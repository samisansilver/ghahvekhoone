<?php

use App\Http\Controllers\ProfileController;
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
/*
Route::get('/', function () {
    return view('/dashboard');
});
*/

Route::get('/', [\App\Http\Controllers\placeController::class, 'index']);

Route::post('/view/{id}', [\App\Http\Controllers\placeController::class, 'view']);
Route::post('/search', [\App\Http\Controllers\placeController::class, 'search']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/addplace', [\App\Http\Controllers\placeController::class, 'addview']);
    Route::post('/addplace', [\App\Http\Controllers\placeController::class, 'add']);
});

Route::get('testsms', function (){
    try{
        $sender = "1000010006060";		//This is the Sender number

        $message = "تست پیامک ایلیااستیل";		//The body of SMS

        $receptor = array("09197228110","09127228828");			//Receptors numbers

        $result = Kavenegar::Send($sender,$receptor,$message);
        if($result){
            foreach($result as $r){
                echo "messageid = $r->messageid";
                echo "message = $r->message";
                echo "status = $r->status";
                echo "statustext = $r->statustext";
                echo "sender = $r->sender";
                echo "receptor = $r->receptor";
                echo "date = $r->date";
                echo "cost = $r->cost";
            }
        }
    }
    catch(\Kavenegar\Exceptions\ApiException $e){
        // در صورتی که خروجی وب سرویس 200 نباشد این خطا رخ می دهد
        echo $e->errorMessage();
    }
    catch(\Kavenegar\Exceptions\HttpException $e){
        // در زمانی که مشکلی در برقرای ارتباط با وب سرویس وجود داشته باشد این خطا رخ می دهد
        echo $e->errorMessage();
    }catch(\Exceptions $ex) {
        // در صورت بروز خطایی دیگر
        echo $ex->getMessage();
    }
});

require __DIR__.'/auth.php';
