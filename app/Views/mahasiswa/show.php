<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $title; ?></title>
    <!-- BOOTSTRAP STYLES-->
    <link href="<?= base_url(); ?>/assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="<?= base_url(); ?>/assets/css/font-awesome.css" rel="stylesheet" />
    <!-- DROPDOWN STYLES-->
    <link href="<?= base_url(); ?>/assets/css/dropdown.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="<?= base_url(); ?>/assets/css/custom.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>/assets/css/style_tab.css" rel="stylesheet" />
    <!-- TABLE STYLES-->
    <link href="<?= base_url(); ?>/assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link rel="shortcut icon" href="<?= base_url(); ?>/login/assets/img/undip.png">
    <style>
        .error {
            color: red;
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
                            <li class="eborder-top">
                                <a href="#"><i class="fa fa-user"></i>Profil</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-pencil-square-o"></i>Ubah Password</a>
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

        <main>


            <h2><?= session()->getFlashdata('halo'); ?>
                <?= (session()->get('akses') == 1) ? 'Ketua Departemen Statistika <br>' : ''; ?>
                <?= session()->get('ses_nama'); ?>
            </h2>

            <hr />


            <div class="row">
                <div class="col-md-12">

                    <!-- Advanced Tables -->
                    <div class="panel panel-default">

                        <div class="panel-heading">
                            Daftar Dosen Departemen Statistika UNDIP
                        </div>

                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center"> No </th>
                                            <th style="text-align:center"> NIP </th>
                                            <th style="text-align:center"> Nama </th>
                                            <th style="text-align:center"> Aksi </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($list_dosen as $dosen) :
                                        ?>
                                            <tr>
                                                <td style="text-align:center"><?= $i++; ?></td>
                                                <td><?= $dosen['nip']; ?></td>
                                                <td><?= $dosen['nama']; ?></td>
                                                <td width=290px style="text-align:center">
                                                    <a data-toggle="tooltip" title="Jadwal" class="btn btn-warning" href="#"><i class="fa fa-calendar"></i></a>
                                                    <a data-toggle="tooltip" title="Kegiatan" class="btn btn-info" href="#"><i class="fa fa-table"></i></a>
                                                    <a data-toggle="tooltip" title="Profil" class="btn btn-primary" href="#"><i class="fa fa-user"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>


        </main>
    </div>
    <!-- /. WRAPPER  -->

    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="<?= base_url(); ?>/assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="<?= base_url(); ?>/assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="<?= base_url(); ?>/assets/js/jquery.metisMenu.js"></script>
    <!-- DATA TABLE SCRIPTS -->
    <script src="<?= base_url(); ?>/assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="<?= base_url(); ?>/assets/js/dataTables/dataTables.bootstrap.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTables-example').dataTable();
        });
    </script>
    <!-- CUSTOM SCRIPTS -->
    <script src="<?= base_url(); ?>/assets/js/custom.js"></script>