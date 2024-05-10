<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add room</title>
</head>
<body>
    
    
    
    <form class="row g-3" method="POST" action="{{route('addRoom')}}">
        @csrf
            
        <label for="number">number</label>
            <input type="number"  id="number" name='number' placeholder="Enter room number"  /><br><br>
        
        <label for="floor">Floor</label>
            <input type="number" id="floor" name="floor" placeholder="Enter floor number"  /><br><br>
            
        <button type="submit" class="btn btn-primary">Add</button>
    </form>
</body>
</html>