<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

// CMS
use App\Http\Requests\UserFormRequest;
use App\Repositories\UserRepositoryInterface;
use App\Models\User;

//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

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

    public function show(User $user)
    {
        return view('admin.user.show', ['user' => $user]);
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
        $originalValues = $user->getOriginal();

        $user->update($input);

        foreach ($originalValues as $key => $value) {
            if ($value != $user->$key) {
                echo "Attribute $key was changed from $value to {$user->$key}\n";
            }
        }

        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));

        //$user->update($request->except(['_token', 'submit']));
        return redirect(route('admin.user.index'))->with('success', 'Użytkownik zaktualizowany');
    }

    public function datatable(Request $request){
        $query = User::orderByDesc('id');

        if ($request->filled('minDate')) {
            $minDate = Carbon::parse($request->input('minDate'))->startOfDay();
            $query->where('created_at', '>=', $minDate);
        }

        if ($request->filled('maxDate')) {
            $maxDate = Carbon::parse($request->input('maxDate'))->endOfDay();
            $query->where('created_at', '<=', $maxDate);
        }

        $list = $query->get();

        return Datatables::of($list)
            ->addColumn('role', function ($row) {
                $roles = '';
                if (!empty($row->getRoleNames())) {
                    foreach ($row->getRoleNames() as $role) {
                        $roles .= '<label class="badge badge-role">' . $role . '</label>';
                    }
                }
                return $roles;
            })
            ->editColumn('status', function ($row){
                return status($row->active);
            })
            ->editColumn('created_at', function ($row){
                $date = Carbon::parse($row->created_at)->format('Y-m-d');
                $diffForHumans = Carbon::createFromFormat('Y-m-d', $date)->diffForHumans();
                return '<span>'.$date.'</span><div class="form-text mt-0">'.$diffForHumans.'</div>';
            })
            ->editColumn('updated_at', function ($row){
                $date = Carbon::parse($row->created_at)->format('Y-m-d');
                $diffForHumans = Carbon::createFromFormat('Y-m-d', $date)->diffForHumans();
                return '<span>'.$date.'</span><div class="form-text mt-0">'.$diffForHumans.'</div>';
            })
            ->addColumn('actions', function ($row) {
                return view('admin.user.tableActions', ['row' => $row]);
            })
            ->rawColumns([
                'role',
                'status',
                'created_at',
                'updated_at',
                'actions'
            ])
            ->make();
    }

    public function destroy($id)
    {
        $this->repository->delete($id);
        return response()->json('Deleted');
    }
}
