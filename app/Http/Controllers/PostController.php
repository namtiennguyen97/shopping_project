<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function showPost(){
        $post = Post::all();
        return $post;
    }
    public function addPost(Request $request){
        $post = new Post();
        $post->comment = $request->input('comment');
        $post->user_id = Auth::user()->id;
        $post->save();
        return $post;
    }
    public function destroy($id){
        Post::destroy($id);
    }
}
