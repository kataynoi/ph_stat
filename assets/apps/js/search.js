$(document).ready(function() {

});

var approve_index = {};

approve_index.ajax = {
    del_outsite:function (id,cb){
        var url = '/outsite/del_outsite',
            params = {
                id: id
            }

        app.ajax(url, params, function (err, data) {
            err ? cb(err) : cb(null, data);
        });
    },
    save_used_car:function (items,cb){
        var url = '/car/save_used_car',
            params = {
                items: items
            }

        app.ajax(url, params, function (err, data) {
            err ? cb(err) : cb(null, data);
        });
    }

};


approve_index.del_outsite = function(id){

    approve_index.ajax.del_outsite(id, function (err, data) {
        if (err) {
            swal(err)
        }
        else {
            //swal('ลบข้อมูลเรียบร้อย')
            app.alert('ลบข้อมูลเรียบร้อย');

        }
    });
}
approve_index.save_used_car = function(items){

    approve_index.ajax.save_used_car(items, function (err, data) {
        if (err) {
            swal(err)
        }
        else {
            //swal('ลบข้อมูลเรียบร้อย')
            app.alert('บันทึกข้อมูลเรียบร้อย');
            location.reload();

        }
    });
}



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
            approve_index.del_used_car(id);
            td.hide();
        }
    });
});

$('#btn_search_link').click(function(){
    var items = {};
    items.txt_search = $('#txt_search_link').val();
    swal('Search Text'+items.txt_search);
    //approve_index.save_used_car(items);


});



function hide_frm_approve(){
    $('#frm_approve').hide();
    $('#frm_not_approve').fadeIn();
}

function show_frm_approve(){
    $('#frm_approve').fadeIn();
    $('#frm_not_approve').hide();
}


// btn_Demographic
