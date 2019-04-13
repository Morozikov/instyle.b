<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserController extends Controller
{
    //

    public function index()
    {
        return User::with('userData')->get();
    }

    public function show($id)
    {
        $user = User::with('userData')->find($id);
            return $user;
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'api_token' => Str::random(60),
        ]);
        return response()->json($user, 201);
    }

    public function update(Request $request)
    {

        $user = Auth::user();
        $user->update($request->all());
        $user->userData->update($request->all());
        if ($request->has('city_id')) {
            //
            $user->userData->city_id = $request->input('city_id');
        }

        return response()->json($user, 200);
    }

    public function delete()
    {
        $user = Auth::user();
        $user->delete();

        return response()->json(null, 204);
    }

    public function auth(Request $request){

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            $user = Auth::user();
            return response()->json($user->api_token, 200);
        }
        else{
            return response()->json('Not valid email or password1', 500);
        }
    }


}
