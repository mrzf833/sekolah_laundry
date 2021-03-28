@extends('layouts.layout')
@section('css_plugin')
<link href="{{ asset('assets/plugins/DataTables/datatables.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">APP</a></li>
    <li class="breadcrumb-item active" aria-current="page">Paket</li>
@endsection
@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title d-inline-block">Paket</h5>
                <div class="float-right d-inline-block">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah-paket">Tambah</button>
                </div>
                @component('components.datatable',['datas' => ['outlet','nama paket' , 'jenis', 'harga','aksi']])
                    @slot('id')
                        paket
                    @endslot
                @endcomponent
            </div>
        </div>
    </div>
</div>
@component('components.modal-form-basic',['id_modal' => 'modal-tambah-paket', 'text_title' => 'Tambah Paket','action' => route('admin.paket.store')])
    @slot('content_modal')
    <div class="form-group">
        <label for="outlet">Outlet</label>
        <select id="outlet" tabindex="-1" style="display: none; width: 100%" name="outlet" required>
            <option value="" selected disabled>-- pilih --</option>
            @forelse ($outlets as $outlet)
                <option value="{{ $outlet->id }}">{{ $outlet->nama }}</option>
            @empty
                
            @endforelse
        </select>
    </div>
    <div class="form-group">
        <label for="jenis">Jenis</label>
        <select id="jenis" tabindex="-1" style="display: none; width: 100%" name="jenis" required>
            <option value="" selected disabled>-- pilih --</option>
            <option value="kiloan">Kiloan</option>
            <option value="selimut">Selimut</option>
            <option value="bed_cover">Bed Cover</option>
            <option value="kaos">Kaos</option>
            <option value="lain">Lain</option>
        </select>
    </div>
    <div class="form-group">
        <label for="nama">Nama Paket</label>
        <input type="text" name="nama" id="nama" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="harga">Harga</label>
        <input type="number" class="form-control" id="harga" placeholder="Telepon User" name="harga" required>
    </div>
    @endslot
@endcomponent
@component('components.modal-form-basic',['id_modal' => 'modal-edit-paket', 'text_title' => 'Edit Paket','action' => ''])
    @slot('content_modal')
    <div class="form-group">
        <label for="outlet-edit">Outlet</label>
        <select id="outlet-edit" tabindex="-1" style="display: none; width: 100%" name="outlet" required>
            <option value="" selected disabled>-- pilih --</option>
            @forelse ($outlets as $outlet)
                <option value="{{ $outlet->id }}">{{ $outlet->nama }}</option>
            @empty
                
            @endforelse
        </select>
    </div>
    <div class="form-group">
        <label for="jenis-edit">Jenis</label>
        <select id="jenis-edit" tabindex="-1" style="display: none; width: 100%" name="jenis" required>
            <option value="" selected disabled>-- pilih --</option>
            <option value="kiloan">Kiloan</option>
            <option value="selimut">Selimut</option>
            <option value="bed_cover">Bed Cover</option>
            <option value="kaos">Kaos</option>
            <option value="lain">Lain</option>
        </select>
    </div>
    <div class="form-group">
        <label for="nama-edit">Nama Paket</label>
        <input type="text" name="nama" id="nama-edit" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="harga-edit">Harga</label>
        <input type="number" class="form-control" id="harga-edit" placeholder="Telepon User" name="harga" required>
    </div>
    @endslot
    @slot('method')
        @method('PATCH')
    @endslot
@endcomponent
@component('components.modal-form-basic',['id_modal' => 'modal-delete-paket', 'text_title' => 'Delete Paket','action' => ''])
    @slot('content_modal')
    <div class="form-group">
        <label for="outlet-delete">Outlet</label>
        <select id="outlet-delete" tabindex="-1" style="display: none; width: 100%" disabled>
            <option value="" selected disabled>-- pilih --</option>
            @forelse ($outlets as $outlet)
                <option value="{{ $outlet->id }}">{{ $outlet->nama }}</option>
            @empty
                
            @endforelse
        </select>
    </div>
    <div class="form-group">
        <label for="jenis-delete">Jenis</label>
        <select id="jenis-delete" tabindex="-1" style="display: none; width: 100%" disabled>
            <option value="" selected disabled>-- pilih --</option>
            <option value="kiloan">Kiloan</option>
            <option value="selimut">Selimut</option>
            <option value="bed_cover">Bed Cover</option>
            <option value="kaos">Kaos</option>
            <option value="lain">Lain</option>
        </select>
    </div>
    <div class="form-group">
        <label for="nama-delete">Nama Paket</label>
        <input type="text" name="nama" id="nama-delete" class="form-control" disabled>
    </div>
    <div class="form-group">
        <label for="harga-delete">Harga</label>
        <input type="number" class="form-control" id="harga-delete" placeholder="Telepon User" disabled>
    </div>
    @endslot
    @slot('method')
        @method('DELETE')
    @endslot
    @slot('content_footer')
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger">Delete</button>
    @endslot
@endcomponent
@endsection
@section('script_plugin')
<script src="{{ asset('assets/plugins/DataTables/datatables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
@endsection
@section('script_custom')
<script>
    $('#outlet').select2()
    $('#jenis').select2()

    $('#outlet-edit').select2()
    $('#jenis-edit').select2()

    $('#outlet-delete').select2()
    $('#jenis-delete').select2()
    $(document).ready(function() {
        var table_paket = $('#paket').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.paket.datatable') }}",
            },
            order : [[1,'desc']],
            columns: [
                {
                    data: 'outlets.nama',
                    name: 'outlets.nama',
                    // orderable: false
                },
                {
                    data: 'nama_paket',
                    name: 'nama_paket',
                    // orderable: false
                },
                {
                    data: 'jenis',
                    name: 'jenis',
                    // orderable: false
                },
                {
                    data: 'harga',
                    name: 'harga',
                    // orderable: false
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                }
            ]
        });

        $(document).on('click','.btn-edit-paket',function(){
            $('#modal-edit-paket').modal();
            let tr = $(this).closest('tr');
            if(tr.hasClass('child')){
                tr = tr.prev()
            }
            let data = table_paket.row(tr).data();
            let url = "{{ route('admin.paket.index') }}"
            $('#modal-edit-paket form').attr('action', url + "/" + data.id + "/edit")
            $('#modal-edit-paket form #outlet-edit').val(data.outlets.id).trigger('change')
            $('#modal-edit-paket form #jenis-edit').val(data.jenis).trigger('change')
            $('#modal-edit-paket form #nama-edit').val(data.nama_paket)
            $('#modal-edit-paket form #harga-edit').val(data.harga)
        })

        $(document).on('click','.btn-delete-paket',function(){
            $('#modal-delete-paket').modal();
            let tr = $(this).closest('tr');
            if(tr.hasClass('child')){
                tr = tr.prev()
            }
            let data = table_paket.row(tr).data();
            let url = "{{ route('admin.paket.index') }}"
            $('#modal-delete-paket form').attr('action', url + "/" + data.id + "/delete")
            $('#modal-delete-paket form #outlet-delete').val(data.outlets.id).trigger('change')
            $('#modal-delete-paket form #jenis-delete').val(data.jenis).trigger('change')
            $('#modal-delete-paket form #nama-delete').val(data.nama_paket)
            $('#modal-delete-paket form #harga-delete').val(data.harga)
        })
    });


</script>
@endsection
