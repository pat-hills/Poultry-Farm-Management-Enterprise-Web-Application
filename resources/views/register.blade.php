<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>


<form action="{{route('create-user')}}" method="POST">
    <input type="text" name="fullname">
   <input type="email" name="email">
   <input type="password" name="password">

        {{csrf_field()}}

  <button type="submit"> submit</button>
</form>


</body>
</html>