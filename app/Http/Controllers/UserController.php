<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->name;
        $users = User::with('profile')->whereHas('profile', function ($query) use ($keyword) {
            $query->where('name', 'LIKE', '%' . $keyword . '%');
        })->orderBy('id', 'desc')->paginate(5);

        $users = User::with('profile')->whereHas('profile', function ($query) use ($keyword) {
            $query->where('name', 'LIKE', '%' . $keyword . '%');
        })->orderBy('id', 'desc')->paginate(5);

        return view('public.user', ['title' => 'Data User', 'users' => $users, 'keyword' => $keyword]);
    }

    public function detail(string $slug)
    {
        $user = User::with('profile')->where('slug', $slug)->firstOrFail();

        return view('public.detail_user', ['title' => $user->username, 'user' => $user]);
    }

    public function softDelete(string $slug)
    {
        $user = User::where('slug', $slug)->firstOrFail();
        $user->delete();

        return redirect('/users')->with('success', 'Data dipindahkan ke sampah!');
    }

    public function trash(Request $request)
    {
        $keyword = $request->name;

        $users = User::onlyTrashed()
            ->with(['profile' => function ($query) {
                $query->withTrashed();
            }])
            ->whereHas('profile', function ($query) use ($keyword) {
                $query->withTrashed()->where('name', 'LIKE', '%' . $keyword . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(5);

        return view('public.user_trash', ['title' => 'Sampah User', 'users' => $users, 'keyword' => $keyword]);
    }

    public function trashDetail(string $slug)
    {
        $user = User::onlyTrashed()->with(['profile' => function ($query) {
            $query->withTrashed();
        }])->where('slug', $slug)->firstOrFail();

        return view('public.detail_trash_user', ['title' => 'Detail', 'user' => $user]);
    }

    public function restore(string $slug)
    {
        $user = User::onlyTrashed()->with(['profile' => function ($query) {
            $query->withTrashed();
        }])->where('slug', $slug)->firstOrFail();
        $user->restore();

        return redirect('/users')->with('success', 'Data berhasil dipulihkan!');
    }

    public function delete(string $slug) {
        $user = User::onlyTrashed()->with(['profile' => function($query) {
            $query->withTrashed();
        }])->where('slug', $slug)->firstOrFail();

        $user->forceDelete();

        return redirect('/users')->with('success', 'Data berhasil dihapus!');
    }
}
