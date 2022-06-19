<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Admin</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>

<body>
<header>
    <div class="p-3 px-md-4 mb-3 bg-dark text-white border-bottom box-shadow">
        <div class="container d-flex align-items-center justify-content-between">
            <h5 class="my-0 mr-md-auto font-weight-normal">{{Auth::user()->name}}</h5>
            <nav class="my-2 my-md-0 mr-md-3">
                <a class="p-2 text-white text-decoration-none" href="{{route('admin.index')}}">Главная</a>
                <a class="p-2 text-white text-decoration-none" href="{{route('admin.apps')}}">Приложения</a>
                <a class="p-2 text-white text-decoration-none" href="{{route('admin.create_admin')}}">Создание администратора</a>
            </nav>
            <form action="{{route('auth.logout')}}" method="post" class="my-auto">
                @csrf
                <button class="btn btn-danger" type="submit">Выход</button>
            </form>
        </div>
    </div>
</header>

<main>
    <div class="container">
        @yield('content')
    </div>
</main>


<footer class="p-4 mt-md-5 pt-md-5 border-top bg-dark text-white">
    <div class="container">
        <div class="row">
            <div class="col-4 col-md">
                <h5>Features</h5>
                <ul class="list-unstyled text-small">
                    <li><a class="text-muted text-decoration-none" href="#">Cool stuff</a></li>
                    <li><a class="text-muted text-decoration-none" href="#">Random feature</a></li>
                    <li><a class="text-muted text-decoration-none" href="#">Team feature</a></li>
                    <li><a class="text-muted text-decoration-none" href="#">Stuff for developers</a></li>
                    <li><a class="text-muted text-decoration-none" href="#">Another one</a></li>
                    <li><a class="text-muted text-decoration-none" href="#">Last time</a></li>
                </ul>
            </div>
            <div class="col-4 col-md">
                <h5>Resources</h5>
                <ul class="list-unstyled text-small">
                    <li><a class="text-muted text-decoration-none" href="#">Resource</a></li>
                    <li><a class="text-muted text-decoration-none" href="#">Resource name</a></li>
                    <li><a class="text-muted text-decoration-none" href="#">Another resource</a></li>
                    <li><a class="text-muted text-decoration-none" href="#">Final resource</a></li>
                </ul>
            </div>
            <div class="col-4 col-md">
                <h5>About</h5>
                <ul class="list-unstyled text-small">
                    <li><a class="text-muted text-decoration-none" href="#">Team</a></li>
                    <li><a class="text-muted text-decoration-none" href="#">Locations</a></li>
                    <li><a class="text-muted text-decoration-none" href="#">Privacy</a></li>
                    <li><a class="text-muted text-decoration-none" href="#">Terms</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>

</body>
</html>
