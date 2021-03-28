<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class AdminMemberController extends Controller
{
    public function index()
    {
        return view('admin.member.index');
    }

    public function datatable()
    {
        $query = Member::query();
        
        $datatable =  DataTables::of($query)
        ->addColumn('action', function($data){
            $button = '<button class="btn btn-warning mr-2 btn-edit-member"">Edit</button>';
            $button .= '<button class="btn btn-danger btn-delete-member"">Delete</button>';
            return $button;
        });

        return $datatable->make(true);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'nama' => 'required|max:100',
            'alamat' => 'required',
            'jenis_kelamin' => 'required|in:L,P',
            'tlp' => 'required|digits_between:5,15'
        ]);

        DB::beginTransaction();
        try{
            Member::create([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tlp' => $request->tlp
            ]);

            DB::commit();
            return redirect()->route('admin.member.index')->with('success', 'Member berhasil di tambahkan');
        }catch(Exception $e){
            DB::rollBack();
            return redirect()->route('admin.member.index')->with('failed', $e->getMessage());
        }
    }

    public function edit(Request $request, $member_id)
    {
        $member = Member::findOrfail($member_id);
        $this->validate($request,[
            'nama' => 'required|max:100',
            'alamat' => 'required',
            'jenis_kelamin' => 'required|in:L,P',
            'tlp' => 'required|digits_between:5,15'
        ]);

        DB::beginTransaction();
        try{
            $member->update([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tlp' => $request->tlp
            ]);

            DB::commit();
            return redirect()->route('admin.member.index')->with('success', 'Member berhasil di perbarui');
        }catch(Exception $e){
            DB::rollBack();
            return redirect()->route('admin.member.index')->with('failed', $e->getMessage());
        }
    }

    public function destroy($member_id)
    {
        $member = Member::findOrfail($member_id);
        DB::beginTransaction();
        try{
            $member->delete();

            DB::commit();
            return redirect()->route('admin.member.index')->with('success', 'Member berhasil di hapus');
        }catch(Exception $e){
            DB::rollBack();
            return redirect()->route('admin.member.index')->with('failed', $e->getMessage());
        }
    }
}
