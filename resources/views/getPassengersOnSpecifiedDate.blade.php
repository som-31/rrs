<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<style>
    table, th, td {
  border: 1px solid black;
        padding: 10px;
    }

</style>
<body>
<button><a href="/">Retrieve User's all Bookings</a></button>
<button><a href="/passengersOnParticularDay">Passengers On Particular Day</a></button>
<button><a href="/trainInfoAccToAgeRange">Train Info According to Age Range</a></button>
<button><a href="/passengersCountForTrain">Passengers Count for a Train</a></button>
<button><a href="/trainNamePassengers">Get Info by Train Name</a></button>
<button><a href="/deletePassengerView">Cancel Booking for a Passenger</a></button>
<center>
    <h1>Passenger's Bookings for a particular Day</h1>
    <form action="passengersOnParticularDay" method="get">
        <div>
        <label for="date">Enter Date</label>
        <input type="date" name="date" id="date">
        </div>
        <br>
        <input type="submit" value="Retrieve all confirmed tickets">
    </form>
    <br>
    <br>
    <br>
    <h1>Passenger Information</h1>
@if (count($passengers) === 0)
    <span>No records Found</span>
@else
        <span>Total records found are: {{count($passengers)}}</span>
    <table>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Travel Date</th>
            <th>Day</th>
            <th>Status</th>
        </tr>
        @foreach ($passengers as $passenger)
            <tr>
                <td>{{$passenger['first_name']}}</td>
                <td>{{$passenger['last_name']}}</td>
                <td>{{$passenger['travel_date']}}</td>
                <td>{{$passenger['day']}}</td>
                <td>{{$passenger['status']}}</td>
            </tr>
        @endforeach
    </table>
@endif
</center>
</body>
</html>


{{--('Josephine','Darakjy',	26,	'4 B Blue Ridge Blvd','Josephine.Darakjy@gmail.com'),--}}
{{--('Art',	'Venere',26,'8 W Cerritos Ave #54','art.Venere@gmail.com'),--}}
{{--('Lenna','Paprocki',26,'639 Main St','Lenna@gmail.com')--}}
