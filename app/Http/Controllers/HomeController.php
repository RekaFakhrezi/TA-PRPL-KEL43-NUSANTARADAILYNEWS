<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // All categories for filter tabs
        $categories = Category::all();

        // Featured article
        $featured = Article::where('status', 'approved')
                        ->where('featured', true)
                        ->latest()
                        ->first();

        if (! $featured) {
            $featured = Article::where('status', 'approved')
                        ->latest()
                        ->first();
        }

        // Build articles query with search, sort, category filters
        $query = Article::where('status', 'approved')
                    ->when($featured, function ($q) use ($featured) {
                        return $q->where('id', '!=', $featured->id);
                    });

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        // Category filter
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Sort
        $sort = $request->get('sort', 'terbaru');
        switch ($sort) {
            case 'terlama':
                $query->oldest();
                break;
            case 'terpopuler':
                $query->withCount('likes')->orderByDesc('likes_count');
                break;
            default: // terbaru
                $query->latest();
                break;
        }

        // Paginate
        $articles = $query->with('category')->paginate(12)->withQueryString();

        // Popular articles (most liked, for right sidebar)
        $popularArticles = Article::where('status', 'approved')
                            ->withCount('likes')
                            ->orderByDesc('likes_count')
                            ->take(5)
                            ->get();

        // Articles grouped by category (for category sections)
        $categoryArticles = [];
        foreach ($categories as $cat) {
            $catArticles = Article::where('status', 'approved')
                            ->where('category_id', $cat->id)
                            ->latest()
                            ->take(4)
                            ->get();
            if ($catArticles->count() > 0) {
                $categoryArticles[$cat->id] = [
                    'category' => $cat,
                    'articles' => $catArticles,
                ];
            }
        }

        return view('home', compact(
            'featured',
            'articles',
            'categories',
            'popularArticles',
            'categoryArticles'
        ));
    }
}