<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'BNSP PMB' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }
        .sidebar {
            background-color: #2c3e50;
            min-height: 100vh;
            padding: 0;
        }
        .sidebar .nav-link {
            color: #ecf0f1;
            border-left: 3px solid transparent;
            padding: 1rem;
            transition: all 0.3s;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: #34495e;
            border-left-color: #3498db;
            color: #3498db;
        }
        .main-content {
            padding: 2rem;
        }
    </style>
</head>
<body>
    @include('components.navbar')
    
    <div class="container-fluid">
        <div class="row">
            @if(auth()->check() && auth()->user()->isAdmin())
                @include('components.admin-sidebar')
                <div class="col-md-9 main-content">
                    @yield('content')
                </div>
            @elseif(auth()->check() && auth()->user()->isStudent())
                @include('components.student-sidebar')
                <div class="col-md-9 main-content">
                    @yield('content')
                </div>
            @else
                <div class="col-md-12 main-content">
                    @yield('content')
                </div>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
