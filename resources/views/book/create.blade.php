@extends('layout')

@section('dashboard-content')

<h1>  Create Book form</h1>

@if(Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="gone">
            <strong> {{ Session::get('success') }} </strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(Session::get('failed'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert" id="gone">
            <strong> {{ Session::get('failed') }} </strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif


<form action = "{{URL::to('post-book-form')}}" method = "post" enctype="multipart/form-data">
    @csrf
  <div class="form-group">
    <label for="exampleInputEmail1">Book Title</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Book Title" name="bookTitle">
  </div>



  <div class="form-group">
    <label for="exampleInputEmail1">Upload Book(.PDF File)</label>
    <input type="file" class="form-control"  placeholder="Insert Book Thumbnail" name="book">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Book Thumbnail</label>
    <input type="file" class="form-control"  placeholder="Insert Book Thumbnail" name="bookThumbnail" onchange="loadPhoto(event)">
  </div>

  <div>

  <img id="photo" width="100" height="100"/>
  
  </div>
  <br>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

<script>
        function loadPhoto(event){
            var reader = new FileReader();

            reader.onload = function(){

                var output = document.getElementById('photo');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
            

        }
    
    </script>

@stop