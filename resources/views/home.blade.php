@extends('layouts.app')

@section('content')
<style type="text/css">
  .col{
    width: 49% !important;
  }
  .col p{
    font-size: 20px;
    margin-bottom: 18px !important;
  }
  .col h4{
    font-size: 30px;
  }
  .col .card{
    width: 86%;
    /*margin-left: 20%*/
  }
</style>
<!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">
              <h3 align="center" style="text-transform: uppercase;margin-bottom: 30px;color:#000000">GVP Monitoring System</h3>
                <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">

                   <div class="col">
                     <div class="card radius-10 border-start border-0 border-3 border-info">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Total GVP identified</p>
                                    <h4 class="my-1 text-info">{{$barcode}}</h4>
                                </div>
                                <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i class='bx bxs-barcode'></i>
                                </div>
                            </div>
                        </div>
                     </div>
                   </div>
                   <div class="col">
                    <div class="card radius-10 border-start border-0 border-3 border-danger">
                       <div class="card-body">
                           <div class="d-flex align-items-center">
                               <div>
                                   <p class="mb-0 text-secondary">Total GVP Attended</p>
                                   <h4 class="my-1 text-danger">{{$todays_report}}</h4>
                               </div>
                               <div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="currentColor" d="M3 4v5h2V5h4V3H4a1 1 0 0 0-1 1zm18 5V4a1 1 0 0 0-1-1h-5v2h4v4h2zm-2 10h-4v2h5a1 1 0 0 0 1-1v-5h-2v4zM9 21v-2H5v-4H3v5a1 1 0 0 0 1 1h5zM2 11h20v2H2z"/></svg></i>
                               </div>
                           </div>
                       </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="card radius-10 border-start border-0 border-3 border-success">
                       <div class="card-body">
                           <div class="d-flex align-items-center">
                               <div>
                                   <p class="mb-0 text-secondary">Last Week GVP Attended</p>
                                   <h4 class="my-1 text-success">{{$week_report}}</h4>
                               </div>
                               <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="currentColor" d="M3 4v5h2V5h4V3H4a1 1 0 0 0-1 1zm18 5V4a1 1 0 0 0-1-1h-5v2h4v4h2zm-2 10h-4v2h5a1 1 0 0 0 1-1v-5h-2v4zM9 21v-2H5v-4H3v5a1 1 0 0 0 1 1h5zM2 11h20v2H2z"/></svg>
                               </div>
                           </div>
                       </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="card radius-10 border-start border-0 border-3 border-warning">
                       <div class="card-body">
                           <div class="d-flex align-items-center">
                               <div>
                                   <p class="mb-0 text-secondary">Last Month GVP Attended</p>
                                   <h4 class="my-1 text-warning">{{$month_report}}</h4>
                               </div>
                               <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="currentColor" d="M3 4v5h2V5h4V3H4a1 1 0 0 0-1 1zm18 5V4a1 1 0 0 0-1-1h-5v2h4v4h2zm-2 10h-4v2h5a1 1 0 0 0 1-1v-5h-2v4zM9 21v-2H5v-4H3v5a1 1 0 0 0 1 1h5zM2 11h20v2H2z"/></svg>
                               </div>
                           </div>
                       </div>
                    </div>
                  </div> 
                  <div class="col">
                    <div class="card radius-10 border-start border-0 border-3 border-warning">
                       <div class="card-body">
                           <div class="d-flex align-items-center">
                               <div>
                                   <p class="mb-0 text-secondary">Yearly GVP Attended</p>
                                   <h4 class="my-1 text-warning">{{$year_report}}</h4>
                               </div>
                               <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="currentColor" d="M3 4v5h2V5h4V3H4a1 1 0 0 0-1 1zm18 5V4a1 1 0 0 0-1-1h-5v2h4v4h2zm-2 10h-4v2h5a1 1 0 0 0 1-1v-5h-2v4zM9 21v-2H5v-4H3v5a1 1 0 0 0 1 1h5zM2 11h20v2H2z"/></svg>
                               </div>
                           </div>
                       </div>
                    </div>
                  </div> 
                </div><!--end row-->
                <!-- <div class="" style="display: flex;width: 100%;margin-top: 50px;">
                  <div style="width: 33.33%">
                    <img src="{{config('app.baseURL')}}/assets/images/img3.jpeg" style="width: 250px;height: 200px;">
                  </div>
                  <div style="width: 33.33%">
                    <img src="{{config('app.baseURL')}}/assets/images/img1.jpeg" style="width: 250px;height: 200px;">
                  </div>
                  <div style="width: 33.33%">
                    <img src="{{config('app.baseURL')}}/assets/images/img2.jpeg" style="width: 250px;height: 200px;">
                  </div>
                </div> -->
            </div>
        </div>
        <!--end page wrapper -->
@endsection
