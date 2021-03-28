<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Paket;
use App\Models\Transaksi;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class AdminTransaksiDetailController extends Controller
{
    public function index($transaksi_id)
    {
        $transaksi = Transaksi::findOrfail($transaksi_id);
        $pakets = Paket::get();
        $semua_paket = $transaksi->pakets()->sum(DB::raw('harga * qty'));
        return view('admin.transaksi-detail.index',[
            'transaksi' => $transaksi,
            'semua_paket' => $semua_paket,
            'pakets' => $pakets
        ]);
    }

    public function datatable($transaksi_id)
    {
        $query = Transaksi::findOrfail($transaksi_id)->detail_transaksis()->with('pakets')
        ->select('detail_transaksis.*');

        $datatable = DataTables::of($query)
        ->addColumn('action', function($data){
            $button = '<button class="btn btn-warning mr-2 btn-edit-detail"">Edit</button>';
            $button .= '<button class="btn btn-danger btn-delete-detail"">Delete</button>';
            return $button;
        });

        return $datatable->make(true);
    }

    public function edit(Request $request, $transaksi_id, $detail_transaksi_id)
    {
        $transaksi = Transaksi::findOrfail($transaksi_id);
        $transaksi_detail = $transaksi->detail_transaksis()->findOrFail($detail_transaksi_id);
        $this->validate($request,[
            'paket' => 'required|exists:pakets,id',
            'qty' => 'required|numeric|min:1',
            'keterangan' => 'nullable'
        ]);

        try{
            $transaksi_detail->update([
                'paket_id' => $request->paket,
                'qty' => $request->qty,
                'keterangan' => $request->keterangan
            ]);
            DB::commit();
            return redirect()->route('admin.transaksi.detail.index', $transaksi_id)->with('success', 'data berhasil di update');
        }catch(Exception $e){
            DB::rollBack();
            return redirect()->route('admin.transaksi.detail.index', $transaksi_id)->with('failed', $e->getMessage());
        }
    }

    public function destroy($transaksi_id, $detail_transaksi_id)
    {
        $transaksi = Transaksi::findOrfail($transaksi_id);
        $transaksi_detail = $transaksi->detail_transaksis()->findOrFail($detail_transaksi_id);

        try{
            $transaksi_detail->delete();
            DB::commit();
            return redirect()->route('admin.transaksi.detail.index', $transaksi_id)->with('success', 'data berhasil di hapus');
        }catch(Exception $e){
            DB::rollBack();
            return redirect()->route('admin.transaksi.detail.index', $transaksi_id)->with('failed', $e->getMessage());
        }
    }
}
