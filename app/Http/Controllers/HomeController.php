<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PatientVisits;


use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['patientLatestVisits'] = 
        PatientVisits::orderBy("id","desc")->take(10)->get();

        return view('home', $data);
    }


    public function showChangePasswordForm(){
        $data['user'] = User::findOrFail(Auth::id());
        return view ('auth.changepassword',$data);
    }

    public function changePassword(Request $request){
        $validatedData = $request->validate([
            'current-password' => ['required'],
            'new-password' => ['required', 'string', 'confirmed', 'different:current-password', Password::min(8)->letters()->mixedCase()->numbers()->symbols()],
        ]);

        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error", "Your current password does not match with the password you provided. Please try again.");
        }

        //Change Profile
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        return redirect()->back()->with("successP","Password is updated successfully !");

    }

}
