<script src="<?php echo base_url() ?>assets/vendor/js/jquery.dataTables.min.js" charset="utf-8"></script>
<script src="<?php echo base_url() ?>assets/vendor/js/dataTables.bootstrap4.min.js" charset="utf-8"></script>
<link href="<?php echo base_url() ?>assets/vendor/css/dataTables.bootstrap4.min.css" rel="stylesheet">

<html>
<body>
<br>

<div class="row">
    <div class="panel panel-info ">
        <div class="panel-heading w3-theme">
            <i class="fa fa-user fa-2x "></i> จำนวนการบันทึกข้อมูลโรงเรียน
        </div>
        <div class="panel-body">

            <table id="table_data" class="table table-responsive">
                <thead>
                <tr>
                    <th>อำเภอ</th><th>ชื่ออำเภอ</th><th>รวมโรงเรียนทั้งหมด</th><th> บันทึกข้อมูลแล้ว</th><th>ยังไม่บันทึข้อมูล</th>
                    <th>#</th>
                </tr>
                </thead>

            </table>
        </div>

    </div>

</div>
<script src="<?php echo base_url() ?>assets/apps/js/report_completeSchool.js" charset="utf-8"></script>
