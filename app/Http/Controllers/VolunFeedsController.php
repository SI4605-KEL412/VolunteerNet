<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Portfolio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VolunFeedsController extends Controller
{
    /**
     * Display the VolunFeeds timeline
     */
    public function index(Request $request)
    {
        // Base query with join to users table
        $query = Portfolio::join('users', 'portfolio.user_id', '=', 'users.user_id')
            ->select('portfolio.*', 'users.name as username');

        // Apply location filter if provided
        if ($request->has('location') && !empty($request->location)) {
            $query->where('portfolio.location', 'like', '%' . $request->location . '%');
        }

        // Apply sorting
        $sort = $request->input('sort', 'latest');

        switch ($sort) {
            case 'popular':
                // For popular sorting, we need to count likes
                // This requires subquery to count likes from the profiledetails JSON field
                $query->leftJoin(DB::raw('(
                    SELECT
                        p.id,
                        COUNT(*) as likes_count
                    FROM portfolio p
                    JOIN users u ON JSON_CONTAINS(u.profiledetails, CONCAT(\'"\', p.id, \'"\'), "$.liked_portfolios")
                    GROUP BY p.id
                ) likes'), 'portfolio.id', '=', 'likes.id')
                ->orderBy('likes.likes_count', 'desc')
                ->orderBy('portfolio.created_at', 'desc'); // Secondary sort by date
                break;

            case 'oldest':
                $query->orderBy('portfolio.created_at', 'asc');
                break;

            default: // 'latest' as default
                $query->orderBy('portfolio.created_at', 'desc');
                break;
        }

        // Execute the query
        $feeds = $query->get();

        // Get like counts for each portfolio
        $feedIds = $feeds->pluck('id')->toArray();
        $likeCounts = $this->getLikeCounts($feedIds);

        // Attach like counts to feed items
        foreach ($feeds as $feed) {
            $feed->likes_count = $likeCounts[$feed->id] ?? 0;
        }

        // Get current user liked portfolios
        $likedPortfolios = [];
        if (Auth::check()) {
            $user = Auth::user();
            $profileDetails = json_decode($user->profiledetails, true) ?: [];
            $likedPortfolios = $profileDetails['liked_portfolios'] ?? [];
        }

        return view('volunfeeds.index', compact('feeds', 'likedPortfolios'));
    }

    /**
     * Helper method to get like counts for portfolios
     */
    private function getLikeCounts(array $portfolioIds)
    {
        if (empty($portfolioIds)) {
            return [];
        }

        // Alternative approach with query builder for safer SQL
        $result = [];

        // Use a simpler query that's less prone to quote/escaping issues
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

    /**
     * Toggle like status for a portfolio
     */
    public function toggleLike($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        $user = Auth::user();

        // Ambil detail profile, default ke array kosong
        $profileDetails = json_decode($user->profiledetails, true) ?: [];
        $likedPortfolios = $profileDetails['liked_portfolios'] ?? [];

        // Toggle like/unlike
        if (in_array($id, $likedPortfolios)) {
            $likedPortfolios = array_diff($likedPortfolios, [$id]);
        } else {
            $likedPortfolios[] = $id;
        }

        // Simpan kembali ke kolom JSON
        $profileDetails['liked_portfolios'] = array_values($likedPortfolios);

        // Replace the save() call with update()
        User::where('user_id', $user->user_id)->update([
            'profiledetails' => json_encode($profileDetails)
        ]);

        return redirect()->back();
    }

    /**
     * Show user's own portfolios
     */
    public function myPortfolios()
    {
        $portfolios = Portfolio::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('volunfeeds.my-portfolios', compact('portfolios'));
    }

    /**
     * View detailed portfolio
     */
    public function show($id)
    {
        $portfolio = Portfolio::join('users', 'portfolio.user_id', '=', 'users.user_id')
            ->select('portfolio.*', 'users.name as username')
            ->where('portfolio.id', $id)
            ->firstOrFail();

        // Get like count
        $likeCounts = $this->getLikeCounts([$id]);
        $portfolio->likes_count = $likeCounts[$id] ?? 0;

        // Initialize likedPortfolios array
        $likedPortfolios = [];

        // Get like status if authenticated
        if (Auth::check()) {
            $user = Auth::user();
            $profileDetails = json_decode($user->profiledetails, true) ?: [];
            $likedPortfolios = $profileDetails['liked_portfolios'] ?? [];
        }

        return view('volunfeeds.show', compact('portfolio', 'likedPortfolios'));
    }

    /**
     * View user profile with portfolios
     */
    public function showProfile($userId)
    {
        $user = User::findOrFail($userId);

        // Renamed from $portfolios to $feeds to match the view expectation
        $feeds = Portfolio::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->paginate(10); // Add pagination for better UX

        // Get like counts
        $feedIds = $feeds->pluck('id')->toArray();
        $likeCounts = $this->getLikeCounts($feedIds);

        // Attach like counts
        foreach ($feeds as $feed) {
            $feed->likes_count = $likeCounts[$feed->id] ?? 0;
        }

        // For the sidebar display
        $portfolios = $feeds;

        // Get like status if authenticated
        $likedPortfolios = [];
        if (Auth::check()) {
            $currentUser = Auth::user();
            $profileDetails = json_decode($currentUser->profiledetails, true) ?: [];
            $likedPortfolios = $profileDetails['liked_portfolios'] ?? [];
        }

        return view('volunfeeds.profile', compact('user', 'feeds', 'portfolios', 'likedPortfolios'));
    }
}
