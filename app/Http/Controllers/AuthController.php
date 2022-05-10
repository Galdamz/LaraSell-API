<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function register(Request $request)
    {

        $role_id = Auth::user()->role_id;

        if ($role_id !== 1) {
            return response([
                "message" => "Oh No... I't Looks like you can't do that."
            ], 403);
        }
        $fields = $request->validate([
            "name" => "required|string",
            "email" => "required|string|unique:users,email",
            "password" => "required|string|min:8|confirmed",
            "role" => "required|integer"
        ]);

        $user = User::create([
            "name" => $fields["name"],
            "email" => $fields["email"],
            "role_id" => $fields["role"],
            "password" => bcrypt($fields["password"])
        ]);

        $token = $user->createToken("x-access-token")->plainTextToken;

        $response = [
            "user" => $user,
            "x-access-token" => $token,
        ];

        return response($response, 201);
    }


    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return (["message" => "Logged-out"]);
    }

    public function getUserInfo(Request $request)
    {
        $id = Auth::id();
        $role_id = Auth::user()->role_id;

        return response(["id" => $id, "role_id" => $role_id], 200);
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            "email" => "required|string",
            "password" => "required"
        ]);

        $user = User::where("email", $fields["email"])->first();

        if (!$user || !Hash::check($fields["password"], $user->password)) {
            return response([
                "message" => "Bad Credential"
            ], 401);
        }
        $token = $user->createToken("x-access-token")->plainTextToken;

        $response = [
            "user" => $user,
            "x-access-token" => $token,
        ];

        return response($response, 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
