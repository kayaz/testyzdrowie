<?php

namespace App\Http\Controllers\Admin\Exam;

use App\Http\Controllers\Controller;

use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

// CMS
use App\Models\ExamDateUser;

class UserController extends Controller
{
    public function update(Request $request)
    {
        if ($request->ajax()) {
            try {
                $validatedData = $request->validate([
                    'dataId' => 'required|integer',
                    'isChecked' => 'required|boolean',
                ]);

                $dataId = $validatedData['dataId'];
                $isChecked = $validatedData['isChecked'];

                $examDateUser = ExamDateUser::find($dataId);

                if ($examDateUser) {
                    $examDateUser->active = $isChecked;
                    $examDateUser->save();
                }

                return response()->json(['success' => true]);
            } catch (ValidationException $e) {
                $errors = $e->errors();
                return new JsonResponse(['errors' => $errors], 422);
            }
        }

        return response()->json(['error' => 'Invalid request.'], 400);
    }
}
