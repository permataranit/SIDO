<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php $akses = session()->get('akses'); ?>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $title; ?></title>
    <!-- JQUERY SCRIPTS -->
    <script src="<?= base_url(); ?>/assets/js/jquery-1.10.2.js"></script>
    <script src="http://code.jquery.com/jquery-migrate-1.2.1.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>
    <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/base/jquery-ui.css">
    <!-- BOOTSTRAP STYLES-->
    <link href="<?= base_url(); ?>/assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="<?= base_url(); ?>/assets/css/font-awesome.css" rel="stylesheet" />
    <!-- DROPDOWN STYLES-->
    <link href="<?= base_url(); ?>/assets/css/dropdown.css" rel="stylesheet" />
    <!-- MORRIS CHART STYLES-->
    <!-- <link href="<?= base_url(); ?>/assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" /> -->
    <!-- CUSTOM STYLES-->
    <link href="<?= base_url(); ?>/assets/css/custom.css" rel="stylesheet" />
    <?php if ($akses == 3) : ?>
        <link href="<?= base_url(); ?>/assets/css/style_tab.css" rel="stylesheet" />
    <?php endif; ?>
    <!-- TABLE STYLES-->
    <link href="<?= base_url(); ?>/assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link rel="shortcut icon" href="<?= base_url(); ?>/login/assets/img/undip.png">
    <style>
        .error {
            color: red;
        }

        #tengah th {
            text-align: center;
        }

        #tengah {
            text-align: center;
        }

        .ui-datepicker-calendar {
            display: none;
        }
    </style>
</head>

<body>
    <div id="wrapper">


        <!-- NAV-BAR START -->
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><img src="/assets/img/logo.png" height="50px"></a>
            </div>

            <!--dropdown punya rizka-->
            <div class="top-nav notification-row">
                <div class="nav pull-right top-menu">
                    <li class="dropdown">
                        <div class="dropdown-toggle" data-toggle="dropdown" href="#" style="color: white;
						padding: 10px 30px 5px 30px;
						float: right;
						font-size: 16px;">
                            <span class="username">
                                Settings
                            </span>
                            <i style="color:white;" class="fa fa-caret-down"></i>
                        </div>
                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up"></div>
                            <?php if (session()->get('akses') == 2 || session()->get('akses') == 1) : ?>
                                <li class="eborder-top">
                                    <a href="/dosen/profile/<?= session()->get('ses_id'); ?>"><i class="fa fa-user"></i>Profil</a>
                                </li>
                            <?php endif;
                            if (session()->get('akses') == 1) {
                                $aksi = "/kadep";
                            } else if (session()->get('akses') == 2) {
                                $aksi = "/dosen";
                            } else if (session()->get('akses') == 3) {
                                $aksi = "/mahasiswa";
                            } else {
                                $aksi = "/admin";
                            }
                            ?>
                            <li>
                                <a href="<?= $aksi . '/password/'; ?>"><i class="fa fa-pencil-square-o"></i>Ubah Password</a>
                            </li>
                            <li>
                                <a href="/auth/logout"><i class="fa fa-sign-out"></i> Log Out</a>
                            </li>
                        </ul>
                    </li>
                </div>
            </div>
        </nav>
        <!-- /. NAV-BAR END  -->

        <?php if ($akses != 3) {
            echo $this->include('layout/sidebar');
        }
        echo $this->renderSection('content');
        ?>

    </div>
    <!-- /. WRAPPER  -->




    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->

    <!-- BOOTSTRAP SCRIPTS -->
    <script src="<?= base_url(); ?>/assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="<?= base_url(); ?>/assets/js/jquery.metisMenu.js"></script>
    <!-- MORRIS CHART SCRIPTS -->
    <!-- <script src=" //base_url(); ?>/assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src=" //base_url(); ?>/assets/js/morris/morris.js"></script> -->
    <!-- CUSTOM SCRIPTS -->
    <!-- <script src="//base_url(); ?>/assets/js/custom.js"></script> -->

    <!-- DATA TABLE SCRIPTS -->
    <script src="<?= base_url(); ?>/assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="<?= base_url(); ?>/assets/js/dataTables/dataTables.bootstrap.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTables-example').dataTable();
        });
    </script>