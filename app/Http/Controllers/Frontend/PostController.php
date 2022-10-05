<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PostController extends Controller
{
    public function show(Post $post)
    {
        $canAction = false;
        return view('cms.pages.blog.show', [
            'post' => $post,
            'canAction' => $canAction
        ]);
    }
}
