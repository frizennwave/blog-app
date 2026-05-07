<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'blog_id' => 'required',
            'comment' => 'required'
        ]);

        Comment::create($request->all());

        return redirect()->route('detailBlog', $request->slug)->with('success', 'Data berhasil disimpan!');
    }
}
