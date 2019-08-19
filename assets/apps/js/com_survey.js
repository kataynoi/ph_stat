$(document).ready(function () {
    var dataTable = $('#table_data').DataTable({
        language: {
            searchPlaceholder: "ค้นหา รุ่น,สถานที่ตั้ง,ผู้รับผิดชอบ"
        },
        "processing": true,
        "serverSide": true,
        "order": [],

        "pageLength": 50,
        "ajax": {
            url: site_url + '/com_survey/fetch_com_survey',
            data: {
                'csrf_token': csrf_token
            },
            type: "POST"
        },
        "columnDefs": [
            {
                "targets": [0, 6],
                "orderable": false,
            },
        ],
    });

});

var crud = {};

crud.ajax = {
    del_data: function (id, cb) {
        var url = '/com_survey/del_com_survey',
            params = {
                id: id
            }

        app.ajax(url, params, function (err, data) {
            err ? cb(err) : cb(null, data);
        });
    }, save: function (items, cb) {
        var url = '/com_survey/save_com_survey',
            params = {
                items: items
            }

        app.ajax(url, params, function (err, data) {
            err ? cb(err) : cb(null, data);
        });
    }, get_update: function (id, cb) {
        var url = '/com_survey/get_com_survey',
            params = {
                id: id
            }

        app.ajax(url, params, function (err, data) {
            err ? cb(err) : cb(null, data);
        });
    }

};
crud.del_data = function (id) {

    crud.ajax.del_data(id, function (err, data) {
        if (err) {
            swal(err)
        }
        else {
            //swal('ลบข้อมูลเรียบร้อย')
            app.alert('ลบข้อมูลเรียบร้อย');

        }
    });
}

crud.save = function (items) {
    crud.ajax.save(items, function (err, data) {
        if (err) {
            //app.alert(err);
            swal(err);
        }
        else {
            swal('แก้ไขข้อมูลเรียบร้อยแล้ว ');
            location.reload();
        }
    });

}

crud.get_update = function (id) {
    crud.ajax.get_update(id, function (err, data) {
        if (err) {
            //app.alert(err);
            swal(err);
        }
        else {
            //swal('แก้ไขข้อมูลเรียบร้อยแล้ว ');
            //location.reload();
            crud.set_update(data);
        }
    });

}
crud.set_update = function (data) {
    $("#id").val(data.rows["id"]);
    $("#computertype").val(data.rows["computertype"]);
    $("#cbrand").val(data.rows["cbrand"]);
    $("#cbrand_series").val(data.rows["cbrand_series"]);
    $("#ram").val(data.rows["ram"]);
    $("#cpu").val(data.rows["cpu"]);
    $("#harddisk").val(data.rows["harddisk"]);
    $("#operating_system").val(data.rows["operating_system"]);
    $("#office").val(data.rows["office"]);
    $("#owner").val(data.rows["owner"]);
    $("#co_workgroup").val(data.rows["co_workgroup"]);
    $("#location").val(data.rows["location"]);
    $("#start_year").val(data.rows["start_year"]);
    $("#ups").val(data.rows["ups"]);
    $("#use_status").val(data.rows["use_status"]);
    $("#serial_number").val(data.rows["serial_number"]);
    $("#note").val(data.rows["note"]);
}

$('#btn_save').on('click', function (e) {
    e.preventDefault();
    var action;
    var items = {};
    items.action = $('#action').val();
    items.id = $("#id").val();
    items.computertype = $("#computertype").val();
    items.cbrand = $("#cbrand").val();
    items.cbrand_series = $("#cbrand_series").val();
    items.ram = $("#ram").val();
    items.cpu = $("#cpu").val();
    items.harddisk = $("#harddisk").val();
    items.operating_system = $("#operating_system").val();
    items.office = $("#office").val();
    items.owner = $("#owner").val();
    items.co_workgroup = $("#co_workgroup").val();
    items.location = $("#location").val();
    items.start_year = $("#start_year").val();
    items.ups = $("#ups").val();
    items.use_status = $("#use_status").val();
    items.serial_number = $("#serial_number").val();
    items.note = $("#note").val();

    if (validate(items)) {
        crud.save(items);
    }

});

$('#add_data').on('click', function (e) {
    e.preventDefault();
    app.clear_form();
});

$(document).on('click', 'button[data-btn="btn_del"]', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    var td = $(this).parent().parent().parent();

    swal({
        title: "คำเตือน?",
        text: "คุณต้องการลบข้อมูล ",
        icon: "warning",
        buttons: [
            'cancel !',
            'Yes !'
        ],
        dangerMode: true,
    }).then(function (isConfirm) {
        if (isConfirm) {
            crud.del_data(id);
            td.hide();
        }
    });
});

$(document).on('click', 'button[data-btn="btn_edit"]', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    $('#action').val('update');
    $('#id').val(id);
    crud.get_update(id);
    $('#frmModal').modal('show');

});

function validate(items) {

    if (!items.computertype) {
        swal("กรุณาระบุประเภทคอมพิวเตอร์");
        $("#computertype").focus();
    } else if (!items.cbrand) {
        swal("กรุณาระบุยี่ห้อ");
        $("#cbrand").focus();
    } else if (!items.cbrand_series) {
        swal("กรุณาระบุรุ่น");
        $("#cbrand_series").focus();
    } else if (!items.ram) {
        swal("กรุณาระบุRAM");
        $("#ram").focus();
    } else if (!items.cpu) {
        swal("กรุณาระบุCPU");
        $("#cpu").focus();
    } else if (!items.harddisk) {
        swal("กรุณาระบุHDD");
        $("#harddisk").focus();
    } else if (!items.operating_system) {
        swal("กรุณาระบุOS");
        $("#operating_system").focus();
    } else if (!items.office) {
        swal("กรุณาระบุOffice");
        $("#office").focus();
    } else if (!items.owner) {
        swal("กรุณาระบุผู้รับผิดชอบ");
        $("#owner").focus();
    } else if (!items.co_workgroup) {
        swal("กรุณาระบุกลุ่มงาน");
        $("#co_workgroup").focus();
    } else if (!items.location) {
        swal("กรุณาระบุสถานที่ตั้ง");
        $("#location").focus();
    } else if (!items.start_year) {
        swal("กรุณาระบุปีที่เริ่มใช้งาน");
        $("#start_year").focus();
    } else if (!items.ups) {
        swal("กรุณาระบุUPS");
        $("#ups").focus();
    } else if (!items.use_status) {
        swal("กรุณาระบุสถานะการใช้งาน");
        $("#use_status").focus();
    } else if (!items.serial_number) {
        swal("กรุณาระบุหมายเลขครุภัณฑ์");
        $("#serial_number").focus();
    } else if (!items.note) {
        swal("กรุณาระบุบันทึกเพิ่มเติม");
        $("#note").focus();
    }
    else {
        return true;
    }

}