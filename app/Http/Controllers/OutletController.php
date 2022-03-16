<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use App\Models\Transaksi;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;


class OutletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $result = Outlet::with(['user'])->get();

            return response([
                "message" => "success get outlet",
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
                "id_user" => "required|integer",
                "alamat" => "required|string"
            ]);

            if ($validator->fails()) {
                return response([
                    "message" => "invalid field",
                    "err" => $validator->errors()
                ], 422);
            }

            $result = Outlet::create([
                "id_user" => $request->id_user,
                "alamat" => $request->alamat
            ]);

            return response([
                "message" => "success add outlet",
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

    public function information($id)
    {
        try {


            $outletList = Outlet::where("id_user", $id)->get();
            $tempOutlet = $outletList;

            for ($i=0; $i < count($outletList) ; $i++) { 
                $transaksi = Transaksi::where("id_outlet", $outletList[$i]->id_outlet)->get();

                $countTransaksi = count($transaksi);

                $tempOutlet[$i]->jumlahTransaksi = $countTransaksi;
            }

            return response([
                "message" => "success get outlet",
                "data" => $tempOutlet
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
                "id_user" => "required|integer",
                "alamat" => "required|string"
            ]);

            if ($validator->fails()) {
                return response([
                    "message" => "invalid field",
                    "err" => $validator->errors()
                ], 422);
            }

            $result = Outlet::where("id_outlet", $id)->update([
                "id_user" => $request->id_user,
                "alamat" => $request->alamat
            ]);

            return response([
                "message" => "success update outlet",
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

            $result = Outlet::where("id_outlet", $id)->delete();

            return response([
                "message" => "success delete outlet",
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
