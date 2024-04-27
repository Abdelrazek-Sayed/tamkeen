<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PostController extends Controller
{


    public function posts(Request $request): View
    {
        return view('posts', [
            'user' => $request->user(),
        ]);
    }

    public function postsArchive(): View
    {
        return view('postsArchive');
    }

}
