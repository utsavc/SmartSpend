<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Rules\CustomPasswordRule;
use App\Models\User;  
use App\Models\Expense;  

class AuthController extends Controller
{

    //This to register user
    public function register(Request $request){
        //This retrieves count of registered user
        $userCount = User::count();

        //if the count is zero then the system_manager would be registerd first
        if ($userCount == 0) {
            $validatedData = $request->validate([
                'name' => ['required', 'string', 'max:20', 'regex:/^[A-Za-z\s]+$/'],
                'email' => 'required|string|email|unique:users|max:255',
                'password' => ['required', 'string', 'min:6', 'confirmed', new CustomPasswordRule],
            ],
            [
                'name.regex' => 'The name field must contain only characters (letters) and spaces.',
            ]);

        // Set department and position directly in the create method
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => bcrypt($validatedData['password']),
                'department' => 'system_manager',
                'position' => 'system_manager',
            ]);
        } else {
        // For non-system_manager users, use the validated data
            $validatedData = $request->validate([
                'name' => ['required', 'string', 'max:20', 'regex:/^[A-Za-z\s]+$/'],
                'email' => 'required|string|email|unique:users|max:255',
                'password' => ['required', 'string', 'min:6', 'confirmed', new CustomPasswordRule],
                'department' => 'required|string|max:255',
            ],
            [
                'name.regex' => 'The name field must contain only characters (letters) and spaces.',
            ]);

            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => bcrypt($validatedData['password']),
                'department' => $validatedData['department'],
            ]);
        }
        return redirect()->route('registration')->with('success', 'Registration successful!');
    }




        //To login the user
    public function authenticate(Request $request){
        $credentials = $request->only('email', 'password');
        $user=User::where('email',$request->email)->get();

        $position= $user[0]->position;
        $manager_id= $user[0]->manager_id;
        $hod_id= $user[0]->hod_id;

        if ($position==="staff" && ($manager_id==NULL||$hod_id==NULL)) {
            return redirect()->route('login')->with('info', 'Please wait a manager or HOD to be assigned');
        }

        if (Auth::attempt($credentials)) {
         $position = Auth::user()->position; 
         return redirect('/dashboard');
     }

        //Authentication failed
     return redirect()->route('login')->with('error', 'Invalid email or password.');
 }




     //This shows the dashboard
 function showDashboard(){

        $user = Auth::user(); // Retrieve the authenticated user
        $userId = $user->id;
        $userRole=$user->position;

        //sshows the data to staff
        if ($userRole=="staff") {

            $pendings = Expense::where('staff_id', $userId)
            ->where('status', 'pending')
            ->get()->count();

            $accepted = Expense::where('staff_id', $userId)
            ->where('status', 'accepted')
            ->get()->count();

            $approveds = Expense::where('staff_id', $userId)
            ->where('status', 'approved')
            ->get()->count();
            
            return view('dashboard', ['pendings'=>$pendings,'approveds'=>$approveds,'accepted'=>$accepted]);
        }

        //shows the data to hod
        if ($userRole=="hod") {

            // Get the currently logged-in user
            $user = Auth::user();

            //gets the count of all staff and manager associated to the current hod
            $expenses = Expense::whereIn('staff_id', function ($query) use ($user) {
                $query->select('id')
                ->from('users')
                ->where('hod_id', $user->id) 
                ->whereIn('position', ['staff', 'manager']); 
            })
            ->where('status', 'accepted')
            ->get()->count();

            //gets the manager count of department
            $managerCount = User::where('department', $user->department)
            ->where('position','manager') 
            ->count();

            //gets the staff count of department
            $staffCount = User::where('department', $user->department)
            ->where('position','staff') 
            ->count();

            return view('dashboard', ['expenses'=>$expenses,'managerCount'=>$managerCount,'staffCount'=>$staffCount]);
        }


        //shows the data to system manager
        if ($userRole=="system_manager") {

            //number of staff
         $staffCount = User::where('position', 'staff')
         ->count();

            //number of managers
         $managerCount = User::where('position', 'manager')
         ->count();

            //number of HOD
         $hodCount = User::where('position', 'hod')
         ->count();


            //number of approved
         $approved = Expense::where('status', 'approved')
         ->count();

            //number of pending
         $pending = Expense::where('status', 'pending')
         ->orWhere('status', 'accepted')
         ->count();

           //total submitted
         $totalCount = Expense::where('status', '!=', 'drafted')->count();



            //expense summary {approved, submitted, drafted}

         return view('dashboard',['staffCount'=>$staffCount,'managerCount'=>$managerCount,'hodCount'=>$hodCount,'approved'=>$approved,'pending'=>$pending, 'totalCount'=>$totalCount]);

     }



        //shows the data to manager
     if ($userRole=="manager") {


        //gets the count of all pending expenses associated with current manager
        $pendings = Expense::whereIn('staff_id', function ($query) use ($user) {
            $query->select('id')
            ->from('users')
            ->where('manager_id', $user->id) 
            ->orWhere('id', $user->id); 
        })
        ->whereIn('status', ['pending'])
        ->get()->count();



        //gets the count of all managers_pending expenses associated with current manager
        $manager_pendings = Expense::whereIn('staff_id', function ($query) use ($user) {
            $query->select('id')
            ->from('users')
            ->where('manager_id', $user->id) 
            ->orWhere('id', $user->id); 
        })
        ->whereIn('status', ['accepted'])
        ->get()->count();


        //gets the count of all approved expenses associated with current manager
        $approveds = Expense::whereIn('staff_id', function ($query) use ($user) {
            $query->select('id')
            ->from('users')
            ->where('manager_id', $user->id) 
            ->orWhere('id', $user->id); 
        })
        ->whereIn('status', ['approved'])
        ->get()->count();

        return view('dashboard', ['pendings'=>$pendings,'approveds'=>$approveds,'manager_pendings'=>$manager_pendings]);
    }
}


//logs out of the system
function logOut(){
    Auth::logout();
    return redirect('/');
}


//shows the profile 
function profile(Request $request){
    $userId=$request->id;
    $user = User::find($userId);
    return view('profile',['user'=>$user]);
}

//shows the password change Form
public function showChangePasswordForm(){
    return view('change-password');
}


//processes the password change
public function changePassword(Request $request)
{
    $request->validate([
        'old_password' => 'required|string',
        'password' => ['required', 'string', 'min:6', 'confirmed', new CustomPasswordRule],
    ]);

    $user = Auth::user();

    if (!password_verify($request->old_password, $user->password)) {
        throw ValidationException::withMessages([
            'old_password' => ['The provided old password is incorrect.'],
        ]);
    }

    $user->update([
        'password' => bcrypt($request->password), // Hash the new password with bcrypt
    ]);

    return redirect()->route('change-password')->with('success', 'Password changed successfully.');
}



}
