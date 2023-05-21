<?php

use App\Models\User;
use App\Notifications\AdminEmailNotification;
use App\Notifications\PasswordResetNotification;
use App\Notifications\UserEmailNotification;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('routes', function() {
    \Artisan::call('route:list');
    return '<pre>' . \Artisan::output() . '</pre>';
});

Route::group(['namespace' => 'Front'], function () {
    Route::get('/', 'IndexController@index')->name('index');

    Route::get('/kontakt', 'ContactController@index')->name('contact.index');
    Route::post('/kontakt', 'ContactController@form')->name('contact.form');

    Route::get('/konferencje-i-szkolenia', 'ArticleController@index')->name('article');

    Route::get('/lista-kursow', 'CourseController@index')->name('course.index');
    Route::get('/nowe-konto', 'CourseController@form')->name('course.form');
    Route::post('/kurs', 'CourseController@check')->name('course.check');
    Route::get('/kurs/{exam}-{date}', 'CourseController@show')->name('course.show');
    Route::post('/kurs/{exam}-{date}', 'CourseController@store')->name('course.store');

    Route::get('/o-nas', 'AboutController@index')->name('about');

    Route::get('/moje-kursy', 'StudentController@index')->name('student.index')->middleware(['auth', 'student']);

    Route::get('/moje-kursy/{exam}-{date}', 'ExamController@info')->name('exam.info')->middleware(['exam.registration']);

    Route::get('/nowe-konto/podziekowanie', 'ThankYouController@index')->name('thankyou');

    Route::group(['middleware' => ['auth', 'can:user-files']], function () {
        Route::get('{exam}/wideo', 'ExamController@video')->name('exam.video');
        Route::get('{exam}/pliki', 'ExamController@files')->name('exam.files');
    });

    Route::group(['middleware' => ['auth', 'can:user-test']], function () {
        Route::get('/egzamin/{exam}-{date}', 'ExamController@index')->name('exam.index')->middleware(['exam.date.registration']);

        Route::get('/egzamin/start/{exam}-{date}', 'ExamController@show')->name('exam.show')->middleware(['exam.date.registration']);

        Route::post('/egzamin/{exam}-{date}', 'ExamController@store')->name('exam.store');

        Route::get('/egzamin/wynik/{exam}-{date}-{attempt}', 'ExamController@result')->name('exam.result');
    });



    Route::get('/notification', function () {
        $admin = User::first();

//        $token = 123;
//        return (new PasswordResetNotification($token))->toMail($admin->mail);

//        $user_notify = [
//            'subject' => 'Podkarpacki Oddział PTMSiZP - potwierdzenie rejestracji',
//            'greeting' => 'Witaj '.$admin->name.',',
//            'body' => 'dziękujemy za dokonanie rejestracji w serwisie Podkarpacki Oddział PTMSiZP. Twoje konto <b>wymaga weryfikacji</b> przez administratora. Po aktywacji konta otrzymasz wiadomość.'
//        ];
//
//        return (new UserEmailNotification($user_notify))->toMail($admin->mail);


//        $admin_notify = [
//            'subject' => 'Podkarpacki Oddział PTMSiZP - rejestracja nowego konta',
//            'greeting' => 'Witaj '.$admin->name.',',
//            'body' =>'w systemie pojawiła się nowa rejestracja użytkownika.<br><table class="table"><tr><td>Data:</td><td>'.date('Y-m-d').'</td></tr><tr><td>Imie:</td><td>Jacek</td></tr><tr><td>Nazwisko:</td><td>Kurowski</td></tr><tr><td>Adres e-mail:</td><td>cos@wp.pl</td></tr></table>',
//            'regards' => 'Pozdrawiam'
//        ];
//        return (new AdminEmailNotification($admin_notify))->toMail($admin->mail);
    });
});