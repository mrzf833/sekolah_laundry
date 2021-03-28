@extends('layouts.layout')
@section('css_plugin')
<link href="{{ asset('assets/plugins/DataTables/datatables.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">APP</a></li>
    <li class="breadcrumb-item"><a href="#">Transaksi</a></li>
    <li class="breadcrumb-item active" aria-current="page">Detail</li>
@endsection
@section('content')
<div class="row">
    <div class="col-lg-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Harga Seluruh Paket</h5>
                <h2 class="text-center text-primary" id="harga_seluruh_barang">Rp. {{ number_format($semua_paket, 2, ',', '.') }}</h2>
            </div>
        </div>
    </div>
    <div class="col-lg-9">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title d-inline-block">Transaksi Detail</h5>
                <div class="float-right d-inline-block">
                    {{-- <button class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah-member">DOWNLOAD INVOICE</button> --}}
                    <a class="btn btn-primary" href="{{ route('admin.transaksi.invoice.print', $transaksi->id) }}" target="_blank">PRINT INVOICE</a>
                    <a class="btn btn-danger" href="{{ route('admin.transaksi.invoice.pdf', $transaksi->id) }}">DOWNLOAD PDF INVOICE</a>
                </div>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th scope="col">Kode Invoice Barang</th>
                            <td>{{ $transaksi->kode_invoice }}</td>
                        </tr>
                        <tr>
                            <th scope="col">Member</th>
                            <td>{{ $transaksi->members->nama }}</td>
                        </tr>
                        <tr>
                            <th scope="col">Tanggal</th>
                            <td>{{ $transaksi->tgl }}</td>
                        </tr>
                        <tr>
                            <th scope="col">Batas Waktu</th>
                            <td>{{ $transaksi->batas_waktu }}</td>
                        </tr>
                        <tr>
                            <th scope="col">Tanggal Bayar</th>
                            <td>{{ $transaksi->tgl_bayar }}</td>
                        </tr>
                        <tr>
                            <th scope="col">Biaya Tambahan</th>
                            <td>{{ $transaksi->biaya_tambahan }}</td>
                        </tr>
                        <tr>
                            <th scope="col">Diskon</th>
                            <td>{{ $transaksi->diskon }}</td>
                        </tr>
                        <tr>
                            <th scope="col">Pajak</th>
                            <td>{{ $transaksi->pajak }}</td>
                        </tr>
                        <tr>
                            <th scope="col">Status</th>
                            <td>{{ $transaksi->status }}</td>
                        </tr>
                        <tr>
                            <th scope="col">Dibayar</th>
                            <td>{{ $transaksi->dibayar }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title d-inline-block">Transaksi Detail</h5>
                @component('components.datatable',['datas' => ['paket', 'jenis', 'harga', 'qty', 'keterangan', 'aksi']])
                    @slot('id')
                        detail-transaksi
                    @endslot
                @endcomponent
            </>
        </div>
    </div>
</div>
@component('components.modal-form-basic',['id_modal' => 'modal-edit-detail-transaksi', 'text_title' => 'Edit Transaksi Detail','action' => ''])
    @slot('content_modal')
    <div class="form-group">
        <label for="paket-edit">Paket</label>
        <select name="paket" id="paket-edit" tabindex="-1" style="display: none; width: 100%" required>
            <option value="" selected disabled>-- pilih --</option>
            @forelse ($pakets as $paket)
                <option value="{{ $paket->id }}">{{ $paket->nama_paket }}</option>
            @empty
                
            @endforelse
        </select>
    </div>
    <div class="form-group">
        <label for="qty-edit">Qty</label>
        <input type="number" class="form-control" id="qty-edit" placeholder="Qty" name="qty" required>
    </div>
    <div class="form-group">
        <label for="keterangan-edit">Keterangan</label>
        <textarea name="keterangan" id="keterangan-edit" cols="30" rows="2" class="form-control"></textarea>
    </div>
    @endslot
    @slot('method')
        @method('PATCH')
    @endslot
@endcomponent
@component('components.modal-form-basic',['id_modal' => 'modal-delete-detail-transaksi', 'text_title' => 'Delete Transaksi Detail','action' => ''])
    @slot('content_modal')
    <div class="form-group">
        <label for="paket-delete">Paket</label>
        <select name="paket" id="paket-delete" tabindex="-1" style="display: none; width: 100%"  disabled>
            <option value="" selected disabled>-- pilih --</option>
            @forelse ($pakets as $paket)
                <option value="{{ $paket->id }}">{{ $paket->nama_paket }}</option>
            @empty
                
            @endforelse
        </select>
    </div>
    <div class="form-group">
        <label for="qty-delete">Qty</label>
        <input type="number" class="form-control" id="qty-delete" placeholder="Qty" name="qty" disabled>
    </div>
    <div class="form-group">
        <label for="keterangan-delete">Keterangan</label>
        <textarea name="keterangan" id="keterangan-delete" cols="30" rows="2" class="form-control" disabled></textarea>
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
    $('#paket-edit').select2();
    $('#paket-delete').select2();
    $(document).ready(function() {
        var detail_transaksi = $('#detail-transaksi').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.transaksi.detail.datatable', $transaksi->id) }}",
            },
            order : [[1,'desc']],
            columns: [
                {
                    data: 'pakets.nama_paket',
                    name: 'pakets.nama_paket',
                    // orderable: false
                },
                {
                    data: 'pakets.jenis',
                    name: 'pakets.jenis',
                    // orderable: false
                },
                {
                    data: 'pakets.harga',
                    name: 'pakets.harga',
                    // orderable: false
                },
                {
                    data: 'qty',
                    name: 'qty',
                    // orderable: false
                },
                {
                    data: 'keterangan',
                    name: 'keterangan',
                    // orderable: false
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                }
            ]
        });

        $(document).on('click','.btn-edit-detail',function(){
            $('#modal-edit-detail-transaksi').modal();
            let tr = $(this).closest('tr');
            if(tr.hasClass('child')){
                tr = tr.prev()
            }
            let data = detail_transaksi.row(tr).data();
            let url = "{{ route('admin.transaksi.detail.index', $transaksi->id) }}"
            $('#modal-edit-detail-transaksi form').attr('action', url + "/" + data.id + "/edit")
            $('#modal-edit-detail-transaksi form #paket-edit').val(data.pakets.id).trigger('change')
            $('#modal-edit-detail-transaksi form #qty-edit').val(data.qty)
            $('#modal-edit-detail-transaksi form #keterangan-edit').val(data.keterangan)
        })

        $(document).on('click','.btn-delete-detail',function(){
            $('#modal-delete-detail-transaksi').modal();
            let tr = $(this).closest('tr');
            if(tr.hasClass('child')){
                tr = tr.prev()
            }
            let data = detail_transaksi.row(tr).data();
            let url = "{{ route('admin.transaksi.detail.index', $transaksi->id) }}"
            $('#modal-delete-detail-transaksi form').attr('action', url + "/" + data.id + "/delete")
            $('#modal-delete-detail-transaksi form #paket-delete').val(data.pakets.id).trigger('change')
            $('#modal-delete-detail-transaksi form #qty-delete').val(data.qty)
            $('#modal-delete-detail-transaksi form #keterangan-delete').val(data.keterangan)
        })
    });
</script>
@endsection
