@extends('layout')

@section('dashboard-content')

<h1>  Update Book form</h1>

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


<form action = "{{URL::to('update-book-form')}}/{{$book->id}}" method = "post" enctype="multipart/form-data">
    @csrf
  <div class="form-group">
    <label for="exampleInputEmail1">Book Title</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Book Title" name="bookTitle" value="{{$book->book_title}}">
  </div>



  <div class="form-group">
    <label for="exampleInputEmail1">Upload Book(.PDF File)</label>
    <input type="file" class="form-control"  placeholder="Insert Book Thumbnail" name="book" value="{{$book->book_url}}">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Book Thumbnail</label>
    <input type="file" class="form-control"  placeholder="Insert Book Thumbnail" name="bookThumbnail" onchange="loadPhoto(event)">
  </div>

  <div>

  <img id="photo" width="100" height="100" src="{{$book->book_thumbnail}}"/>
  
  </div>
  <br>
  <button type="submit" class="btn btn-primary">Update</button>
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