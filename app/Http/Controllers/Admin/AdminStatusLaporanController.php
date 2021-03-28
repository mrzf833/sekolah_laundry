<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Outlet;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class AdminStatusLaporanController extends Controller
{
    public function baru()
    {
        $outlets = Outlet::get();
        $members = Member::get();

        // [$outlets, $members] = Octane
        // return ;
        return view('admin.status-laporan.baru',[
            'members' => $members,
            'outlets' => $outlets
        ]);
    }

    public function baru_datatable()
    {
        $query = Transaksi::with(['outlets', 'members', 'users'])
        ->where('status', 'baru')
        ->select('transaksis.*');

        $datatable = DataTables::eloquent($query)
        ->addColumn('action', function($data){
            $button = '<a href="' . route('admin.transaksi.detail.index', $data->id) . '" class="btn btn-info mr-2 btn-detail">Detail</a>';
            $button .= '<button class="btn btn-warning mr-2 btn-edit">Edit</a>';
            $button .= '<button class="btn btn-danger mr-2 btn-delete">Delete</button>';
            return $button;
        });

        return $datatable->make(true);
    }
}
