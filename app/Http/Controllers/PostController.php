<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Category;

use App\Post;

class PostController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $posts = Post::allPosts();
        return view('post.index', compact('posts'));
    }


    public function create()
    {
        return view('post.create');
    }

    public function makeSlug($string) {
      $slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
      return $slug;
    }


    public function store(Request $request) {
      $post_id = $request->session()->get('post_id', function() {
       // dd('nothing yet');
      });
      $title = $request->input('title');
      $slug = $this->makeSlug($title);
      $post = Post::find($post_id);
      $post->title = $request->input('title');
      $post->description = $request->input('description');
      $post->category = $request->input('category');
      $post->slug = $slug;
      $post->save();

      $request->session()->forget('post_id');
      return redirect('post/' . $slug);
    }

    public function show($slug) {
      $post = Post::with('photos')->with('labels')->where('slug', '=', $slug)->get();
      return view('post.show', compact('post'));
    }
}
