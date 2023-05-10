@php
use Carbon\Carbon;
@endphp


<!DOCTYPE html>
<html>
<head>
    <title>INTERVIEW DATE & </title>
</head>
<body>
    <h1>Hello {{$details['user']}}, You have been assigned a task!</h1>
    <p>Info : <br>
        <label for="">
            Technology : {{$details['technology']}} <br>
            
       
        </label>
        <label for="">
           Complete The Task Before The Interview.
        </label>
    </p>
    
   
    <p>Thank you</p>
</body>
</html>