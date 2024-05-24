<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostsController extends Controller
{
    private $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function index(Request $request)
    {
        if($request->search){
            // search data
            $all_posts = $this->post->orderBy('id', 'desc')
                                    ->where('description', 'LIKE', '%'.$request->search.'%')
                                    ->get();
        }else{
            $all_posts = $this->post->orderBy('id', 'desc')->withTrashed()->get();
        }

        return view('admin.posts.index')->with('all_posts', $all_posts)
                                        ->with('search', $request->search);
    }

    public function hide($id)
    {
        $this->post->destroy($id);

        return redirect()->back();
    }

    public function unhide($id)
    {
        $this->post->onlyTrashed()->findOrFail($id)->restore();

        return redirect()->back();
    }
}
