<?php

namespace App\Http\Controllers;

use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function Seeder()
    {
        try {
            Artisan::call('db:seed', ['--class' => UserSeeder::class]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Somthig went wrong!']);
        }
        if (Artisan::output()) {
            return response()->json(['message' => 'Admin created successfully!']);
        }
    }
    public function index()
    {
        return response()->json(User::all());
    }
    public function store(Request $request)
    {
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role = $request->role;
            $user->save();
            return response()->json(['message' => 'User created successfully!']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Somthig went wrong!']);
        }
    }
    public function show($id)
    {
        return response()->json(User::find($id));
    }
    public function update(Request $request, $id)
    {
        try {
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role = $request->role;
            $user->save();
            return response()->json(['message' => 'User updated successfully!']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Somthig went wrong!']);
        }
    }
    public function destroy($id)
    {

        
        if (User::destroy($id)) {
            return response()->json(['message' => 'User deleted successfully!']);
        } else {
            return response()->json(['message' => 'User not found!']);
        }
    }
}
