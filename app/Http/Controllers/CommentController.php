<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    private $comment;
    public function __construct(Comment $comment){
        $this->comment = $comment;
    }

    public function store(Request $request, $post_id){
        $request->validate([
            "comment_body$post_id" => 'required|max:150'
        ],
        [
            // costumize error message
            "comment_body$post_id.required" => 'You cannot post an empty comment.',
            "comment_body$post_id.max" => 'Maximum of 150 characters only.'
        ]);

        $this->comment->body = $request->input('comment_body'.$post_id);
        $this->comment->post_id = $post_id;
        $this->comment->user_id = Auth::user()->id;
        $this->comment->save();

        return redirect()->back(); //go back to previous page
    }

    public function destroy($id){

        $this->comment->destroy($id);

        return redirect()->back();
    }
}
