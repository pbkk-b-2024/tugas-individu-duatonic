<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Management</title>
    <link href="../css/app.css" rel="stylesheet">

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }

        .wrapper {
            flex: 1;
            display: flex;
        }

        .main-sidebar {
            width: 250px;
            background-color: #343a40;
            color: #fff;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 20px;
        }

        .brand-link {
            text-align: center;
            padding: 15px;
            display: block;
            font-size: 1.25rem;
            color: #fff;
            font-weight: bold;
            text-decoration: none;
            border-bottom: 1px solid #4f5962;
        }

        .sidebar .user-panel {
            color: #ddd;
            border-bottom: 1px solid #4f5962;
        }

        .sidebar .nav {
            padding-left: 0;
            margin: 0;
            list-style: none;
        }

        .sidebar .nav-item {
            display: block;
        }

        .sidebar .nav-item a {
            color: #c2c7d0;
            padding: 10px;
            display: block;
            text-decoration: none;
        }

        .sidebar .nav-item a:hover {
            background-color: #495057;
        }

        .content-wrapper {
            margin-left: 50px;
            padding: 20px;
            flex: 1;
        }

        .content-header h1 {
            font-weight: 600;
        }

        .main-footer {
            background-color: #0b0c0f;
            text-align: center;
            border-top: 1px solid #dee2e6;
            position: absolute; /* Change to absolute positioning */
            bottom: 0; /* Position at the bottom */
            width: 100%; /* Adjust width as needed */
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Wrapper to hold everything -->
    <div class="wrapper">
        <!-- Header -->
        @include('components.header')

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="/" class="brand-link">
                Store Management
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="info pl-3">
                        <span class="d-block">Rafli Dzulhaikal - 5025221148</span>
                    </div>
                </div>
                
                <!-- Sidebar Menu -->
                @include('components.sidebar')
            </div>
            <!-- /.sidebar -->

            <!-- Footer -->
            <div class="main-footer">
                @include('components.footer')
            </div>
            
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper flex-fill">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">
                                @yield('title')
                            </h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="container-fluid">
                @yield('alert')
                @yield('content')
            </div>
            <!-- /.content -->
        </div>

    </div>
    
    <!-- Include Bootstrap JS (optional for interactive components) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    @yield('script')
</body>
</html>