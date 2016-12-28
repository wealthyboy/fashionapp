<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageLabel extends Model
{
    //

    public function photos()
    {
        return $this->belongsTo('App\Photo');
    }


    public static function createLabel($id, $data) {

      $label = new static;
      $label->post_id = $id;
      $label->label_x = $data['labelx'];
      $label->label_y = $data['labely'];
      $label->description = $data['labeltitle'];
      $label->url = $data['labelurl'];
      $label->height = $data['height'];
      $label->width = $data['width'];
      $label->save();
    }
}
