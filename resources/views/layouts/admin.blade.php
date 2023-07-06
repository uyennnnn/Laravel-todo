<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <!-- Import các file CSS và JavaScript của Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-alpha1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-alpha1/js/bootstrap.bundle.min.js"></script>
    <style>
        .container-fluid {
            min-height: 100vh;
        }

        .row {
            display: flex;
            flex-wrap: nowrap;
        }

        .col-md-3 {
            flex: 0 0 auto;
            height: 100%;
            order: 0; /* Thay đổi thứ tự hiển thị của cột */
        }

        .main-content {
            flex: 1 1 auto;
            overflow-y: auto;
            order: 1; /* Thay đổi thứ tự hiển thị của cột */
        }
    </style>
</head>

<body>
    <div class="container-fluid d-flex flex-column vh-100">
        <div class="row">
            <!-- Nội dung chính -->
            <div class="main-content">
                @yield('content')
            </div>

            <!-- Thanh điều hướng bên trái -->
            <div class="col-md-3 bg-dark text-light">
                <h3>Admin Navigation</h3>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.users') }}">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Todos</a>
                    </li>
                    <!-- Thêm các mục điều hướng khác -->
                </ul>
            </div>
        </div>
    </div>
</body>

</html>
