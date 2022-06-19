<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <title>@yield('title', 'Makro')</title>
</head>
<body>
<header>
    <div class="container">
        <div class="d-flex flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white box-shadow">
            <h5 class="my-0 mr-md-auto font-weight-normal"></h5>

            <nav class="my-2 my-md-0 mr-md-3">
                <div class="row">
                    <div class="col-4">

                        <a href="{{route('locale', ['locale' => 'ru'])}}">RU</a>
                        <a href="{{route('locale', ['locale' => 'uz'])}}">UZ</a>

                        @guest

                        @else
                            <form action="{{route('auth.logout')}}" method="post" class="mb-5">
                                @csrf
                                <button type="submit" class="btn btn-danger">{{__('auth.application.exit')}}</button>
                            </form>
                        @endguest
                    </div>
                </div>
            </nav>
        </div>
    </div>
</header>
<main>
    @yield('content')
</main>

</body>
@yield('style')
@yield('script')
</html>


