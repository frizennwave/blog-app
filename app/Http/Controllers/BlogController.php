<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Tag;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('image')->latest()->paginate(6);

        return view('public.blog', compact('blogs'));
    }

    public function adminBlog(Request $request)
    {
        $title = $request->title;
        $tags = Tag::all();

        // $blogs = DB::table('blogs')->where('title', 'LIKE', '%'.$title.'%')->orderBy('id', 'desc')->paginate(5);
        $blogs = Blog::where('title', 'LIKE', '%' . $title . '%')->orderBy('id', 'desc')->paginate(5);

        return view('private.blog', ['title' => 'Blog', 'blogs' => $blogs, 'keyword' => $title, 'tags' => $tags]);
    }

    public function detailBlog(string $slug)
    {
        // $blog = DB::table('blogs')->where('slug', $slug)->firstOrFail();
        $blog = Blog::with(['comment', 'tags'])->where('slug', $slug)->firstOrFail();

        return view('private.detail_blog', ['title' => 'Detail Blog', 'blog' => $blog]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:blogs|max:255',
            'author' => 'required|max:255',
            'content' => 'required'
        ]);

        $title = $request->title;

        // DB::table('blogs')->insert([
        //     'title' => $title,
        //     'slug' => Str::slug($title),
        //     'author' => $request->author,
        //     'content' => $request->content,
        //     'created_at' => now(),
        //     'updated_at' => now()
        // ]);

        $blog = Blog::create($request->all());
        $blog->tags()->attach($request->tags);

        return redirect(route('blog'))->with('success', 'Data berhasil disimpan!');
    }

    public function update(Request $request, string $slug)
    {
        // $blog = DB::table('blogs')->where('slug', $slug)->firstOrFail();
        $blog = Blog::with(['tags'])->where('slug', $slug)->firstOrFail();

        $request->validate([
            'title' => 'required|unique:blogs,title,' . $blog->id . '|max:255',
            'author' => 'required|max:255',
            'content' => 'required'
        ]);

        $title = $request->title;

        // DB::table('blogs')->where('slug', $slug)->update([
        //     'title' => $title,
        //     'slug' => Str::slug($title),
        //     'author' => $request->author,
        //     'content' => $request->content,
        //     'updated_at' => now()
        // ]);

        // detach/hapus tag dari blog
        // $blog->tags()->detach($blog->tags);
        // attach/tambah tag ke blog
        // $blog->tags()->attach($request->tags);


        // Menggunakan sync
        $blog->tags()->sync($request->tags);
        $blog->update($request->all());

        return redirect(route('blog'))->with('success', 'Data Berhasil diubah!');
    }

    public function softDelete(string $slug)
    {
        // DB::table('blogs')->where('slug', $slug)->delete();
        $blog = Blog::where('slug', $slug)->firstOrFail();
        $blog->delete();

        return redirect(route('blog'))->with('success', 'Data dipindahkan ke sampah!');
    }

    public function trash(Request $request)
    {
        $keyword = $request->title;
        $blogs = Blog::onlyTrashed()->where('title', 'LIKE', '%' . $keyword . '%')->paginate(5);

        return view('private.blog_trash', ['title' => 'Sampah Blog', 'blogs' => $blogs, 'keyword' => $keyword]);
    }

    public function trashDetail(string $slug)
    {
        $blog = Blog::onlyTrashed()->with([
            'comment' => function ($query) {
                $query->withTrashed();
            }, 'tags'])->where('slug', $slug)->firstOrFail();

        return view('private.detail_trash_blog', ['title' => 'Detail Blog', 'blog' => $blog]);
    }

    public function restore(string $slug)
    {
        Blog::onlyTrashed()->where('slug', $slug)->restore();

        return redirect(route('blog'))->with('success', 'Data Berhasil dipulihkan!');
    }

    public function delete(string $slug)
    {
        Blog::onlyTrashed()->where('slug', $slug)->forceDelete();

        return redirect(route('blog'))->with('success', 'Data Berhasil dihapus!');
    }
}
