@extends('layouts.layout')
@section('css_plugin')
<link href="{{ asset('assets/plugins/DataTables/datatables.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">APP</a></li>
    <li class="breadcrumb-item"><a href="#">Status Laporan</a></li>
    <li class="breadcrumb-item active" aria-current="page">Proses</li>
@endsection
@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title d-inline-block">Status Proses</h5>
                @component('components.datatable',['datas' => ['Invoice', 'Outlet', 'Member', 'tanggal', 'batas waktu', 'tanggal bayar', 'biaya tambahan', 'diskon','pajak', 'status', 'dibayar', 'user', 'aksi']])
                    @slot('id')
                        baru
                    @endslot
                @endcomponent
            </>
        </div>
    </div>
</div>
@component('components.modal-form-basic',['id_modal' => 'modal-edit-transaksi', 'text_title' => 'Edit Transaksi','action' => ''])
    @slot('content_modal')
    <div class="form-group">
        <label for="outlet-edit">Outlet</label>
        <select name="outlet" id="outlet-edit" tabindex="-1" style="display: none; width: 100%" required>
            <option value="" selected disabled>-- pilih --</option>
            @forelse ($outlets as $outlet)
                <option value="{{ $outlet->id }}">{{ $outlet->nama }}</option>
            @empty
                
            @endforelse
        </select>
    </div>
    <div class="form-group">
        <label for="member-edit">Member</label>
        <select name="member" id="member-edit" tabindex="-1" style="display: none; width: 100%" required>
            <option value="" selected disabled>-- pilih --</option>
            @forelse ($members as $member)
                <option value="{{ $member->id }}">{{ $member->nama }}</option>
            @empty
                
            @endforelse
        </select>
    </div>
    <div class="form-group">
        <label for="tgl-edit">Tanggal</label>
        <input type="datetime-local" class="form-control" id="tgl-edit" placeholder="Tanggal" name="tgl" required>
    </div>
    <div class="form-group">
        <label for="batas_waktu-edit">Batas Waktu</label>
        <input type="datetime-local" class="form-control" id="batas_waktu-edit" placeholder="Batas Waktu" name="batas_waktu" required>
    </div>
    <div class="form-group">
        <label for="tgl_bayar-edit">Tanggal Bayar</label>
        <input type="datetime-local" class="form-control" id="tgl_bayar-edit" placeholder="Tanggal Bayar" name="tgl_bayar" required>
    </div>
    <div class="form-group">
        <label for="biaya_tambahan-edit">Biaya Tambahan</label>
        <input type="biaya_tambahan" class="form-control" id="biaya_tambahan-edit" placeholder="Baiya Tambahan" name="biaya_tambahan" required>
    </div>
    <div class="form-group">
        <label for="diskon-edit">Diskon</label>
        <input type="number" class="form-control" id="diskon-edit" placeholder="Diskon" name="diskon" step="0.1" required>
    </div>
    <div class="form-group">
        <label for="pajak-edit">Pajak</label>
        <input type="number" class="form-control" id="pajak-edit" placeholder="Pajak" name="pajak" step="0.1" required>
    </div>
    <div class="form-group">
        <label for="status-edit">Status</label>
        <select name="status" id="status-edit" tabindex="-1" style="display: none; width: 100%" required>
            <option value="" selected disabled>-- pilih --</option>
            <option value="baru">Baru</option>
            <option value="proses">Proses</option>
            <option value="selesai">Selesai</option>
            <option value="diambil">Diambil</option>
        </select>
    </div>
    <div class="form-group">
        <label for="dibayar-edit">Dibayar</label>
        <select name="dibayar" id="dibayar-edit" tabindex="-1" style="display: none; width: 100%" required>
            <option value="" selected disabled>-- pilih --</option>
            <option value="dibayar">Dibayar</option>
            <option value="belum_bayar">Belum Bayar</option>
        </select>
    </div>
    @endslot
    @slot('method')
        @method('PATCH')
    @endslot
@endcomponent
@component('components.modal-form-basic',['id_modal' => 'modal-delete-transaksi', 'text_title' => 'Delete Transaksi','action' => ''])
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
        <label for="member-delete">Member</label>
        <select id="member-delete" tabindex="-1" style="display: none; width: 100%" disabled>
            <option value="" selected disabled>-- pilih --</option>
            @forelse ($members as $member)
                <option value="{{ $member->id }}">{{ $member->nama }}</option>
            @empty
                
            @endforelse
        </select>
    </div>
    <div class="form-group">
        <label for="tgl-delete">Tanggal</label>
        <input type="datetime-local" class="form-control" id="tgl-delete" placeholder="Tanggal" disabled>
    </div>
    <div class="form-group">
        <label for="batas_waktu-delete">Batas Waktu</label>
        <input type="datetime-local" class="form-control" id="batas_waktu-delete" placeholder="Batas Waktu" disabled>
    </div>
    <div class="form-group">
        <label for="tgl_bayar-delete">Tanggal Bayar</label>
        <input type="datetime-local" class="form-control" id="tgl_bayar-delete" placeholder="Tanggal Bayar" disabled>
    </div>
    <div class="form-group">
        <label for="biaya_tambahan-delete">Biaya Tambahan</label>
        <input type="biaya_tambahan" class="form-control" id="biaya_tambahan-delete" placeholder="Baiya Tambahan" disabled>
    </div>
    <div class="form-group">
        <label for="diskon-delete">Diskon</label>
        <input type="number" class="form-control" id="diskon-delete" placeholder="Diskon" step="0.1" disabled>
    </div>
    <div class="form-group">
        <label for="pajak-delete">Pajak</label>
        <input type="number" class="form-control" id="pajak-delete" placeholder="Pajak" step="0.1" disabled>
    </div>
    <div class="form-group">
        <label for="status-delete">Status</label>
        <select id="status-delete" tabindex="-1" style="display: none; width: 100%" disabled>
            <option value="" selected disabled>-- pilih --</option>
            <option value="baru">Baru</option>
            <option value="proses">Proses</option>
            <option value="selesai">Selesai</option>
            <option value="diambil">Diambil</option>
        </select>
    </div>
    <div class="form-group">
        <label for="dibayar-delete">Dibayar</label>
        <select id="dibayar-delete" tabindex="-1" style="display: none; width: 100%" disabled>
            <option value="" selected disabled>-- pilih --</option>
            <option value="dibayar">Dibayar</option>
            <option value="belum_bayar">Belum Bayar</option>
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
    $('#outlet-edit').select2();
    $('#member-edit').select2();
    $('#status-edit').select2();
    $('#dibayar-edit').select2();

    $('#outlet-delete').select2();
    $('#member-delete').select2();
    $('#status-delete').select2();
    $('#dibayar-delete').select2();
    $(document).ready(function() {
        var table_baru = $('#baru').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.status.laporan.proses.datatable') }}",
            },
            order : [[1,'desc']],
            columns: [
                {
                    data: 'kode_invoice',
                    name: 'kode_invoice',
                    // orderable: false
                },
                {
                    data: 'outlets.nama',
                    name: 'outlets.nama',
                    // orderable: false
                },
                {
                    data: 'members.nama',
                    name: 'members.nama',
                    // orderable: false
                },
                {
                    data: 'tgl',
                    name: 'tgl',
                    // orderable: false
                },
                {
                    data: 'batas_waktu',
                    name: 'batas_waktu',
                    // orderable: false
                },
                {
                    data: 'tgl_bayar',
                    name: 'tgl_bayar',
                    // orderable: false
                },
                {
                    data: 'biaya_tambahan',
                    name: 'biaya_tambahan',
                    // orderable: false
                },
                {
                    data: 'diskon',
                    name: 'diskon',
                    // orderable: false
                },
                {
                    data: 'pajak',
                    name: 'pajak',
                    // orderable: false
                },
                {
                    data: 'status',
                    name: 'status',
                    // orderable: false
                },
                {
                    data: 'dibayar',
                    name: 'dibayar',
                    // orderable: false
                },
                {
                    data: 'users.nama',
                    name: 'users.nama',
                    // orderable: false
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                }
            ]
        });

        $(document).on('click','.btn-edit',function(){
            $('#modal-edit-transaksi').modal();
            let tr = $(this).closest('tr');
            if(tr.hasClass('child')){
                tr = tr.prev()
            }
            let data = table_baru.row(tr).data();
            let url = "{{ route('admin.transaksi.index') }}"
            let tgl = mysqlTimeStampToDateTime(data.tgl)
            let batas_waktu = mysqlTimeStampToDateTime(data.batas_waktu)
            let tgl_bayar = mysqlTimeStampToDateTime(data.tgl_bayar)
            $('#modal-edit-transaksi form').attr('action', url + "/" + data.id + "/edit")
            $('#modal-edit-transaksi form #outlet-edit').val(data.outlets.id).trigger('change')
            $('#modal-edit-transaksi form #member-edit').val(data.members.id).trigger('change')
            $('#modal-edit-transaksi form #tgl-edit').val(tgl)
            $('#modal-edit-transaksi form #batas_waktu-edit').val(batas_waktu)
            $('#modal-edit-transaksi form #tgl_bayar-edit').val(tgl_bayar)
            $('#modal-edit-transaksi form #biaya_tambahan-edit').val(data.biaya_tambahan)
            $('#modal-edit-transaksi form #diskon-edit').val(data.diskon)
            $('#modal-edit-transaksi form #pajak-edit').val(data.pajak)
            $('#modal-edit-transaksi form #status-edit').val(data.status).trigger('change')
            $('#modal-edit-transaksi form #dibayar-edit').val(data.dibayar).trigger('change')
        })

        $(document).on('click','.btn-delete',function(){
            $('#modal-delete-transaksi').modal();
            let tr = $(this).closest('tr');
            if(tr.hasClass('child')){
                tr = tr.prev()
            }
            let data = table_baru.row(tr).data();
            let url = "{{ route('admin.transaksi.index') }}"
            let tgl = mysqlTimeStampToDateTime(data.tgl)
            let batas_waktu = mysqlTimeStampToDateTime(data.batas_waktu)
            let tgl_bayar = mysqlTimeStampToDateTime(data.tgl_bayar)
            $('#modal-delete-transaksi form').attr('action', url + "/" + data.id + "/delete")
            $('#modal-delete-transaksi form #outlet-delete').val(data.outlets.id).trigger('change')
            $('#modal-delete-transaksi form #member-delete').val(data.members.id).trigger('change')
            $('#modal-delete-transaksi form #tgl-delete').val(tgl)
            $('#modal-delete-transaksi form #batas_waktu-delete').val(batas_waktu)
            $('#modal-delete-transaksi form #tgl_bayar-delete').val(tgl_bayar)
            $('#modal-delete-transaksi form #biaya_tambahan-delete').val(data.biaya_tambahan)
            $('#modal-delete-transaksi form #diskon-delete').val(data.diskon)
            $('#modal-delete-transaksi form #pajak-delete').val(data.pajak)
            $('#modal-delete-transaksi form #status-delete').val(data.status).trigger('change')
            $('#modal-delete-transaksi form #dibayar-delete').val(data.dibayar).trigger('change')
        })
    });
</script>
@endsection
