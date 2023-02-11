<?php namespace App\Repositories;

use Spatie\Activitylog\Models\Activity;
use Yajra\DataTables\DataTables;

class LogRepository
{
    public function getDataTable(){
        $list = Activity::all()->sortByDesc("id");
        return Datatables::of($list)
            ->editColumn('name', function ($row){
                return '<span data-filter="'. $row->causer->email.'">'.$row->causer->name.'<br>'.$row->causer->email.'</span>';
            })
            ->editColumn('method', function ($row){
                return '<span data-filter="'. $row->properties['methodType'].'"><div class="badge badge-method badge-method-'.strtolower($row->properties['methodType']).'">'. $row->properties['methodType'].'</div></span>';
            })
            ->editColumn('route', function ($row){
                return $row->properties['route'];
            })
            ->editColumn('referer', function ($row){
                return $row->properties['referer'];
            })
            ->editColumn('ip', function ($row){
                return $row->properties['ipAddress'];
            })
            ->editColumn('created_at', function ($row){
                return $row->created_at->diffForHumans();
            })
            ->rawColumns(['method', 'name'])
            ->make(true);
    }
}
