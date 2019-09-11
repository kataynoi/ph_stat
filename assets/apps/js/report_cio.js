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
            url: site_url + '/report_cio/fetch_report_cio',
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
        var url = '/report_cio/del_report_cio',
            params = {
                id: id
            }

        app.ajax(url, params, function (err, data) {
            err ? cb(err) : cb(null, data);
        });
    },save:function (items,cb){
             var url = '/report_cio/save_report_cio',
                 params = {
                     items: items
                 }

             app.ajax(url, params, function (err, data) {
                 err ? cb(err) : cb(null, data);
             });
    },get_update:function (id,cb){
                   var url = '/report_cio/get_report_cio',
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
                crud.set_after_insert(items,data.id);
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
    row_id.find("td:eq(0)").html(items.kpi_name);row_id.find("td:eq(1)").html(items.kpi_id);row_id.find("td:eq(2)").html(items.kpi_type);row_id.find("td:eq(3)").html(items.month_time);row_id.find("td:eq(4)").html(items.amp);row_id.find("td:eq(5)").html(items.target);row_id.find("td:eq(6)").html(items.result);row_id.find("td:eq(7)").html(items.calc_result);row_id.find("td:eq(8)").html(items.point);

}
crud.set_after_insert = function (items,id) {

            $('<tr name="row'+(id+1)+'"><td>'+id+'</td>' +
                '<td>' +items.kpi_name+'</td>' +'<td>' +items.kpi_id+'</td>' +'<td>' +items.kpi_type+'</td>' +'<td>' +items.month_time+'</td>' +'<td>' +items.amp+'</td>' +'<td>' +items.target+'</td>' +'<td>' +items.result+'</td>' +'<td>' +items.calc_result+'</td>' +'<td>' +items.point+'</td>' +
                '<td><div class="btn-group pull-right" role="group">' +
                '<button class="btn btn-outline btn-success" data-btn="btn_view" data-id="' + id + '"><i class="fa fa-eye"></i></button>' +
                '<button class="btn btn-outline btn-warning" data-btn="btn_edit" data-id="' + id + '"><i class="fa fa-edit"></i></button>' +
                '<button class="btn btn-outline btn-danger" data-btn="btn_del" data-id="' + id + '"><i class="fa fa-trash"></i></button>' +
                '</td></div>' +
                '</tr>').insertBefore('table > tbody > tr:first');
}

crud.set_update = function (data,row_id) {
    $("#row_id").val(row_id);
    $("#kpi_name").val(data.rows["kpi_name"]);$("#kpi_id").val(data.rows["kpi_id"]);$("#kpi_type").val(data.rows["kpi_type"]);$("#month_time").val(data.rows["month_time"]);$("#amp").val(data.rows["amp"]);$("#target").val(data.rows["target"]);$("#result").val(data.rows["result"]);$("#calc_result").val(data.rows["calc_result"]);$("#point").val(data.rows["point"]);
}

$('#btn_save').on('click', function (e) {
    e.preventDefault();
    var action;
    var items = {};
    var row_id = $("#row_id").val();
    items.action = $('#action').val();
    // items.brand_name = $("#brand option:selected").text();
    items.kpi_name=$("#kpi_name").val();items.kpi_id=$("#kpi_id").val();items.kpi_type=$("#kpi_type").val();items.month_time=$("#month_time").val();items.amp=$("#amp").val();items.target=$("#target").val();items.result=$("#result").val();items.calc_result=$("#calc_result").val();items.point=$("#point").val();

          if(validate(items)){
                crud.save(items,row_id);
            }

});

$('#add_data').on('click', function (e) {
    e.preventDefault();
        $("#frmModal input").prop('disabled', false);
        $("#frmModal select").prop('disabled', false);
        $("#frmModal textarea").prop('disabled', false);
        $("#frmModal .btn").prop('disabled', false);
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
        $("#frmModal input").prop('disabled', false);
        $("#frmModal select").prop('disabled', false);
        $("#frmModal textarea").prop('disabled', false);
        $("#frmModal .btn").prop('disabled', false);

    crud.get_update(id,row_id);
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
    $("#frmModalselect").prop('disabled', true);
    $("#frmModaltextarea").prop('disabled', true);
    $("#frmModal .btn").prop('disabled', true);
    $("#btn_close").prop('disabled', false);
    $('#frmModal').modal('show');

});

function validate(items){

    if (!items.kpi_name) { swal("กรุณาระบุ");$("#kpi_name").focus();}else if (!items.kpi_id) { swal("กรุณาระบุ");$("#kpi_id").focus();}else if (!items.kpi_type) { swal("กรุณาระบุ");$("#kpi_type").focus();}else if (!items.month_time) { swal("กรุณาระบุ");$("#month_time").focus();}else if (!items.amp) { swal("กรุณาระบุ");$("#amp").focus();}else if (!items.target) { swal("กรุณาระบุ");$("#target").focus();}else if (!items.result) { swal("กรุณาระบุ");$("#result").focus();}else if (!items.calc_result) { swal("กรุณาระบุ");$("#calc_result").focus();}else if (!items.point) { swal("กรุณาระบุ");$("#point").focus();}
    else{
        return true;
    }

}