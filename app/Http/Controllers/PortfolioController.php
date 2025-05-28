<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portfolio;
use Illuminate\Support\Facades\Auth;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $portfolios = Portfolio::where('user_id', Auth::id())->orderBy('date', 'desc')->get();
        return view('portfolio.index', compact('portfolios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('portfolio.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'date' => 'nullable|date',
            'location' => 'nullable|max:255',
            'file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'location' => $request->location,
        ];

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('portfolio_files', $filename, 'public');
            $data['file_path'] = $filename;
        }

        Portfolio::create($data);

        return redirect()->route('portfolio.index')->with('success', 'Entri portofolio berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $portfolio = Portfolio::where('user_id', Auth::id())->findOrFail($id);
        return view('portfolio.edit', compact('portfolio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $portfolio = Portfolio::where('user_id', Auth::id())->findOrFail($id);

        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'date' => 'nullable|date',
            'location' => 'nullable|max:255',
            'file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048', // validasi file
        ]);

        $data = $request->only('title', 'description', 'date', 'location');

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('portfolio_files', $filename, 'public');
            $data['file_path'] = $filename;
        }

        $portfolio->update($data);

        return redirect()->route('portfolio.index')->with('success', 'Entri berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $portfolio = Portfolio::where('user_id', Auth::id())->findOrFail($id);
        $portfolio->delete();

        return redirect()->route('portfolio.index')->with('success', 'Entri berhasil dihapus.');
    }
}