<!DOCTYPE html>
<html>
   <head>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   </head>
   <body>

     <!-- Department Dropdown -->
     Subject : <select id='sel_subject' name='sel_subject'>
       <option value='0'>-- Select subject --</option>
 
       <!-- Read Departments -->
       @foreach($subjects['data'] as $subject)
         <option value="{{ $subject->id }}">{{ $subject->subject }}</option>
       @endforeach

    </select>

    <br><br>
    <!-- Department Employees Dropdown -->
    Topic : <select id='sel_topic' name='sel_topic'>
       <option value='0'>-- Select Topic --</option>
    </select>

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
  </body>
</html>