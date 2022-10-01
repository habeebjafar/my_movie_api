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
            All Genres</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                    <th>  S/N </th>
                        <th>  Type </th>
                        <th> Icon </th>
                        <th>Actions </th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                    <th>  S/N </th>
                        <th>  Type </th>
                        <th>  Icon </th>
                        <th>Actions </th>
                    </tr>
                    </tfoot>
                    <tbody>
                   

                    @foreach($genres as $genre)

                        <tr>
                            <td> {{$i++}} </td>
                            <td> {{ $genre->name }} </td>
                            <td> <img src="{{ $genre->icon }}" width="100" height="100" /> </td>
                            <td>
                                <a href="{{ URL::to('edit-genre') }}/{{ $genre->id }}" class="btn btn-outline-primary btn-sm">  <i class="fas fa-edit fa-fw"></i> </a>
                                |
                                <a href="{{ URL::to('delete-genre') }}/{{ $genre->id }}" class="btn btn-outline-danger btn-sm" onclick="checkDelete()">  <i class="fas fa-recycle fa-fw"></i> </a>
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

        function increment(x){
            x++ 

        }
    </script>



@stop

