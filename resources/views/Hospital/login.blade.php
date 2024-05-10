<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HospitalLogin</title>
</head>
<body>
    
    
    
    <form class="row g-3" method="POST" action="{{route('hospital.login')}}">
        @csrf
            
        <label for="name">Name</label>
            <input  id="name" name='name' placeholder="Enter Name"  /><br><br>
            @error('name')
            <small>{{$message}}</small><br>
            @enderror
        <label for="pass">Password</label>
            <input type="password" id="pass" name="password" placeholder="Enter Password"  /><br><br>
            @error('password')
            <small>{{$message}}</small><br>
            @enderror
        
        <button type="submit" class="btn btn-primary">Sign in</button>
    </form>
</body>
</html>