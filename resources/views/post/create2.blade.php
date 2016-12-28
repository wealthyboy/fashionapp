@extends('layouts.app')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.css" rel="stylesheet" type="text/css"></script>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Upload New Pictures</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/post/store') }}" id="upload-post">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Subject</label>

                            <div class="col-md-6">
                                <input id="subject" type="text" class="form-control" name="subject" value="{{ old('subject') }}">

                                @if ($errors->has('subject'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('subject') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Category</label>

                            <div class="col-md-6">
                                <select class="form-control">
                                    <option> Choose Category </option>
                                </select>

                                @if ($errors->has('subject'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('subject') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                                <textarea id="description" name="textarea" class="form-control">  </textarea>
                            </div>
                        </div>

                    </form>

                    <form enctype="multipart/form-data"  action="/photo/store" class="dropzone needsclick" id="addPhotosForm">
                            {{ csrf_field() }}
                            <input type="hidden" id="formmode" value="insert" name="formmode">
                            <input type="hidden" id="edititemid" value="none" name="itemid">
                            <input type="hidden" id="picture" value="0" name="picture">
                    </form>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="button" class="btn btn-primary" id="uploa-post">
                                 Create New Post
                            </button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.js"></script>
<script>
$("form#addPhotosForm").dropzone({
  //forceFallback: true,
      paramName: "file", // The name that will be used to transfer the file
      maxFilesize: 15, // MB
      parallelUploads: 1,
      acceptedFiles: "image/*",
      addRemoveLinks: true,
      maxFiles: 5,
      autoProcessQueue: true,
      parallelUploads: 1,
        complete: function(file) {

        },
      dictRemoveFile: "Remove Photo",
      init: function() {

      this.on("success", function(file, response) {
      files++;
      $(".dropzone").css({"background-image": "url('assets/img/mobile-dropzone.png')", "background-repeat": "no-repeat", "background-size": "40px 40px", "background-position": "95% 95%"});
      //localStorage.setItem("FileNumber", files);
      $("#picture").val(files)
      var servername = response;
      fileList[response] = {"serverFileName" : response, "fileName" : file.name };
      })
      },
      removedfile: function(file) {
      var _ref;
      token = $("form#deletephoto input[name=_token]").val();
      if(files > 0) {
      files--;
      }else{
      files = 0;
      }
      //localStorage.setItem("FileNumber", files);
      $("#picture").val(files)
      $.ajax({
      url: "photos/remove",
      type: "POST",
      data: { "fileList" : JSON.stringify(fileList), "_token":token, "filename":file.name }
      });
      return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
      },
      fallback: function(){
      $("#addPhotosForm").append('<input type="file" name="file" id="filefield" onchange="doStuff(this)">' +
      '<div class="container clearfix"> <div class="row" id="container"></div></div>')
      $("#submitbutton").html('<button class="btn btn-default" id="submit-request" type="button" onclick="submitRequest()">ADD ITEM FOR QUOTE </button>')
      },
  });

  $(function() {
    $('#uploa-post').on('click', function() {
      var form  = $('#upload-post');
      form.submit();
    })
  })
</script>
