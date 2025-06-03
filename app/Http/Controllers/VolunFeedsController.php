<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Portfolio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VolunFeedsController extends Controller
{
    public function index(Request $request)
    {
        $query = Portfolio::join('users', 'portfolio.user_id', '=', 'users.user_id')
            ->select('portfolio.*', 'users.name as username');

        // Filter lokasi
        if ($request->has('location') && !empty($request->location)) {
            $query->where('portfolio.location', 'like', '%' . $request->location . '%');
        }

        $sort = $request->input('sort', 'latest');

        switch ($sort) {
            case 'popular':
                $query->leftJoin(DB::raw('(
                    SELECT
                        p.id,
                        COUNT(*) as likes_count
                    FROM portfolio p
                    JOIN users u
                      ON JSON_VALID(u.profiledetails)
                      AND JSON_CONTAINS(u.profiledetails, CONCAT(\'"\', p.id, \'"\'), "$.liked_portfolios")
                    GROUP BY p.id
                ) likes'), 'portfolio.id', '=', 'likes.id')
                ->orderBy('likes.likes_count', 'desc')
                ->orderBy('portfolio.created_at', 'desc');
                break;

            case 'oldest':
                $query->orderBy('portfolio.created_at', 'asc');
                break;

            default:
                $query->orderBy('portfolio.created_at', 'desc');
                break;
        }

        $feeds = $query->get();

        $feedIds = $feeds->pluck('id')->toArray();
        $likeCounts = $this->getLikeCounts($feedIds);

        foreach ($feeds as $feed) {
            $feed->likes_count = $likeCounts[$feed->id] ?? 0;
        }

        $likedPortfolios = [];
        if (Auth::check()) {
            $user = Auth::user();
            $profileDetails = json_decode($user->profiledetails, true) ?: [];
            $likedPortfolios = $profileDetails['liked_portfolios'] ?? [];
        }

        return view('volunfeeds.index', compact('feeds', 'likedPortfolios'));
    }

    private function getLikeCounts(array $portfolioIds)
    {
        if (empty($portfolioIds)) {
            return [];
        }

        $result = [];
        $users = User::whereNotNull('profiledetails')->get();

        foreach ($portfolioIds as $portfolioId) {
            $count = 0;
            foreach ($users as $user) {
                $profileDetails = json_decode($user->profiledetails, true) ?: [];
                $likedPortfolios = $profileDetails['liked_portfolios'] ?? [];

                if (in_array($portfolioId, $likedPortfolios)) {
                    $count++;
                }
            }

            if ($count > 0) {
                $result[$portfolioId] = $count;
            }
        }

        return $result;
    }

    public function toggleLike($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        $user = Auth::user();

        $profileDetails = json_decode($user->profiledetails, true) ?: [];
        $likedPortfolios = $profileDetails['liked_portfolios'] ?? [];

        if (in_array($id, $likedPortfolios)) {
            $likedPortfolios = array_diff($likedPortfolios, [$id]);
        } else {
            $likedPortfolios[] = $id;
        }

        $profileDetails['liked_portfolios'] = array_values($likedPortfolios);

        User::where('user_id', $user->user_id)->update([
            'profiledetails' => json_encode($profileDetails)
        ]);

        return redirect()->back();
    }

    public function myPortfolios()
    {
        $portfolios = Portfolio::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('volunfeeds.my-portfolios', compact('portfolios'));
    }

    public function show($id)
    {
        $portfolio = Portfolio::join('users', 'portfolio.user_id', '=', 'users.user_id')
            ->select('portfolio.*', 'users.name as username')
            ->where('portfolio.id', $id)
            ->firstOrFail();

        $likeCounts = $this->getLikeCounts([$id]);
        $portfolio->likes_count = $likeCounts[$id] ?? 0;

        $likedPortfolios = [];
        if (Auth::check()) {
            $user = Auth::user();
            $profileDetails = json_decode($user->profiledetails, true) ?: [];
            $likedPortfolios = $profileDetails['liked_portfolios'] ?? [];
        }

        return view('volunfeeds.show', compact('portfolio', 'likedPortfolios'));
    }

    public function showProfile($userId)
    {
        $user = User::findOrFail($userId);

        $feeds = Portfolio::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $feedIds = $feeds->pluck('id')->toArray();
        $likeCounts = $this->getLikeCounts($feedIds);

        foreach ($feeds as $feed) {
            $feed->likes_count = $likeCounts[$feed->id] ?? 0;
        }

        $portfolios = $feeds;

        $likedPortfolios = [];
        if (Auth::check()) {
            $currentUser = Auth::user();
            $profileDetails = json_decode($currentUser->profiledetails, true) ?: [];
            $likedPortfolios = $profileDetails['liked_portfolios'] ?? [];
        }

        return view('volunfeeds.profile', compact('user', 'feeds', 'portfolios', 'likedPortfolios'));
    }
}
