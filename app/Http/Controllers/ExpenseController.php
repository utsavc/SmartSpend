<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\User; 
use App\Models\Expense; 

class ExpenseController extends Controller{

 function showExpenseForm(){
    return view('expense');
}

/**
 * Store expense data submitted via a form.
 */
function storeExpenseData(Request $request)
{
    // Get the currently logged-in user's information
    $user = Auth::user();
    $userId = $user->id;
    $userRole = $user->position;

    // Validate the incoming request data
    $validatedData = $request->validate([
        'amount' => 'required|numeric',
        'description' => 'required|string',
        'category' => 'required|string',
        'supporting_document' => 'file|mimes:jpg,jpeg,png|max:200' // 50 KB // Specify allowed file types
    ]);

    // Create a new Expense model instance and populate its fields
    $expense = new Expense();
    $expense->amount = $validatedData['amount'];
    $expense->description = $validatedData['description'];
    $expense->category = $validatedData['category'];
    $expense->staff_id = $userId;

    // Set the expense status based on the user's role
    if ($userRole == "manager") {
        $expense->status = "accepted";
    }

    // Check if the "draft" checkbox is checked
    $draft = $request->has('draft');

    if ($draft) {
        $expense->status = "drafted";
    }

    // Handle the uploaded supporting document
    if ($request->hasFile('supporting_document')) {
        $file = $request->file('supporting_document');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads'), $fileName);
        $expense->supporting_document = 'uploads/' . $fileName;
    }

    // Save the expense record to the database
    $expense->save();

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Expense has been successfully recorded.');
}



function showExpenseDetails(){
         $user = Auth::user(); // Retrieve the authenticated user
         $userId = $user->id;
         $userRole=$user->position;


         if ($userRole=="staff") {
            $pendings = Expense::where('staff_id', $userId)
            ->get();

            $approveds = Expense::where('staff_id', $userId)
            ->where('status', 'approved')
            ->get();
        }




        if ($userRole=="manager") {

          $currentUser = Auth::user();

            // Get the IDs of all staff members associated with the current manager
          $staffIds = User::where('manager_id', $currentUser->id)->pluck('id');

            // Include the manager's ID in the list
          $staffIds[] = $currentUser->id;

            // Retrieve expenses for the current manager and their associated staff
          $approveds = Expense::whereIn('staff_id', $staffIds)
          ->where('status','approved')
          ->get();




          $user = Auth::user();

          $pendings = Expense::whereHas('staff', function ($query) use ($user) {
                // This filters expenses for staff associated with the current user
            $query->where('manager_id', $user->id);
        })
          ->where('status', 'pending')
          ->get();


          $manager_pendings = Expense::where('staff_id', $userId)
          ->where('status', 'accepted')
          ->get();

          $manager_drafted = Expense::where('staff_id', $userId)
          ->where('status', 'drafted')
          ->get();

          $rejected=Expense::whereIn('staff_id', $staffIds)
          ->where('status','rejected_hod')
          ->orWhere('status','rejected_manager')
          ->get();


          return view('expense_details', ['rejected'=>$rejected,'manager_drafted'=>$manager_drafted,'pendings' => $pendings,'manager_pendings'=>$manager_pendings, 'approveds'=>$approveds]);


      }



      if ($userRole=="hod") {


        $hodId = Auth::user()->id;
        $currentDepartment=Auth::user()->department;

        $pendings = Expense::whereIn('staff_id', function ($query) use ($currentDepartment) {
        // Subquery to retrieve staff and managers associated with the current department
            $query->select('id')
            ->from('users')
            ->where('department', $currentDepartment)
            ->where(function ($query) {
                  // Include both staff and managers
              $query->where('position', 'staff')
              ->orWhere('position', 'manager');
          });
        })
    ->where('status', 'accepted') // Filter by expense status 'accepted' by Manager
    ->get();




    $details = Expense::whereIn('staff_id', function ($query) use ($currentDepartment) {
        // Subquery to retrieve staff and managers associated with the current department
        $query->select('id')
        ->from('users')
        ->where('department', $currentDepartment)
        ->where(function ($query) {
                  // Include both staff and managers
          $query->where('position', 'staff')
          ->orWhere('position', 'manager');
      });
    })
    ->where('status', 'approved') // Filter by expense status 'pending'
    ->get();




    $rejected = Expense::whereIn('staff_id', function ($query) use ($currentDepartment) {
        // Subquery to retrieve staff and managers associated with the current department
        $query->select('id')
        ->from('users')
        ->where('department', $currentDepartment)
        ->where(function ($query) {
                  // Include both staff and managers
          $query->where('position', 'staff')
          ->orWhere('position', 'manager');
      });
    })
    ->where('status', 'rejected_hod') // Filter by expense status 'rejected_by hod and manager'
    ->orWhere('status', 'rejected_manager')
    ->get();

    return view('expense_details', ['rejected'=>$rejected,'pendings' => $pendings, 'details'=>$details]);
}

return view('expense_details', ['pendings' => $pendings, 'approveds'=>$approveds]);
}







/*This gives the staff expenses associated to the current logged in manager */
function details(Request $request){

    $expenseId=$request->id;

    $expense = Expense::with('submittedByUser')->find($expenseId);
        // $submittedByUser = $expense->submittedByUser;

    return view('details',['expense'=>$expense]);

}



function approve(Request $request){
    $userRole=Auth::user()->position;
    $id=$request->id;
    $expense = Expense::find($request->id);
    
    if ($userRole=="manager") {
        $expense->status='accepted';

    }else{
        $expense->status='approved';        
    }

    $expense->save();
    return redirect("/expense_details")->with('success', 'Expense has been Accepted.');
}



function reject(Request $request){
    $userRole=Auth::user()->position;
    $id=$request->id;
    $expense = Expense::find($request->id);

    if ($userRole=="hod") {
        $expense->status='rejected_hod';

    }else{
        $expense->status='rejected_manager';        
    }

    $expense->save();
    return redirect("/expense_details")->with('deleted', 'Expense has been Rejected.');
}



function masterExpense(Request $request){

    $submitted = Expense::where('status', 'pending')
    ->orWhere('status', 'accepted')
    ->get();

    $rejected=Expense::where('status','rejected_hod')->get();
    $approveds=Expense::where('status','approved')->get();
    $drafted=Expense::where('status','drafted')->get();
    return view('master-expense',['drafted'=>$drafted,'rejected'=>$rejected,'submitted' => $submitted, 'approveds'=>$approveds]);
}



function deleteExpense(Request $request){
    $id=$request->id;
    $expense = Expense::find($id);

    if ($expense) {
        $expense->delete();
    // The record with the specified ID has been deleted.
    } else {
    // Handle the case where no record was found with the given ID.
        abort(404);
    }

    return redirect("/master-expense")->with('deleted', 'Expense has been Deleted.');
}


function rejectExpense(Request $request){
    $id=$request->id;
    $expense = Expense::find($request->id);
    $expense->status='rejected_hod';        
    
    $expense->save();
    return redirect("/master-expense")->with('deleted', 'Expense has been Rejected.');
}


function editExpense(Request $request){
    $id=$request->id;
    $expense = Expense::find($request->id);    
    return view('edit-expense',['expense'=>$expense]);
}



public function updateExpense(Request $request, $id)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'amount' => 'required|numeric',
        'description' => 'required|string',
        'category' => 'required|string',
        'supporting_document' => 'file|mimes:jpg,jpeg,png|max:200'
    ]);

    // Retrieve the expense record to update
    $expense = Expense::findOrFail($id);

    // Update the expense record with the new data
    $expense->amount = $validatedData['amount'];
    $expense->description = $validatedData['description'];
    $expense->category = $validatedData['category'];

    // Check if the "draft" checkbox is checked
    $draft = $request->has('draft');

    $user = Auth::user(); // Retrieve the authenticated user
    $userRole=$user->position;




    if ($draft) {
        $expense->status = "drafted";
    }else{
        if ($userRole=="manager") {
            $expense->status = "accepted";
        }else{
            $expense->status = "pending";
        }
    }

    // Handle the uploaded supporting document
    if ($request->hasFile('supporting_document')) {
        $file = $request->file('supporting_document');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads'), $fileName);
        $expense->supporting_document = 'uploads/' . $fileName;
    }

    // Save the updated expense record
    $expense->save();

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Expense has been successfully updated.');
}









}
