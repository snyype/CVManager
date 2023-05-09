<!DOCTYPE html>
<html>
<head>
    <title>INTERVIEW DATE & </title>
</head>
<body>
    <h1>Congratulations {{$details['user']}} You have been Hired!!</h1>
    <p>Check your details below : <br>
        <label for="">
            Technology : {{$details['technology']}} <br>
            Date & Time : {{$details['datetime']}} <br>
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