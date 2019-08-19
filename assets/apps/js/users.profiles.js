$(document).ready(function(){

    var users = {};
    users.ajax = {
        save_edit_user: function (items, cb) {
            var url = '/user/save_edit_profile',
                params = {
                    items: items,
                }
            app.ajax(url, params, function (err, data) {
                err ? cb(err) : cb(null, data);
            });
        },save_edit_password: function (items, cb) {
            var url = '/user/save_edit_password',
                params = {
                    items: items,
                }
            app.ajax(url, params, function (err, data) {
                err ? cb(err) : cb(null, data);
            });
        }
    };

    users.save_edit_user = function(items){
        console.log('SAve_alax');
        users.ajax.save_edit_user(items, function (err, data) {
            if (err) {
                app.alert(err);
            }
            else {
                swal('แก้ไขข้อมูล เรียบร้อยแล้ว');
                $('#modalEditProfiles').modal('hide');
                location.reload();
            }
        });
    }

    users.save_edit_password = function(items){

        users.ajax.save_edit_password(items, function (err, data) {
            if (err) {
                app.alert(err);
            }
            else {
                swal('แก้ไขข้อมูล เรียบร้อยแล้ว');
                $('#modalEditPassword').modal('hide');
                window.location = site_url+"user/logout";
            }
        });
    }
    $('#btn_save_profiles').on('click',function(e){
        e.preventDefault();
        var items={};
        items.id=$('#id').val();
        items.prename = $('#prename').val();
        items.username=$('#username').val();
        items.name = $('#name').val();
        items.cid=$('#cid').val();
        items.hospcode=$('#hospcode').val();
        items.group=$('#group').val();
        items.employee_type=$('#employee_type').val();
        items.email=$('#email').val();
        items.user_mobile=$('#user_mobile').val();
        items.position=$('#position').val();
        items.action='update';
        if (!items.name) {
            swal('กรุณาระบุ ชื่อสกุล');
            $('#name').focus();
        } else if (items.cid.length<13) {
            swal('กรุณาระบุ เลขบัตรประชาชนให้ถูกต้อง');
            $('#cid').focus();
        }else if (!items.email) {
            swal('กรุณาระบุ email');
            $('#email').focus();
        }else if(!items.username){
            swal('กรุณาระบุ Username');
            $('#username').focus();
        }else{
            console.log(items);
            console.log('Test save Profiles');
            users.save_edit_user(items);
        }
    })

    $('#btn_save_password').on('click',function(e){
        e.preventDefault();
        var items={};
        items.id=$('#id').val();
        items.password = $('#password').val();
        items.re_password = $('#re_password').val();
        if (!items.password) {
            swal('กรุณาระบุ Password');
            $('#password').focus();
        } else if (items.password.length<4) {
            swal('กรุณาระบุ Password ให้มากกว่า 4 หลัก');
            $('#password').focus();
        }else if (items.password != items.re_password ) {
            swal('กรุณาระบุ Password  ให้ตรงกัน');
            $('#re_password').focus();
        }else{
            console.log(items);
            users.save_edit_password(items);
        }
    });
});