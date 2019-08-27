<script src="<?php echo base_url()?>assets/vendor/js/jquery.min.js"></script>
<!-- Bootstrap Core CSS -->
<link href="<?php echo base_url()?>assets/vendor/css/bootstrap.css" rel="stylesheet">
<link href="<?php echo base_url()?>assets/vendor/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue.css">
<!------ Include the above in your HEAD tag ---------->
<link href='https://fonts.googleapis.com/css?family=Kanit' rel='stylesheet'>
<script type="text/javascript" charset="utf-8">
    var site_url = '<?php echo site_url()?>';
    var base_url = '<?php echo base_url()?>';
    var csrf_token = '<?php echo $this->security->get_csrf_hash(); ?>';
</script>
<style>
    body {
        font-family: 'Kanit', sans-serif;
    }
</style>
<style>
    @CHARSET "UTF-8";
    /*
    over-ride "Weak" message, show font in dark grey
    */

    .progress-bar {
        color: #333;
    }

    /*
    Reference:
    http://www.bootstrapzen.com/item/135/simple-login-form-logo/
    */

    * {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        outline: none;
    }

    .form-control {
        position: relative;
        font-size: 16px;
        height: auto;
        padding: 10px;
    @include box-sizing(border-box);

    &:focus {
         z-index: 2;
     }
    }

    body {

        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        font-family: 'Kanit', sans-serif;
        font-size: 90%;

    }

    .login-form {
        margin-top: 60px;
    }

    form[role=login] {
        color: #5d5d5d;
        background: #f2f2f2;
        padding: 26px;
        border-radius: 10px;
        -moz-border-radius: 10px;
        -webkit-border-radius: 10px;
    }
    form[role=login] img {
        display: block;
        margin: 0 auto;
        margin-bottom: 35px;
    }
    form[role=login] input,
    form[role=login] button {
        font-size: 18px;
        margin: 16px 0;
    }
    form[role=login] > div {
        text-align: center;
    }

    .form-links {
        text-align: center;
        margin-top: 1em;
        margin-bottom: 50px;
    }
    .form-links a {
        color: #fff;
    }
</style>
<body class=" w3-theme">


<div class="container w3-theme">

    <div class="row" id="pwd-container">
        <div class="col-md-4">
            <section class="login-form">
                <form method="post" action="#" role="login" id="frm_login">
                    <img width="100px" src="<?php echo base_url('assets/img/logo.png')?>" class="img-responsive" alt="" />
                    <input type="email" id="username" placeholder="Username" required class="form-control input-lg" value="" />

                    <input type="password" class="form-control input-lg" id="password" placeholder="Password" required="" />
                    <div class="pwstrength_viewport_progress"></div>
                    <input type="hidden" name="csrf_token" value="<?php echo $this->security->get_csrf_hash() ?>">
                </form method="post">
                <button name="go" class=" btn btn-lg  btn-block w3-theme-d1" id="btn_login">Sign in</button>
                <div>
                    <!--<a href="#">Create account</a> or <a href="#">reset password</a>-->
                </div>
            </section>
        </div>
<div class="col-md-1 "></div>
        <div class="col-md-7">
            <section class="login-form">
            <div class="panel w3-theme">
                <div class="panel-heading">
                     <i class="fa fa-bullhorn fa-2x"></i>  ประกาศ
                </div>
                <div class="panel-body">
                    1. กระทรวงสาธารณสุขจะทำการเชื่อโยงข้อมูล นักเรียนและข้มูลโรงเรียน<br>
                    2. แจ้งทุกหน่วยบริการบันทึกข้อมูล รพ.สต. ที่รับผิดชอบโรงเรียน  ให้แล้วเสร็จ ภายในวันที่ 1 กันยายน 2562<br>

                </div>

            </div>
        </div>
</div>

    </div>
</div>
</body>
<script type="text/javascript" charset="utf-8">
    var site_url = '<?php echo site_url()?>';
    var base_url = '<?php echo base_url()?>';
    var csrf_token = '<?php echo $this->security->get_csrf_hash(); ?>';
</script>
<script src="<?php echo base_url()?>assets/vendor/js/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>assets/vendor/js/jquery.blockUI.js"></script>
<script src="<?php echo base_url()?>assets/vendor/js/jquery.maskedinput.min.js"></script>
<script src="<?php echo base_url()?>assets/vendor/js/jquery.numeric.js"></script>
<script src="<?php echo base_url()?>assets/apps/js/apps.js"></script>
<script src="<?php echo base_url()?>assets/apps/js/users.login.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
