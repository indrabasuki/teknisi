<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="google" value="notranslate">
    <meta name="author" content="indrabasuki">

    <title>Tes Uji Coba - <?= $title ?></title>


    <link rel="shortcut icon" href="<?= base_url() ?>asset/favicon.ico" type="image/x-icon">
    <link href="<?= base_url() ?>asset/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>asset/css/sb-admin.css" rel="stylesheet">
    <link href="<?= base_url() ?>asset/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>asset/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />

    <script src="<?= base_url() ?>asset/js/jquery.js"></script>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
    <style>
        #mapid {
            height: 490px;
        }
    </style>
    <script>
        var base_url = '<?= base_url() ?>';
    </script>
</head>

<body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-primary static-top">

        <a class="navbar-brand mr-1" href="<?= base_url('dashboard') ?>"><img src="<?= base_url('asset/images/logo-enerren.png') ?>" width="100"> Enerren </a>

        <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
            <i class="fas fa-bars"></i>
        </button>

        <div class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0"></div>

        <ul class="navbar-nav ml-auto ml-md-0 float-left">
            <a class="nav-link active " href="#">Link Source Code
                <i class="fas fa-code fa-fw"></i>
            </a>
        </ul>

    </nav>

    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="sidebar navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="<?= base_url('teknisi') ?>">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Data Teknisi</span>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="<?= base_url('teknisi/map') ?>">
                    <i class="fas fa-fw fa-map-marked"></i>
                    <span>Data Map</span>
                </a>
            </li>
        </ul>


        <div id="content-wrapper">
            <div class="container-fluid">
                <?php echo $content; ?>
            </div>
            <!-- Sticky Footer -->
            <footer class="sticky-footer">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>TEST UJI COBA</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="<?= base_url() ?>asset/datatables/jquery.dataTables.js"></script>
    <script src="<?= base_url() ?>asset/datatables/dataTables.bootstrap4.js"></script>
    <script src="<?= base_url() ?>asset/js/sb-admin.min.js"></script>
    <script src="<?= base_url() ?>asset/sweetalert2/sweetalert2.all.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
            return {
                "iStart": oSettings._iDisplayStart,
                "iEnd": oSettings.fnDisplayEnd(),
                "iLength": oSettings._iDisplayLength,
                "iTotal": oSettings.fnRecordsTotal(),
                "iFilteredTotal": oSettings.fnRecordsDisplay(),
                "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
            };
        };
    </script>
</body>

</html>