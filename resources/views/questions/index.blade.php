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
            All Topics</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                    <th>  S/N </th>
                        <th>  Subject </th>
                        <th> Topic </th>
                        <th> Question </th>
                        <th> Image </th>
                        <th> OptionA </th>
                        <th> OptionB </th>
                        <th> OptionC </th>
                        <th> OptionD </th>
                        <th> Answer </th>
                        <th> Explanation </th>
                        <th> Year </th>
                        <th> Actions </th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                   <th> S/N </th>
                        <th>  Subject </th>
                        <th> Topic </th>
                        <th> Question </th>
                        <th> Image </th>
                        <th> OptionA </th>
                        <th> OptionB </th>
                        <th> OptionC </th>
                        <th> OptionD </th>
                        <th> Answer </th>
                        <th> Explanation </th>
                        <th> Year </th>
                        <th> Actions </th>
                    </tr>
                    </tfoot>
                    <tbody>
                   

                    @foreach($questions as $question)

                        <tr>
                            <td> {{$i++}} </td>
                            <td> {{ !empty($question->subject) ? $question->subject->subject:''}} </td>
                            <td> {{ !empty($question->topic) ? $question->topic->topic:''}} </td>

                            <td> {{ $question->question}} </td>
                            <td> <img src="{{ $question->image }}" width="100" height="100" /> </td>
                            

                            <td> {{ $question->option_a}} </td>
                            <td> {{ $question->option_b}} </td>

                            <td> {{ $question->option_c}} </td>

                            <td> {{ $question->option_d}} </td>
                            <td> {{ $question->answer}} </td>
                            <td> {{ $question->explanation}} </td>
                            <td> {{ $question->year}} </td>


                            
                            <td>
                                <a href="{{ URL::to('edit-question') }}/{{ $question->id }}" class="btn btn-outline-primary btn-sm"> Edit </a>
                                |
                                <a href="{{ URL::to('delete-question') }}/{{ $question->id }}" class="btn btn-outline-danger btn-sm" onclick="checkDelete()"> Delete </a>
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

