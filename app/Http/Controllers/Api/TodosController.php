<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Constants\ErrorCodes;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TodosController extends Controller
{
    public function findAll()
    {
        return Todo::paginate();
    }

    public function find($id)
    {
        $todo = Todo::find($id);
        if (!$todo) {
            return response()->json(["code" => ErrorCodes::NOT_FOUND], 404);
        }
        return $todo;
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required|string|max:255',
            'completed' => 'boolean',
        ]);
        if ($validator->fails()) {
            return response(['code' => ErrorCodes::VALIDATION_FAILED], 400);
        }

        try {
            $todo = Todo::create($request->all());
            return $todo;
        } catch (\Exception $e) {
            return response(['code' => ErrorCodes::UNKNOW_ERROR], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required|string|max:255',
            'completed' => 'boolean',
        ]);
        if ($validator->fails()) {
            return response(['code' => ErrorCodes::VALIDATION_FAILED], 400);
        }

        $todo = Todo::find($id);
        if (!$todo) {
            return response(['code' => ErrorCodes::NOT_FOUND], 404);
        }
        if ($todo->update($request->all())) {
            return $todo;
        }
        return response(['code' => ErrorCodes::UNKNOW_ERROR], 500);
    }

    public function delete($id)
    {
        $todo = Todo::find($id);
        if (!$todo) {
            return response(['code' => ErrorCodes::NOT_FOUND], 404);
        }
        if ($todo->delete()) {
            return response()->noContent();
        };
        return response(['code' => ErrorCodes::UNKNOW_ERROR], 500);
    }
}
