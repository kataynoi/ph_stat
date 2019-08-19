<br>
<div class="">
    <div class="panel panel-info">
        <div class="panel-heading">
            User Profile
        </div>
        <div class="panel-body">
            <div class="col-md-3">


                <img class="rounded float-left img-thumbnail" height="200px"
                     src=<?php echo base_url('assets/images/users/') .$user_profiles['id']. ".jpg" ?>>

            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-8">
                        <ul class="list-group">
                            <?php
                            echo "<li class='list-group-item'><i class='fas fa-user-circle fa-2x' color='w3-theme' ></i> " . $user_profiles['fullname'] . "</li>";
                            echo "<li class='list-group-item'><i class='fas fa-envelope fa-2x' ></i> " . $user_profiles['email'] . "</li>";
                            echo "<li class='list-group-item'><i class='fas fa-home fa-2x' ></i> " . $user_profiles['hospname'] . "</li>";
                            echo "<li class='list-group-item'><i class='fas fa-layer-group fa-2x' ></i> " . $user_profiles['group_name'] . "</li>";
                            echo "<li class='list-group-item'><i class='fas fa-address-book fa-2x' ></i> " . $user_profiles['position'] . "</li>";
                            echo "<li class='list-group-item'><i class='fas fa-phone fa-2x' ></i> " . $user_profiles['user_mobile'] . "</li>";
                            if($user_profiles['id'] == $this->session->userdata('id')){

                            ?>

                            <li class="list-group-item text-center">
                                <button class="btn btn-info" id="btn_edit_profiles" data-target="#modalEditProfiles"
                                        data-toggle="modal"><i class="fa fa-edit"></i> Edit Profiles
                                </button>
                                <button class="btn btn-warning" id="btn_edit_password" data-target="#modalEditPassword"
                                        data-toggle="modal"><i class="fa fa-user-secret"></i> Change Password
                                </button>
                            </li>
                            <?php
                            }
                            ?>
                        </ul

                    </div>
                </div>

            </div>

        </div>
    </div>
</div>


<!--//Modal-->
<div class="modal fade" tabindex="-1" role="dialog" id="modalEditProfiles">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit User Profiles</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Modal Body-->

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="prename">คำนำหน้า</label>
                                <input type="text" class="form-control" id="prename"
                                       placeholder="นาย" value="<?php echo $user_profiles['prename']?>"
                                    >
                            </div>
                            <div class="col-md-8">
                                <label for="name">ชื่อ-สกุล</label>
                                <input type="text" class="form-control" id="name"
                                       placeholder="ทดสอบ สมใจนึก" value="<?php echo $user_profiles['name']?>"
                                    >
                            </div>

                            </div>

                        </div>
                        <label for="name">เลขบัตรประชาชน</label>
                        <input type="text" class="form-control" id="cid"
                               placeholder="3440120000000" value="<?php echo $user_profiles['cid']?>"  >
                        <label for="name">Username</label>
                        <input type="text" class="form-control" id="username"
                               placeholder="" value="<?php echo $user_profiles['username']?>"  >
                        <label for="name">หน่วยบริการ</label>
                            <select class="form-control" id="hospcode">
                                <?php

                                    foreach($office as $hp){
                                        if($user_profiles['hospcode'] == $hp->hoscode){ $s ='selected';}else{$s =''; }
                                        echo "<option value='$hp->hoscode' $s >$hp->hosname</option>";
                                    }
                                ?>
                            </select>
                            <label for="name">กลุ่มงาน</label>
                            <select class="form-control" id="group">
                                <?php

                                    foreach($group as $g){
                                        if($user_profiles['group'] == $g->id){ $s ='selected';}else{$s =''; }
                                        echo "<option value='$g->id' $s >$g->name</option>";
                                    }
                                ?>
                            </select>
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control" id="email"
                               placeholder="name@example.com" value="<?php echo $user_profiles['email']?>">
                <label for="name">ประเภทพนักงาน</label>
                <select class="form-control" id="employee_type">
                    <?php

                    foreach($employee_type as $g){
                        if($user_profiles['employee_type'] == $g->id){ $s ='selected';}else{$s =''; }
                        echo "<option value='$g->id' $s >$g->name</option>";
                    }
                    ?>
                </select>
                      <label for="position">ตำแหน่ง</label>
                        <input type="text" class="form-control" id="position"
                               placeholder="นักวิชาการสาธารณสุขชำนาญการ" value="<?php echo $user_profiles['position']?>">
                    <label for="position">เบอร์โทร</label>
                        <input type="text" class="form-control" id="user_mobile"
                               placeholder="0830000000" value="<?php echo $user_profiles['user_mobile']?>">

                <!--End Modal Body-->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn_save_profiles">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="hidden" class="form-control" id="id"
                       placeholder="นาย" value="<?php echo $user_profiles['id']?>">
            </div>
        </div>
    </div>
</div>

<!--End Modal-->

<!--Start Modal Edit Password-->
<div class="modal fade" tabindex="-1" role="dialog" id="modalEditPassword">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Modal Body-->
                <form>
                    <label for="password">New Password</label>
                    <input type="text" class="form-control" id="password" placeholder="name@example.com">
                    <label for="re_password">Confirm New Password</label>
                    <input type="password" class="form-control" id="re_password" placeholder="name@example.com">
            </form>
            <!--End Modal Body-->
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="btn_save_password">Save changes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
</div>
<!--End Modal Modal Edit Password-->

<script src="<?php echo base_url() ?>assets/apps/js/users.profiles.js" charset="utf-8"></script>