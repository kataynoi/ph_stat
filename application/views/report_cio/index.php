<script src="<?php echo base_url() ?>assets/vendor/js/jquery.dataTables.min.js" charset="utf-8"></script>
<script src="<?php echo base_url() ?>assets/vendor/js/dataTables.bootstrap4.min.js" charset="utf-8"></script>
<link href="<?php echo base_url() ?>assets/vendor/css/dataTables.bootstrap4.min.css" rel="stylesheet">

<html>
<body>
<br>

<div class="row">
    <div class="panel panel-info ">
        <div class="panel-heading w3-theme">
            <i class="fa fa-user fa-2x "></i> สรุปผลการจัดการจข้อมูล CIO มหาสารคาม
            </span>

        </div>
        <div class="panel-body">

            <table id="table_data" class="table table-responsive">
                <thead>
                <tr>
                    <th>ตัวชี้วัด</th>
                    <th>ประเภทตัวชี้วัด</th>
                    <th>CIO ครั้งที่</th>
                    <th>อำเภอ</th>
                    <th>ร้อยละ</th>
                    <th>คะแนน(5)</th>
                </tr>
                </thead>

            </table>
        </div>

    </div>

</div>


<div class="modal fade" id="frmModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">เพิ่มสรุปผลการจัดการจข้อมูล CIO มหาสารคาม</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <input type="hidden" id="action" value="insert">
                <input type="hidden" class="form-control" id="row_id" placeholder="ROWID" value="">

                <div class="form-group">
                    <label for="kpi_name"></label>
                    <input type="text" class="form-control" id="kpi_name" placeholder="" value=""></div>
                <div class="form-group">
                    <label for="kpi_id"></label>
                    <input type="text" class="form-control" id="kpi_id" placeholder="" value=""></div>
                <div class="form-group">
                    <label for="kpi_type"></label>
                    <input type="text" class="form-control" id="kpi_type" placeholder="" value=""></div>
                <div class="form-group">
                    <label for="month_time"></label>
                    <input type="text" class="form-control" id="month_time" placeholder="" value=""></div>
                <div class="form-group">
                    <label for="amp"></label>
                    <input type="text" class="form-control" id="amp" placeholder="" value=""></div>
                <div class="form-group">
                    <label for="target"></label>
                    <input type="text" class="form-control" id="target" placeholder="" value=""></div>
                <div class="form-group">
                    <label for="result"></label>
                    <input type="text" class="form-control" id="result" placeholder="" value=""></div>
                <div class="form-group">
                    <label for="calc_result"></label>
                    <input type="text" class="form-control" id="calc_result" placeholder="" value=""></div>
                <div class="form-group">
                    <label for="point"></label>
                    <input type="text" class="form-control" id="point" placeholder="" value=""></div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="btn_save">Save</button>
                <button type="button" class="btn btn-danger" id="btn_close" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>


<script src="<?php echo base_url() ?>assets/apps/js/report_cio.js" charset="utf-8"></script>
