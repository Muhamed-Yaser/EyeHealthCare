<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>create doctor</title>
</head>
<body>
    
    
    
    <form class="row g-3" method="POST" action="{{route('createDoctor')}}">
        @csrf
            
        <label for="name">Name</label>
            <input  id="name" name='name' placeholder="Enter Name"  /><br><br>
        
        <label for="pass">Password</label>
            <input type="password" id="pass" name="password" placeholder="Enter Password"  /><br><br>
            
        <label for="national_id">National_id</label>
        <input  id="national_id" name='national_id' placeholder="Enter National_id"  /><br><br>
        
        <label for="phone">Phone</label>
            <input type="phone" id="phone" name="phone" placeholder="Enter Phone"  /><br><br>
        
        <label for="specialty">Specialty</label>
        <input  id="specialty" name='specialty' placeholder="Enter Specialty"  /><br><br>
        
        <label for="presence_days">Presence_days</label>
            <input type="presence_days" id="presence_days" name="presence_days" placeholder="Enter Presence_days"  /><br><br>
            
        <label for="hospital_id">Hospital_id</label>
        <input type="hospital_id" id="hospital_id" name="hospital_id" placeholder="Enter Hospital_id"  /><br><br>
            
        <button type="submit" class="btn btn-primary">Sign in</button>
    </form>
</body>
</html>