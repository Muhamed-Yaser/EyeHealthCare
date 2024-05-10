<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DoctorLogin</title>
</head>
<body>
    
    
    
    <form class="row g-3" method="POST" action="{{route('doctor.login')}}">
        @csrf
            
        <label for="national_id">National id</label>
            <input  id="national_id" name='national_id' placeholder="Enter national_id"  /><br><br>
            @error('national_id')
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