<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function __construct(){

        $this->middleware(['auth'])->only(['store','destroy']);
    }

    public function index()
    {
        // we used eagger loading by append the relations between the Post model and User,Like models
        // it will reduce the capasity of queries coming from db
        // its importanat to have the relation between models before use it
        $posts = Post::latest()->with(['user','likes'])->paginate(20);
        // orderBy('created_at','desc') == latest()


        return view('posts.index',[
            'posts' => $posts
        ]);
    }

    public function store(Request $request)
    {

        // validation
        $this->validate($request, [
            'body' =>'required'
        ]);

        //storing the post
        $request->user()->posts()->create($request->only('body'));

        return back();
    }
    public function show(Post $post){
        return view('posts.show',[
            'posts' => $post
        ]);
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete',$post);
        $post->delete();
        return back();
    }
}
