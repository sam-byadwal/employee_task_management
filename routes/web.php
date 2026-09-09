<?php


use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\TaskController;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Admin\CommentController; // for comment 

//  for employes
use App\Http\Controllers\Employee\EmployeeAuthController;
use App\Http\Controllers\Employee\EmployeeDashboardController;


use App\Http\Controllers\Employee\TaskController as EmployeeTaskController;



// Route::get('/', function () {
//     return 'Laravel Home Working';
// });

Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');


Route::middleware('admin')->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');


    
    //  employe 

 Route::prefix('admin')->name('admin.')->group(function () {


// <--- for employe delete issue --->

Route::get('/employees/{employee}/tasks', [EmployeeController::class,'tasks'])->name('employees.tasks'); // for delete task issue resolve method

Route::patch('/employees/{employee}/tasks/{task}/reassign', [EmployeeController::class,'reassignTask'])->name('employees.tasks.reassign');// bulkk task assign for employe by admin

Route::patch('/employees/{employee}/tasks/bulk-reassign', [EmployeeController::class,'bulkReassignTasks'])->name('employees.tasks.bulk-reassign');  // bulkk task assign for employe by admin

// <--- for employe delete issue --->

        Route::resource('employees', EmployeeController::class)
            ->except(['show']);

        Route::patch(
            '/employees/{employee}/toggle-status',
            [EmployeeController::class, 'toggleStatus']
        )->name('employees.toggle-status');


        Route::resource('tasks', TaskController::class);


    Route::resource('comments', CommentController::class)
    ->except(['show']);
    });

    


    
});


Route::get('/employee/login', [EmployeeAuthController::class, 'showLogin'])->name('employee.login');
Route::post('/employee/login', [EmployeeAuthController::class, 'login'])->name('employee.login.submit');



Route::middleware('employee')->prefix('employee')->name('employee.')->group(function () {
    Route::get('/dashboard', [EmployeeDashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [EmployeeAuthController::class, 'logout'])->name('logout');

      Route::get('/tasks', [EmployeeTaskController::class,
        'index'])->name('tasks.index');

    Route::get('/tasks/{task}', [EmployeeTaskController::class, 'show' ])->name('tasks.show');

    Route::patch('/tasks/{task}/status', [EmployeeTaskController::class, 'updateStatus'])->name('tasks.update-status');
Route::post('/tasks/{task}/comments', [EmployeeTaskController::class, 'addComment'])->name('tasks.comments.store');



});

