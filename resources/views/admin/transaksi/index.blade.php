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
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title d-inline-block">Select Paket</h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="paket">Paket</label>
                            <select name="paket" id="paket" tabindex="-1" style="display: none; width: 100%">
                                <option value="" selected disabled>-- pilih --</option>
                                @forelse ($pakets as $paket)
                                    <option value="{{ $paket->id }}">{{ $paket->nama_paket }}</option>
                                @empty
                                    
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="outlet">Outlet</label>
                            <input type="text" id="outlet" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="jenis">Jenis</label>
                            <input type="text" id="jenis" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input type="number" id="harga" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="qty">Qty</label>
                            <input type="number" id="qty" class="form-control" name="qty" min="1">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea id="keterangan" class="form-control" cols="30" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary form-control" id="submit-paket">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title d-inline-block">Paket</h5>
                @component('components.datatable',['datas' => ['outlet', 'jenis','nama paket' , 'harga', 'qty', 'keterangan','aksi']])
                    @slot('id')
                        paket-table
                    @endslot
                @endcomponent
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title d-inline-block">Transaksi</h5>
                <form action="{{ route('admin.transaksi.store') }}" id="transaksi-form" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="member-transaksi">Member</label>
                                <select name="member_transaksi" id="member-transaksi" tabindex="-1" style="display: none; width: 100%">
                                    <option value="" selected disabled>-- pilih --</option>
                                    @forelse ($members as $member)
                                        <option value="{{ $member->id }}">{{ $member->nama }}</option>
                                    @empty
                                        
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="outlet-transaksi">Outlet</label>
                                <select name="outlet_transaksi" id="outlet-transaksi" tabindex="-1" style="display: none; width: 100%">
                                    <option value="" selected disabled>-- pilih --</option>
                                    @forelse ($outlets as $outlet)
                                        <option value="{{ $outlet->id }}">{{ $outlet->nama }}</option>
                                    @empty
                                        
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tgl-transaksi">Tanggal</label>
                                <input type="datetime-local" id="tgl-transaksi" class="form-control" name="tgl_transaksi" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="batas_waktu-transaksi">Batas Waktu</label>
                                <input type="datetime-local" id="batas_waktu-transaksi" class="form-control" name="batas_waktu_transaksi" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tgl_bayar-transaksi">Tanggal Bayar</label>
                                <input type="datetime-local" id="tgl_bayar-transaksi" class="form-control" name="tgl_bayar_transaksi" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="biaya_tambahan-transaksi">Biaya Tambahan</label>
                                <input type="number" id="biaya_tambahan-transaksi" class="form-control" name="biaya_tambahan_transaksi" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="diskon-transaksi">Diskon</label>
                                <input type="number" id="diskon-transaksi" class="form-control" name="diskon_transaksi" step="0.1" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="pajak-transaksi">Pajak</label>
                                <input type="number" id="pajak-transaksi" class="form-control" name="pajak_transaksi" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="status-transaksi">Status</label>
                                <select name="status_transaksi" id="status-transaksi" tabindex="-1" style="display: none; width: 100%" required>
                                    <option value="" selected disabled>-- pilih --</option>
                                    <option value="baru">Baru</option>
                                    <option value="proses">Proses</option>
                                    <option value="selesai">Selesai</option>
                                    <option value="diambil">Diambil</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="dibayar-transaksi">Dibayar</label>
                                <select name="dibayar_transaksi" id="dibayar-transaksi" tabindex="-1" style="display: none; width: 100%" required>
                                    <option value="" selected disabled>-- pilih --</option>
                                    <option value="dibayar">Dibayar</option>
                                    <option value="belum_bayar">Belum Bayar</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="jumlah-pembayaran">Jumlah Pembayaran</label>
                                <input type="number" id="jumlah-pembayaran" min="0" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary form-control" id="submit-transaksi">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<form action="{{ route('admin.transaksi.store') }}" method="post" hidden>
    @csrf
</form>
@endsection
@component('components.modal-form-basic',['id_modal' => 'modal-transaksi', 'text_title' => 'Transaksi','action' => ''])
@slot('id_btn_save')
    btn-submit-transaksi
@endslot
@slot('content_modal')
apakah anda yakin untuk melakukan transaksi ini
@endslot
@endcomponent
@section('script_plugin')
<script src="{{ asset('assets/plugins/DataTables/datatables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
@endsection
@section('script_custom')
<script>
var check_transaction = false
var jumlah_pembayaran = 0;
    $(document).ready(function() {
        $('#paket').select2()
        $('#outlet-transaksi').select2()
        $('#member-transaksi').select2()
        $('#status-transaksi').select2()
        $('#dibayar-transaksi').select2()

        var paket_table = $('#paket-table').DataTable({
            responsive: true,
            "columns": [
                    { "data": "outlet" },
                    { "data": "jenis" },
                    { "data": "nama_paket" },
                    { "data": "harga" },
                    { "data": "qty" },
                    { "data": "keterangan" },
                    { "data": null },
                ],
                columnDefs: [
                    {
                        "targets": 6,
                        "render": function (data, type, row) {
                            var checkbox = `
                            <button type="button" class="btn btn-danger delete-transaksi"><i class="fas fa-trash"></i></button>
                            `;
                            return checkbox;
                        }
                    },
                ]
        })
        $(document).on('change', '#paket', function(){
            let paket_id = $(this).val()
            if(paket_id == null || paket_id === ""){
                return
            }
            $.ajax({
                url : "{{ route('admin.transaksi.index') }}" + "/search/paket",
                type: "GET",
                data : {
                    paket_id : paket_id
                },
                success: function(data){
                    $('#outlet').val(data.outlets.nama)
                    $('#jenis').val(data.jenis)
                    $('#harga').val(data.harga)
                },
                error: function(data){
                    alert('data tidak di temukan')
                }
            })
        })

        $(document).on('click', '#submit-paket', function(){
            let paket_val = $('#paket').val()
            let qty_val = $('#qty').val()
            let jenis_val = $('#jenis').val()
            let outlet_val = $('#outlet').val()
            let nama_paket_val = $('#paket option:selected').text()
            let harga_val = $('#harga').val()
            let keterangan_val = $('#keterangan').val()
            if(paket_val == null || paket_val === "" || qty_val == null || qty_val === ""){
                alert('silahkan masukan paket dan qty terlebih dahulu')
                return
            }

            paket_table.row.add({
                outlet: outlet_val,
                jenis: jenis_val,
                nama_paket: nama_paket_val,
                harga: harga_val,
                qty: qty_val,
                keterangan: keterangan_val,
                paket_id: paket_val
            }).draw()
            

            jumlah_pembayaran = jumlah_pembayaran + (harga_val * qty_val )
            $('#jumlah-pembayaran').val(jumlah_pembayaran)

            console.log($('#tgl-transaksi').val());

            $('#paket').val('').trigger('change')
            $('#qty').val('')
            $('#jenis').val('')
            $('#outlet').val('')
            $('#harga').val('')
            $('#keterangan').val('')
        })

        // $(document).on('click','.delete-transaksi',function(){
        //     let row = table_detail_transaksi.row($(this).parents('tr'));
        //     row.remove().draw();
        //     let uang_customer = $('#uang_customer').val()
        //     let semua_transaksi = table_detail_transaksi.rows().data();
        //     let jumlah_dibayar =  semua_transaksi.reduce((accumulator, currentValue) => accumulator + (parseInt(currentValue.harga_satuan) * parseInt(currentValue.stok)), 0)
        //     $('#jumlah_dibayar').attr('jumlah_bayar',jumlah_dibayar)
        //     $('#jumlah_dibayar').val('Rp. ' + number_format(jumlah_dibayar,2,',','.'))
        //     kembalian(jumlah_dibayar, uang_customer)
        // })

        $('#modal-transaksi form').submit(function(event){
            event.preventDefault();

            if(paket_table.rows().data().length < 1){
                alert('silahkan masukan paket terlebih dahulu')
                return ;
            }
            let loop = 0;
            let semua_paket = paket_table.rows().data();
            $.each(semua_paket, function(i, val){
                $("<input />").attr("type", "hidden")
                .attr("name", `paket[${loop}][paket_id]`)
                .attr("value", val.paket_id)
                .appendTo("#transaksi-form");
                $("<input />").attr("type", "hidden")
                .attr("name", `paket[${loop}][qty]`)
                .attr("value", val.qty)
                .appendTo("#transaksi-form");
                $("<input />").attr("type", "hidden")
                .attr("name", `paket[${loop}][keterangan]`)
                .attr("value", val.keterangan)
                .appendTo("#transaksi-form");
                loop++
            })

            check_transaction = true
            $('#transaksi-form').submit()
        })

        $(document).on('click', '.delete-transaksi', function(){
            let tr = $(this).closest('tr');
            if(tr.hasClass('child')){
                tr = tr.prev()
            }
            let row = paket_table.row(tr);
            row.remove().draw();

            let semua_transaksi = paket_table.rows().data();
            let jumlah_dibayar =  semua_transaksi.reduce((accumulator, currentValue) => accumulator + (parseInt(currentValue.harga) * parseInt(currentValue.qty)), 0)
            jumlah_pembayaran = jumlah_dibayar
            $('#jumlah-pembayaran').val(jumlah_pembayaran)
        })
    })

    $('#transaksi-form').submit(function(){
            $('#modal-transaksi').modal()
            return check_transaction
        })
</script>
@endsection
