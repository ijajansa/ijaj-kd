<!doctype html>
    <html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--favicon-->
        <link rel="icon" href="{{config('app.baseURL')}}/assets/images/vita-logo.png" type="image/png" />
        <!--plugins-->
        <link href="{{config('app.baseURL')}}/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
        <link href="{{config('app.baseURL')}}/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
        <link href="{{config('app.baseURL')}}/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
        <!-- loader-->
        <link href="{{config('app.baseURL')}}/assets/css/pace.min.css" rel="stylesheet" />
        <script src="{{config('app.baseURL')}}/assets/js/pace.min.js"></script>
        <!-- Bootstrap CSS -->
        <link href="{{config('app.baseURL')}}/assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="{{config('app.baseURL')}}/assets/css/bootstrap-extended.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
        <link href="{{config('app.baseURL')}}/assets/css/app.css" rel="stylesheet">
        <link href="{{config('app.baseURL')}}/assets/css/icons.css" rel="stylesheet">
        <title>@yield('title')</title>
    </head>

    <body class="bg-login">
        <!--wrapper-->
        @yield('content')

        <!-- Bootstrap JS -->
        <script src="{{config('app.baseURL')}}/assets/js/bootstrap.bundle.min.js"></script>
        <!--plugins-->
        <script src="{{config('app.baseURL')}}/assets/js/jquery.min.js"></script>
        <script src="{{config('app.baseURL')}}/assets/plugins/simplebar/js/simplebar.min.js"></script>
        <script src="{{config('app.baseURL')}}/assets/plugins/metismenu/js/metisMenu.min.js"></script>
        <script src="{{config('app.baseURL')}}/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
        <!--Password show & hide js -->
        <script>
            $(document).ready(function () {
                $("#show_hide_password a").on('click', function (event) {
                    event.preventDefault();
                    if ($('#show_hide_password input').attr("type") == "text") {
                        $('#show_hide_password input').attr('type', 'password');
                        $('#show_hide_password i').addClass("bx-hide");
                        $('#show_hide_password i').removeClass("bx-show");
                    } else if ($('#show_hide_password input').attr("type") == "password") {
                        $('#show_hide_password input').attr('type', 'text');
                        $('#show_hide_password i').removeClass("bx-hide");
                        $('#show_hide_password i').addClass("bx-show");
                    }
                });
            });
        </script>
        <!--app JS-->
        <script src="{{config('app.baseURL')}}/assets/js/app.js"></script>
    </body>

    </html>
