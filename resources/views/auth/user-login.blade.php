<!doctype html>
    <html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--favicon-->
        <!-- <link rel="icon" href="https://dsptechnologies.co.in/assets/title.png" type="image/png" /> -->
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
        <title>Manchar Nagarpanchayat - Login Page</title>
    </head>

    <body class="bg-login">
        <!--wrapper-->
        <div class="wrapper">
            <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
                <div class="container-fluid">
                    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                        <div class="col mx-auto">

                            <div class="card">
                                <div class="card-body">
                                    <div class="p-4 rounded">
                                        <div class="mb-4 text-center">
                                            {{-- <img src="{{config('app.baseURL')}}/assets/images/kdmc-logo.png" style="width: 120px;" alt="" /> --}}
                                        </div>
                                        <div class="text-center">
                                            <h3 class="">Sign in</h3>
                                            <!-- <p>Don't have an account yet? <a href="authentication-signup.html">Sign up here</a> -->
                                            </p>
                                        </div>


                                        <div class="form-body">

                                            <form class="row g-3" method="POST" action="{{ url('user-login') }}">
                                                @csrf
                                                <div class="col-12">
                                                    <label for="inputCat" class="form-label">Category</label>
                                                    <select name="category_id" class="form-control form-select @error('category_id') is-invalid @enderror" id="inputCat">
                                                        <option value="">Select Category</option>
                                                        @foreach($categories as $category)
                                                        <option value="{{$category->id}}" @if(old('category_id')==$category->id) selected @endif>{{$category->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('category_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="col-12">
                                                    <label for="inputEmailAddress" class="form-label">Email Address</label>

                                                    <input id="inputEmailAddress" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  placeholder="Email Address" autofocus>
                                                    @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="col-12">
                                                    <label for="inputChoosePassword" class="form-label">Enter Password</label>
                                                    <div class="input-group" id="show_hide_password">

                                                        <input type="password" class="form-control @error('password') is-invalid @enderror border-end-0" name="password" id="inputChoosePassword" placeholder="Enter Password"  autocomplete="current-password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                                        @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-check form-switch">

                                                        <input class="form-check-input" type="checkbox" name="remember" id="flexSwitchCheckChecked" {{ old('remember') ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="flexSwitchCheckChecked">Remember Me</label>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-6 text-end">
                                                    @if (Route::has('password.request'))
                                                    <a href="{{ route('password.request') }}">
                                                        {{ __('Forgot Password?') }}
                                                    </a>
                                                    @endif
                                                </div> -->
                                                <div class="col-12">
                                                    <div class="d-grid">
                                                        <button type="submit" class="btn btn-primary"><i class="bx bxs-lock-open"></i>Sign in</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                </div>
            </div>
        </div>
        <!--end wrapper-->
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