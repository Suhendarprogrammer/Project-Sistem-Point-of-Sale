let url, report = $("#report").DataTable({
    responsive: true,
    scrollX: true,
    ajax: readUrl,
    columnDefs: [{
        searcable: false,
        orderable: false,
        targets: 0
    }],
    order: [
        [1, "asc"]
    ],
    columns: [{
        data: null
    }, {
        data: "tanggal"
    },{
        data: "actual"
    },{
        data: "target"
    },{
        data: "acv"
    },{
        data: "keterangan"
    }
    ]
});

function reloadTable() {
    report.ajax.reload()
}

function addData() {
    $.ajax({
        url: addUrl,
        type: "post",
        dataType: "json",
        data: $("#form").serialize(),
        success: () => {
            $(".modal").modal("hide");
            Swal.fire("Sukses", "Sukses Menambahkan Data", "success");
            reloadTable()
        },
        error: err => {
            console.log(err)
        }
    })
}

function remove(id) {
    Swal.fire({
        title: "Hapus",
        text: "Hapus data ini?",
        type: "warning",
        showCancelButton: true
    }).then(() => {
        $.ajax({
            url: deleteUrl,
            type: "post",
            dataType: "json",
            data: {
                id: id
            },
            success: () => {
                Swal.fire("Sukses", "Sukses Menghapus Data", "success");
                reloadTable()
            },
            error: err => {
                console.log(err)
            }
        })
    })
}

function editData() {
    $.ajax({
        url: editUrl,
        type: "post",
        dataType: "json",
        data: $("#form").serialize(),
        success: () => {
            $(".modal").modal("hide");
            Swal.fire("Sukses", "Sukses Mengedit Data", "success");
            reloadTable()
        },
        error: err => {
            console.log(err)
        }
    })
}

function add() {
    url = "add";
    $(".modal-title").html("Add Data");
    $('.modal button[type="submit"]').html("Add")
}

function edit(id) {
    $.ajax({
        url: get_kategoriUrl,
        type: "post",
        dataType: "json",
        data: {
            id: id
        },
        success: res => {
            $('[name="id"]').val(res.id);
            $('[name="tanggal"]').val(res.tanggal);
            $('[name="actual"]').val(res.actual);
            $('[name="target"]').val(res.target);
            $('[name="acv"]').val(res.acv);
            $('[name="keterangan"]').val(res.keterangan);
            $(".modal").modal("show");
            $(".modal-title").html("Edit Data");
            $('.modal button[type="submit"]').html("Edit");
            url = "edit"
        },
        error: err => {
            console.log(err)
        }
    })
}
report.on("order.dt search.dt", () => {
    report.column(0, {
        search: "applied",
        order: "applied"
    }).nodes().each((el, val) => {
        el.innerHTML = val + 1
    })
});
$("#form").validate({
    errorElement: "span",
    errorPlacement: (err, el) => {
        err.addClass("invalid-feedback"), el.closest(".form-group").append(err)
    },
    submitHandler: () => {
        "edit" == url ? editData() : addData()
    }
});
$(".modal").on("hidden.bs.modal", () => {
    $("#form")[0].reset();
    $("#form").validate().resetForm()
});