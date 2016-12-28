<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Photo extends Model
{
    //
    public static function addNewPhoto($file) {

      $photo = new static;

      $ext = $file->guessClientExtension();

      $timestamp = time() .'.'.$ext;

      $img = \Image::make($file)->save(public_path() .'/images/'. $timestamp);

      self::savePhoto($timestamp, session()->get('post_id'));

      return true;

    }

    public static function savePhoto($path, $post) {

        $photo = new static;
        $photo->url = $path;
        $photo->post_id = $post;
        $photo->save();

    }

    public static function makeActiveImage($id) {
          $photo = new static;

    }
}
