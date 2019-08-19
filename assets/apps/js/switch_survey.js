$(document).ready(function() {
    var dataTable = $('#table_data').DataTable({
        'createdRow': function (row, data, dataIndex) {
                    $(row).attr('name', 'row'+dataIndex);
                },
        "processing": true,
        "serverSide": true,
        "order": [],

        "pageLength": 50,
        "ajax": {
            url: site_url + '/switch_survey/fetch_switch_survey',
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
        var url = '/switch_survey/del_switch_survey',
            params = {
                id: id
            }

        app.ajax(url, params, function (err, data) {
            err ? cb(err) : cb(null, data);
        });
    },save:function (items,cb){
             var url = '/switch_survey/save_switch_survey',
                 params = {
                     items: items
                 }

             app.ajax(url, params, function (err, data) {
                 err ? cb(err) : cb(null, data);
             });
    },get_update:function (id,cb){
                   var url = '/switch_survey/get_switch_survey',
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

crud.save = function (items,row_id) {
    crud.ajax.save(items, function (err, data) {
        if (err) {
            //app.alert(err);
            swal(err);
        }
        else {
            if(items.action == 'insert'){
                crud.set_after_insert(items);
            }else if(items.action == 'update'){
                crud.set_after_update(items,row_id);
            }
            $('#frmModal').modal('toggle');
            swal('บันทึกข้อมูลเรียบร้อยแล้ว ');
        }
    });

}


crud.get_update = function (id,row_id) {
    crud.ajax.get_update(id, function (err, data) {
        if (err) {
            //app.alert(err);
            swal(err);
        }
        else {
                //swal('แก้ไขข้อมูลเรียบร้อยแล้ว ');
                //location.reload();
                crud.set_update(data,row_id);
        }
    });

}


crud.set_after_update = function (items,row_id) {

    var row_id = $('tr[name="' + row_id + '"]');
    row_id.find("td:eq(0)").html(items.id);row_id.find("td:eq(1)").html(items.switchtype);row_id.find("td:eq(2)").html(items.brand);row_id.find("td:eq(3)").html(items.switch_series);row_id.find("td:eq(4)").html(items.porttype);row_id.find("td:eq(5)").html(items.port);row_id.find("td:eq(6)").html(items.location);row_id.find("td:eq(7)").html(items.start_use);row_id.find("td:eq(8)").html(items.use_status);row_id.find("td:eq(9)").html(items.serial_number);row_id.find("td:eq(10)").html(items.ip);

}
crud.set_after_insert = function (items) {
    $('<tr><td></td>'+
        '<td>' +items.id+'</td>' +'<td>' +items.switchtype+'</td>' +'<td>' +items.brand+'</td>' +'<td>' +items.switch_series+'</td>' +'<td>' +items.porttype+'</td>' +'<td>' +items.port+'</td>' +'<td>' +items.location+'</td>' +'<td>' +items.start_use+'</td>' +'<td>' +items.use_status+'</td>' +'<td>' +items.serial_number+'</td>' +'<td>' +items.ip+'</td>' +
        '<td>-</td>' +
        '</tr>').insertBefore('table > tbody > tr:first');

}

crud.set_update = function (data,row_id) {
    $("#row_id").val(row_id);
    $("#id").val(data.rows["id"]);$("#switchtype").val(data.rows["switchtype"]);$("#brand").val(data.rows["brand"]);$("#switch_series").val(data.rows["switch_series"]);$("#porttype").val(data.rows["porttype"]);$("#port").val(data.rows["port"]);$("#location").val(data.rows["location"]);$("#start_use").val(data.rows["start_use"]);$("#use_status").val(data.rows["use_status"]);$("#serial_number").val(data.rows["serial_number"]);$("#ip").val(data.rows["ip"]);
}

$('#btn_save').on('click', function (e) {
    e.preventDefault();
    var action;
    var items = {};
    var row_id = $("#row_id").val();
    items.action = $('#action').val();
    // items.brand_name = $("#brand option:selected").text();
    items.id=$("#id").val();items.switchtype=$("#switchtype").val();items.brand=$("#brand").val();items.switch_series=$("#switch_series").val();items.porttype=$("#porttype").val();items.port=$("#port").val();items.location=$("#location").val();items.start_use=$("#start_use").val();items.use_status=$("#use_status").val();items.serial_number=$("#serial_number").val();items.ip=$("#ip").val();

          if(validate(items)){
                crud.save(items,row_id);
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
    var row_id = $(this).parent().parent().parent().attr('name');
    crud.get_update(id,row_id);
    $('#frmModal').modal('show');

});

function validate(items){

    if (!items.id) { swal("กรุณาระบุID");$("#id").focus();}else if (!items.switchtype) { swal("กรุณาระบุประเภทสวิทย์");$("#switchtype").focus();}else if (!items.brand) { swal("กรุณาระบุยี่ห้อ");$("#brand").focus();}else if (!items.switch_series) { swal("กรุณาระบุรุ่น");$("#switch_series").focus();}else if (!items.porttype) { swal("กรุณาระบุประเภทของPort");$("#porttype").focus();}else if (!items.port) { swal("กรุณาระบุ");$("#port").focus();}else if (!items.location) { swal("กรุณาระบุสถานที่ตั้ง");$("#location").focus();}else if (!items.start_use) { swal("กรุณาระบุปีที่เริ่มใช้งาน");$("#start_use").focus();}else if (!items.use_status) { swal("กรุณาระบุสถานะการใช้งาน");$("#use_status").focus();}else if (!items.serial_number) { swal("กรุณาระบุหมายเลจครุภัณฑ์");$("#serial_number").focus();}else if (!items.ip) { swal("กรุณาระบุIP");$("#ip").focus();}
    else{
        return true;
    }

}