<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post;
use App\Photo;


class PhotoController extends Controller
{
    //



    public function store(Request $request, Photo $photo) {

        //Validate the file to make sure it is an image

        //$post = Post::createNewPost();

        $p = Post::getPostSession($request);
		
		

        $file = $request->file('file');

        //Save Photo Path;

        $photo = Photo::addNewPhoto($file);

        //dd($photo);

    }


}
