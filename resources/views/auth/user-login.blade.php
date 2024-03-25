@extends('layouts.public')
@section('content')
@section('title', 'System User Login | Vita Municipal Council, Vita')
        <!--wrapper-->
        <div class="wrapper">
            <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
                <div class="container-fluid">
                    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                        <div class="col mx-auto">

                            <div class="card" style="border: none;
                            border-radius: 15px;
                            box-shadow: 1px 1px 10px rgba(0,0,0,0.1);">
                                <div class="card-body">
                                    <div class="p-4 rounded">
                                        <div class="text-center">
                                            <img src="{{config('app.baseURL')}}/assets/images/vita-logo.png" style="width: 40%;" alt="" />
                                        </div>
                                        <div class="text-center">
                                            <h4 class="">Sign In @if(request()->get('system')=='cnd_waste') - GVP Monitoring System @else - Waste Management System @endif</h4>
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
       @endsection