<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ExamDate;
use App\Models\ExamDateUser;

class CheckExamDateRegistration
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        $exam = $request->route('exam');
        $date = $request->route('date');

        $user = Auth::user();
        $examDate = ExamDate::where('exam_id', $exam->id)->where('id', $date->id)->first();
        if (!$examDate) {
            abort(404);
        }

        $startCarbonDate = Carbon::createFromFormat('Y-m-d', $examDate->exam);
        $endCarbonDate = Carbon::createFromFormat('Y-m-d', $examDate->end);
        $currentDate = Carbon::createFromFormat('Y-m-d', date('Y-m-d'));

        if (!$currentDate->between($startCarbonDate, $endCarbonDate)) {
            abort(404);
        }

        $userRegistered = ExamDateUser::where('exam_date_id', $examDate->id)->where('user_id', $user->id)->exists();

        if ($userRegistered) {
            return $next($request);
        } else {
            abort(403);
        }
    }
}
