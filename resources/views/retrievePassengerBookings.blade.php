<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
  <h1>Retrieve User's all Bookings</h1>
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
</body>
</html>
