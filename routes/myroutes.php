<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\DepartmentController;

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::get('/register', [HomeController::class, 'registration'])->name('registration');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'authenticate']);
Route::get('/dashboard', [AuthController::class, 'showDashboard'])->middleware('auth')->name('dashboard');
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/profile/{id}', [AuthController::class, 'profile'])->middleware('auth');
Route::get('/change-password', [AuthController::class, 'showChangePasswordForm'])->middleware('auth')->name('change-password');
Route::post('/change-password', [AuthController::class, 'changePassword'])->middleware('auth');









Route::middleware(['role:hod'])->group(function () {
	Route::get('/expense', [ExpenseController::class, 'showExpenseForm'])->middleware('auth');
	Route::post('/expense', [ExpenseController::class, 'storeExpenseData'])->middleware('auth');	
	Route::get('/user-management', [UserManagementController::class, 'userManagement'])->middleware('auth');
});

Route::middleware(['auth', 'role:hod,manager'])->group(function () {

	Route::get('/expense_details', [ExpenseController::class, 'showExpenseDetails'])->middleware('auth');
	Route::get('/detail/{id}', [ExpenseController::class, 'details']);
	Route::post('/approve', [ExpenseController::class, 'approve']);
	Route::post('/reject', [ExpenseController::class, 'reject']);
});









// Route::middleware(['role:staff,manager'])->group(function () {
// 	Route::get('/expense', [ExpenseController::class, 'showExpenseForm'])->middleware('auth');
// 	Route::post('/expense', [ExpenseController::class, 'storeExpenseData'])->middleware('auth');	
// });




// Route::middleware(['role:system_manager'])->group(function () {
// 	Route::get('/department', [DepartmentController::class, 'index'])->middleware('auth');
// 	Route::post('/department', [DepartmentController::class, 'addDepartment'])->middleware('auth');
// 	Route::get('/department/remove/{id}', [DepartmentController::class, 'remove'])->middleware('auth');
// 	Route::get('/user-management', [UserManagementController::class, 'userManagement'])->middleware('auth');



// 	Route::get('/promote-hod/{id}', [UserManagementController::class, 'promoteHOD'])->middleware('auth');
// 	Route::get('/demote-manager/{id}', [UserManagementController::class, 'showDemoteForm'])->middleware('auth');
// 	Route::post('/demote-manager/{id}', [UserManagementController::class, 'demoteHOD'])->middleware('auth');
// 	Route::get('/promote/{id}', [UserManagementController::class, 'promote'])->middleware('auth');
// 	Route::post('/demote', [UserManagementController::class, 'demote'])->middleware('auth');

// 	Route::get('/promote-manager/{id}', [UserManagementController::class, 'promoteManager'])->middleware('auth');
// 	Route::get('/assign-manager/{id}', [UserManagementController::class, 'showAssignForm'])->middleware('auth');
// 	Route::post('/assign-manager/{id}', [UserManagementController::class, 'assignManager'])->middleware('auth');
// });












// Route::get('/demote-manager/{id}', [UserManagementController::class, 'showDemoteForm'])->middleware('auth');
// Route::post('/demote-manager/{id}', [UserManagementController::class, 'demoteHOD'])->middleware('auth');

// Route::post('/assign-hod', [UserManagementController::class, 'assign'])->middleware('auth');






Route::get('/test', [ExpenseController::class, 'test'])->middleware('auth');



//updated yeta chha hai 

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\DepartmentController;

/*These are the routes accessible to all users despite of any position*/
/*middleware('auth') refers that the route is accesible only after login */
/*name('xyz') refers to the name of the route */

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::get('/register', [HomeController::class, 'registration'])->name('registration');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'authenticate']);
Route::get('/dashboard', [AuthController::class, 'showDashboard'])->middleware('auth')->name('dashboard');
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');
Route::get('/profile/{id}', [AuthController::class, 'profile'])->middleware('auth');


Route::get('/change-password', [AuthController::class, 'showChangePasswordForm'])->name('change-password');
Route::post('/change-password', [AuthController::class, 'changePassword']);


/*For The route group below, a middleware CheckPosition is created and added to the Kernel.php in app/http/ location*/ 

//Allow access for manager and staff
Route::group(['middleware' => ['auth', 'check.position:manager,staff']], function () {
	Route::get('/expense', [ExpenseController::class, 'showExpenseForm'])->middleware('auth');
	Route::post('/expense', [ExpenseController::class, 'storeExpenseData'])->middleware('auth');
});



//Allow access for manager,hod and staff
Route::group(['middleware' => ['auth', 'check.position:manager,staff,hod']], function () {
	Route::get('/expense_details', [ExpenseController::class, 'showExpenseDetails'])->middleware('auth');
});




//Allow access for manager and hod and system_manager
Route::group(['middleware' => ['auth', 'check.position:manager,hod,system_manager']], function () {
	Route::get('/detail/{id}', [ExpenseController::class, 'details']);
	Route::post('/approve', [ExpenseController::class, 'approve']);
	Route::post('/reject', [ExpenseController::class, 'reject']);
});



//Allow access for system_manager and hod
Route::group(['middleware' => ['auth', 'check.position:system_manager,hod']], function () {
	Route::get('/user-management', [UserManagementController::class, 'userManagement'])->middleware('auth');
});


//Allow access for system_manager
Route::group(['middleware' => ['auth', 'check.position:system_manager']], function () {
	Route::get('/department', [DepartmentController::class, 'index'])->middleware('auth');
	Route::post('/department', [DepartmentController::class, 'addDepartment'])->middleware('auth');
	Route::get('/department/remove/{id}', [DepartmentController::class, 'remove'])->middleware('auth');


	Route::get('/promote-hod/{id}', [UserManagementController::class, 'promoteHOD'])->middleware('auth');
	Route::get('/demote-manager/{id}', [UserManagementController::class, 'showDemoteForm'])->middleware('auth');
	Route::post('/demote-manager/{id}', [UserManagementController::class, 'demoteHOD'])->middleware('auth');


	Route::get('/master-expense', [ExpenseController::class, 'masterExpense'])->middleware('auth');
	Route::get('/delete-expense/{id}', [ExpenseController::class, 'deleteExpense'])->middleware('auth');
	Route::get('/reject-expense/{id}', [ExpenseController::class, 'rejectExpense'])->middleware('auth');


});


//Allow access for hod
Route::group(['middleware' => ['auth', 'check.position:hod']], function () {
	Route::get('/promote-manager/{id}', [UserManagementController::class, 'promoteManager'])->middleware('auth');
	Route::get('/assign-manager/{id}', [UserManagementController::class, 'showAssignForm'])->middleware('auth');
	Route::post('/assign-manager/{id}', [UserManagementController::class, 'assignManager'])->middleware('auth');
	Route::post('/demote', [UserManagementController::class, 'demote'])->middleware('auth');
});



Route::put('/update-expense/{id}', [ExpenseController::class, 'updateExpense'])->name('update-expense');

Route::get('/edit/{id}', [ExpenseController::class, 'editExpense'])->middleware('auth');


Route::get('/promote/{id}', [UserManagementController::class, 'promote'])->middleware('auth');

Route::post('/assign-hod', [UserManagementController::class, 'assign'])->middleware('auth');




