$(document).ready(function () {
    var dataTable = $('#table_data').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],

        "pageLength": 50,
        "ajax": {
            url: site_url + '/admin_user/fetch_admin_user',
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
        var url = '/admin_user/del_admin_user',
            params = {
                id: id
            }

        app.ajax(url, params, function (err, data) {
            err ? cb(err) : cb(null, data);
        });
    }, save: function (items, cb) {
        var url = '/admin_user/save_admin_user',
            params = {
                items: items
            }

        app.ajax(url, params, function (err, data) {
            err ? cb(err) : cb(null, data);
        });
    }, get_update: function (id, cb) {
        var url = '/admin_user/get_admin_user',
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
    $("#username").val(data.rows["username"]);
    //$("#password").val(data.rows["password"]);
    $("#name").val(data.rows["name"]);
    $("#user_type").val(data.rows["user_type"]);
    $("#email").val(data.rows["email"]);
    $("#active").val(data.rows["active"]);
}

$('#btn_save').on('click', function (e) {
    e.preventDefault();
    var action;
    var items = {};
    items.action = $('#action').val();
    items.id = $("#id").val();
    items.username = $("#username").val();
    items.password = $("#password").val();
    items.name = $("#name").val();
    items.user_type = $("#user_type").val();
    items.email = $("#email").val();
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

    if (!items.id) {
        swal("กรุณาระบุID");
        $("#id").focus();
    } else if (!items.username) {
        swal("กรุณาระบุUsername");
        $("#username").focus();
    } else if (!items.name) {
        swal("กรุณาระบุชื่อ สกุล");
        $("#name").focus();
    } else if (!items.user_type) {
        swal("กรุณาระบุระดับการใช้งาน");
        $("#user_type").focus();
    } else if (!items.email) {
        swal("กรุณาระบุE-mail");
        $("#email").focus();
    } else if (!items.active) {
        swal("กรุณาระบุสถานะผู้ใช้");
        $("#active").focus();
    }
    else {
        return true;
    }

}