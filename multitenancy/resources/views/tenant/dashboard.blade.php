<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3>{{auth()->user()->name}}</h3>
    <h3>{{auth()->user()->email}}</h3>
    <form method="POST" action="{{route('tenant.logout')}}">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>