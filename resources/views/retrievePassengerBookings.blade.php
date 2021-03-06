<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <style>
        table, th, td {
            border: 1px solid black;
            padding: 10px;
        }
    </style>
</head>
<body>
<button><a href="/">Retrieve User's all Bookings</a></button>
<button><a href="/passengersOnParticularDay">Passengers On Particular Day</a></button>
<button><a href="/trainInfoAccToAgeRange">Train Info According to Age Range</a></button>
<button><a href="/passengersCountForTrain">Passengers Count for a Train</a></button>
<button><a href="/trainNamePassengers">Get Info by Train Name</a></button>
<button><a href="/deletePassengerView">Cancel Booking for a Passenger</a></button>
<center>
  <div>
  <h1>Retrieve User's Bookings</h1>
  <form action="{{'/'}}" method="get">
      <div>
          <label for="firstname">FirstName</label>
          <input type="text" name="firstname" id="firstname">
      </div>
      <br>
      <div>
          <label for="lastname">LastName</label>
          <input type="text" name="lastname" id="lastname">
      </div>
      <br>
      <div>
          <input type="submit" value="Retrieve All Bookings">
      </div>
  </form>
  </div>
  <br>
  <br>
  <br>
  <h1>Train Information</h1>

@if(count($passengers) === 0)
    <span>No Records Found</span>
@else
    <span>Total records found are: {{count($passengers)}}</span>
    <table>
        <tr>
            <th>Train number</th>
            <th>Name</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Status</th>
            <th>Category</th>
        </tr>

        @foreach ($passengers as $passenger)
            <tr>
                <td>{{$passenger['train_number']}}</td>
                <td>{{$passenger['name']}}</td>
                <td>{{$passenger['first_name']}}</td>
                <td>{{$passenger['last_name']}}</td>
                <td>{{$passenger['status']}}</td>
                <td>{{$passenger['category']}}</td>
            </tr>
        @endforeach
    </table>
@endif
</center>
</body>
</html>
