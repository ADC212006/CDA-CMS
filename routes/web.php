<?php

use App\Http\Controllers\AuctionNoticesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LinksController;
use App\Http\Controllers\NewsUpdateController;
use App\Http\Controllers\PublicNotesController;
use App\Http\Controllers\TenderController;
use App\Http\Controllers\BoardMeetingController;

use Illuminate\Support\Facades\Artisan;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;






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
Route::middleware(['web', 'throttle:web'])->group(function () {

Route::get('/send-test-email', function () {
    $data = 'This is a test email from Laravel!';
    try {
        Mail::to('arslanali242@gmail.com')->send(new TestMail($data));
        return 'Test email sent!';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});


Route::get('/config-cache', function () {
  
    Artisan::call('config:cache');
    Artisan::call('config:clear');
    return 'Configuration cache cleared and created successfully!';
})->name('config.cache');

Route::get('/phpinfo', function () {
    return phpinfo();
})->name('phpinfo');



Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');

Route::post('/admin/login/submit', [AdminController::class, 'loginSubmit'])->name('admin.login.submit');

Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
Route::get('admin/password/reset/{token}', [AdminController::class, 'showResetForm'])->name('admin.password.reset');

Route::post('admin/password/email', [AdminController::class, 'sendResetLink'])->name('admin.password.email');
Route::post('admin/password/reset', [AdminController::class, 'resetPassword'])->name('admin.password.update');


Route::middleware(['adminAuthMiddleware'])->group(function () {
    Route::get('/', function () {
        return redirect()->route('slider.index');
    })->name('/');
    Route::post('/admin/password/update', [AdminController::class, 'updatePassword'])->name('admin.password.update.modal');

    Route::get('slider/index', [SliderController::class, 'index'])->name('slider.index');
    Route::get('slider/fetch', [SliderController::class, 'sliderFetch'])->name('slider.fetch');
    Route::post('slider/store', [SliderController::class, 'store'])->name('slider.store');
    Route::post('/slider/update/{id}', [SliderController::class, 'update'])->name('slider.update');
    Route::delete('slider/delete/{id}', [SliderController::class, 'destroy'])->name('slider.destroy');



    Route::get('links/index', [LinksController::class, 'index'])->name('links.index');
    Route::post('links/store', [LinksController::class, 'store'])->name('links.store');
    Route::get('link/fetch', [LinksController::class, 'linkFetch'])->name('link.fetch');
    Route::post('link/update/{id}', [LinksController::class, 'update'])->name('link.update');
    Route::delete('link/delete/{id}', [LinksController::class, 'destroy'])->name('link.destroy');



    Route::get('news/update/index', [ NewsUpdateController::class, 'index'])->name('news.update.index');
    Route::post('news/update/index', [ NewsUpdateController::class, 'store'])->name('news.store');
    Route::get('news/fetch', [ NewsUpdateController::class, 'newFetch'])->name('newsUpdate.fetch');
    Route::post('newsupdate/update/{id}', [ NewsUpdateController::class, 'update'])->name('newsupdate.update');
    Route::delete('newsupdate/delete/{id}', [NewsUpdateController::class, 'destroy'])->name('newsupdate.destroy');

    Route::post('newsupdate/banner/store', [     NewsUpdateController::class, 'storeBanner'])->name('newsupdate.banner.store');
    Route::get('newsupdate/banner/get', [    NewsUpdateController::class, 'getAllBanners'])->name('newsupdate.banner.get');

    Route::get('public/notes/index', [ PublicNotesController::class, 'index'])->name('public.notes.index');
    Route::post('public/notes/index', [ PublicNotesController::class, 'store'])->name('public.notes.store');
    Route::get('public/notes/fetch', [ PublicNotesController::class, 'newFetch'])->name('public.notes.fetch');
    Route::post('public/notes/{id}', [ PublicNotesController::class, 'update'])->name('public.notes.update');
    Route::delete('public/notes/delete/{id}', [PublicNotesController::class, 'destroy'])->name('public.notes.destroy');

    Route::post('public/notice/banner/store', [ PublicNotesController::class, 'storeBanner'])->name('public.notice.banner.store');
    Route::get('public/notice/banner/get', [ PublicNotesController::class, 'getAllBanners'])->name('public.notice.banner.get');

   

    
    
    // Route::get('tender/index', [ TenderController::class, 'index'])->name('tender.index');
    // Route::post('tender/index', [ TenderController::class, 'store'])->name('tender.store');
    // Route::get('tender/fetch', [ TenderController::class, 'newFetch'])->name('tender.fetch');
    // Route::post('tender/{id}', [ TenderController::class, 'update'])->name('tender.update');
    // Route::delete('tender/delete/{id}', [TenderController::class, 'destroy'])->name('tender.destroy');



    // Route::get('board/meeting/index', [ BoardMeetingController::class, 'index'])->name('board.meeting.index');
    // Route::post('board/meeting/index', [ BoardMeetingController::class, 'store'])->name('board.meeting.store');
    // Route::get('board/meeting/fetch', [ BoardMeetingController::class, 'newFetch'])->name('board.meeting.fetch');
    // Route::post('board/meeting/{id}', [ BoardMeetingController::class, 'update'])->name('board.meeting.update');
    // Route::delete('board/meeting/delete/{id}', [BoardMeetingController::class, 'destroy'])->name('board.meeting.destroy');


    Route::get('board/index', [ BoardMeetingController::class, 'index'])->name('board.index');
    Route::post('board/index', [ BoardMeetingController::class, 'store'])->name('board.store');
    Route::get('board/fetch', [ BoardMeetingController::class, 'newFetch'])->name('board.fetch');
    Route::post('board/{id}', [ BoardMeetingController::class, 'update'])->name('board.update');
    Route::delete('board/delete/{id}', [BoardMeetingController::class, 'destroy'])->name('board.destroy');

    Route::post('board/banner/store', [     BoardMeetingController::class, 'storeBanner'])->name('board.banner.store');
    Route::get('board/banner/get', [    BoardMeetingController::class, 'getAllBanners'])->name('board.banner.get');


    Route::get('tender/index', [ TenderController::class, 'index'])->name('tender.index');
    Route::post('tender/index', [ TenderController::class, 'store'])->name('tender.store');
    Route::get('tender/fetch', [ TenderController::class, 'newFetch'])->name('tender.fetch');
    Route::post('tender/{id}', [ TenderController::class, 'update'])->name('tender.update');
    Route::delete('tender/delete/{id}', [TenderController::class, 'destroy'])->name('tender.destroy');

    Route::post('tender/banner/store', [     TenderController::class, 'storeBanner'])->name('tender.banner.store');
    Route::get('tender/banner/get', [    TenderController::class, 'getAllBanners'])->name('tender.banner.get');

    

   

   
});
});