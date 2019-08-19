<script src="<?php echo base_url()?>vendor/DataTables-1.10.18/js/jquery.dataTables.min.js" charset="utf-8"></script>
<script src="<?php echo base_url()?>vendor/DataTables-1.10.18/js/dataTables.bootstrap4.min.js" charset="utf-8"></script>
<link href="<?php echo base_url()?>vendor/DataTables-1.10.18/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<html>
<body>
<br>
<div class="row">
    <div class="panel panel-info">
        <div class="panel-heading">
            <i class="fa fa-user fa-2x "></i> จัดการข้อมูลผู้ใช้งาน
        </div>
        <div class="panel-body">
            <table id="user_data" class="table table-responsive">
                <thead>
                <tr>
                    <th width="10%">UserID</th>
                    <th width="35%">ชื่อ สกุล</th>
                    <th width="35%">ตำแหน่ง</th>
                    <th width="10%">Edit</th>
                    <th width="10%">Delete</th>
                </tr>
                </thead>
            </table>
        </div>

    </div>

    </div>
</body>
</html>
<script type="text/javascript" language="javascript" >
    $(document).ready(function(){
        var dataTable = $('#user_data').DataTable({
            "processing":true,
            "serverSide":true,
            "order":[],
            "pageLength": 50,
            "ajax":{
                url:"<?php echo base_url() . 'admin/fetch_user'; ?>",
                type:"POST"
            },
            "columnDefs":[
                {
                    "targets":[2,3],
                    "orderable":false,
                },
            ],
        });
    });
</script>