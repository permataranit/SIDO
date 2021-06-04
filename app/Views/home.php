<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>Sistem Informasi Kegiatan Dosen</title>
    <!--  Bootstrap Style -->
    <link href="login/assets/css/bootstrap.css" rel="stylesheet" />
    <!--  Font-Awesome Style -->
    <link href="login/assets/css/font-awesome.min.css" rel="stylesheet" />
    <!--  Animation Style -->
    <link href="login/assets/css/animate.css" rel="stylesheet" />
    <!--  Pretty Photo Style -->
    <link href="login/assets/css/prettyPhoto.css" rel="stylesheet" />
    <!--  Google Font Style -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <!--  Custom Style -->
    <link href="login/assets/css/style.css" rel="stylesheet" />
    <link rel="shortcut icon" href="login/assets/img/undip.png" />
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <div id="pre-div">
        <div id="loader">
        </div>
    </div>
    <!--/. PRELOADER END -->
    <div class="navbar navbar-default navbar-fixed-top move-me ">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <a class="navbar-brand" href="#">
                    <img src="login/assets/img/logo.png" class="navbar-brand-logo " alt="" />

                </a>
            </div>
            <div class="navbar-collapse collapse move-me">

            </div>

        </div>
    </div>
    <!--./ NAV BAR END -->
    <div id="home">
        <div class="overlay">
            <div class="container">
                <div class="row ">
                    <div class="col-lg-9 col-md-9 head-text">
                        <h1 id="divDisp">Selamat Datang</h1>
                        <span>
                            di Sistem Informasi Kegiatan Dosen (SIKADO) Departemen Statistika
                            <br /><br /> Fakultas Sains dan Matematika
                            <br /><br /> Universitas Diponegoro
                        </span>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="div-trans text-center">
                            <h3> Login </h3>
                            <div class="col-lg-12 col-md-12 col-sm-12">

                                <br />
                                <br />
                                <form action="/auth/login" method="post" />
                                <div class="form-group">
                                    <input type="text" class="form-control" required="required" placeholder="Username" name="username" size="30" maxlength="50" autofocus value="">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" required="required" placeholder="Password" name="password" size="30" maxlength="50" autofocus value="">
                                </div>
                                <br />
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-block btn-lg">Login</button>
                                </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </div>


    </div>
    <!--./ HOME SECTION END -->

    <!--./ HELP SECTION END -->
    <div id="footser-end">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    &copy; 2017 Sistem Informasi Kegiatan Dosen </a>

                </div>
            </div>

        </div>
    </div>
    <!--./ FOOTER SECTION END -->
    <!--  Jquery Core Script -->
    <script src="login/assets/js/jquery-1.10.2.js"></script>
    <!--  Core Bootstrap Script -->
    <script src="login/assets/js/bootstrap.js"></script>
    <!--  WOW Script -->
    <script src="login/assets/js/wow.min.js"></script>
    <!--  Scrolling Script -->
    <script src="login/assets/js/jquery.easing.min.js"></script>
    <!--  PrettyPhoto Script -->
    <script src="login/assets/js/jquery.prettyPhoto.js"></script>
    <!--  Custom Scripts -->
    <script src="login/assets/js/custom.js"></script>

</body>

</html>