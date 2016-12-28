@extends('layouts.app')

@section('content')
<style media="screen">
  img {
    max-width: 100%;
  }

  .add-description-form {
    width: 200px;
    height: 180px;
    border: 1px;
    z-index: 1000;
    background-color: #fff;
    position: absolute;
    top: 0;
    left: 0;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 10px;
    display: none;
}

.small-box {
  border: 1px solid red;
  background: red;
  height: 40px;
  width: 40px;
  position: absolute;
  z-index: 100;
}

#save-label {
  width: 100%;
  margin-bottom: 25px;
}

</style>

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $post[0]->title }}</div>

                <div class="panel-body">
                  <div class="col-md-9">
                    @foreach($post[0]->labels as $label)
                      <div class="small-box" data-height="{{$label->height}}" data-width="{{$label->width}}" data-left="{{$label->label_x}}" data-top="{{$label->label_y}}"> </div>
                    @endforeach
                    <div class="image-edit">
                          <img src="/images/{{ $post[0]->photos[0]->url }}" title="{{ $post[0]->title }}" id="something" data-id="{{ $post[0]->id }}"/>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div>
                      <button id="save-label" class="btn btn-primary"> Save Entry </button>
                    </div>
                    @foreach($post[0]->photos as $photo)
                      <img src=/images/{{ $photo->url }} title="{{ $post[0]->title }}"/>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<div class="add-description-form">
    <div class="row">
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Title" name="labeltitle" id="labeltitle">
      </div>

      <div class="form-group">
        <input type="text" class="form-control" placeholder="URL" name="labelurl" id="labelurl">
      </div>
        <button class="btn btn-primary" id="submit-label"> Submit </button>
    </div>
</div>
@endsection
