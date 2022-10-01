@extends('layout')

@section('dashboard-content')

<h1>  Update Episode form</h1>

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


<form action = "{{URL::to('update-episode-form')}}/{{$episode->id}}" method = "post" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
                            <label for="exampleInputEmail1">Season Name :</label>
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
                              
                            </select>
                            </div>

                            <div class="form-group">
                            <label for="exampleInputEmail1">Episode Number :</label>
                            <select  class="drop-down related-post form-control" name="episodeNumber">
                                <option value="1">Episode 1</option>
                                <option value="2">Episode 2</option>
                                <option value="3">Episode 3</option>
                                <option value="4">Episode 4</option>
                                <option value="5">Episode 5</option>
                                <option value="6">Episode 6</option>
                                <option value="7">Episode 7</option>
                                <option value="8">Episode 8</option>
                                <option value="9">Episode 9</option>
                                <option value="10">Episode 10</option>
                              
                            </select>
                            </div>


  <div class="form-group">
    <label for="exampleInputEmail1">Episode Thumbnail</label>
    <input type="file" class="form-control"  placeholder="Insert Episode Thumbnail" name="episodeThumbnail" onchange="loadPhoto(event)">
  </div>

  <div class="form-group">
  <div >

  <img id="photo" width="100" height="100" src="{{$episode->episode_thumbnail}}"/>
  
  </div>

</br>
  
  <div class="form-group">
                            <label for="exampleInputEmail1">Episode Url :</label>
                            <input type="text" value="{{$episode->episode_url}}" name="episode_url" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Episode Download Url :</label>
                            <input type="text" value="{{$episode->episode_download_url}}" name="episode_download_url" class="form-control">
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