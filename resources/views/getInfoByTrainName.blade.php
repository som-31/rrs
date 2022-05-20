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
    <h1>Retrieve Train Bookings</h1>
    <form action="trainNamePassengers" method="get">
        <div>
            <label for="trainName">Train Name</label>
            <input type="text" name="trainName" id="Enter Train Name">
        </div>
        <br>
        <div>
            <input type="submit" value="Retrieve Confirmed Tickets">
        </div>
    </form>
    <br>
    <br>
    <br>
    <h1>Passengers travelling on particular Train</h1>
@if(count($result) === 0)
    <span>No records found!</span>
@else
        <span>Total records found are: {{count($result)}}</span>
    <table>
        <tr>
            <th>Passenger Name</th>
            <th>Age</th>
            <th>Address</th>
            <th>Train Name</th>
            <th>Status</th>
        </tr>
        @foreach($result as $record)
            <tr>
                <td>{{$record['first_name'].' '.$record['last_name']}}</td>
                <td>{{$record['age']}}</td>
                <td>{{$record['address']}}</td>
                <td>{{$record['name']}}</td>
                <td>{{$record['status']}}</td>
            </tr>
        @endforeach
    </table>
@endif
</center>
</body>
</html>
