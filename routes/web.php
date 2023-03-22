<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Demo\DemoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Home\HomeSlideController;
use App\Http\Controllers\Home\AboutController;
use App\Http\Controllers\Home\PortfolioController;
use App\Http\Controllers\Home\ContactController;
use App\Http\Controllers\Home\FooterController;

/*Route::get('/', function () {
    return view('frontend.index');
});*/


Route::middleware('auth')->group(function () {   //We use this middleware to return to login page when the  session page gets expired

//Admin all route
Route::controller(AdminController::class)->group(function () {
    Route::get('/admin/logout', 'destroy')->name('admin.logout');
    Route::get('/admin/profile', 'profile')->name('admin.profile');
    Route::get('/edit/profile/', 'editprofile')->name('edit.profile');
    Route::post('/store/profile/', 'storeprofile')->name('store.profile');
    Route::get('/change/password/', 'changepassword')->name('change.password');
    Route::post('/update/password/', 'updatepassword')->name('update.password');
    Route::get('/admin/logout/Timeout', 'timeoutdestroy')->name('admin.logout.timeout');
});


Route::controller(HomeSlideController::class)->group(function () {
    Route::get('/', 'Homepage')->name('home');
    Route::get('/home/slide', 'homeslider')->name('home.slide');
    Route::post('/update/slide', 'updateslide')->name('update.slide');
});


//About all route
Route::controller(AboutController::class)->group(function () {
    Route::get('/about/page', 'aboutpage')->name('about.page');
    Route::post('/update/about', 'updateabout')->name('update.about');
    Route::get('/home/about', 'homeabout')->name('home.about');
    Route::get('/about/multi/image', 'aboutmultiimage')->name('about.multi.image');
    Route::post('/store/multiimage', 'storemultiimage')->name('store.multi.image');
    Route::get('/all/multi/image', 'allmultiimage')->name('all.multi.image');
    Route::get('/edit/multi/image/{id}', 'editmultiimage')->name('edit.multi.image'); //Here we pass id with url it shows the image id then this id is passed as a parameter to the method to access that value stord table
    Route::post('/update/multiimage', 'updatemultiimage')->name('Update.multi.image');
    Route::get('/delete/multiimage{id}', 'deletemultiimage')->name('delete.multi.image');
});


//Portfolio all route
Route::controller(PortfolioController::class)->group(function () {
    Route::get('/all/Portfolio', 'allportfolio')->name('all.portfolio');
    Route::get('/add/Portfolio', 'addportfolio')->name('add.portfolio');
    Route::post('/store/Portfolio', 'storeportfolio')->name('store.portfolio');
    Route::get('/edit/portfolio/{id}', 'editportfolio')->name('edit.portfolio'); //Here we pass id with url it shows the image id then this id is passed as a parameter to the method to access that value stord table
    Route::post('/update/portfolio', 'updateportfolio')->name('Update.portfolio');
    Route::get('/delete/portfolio{id}', 'deleteportfolio')->name('delete.portfolio');
    Route::get('/portfolio/details', 'portfoliodetails')->name('portfolio.details');
});

Route::controller(ContactController::class)->group(function () {
    Route::get('/contact/page', 'contactpage')->name('contact.page');
    Route::post('/send/message', 'sendmessage')->name('send.message');
    Route::get('/contact/message', 'contactmessage')->name('contact.message');
    Route::get('/delete/message{id}', 'deletemessage')->name('delete.message');
});

Route::controller(FooterController::class)->group(function () {
    Route::get('/footer/setup', 'footersetup')->name('footer.setup');
    Route::post('/update/footer', 'updatefooter')->name('update.footer');
});
});



Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');





Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
