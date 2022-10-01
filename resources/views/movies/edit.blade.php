<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha256-aAr2Zpq8MZ+YA/D6JtRD3xtrwpEz2IqOS+pWD/7XKIw=" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha256-OFRAJNoaD8L3Br5lglV7VyLRf0itmoBzWUoM+Sji4/8=" crossorigin="anonymous"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src = "{{URL::to('ckeditor/ckeditor.js')}}"></script>

</head>
<body style="background-color:black; margin:0px; padding-bottom:50px">
    <div class="row mt-5" >
        <div class="col-md-6 offset-3 mt-5">
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
            <div class="card">
            <h2 class="btn-info" style="text-align:center; padding:15px">Update Movie</h2>
                <div class="card-header">
                <a href="{{ URL::to('all-movies') }}"><button class="btn btn-primary store-related-post btn-sm">View Movie List</button></a>
                   
                </div>
                <div class="card-body" style="height: 100%;">
                <form action = "{{URL::to('update-movie-form')}}/{{$movie->id}}" method = "post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Title :</label>
                            <input type="text" value="{{$movie->title}}" name="title" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Movie Url :</label>
                            <input type="text"  value="{{$movie->movie_url}}" name="movie_url" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Download Url :</label>
                            <input type="text"  value="{{$movie->download_url}}" name="download_url" class="form-control">
                        </div>
                        
                        <div class="form-group">
            <label for="exampleInputEmail1"> Description: </label>
            <textarea name="description" id="editor1"> {{$movie->description}}  </textarea>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1"> Movie Thumbnail: </label>
            <input type="file" class="form-control btn btn-primary" name="thumbnail" onchange="loadThumbnail(event)">
        </div>

        <div class="form-group">
            <img id="thumbnail"  src="{{$movie->movie_thumbnail}}" height="300" width="200">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1"> Movie Poster: </label>
            <input type="file" class="form-control btn btn-primary" name="poster" onchange="loadPoster(event)">
        </div>

        <div class="form-group">
            <img id="poster" src="{{$movie->movie_poster}}" height="200" width="400">
        </div>

        <div class="form-group">
        <label>Quality :</label>
                            <select  class="form-control" name="quality">
                                <option value="HD">HD</option>
                                <option value="SD">SD</option>
                                <option value="4K">4K</option>
                                <option value="CAM">CAM</option>
                                <option value="DVD">DVD</option>
                                <option value="FHD">FHD</option>
                                <option value="LQ">LQ</option>
                              
                            </select>

                            </select>
                        </div>
                        <div class="form-group">
                            <label>Rating :</label>
                            <input type="text" value="{{$movie->rating}}" name="rating" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Release Date :</label>
                            <input type="date" value="{{$movie->release_date}}" name="date" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Running Time :</label>
                            <input type="text" value="{{$movie->runtime}}" name="runtime" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Genres :</label>
                            <select  class="drop-down related-post form-control" name="genres[]" multiple>
                            @foreach($genres as $genre)
                            <option value="{{ $genre->name }}"> {{ $genre->name }}</option>
                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Countries :</label>
                            <select  class="drop-down related-post form-control" name="countries[]" multiple>
                            @foreach($countries as $country)
                    <option value="{{ $country->name }}"> {{ $country->name }}</option>
                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Actors :</label>
                            <select  class="drop-down related-post form-control" name="actors[]" multiple>
                            @foreach($stars as $star)
                    <option value="{{ $star->name }}"> {{ $star->name }}</option>
                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Directors :</label>
                            <select  class="drop-down related-post form-control" name="directors[]" multiple>
                            @foreach($stars as $star)
                    <option value="{{ $star->name }}"> {{ $star->name }}</option>
                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Writers :</label>
                            <select  class="drop-down related-post form-control" name="writers[]" multiple>
                            @foreach($stars as $star)
                    <option value="{{ $star->name }}"> {{ $star->name }}</option>
                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-success store-related-post btn-sm">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.drop-down').select2();
        });

        function loadThumbnail(event){
            var reader = new FileReader();

            reader.onload = function(){

                var output = document.getElementById('thumbnail');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
            

        }

        function loadPoster(event){
            var reader = new FileReader();

            reader.onload = function(){

                var output = document.getElementById('poster');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
            

        }
    </script>

<script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'editor1' );
            </script>
</body>
</html>