<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    // Create Account
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login' => 'required|string|max:20',
            'password' => 'required|string|max:40',
            'phone' => 'nullable|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        try {
            $account = Account::create($request->all());
            return response()->json($account, 201);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['message' => 'Internal Server Error'], 500);
        }
    }

    // Get All Accounts with Pagination
    public function index(Request $request)
    {
        $accounts = Account::paginate($request->get('per_page', 10));
        return response()->json($accounts);
    }

    // Get Single Account
    public function show($id)
    {
        $account = Account::find($id);
        if (!$account) {
            return response()->json(['message' => 'Account not found'], 404);
        }
        return response()->json($account);
    }

    // Update Account
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'login' => 'sometimes|string|max:20',
            'password' => 'sometimes|string|max:40',
            'phone' => 'nullable|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $account = Account::find($id);
        if (!$account) {
            return response()->json(['message' => 'Account not found'], 404);
        }

        try {
            $account->update($request->all());
            return response()->json($account);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['message' => 'Internal Server Error'], 500);
        }
    }

    // Delete Account
    public function destroy($id)
    {
        $account = Account::find($id);
        if (!$account) {
            return response()->json(['message' => 'Account not found'], 404);
        }

        try {
            $account->delete();
            return response()->json(['message' => 'Account deleted successfully']);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['message' => 'Internal Server Error'], 500);
        }
    }
}
