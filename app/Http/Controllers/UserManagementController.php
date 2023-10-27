<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; 
use App\Models\Expense; 
use App\Models\Department; 

class UserManagementController extends Controller
{

    /**
 * Handle user management based on user's role and display appropriate user lists.
 */
    function userManagement(Request $request){
    // Get the currently logged-in user's ID and position
        $user = Auth::user();
        $userId = $user->id;
        $position = $user->position;

    // Check if the user is a system manager
        if ($position == "system_manager") {
        // Retrieve managers, staff, and HODs for system managers
            $managers = User::where('position','manager')->get(); 
            $staffs = User::where('position', 'staff')->get();
            $hods = User::where('position', 'hod')->get();

            return view('users', ['staffs' => $staffs,'managers'=>$managers,'hods'=>$hods]);
        }

    // Check if the user is an HOD
        if ($position == "hod") {
        // Get the HOD's ID and department
            $hodId = $userId;
            $department = $user->department;

        // Retrieve staff and managers for HODs
            $staff = User::where('department', $department)
            ->where('position','staff')
            ->get();

            $managers = User::where('position', 'manager')
            ->where('hod_id',$hodId)
            ->get();

            return view('users', ['staff' => $staff,'managers'=>$managers]);
        }
    }

    


/**
 * Promote a user to the Head of Department (HOD) role.
 *
 */
function promoteHOD(Request $request){
    // Find the user to be promoted to HOD by their ID
    $user = User::find($request->id);

    if ($user) {
        // Get the department of the user to be promoted
        $department = $user->department;

        // Count the number of HODs in the same department
        $count = User::where('position', 'hod')
        ->where('department', $department)
        ->count();

        // Check if the department can have only one HOD
        if ($count <= 0) {
            // Promote the user to the HOD position and update related managers
            $user->position = 'hod';
            $user->manager_id = null;
            $user->hod_id = null;
            $user->save();

            // Update the HOD ID for managers in the same department
            User::where('department', $department)
            ->where('position', 'manager')
            ->update(['hod_id' => $request->id]);
        } else {
            return redirect('/user-management')->with('exists', 'Department can have one hod only');
        }
    } else {
        abort(404);
    }

    return redirect('/user-management')->with('success', 'Promoted Successfully');
}





    //To Demote the HOD to manager
public function showDemoteForm(Request $request){
    // Find the user to be demoted from HOD to manager by their ID
    $user = User::find($request->id);

    if ($user) {
        // Get the department of the user to be demoted
        $department = $user->department;

        // Retrieve a list of managers in the same department
        $managers = User::where('department', $department)
        ->where('position', 'manager')
        ->get();
    } else {
        // If the user is not found, return a 404 error
        abort(404);
    }

    // Return the view for assigning a new manager
    return view("assign-hod", ['users' => $user, 'managers' => $managers]);
}



    //To Demote the HOD to manager
public function demoteHOD(Request $request){
    // Get the new manager's ID and the ID of the user to be demoted
    $manager_id = $request->manager_id;
    $id = $request->id;
    $position = "staff";

    // Update the user's information to demote them to a manager
    User::where('id', $id)
    ->update([
        'manager_id' => $manager_id,
        'position' => 'staff',
    ]);

    // Redirect back to the user management page with a success message
    return redirect('/user-management')->with('success', 'Demoted Successfully');
}






    //To Promote the user to manager
public function promote(Request $request){
    $user = User::find($request->id);
    $hodId = Auth::user()->id;

    if ($user) {
        $user->position= 'manager';
        $user->manager_id=NULL;
        $user->hod_id=$hodId;
        $user->save();

    } else {
        abort(404);

    }

    return redirect('/user-management')->with('success', 'Promoted Successfully');

}


    //To demote the manager to staff
public function demote(Request $request){

    $id = $request->input('id');
    $manager_id = $request->input('manager_id');

    $user = User::find($id);        

    if ($user) {
        $user->position= 'staff';
        $user->manager_id=$manager_id;
        $user->hod_id=NULL;
        $user->save();

    } else {
        abort(404);

    }
    return redirect('/user-management')->with('successess', 'Demoted Successfully');
}


    //To Promote the user to Manager
public function promoteManager(Request $request){
    // Find the user to be promoted to Manager by their ID
    $user = User::find($request->id);

    if ($user) {
        // Get the department of the user to be promoted
        $department = $user->department;

        // Update the user's information to promote them to the Manager role
        $user->position = 'manager';
        $user->manager_id = null;
        $user->hod_id = Auth::user()->id;
        $user->save();            
    } else {
        // If the user is not found, return a 404 error
        abort(404);
    }

    // Redirect back to the user management page with a success message
    return redirect('/user-management')->with('success', 'Promoted Successfully');
}




/**
 * Display the form for assigning a manager to a staff member.
 */
public function showAssignForm(Request $request){
    // Find the user for whom a manager is to be assigned by their ID
    $user = User::find($request->id);

    if ($user) {
        // Get the department of the user for whom a manager is to be assigned
        $department = $user->department;

        // Retrieve a list of managers in the same department
        $managers = User::where('department', $department)
        ->where('position', 'manager')
        ->get();
    } else {
        // If the user is not found, return a 404 error
        abort(404);
    }

    // Return the view for assigning a manager to the staff member
    return view("assign-manager", ['users' => $user, 'managers' => $managers]);
}




/**
 * Assign a manager to a staff member.
 */
public function assignManager(Request $request){
    // Get the manager's ID, HOD ID, and the ID of the staff member to be assigned
    $manager_id = $request->manager_id;
    $hodId = User::find($manager_id)->hod_id;
    $id = $request->id;
    $position = "staff";

    // Update the staff member's information to assign them to the manager
    User::where('id', $id)
    ->update([
        'manager_id' => $manager_id,
        'hod_id' => $hodId,
        'position' => 'staff',
    ]);

    // Redirect back to the user management page with a success message
    return redirect('/user-management')->with('success', 'Manager Assigned Successfully');
}





}
