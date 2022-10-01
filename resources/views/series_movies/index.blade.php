@extends('layout')
@section('dashboard-content')
{{$i = 1}}
    @if(Session::get('deleted'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert" id="gone">
            <strong> {{ Session::get('deleted') }} </strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(Session::get('delete-failed'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert" id="gone">
            <strong> {{ Session::get('delete-failed') }} </strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>
            <h2>All Series</h2></div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                    <th>  S/N </th>
                        <th>  Title </th>
                        <th> Thumbnail </th>
                        <th> Storyline </th>

                        <th> Genre </th>
                        <th> Run Time </th>
                        <th>Release Date  </th>


                        <th>Actions </th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                    <th>  S/N </th>
                        <th>  Title </th>
                        <th> Thumbnail </th>
                        <th> Storyline </th>

                        <th> Genre </th>
                        <th> Run Time </th>
                        <th>Release Date  </th>

                        <th>Actions </th>
                    </tr>
                    </tfoot>
                    <tbody>
                   

                    @foreach($series as $serie)

                        <tr>
                            <td> {{$i++}} </td>
                            <td> {{ $serie->title }} </td>
                            <td> <img src="{{ $serie->series_thumbnail }}" width="150" height="150" /> </td>
                            <td width="250"> {{ $serie->description }} </td>
                            <td> {{ $serie->genres }} </td>
                            <td> {{ $serie->runtime }} mins</td>
                            <td> {{ $serie->release_date }} </td>


                            <td>


                            
            <!-- <a class="nav-link dropdown-toggle " href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                   <span>Manage</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
            </div> -->



                                <a href="{{ URL::to('view-series-details') }}/{{ $serie->id }}" class="btn btn-outline-info btn-sm">  <i class="fas fa-th-list fa-fw"></i> </a>
                                |
                                <a href="{{ URL::to('edit-series') }}/{{ $serie->id }}" class="btn btn-outline-primary btn-sm">  <i class="fas fa-edit fa-fw"></i> </a>
                                |
                                <a href="{{ URL::to('delete-series') }}/{{ $serie->id }}" class="btn btn-outline-danger btn-sm" onclick="checkDelete()">  <i class="fas fa-trash fa-fw"></i> </a>
                            </td>

                        </tr>


                    @endforeach



                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>

    <script>
        function checkDelete() {
            var check = confirm('Are you sure you want to Delete this?');
            if(check){
                return true;
            }
            return false;
        }

    </script>



@stop

