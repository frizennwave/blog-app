<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->query('category');

        $news = News::with(['image', 'rating', 'categories'])
            ->when($category, function ($query) use ($category) {
                $query->whereHas('categories', function ($query) use ($category) {
                    $query->where('slug', $category);
                });
            })->latest()->paginate(6)->withQueryString();

        $categories = Category::query()->orderBy('name')->get();

        return view('public.news', compact('news', 'categories', 'category'));
    }

    public function adminNews(Request $request)
    {
        $keyword = $request->title;
        /* $tags = Tag::all(); */

        $news = News::where('title', 'LIKE', '%' . $keyword . '%')->orderBy('id', 'desc')->paginate(5);
        $title = 'News';

        return view('private.news', compact('title', 'news', 'keyword'));
    }

    public function detailNews(string $slug)
    {
        $news = News::with(['image', 'categories'])->where('slug', $slug)->firstOrFail();
        $title = 'Detail News';

        return view('private.detail_news', compact('title', 'news'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:news|max:255',
            'author' => 'required|max:255',
            'content' => 'required',
            'status' => 'required',
        ]);

        News::create($request->all());
        /* $blog->tags()->attach($request->tags); */

        return redirect(route('news'))->with('success', 'Data berhasil disimpan!');
    }

    public function update(Request $request, string $slug)
    {
        $news = News::with('image')->where('slug', $slug)->firstOrFail();

        $request->validate([
            'title' => 'required|unique:news,title,' . $news->id . '|max:255',
            'author' => 'required|max:255',
            'content' => 'required',
            'status' => 'required',
        ]);

        /* $blog->tags()->sync($request->tags); */
        $news->update($request->all());

        return redirect(route('news'))->with('success', 'Data Berhasil diubah!');
    }

    public function softDelete(string $slug)
    {
        $news = News::where('slug', $slug)->firstOrFail();
        $news->delete();

        return redirect(route('news'))->with('success', 'Data dipindahkan ke sampah!');
    }

    public function trash(Request $request)
    {
        $keyword = $request->title;
        $news = News::onlyTrashed()->with(['rating', 'categories'])->where('title', 'LIKE', '%' . $keyword . '%')->paginate(5);
        $title = 'Sampah News';

        return view('private.news_trash', compact('title', 'news', 'keyword'));
    }

    public function trashDetail(string $slug)
    {
        $news = News::onlyTrashed()->where('slug', $slug)->firstOrFail();

        return view('private.detail_trash_news', ['title' => 'Detail News', 'news' => $news]);
    }

    public function restore(string $slug)
    {
        News::onlyTrashed()->where('slug', $slug)->restore();

        return redirect(route('news'))->with('success', 'Data Berhasil dipulihkan!');
    }

    public function delete(string $slug)
    {
        News::onlyTrashed()->where('slug', $slug)->forceDelete();

        return redirect(route('news'))->with('success', 'Data Berhasil dihapus!');
    }

}
