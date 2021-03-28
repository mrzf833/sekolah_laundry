<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Outlet;
use App\Models\Paket;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class AdminPaketController extends Controller
{
    public function index()
    {
        $outlets = Outlet::get();
        return view('admin.paket.index',[
            'outlets' => $outlets
        ]);
    }

    public function datatable()
    {
        $query = Paket::with('outlets')
        ->select('pakets.*');
        
        $datatable =  DataTables::of($query)
        ->addColumn('action', function($data){
            $button = '<button class="btn btn-warning mr-2 btn-edit-paket"">Edit</button>';
            $button .= '<button class="btn btn-danger btn-delete-paket"">Delete</button>';
            return $button;
        });

        return $datatable->make(true);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'outlet' => 'required|exists:outlets,id',
            'jenis' => 'required|in:kiloan,selimut,bed_cover,kaos,lain',
            'nama' => 'required|max:100',
            'harga' => 'required',
        ]);

        DB::beginTransaction();
        try{
            Paket::create([
                'outlet_id' => $request->outlet,
                'jenis' => $request->jenis,
                'nama_paket' => $request->nama,
                'harga' => $request->harga,
            ]);

            DB::commit();
            return redirect()->route('admin.paket.index')->with('success', 'Paket berhasil di tambahkan');
        }catch(Exception $e){
            DB::rollBack();
            return redirect()->route('admin.paket.index')->with('failed', $e->getMessage());
        }
    }

    public function edit(Request $request, $paket_id)
    {
        $paket = Paket::findOrfail($paket_id);
        $this->validate($request,[
            'outlet' => 'required|exists:outlets,id',
            'jenis' => 'required|in:kiloan,selimut,bed_cover,kaos,lain',
            'nama' => 'required|max:100',
            'harga' => 'required',
        ]);

        DB::beginTransaction();
        try{
            $paket->update([
                'outlet_id' => $request->outlet,
                'jenis' => $request->jenis,
                'nama_paket' => $request->nama,
                'harga' => $request->harga,
            ]);

            DB::commit();
            return redirect()->route('admin.paket.index')->with('success', 'Paket berhasil di perbarui');
        }catch(Exception $e){
            DB::rollBack();
            return redirect()->route('admin.paket.index')->with('failed', $e->getMessage());
        }
    }

    public function destroy($paket_id)
    {
        $paket = Paket::findOrfail($paket_id);

        DB::beginTransaction();
        try{
            $paket->delete();

            DB::commit();
            return redirect()->route('admin.paket.index')->with('success', 'Paket berhasil di hapus');
        }catch(Exception $e){
            DB::rollBack();
            return redirect()->route('admin.paket.index')->with('failed', $e->getMessage());
        }
    }
}
