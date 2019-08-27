<html>
<body>

<div class="row">
    <div class="panel panel-info ">
        <div class="panel-heading w3-theme">
            <i class="fa fa-user fa-2x "></i> ข้อมูลผู้ขอรับเกียรติบัตร
</span>

        </div>
        <div class="panel-body">

            <form>
                <div class="form-group">
                    <label for="exampleInputPassword1">SQl Query</label>
                    <textarea style="display: none" class="form-control" rows="10" placeholder="Sql" id="sql"> SELECT LEFT(a.SUBDISTRICTCODE,4) as ampcode,b.ampurname,
count(*) as total,SUM(IF(a.hospcode IS NOT NULL,1,0)) as complete ,
SUM(IF(a.hospcode IS NULL,1,0)) as uncomplete
FROM school as a
LEFT JOIN campur as b ON LEFT(SUBDISTRICTCODE,4) = b.ampurcodefull
GROUP BY LEFT(SUBDISTRICTCODE,4)
-- ORDER BY total DESC;</textarea>

                    <button class="btn btn-success" id="btn_sql_test"> Query Test</button>
                </div>
                <div >
                    <table class="table table-responsive" id="tbl_list">
                        <thead>

                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </form>




        </div>

    </div>

</div>

<script src="<?php echo base_url() ?>assets/apps/js/admin_query.js" charset="utf-8"></script>