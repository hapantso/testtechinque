<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ url('/') }}/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ url('/') }}/css/style.css">
</head>
<body>
    
    <nav class="navbar navbar-light text-white bg-secondary">
        <a href="#" class="navbar-brand">Project Name</a>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 border py-5">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('form') }}">Questionnaires</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('utilisateurs') }}">Utilisateurs</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-9 py-5">
                @yield('container')
            </div>
        </div>
    </div>

    <footer class="footer text-center text-white bg-primary">
        <span>&copy; 2021</span>
    </footer>
    <script src="{{ url('/') }}/js/jquery.min.js"></script>
    <script src="{{ url('/') }}/js/bootstrap.min.js"></script>
    @yield('script')
</body>
</html>