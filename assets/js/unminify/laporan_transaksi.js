let laporan_transaksi = $("#laporan_transaksi").DataTable( {
    responsive:true,
    scrollX:true,
    ajax:readUrl,
    columnDefs:[{
        searcable: false,
        orderable: false,
        targets: 0
    }],
    order:[
        [1, "asc"]],
        columns:[ {
            data: null
        }
        , {
            data: "tanggal"
        }
        , {
            data: "jumlah_uang"
        }
        ]
}

);
function reloadTable() {
    laporan_transaksi.ajax.reload()
}

laporan_transaksi.on("order.dt search.dt", ()=> {
    laporan_transaksi.column(0, {
        search: "applied", order: "applied"
    }).nodes().each((el, err)=> {
        el.innerHTML=err+1
    })
});
$(".modal").on("hidden.bs.modal", ()=> {
    $("#form")[0].reset();
    $("#form").validate().resetForm()
});