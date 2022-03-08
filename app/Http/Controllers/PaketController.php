<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;


class PaketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $result = Paket::get();

            return response([
                "message" => "success get paket",
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
                "jenis" => "required|string",
                "harga" => "required|integer"
            ]);

            if ($validator->fails()) {
                return response([
                    "message" => "invalid field",
                    "err" => $validator->errors()
                ], 422);
            }

            $result = Paket::create([
                "jenis" => $request->jenis,
                "harga" => $request->harga
            ]);

            return response([
                "message" => "success add paket",
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
                "jenis" => "required|string",
                "harga" => "required|integer"
            ]);

            if ($validator->fails()) {
                return response([
                    "message" => "invalid field",
                    "err" => $validator->errors()
                ], 422);
            }

            $result = Paket::where("id_paket", $id)->update([
                "jenis" => $request->jenis,
                "harga" => $request->harga
            ]);

            return response([
                "message" => "success update paket",
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

            $result = Paket::where("id_paket", $id)->delete();

            return response([
                "message" => "success delete paket",
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
