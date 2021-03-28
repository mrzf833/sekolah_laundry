<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Outlet;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class AdminUserController extends Controller
{
    public function index()
    {
        $outlets = Outlet::get();
        return view('admin.user.index',[
            'outlets' => $outlets
        ]);
    }

    public function datatable()
    {
        $query = User::with('outlets')
        ->select('users.*');
        
        $datatable =  DataTables::of($query)
        ->addColumn('action', function($data){
            $button = '<button class="btn btn-warning mr-2 btn-edit-user"">Edit</button>';
            $button .= '<button class="btn btn-danger btn-delete-user"">Delete</button>';
            return $button;
        });

        return $datatable->make(true);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'nama' => 'required|max:100',
            'username' => 'required|unique:users,username',
            'password' => 'required',
            'outlet' => 'required|exists:outlets,id',
            'role' => 'required|in:admin,kasir,owner'
        ]);

        DB::beginTransaction();
        try{
            User::create([
                'nama' => $request->nama,
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'outlet_id' => $request->outlet
            ]);

            DB::commit();
            return redirect()->route('admin.user.index')->with('success', 'User berhasil di tambahkan');
        }catch(Exception $e){
            DB::rollBack();
            return redirect()->route('admin.user.index')->with('failed', $e->getMessage());
        }
    }

    public function edit(Request $request, $user_id)
    {
        $user = User::findOrfail($user_id);
        $this->validate($request,[
            'nama' => 'required|max:100',
            'username' => 'required|unique:users,username,' . $user_id,
            'password' => 'nullable',
            'outlet' => 'required|exists:outlets,id',
            'role' => 'required|in:admin,kasir,owner'
        ]);

        DB::beginTransaction();
        try{
            $user->update([
                'nama' => $request->nama,
                'username' => $request->username,
                'outlet_id' => $request->outlet,
                'role' => $request->role
            ]);

            if($request->password){
                $user->update([
                    'password' => bcrypt($request->password),
                ]);
            }

            DB::commit();
            return redirect()->route('admin.user.index')->with('success', 'User berhasil di perbarui');
        }catch(Exception $e){
            DB::rollBack();
            return redirect()->route('admin.user.index')->with('failed', $e->getMessage());
        }
    }

    public function destroy($user_id)
    {
        $user = User::findOrfail($user_id);

        DB::beginTransaction();
        try{
            $user->delete();

            DB::commit();
            return redirect()->route('admin.user.index')->with('success', 'User berhasil di hapus');
        }catch(Exception $e){
            DB::rollBack();
            return redirect()->route('admin.user.index')->with('failed', $e->getMessage());
        }
    }
}
