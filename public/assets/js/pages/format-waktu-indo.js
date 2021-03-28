function format_tanggal_input_date(date){
    tanggal = new Date(date)
    let day = ("0" + tanggal.getDate()).slice(-2);
    let month = ("0" + (tanggal.getMonth() + 1)).slice(-2);
    return tanggal.getFullYear()+"-"+(month)+"-"+(day);
}

function format_tanggal_waktu_indo(waktu){
    const date = new Date(waktu)
    var tahun = date.getFullYear();
    var bulan = date.getMonth();
    bulan = Number(bulan) + 1;
    var tanggal = date.getDate();
    var jam = date.getHours();
    var menit = date.getMinutes();
    var detik = date.getSeconds();
    return ( tanggal < 10 ? '0' + tanggal : tanggal ) + '-' + ( bulan < 10 ? '0' + bulan : bulan ) + '-' + tahun + ' ' + jam + ':' + menit + ':' + detik;
}

function format_tanggal_indo(waktu){
    const date = new Date(waktu)
    var tahun = date.getFullYear();
    var bulan = date.getMonth();
    bulan = Number(bulan) + 1;
    var tanggal = date.getDate();
    return ( tanggal < 10 ? '0' + tanggal : tanggal ) + '-' + ( bulan < 10 ? '0' + bulan : bulan ) + '-' + tahun;
}