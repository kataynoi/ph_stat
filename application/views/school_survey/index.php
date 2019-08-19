<script src="<?php echo base_url() ?>assets/vendor/js/jquery.dataTables.min.js" charset="utf-8"></script>
<script src="<?php echo base_url() ?>assets/vendor/js/dataTables.bootstrap4.min.js" charset="utf-8"></script>
<link href="<?php echo base_url() ?>assets/vendor/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>

<html>
<body>
<br>

<div class="row">
    <div class="panel panel-info ">
        <div class="panel-heading w3-theme">
            <i class="fa fa-user fa-2x "></i> สถานศึกษาในจังหวัดมหาสารคาม

        </div>
        <div class="panel-body">

            <table id="table_data" class="table table-responsive">
                <thead>
                <tr>
                    <th>รหัสสถานศึกษา</th>
                    <th>ชื่อสถานศึกษา</th>
                    <th>อำเภอ</th>
                    <th>ที่ตั้ง</th>
                    <th>เบอร์โทรศัพย์</th>
                    <th>หน่วยบริการที่รับผิดชอบ</th>
                    <th>#</th>
                </tr>
                </thead>

            </table>
        </div>

    </div>

</div>


<div class="modal fade" id="frmModal"  role="dialog" style="overflow:hidden;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">เพิ่มสถานศึกษาในจังหวัดมหาสารคาม</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <input type="hidden" id="action" value="insert">
                <input type="hidden" class="form-control" id="row_id" placeholder="ROWID" value="">

                <div class="form-group">
                    <label for="SCHOOLID"></label>
                    <input type="text" class="form-control" id="SCHOOLID" placeholder="" value=""></div>
                <div class="form-group">
                    <label for="SCHOOLNAME"></label>
                    <input type="text" class="form-control" id="SCHOOLNAME" placeholder="" value=""></div>

                <div class="form-group">
                    <label for="SUBDISTRICTCODE">ที่ตั้ง</label>
                    <input type="text" class="form-control" id="SUBDISTRICTCODE" placeholder="" value=""></div>

                <div class="form-group">
                    <label for="TELEPHONE1">เบอร์โทร</label>
                    <input type="text" class="form-control" id="TELEPHONE1" placeholder="" value=""></div>
                <div class="form-group">
                    <label for="JURISDICTIONID">สังกัด</label>
                    <select class="form-control" id="JURISDICTIONID" placeholder="" value="">
                        <option>-------</option>
                        <?php
                        foreach ($cjurisdiction as $r) {
                            echo "<option value=$r->JurisdictionID > $r->JurisdictionName </option>";
                        } ?>
                    </select></div>
                <div class="form-group">
                    <label for="ORGANIZATIONTYPECODE">ประเภทสถานศึกษา</label>
                    <select class="form-control" id="ORGANIZATIONTYPECODE" placeholder="" value="">
                        <option>-------</option>
                        <?php
                        foreach ($corganizationtype as $r) {
                            echo "<option value=$r->OrganizationTypeID > $r->OrganizationTypeName </option>";
                        } ?>
                    </select></div>

                <div class="form-group">
                    <label for="hospcode">หน่วยบริการที่รับผิดชอบ</label>
                    <select  id="hospcode" placeholder="" value=""  class="hospcode form-control" name="state" style="width: 100%">
                        <?php
                        foreach ($chospital_mk as $r) {
                            echo "<option value=$r->hoscode >$r->hosname </option>";
                        } ?>
                    </select></div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="btn_save">Save</button>
                <button type="button" class="btn btn-danger" id="btn_close" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<script src="<?php echo base_url() ?>assets/apps/js/school_survey.js" charset="utf-8"></script>

