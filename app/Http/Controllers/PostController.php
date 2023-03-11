<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
class PostController extends Controller
{
     
    public function index() {


        $postsFromBD = Post::all();
        return view("posts.index",['posts' => $postsFromBD]);
        
    }

    public function show(Post $post){

        // $showPost = Post::findOrFail($post);
        return view('posts.show' ,['post' => $post]);

    }

    public function create(){
        
        $users = User::all();

        return view('posts.create',['users' => $users]);
    }

    public function store(Request $request){

        // Tari9a 1
        $title = $request->title;
        $description = $request->description;
        $users = $request ->user_id;
        // Tari9a 2 
        // $title = request()->title;
        // $description = request()->description;
// need protected fillable in model to work 
        $post = Post::create([
            'title' =>$title ,
            'description' =>$description ,
            'user_id' =>$users
        ]);
// don't need protected fillable in model to work 
        // $post = new Post ;
        // $post = $title->title;
        // $post = $description->description;
        // $post->save();
    return redirect()->route('posts.index');

    }

    public function edit(Post $post){
        $users = User::all();


        // $editPost = Post::findOrFail($post);
        return view('posts.edit',['post' => $post,'users' => $users]);
    }

    public function update(Post $post,Request $request){

        // $updatePost = Post::findOrFail($post);

        $post->update([
            'title' =>$request->title ,
            'description' =>$request->description,
            'user_id' =>$request->user_id, 

        ]);

      

        return redirect()->route('posts.index');
    }

    public function destroy(Post $post){

    //   $destroyPost = Post::findOrFail($post);
      $post->delete();
      return redirect()->route('posts.index');
    }
}
