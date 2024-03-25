@extends('layouts.public')
@section('content')
@section('title', 'Home | Vita')
<style>
    .card:hover{
        background: #f5f5f5;
    }
</style>
        <div class="wrapper">
            <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-4 text-center">
                                <img src="{{config('app.baseURL')}}/assets/images/vita-logo.png" style="width: 15%;" alt="" />
                            </div>
                        </div>
                        <div class="col-lg-3"></div>
                            <div class="col-lg-3">
                            <div class="card" style="border: none;
                            border-radius: 15px;
                            box-shadow: 1px 1px 10px rgba(0,0,0,0.1);cursor:pointer" onclick=window.location.href="{{url('login')}}?system=cnd_waste">
                                <div class="card-body">
                                    <div class="p-4 rounded">
                                        <div class="text-center">
                                            <h3 class="">GVP Monitoring System</h3>
                                            </p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card" style="border: none;
                            border-radius: 15px;
                            box-shadow: 1px 1px 10px rgba(0,0,0,0.1);cursor:pointer" onclick=window.location.href="{{url('login')}}?system=e_waste">
                                <div class="card-body">
                                    <div class="p-4 rounded">
                                        <div class="text-center">
                                            <h3 class="">Waste Management System</h3>
                                            </p>
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