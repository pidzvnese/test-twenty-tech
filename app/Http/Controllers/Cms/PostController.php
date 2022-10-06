<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('cms.pages.blog.index',);
    }

    public function create()
    {
        return view('cms.pages.blog.create');
    }


    public function store(Request $request)
    {
        $userId = Auth::user()->id;
        $newPost = Post::create([
            'title' => $request->title,
            'content' => $request->blog_content,
            'user_id' => $userId,
            'status' => 0
        ]);
        return redirect('blog/' . $newPost->id);
    }

    public function show(Post $post)
    {
        $userId = Auth::user()->id;
        $canAction = false;
        if($userId == $post->user_id) {
            $canAction = true;
        }
        return view('cms.pages.blog.show', [
            'post' => $post,
            'canAction' => $canAction
        ]);
    }


    public function edit(Post $post)
    {
        return view('cms.pages.blog.edit', [
            'post' => $post,
        ]);
    }


    public function update(Request $request, Post $post)
    {
        $post->update([
            'title' => $request->title,
            'body' => $request->blog_content
        ]);

        return redirect('blog/' . $post->id);
    }


    public function destroy(Request $request, Post $post)
    {
        $post->delete();
        if ($request->ajax()) {
            return response()->json(['status' => 'ok']);
        }
        return redirect('/admin/blog')->with('_method', 'GET');
    }


    public function publish(Request $request, Post $post)
    {
        $post->update([
            'status' => 1
        ]);

        if ($request->ajax()) {
            return response()->json(['status' => 'ok']);
        }
        return redirect('blog/' . $post->id);
    }


    public function getDatatables(Request $request)
    {
        if ($request->ajax()) {
            $user = Auth::user();
            if($user->hasRole('Admin')) {
                $data = Post::latest();
            } else {
                $data = Post::where('user_id', $user->id)->latest();
            }
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row)  {
                    $actionBtn = '<a href="/admin/blog/'.$row->id.'/edit" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" data-id="' .$row->id .'" class="delete btn btn-danger btn-sm">Delete</a> ';
                    if($row->status == 0 && Auth::user()->hasRole('Admin'))
                    $actionBtn .= '<a href="javascript:void(0)" data-id="' .$row->id .'" class="publish btn btn-primary btn-sm">Publish</a>';
                    return $actionBtn;
                })
                ->filter(function ($instance) use ($request) {
                    if ($request->get('status') == '0' || $request->get('status') == '1') {
                        $instance->where('status', $request->get('status'));
                    }

                    if (!empty($request->get('search'))) {
                        $instance->where(function($w) use($request){
                            $search = $request->get('search');
                            $w->orWhere('title', 'LIKE', "%$search%");
                        });
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
