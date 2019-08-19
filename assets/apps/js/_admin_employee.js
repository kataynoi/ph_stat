$(document).ready(function () {
    var dataTable = $('#table_data').DataTable({
        language: {
            searchPlaceholder: "ค้นหา ชื่อสกุล,กลุ่มงาน"
        },
        "processing": true,
        "serverSide": true,
        "order": [],

        "pageLength": 50,
        "ajax": {
            url: site_url + '/admin_employee/fetch_admin_employee',
            data: {
                'csrf_token': csrf_token
            },
            type: "POST"
        },
        "columnDefs": [
            {
                "targets": [1, 2],
                "orderable": false,
            },
        ],
    });

});

var crud = {};

crud.ajax = {
    del_data: function (id, cb) {
        var url = '/admin_employee/del_admin_employee',
            params = {
                id: id
            }

        app.ajax(url, params, function (err, data) {
            err ? cb(err) : cb(null, data);
        });
    }, save: function (items, cb) {
        var url = '/admin_employee/save_admin_employee',
            params = {
                items: items
            }

        app.ajax(url, params, function (err, data) {
            err ? cb(err) : cb(null, data);
        });
    }, get_update: function (id, cb) {
        var url = '/admin_employee/get_admin_employee',
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
    $("#prename").val(data.rows["prename"]);
    $("#name").val(data.rows["name"]);
    $("#sex").val(data.rows["sex"]);
    $("#cid").val(data.rows["cid"]);
    $("#position").val(data.rows["position"]);
    $("#employee_type").val(data.rows["employee_type"]);
    $("#group").val(data.rows["group"]);
    $("#active").val(data.rows["active"]);
}

$('#btn_save').on('click', function (e) {
    e.preventDefault();
    var action;
    var items = {};
    items.action = $('#action').val();
    items.id = $("#id").val();
    items.prename = $("#prename").val();
    items.name = $("#name").val();
    items.sex = $("#sex").val();
    items.cid = $("#cid").val();
    items.position = $("#position").val();
    items.employee_type = $("#employee_type").val();
    items.group = $("#group").val();
    items.active = $("#active").val();

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

    if (!items.prename) {
        swal("กรุณาระบุคำนำหน้า");
        $("#prename").focus();
    } else if (!items.name) {
        swal("กรุณาระบุชื่อสกุล");
        $("#name").focus();
    } else if (!items.sex) {
        swal("กรุณาระบุเพศ");
        $("#sex").focus();
    } else if (!items.cid) {
        swal("กรุณาระบุเลขประจำตัวประชาชน");
        $("#cid").focus();
    } else if (!items.position) {
        swal("กรุณาระบุตำแหน่ง");
        $("#position").focus();
    } else if (!items.employee_type) {
        swal("กรุณาระบุประเภทพนักงาน");
        $("#employee_type").focus();
    } else if (!items.group) {
        swal("กรุณาระบุกลุ่มงาน");
        $("#group").focus();
    } else if (!items.active) {
        swal("กรุณาระบุสถานะการใช้งาน");
        $("#active").focus();
    }
    else {
        return true;
    }

}