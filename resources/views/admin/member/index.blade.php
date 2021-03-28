@extends('layouts.layout')
@section('css_plugin')
<link href="{{ asset('assets/plugins/DataTables/datatables.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">APP</a></li>
    <li class="breadcrumb-item active" aria-current="page">Member</li>
@endsection
@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title d-inline-block">Member</h5>
                <div class="float-right d-inline-block">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah-member">Tambah</button>
                </div>
                @component('components.datatable',['datas' => ['nama','alamat', 'jenis kelamin','aksi']])
                    @slot('id')
                        member
                    @endslot
                @endcomponent
            </div>
        </div>
    </div>
</div>
@component('components.modal-form-basic',['id_modal' => 'modal-tambah-member', 'text_title' => 'Tambah Member','action' => route('admin.member.store')])
    @slot('content_modal')
    <div class="form-group">
        <label for="nama">Nama</label>
        <input type="text" class="form-control" id="nama" placeholder="Nama Member" name="nama" required>
    </div>
    <div class="form-group">
        <label for="alamat">Alamat</label>
        <textarea name="alamat" id="alamat" cols="30" rows="3" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <label for="jenis_kelamin">Jenis Kelamin</label>
        <select name="jenis_kelamin" id="jenis_kelamin"  tabindex="-1" style="display: none; width: 100%">
            <option value="" selected disabled>-- pilih --</option>
            <option value="L">Laki-Laki</option>
            <option value="P">Perempuan</option>
        </select>
    </div>
    <div class="form-group">
        <label for="tlp">Telepon</label>
        <input type="text" class="form-control" id="tlp" placeholder="Telepon Member" name="tlp" required>
    </div>
    @endslot
@endcomponent
@component('components.modal-form-basic',['id_modal' => 'modal-edit-member', 'text_title' => 'Edit Member','action' => ''])
    @slot('content_modal')
    <div class="form-group">
        <label for="nama-edit">Nama</label>
        <input type="text" class="form-control" id="nama-edit" placeholder="Nama Member" name="nama" required>
    </div>
    <div class="form-group">
        <label for="alamat-edit">Alamat</label>
        <textarea name="alamat" id="alamat-edit" cols="30" rows="3" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <label for="jenis_kelamin-edit">Jenis Kelamin</label>
        <select name="jenis_kelamin" id="jenis_kelamin-edit"  tabindex="-1" style="display: none; width: 100%">
            <option value="" selected disabled>-- pilih --</option>
            <option value="L">Laki-Laki</option>
            <option value="P">Perempuan</option>
        </select>
    </div>
    <div class="form-group">
        <label for="tlp-edit">Telepon</label>
        <input type="text" class="form-control" id="tlp-edit" placeholder="Telepon Member" name="tlp" required>
    </div>
    @endslot
    @slot('method')
        @method('PATCH')
    @endslot
@endcomponent
@component('components.modal-form-basic',['id_modal' => 'modal-delete-member', 'text_title' => 'Delete Member','action' => ''])
    @slot('content_modal')
    <div class="form-group">
        <label for="nama-delete">Nama</label>
        <input type="text" class="form-control" id="nama-delete" placeholder="Nama Member" disabled>
    </div>
    <div class="form-group">
        <label for="alamat-delete">Alamat</label>
        <textarea id="alamat-delete" cols="30" rows="3" class="form-control" disabled></textarea>
    </div>
    <div class="form-group">
        <label for="jenis_kelamin-delete">Jenis Kelamin</label>
        <select id="jenis_kelamin-delete" tabindex="-1" style="display: none; width: 100%" disabled>
            <option value="" selected disabled>-- pilih --</option>
            <option value="L">Laki-Laki</option>
            <option value="P">Perempuan</option>
        </select>
    </div>
    <div class="form-group">
        <label for="tlp-delete">Telepon</label>
        <input type="text" class="form-control" id="tlp-delete" placeholder="Telepon Member" disabled>
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
    $('#jenis_kelamin').select2();
    $('#jenis_kelamin-edit').select2();
    $('#jenis_kelamin-delete').select2();
    $(document).ready(function() {
        var table_member = $('#member').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.member.datatable') }}",
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
                    data: 'jenis_kelamin',
                    name: 'jenis_kelamin',
                    // orderable: false
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                }
            ]
        });

        $(document).on('click','.btn-edit-member',function(){
            $('#modal-edit-member').modal();
            let data = table_member.rows($(this).parents("tr")).data()[0];
            let url = "{{ route('admin.member.index') }}"
            $('#modal-edit-member form').attr('action', url + "/" + data.id + "/edit")
            $('#modal-edit-member form #nama-edit').val(data.nama)
            $('#modal-edit-member form #alamat-edit').val(data.alamat)
            $('#modal-edit-member form #jenis_kelamin-edit').val(data.jenis_kelamin).trigger('change')
            $('#modal-edit-member form #tlp-edit').val(data.tlp)
        })

        $(document).on('click','.btn-delete-member',function(){
            $('#modal-delete-member').modal();
            let data = table_member.rows($(this).parents("tr")).data()[0];
            let nama = data.nama
            let url = "{{ route('admin.member.index') }}"
            $('#modal-delete-member form').attr('action', url + "/" + data.id + "/delete")
            $('#modal-delete-member form #nama-delete').val(data.nama)
            $('#modal-delete-member form #alamat-delete').val(data.alamat)
            $('#modal-delete-member form #jenis_kelamin-delete').val(data.jenis_kelamin).trigger('change')
            $('#modal-delete-member form #tlp-delete').val(data.tlp)
        })
    });

</script>
@endsection
