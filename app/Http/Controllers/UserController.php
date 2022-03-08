<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $result = User::get();

            return response([
                "message" => "success get user",
                "data" => $result
            ], 200);
        } catch (\Exception $th) {
            return response([
                "message" => "internal error",
                "err" => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        try {

            $validator = Validator::make($request->all(), [
                "nama_user" => "required|string",
                "username" => "required|string",
                "password" => "required|string",
                "role" => "required|string"
            ]);

            if ($validator->fails()) {
                return response([
                    "message" => "invalid field",
                    "err" => $validator->errors()
                ], 422);
            }

            $result = User::create([
                "nama_user" => $request->nama_user,
                "username" => $request->username,
                "password" => md5($request->password),
                "role" => $request->role
            ]);

            return response([
                "message" => "success add user",
                "data" => $result
            ], 200);

        } catch (\Exception $th) {
            return response([
                "message" => "internal error",
                "err" => $th->getMessage()
            ], 500);
        }
    

    }

    public function login(Request $request)
    {
        try {

            $user = User::where("username", $request->username)
            ->where("password", md5($request->password))->first();

            if($user == null) {
                return response([
                    "message" => "incorrect username or password",
                    "data" => null
                ], 403);
            }

            // insert token
            $token = sha1($request->username).md5(time());
            User::where("id_user", $user['id_user'])->update(["token"=>$token]);

            $customPayload = [
                "token"=>$token,
                "id_user"=>$user["id_user"],
                "role"=>$user["role"]
            ];

            return response([
                "message" => "success login",
                "data" => $customPayload
            ], 200);
        } catch (\Exception $th) {
            return response([
                "message" => "internal error",
                "err" => $th->getMessage()
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        try {

            $token = $request->get("token");

            if ($token == null) {
                return response([
                    "message" => "token not found",
                    "data" => null
                ], 403);
            }

            $result = User::where("token", $token)->update(["token"=>null]);

            return response([
                "message" => "success logout",
                "data" => $result
            ], 200);
        } catch (\Exception $th) {
            return response([
                "message" => "internal error",
                "err" => $th->getMessage()
            ], 500);
        }
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        try {

            $validator = Validator::make($request->all(), [
                "nama_user" => "required|string",
                "username" => "required|string",
                "role" => "required|string"
            ]);

            if ($validator->fails()) {
                return response([
                    "message" => "invalid field",
                    "err" => $validator->errors()
                ], 422);
            }

            $result = User::where("id_user", $id)->update([
                "nama_user" => $request->nama_user,
                "username" => $request->username,
                "role" => $request->role
            ]);

            return response([
                "message" => "success update user",
                "data" => $result
            ], 200);
        } catch (\Exception $th) {
            return response([
                "message" => "internal error",
                "err" => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            $result = User::where("id_user", $id)->delete();

            return response([
                "message" => "success delete user",
                "data" => $result
            ], 200);

        } catch (\Exception $th) {
            return response([
                "message" => "internal error",
                "err" => $th->getMessage()
            ], 500);
        }
    }
}
