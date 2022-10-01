@extends('layout')

@section('dashboard-content')

<h1>  Update Subject form</h1>

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


<form action = "{{URL::to('update-subject')}}/{{$subject->id}}" method = "post" enctype="multipart/form-data">
    @csrf
  <div class="form-group">
    <label for="exampleInputEmail1">Subject</label>
    <input type="text" value="{{$subject->subject}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Subject name" name="subjectName">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Icon</label>
    <input type="file" class="form-control"  placeholder="Insert subject icon" name="subjectIcon" onchange="loadPhoto(event)">
  </div>

  <div>

  <img id="photo" width="100" height="100" src="{{$subject->icon}}"/>
  
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