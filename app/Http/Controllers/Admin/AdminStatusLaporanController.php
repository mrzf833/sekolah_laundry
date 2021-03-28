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

    public function proses()
    {
        $outlets = Outlet::get();
        $members = Member::get();
        return view('admin.status-laporan.proses',[
            'members' => $members,
            'outlets' => $outlets
        ]);
    }

    public function proses_datatable()
    {
        $query = Transaksi::with(['outlets', 'members', 'users'])
        ->where('status', 'proses')
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

    public function selesai()
    {
        $outlets = Outlet::get();
        $members = Member::get();
        return view('admin.status-laporan.selesai',[
            'members' => $members,
            'outlets' => $outlets
        ]);
    }

    public function selesai_datatable()
    {
        $query = Transaksi::with(['outlets', 'members', 'users'])
        ->where('status', 'selesai')
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

    public function diambil()
    {
        $outlets = Outlet::get();
        $members = Member::get();
        return view('admin.status-laporan.diambil',[
            'members' => $members,
            'outlets' => $outlets
        ]);
    }

    public function diambil_datatable()
    {
        $query = Transaksi::with(['outlets', 'members', 'users'])
        ->where('status', 'diambil')
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

    public function all()
    {
        $outlets = Outlet::get();
        $members = Member::get();
        return view('admin.status-laporan.all',[
            'members' => $members,
            'outlets' => $outlets
        ]);
    }

    public function all_datatable()
    {
        $query = Transaksi::with(['outlets', 'members', 'users'])
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
