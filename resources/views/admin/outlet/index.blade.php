@extends('layouts.layout')
@section('css_plugin')
<link href="{{ asset('assets/plugins/DataTables/datatables.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">APP</a></li>
    <li class="breadcrumb-item active" aria-current="page">Outlet</li>
@endsection
@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title d-inline-block">Outlet</h5>
                <div class="float-right d-inline-block">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah-outlet">Tambah</button>
                </div>
                @component('components.datatable',['datas' => ['nama','alamat', 'Telepon','aksi']])
                    @slot('id')
                        outlet
                    @endslot
                @endcomponent
            </div>
        </div>
    </div>
</div>
@component('components.modal-form-basic',['id_modal' => 'modal-tambah-outlet', 'text_title' => 'Tambah Outlet','action' => route('admin.outlet.store')])
    @slot('content_modal')
    <div class="form-group">
        <label for="nama">Nama</label>
        <input type="text" class="form-control" id="nama" placeholder="Nama User" name="nama" required>
    </div>
    <div class="form-group">
        <label for="alamat">alamat</label>
        <textarea name="alamat" id="alamat" cols="30" rows="3" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <label for="tlp">Telepon</label>
        <input type="text" class="form-control" id="tlp" placeholder="Telepon User" name="tlp" required>
    </div>
    @endslot
@endcomponent
@component('components.modal-form-basic',['id_modal' => 'modal-edit-outlet', 'text_title' => 'Edit Outlet','action' => ''])
    @slot('content_modal')
    <div class="form-group">
        <label for="nama-edit">Nama</label>
        <input type="text" class="form-control" id="nama-edit" placeholder="Nama User" name="nama" required>
    </div>
    <div class="form-group">
        <label for="alamat-edit">alamat</label>
        <textarea name="alamat" id="alamat-edit" cols="30" rows="3" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <label for="tlp-edit">Telepon</label>
        <input type="text" class="form-control" id="tlp-edit" placeholder="Telepon User" name="tlp" required>
    </div>
    @endslot
    @slot('method')
        @method('PATCH')
    @endslot
@endcomponent
@component('components.modal-form-basic',['id_modal' => 'modal-delete-outlet', 'text_title' => 'Delete Outlet','action' => ''])
    @slot('content_modal')
    <div class="form-group">
        <label for="nama-delete">Nama</label>
        <input type="text" class="form-control" id="nama-delete" placeholder="Nama User" disabled>
    </div>
    <div class="form-group">
        <label for="alamat-delete">alamat</label>
        <textarea id="alamat-delete" cols="30" rows="3" class="form-control" disabled></textarea>
    </div>
    <div class="form-group">
        <label for="tlp-delete">Telepon</label>
        <input type="text" class="form-control" id="tlp-delete" placeholder="Telepon User" disabled>
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
    $(document).ready(function() {
        var table_outlet = $('#outlet').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.outlet.datatable') }}",
            },
            order : [[1,'desc']],
            columns: [
                {
                    data: 'nama',
                    name: 'nama',
                    // orderable: false
                },
                {
                    data: 'alamat',
                    name: 'alamat',
                    // orderable: false
                },
                {
                    data: 'tlp',
                    name: 'tlp',
                    // orderable: false
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                }
            ]
        });

        $(document).on('click','.btn-edit-outlet',function(){
            $('#modal-edit-outlet').modal();
            let data = table_outlet.rows($(this).parents("tr")).data()[0];
            let url = "{{ route('admin.outlet.index') }}"
            $('#modal-edit-outlet form').attr('action', url + "/" + data.id + "/edit")
            $('#modal-edit-outlet form #nama-edit').val(data.nama)
            $('#modal-edit-outlet form #alamat-edit').val(data.alamat)
            $('#modal-edit-outlet form #tlp-edit').val(data.tlp)
        })

        $(document).on('click','.btn-delete-outlet',function(){
            $('#modal-delete-outlet').modal();
            let data = table_outlet.rows($(this).parents("tr")).data()[0];
            let url = "{{ route('admin.outlet.index') }}"
            $('#modal-delete-outlet form').attr('action', url + "/" + data.id + "/delete")
            $('#modal-delete-outlet form #nama-delete').val(data.nama)
            $('#modal-delete-outlet form #alamat-delete').val(data.alamat)
            $('#modal-delete-outlet form #tlp-delete').val(data.tlp)
        })
    });


</script>
@endsection
