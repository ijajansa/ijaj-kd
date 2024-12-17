@extends('layouts.app')

@section('content')
<style type="text/css">
  .col{
    width: 33.33% !important;
  }
  .col p{
    font-size: 20px;
    margin-bottom: 18px !important;
  }
  .col h4{
    font-size: 30px;
  }
  .col .card{
    width: 100%;
    /*margin-left: 20%*/
  }
  @media(max-width :600px)
  {
    .col{
    width: 100% !important;
  }
  .col .card{
    width: 100%;
    /*margin-left: 20%*/
  } 
  }
</style>
<!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">
              {{-- <h3 align="center" style="text-transform: uppercase;margin-bottom: 30px;color:#000000">
                Admin Dashboard
              </h3> --}}
              <h5 align="center" style="text-transform: uppercase;margin-bottom: 30px;color:#000000">City Cleaning Parameters</h5>
              <hr>
              @foreach($data['categories'] as $category)  
              <h6 align="center" style="text-transform: uppercase;margin-bottom: 30px;color:#000000">{{$category->name}} Cleaning Report</h6>

              <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
                   <div class="col">
                     <div class="card radius-10 border-start border-0 border-3 border-success">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Total {{$category->name}} Cleaning Points Installed</p>
                                    <h4 class="my-1 text-success">{{$category?->install_count}}</h4>
                                </div>
                                <!--<div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i class='bx bxs-barcode'></i>-->
                                <!--</div>-->
                            </div>
                        </div>
                     </div>
                   </div>
                   <div class="col">
                    <div class="card radius-10 border-start border-0 border-3 border-success">
                       <div class="card-body">
                           <div class="d-flex align-items-center">
                               <div>
                                   <p class="mb-0 text-secondary">Total {{$category->name}} Cleaning Points Attended Today</p>
                                   <h4 class="my-1 text-success">{{$category?->today_count}}</h4>
                               </div>
                               <!--<div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="currentColor" d="M3 4v5h2V5h4V3H4a1 1 0 0 0-1 1zm18 5V4a1 1 0 0 0-1-1h-5v2h4v4h2zm-2 10h-4v2h5a1 1 0 0 0 1-1v-5h-2v4zM9 21v-2H5v-4H3v5a1 1 0 0 0 1 1h5zM2 11h20v2H2z"/></svg></i>-->
                               <!--</div>-->
                           </div>
                       </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="card radius-10 border-start border-0 border-3 border-success">
                       <div class="card-body">
                           <div class="d-flex align-items-center">
                               <div>
                                   <p class="mb-0 text-secondary">Monthly {{$category->name}} Cleaning Points Attended</p>
                                   <h4 class="my-1 text-success">{{$category?->monthly_count}}</h4>
                               </div>
                               <!--<div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="currentColor" d="M3 4v5h2V5h4V3H4a1 1 0 0 0-1 1zm18 5V4a1 1 0 0 0-1-1h-5v2h4v4h2zm-2 10h-4v2h5a1 1 0 0 0 1-1v-5h-2v4zM9 21v-2H5v-4H3v5a1 1 0 0 0 1 1h5zM2 11h20v2H2z"/></svg>-->
                               <!--</div>-->
                           </div>
                       </div>
                    </div>
                  </div>
                  
                </div><!--end row-->
                @endforeach
                <hr>
                <h5 align="center" style="text-transform: uppercase;margin-bottom: 30px;color:#000000">C & D Waste Management Parameter Reports</h5>
                <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
                   <div class="col">
                     <div class="card radius-10 border-start border-0 border-3 border-info">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-secondary">Total C&D Waste Collected</p>
                                    <h4 class="my-1 text-info">{{$data['total_cd_collection']}}</h4>
                                </div>
                                <!--<div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i class='bx bxs-barcode'></i>-->
                                <!--</div>-->
                            </div>
                        </div>
                     </div>
                   </div>
                   <div class="col">
                    <div class="card radius-10 border-start border-0 border-3 border-info">
                       <div class="card-body">
                           <div class="d-flex align-items-center">
                               <div>
                                   <p class="mb-0 text-secondary">Total C&D Waste Processed</p>
                                   <h4 class="my-1 text-info">{{$data['total_cd_processed']}}</h4>
                               </div>
                               <!--<div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="currentColor" d="M3 4v5h2V5h4V3H4a1 1 0 0 0-1 1zm18 5V4a1 1 0 0 0-1-1h-5v2h4v4h2zm-2 10h-4v2h5a1 1 0 0 0 1-1v-5h-2v4zM9 21v-2H5v-4H3v5a1 1 0 0 0 1 1h5zM2 11h20v2H2z"/></svg></i>-->
                               <!--</div>-->
                           </div>
                       </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="card radius-10 border-start border-0 border-3 border-info">
                       <div class="card-body">
                           <div class="d-flex align-items-center">
                               <div>
                                   <p class="mb-0 text-secondary">% of C&D Waste Processed</p>
                                   <h4 class="my-1 text-info">{{$data['total_cd_collection'] != 0 ? number_format(($data['total_cd_processed']/$data['total_cd_collection']) * 100,2) : 0}}%</h4>
                               </div>
                               <!--<div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="currentColor" d="M3 4v5h2V5h4V3H4a1 1 0 0 0-1 1zm18 5V4a1 1 0 0 0-1-1h-5v2h4v4h2zm-2 10h-4v2h5a1 1 0 0 0 1-1v-5h-2v4zM9 21v-2H5v-4H3v5a1 1 0 0 0 1 1h5zM2 11h20v2H2z"/></svg>-->
                               <!--</div>-->
                           </div>
                       </div>
                    </div>
                  </div>
                  
                </div><!--end row-->
                
                <hr>
                <h5 align="center" style="text-transform: uppercase;margin-bottom: 30px;color:#000000">E-Waste Management Parameter Reports</h5>
                <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
                   <div class="col">
                    <div class="card radius-10 border-start border-0 border-3 border-warning">
                       <div class="card-body">
                           <div class="d-flex align-items-center">
                               <div>
                                   <p class="mb-0 text-secondary">Total E-waste collected as on date</p>
                                   <h4 class="my-1 text-warning">{{$data['total_e_collection']}}</h4>
                               </div>
                               <!--<div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="currentColor" d="M3 4v5h2V5h4V3H4a1 1 0 0 0-1 1zm18 5V4a1 1 0 0 0-1-1h-5v2h4v4h2zm-2 10h-4v2h5a1 1 0 0 0 1-1v-5h-2v4zM9 21v-2H5v-4H3v5a1 1 0 0 0 1 1h5zM2 11h20v2H2z"/></svg>-->
                               <!--</div>-->
                           </div>
                       </div>
                    </div>
                  </div> 
                   <div class="col">
                    <div class="card radius-10 border-start border-0 border-3 border-warning">
                       <div class="card-body">
                           <div class="d-flex align-items-center">
                               <div>
                                   <p class="mb-0 text-secondary">Total E-waste recycled as on date</p>
                                   <h4 class="my-1 text-warning">{{$data['total_e_processed']}}</h4>
                               </div>
                               <!--<div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="currentColor" d="M3 4v5h2V5h4V3H4a1 1 0 0 0-1 1zm18 5V4a1 1 0 0 0-1-1h-5v2h4v4h2zm-2 10h-4v2h5a1 1 0 0 0 1-1v-5h-2v4zM9 21v-2H5v-4H3v5a1 1 0 0 0 1 1h5zM2 11h20v2H2z"/></svg></i>-->
                               <!--</div>-->
                           </div>
                       </div>
                    </div>
                  </div>
                  
                  <div class="col">
                    <div class="card radius-10 border-start border-0 border-3 border-warning">
                       <div class="card-body">
                           <div class="d-flex align-items-center">
                               <div>
                                   <p class="mb-0 text-secondary">% of E-waste Recycled</p>
                                   <h4 class="my-1 text-warning">{{$data['total_e_collection'] != 0 ? number_format(($data['total_e_processed']/$data['total_e_collection']) * 100,2) : 0}}%</h4>
                               </div>
                               <!--<div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="currentColor" d="M3 4v5h2V5h4V3H4a1 1 0 0 0-1 1zm18 5V4a1 1 0 0 0-1-1h-5v2h4v4h2zm-2 10h-4v2h5a1 1 0 0 0 1-1v-5h-2v4zM9 21v-2H5v-4H3v5a1 1 0 0 0 1 1h5zM2 11h20v2H2z"/></svg>-->
                               <!--</div>-->
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
