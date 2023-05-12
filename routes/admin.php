<?php
use Illuminate\Support\Facades\Route;

//GET - admin/crm/module
//POST - admin/crm/module - store
//PUT - admin/crm/module/{calendar} - update
//GET - admin/crm/module/{calendar} - show
//DELETE - admin/crm/module/{calendar} - destroy
//GET - admin/crm/module/{calendar}/edit - edit

Route::group([
    'namespace' => 'Admin', 'prefix' => '/admin', 'as' => 'admin.', 'middleware' => ['auth', 'can:admin-panel']], function () {

    Route::get('/', function () {
        return redirect('admin/settings/seo');
    });

    Route::resources([
        'user' => 'User\IndexController',
        'role' => 'Role\IndexController',
        'greylist' => 'Greylist\IndexController',
        'article' => 'Article\IndexController',
        'file' => 'File\IndexController',
        'exam' => 'Exam\IndexController',
        'examdate' => 'Exam\DateController',
        'exam/{exam}/question' => 'Exam\QuestionController',
    ]);

    Route::group(['namespace' => 'Calendar','prefix'=>'/calendar', 'as' => 'calendar.'], function () {
        Route::get('/', 'IndexController@index')->name('index');
        Route::get('/events', 'IndexController@show')->name('show');
    });

    Route::delete('examdate/{examdate}/entry/{examdateuser}', 'Exam\DateController@destroyRegister')->name('examdate.destroyRegister');
    Route::get('examdate/results/{examdate}', 'Exam\DateController@index')->name('examdate.index');
    Route::get('examdate/export/{examdate}', 'Exam\DateController@export')->name('examdate.export');
    Route::get('examdate/show/{id}', function ($id) {
        $examDate = App\Models\ExamDate::select('exam', 'start', 'end')->find($id);
        return response()->json($examDate);
    });


    // Settings
    Route::group(['prefix'=>'/settings', 'as' => 'settings.'], function () {

        Route::resources([
            '/' => 'Dashboard\IndexController',
            'seo' => 'Dashboard\SeoController',
            'popup' => 'Dashboard\PopupController'
        ]);
    });

    Route::get('logs', 'Log\IndexController@index')->name('log.index');
    Route::get('logs/datatable', 'Log\IndexController@datatable')->name('log.datatable');
});
