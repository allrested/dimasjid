<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Hash;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        return view('auth.forgot');
    }

    public function reset(Request $request)
    {

        $input = $request->all();
        $user = User::where('email',$request->email)->first();
        
        if($user){
            $validate = Validator::make($input, [
                'password' => 'min:8|required_with:password_confirmation|same:password_confirmation',
                'password_confirmation' => 'min:8'
            ]);
            
            if($validate->fails()){
    
                return back()->withErrors($validate->errors())->withInput($input);
            }
    
            $input['password'] = Hash::make($request->password);
            $user->update($input);
            return redirect()->to('login')->with('info', 'Password anda berhasil diubah');
        }else{
            return redirect()->to('login')->with('error', 'Email tidak ditemukan');
        }
       
    }
}
