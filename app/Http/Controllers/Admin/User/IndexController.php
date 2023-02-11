<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

// CMS
use App\Http\Requests\UserFormRequest;
use App\Repositories\UserRepositoryInterface;
use App\Models\User;

//Importing laravel-permission models
use Spatie\Permission\Models\Role;

class IndexController extends Controller
{
    private $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
//        $this->middleware('permission:user-list|user-create|user-edit|user-delete', [
//            'only' => ['index','store']
//        ]);
//        $this->middleware('permission:user-create', [
//            'only' => ['create','store']
//        ]);
//        $this->middleware('permission:user-edit', [
//            'only' => ['edit','update']
//        ]);
//        $this->middleware('permission:user-delete', [
//            'only' => ['destroy']
//        ]);
        $this->repository = $repository;
    }

    public function index()
    {
        return view('admin.user.index', [
            'list' => $this->repository->all()
        ]);
    }

    public function create()
    {
        return view('admin.user.form', [
            'cardTitle' => 'Dodaj użytkownika',
            'roles' => $this->repository->getRoles(),
            'backButton' => route('admin.user.index'),
            'selected' => ''
        ])->with('entry', User::make());
    }

    public function store(UserFormRequest $request)
    {
        $user = User::create($request->merge([
            'password' => Hash::make($request->get('password')),
        ])->except(['_token', 'submit', 'confirm-password', 'roles']));

        $user->assignRole($request->input('roles'));

        return redirect(route('admin.user.index'))->with('success', 'Użytkownik dodany');
    }

    public function edit($id)
    {
        $user = $this->repository->find($id);
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('admin.user.form', [
            'cardTitle' => 'Edytuj użytkownika: '.$user->name,
            'roles' => $this->repository->getRoles(),
            'selected' => $userRole,
            'backButton' => route('admin.user.index'),
            'entry' => $user
        ]);
    }

    public function update(UserFormRequest $request, $id)
    {
        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = $this->repository->find($id);
        $user->update($input);

        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));

        //$user->update($request->except(['_token', 'submit']));
        return redirect(route('admin.user.index'))->with('success', 'Użytkownik zaktualizowany');
    }

    public function destroy($id)
    {
        $this->repository->delete($id);
        return response()->json('Deleted');
    }
}
