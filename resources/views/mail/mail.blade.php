@php
use Carbon\Carbon;
$datetime = Carbon::parse($details['datetime']);
$formattedDate = $datetime->format('Y-m-d');
$formattedtime = $datetime->format('H:i');
@endphp

<!DOCTYPE html>
<html>
<head>
    <title>INTERVIEW DATE & TIME</title>
    <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Montserrat">
</head>
<body style="font-family:'Montserrat',serif">
    <h1>Congratulations {{$details['user']}} You have been Hired!!</h1>
    <p>Check your details below : <br>
        <label for="">
            Technology : {{$details['technology']}} <br>
            Date  : {{$formattedDate}} <br>
            Time  : {{$formattedtime}} <br>
            Interviewer : {{$details['interviewer']}} <br>
            Staus : <label style="color:green" for="">{{$details['status']}} </label> <br>
            Address : Thapathali <br>
        </label>
        <label for="">
            Further details will be disscussed at office.
        </label>
    </p>
    
   
    <p>Thank you</p>
</body>
</html>