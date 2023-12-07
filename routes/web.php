<?php

use App\Http\Livewire\Auth\ForgotPassword;
use App\Http\Livewire\Auth\Login as AuthLogin;
use App\Http\Livewire\Auth\SignUp;
use App\Http\Livewire\Billing;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\LaravelExamples\UserManagement;
use App\Http\Livewire\LaravelExamples\UserProfile;
use App\Http\Livewire\Master\MasterCostCenter;
use App\Http\Livewire\Master\MasterDepartement;
use App\Http\Livewire\Master\MasterMaterial;
use App\Http\Livewire\Master\MasterMovementType;
use App\Http\Livewire\Master\MasterStorageBin;
use App\Http\Livewire\Master\MasterStorageLocation;
use App\Http\Livewire\MasterDepartement\Index as MasterDepartementIndex;
use App\Http\Livewire\MasterUom\Index as MasterUomIndex;
use App\Http\Livewire\MasterMaterial\Edit;
use App\Http\Livewire\MasterMaterial\Index;
use App\Http\Livewire\Profile;
use App\Http\Livewire\Rtl;
use App\Http\Livewire\StaticSignIn;
use App\Http\Livewire\StaticSignUp;
use App\Http\Livewire\Tables;
// use App\Livewire\Auth\Login;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // return view('login');
    return redirect('/login');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/sign-up', SignUp::class)->name('sign-up');
Route::get('/login', AuthLogin::class)->name('login');

Route::get('/login/forgot-password', ForgotPassword::class)->name('forgot-password');

// Route::get('/reset-password/{id}',ResetPassword::class)->name('reset-password')->middleware('signed');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/billing', Billing::class)->name('billing');
    Route::get('/profile', Profile::class)->name('profile');
    Route::get('/tables', Tables::class)->name('tables');
    Route::get('/static-sign-in', StaticSignIn::class)->name('sign-in');
    Route::get('/static-sign-up', StaticSignUp::class)->name('static-sign-up');
    Route::get('/rtl', Rtl::class)->name('rtl');
    Route::get('/laravel-user-profile', UserProfile::class)->name('user-profile');
    Route::get('/laravel-user-management', UserManagement::class)->name('user-management');
    // Master
    Route::get('/master_material', Index::class)->name('master-material');
    Route::get('/master_departement', MasterDepartementIndex::class)->name('master-departement');
    Route::get('/master_uom', MasterUomIndex::class)->name('master-uom');

    Route::get('/master_storage_bin', MasterStorageBin::class)->name('master-storage-bin');
    Route::get('/master_storage_location', MasterStorageLocation::class)->name('master-storage-location');
    // Route::get('/master_departement', MasterDepartement::class)->name('master-departement');
    Route::get('/master_cost_center', MasterCostCenter::class)->name('master-cost-center');
    Route::get('/master_movement_type', MasterMovementType::class)->name('master-movement-type');

});
