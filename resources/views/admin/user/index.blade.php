@extends('layouts.layout')
@section('css_plugin')
<link href="{{ asset('assets/plugins/DataTables/datatables.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">APP</a></li>
    <li class="breadcrumb-item active" aria-current="page">User</li>
@endsection
@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title d-inline-block">User</h5>
                <div class="float-right d-inline-block">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah-user">Tambah</button>
                </div>
                @component('components.datatable',['datas' => ['nama','username', 'outlet', 'role','aksi']])
                    @slot('id')
                        user
                    @endslot
                @endcomponent
            </div>
        </div>
    </div>
</div>
@component('components.modal-form-basic',['id_modal' => 'modal-tambah-user', 'text_title' => 'Tambah User','action' => route('admin.user.store')])
    @slot('content_modal')
    <div class="form-group">
        <label for="nama">Nama</label>
        <input type="text" class="form-control" id="nama" placeholder="Nama User" name="nama" required>
    </div>
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" placeholder="Nama User" name="username" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" placeholder="Password User" name="password" required>
    </div>
    <div class="form-group">
        <label for="outlet">Outlet</label>
        <select name="outlet" id="outlet"  tabindex="-1" style="display: none; width: 100%">
            <option value="" selected disabled>-- pilih --</option>
            @forelse ($outlets as $outlet)
                <option value="{{ $outlet->id }}">{{ $outlet->nama }}</option>
            @empty
                
            @endforelse
        </select>
    </div>
    <div class="form-group">
        <label for="role">Role</label>
        <select name="role" id="role"  tabindex="-1" style="display: none; width: 100%">
            <option value="" selected disabled>-- pilih --</option>
            <option value="admin">Admin</option>
            <option value="kasir">Kasir</option>
            <option value="owner">Owner</option>
        </select>
    </div>
    @endslot
@endcomponent
@component('components.modal-form-basic',['id_modal' => 'modal-edit-user', 'text_title' => 'Edit User','action' => ''])
    @slot('content_modal')
    <div class="form-group">
        <label for="nama-edit">Nama</label>
        <input type="text" class="form-control" id="nama-edit" placeholder="Nama User" name="nama" required>
    </div>
    <div class="form-group">
        <label for="username-edit">Username</label>
        <input type="text" class="form-control" id="username-edit" placeholder="Nama User" name="username" required>
    </div>
    <div class="form-group">
        <label for="password-edit">Password</label>
        <input type="password" class="form-control" id="password-edit" placeholder="Password User" name="password">
    </div>
    <div class="form-group">
        <label for="outlet-edit">Outlet</label>
        <select name="outlet" id="outlet-edit"  tabindex="-1" style="display: none; width: 100%">
            <option value="" selected disabled>-- pilih --</option>
            @forelse ($outlets as $outlet)
                <option value="{{ $outlet->id }}">{{ $outlet->nama }}</option>
            @empty
                
            @endforelse
        </select>
    </div>
    <div class="form-group">
        <label for="role-edit">Role</label>
        <select name="role" id="role-edit"  tabindex="-1" style="display: none; width: 100%">
            <option value="" selected disabled>-- pilih --</option>
            <option value="admin">Admin</option>
            <option value="kasir">Kasir</option>
            <option value="owner">Owner</option>
        </select>
    </div>
    @endslot
    @slot('method')
        @method('PATCH')
    @endslot
@endcomponent
@component('components.modal-form-basic',['id_modal' => 'modal-delete-user', 'text_title' => 'Delete User','action' => ''])
    @slot('content_modal')
    <div class="form-group">
        <label for="nama-delete">Nama</label>
        <input type="text" class="form-control" id="nama-delete" placeholder="Nama User" disabled>
    </div>
    <div class="form-group">
        <label for="username-delete">Username</label>
        <input type="text" class="form-control" id="username-delete" placeholder="Nama User" disabled>
    </div>
    <div class="form-group">
        <label for="outlet-delete">Outlet</label>
        <select id="outlet-delete"  tabindex="-1" style="display: none; width: 100%" disabled>
            <option value="" selected disabled>-- pilih --</option>
            @forelse ($outlets as $outlet)
                <option value="{{ $outlet->id }}">{{ $outlet->nama }}</option>
            @empty
                
            @endforelse
        </select>
    </div>
    <div class="form-group">
        <label for="role-delete">Role</label>
        <select id="role-delete"  tabindex="-1" style="display: none; width: 100%" disabled>
            <option value="" selected disabled>-- pilih --</option>
            <option value="admin">Admin</option>
            <option value="kasir">Kasir</option>
            <option value="owner">Owner</option>
        </select>
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
    $('#outlet').select2();
    $('#role').select2();
    $('#outlet-edit').select2();
    $('#role-edit').select2();
    $('#outlet-delete').select2();
    $('#role-delete').select2();
    $(document).ready(function() {
        var table_user = $('#user').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.user.datatable') }}",
            },
            order : [[1,'desc']],
            columns: [
                {
                    data: 'nama',
                    name: 'nama',
                    // orderable: false
                },
                {
                    data: 'username',
                    name: 'username',
                    // orderable: false
                },
                {
                    data: 'outlets.nama',
                    name: 'outlets.nama',
                    // orderable: false
                },
                {
                    data: 'role',
                    name: 'role',
                    // orderable: false
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                }
            ]
        });

        $(document).on('click','.btn-edit-user',function(){
            $('#modal-edit-user').modal();
            let tr = $(this).closest('tr');
            if(tr.hasClass('child')){
                tr = tr.prev()
            }
            let data = table_user.row(tr).data();
            let url = "{{ route('admin.user.index') }}"
            $('#modal-edit-user form').attr('action', url + "/" + data.id + "/edit")
            $('#modal-edit-user form #nama-edit').val(data.nama)
            $('#modal-edit-user form #username-edit').val(data.username)
            $('#modal-edit-user form #password-edit').val('')
            $('#modal-edit-user form #outlet-edit').val(data.outlets.id).trigger('change')
            $('#modal-edit-user form #role-edit').val(data.role).trigger('change')
        })

        $(document).on('click','.btn-delete-user',function(){
            $('#modal-delete-user').modal();
            let tr = $(this).closest('tr');
            if(tr.hasClass('child')){
                tr = tr.prev()
            }
            let data = table_user.row(tr).data();
            let url = "{{ route('admin.user.index') }}"
            $('#modal-delete-user form').attr('action', url + "/" + data.id + "/delete")
            $('#modal-delete-user form #nama-delete').val(data.nama)
            $('#modal-delete-user form #username-delete').val(data.username)
            $('#modal-delete-user form #outlet-delete').val(data.outlets.id).trigger('change')
            $('#modal-delete-user form #role-delete').val(data.role).trigger('change')
        })
    });


</script>
@endsection
