<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\DoctorLogin;
use App\Http\Requests\DoctorWeb;
use App\Models\PatientHistory;
use App\Models\Prescription;
use App\Models\Reservation;
use App\Models\Room;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class doctorController extends Controller
{
    use GeneralTrait;

    // Login
    public function store(DoctorLogin $request)
    {
        $doctor =  $request->authenticate();
        return response()->json($doctor);
    }

    public function WebLogin(DoctorWeb $request){
        
        $data = $request->authenticate();

        $request->session()->regenerate();

        return response()->json($data);
    }

    // make prescription and update room to be available
    public function makePrescription(Request $request){
        try{
        $date = date('Y-m-d');
        $checkPrescription = Prescription::where('doctor_id',Auth::id())->where('user_id',$request->user_id)->where('created_at','LIKE',"%".$date."%")->first();
        if($checkPrescription){
                return $this->returnError(400,'you have already send');
        }else{
        if($request->image){
            $image =$this->SaveImages('images/prescriptions',$request->image);
        }
        else{
            $image = 'Null';
        }
        
        
        $id = Auth::id();
        $prescription = Prescription::create([
        'doctor_id' => $id,
        'image' => $image,
        'medicine' => $request->medicine,
        'problem' => $request->problem,
        'user_id' => $request->user_id
        ]);
        $reserve = Reservation::where('doctor_id',Auth::id())->where('status' , 'accepted')->first();
        $room = Room::find($reserve->room_id);
        $reserve->update([
            'status' => 'done'
        ]);
        $room->update([
            'status' => 1
        ]);
        return $this->returnData('prescription',$prescription,'prescription has recorded');
    }}catch(Exception $ex){
        return $this->returnError(400,'Something went wrong');
        }
    }

    // Get reservations of patients that are accepted by hospital and get patient-history of patients 
    public function getReservations(){
        try{
            $reservations = Reservation::with(relations:['user','room'])->where("doctor_id" , Auth::id())->where('status','done')->orWhere('status' , 'accepted')->orderBy('id' , 'desc')->get();
            foreach($reservations as $reservation){
                $patient_history = PatientHistory::where('user_id' , $reservation->user->id)->first();
                $reservation -> user->patient_history = $patient_history;
            }
                return $this->returnData("Reservations",$reservations);
            }catch(Exception $ex){
                return $this->returnError(400,'Something went wrong');
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
        Auth::guard('doctor')->logout();
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
