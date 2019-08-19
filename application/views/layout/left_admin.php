<div class="sidebar w3-theme-l5" role="navigation" style="padding-top: 15px;margin-top: 54px;">
    <div class="sidebar-nav navbar-collapse" id="left_slide">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" id="txt_search_link" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button" id="btn_search_link">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                </div>
                <!-- /input-group -->
            </li>
            <li>
                <a href="<?php echo site_url('admin'); ?>"><i class="fas fa-chart-line"></i> Dashboard</a>
            </li>
            <li>
                <a href="<?php echo site_url('outsite') ?>"><i class="fa fa-bus fa-fw"></i> จัดการแฟ้มพื้นฐาน<span
                        class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?php echo site_url('admin_computertype') ?>"><i
                                class="fa fa-angle-double-right  "></i> ประเภทคอมพิวเตอร์ </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('admin_workgroup') ?>"><i class="fa fa-angle-double-right  "></i>
                            จัดการข้อมูลกลุ่มงาน</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('admin_brand') ?>"><i class="fa fa-angle-double-right  "></i>
                            จัดการ Brand Computer</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('admin_cpu') ?>"><i class="fa fa-angle-double-right  "></i> จัดการ
                            CPU</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('admin_operating_system') ?>"><i
                                class="fa fa-angle-double-right  "></i> จัดการ ระบบปฏิบัติการ OS</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('admin_office') ?>"><i class="fa fa-angle-double-right  "></i>
                            จัดการโปรแกรม Office</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('admin_location') ?>"><i class="fa fa-angle-double-right  "></i>
                            สถานที่ตั้งอุปกรณ์</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('admin_use_status') ?>"><i class="fa fa-angle-double-right  "></i>
                            สถานะการใช้งานอุปกรณ์</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('admin_cbrand_series') ?>"><i
                                class="fa fa-angle-double-right  "></i> รุ่นอุปกรณ์</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('admin_printertype') ?>"><i class="fa fa-angle-double-right  "></i>
                            ประเภทปริ้นเตอร์</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('admin_switchtype') ?>"><i class="fa fa-angle-double-right  "></i>
                            ประเภทอุปกรณ์กระจายสัญญาณ</a>
                    </li>


                </ul>
                <!-- /.nav-second-level -->

            </li>
            <li>
                <a href="<?php echo site_url('outsite') ?>"><i class="fa fa-bus fa-fw"></i>
                    จัดการสิทธิ์การใช้งานระบบ<span
                        class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?php echo site_url('admin_user') ?>"><i class="fa fa-angle-double-right  "></i> จัดการ
                            Users </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('admin_role') ?>"><i class="fa fa-angle-double-right  "></i>
                            จัดการระดับสิทธิ์การใช้งาน </a>
                    </li>
                </ul>
            </li>


            <li>
                <a href="<?php echo site_url('admin_employee') ?>"><i class="fa fa-user fa-fw"></i> จัดการข้อมูลพนักงาน</a>
            </li>

        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>

