<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// CMS
use App\Models\ExamDate;
use App\Models\ExamDateUser;
use Illuminate\Support\Facades\Log;

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

        if (is_null($exam) || is_null($date)) {
            Log::error('Exam or date is null', ['exam' => $exam, 'date' => $date]);
            abort(404, 'Exam or date not found.');
        }

        $user = Auth::user();
        if (!$user) {
            Log::error('User not authenticated');
            abort(403, 'User not authenticated.');
        }

        $examDate = ExamDate::where('exam_id', $exam->id)->where('id', $date->id)->first();
        if (!$examDate) {
            Log::error('Exam date not found', ['exam_id' => $exam->id, 'date_id' => $date->id]);
            abort(404, 'Exam date not found.');
        }

        $userRegistered = ExamDateUser::where('exam_date_id', $examDate->id)
            ->where('user_id', $user->id)
            ->where('active', 1)
            ->exists();

        if ($userRegistered) {
            return $next($request);
        } else {
            Log::error('User not registered for the exam date', ['exam_date_id' => $examDate->id, 'user_id' => $user->id]);
            abort(403, 'User not registered for the exam date.');
        }
    }
}
