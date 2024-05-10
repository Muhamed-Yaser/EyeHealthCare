<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\PatientRequest as AuthPatientRequest;
use App\Http\Requests\PatientRequest;
use App\Providers\RouteServiceProvider;
use App\Traits\GeneralTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthenticatedSessionController extends Controller
{
    use GeneralTrait;
    /**
     * Display the login view.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $data = $request->authenticate();

        //$request->session()->regenerate();

        return response()->json($data);
    }

    public function webLogin(AuthPatientRequest $request)
    {
        $data = $request->authenticate();

        $request->session()->regenerate();

        return response()->json($data);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function webLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
    public function destroy(Request $request)
    {
        $token = $request->header('auth-token');
        if($token){
            try{
                JWTAuth::setToken($token)->invalidate();
                return $this->returnSuccessMessage('logout done successfully');
            }catch(\Tymon\JWTAuth\Exceptions\TokenInvalidException $e){
                return  $this -> returnError('400','some thing went wrongs');
        }

    }
        else{
            return  $this -> returnError('400','some thing went wrongs');
        }
    }
}
