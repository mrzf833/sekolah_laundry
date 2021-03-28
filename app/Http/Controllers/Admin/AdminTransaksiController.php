<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Paket;
use App\Models\Member;
use App\Models\Outlet;
use PDF;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\DetailTransaksi;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminTransaksiController extends Controller
{
    public function index()
    {
        $outlets = Outlet::get();
        $members = Member::get();
        $pakets = Paket::get();
        return view('admin.transaksi.index',[
            'pakets' => $pakets,
            'members' => $members,
            'outlets' => $outlets
        ]);
    }

    public function search_paket(Request $request)
    {
        $paket = Paket::findOrfail($request->paket_id)->load('outlets');

        return response()->json($paket);
    }

    public function store(Request $request)
    {
        if(count($request->paket) < 1){
            return redirect()->route('admin.transaksi.index')->with('failed', 'paket belum ada');
        }

        $this->validate($request,[
            'member_transaksi' => 'required|exists:members,id',
            'outlet_transaksi' => 'required|exists:outlets,id',
            'tgl_transaksi' => 'required|date',
            'batas_waktu_transaksi' => 'required|date',
            'tgl_bayar_transaksi' => 'required|date',
            'biaya_tambahan_transaksi' => 'required|numeric|min:0',
            'diskon_transaksi' => 'required|numeric|min:0',
            'pajak_transaksi' => 'required|numeric|min:0',
            'status_transaksi' => 'required|in:baru,proses,selesai,diambil',
            'dibayar_transaksi' => 'required|in:dibayar,belum_dibayar',
        ]);

        foreach($request->paket as $paket){
            $paket_request = new Request($paket);
            $this->validate($paket_request,[
                'paket_id' => 'required|exists:pakets,id',
                'qty' => 'required|numeric|min:0',
                'keterangan' => 'nullable'
            ]);
        }

        DB::beginTransaction();
        try{
            $transaksi = Transaksi::create([
                'outlet_id' => $request->outlet_transaksi,
                'member_id' => $request->member_transaksi,
                'tgl' => $request->tgl_transaksi,
                'batas_waktu' => $request->batas_waktu_transaksi,
                'tgl_bayar' => $request->tgl_bayar_transaksi,
                'biaya_tambahan' => $request->biaya_tambahan_transaksi,
                'diskon' => $request->diskon_transaksi,
                'pajak' => $request->pajak_transaksi,
                'status' =>$request->status_transaksi,
                'dibayar' => $request->dibayar_transaksi,
                'user_id' => auth()->id()
            ]);

            $invoice = str_pad($transaksi->id,10,"0",STR_PAD_LEFT);

            $transaksi->update([
                'kode_invoice' => $invoice
            ]);

            foreach($request->paket as $paket){
                DetailTransaksi::create([
                    'transaksi_id' => $transaksi->id,
                    'paket_id' => $paket['paket_id'],
                    'qty' => $paket['qty'],
                    'keterangan' => $paket['keterangan']
                ]);
            }

            DB::commit();
            return redirect()->route('admin.transaksi.index')->with('success', 'transaksi berhasil di tambahkan');
        }catch(Exception $e){
            DB::rollBack();
            return redirect()->route('admin.transaksi.index')->with('failed', $e->getMessage());
        }
    }

    public function edit(Request $request, $transaksi_id)
    {

        $transaksi = Transaksi::findOrfail($transaksi_id);
        $this->validate($request,[
            'member' => 'required|exists:members,id',
            'outlet' => 'required|exists:outlets,id',
            'tgl' => 'required|date',
            'batas_waktu' => 'required|date',
            'tgl_bayar' => 'required|date',
            'biaya_tambahan' => 'required|numeric|min:0',
            'diskon' => 'required|numeric|min:0',
            'pajak' => 'required|numeric|min:0',
            'status' => 'required|in:baru,proses,selesai,diambil',
            'dibayar' => 'required|in:dibayar,belum_dibayar',
        ]);

        DB::beginTransaction();
        try{
            $transaksi->update([
                'outlet_id' => $request->outlet,
                'member_id' => $request->member,
                'tgl' => $request->tgl,
                'batas_waktu' => $request->batas_waktu,
                'tgl_bayar' => $request->tgl_bayar,
                'biaya_tambahan' => $request->biaya_tambahan,
                'diskon' => $request->diskon,
                'pajak' => $request->pajak,
                'status' =>$request->status,
                'dibayar' => $request->dibayar,
                'user_id' => auth()->id()
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'transaksi berhasil di perbarui');
        }catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

    public function destroy($transaksi_id)
    {
        $transaksi = Transaksi::findOrfail($transaksi_id);

        DB::beginTransaction();
        try{
            $transaksi->delete();

            DB::commit();
            return redirect()->back()->with('success', 'transaksi berhasil di hapus');
        }catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }

    public function invoice_print($transaksi_id)
    {
        $transaksi = Transaksi::findOrfail($transaksi_id)->load(['members', 'outlets']);
        $detail_transaksis = $transaksi->detail_transaksis()->with('pakets')->get();
        $semua_paket = $transaksi->pakets()->sum(DB::raw('harga * qty'));
        return view('admin.invoice',[
            'transaksi' => $transaksi,
            'detail_transaksis' => $detail_transaksis,
            'no' => 1,
            'semua_paket' => $semua_paket
        ]);
    }

    public function invoice_pdf($transaksi_id)
    {
        $transaksi = Transaksi::findOrfail($transaksi_id)->load(['members', 'outlets']);
        $detail_transaksis = $transaksi->detail_transaksis()->with('pakets')->get();
        $semua_paket = $transaksi->pakets()->sum(DB::raw('harga * qty'));

        $pdf = PDF::loadView('admin.invoice', [
            'transaksi' => $transaksi,
            'detail_transaksis' => $detail_transaksis,
            'no' => 1,
            'semua_paket' => $semua_paket
        ])->setPaper('a4', 'landscape');
        return $pdf->stream('invoice.pdf');
    }
}
