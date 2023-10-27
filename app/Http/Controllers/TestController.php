<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\User; 
use App\Models\Expense; 

class ExpenseController extends Controller
{

   function showExpenseForm(){
    return view('expense');
}


function storeExpenseData(Request $request){
        $user = Auth::user(); // Retrieve the authenticated user
        $userId = $user->id;
        $userRole=$user->position;

        // Validate the incoming request data
        $validatedData = $request->validate([
            'amount' => 'required|numeric',
            'description' => 'required|string',
            'category' => 'required|string',
            'supporting_document' => 'required|file|mimes:pdf,jpg,jpeg,png',
        ]);

        //To store in the Expense Model
        $expense = new Expense();
        $expense->amount = $validatedData['amount'];
        $expense->description = $validatedData['description'];
        $expense->category = $validatedData['category'];

        //To fill up the column depending on type of the user's position
        if ($userRole=="manager") {
            $expense->staff_id=0;
            $expense->manager_id=$userId;
        }else{
            $expense->staff_id=$userId;
            $expense->manager_id=0;
        }



        // Handle the uploaded supporting document
        if ($request->hasFile('supporting_document')) {
            $file = $request->file('supporting_document');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);
            $expense->supporting_document = 'uploads/' . $fileName;
        }


        // Save the expense record
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
            ->where('status', 'pending')
            ->get();

            $approveds = Expense::where('staff_id', $userId)
            ->where('status', 'approved')
            ->get();
        }




        if ($userRole=="manager") {

            $pendings = User::where('users.manager_id', $userId)->join('expenses', 'users.id', '=', 'expenses.staff_id')
            ->where('expenses.status','pending')
            ->select('expenses.*')->get();


            $manager_pendings = Expense::where('manager_id', $userId)
            ->where('status', 'pending')
            ->get();


            $approveds = Expense::where('manager_id', $userId)
            ->where('status', 'approved')
            ->get();


        }



        if ($userRole=="hod") {

            $pendings = Expense::where('manager_id', $userId)
            ->where('status', 'pending')
            ->get();

            $details = Expense::where('manager_id', $userId)
            ->where('status', 'approved')
            ->get();


            return view('expense_details', ['pendings' => $pendings, 'details'=>$details]);
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



    /*This gives the staff expenses associated to the current logged in manager */
    function test(Request $request){

       $hodId = Auth::user()->id; // Get the ID of the currently logged-in HOD

       $staff = User::where('hod_id', $hodId)->with('staff')->get();

       return $staff;


   }



}
