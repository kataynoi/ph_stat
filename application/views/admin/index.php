<script src="<?php echo base_url() ?>assets/vendor/js/jquery.dataTables.min.js" charset="utf-8"></script>
<script src="<?php echo base_url() ?>assets/vendor/js/dataTables.bootstrap4.min.js" charset="utf-8"></script>
<link href="<?php echo base_url() ?>assets/vendor/css/dataTables.bootstrap4.min.css" rel="stylesheet">

<html>
<body>
<br>

<div class="row">
    <div class="panel panel-info ">
        <div class="panel-heading w3-theme">
            <i class="fa fa-user fa-2x "></i> หราการอุปกรณ์
            <button class="btn btn-success pull-right" id="add_data" data-toggle="modal" data-target="#frmModal"><i
                    class="fa fa-plus-circle"></i> Add
            </button>
            </span>

        </div>
        <div class="panel-body">

            <table id="table_data" class="table table-responsive">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>อุปกรณ์</th>
                    <th>จำนวนทั้งหมด</th>
                    <th> ใช้งานไม่ได้</th>
                    <th>ใช้งานได้ควรเปลี่ยนเครื่องใหม่</th>
                    <th>ใช้งานได้แต่ควร Upgrate</th>
                    <th>ใช้งานได้</th>
                    <th>ใช้งานได้ดีปกติ</th>
                    <th>รอจำหน่าย</th>
                    <th>#</th>
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
                <h4 class="modal-title">เพิ่มหราการอุปกรณ์</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <input type="hidden" id="action" value="insert">

                <div class="form-group">
                    <label for="id"></label>
                    <input type="text" class="form-control" id="id" placeholder="" value=""></div>
                <div class="form-group">
                    <label for="equipment_id">อุปกรณ์</label>
                    <select class="form-control" id="equipment_id" placeholder="อุปกรณ์" value="">
                        <option>-------</option>
                        <?php
                        foreach ($cequipment as $r) {
                            if ($data["invit_type"] == $r->id) {
                                $s = "selected";
                            } else {
                                $s = "";
                            }
                            echo "<option value=$r->id $s > $r->name </option>";
                        } ?>
                    </select></div>
                <div class="form-group">
                    <label for="total"></label>
                    <input type="text" class="form-control" id="total" placeholder="" value=""></div>
                <div class="form-group">
                    <label for="status"></label>
                    <select class="form-control" id="status" placeholder="" value="">
                        <option>-------</option>
                        <?php
                        foreach ($use_status as $r) {
                            if ($data["invit_type"] == $r->id) {
                                $s = "selected";
                            } else {
                                $s = "";
                            }
                            echo "<option value=$r->id $s > $r->name </option>";
                        } ?>
                    </select></div>
                <div class="form-group">
                    <label for="id"></label>
                    <input type="text" class="form-control" id="id" placeholder="" value=""></div>
                <div class="form-group">
                    <label for="equipment_id">อุปกรณ์</label>
                    <input type="text" class="form-control" id="equipment_id" placeholder="อุปกรณ์" value=""></div>
                <div class="form-group">
                    <label for="total">จำนวนทั้งหมด</label>
                    <input type="text" class="form-control" id="total" placeholder="จำนวนทั้งหมด" value=""></div>
                <div class="form-group">
                    <label for="status1"> ใช้งานไม่ได้</label>
                    <input type="text" class="form-control" id="status1" placeholder=" ใช้งานไม่ได้" value=""></div>
                <div class="form-group">
                    <label for="status2">ใช้งานได้ควรเปลี่ยนเครื่องใหม่</label>
                    <input type="text" class="form-control" id="status2" placeholder="ใช้งานได้ควรเปลี่ยนเครื่องใหม่"
                           value=""></div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="btn_save">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>


<script src="<?php echo base_url() ?>assets/apps/js/admin.js" charset="utf-8"></script>

<!--         foreach ($invit_type as $r) {
                                if ($outsite["invit_type"] == $r->id) {
                                    $s = "selected";
                                } else {
                                    $s = "";
                                }
                                echo "<option value=" $r->id" $s > $r->name </option>";

}
-->