@extends('layout')

@section('dashboard-content')

<h1>  Create Season form</h1>

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


<form action = "{{URL::to('post-season-form')}}" method = "post" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
                            <label for="exampleInputEmail1">Series Name :</label>
                            <select  class="drop-down related-post form-control" name="seriesTitle" >
                            @foreach($series as $serie)
                    <option value="{{ $serie->id }}"> {{ $serie->title }}</option>
                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Season Number :</label>
                            <select  class="drop-down related-post form-control" name="seasonNumber">
                                <option value="1">Season 1</option>
                                <option value="2">Season 2</option>
                                <option value="3">Season 3</option>
                                <option value="4">Season 4</option>
                                <option value="5">Season 5</option>
                                <option value="6">Season 6</option>
                                <option value="7">Season 7</option>
                                <option value="8">Season 8</option>
                                <option value="9">Season 9</option>
                                <option value="10">Season 10</option>
                                <option value="11">Season 11</option>
                                <option value="12">Season 12</option>
                                <option value="13">Season 13</option>
                                <option value="14">Season 14</option>
                                <option value="15">Season 15</option>
                                <option value="16">Season 16</option>
                                <option value="17">Season 17</option>
                                <option value="18">Season 18</option>
                                <option value="19">Season 19</option>
                                <option value="20">Season 20</option>
                              
                            </select>
                            </div>

                         


  <div class="form-group">
    <label for="exampleInputEmail1">Season Thumbnail</label>
    <input type="file" class="form-control"  placeholder="Insert Season Thumbnail" name="seasonThumbnail" onchange="loadPhoto(event)">
  </div>

  <div class="form-group">
  <div >

  <img id="photo" width="100" height="100"/>
  
  </div>

</br>
  

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