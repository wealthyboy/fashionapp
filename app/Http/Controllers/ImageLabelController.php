<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\ImageLabel;

class ImageLabelController extends Controller
{
    //

    public function index() {

      dd(ImageLabel::get());

    }

    public function create(Request $request) {

      $input = $request->input();

      $data = $request['data'];
      $id = $request['id'];

      foreach ($data as $d) {
        ImageLabel::createLabel($id, $d);
      }

      dd($data);
    }
}
