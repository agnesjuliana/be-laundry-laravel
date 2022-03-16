<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\Paket;
use App\Models\Transaksi;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $result = Transaksi::with(["member","user","outlet","detail","detail.paket"])->get();

            return response([
                "message" => "success get all transaksi",
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
                "id_member" => "required|integer",
                "id_user" => "required|integer",
                "id_outlet" => "required|integer",
                "list_paket"  => "required"
            ]);

            if ($validator->fails()) {
                return response([
                    "message" => "invalid field",
                    "err" => $validator->errors()
                ], 422);
            }

            $Date = date('Y-m-d');
            $customPayload = [
                "id_member" => $request->id_member,
                "id_user" => $request->id_user,
                "id_outlet" => $request->id_outlet,
                "tgl_diterima" => $Date,
                "batas_waktu" => date('Y-m-d', strtotime($Date . ' + 2 days')),
                "total" => 0
            ];

            $transaksi = Transaksi::create($customPayload);

            // prepare detail transaksi
            $listPaket = $request->list_paket;
            for ($i = 0; $i < count($listPaket); $i++) {
                $listPaket[$i]['id_transaksi'] = $transaksi->id_transaksi;

                // find harga paket untuk dijumlah total
                $paket = Paket::where("id_paket", $listPaket[$i]['id_paket'])->first();
                $totalHargaPaket = $paket-> harga * $listPaket[$i]['qty'];
                $customPayload['total'] += $totalHargaPaket;
            }

            // insert detail transaksi
            $detail = Detail::insert($listPaket);

            return response([
                "message" => "success add transaksi",
                "data" => $customPayload
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

            $result = Transaksi::where("id_transaksi", $id)
            ->with(["member","user","outlet","detail","detail.paket"])->first();

            return response([
                "message" => "success get one transaksi",
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
    public function updateBayar(Request $request, $id)
    {
        try {

            $result = Transaksi::where("id_transaksi", $id)
                ->update([
                    "tgl_bayar"=>date('Y-m-d'),
                    "dibayar"=>"dibayar"
                ]);

            return response([
                "message" => "success bayar transaksi",
                "data" => $result
            ], 200);
        } catch (\Exception $th) {
            return response([
                "message" => "internal error",
                "err" => $th->getMessage()
            ], 500);
        }
    }

    public function updateStatus(Request $request, $id)
    {
        try {

            $result = Transaksi::where("id_transaksi", $id)
                ->update([
                    "status" => $request->status
                ]);

            return response([
                "message" => "success update status transaksi",
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
        //
    }
}
