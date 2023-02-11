<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeoFormRequest;
use Spatie\Valuestore\Valuestore;

class SeoController extends Controller
{
    public function index()
    {
        return view('admin.settings.seo.index');
    }

    public function store(SeoFormRequest $request)
    {
        $settings = Valuestore::make(storage_path('app/settings.json'));
        $settings->put($request->except(['_token', 'submit']));
        return redirect(route('admin.settings.seo.index'))->with('success', 'Ustawienia zostały zapisane');
    }
}
