/**
 * Created by Spider on 19/7/2562.
 */
var num_filed = 0;
var all_field = new Array();
var all_comment = new Array();
$('#alert').hide();
$(document).on('click', 'input[type="checkbox"]', function (e) {
    // e.preventDefault();
    var filed = $(this).data('filed');
    var column = $(this).data('comment');

    if ($(this).prop("checked") == true) {
        crud.set_select(filed, column);
    }
    else if ($(this).prop("checked") == false) {
        crud.unset_select(filed, column);

    }

});

var crud = {};

crud.set_select = function (filed, column) {
    if ($('#select').val() == '') {
        var val = filed;
        var com = column
    } else {
        var val = $('#select').val() + ',' + filed;
        var com = $('#column').val() + ',' + column;
    }
    $('#select').val(val);
    $('#column').val(com);


}
crud.unset_select = function (filed, column) {

    var val = $('#select').val();
    var val2 = val.replace(filed + ',', '');
    var val3 = val2.replace(',' + filed, '');
    $('#select').val(val3);

    var co = $('#column').val();
    var co2 = co.replace(filed + ',', '');
    var co3 = co2.replace(',' + filed, '');
    $('#column').val(co3);
}
crud.ajax = {
    create_crud: function (items, cb) {
        var url = '/admin_query/create_report',
            params = {
                items: items
            }

        app.ajax(url, params, function (err, data) {
            err ? cb(err) : cb(null, data);
        });
    },
    test_query: function (sql, cb) {
        var url = '/admin_query/test_query',
            params = {
                sql: sql
            }

        app.ajax(url, params, function (err, data) {
            err ? cb(err) : cb(null, data);
        });
    }
};

crud.create_crud = function (items) {
    crud.ajax.create_crud(items, function (err, data) {
        if (err) {
            //app.alert(err);
            swal(err);
        }
        else {

            swal('บันทึกข้อมูลเรียบร้อยแล้ว ');
            $('#alert').empty();
            $('#alert').append(
                data.msg +
                '<br><a href="' + site_url + '/' + data.ctrl + '" target="_bank"> Link To View</a>'
            );
            $('#alert').show();

        }
    });

}

crud.set_table = function (data) {
    // console.log(data.success);
    var column = Object.keys(data.rows[0]).length;
    var column = Object.keys(data.rows[0]);
    var html_head = '';
    var html_body = '';
    var header = '';
    var select ='';
    if (data.success) {
        var no = 1;
        $('#tbl_list > tbody').empty();
        $('#tbl_list > thead').empty();

        if (_.size(data.rows) > 0) {
            _.each(data.rows, function (name, key) {
                if (no == 1) {
                    html_body += '<tr>';
                    _.each(name, function (name, key) {
                        html_body += '<th class="row">' + key + '</th>';
                        if (select == '') {
                            select+=key;
                        }else{
                            select+=','+key;
                        }

                    });
                    html_body += '</tr>';
                    $('#select').val(select);
                }
                html_body += '<tr>';
                _.each(name, function (name, key) {
                    html_body += '<td class="row">' + name + '</td>';
                });
                html_body += '</tr>';
                no++
            });

            $('#tbl_list > tbody').append(html_body);
            $('#tbl_list > thead').append(html_head);
        }
        else {
            $('#tbl_list > tbody').append('<tr><td colspan="4">ไม่พบรายการ</td></tr>');
        }
    } else {
        swal('ไม่พบข้อมูล');
    }
}
crud.test_query = function (sql) {
    crud.ajax.test_query(sql, function (err, data) {
        if (err) {
            swal(err);
        }
        else {
            console.log(data.rows.length);
            ///crud.set_filedName();
            crud.set_table(data);

        }
    });

}

$('#btn_create_crud').click(function (e) {
    e.preventDefault();
    var items = {};
    items.ctrl = $('#ctrl').val();
    items.sql = $('#sql').val();
    items.select = $('#select').val();
    items.column = $('#column').val();
    items.search_txt = $('#search_txt').val();
    items.view_name = $('#view_name').val();
    var items_s = new Array();
    $("tbody>tr").each(function (index) {
        var val2 = $(this).find("select").val();
        var val3 = $(this).find("input[type=text]").val();
        items_s[index] = all_field[index] + ',' + all_comment[index] + ',' + val2 + ',' + val3;
    });
    items.formcreate = items_s;
    console.log(items_s);

    swal({
        title: "คำเตือน?",
        text: "คุณต้องการสร้าง CRUD ",
        icon: "warning",
        buttons: [
            'cancel !',
            'Yes !'
        ],
        dangerMode: true,
    }).then(function (isConfirm) {
        if (isConfirm) {
            crud.create_crud(items);
        }
    });
});
$('#btn_sql_test').click(function (e) {
    e.preventDefault();
    var sql = $('#sql').val();
    console.log(sql);
    crud.test_query(sql);

});