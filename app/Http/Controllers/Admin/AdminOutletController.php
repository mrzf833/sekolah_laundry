<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Outlet;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class AdminOutletController extends Controller
{
    public function index()
    {
        return view('admin.outlet.index');
    }

    public function datatable()
    {
        $query = Outlet::query();
        
        $datatable =  DataTables::of($query)
        ->addColumn('action', function($data){
            $button = '<button class="btn btn-warning mr-2 btn-edit-outlet"">Edit</button>';
            $button .= '<button class="btn btn-danger btn-delete-outlet"">Delete</button>';
            return $button;
        });

        return $datatable->make(true);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'nama' => 'required|max:100',
            'alamat' => 'required',
            'tlp' => 'required|digits_between:5,15',
        ]);

        DB::beginTransaction();
        try{
            Outlet::create([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'tlp' => $request->tlp,
            ]);

            DB::commit();
            return redirect()->route('admin.outlet.index')->with('success', 'Outlet berhasil di tambahkan');
        }catch(Exception $e){
            DB::rollBack();
            return redirect()->route('admin.outlet.index')->with('failed', $e->getMessage());
        }
    }

    public function edit(Request $request, $outlet_id)
    {
        $outlet = Outlet::findOrfail($outlet_id);
        $this->validate($request,[
            'nama' => 'required|max:100',
            'alamat' => 'required',
            'tlp' => 'required|digits_between:5,15',
        ]);

        DB::beginTransaction();
        try{
            $outlet->update([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'tlp' => $request->tlp,
            ]);

            DB::commit();
            return redirect()->route('admin.outlet.index')->with('success', 'Outlet berhasil di perbarui');
        }catch(Exception $e){
            DB::rollBack();
            return redirect()->route('admin.outlet.index')->with('failed', $e->getMessage());
        }
    }

    public function destroy($outlet_id)
    {
        $outlet = Outlet::findOrfail($outlet_id);

        DB::beginTransaction();
        try{
            $outlet->delete();

            DB::commit();
            return redirect()->route('admin.outlet.index')->with('success', 'Outlet berhasil di hapus');
        }catch(Exception $e){
            DB::rollBack();
            return redirect()->route('admin.outlet.index')->with('failed', $e->getMessage());
        }
    }
}
