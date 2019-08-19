$(document).ready(function() {
    var dataTable = $('#table_data').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],

        "pageLength": 50,
        "ajax": {
            url: site_url + '/printer_survey/fetch_printer_survey',
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

crud .ajax = {
    del_data:function (id,cb){
        var url = '/printer_survey/del_printer_survey',
            params = {
                id: id
            }

        app.ajax(url, params, function (err, data) {
            err ? cb(err) : cb(null, data);
        });
    },save:function (items,cb){
             var url = '/printer_survey/save_printer_survey',
                 params = {
                     items: items
                 }

             app.ajax(url, params, function (err, data) {
                 err ? cb(err) : cb(null, data);
             });
    },get_update:function (id,cb){
                   var url = '/printer_survey/get_printer_survey',
                       params = {
                           id: id
                       }

                   app.ajax(url, params, function (err, data) {
                       err ? cb(err) : cb(null, data);
                   });
    }

};
crud.del_data = function(id){

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
    $("#id").val(data.rows["id"]);$("#printertype").val(data.rows["printertype"]);$("#brand").val(data.rows["brand"]);$("#printer_series").val(data.rows["printer_series"]);$("#printer_color").val(data.rows["printer_color"]);$("#port").val(data.rows["port"]);$("#location").val(data.rows["location"]);$("#start_user").val(data.rows["start_user"]);$("#use_status").val(data.rows["use_status"]);$("#serial_number").val(data.rows["serial_number"]);$("#ip").val(data.rows["ip"]);
}

$('#btn_save').on('click', function (e) {
    e.preventDefault();
    var action;
    var items = {};
    items.action = $('#action').val();
    items.id=$("#id").val();items.printertype=$("#printertype").val();items.brand=$("#brand").val();items.printer_series=$("#printer_series").val();items.printer_color=$("#printer_color").val();items.port=$("#port").val();items.location=$("#location").val();items.start_user=$("#start_user").val();items.use_status=$("#use_status").val();items.serial_number=$("#serial_number").val();items.ip=$("#ip").val();

          if(validate(items)){
                crud.save(items);
            }

});

$('#add_data').on('click', function (e) {
    e.preventDefault();
    app.clear_form();
});

$(document).on('click', 'button[data-btn="btn_del"]', function(e) {
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
    }).then(function(isConfirm){
        if(isConfirm){
            crud.del_data(id);
            td.hide();
        }
    });
});

$(document).on('click', 'button[data-btn="btn_edit"]', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    $('#action').val('update');
    $('#id').val(id);
    crud.get_update(id);
    $('#frmModal').modal('show');

});

function validate(items){

    if (!items.id) { swal("กรุณาระบุID");$("#id").focus();}else if (!items.printertype) { swal("กรุณาระบุประเภทปริ้นเตอร์");$("#printertype").focus();}else if (!items.brand) { swal("กรุณาระบุยี่ห้อ");$("#brand").focus();}else if (!items.printer_series) { swal("กรุณาระบุรุ่น");$("#printer_series").focus();}else if (!items.printer_color) { swal("กรุณาระบุปริ้นสี/ขาวดำ");$("#printer_color").focus();}else if (!items.port) { swal("กรุณาระบุPort การเชื่อมต่อ");$("#port").focus();}else if (!items.location) { swal("กรุณาระบุสถานที่ตั้ง");$("#location").focus();}else if (!items.start_user) { swal("กรุณาระบุปีที่เริ่มใช้งาน");$("#start_user").focus();}else if (!items.use_status) { swal("กรุณาระบุสถานะการใช้งาน");$("#use_status").focus();}else if (!items.serial_number) { swal("กรุณาระบุหมายเลจครุภัณฑ์");$("#serial_number").focus();}else if (!items.ip) { swal("กรุณาระบุIP");$("#ip").focus();}
    else{
        return true;
    }

}