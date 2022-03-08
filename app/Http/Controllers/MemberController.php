<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $result = Member::get();

            return response([
                "message" => "success get member",
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
                "nama_member" => "required|string",
                "alamat" => "required|string",
                "jenis_kelamin" => "required|string",
                "telp" => "required|string"
            ]);

            if ($validator->fails()) {
                return response([
                    "message" => "invalid field",
                    "err" => $validator->errors()
                ], 422);
            }

            $result = Member::create([
                "nama_member" => $request->nama_member,
                "alamat" => $request->alamat,
                "jenis_kelamin" => $request->jenis_kelamin,
                "telp" => $request->telp
            ]);

            return response([
                "message" => "success add member",
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
        try {

            $result = Member::where("id_member", $id)->first();

            return response([
                "message" => "success get one member",
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
                "nama_member" => "required|string",
                "alamat" => "required|string",
                "jenis_kelamin" => "required|string",
                "telp" => "required|string"
            ]);

            if ($validator->fails()) {
                return response([
                    "message" => "invalid field",
                    "err" => $validator->errors()
                ], 422);
            }

            $result = Member::where("id_member", $id)->update([
                "nama_member" => $request->nama_member,
                "alamat" => $request->alamat,
                "jenis_kelamin" => $request->jenis_kelamin,
                "telp" => $request->telp
            ]);

            return response([
                "message" => "success update member",
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

            $result = Member::where("id_member", $id)->delete();

            return response([
                "message" => "success delete member",
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
