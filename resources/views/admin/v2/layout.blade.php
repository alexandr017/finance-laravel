<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/admin/v2/assets//vendor/bootstrap/css/bootstrap.min.css">
    <link href="/admin/v2/assets//vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="/admin/v2/assets//libs/css/style.css">
    <link rel="stylesheet" href="/admin/v2/assets//vendor/fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" href="/admin/v2/assets//vendor/charts/chartist-bundle/chartist.css">
    <link rel="stylesheet" href="/admin/v2/assets//vendor/charts/morris-bundle/morris.css">
    <link rel="stylesheet" href="/admin/v2/assets//vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/admin/v2/assets//vendor/charts/c3charts/c3.css">
    <link rel="stylesheet" href="/admin/v2/assets//vendor/fonts/flag-icon-css/flag-icon.min.css">

    <link rel="stylesheet" href="/admin/modules/dataTables/datatables.min.css">
    <title>@yield('title')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Ysabeau+Infant:wght@1;100;400;500;600;700&display=swap" rel="stylesheet">

    <style>

        body {
            font-family: 'Raleway', sans-serif;
            font-family: 'Ysabeau Infant', sans-serif;
        }

        .nav-left-sidebar .navbar-nav .nav-link {
            padding: 8px 12px;
        }

        .inline {
            display: inline-block;
        }

        .red {
            color: red;
        }

        .pull-right {
            float: right;
        }

        .pull-right[type=submit] {
            margin-top: 10px;
        }

        .clearfix {
            clear: both;
        }
    </style>

</head>
<body>
<div class="dashboard-main-wrapper">
    @include('admin.v2.includes.header')
    @include('admin.v2.includes.sidebar')
    <!-- ============================================================== -->
    <!-- wrapper  -->
    <!-- ============================================================== -->
    <div class="dashboard-wrapper">
        <div class="dashboard-ecommerce">
            <div class="container-fluid dashboard-content ">
                <!-- ============================================================== -->
                <!-- pageheader  -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title">@yield('h1')</h2>
                            @include('admin.v2.includes.breadcrumbs')
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end pageheader  -->
                <!-- ============================================================== -->
                <div class="ecommerce-widget">

                    <div class="card">
                    <div class="card-body">
                        @include('admin.v2.includes.messages')
                        @yield('content')
                    </div>
                    </div>

                </div>
            </div>
        </div>
        @include('admin.v2.includes.footer')
    </div>
    <!-- ============================================================== -->
    <!-- end wrapper  -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- end main wrapper  -->
<!-- ============================================================== -->
<!-- Optional JavaScript -->
<!-- jquery 3.3.1 -->
<script src="/admin/v2/assets//vendor/jquery/jquery-3.3.1.min.js"></script>
<!-- bootstap bundle js -->
<script src="/admin/v2/assets//vendor/bootstrap/js/bootstrap.bundle.js"></script>
<!-- slimscroll js -->
<script src="/admin/v2/assets//vendor/slimscroll/jquery.slimscroll.js"></script>
<!-- main js -->
<script src="/admin/v2/assets//libs/js/main-js.js"></script>
<!-- chart chartist js -->
<script src="/admin/v2/assets//vendor/charts/chartist-bundle/chartist.min.js"></script>
<!-- sparkline js -->
<script src="/admin/v2/assets//vendor/charts/sparkline/jquery.sparkline.js"></script>
<!-- morris js -->
<script src="/admin/v2/assets//vendor/charts/morris-bundle/raphael.min.js"></script>
<script src="/admin/v2/assets//vendor/charts/morris-bundle/morris.js"></script>
<!-- chart c3 js -->
<script src="/admin/v2/assets//vendor/charts/c3charts/c3.min.js"></script>
<script src="/admin/v2/assets//vendor/charts/c3charts/d3-5.4.0.min.js"></script>
<script src="/admin/v2/assets//vendor/charts/c3charts/C3chartjs.js"></script>
<script src="/admin/v2/assets//libs/js/dashboard-ecommerce.js"></script>

@yield('additional-scripts')

<script src="/admin/modules/dataTables/datatables.min.js"></script>

<script>
    $('.rest-destroy').on('click',function(){
        return confirm("Вы действительно хотите удалить текущий элемент?");
    });

    $(document).ready(function(){
        $("#coolTable").DataTable({
            "sort": true,
            "pageLength": 50,
            "language": {"url": "/backend/dataTables/datatables.json"}
        });

    });
</script>

</body>
</html>
