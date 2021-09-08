<?php

session_start();
// Connection
include('admin/template/connection.php');


?>


<html lang="en">

<!-- Basic -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Site Metas -->
<title>مـدونتي || تسجيل الدخول</title>
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="author" content="">

<!-- Site Icons -->
<link rel="apple-touch-icon" href="images/apple-touch-icon.png">

<!-- Design fonts -->
<link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">

<!-- Bootstrap core CSS -->
<link href="css/bootstrap.css" rel="stylesheet">

<!-- FontAwesome Icons core CSS -->
<link href="css/font-awesome.min.css" rel="stylesheet">

<!-- bootstrap-rtl  CSS -->
<link href="css/bootstrap-rtl.min.css" rel="stylesheet">

<!-- Custom styles for this template -->
<link href="css/style.css" rel="stylesheet">

<!-- Animate styles for this template -->
<link href="css/animate.css" rel="stylesheet">

<!-- Responsive styles for this template -->
<link href="css/responsive.css" rel="stylesheet">

<!-- Colors for this template -->
<link href="css/colors.css" rel="stylesheet">

<!-- Version Marketing CSS for this template -->
<link href="css/version/marketing.css" rel="stylesheet">

<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>


    <div id="wrapper">
        <!-- end market-header -->

        <!-- end page-title -->

        <section class="section lb login">
            <div class="container">
                <div class="row">
                    <!-- end col -->

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="page-wrapper">
                            <?php
                            if (isset($_POST['login'])) {
                                $adminMail = $_POST['email'];
                                $adminPass = $_POST['password'];
                                if (empty($adminMail) || empty($adminPass)) {
                                    echo "<div class='alert alert-danger text-center'>" . "الرجاء ادخال البريد الالكترونى وكلمة المرور" . "</div>";
                                } else {
                                    $query = "SELECT * FROM admin WHERE email = '$adminMail' AND password = '$adminPass'";
                                    $result = mysqli_query($conn, $query);
                                    $row = mysqli_fetch_assoc($result);
                                    if (in_array($adminMail, $row, true) && in_array($adminPass, $row, true)) {
                                        echo "<div class='alert alert-success text-center'>" . "  مرحبا سوف يتم تحويلك الى صفحة التحكم" . "</div>";
                                        $_SESSION['id'] = $row['id'];
                                        header('Location: admin/categories.php');
                                    } else {
                                        echo "<div class='alert alert-danger text-center'>" . "البيانات غير متطابقة" . "</div>";
                                    }
                                }
                            }
                            ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <form class="form-wrapper" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
                                        <h4>تسجيل الدخول</h4>
                                        <input type="text" class="form-control" placeholder="البريد الالكتروني" name="email">
                                        <input type="password" class="form-control" placeholder="كلمة المرور" name="password">
                                        <button class="btn btn-primary" name="login"> <i class="fa fa-sign-in"></i>دخول</button>
                                    </form>
                                </div>
                            </div>
                        </div><!-- end page-wrapper -->
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end container -->
        </section>

        <!-- end footer -->



    </div>

    <!-- Core JavaScript
================================================== -->
    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/animate.js"></script>
    <script src="js/custom.js"></script>

</body>

</html>