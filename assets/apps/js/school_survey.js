$(document).ready(function () {
    var dataTable = $('#table_data').DataTable({
        language: {
            searchPlaceholder: "สถานศึกษา อำเภอ ตำบล รพ.สต"
        }
        ,
        'createdRow': function (row, data, dataIndex) {
            $(row).attr('name', 'row' + dataIndex);
        },
        "processing": true,
        "serverSide": true,
        "order": [],

        "pageLength": 50,
        "ajax": {
            url: site_url + '/school_survey/fetch_school_survey',
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
        var url = '/school_survey/del_school_survey',
            params = {
                id: id
            }

        app.ajax(url, params, function (err, data) {
            err ? cb(err) : cb(null, data);
        });
    }, save: function (items, cb) {
        var url = '/school_survey/save_school_survey',
            params = {
                items: items
            }

        app.ajax(url, params, function (err, data) {
            err ? cb(err) : cb(null, data);
        });
    }, get_update: function (id, cb) {
        var url = '/school_survey/get_school_survey',
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

crud.save = function (items, row_id) {
    crud.ajax.save(items, function (err, data) {
        if (err) {
            //app.alert(err);
            swal(err);
        }
        else {
            if (items.action == 'insert') {
                crud.set_after_insert(items, data.id);
            } else if (items.action == 'update') {
                crud.set_after_update(items, row_id);
            }
            $('#frmModal').modal('toggle');
            swal('บันทึกข้อมูลเรียบร้อยแล้ว ');
        }
    });

}


crud.get_update = function (id, row_id) {
    crud.ajax.get_update(id, function (err, data) {
        if (err) {
            //app.alert(err);
            swal(err);
        }
        else {
            //swal('แก้ไขข้อมูลเรียบร้อยแล้ว ');
            //location.reload();
            crud.set_update(data, row_id);
        }
    });

}


crud.set_after_update = function (items, row_id) {

    var row_id = $('tr[name="' + row_id + '"]');
    row_id.find("td:eq(7)").html(items.hospname);

}

crud.set_update = function (data, row_id) {
    $("#row_id").val(row_id);
    $("#hospcode").val(data.rows["hospcode"]);
}

$('#btn_save').on('click', function (e) {
    e.preventDefault();
    var action;
    var items = {};
    var row_id = $("#row_id").val();
    items.action = $('#action').val();
    items.hospcode = $("#hospcode").val();
    items.hospname = $("#hospcode option:selected").text();
    items.SCHOOLID = $("#SCHOOLID").val();

    if (validate(items)) {
        crud.save(items, row_id);
    }

});

crud.set_update = function (data, row_id) {
    $("#row_id").val(row_id);

    $("#SCHOOLID").val(data.rows["SCHOOLID"]);
    $("#SCHOOLNAME").val(data.rows["SCHOOLNAME"]);
    $("#SUBDISTRICTCODE").val(data.rows["SUBDISTRICTCODE"]);
    $("#TELEPHONE1").val(data.rows["TELEPHONE1"]);
    $("#JURISDICTIONID").val(data.rows["JURISDICTIONID"]);
    $("#ORGANIZATIONTYPECODE").val(data.rows["ORGANIZATIONTYPECODE"]);
    $("#hospcode").val(data.rows["hospcode"]);
}

$(document).on('click', 'button[data-btn="btn_edit"]', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    $('#action').val('update');
    $('#id').val(id);
    var row_id = $(this).parent().parent().parent().attr('name');
    $("#frmModal input").prop('disabled', true);
    $("#hospcode").prop('disabled', false);
    $("#btn_save").prop('disabled', false);
    $("#frmModal .btn").prop('disabled', false);

    crud.get_update(id, row_id);
    $('#frmModal').modal('show');

});

$(document).on('click', 'button[data-btn="btn_view"]', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    $('#action').val('update');
    $('#id').val(id);
    var row_id = $(this).parent().parent().parent().attr('name');
    crud.get_update(id, row_id);
    $("#frmModal input").prop('disabled', true);
    $("#frmModal select").prop('disabled', true);
    $("#frmModal textarea").prop('disabled', true);
    $("#frmModal .btn").prop('disabled', true);
    $("#btn_close").prop('disabled', false);
    $('#frmModal').modal('show');

});

function validate(items) {

    if (!items.hospcode) {
        swal("กรุณาระบุ");
        $("#hospcode").focus();
    }
    else {
        return true;
    }

}