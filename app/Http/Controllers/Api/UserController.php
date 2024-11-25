<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public function index()
    {
        try {
            $users = User::all();
            return response()->json([
                'status' => true,
                'message' => "Users found",
                'data' => $users
            ], 200);    
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => "Error when trying to find users",
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function show(string $id)
    {
        try {
            $user = User::find($id);
            return response()->json([
                'status' => true,
                'message' => "User found",
                'data' => $user
            ], 200);
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => "Error when trying to find user",
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function store(UserRequest $request)
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'message' => $request->message
            ]);
            return response()->json([
                'status' => true,
                'message' => "User create successfully",
                'data' => $user
            ], 201);    
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => "Error when trying to register user",
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function update(UserRequest $request, User $user)
    {
        try {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'message' => $request->message
            ]);
            return response()->json([
                'status' => true,
                'message' => "User updated successfully",
                'data' => $user
            ], 200);
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => "Error when trying to update user",
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function destroy(string $id)
    {
        try {
            User::destroy($id);
            return response()->json([
                'status' => true,
                'message' => "User deleted successfully",
            ], 204);
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => "Error when trying to delete user",
                'error' => $e->getMessage()
            ], 400);
        }
    }
}
