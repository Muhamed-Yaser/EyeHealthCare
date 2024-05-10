<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\HospitalLogin;
use App\Http\Requests\HospitalWeb;
use App\Models\Clincal;
use App\Models\Doctor;
use App\Models\Emergency_case;
use App\Models\Hospital;
use App\Models\PatientHistory;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\GeneralTrait;
use Exception;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Validation\Rules;

class hospitalController extends Controller
{
    use GeneralTrait;

    // Login
    public function store(HospitalLogin $request)
    {
        $data = $request->authenticate();

       //$request->session()->regenerate();

        return response()->json($data);
    }

    public function WebLogin(HospitalWeb $request){
        
        $data = $request->authenticate();

        $request->session()->regenerate();

        return response()->json($data);
    }

    /*
    public function viewCreateDoctor(){
        return view('Hospital\createDoctor');
    }*/

 // create   doctor for app without login
 public function createDoctorForApp (Request $request){
    try{
        if($request->image){
            $image =$this->SaveImages('images/Doctors',$request->image);
        }
        else{
            $image = '';
        }

        $validator = Validator::make($request->all() , [
            'specialty' => ['required' , 'string']
            ]);

        if($validator->fails()){
            return $this->returnValidationError(400,$validator);
        }

        $clincal = Clincal::where('hospital_id' , Auth::id())->where('name' , $request->specialty)->first();
        if(!$clincal){
            return $this->returnError(400,'No clincal with this name');
        }
        if(is_array($request->presence_days)){
              $days =  implode(", " , $request->presence_days);
        }else{ $days = $request->presence_days;}
        
        $doctor = Doctor::create([
            "name" => $request -> name,
            'national_id' => $request -> national_id,
            'password' => bcrypt($request -> password) ,
            'phone' =>  $request -> phone,
            'specialty' => $request -> specialty,
            'presence_days' => $days,
            'hospital_id' => Auth::id(),
            'clincal_id' => $clincal->id,
            'image' => $image
        ]);
        
        return $this->returnData('doctor',$doctor,"registered is done successfully");

    }catch(Exception $ex){
        return $this->returnError(400,"Data went wrong , please return enter data successfully".$ex );
    } 
}

    // create account for doctor to login
    public function createDoctor (Request $request){
            try{
                if($request->image){
                    $image =$this->SaveImages('images/Doctors',$request->image);
                }
                else{
                    $image = '';
                }

                $validator = Validator::make($request->all() , [
                    'phone' => ['required' , 'numeric' , 'digits_between:10,12'],
                    'national_id' => ['required' , 'numeric' , 'digits:14'],
                    'password' => ['required', 'confirmed', Rules\Password::defaults()],
                    'specialty' => ['required' , 'string']
                    ],[
                    'phone' => "Phone number isn't correct",
                    'national_id' => "National id isn't correct"
                ]);

                if($validator->fails()){
                    return $this->returnValidationError(400,$validator);
                }

                $clincal = Clincal::where('hospital_id' , Auth::id())->where('name' , $request->specialty)->first();
                if(!$clincal){
                    return $this->returnError(400,'No clincal with this name');
                }
                
                if(is_array($request->presence_days)){
                    $days =  implode(", " , $request->presence_days);
                }else{ $days = $request->presence_days;}
                $doctor = Doctor::create([
                    "name" => $request -> name,
                    'national_id' => $request -> national_id,
                    'password' => bcrypt($request -> password) ,
                    'phone' =>  $request -> phone,
                    'specialty' => $request -> specialty,
                    'presence_days' => $days,
                    'hospital_id' => Auth::id(),
                    'clincal_id' => $clincal->id,
                    'image' => $image
                ]);
                
                
                return $this->returnSuccessMessage("registered is done successfully");

            }catch(Exception $ex){
                return $this->returnError(400,"Data went wrong , please return enter data successfully" );
            } 
    }

    // Create reservation manually by receptionist
    public function createReservation(Request $request){
        try{
            $clincal = Clincal::where('hospital_id' , Auth::id())->where('name',$request->clincal)->first();
            
            $validator = Validator::make($request->all() , [
                'date' => ['required' ,'after_or_equal:' . date('Y-m-d')]
            ]);

            if($validator->fails()){
                return $this->returnValidationError(400 , $validator);
            }
            
            $reservation = Reservation::create([
                'hospital_id' => Auth::id(),
                'date' => $request-> date,
                'status' => 'accepted',
                'clincal_id' => $clincal->id
            ]);

        $reservaionsOfDay = Reservation::where('hospital_id' ,Auth::id())->where('date',$request->date)->with(relations:'clincal')->get();
        $Day_id = count($reservaionsOfDay);
        
        $reservationsOfClincal = [];
        foreach($reservaionsOfDay as $reserve){
            if($reserve->clincal->name == $request->clincal){
                array_push($reservationsOfClincal , $reserve);
            }
        }
        $Day_Clincal_id=count($reservationsOfClincal);

        $reservation->NORIH = $Day_id;
        $reservation->NORIC = $Day_Clincal_id;
        return $this->returnData('reservation',$reservation,"reservation is done successfully");
        }catch(Exception $ex){
            return $this->returnError(400,"Something went wrong");
        } 
    }


    public function createReservationRoom(Request $request){
        try{
            $room = Room::where('number' , $request->room_number)->first();
            
            if($request->doctor_name){
                $doctor = Doctor::where('name',$request->doctor_name)->first();
                $doctor_id = $doctor->id;
            }else{
                $doctor_id = null;
            }
            
            if($room -> status == 0){
                return $this->returnError(400,"room is reserved and unavailable" );
            }
            $validator = Validator::make($request->all() , [
                'room_number' => ['required' , 'numeric'],
                'name' => ['required' , 'string'],
                'phone' => ['required' , 'numeric' , 'digits_between:10,12'],
                'national_id' => ['required' , 'numeric' , 'digits:14'],
                'date' => ['required' ,'after_or_equal:' . date('Y-m-d')]
            ],[
                'phone' => "Phone number isn't correct",
                'national_id' => "National id isn't correct"
            ]);
            if($validator->fails()){
                return $this->returnValidationError(400 , $validator);
            }
            
            $reservation = Reservation::create([
                'room_id' => $room->id,
                'hospital_id' => Auth::id(),
                'doctor_id' => $doctor_id,
                'date' => $request-> date,
                'time' => $request -> time,
                'status' => 'accepted',
                'name' => $request->name,
                'phone' => $request-> phone,
                'national_id' => $request->national_id
            ]);
            $room -> update([
                'status' => 0 
            ]);
            return $this->returnSuccessMessage("reservation is done successfully");
        }catch(Exception $ex){
            return $this->returnError(400,"Data went wrong , please return enter data successfully");
        } 
    }

    // get doctors who works in hospital with their reservations
    public function getDoctors(){
        $doctors = Doctor::with(relations:'clincal')->where('hospital_id',Auth::id())->orderBy('id' , 'desc')->get();
        return $this->returnData("Doctors",$doctors);
    }

    // search for doctor in hospital to get his information 
    public function search(Request $request){
        if(!$request->value == ''){
            $doctors = Doctor::with(relations:'Reservation')->where("name",'LIKE','%'.$request->value . '%')->get();
            return $this->returnData("Doctors",$doctors);
        }
        
    }
    
    // get all reservations that is sent to the hospital
    public function getReservations(){
        $date = date('Y-m-d');
        $reservaionsOfDay =[];
        $clincalsTypes = Clincal::select('id','name')->where('hospital_id', Auth::id())->get();
        
        $Day_Clincal_id = null; 
        $Day_id = null;
        $reservations = Reservation::with(relations:['user','clincal' , 'room' , 'doctor'])->where('hospital_id' , Auth::id())->get();
        foreach($reservations as $reserve){
            if($reserve->date == $date && $reserve->clincal){
                array_push($reservaionsOfDay , $reserve);
                $Day_id = count($reservaionsOfDay);
                $reserve->NORIH = $Day_id;
            }
            
        }
        foreach($clincalsTypes as $clincal){
            $reservationsOfClincal = [];
            foreach($reservations as $reserve){
                if($reserve->date == $date && $reserve->clincal->name == $clincal->name){
                    array_push($reservationsOfClincal , $reserve);
                    $Day_Clincal_id = count($reservationsOfClincal);
                    $reserve->NORIC = $Day_Clincal_id;
                }
        
            }
        }
        
        $reservationss = array_reverse($reservations->toArray());
        return $this->returnData("Reservations",$reservationss);
    }

    // get clincal reservations for app
    public function getClincalReservations(){
        $date = date('Y-m-d');
        $reservaionsOfDay =[];
        $clincalsTypes = Clincal::select('id','name')->where('hospital_id', Auth::id())->get();
        
        $Day_Clincal_id = null; 
        $Day_id = null;
        $reservations = Reservation::with(relations:['user','clincal'])->whereHas('clincal')->where('hospital_id' , Auth::id())
        ->select('id' , 'clincal_id' ,'hospital_id' , 'user_id' , 'status' , 'date' )->get();
        foreach($reservations as $reserve){
            if($reserve->date == $date && $reserve->clincal){
                array_push($reservaionsOfDay , $reserve);
                $Day_id = count($reservaionsOfDay);
                $reserve->NORIH = $Day_id;
            }
            
        }
        foreach($clincalsTypes as $clincal){
            $reservationsOfClincal = [];
            foreach($reservations as $reserve){
                if($reserve->date == $date && $reserve->clincal->name == $clincal->name){
                    array_push($reservationsOfClincal , $reserve);
                    $Day_Clincal_id = count($reservationsOfClincal);
                    $reserve->NORIC = $Day_Clincal_id;
                }
        
            }
        }
        
        $reservationss = array_reverse($reservations->toArray());
        return $this->returnData("Reservations",$reservationss);
    }

    // Get emergency cases
    public function getEmergencyCases(){
        $emergencyCases = Emergency_case::with(relations:'user')->where('hospital_id', Auth::id())->orderBy('id' , 'desc')->get();
        foreach($emergencyCases as $emergencyCase){
            $patient_history = PatientHistory::where('user_id' , $emergencyCase->user_id)->select('phone','national_id')->first();
            $emergencyCase -> userInfo = $patient_history;
        }
        return $this->returnData("Emergency_cases",$emergencyCases);
    }
    
    // Accept the reservation , it is send to doctor automatically
    public function acceptReservation($id){
        $reservation = Reservation::with(relations:['user' ,'clincal'])->where('hospital_id', Auth::id())->where('status' , 'in progress')->find($id);
        if($reservation){
        $reservation->update([
            'status' => 'accepted' 
        ]);
        return $this->returnData('reservation',$reservation);
    }
    return $this->returnError(400,"Can't be accepted" );
    }

    // Reject the reservation and return the room to be available for revesration
    public function rejectReservation($id){
        
        $reservation = Reservation::with(relations:['user' ,'clincal'])->where('hospital_id', Auth::id())->where('status' , 'In progress')->find($id);
        if($reservation ){
        $reservation->update([
            'status' => 'rejected' 
        ]);
        
        return $this->returnSuccessMessage('reservation has rejected');
    }
    return $this->returnError(400,"Can't be rejected" );
    }

    // End  the reservation and return room available
    public function finishReservation($id){
        $reservation = Reservation::with(relations:['user' ,'clincal'])->where('hospital_id', Auth::id())->where('status' , 'accepted')->find($id);

        if($reservation ){
        $reservation->update([
            'status' => 'done' 
        ]);

        $room =Room::find($reservation->room_id);
        $room->update([
            'status' => 1
        ]);
        
        return $this->returnData('reservation',$reservation);
    }
    return $this->returnError(400,"Not Found or Something went wrong" );
    }


    // Get rooms of the hospital
    public function rooms(){
        $rooms = Room::where('hospital_id' ,Auth::id() )->orderBy('number' , 'asc')->get();
        return $this->returnData('rooms' , $rooms);
    }

    // Enter new room by hospital
    public function addRoom(Request $request){
        $validator = Validator::make($request->all(),[
            'number' => ['required' , ' numeric' , 'unique:'.Room::class ],
            'floor' => ['required' , ' numeric']
        ]);
        
        if($validator->fails()){
            return $this->returnValidationError(400,$validator);
        }
        Room::create([
            'number' => $request->number,
            'floor' => $request->floor,
            'hospital_id' => Auth::id(),
        ]);
        return $this->returnSuccessMessage('Room is added.');
    }

    // Get clincals of the hospital
    public function clincals(){
        $clincals = Clincal::where('hospital_id' ,Auth::id() )->orderBy('id' , 'desc')->get();
        return $this->returnData('clincals' , $clincals);
    }

    // Enter new clincal by hospital
    public function addClincal(Request $request){
        try{
            $validator = Validator::make($request->all(),[
                'name' => ['required' , ' string'],
            ]);
            
            if($validator->fails()){
                return $this->returnValidationError(400,$validator);
            }
            $validator2 = Clincal::where('name' , $request->name)->where('hospital_id' , Auth::id())->first();
            if($validator2){
                return $this->returnValidationError(400,"There is already clincal with this name.");
            }
            Clincal::create([
                'name' => $request->name,
                'hospital_id' => Auth::id(),
            ]);
            return $this->returnSuccessMessage('Clincal is added.');
        }catch(Exception $ex){
            return $this->returnError(400,'error..');
        }
    }

    // Delete Clincal
    public function deleteClincal($id){
        try{
            $clincal = Clincal::find($id);
            if(!$clincal){
                return $this->returnError(400,"Clincal is not founded");
            }
            $clincal->delete();
            return $this->returnSuccessMessage('Clincal is deleted.');
            }catch(Exception $ex){
                return $this->returnError(400,'Error...');
            }
    }

    // Delete Room
    public function deleteRoom($id){
        try{
            $room = Room::find($id);
            if(!$room){
                return $this->returnError(400,"Room is not founded");
            }
            $room->delete();
            return $this->returnSuccessMessage('Room is deleted.');
            }catch(Exception $ex){
                return $this->returnError(400,'Error...');
            }
    }

    // Delete Doctor
    public function deleteDoctor($id){
        try{
            $doctor = Doctor::find($id);
            if(!$doctor){
                return $this->returnError(400,"Doctor is not founded");
            }
            $doctor->delete();
            return $this->returnSuccessMessage('Doctor is deleted.');
            }catch(Exception $ex){
                return $this->returnError(400,'Error...');
            }
    }

    // Logout
    public function logout(Request $request)
    {
        $token = $request->header('auth-token');
        if($token){
            try{
                JWTAuth::setToken($token)->invalidate();
            }catch(\Tymon\JWTAuth\Exceptions\TokenInvalidException $e){
                return  $this -> returnError('400','some thing went wrongs');
        }
        return $this->returnSuccessMessage('logout done successfully');
    }
        else{
            return  $this -> returnError('400','some thing went wrongs');
        }
    }

    // Web logout
    public function WebLogout(Request $request)
    {
        Auth::guard('hospital')->logout();
        $request->session()->regenerateToken();
        return redirect('/login');
    }


    protected  function SaveImages($folder,$image)
    {
        $file_extension = $image->getClientOriginalExtension();
        $file_name =time(). '.' . $file_extension;
        $image->move($folder , $file_name);
        return $file_name;
    }
}
