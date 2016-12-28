<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Requests;

class Post extends Model
{
    //

    public static function createNewPost() {

        $post = new static;
        $post->user_id = \Auth::id();
        $post->save();

        return $post->id;
    }

    public function photos()
    {
        return $this->hasMany('App\Photo')->orderBy('is_active');
    }

    public function labels()
    {
        return $this->hasMany('App\ImageLabel');
    }


    public static function getPostSession($request) {
      if ($request->session()->has('post_id')) {
          return session('post_id');
      }

      $post = self::createNewPost();
      $request->session()->put('post_id', $post);
      return $post;
    }

    public static function allPosts(){
      $posts = new static;
      $id = \Auth::id();
      return $posts::with('photos')->where('user_id', '=', $id)->get();
    }
}
