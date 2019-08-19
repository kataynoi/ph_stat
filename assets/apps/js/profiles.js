$(document).ready(function(){

    var users_profiles = {};

    users_profiles.ajax = {
        save_edit_user: function (items, cb) {
            var url = '/user/do_auth',
                params = {
                    items: items,
                }
            app.ajax(url, params, function (err, data) {
                err ? cb(err) : cb(null, data);
            });
        }

    };

    users_profiles.save_edit_user = function(items){
        console.log(items);
        users_profiles.ajax.save_edit_user(items, function (err, data) {
            if (err) {
                app.alert(err);
            }
            else {
                alert('แก้ไขข้อมูล เรียบร้อยแล้ว กรุณาเข้าสู่ระบบ อีคกรั้ง');
            }
        });
    }

    $('#btn_edit_profiles').on('click',function(){
        console.log('Test');
        $('#modalEditProfiles').on('shown.bs.modal', function () {
            $('#myInput').trigger('focus')
        })

    });

    $('#btn_edit_password').on('click',function(){
        console.log('Test');
        $('#modalEditPassword').on('shown.bs.modal', function () {
            $('#myInput').trigger('focus')
        })

    });
    $('#btn_save_profiles').on('click',function(){

        var items={};
        items.id=$('#id').val();
        items.prename = $('#prename').val();
        items.username=$('#username').val();
        items.name = $('#name').val();
        items.cid=$('#cid').val();
        items.hospcode=$('#hospcode').val();
        items.email=$('#email').val();
        items.user_mobile=$('#user_mobile').val();
        items.position=$('#position').val();
        items.action=$='update';
        if (!items.name) {
            app.alert('กรุณาระบุ ชื่อสกุล');
            $('#name').focus();
        } else if (items.cid.length<13) {
            app.alert('กรุณาระบุ เลขบัตรประชาชนให้ถูกต้อง');
            $('#newPass').focus();
        }else if (!items.email) {
            app.alert('กรุณาระบุ email');
            $('#email').focus();
        }else if(!items.username){
            app.alert('กรุณาระบุ Username');
            $('#username').focus();
        }else{
            console.log(items);
            console.log('Test save Profiles');
            users_profiles.save_edit_user(items);
        }
    });

});