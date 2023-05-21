<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// CMS
use App\Models\ExamDate;
use App\Models\ExamDateUser;

class CheckExamRegistration
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $exam = $request->route('exam');
        $date = $request->route('date');

        $user = Auth::user();
        $examDate = ExamDate::where('exam_id', $exam->id)->where('id', $date->id)->first();
        if (!$examDate) {
            abort(404);
        }
        $userRegistered = ExamDateUser::where('exam_date_id', $examDate->id)->where('user_id', $user->id)->where('active', '=', 1)->exists();

        if ($userRegistered) {
            return $next($request);
        } else {
            abort(403);
        }
    }
}
