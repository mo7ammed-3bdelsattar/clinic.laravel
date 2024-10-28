<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Created</title>
</head>
<body>
    <h1 class="text-center">Hi {{$data['patientName']}}, Your Booking with doctor{{$data['doctorName']}} has been created</h1>
    <p>Your booking is number {{$data['bookingNumber']}}</p>
    <p>We'll wait you at {{$data['date']}} </p>
</body>
</html>