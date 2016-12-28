@extends('layouts.app')

@section('content')
<style>
  img {
    max-width: 100%;
  }
</style>
<div class="container">
    <div class="row">

      <h2>All Posts</h2>
      <hr>
        <div class="col-md-12">


          <div class="row">
            @foreach($posts as $post)
              <div class="row">
                <div class="col-md-2">
                      <img src="/images/{{ $post->photos[0]->url }}" title="{{ $post->title }}" id="something" data-id="{{ $post->id }}"/>
                </div>
                <div class="col-md-10">
                    <h4>{{$post->title}}</h4>
                    <p>{{ $post->description}}</p>
                    <p><span>Views: 200 </span> <span>Likes: </span> <span>Likes: </span></p>
                    <p><span><a href="{{ url('/post/'. $post->slug) }}"> Edit</a></span> | <span><a href="#">Delete</a></span></p>
                </div>
              </div>
              <hr>
            @endforeach
          </div>
        </div>
    </div>
</div>
@endsection
