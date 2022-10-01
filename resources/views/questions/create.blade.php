@extends('layout')

@section('dashboard-content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<h1>  Create Questions form</h1>

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


<form action = "{{URL::to('post-question-form')}}" method = "post" enctype="multipart/form-data">
    @csrf

    <div class="form-group">


                          <label>Subject :</label>
                            <select  class="drop-down related-post form-control sel_subject" name="subjectName" id="sel_subject">
                            <option value='0'>-- Select Subject --</option>
                            @foreach($subjects['data'] as $subject)
                    <option value="{{ $subject->id }}"> {{ $subject->subject }}</option>
                @endforeach

                            </select>
                        </div>


                        <div class="form-group">
                            <label>Topic :</label>
                            <select  class="drop-down related-post form-control sel_topic" name="topicName" id="sel_topic">
                            <option value='0'>-- Select Topic --</option>

                            </select>
                        </div>

   
   
   
   

 
 
 
 
  
   <!-- <div class="form-group">
                            <label>Subject :</label>
                            <select  class="drop-down related-post form-control sel_subject" name="subjectName">
                            <option value='0'>-- Select Subject --</option>
                            @foreach($subjects['data'] as $subject)
                    <option value="{{ $subject->id }}"> {{ $subject->subject }}</option>
                @endforeach

                            </select>
                        </div>


                        <div class="form-group">
                            <label>Year :</label>
                            <select  class="drop-down related-post form-control sel_topic" name="topicName">
                            <option>-- Select Year --</option>
                            <option value='2023'> 2023 </option>
                            <option value='2022'> 2022 </option>
                            <option value='2021'> 2021 </option>
                            <option value='2020'> 2020 </option>
                            <option value='2019'> 2019 </option>
                            <option value='2018'> 2018 </option>
                            <option value='2017'> 2017 </option>
                            <option value='2016'> 2016 </option>
                            <option value='2015'> 2015 </option>
                            <option value='2014'> 2014 </option>
                            <option value='2013'> 2013 </option>
                            <option value='2012'> 2012 </option>
                            <option value='2011'> 2011 </option>
                            <option value='2010'> 2010 </option>

                            </select>
                        </div> -->
 
 
  <div class="form-group">
            <label for="exampleInputEmail1"> Question : </label>
            <textarea name="question" id="editor1">  </textarea>
        </div>

  

  <div class="form-group">
    <label for="exampleInputEmail1">Image(optional) :</label>
    <input type="file" class="form-control"  placeholder="Insert subject icon" name="questionImage" onchange="loadPhoto(event)">
  </div>

  <div>

  <img id="photo" width="100" height="100"/>
  
  </div>
  <br>

  <div class="form-group">
    <label for="exampleInputEmail1">OptionA</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter OptionA" name="optionA">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">OptionB</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter OptionB" name="optionB">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">OptionC</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter OptionC" name="optionC">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">OptionD</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter OptionD" name="optionD">
  </div>

  
  <div class="form-group">
    <label for="exampleInputEmail1">Correct Answer</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Correct Answer" name="answer">
  </div>


  <div class="form-group">
            <label for="exampleInputEmail1"> Explanation(optional) : </label>
            <textarea name="explanation" id="editor2">  </textarea>
        </div>

    <div class="form-group">
    <label for="exampleInputEmail1">Year(optional) : </label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Topic name" name="year">
  </div>    

  

  <button type="submit" class="btn btn-primary">Submit</button>
</form>  

<!-- Script -->
        <script type='text/javascript'>

$(document).ready(function(){

  // Department Change
  $('#sel_subject').change(function(){

     // Department id
     var id = $(this).val();

     // Empty the dropdown
     $('#sel_topic').find('option').not(':first').remove();

     // AJAX request 
     $.ajax({
       url: 'getTopics/'+id,
       type: 'get',
       dataType: 'json',
       success: function(response){

         var len = 0;
         if(response['data'] != null){
           len = response['data'].length;
         }

         if(len > 0){
           // Read data and create <option >
           for(var i=0; i<len; i++){

             var id = response['data'][i].id;
             var topic = response['data'][i].topic;

             var option = "<option value='"+id+"'>"+topic+"</option>"; 

             $("#sel_topic").append(option); 
           }
         }

       }
    });
  });

});

</script>



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