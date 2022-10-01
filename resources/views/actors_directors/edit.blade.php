@extends('layout')

@section('dashboard-content')

<h1>  Update Actors/Directors form</h1>

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


<form action = "{{URL::to('update-star-form')}}/{{$star->id}}" method = "post" enctype="multipart/form-data">
    @csrf
  <div class="form-group">
    <label for="exampleInputEmail1">Actor/Director/Writer:</label>
    <input type="text" value="{{$star->name}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter star name" name="starName">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Star role:</label>
    <input type="text" value="{{$star->star_role}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter starrole" name="starRole">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Star Photo:</label>
    <input type="file" class="form-control"  placeholder="Insert country photo" name="starPhoto" onchange="loadPhoto(event)">
  </div>

  <div>

  <img id="photo" width="100" height="100" src="{{$star->photo}}"/>
  
  </div>
  <br>

  

  <div class="form-group">
            <label for="exampleInputEmail1"> Star Bio: </label>
            <textarea name="starBio" id="editor1"> {{$star->star_bio}}  </textarea>
        </div>


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