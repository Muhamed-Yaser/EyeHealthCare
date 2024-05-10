<?php

namespace App\Http\Controllers;

use App\Models\Clincal;
use App\Models\Doctor;
use App\Models\Emergency_case;
use App\Models\Hospital;
use App\Models\PatientHistory;
use App\Models\Prescription;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\User;
use App\Traits\GeneralTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;

class userController extends Controller
{
    use GeneralTrait;

    // Enter Patient_history
    public function enterPatientHistory(Request $request){
        try{
            $validator = Validator::make($request->all() , [
                'phone' => ['required' , 'numeric' , 'digits_between:10,12'],
                'national_id' => ['required' , 'numeric' , 'digits:14'],
                'full_name' => ['required' , 'string']
                ],[
                'phone' => "Phone number isn't correct",
                'national_id' => "National id isn't correct"
            ]);

            if($validator->fails()){
                return $this->returnValidationError(400,$validator);
            }
        $patient_history= PatientHistory::create([
            'national_id' => $request -> national_id,
            'full_name' => $request -> full_name,
            'phone' => $request -> phone,
            'chronic_disease' => $request -> chronic_disease,
            'gentic_disease' => $request -> gentic_disease,
            'blood_type' => $request -> blood_type,
            'disease_senstivity' => $request -> disease_senstivity,
            'surgey' => $request -> surgey,
            'medicine' => $request -> medicine,
            'user_id' => Auth::id()
        ]);
        return $this->returnData("patient history",$patient_history,'Data is added');
    }catch(Exception $ex){
        return $this->returnError(400,'something went wrong.');
    }
    }

    // Update Patient_history
    public function updatePatientHistory(Request $request){
        try{
            $validator = Validator::make($request->all() , [
                'phone' => ['required' , 'numeric', 'digits_between:10,12'],
                'national_id' => ['required' , 'numeric' , 'digits:14'],
                'full_name' => ['required' , 'string']
                ],[
                'national_id' => "National id isn't correct"
            ]);

            if($validator->fails()){
                return $this->returnValidationError(400,$validator);
            }
                $patient_history = PatientHistory::where('user_id' , Auth::id())-> first();
                $patient_history ->update($request->all());
                return $this->returnData("Patient_history",$patient_history,"Data is updated Successfully.");
            }catch(Exception $ex){
            return $this->returnError(400,"something went error, return enter data.");
        }
    }

    public function requestReservation(Request $request){
        try{
            $validation = Validator::make($request->all(),[
                'date' => ['required' ,'after_or_equal:' . date('Y-m-d')],
                'clincal' => ['required' , 'string']
            ]);
            if($validation->fails()){
                return $this->returnValidationError(400 , $validation);
            }
            $user = Reservation::where('user_id' , Auth::id())->where('status','In progress')->orWhere('status','accepted')->first(); 
            $clincal = Clincal::where('hospital_id' , $request->hospital_id)->where('name',$request->clincal)->first();
            // check if user has reservation already in progress or accepted
            if($user){
                return $this->returnError(400,'you have a reservation that is available');
            }

            // request reservation 
            else{
            $id = Auth::id();
            $reservation = Reservation::create([
            'user_id' => $id,
            'date' => $request -> date,
            'clincal_id' =>$clincal->id,
            'hospital_id' => $request->hospital_id,
        ]);
        $reservaionOfDay = Reservation::where('hospital_id' , $request->hospital_id)->where('status' ,'!=' ,'canceled')->where('date',$request->date)->whereHas(relation:'clincal')->get();
        $Day_id = count($reservaionOfDay);
        
        $reservationOfClincal = [];
        foreach($reservaionOfDay as $reserve){
            if($reserve->clincal && $reserve->clincal->name == $request->clincal){
                array_push($reservationOfClincal , $reserve);
            }
        }
        $Day_Clincal_id=count($reservationOfClincal);

        $reservation->NORIH = $Day_id;
        $reservation->NORIC = $Day_Clincal_id;
        
        return $this->returnData('reservation',$reservation,"reservation is done successfully");
    }}
        catch(Exception $ex){
            return $this->returnError(400,"something went wrong with data entered" );
        }
    }

    // for App without validate date -- use tpe string for date
    public function requestReservationForApp(Request $request){
        try{
            
            
            $validation = Validator::make($request->all(),[
                'clincal' => ['required' , 'string'],
                'date' => ['required' , 'string']
            ]);
            if($validation->fails()){
                return $this->returnValidationError(400 , $validation);
            }
            $user = Reservation::where('user_id' , Auth::id())->where('status','In progress')->orWhere('status','accepted')->first(); 
            $clincal = Clincal::where('hospital_id' , $request->hospital_id)->where('name',$request->clincal)->first();
            // check if user has reservation already in progress or accepted
            if($user){
                return $this->returnError(400,'you have a reservation that is available');
            }

            // request reservation 
            else{
            $id = Auth::user()?->id;
            $stringDate = $request->date;
            $date = date_create_from_format("Y-m-d", $stringDate)->format("Y-m-d");
            
            $reservation = Reservation::create([
            'user_id' => $id,
            'date' => $date,
            'clincal_id' =>$clincal->id,
            'hospital_id' => $request->hospital_id,
        ]);
        $reservaionOfDay = Reservation::where('hospital_id' , $request->hospital_id)->where('status' ,'!=' ,'canceled')->where('date',$date)->whereHas(relation:'clincal')->get();
        $Day_id = count($reservaionOfDay);
        
        $reservationOfClincal = [];
        foreach($reservaionOfDay as $reserve){
            if($reserve->clincal && $reserve->clincal->name == $request->clincal){
                array_push($reservationOfClincal , $reserve);
            }
        }
        $Day_Clincal_id=count($reservationOfClincal);

        $reservation->NORIH = $Day_id;
        $reservation->NORIC = $Day_Clincal_id;
        
        return $this->returnData('reservation',$reservation,"reservation is done successfully");
    }}
        catch(Exception $ex){
            return $this->returnError(400,"something went wrong with data entered ".$ex );
        }
    }
    
    public function reservationRoom(Request $request){
        try{
            $validation = Validator::make($request->all(),[
                'date' => ['required' ,'after_or_equal:' . date('Y-m-d')]
            ]);
            if($validation->fails()){
                return $this->returnValidationError(400 , $validation);
            }
            $user = Reservation::where('user_id' , Auth::id())->where('status','In progress')->orWhere('status','accepted')->first(); 
            $room = Room::where('number' , $request->room_number)->first();
            if($request->doctor_name == ''){
                $doctor = null;
            }
            $doctor = Doctor::where("name" , $request->doctor_name)->first();
            //$doctorReserve = Reservation::where('doctor_id' , $doctor->id)->where('status' , 'accepted')->first();
            // check if user has reservation already in progress or accepted
            if($user){
                return $this->returnError(400,'you have a reservation that is available');
            }
            //check room and doctor availablity
            else if($room->status == 0 ){
                return $this->returnError(400,'doctor or room is unavailable');
            }
            // request reservation and make room reserved
            else{
            $id = Auth::id();
            $reserveation = Reservation::create([
            'user_id' => $id,
            'doctor_id' => $doctor->id ,
            'date' => $request -> date,
            'room_id' =>$room->id,
            'hospital_id' => $request->hospital_id
        ]);
        $room->update([
            'status' => 0
        ]);
        return $this->returnSuccessMessage("reservation is sent successfully."); 
        }}
        catch(Exception $ex){
            return $this->returnError(400,"something went wrong with data entered" );
        }
    }

    // cancel the reservation and return room empty
    public function cancelReservation($id){
        
        $reservation = Reservation::where('user_id' , Auth::id())->where('status' , 'In progress')->find($id);
    
        if($reservation){
        $reservation->update([
                'status' => 'canceled' 
        ]);
        /*
        $room =Room::find($reservation->room_id);
        $room->update([
            'status' => 1
        ]);
        */
        return $this->returnSuccessMessage('reservation has canceled');
    }
    return $this->returnError(400,"Something went wrong" );
    }

    // cancel the reservation and return room empty
    public function cancelReservationForWeb($id){
        
        $reservation = Reservation::where('user_id' , Auth::id())->where('status' , 'In progress')->find($id);
    
        if($reservation){
        $reservation->update([
                'status' => 'canceled' 
        ]);
        
        $room =Room::find($reservation->room_id);
        $room->update([
            'status' => 1
        ]);
        
        return $this->returnSuccessMessage('reservation has canceled');
    }
    return $this->returnError(400,"Something went wrong" );
    }

    // send the hospitals to frontend with its availablilty of reservation and emergency_cases 
    public function hospitals(){
        $hospitals = Hospital::with(relations:['doctor' , 'clincal'])->get();
        foreach($hospitals as $hospital){
            $todaynow = date("D");
            $days = Hospital::where('emergency_days','LIKE', '%'. $todaynow . '%')->where('name' , $hospital->name)->get();
            if(count($days) > 0){
                $hospital -> emergency = "available";
            }else{
                $hospital -> emergency = "unavailable";
            }
        }
        return $this->returnData("hospitals",$hospitals);
    }

    public function hospitalsWeb(){
        $hospitals = Hospital::with(relations:['doctor' , 'room' , 'clincal'])->get();
        foreach($hospitals as $hospital){
            $rooms = $hospital-> whereHas('room' , function ($q){
                $q->where('status', 1);
            })->get();
            $todaynow = date("D");
            $days = Hospital::where('emergency_days','LIKE', '%'. $todaynow . '%')->where('name' , $hospital->name)->get();
            if( count($rooms) == 0){
                $hospital-> rooms = "full";
            }else{
            $hospital -> reservations = 'available';
            if(count($days) > 0){
                $hospital -> emergency = "available";
            }else{
                $hospital -> emergency = "unavailable";
            }
        }}
        return $this->returnData("hospitals",$hospitals);
    }

    // Get clincals of the hospital
    public function clincals(){
        $clincals = Clincal::with(relations:['hospital'])->get();
        return $this->returnData('clincals' , $clincals);
    }

    // Get patient history of the user
    public function patientHistory(){
        $patientHistory = PatientHistory::where('user_id' , Auth::id())->first();
        $preserciptions = Prescription::with('doctor')->where('user_id' , Auth::id())->get();
        if(count($preserciptions) > 0){
            foreach($preserciptions as $preserciption){
                $hospital = Hospital::where('id' , $preserciption->doctor->hospital_id)->first();
                $preserciption->doctor->hospital = $hospital;
            }
        }
        $patientHistory->prescriptions = $preserciptions ;
        return $this->returnData('Data' , $patientHistory);
    }

    // Get reservations of the patient
    public function reservations(){
        try{
            $userReservaions = Reservation::where('user_id' , Auth::id())->with(['user','clincal' ,'hospital' , 'room' , 'doctor'])
            ->where('status','!=','canceled')->where('status','!=','done') -> get();

            foreach($userReservaions as $userReserve){
                $reservations = Reservation::with(relations:['user','clincal' , 'room' , 'doctor'])->where('hospital_id' , $userReserve->hospital_id)->get();
                $reservaionsOfDay =[];
                $Day_Clincal_id = null; 
                $Day_id = null;
                foreach($reservations as $reserve){
                    if($reserve->date == $userReserve->date && $reserve->clincal){
                        array_push($reservaionsOfDay , $reserve);
                        $Day_id = count($reservaionsOfDay);
    
                        if($reserve->id == $userReserve->id){
                            $userReserve->NORIH = $Day_id;
                        }
                    }
                    
                }
                $clincalsTypes = Clincal::select('id','name')->where('hospital_id', $userReserve->hospital_id)->get();
                
                
                
                foreach($clincalsTypes as $clincal){
                    $reservationsOfClincal = [];
                    foreach($reservations as $reserve){
                        if($reserve->clincal ){
                            if($reserve->date == $userReserve->date && $reserve->clincal->name == $clincal->name){
                                array_push($reservationsOfClincal , $reserve);
                                $Day_Clincal_id = count($reservationsOfClincal);
                                if($reserve->id == $userReserve->id){
                                    $userReserve->NORIC = $Day_Clincal_id;
                                }
                            }
                        }
                    }
                }
            }
            
            
            //$reservationss = array_reverse($reservations->toArray());
            return $this->returnData("Reservations",$userReservaions);
        }catch(Exception $ex){
            return $this->returnError(400,'error'.$ex);
        }
        
    }

    // Search for hospital by name
    public function searchByName(Request $request){
        if($request->value){
            $hospitals = Hospital::where('name' , 'LIKE' , '%'. $request->value . "%")->get();
            return $this->returnData('hospitals' , $hospitals);
        }
        
    }

    // Search for hospital by address
    public function searchByAddress(Request $request){
        if($request->value){
            $cities = Hospital::where('city' , 'LIKE' , '%'. $request->value . "%")->select('city')->get();
            return $this->returnData('cities' , $cities);
        }
    }

    
    public function changePassword(Request $request){
        $user = User::find(Auth::id());

        $validator = Validator::make($request->all() ,[
            'currentPassword' => ['required' ,function ($attr, $password, $validation) use ($user) {
                if (! Hash::check($password, $user->password)) {
                    return $validation(__('The current password is incorrect.'));
                }
            } ],
            'newPassword' => ['required', 'confirmed', Rules\Password::defaults()]
        ]);

        if($validator->fails()){
            return $this->returnValidationError(400 , $validator);
        }

        if($request->currentPassword == $request->newPassword){
            return $this->returnError(400 , 'Cannot change password as this is already your password');
        }
        $user->update([
            'password' => $request->newPassword 
        ]);

        return $this->returnSuccessMessage('Password is changed Sucessfully.');
    }

    // request Emergency case
    public function createEmergencyCase(Request $request){
        try{
            $date = date('Y-m-d');
            $user_id = Auth::id();
            $user = Emergency_case::where('user_id' , $user_id)->where('created_at','LIKE',"%" . $date . "%")->first();
            if($user){
                return $this->returnError(400,"sorry cannot send as you have one in progress" ) ;
            }
            $emergency_cases = Emergency_case::create([
                'user_id' => $user_id,
                'hospital_id' => $request ->hospital_id ,
            ]);
            return $this->returnSuccessMessage("emergency_cases has sent");
        }catch(Exception $ex){
            return $this->returnError(400,"something went wrong" ) ;
        }    
    }
}
