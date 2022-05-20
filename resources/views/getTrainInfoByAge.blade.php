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
    <h1>Passenger's Bookings for specific Age Groups</h1>
    <form action="trainInfoAccToAgeRange" method="get">
        <div>
        <label for="age">Enter Minimum Age</label>
        <input type="number" name="minAge" id="">
        </div>
        <br>
        <div>
            <label for="Maxage">Enter Maximum Age</label>
            <input type="number" name="maxAge" id="">
        </div>
        <br>
        <input type="submit" value="Retrieve all booking information">
    </form>
    <br>
    <br>
    <br>
    <h1>Bookings</h1>
@if(count($result) === 0)
    <span>No records found!</span>
@else
        <span>Total records found are: {{count($result)}}</span>
    <table>
        <tr>
            <th>Train number</th>
            <th>Train Name</th>
            <th>Source</th>
            <th>Destination</th>
            <th>Passenger Name</th>
            <th>Address</th>
            <th>Age</th>
            <th>Category</th>
            <th>Status</th>
        </tr>
        @foreach($result as $record)
            <tr>
                <td>{{$record['train_number']}}</td>
                <td>{{$record['name']}}</td>
                <td>{{$record['source']}}</td>
                <td>{{$record['destination']}}</td>
                <td>{{$record['first_name'].' '.$record['last_name']}}</td>
                <td>{{$record['address']}}</td>
                <td>{{$record['age']}}</td>
                <td>{{$record['category']}}</td>
                <td>{{$record['status']}}</td>
            </tr>
        @endforeach
    </table>
@endif
</center>
</body>
</html>
