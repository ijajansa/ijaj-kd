@extends('layouts.app')
@section('content')

<style type="text/css">
	.closeImage{
		position: absolute;
		right: 0px;
		top: -9px;
		width: 25px;
		height: 25px;
		background: #eee;
		cursor: pointer;
		border-radius: 50%;
		font-size: 22px;
		line-height: 24px;
		padding-left: 7px;
	}
	.AllImg:hover {
		overflow: hidden;
	}
	.AllImg:hover img{
		transform: scale(1.5);
		transition: 1s ease;
		cursor: pointer;

	}
	.closeImage2{
		position: absolute;
		right: 0px;
		top: -9px;
		width: 25px;
		height: 25px;
		background: #eee;
		cursor: pointer;
		border-radius: 50%;
		font-size: 22px;
		line-height: 24px;
		padding-left: 7px;
	}
</style>
<!--start page wrapper -->
<div class="page-wrapper">
	<div class="page-content">
		<h6 class="mb-0 text-uppercase" style="display:inline-block;">Image / Video Details</h6>
		<!-- <p align="right"><a href="{{config('app.baseURL')}}/customer/add" class="btn btn-primary mb-3 mb-lg-0"><i class='bx bxs-plus-square'></i>Add New Customer</a></p> -->
		<hr/>
		<div class="row row-cols-12 row-cols-md-12 row-cols-lg-12 row-cols-xl-12">
			<div class="col">
				<div class="card">
					<div class="card-body">
						<ul class="nav nav-tabs nav-primary" role="tablist">
							<li class="nav-item" role="presentation">
								<a class="nav-link active" data-bs-toggle="tab" href="#primaryhome" role="tab" aria-selected="true">
									<div class="d-flex align-items-center">
										<div class="tab-icon"><i class='bx bx-home font-18 me-1'></i>
										</div>
										<div class="tab-title">Room</div>
									</div>
								</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" data-bs-toggle="tab" href="#primaryprofile" role="tab" aria-selected="false">
									<div class="d-flex align-items-center">
										<div class="tab-icon"><i class='bx bx-book-content font-18 me-1'></i>
										</div>
										<div class="tab-title">Gallery</div>
									</div>
								</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" data-bs-toggle="tab" href="#primarycontact" role="tab" aria-selected="false">
									<div class="d-flex align-items-center">
										<div class="tab-icon"><i class='bx bx-calendar-week font-18 me-1'></i>
										</div>
										<div class="tab-title">Facilities</div>
									</div>
								</a>
							</li>
						</ul>
						<div class="tab-content py-3">
							<div class="tab-pane fade show active" id="primaryhome" role="tabpanel">
								<h4>Images</h4>
								<div class="row">
									@foreach($data as $image)
									@if($image->image!=null)
									@if($image->service_type=='room')
									<div class="col-md-3 AllImg" style="margin-top:20px;position: relative;">
										<img src="{{config('app.baseURL')}}/storage/app/{{$image->image}}" style="width:100%">
										<div class="closeImage"><a href="{{config('app.baseURL')}}/hotel/delete-image/{{$image->id}}">&times;</a></div>
									</div>
									@endif
									@endif
									@endforeach
								</div>
								<hr>
								<h4>Videos</h4>
								<div class="row">
									@foreach($data as $image)
									@if($image->videos!=null)
									@if($image->service_type=='room')
									<div class="col-md-4" style="margin-top:20px;position: relative;">
										<iframe style="width: 100%;height: 230px;" src="{{$image->videos}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
										<div class="closeImage2"><a href="{{config('app.baseURL')}}/hotel/delete-image/{{$image->id}}">&times;</a></div>
										<div>
											
										</div>
									</div>
									@endif
									@endif
									@endforeach
								</div>
							</div>
							<div class="tab-pane fade" id="primaryprofile" role="tabpanel">
								<h4>Images</h4>
								<div class="row">
									@foreach($data as $image)
									@if($image->image!=null)
									@if($image->service_type=='gallery')
									<div class="col-md-3 AllImg" style="margin-top:20px;position: relative;">
										<img src="{{config('app.baseURL')}}/storage/app/{{$image->image}}" style="width:100%">
										<div class="closeImage"><a href="{{config('app.baseURL')}}/hotel/delete-image/{{$image->id}}">&times;</a></div>
									</div>
									@endif
									@endif
									@endforeach
								</div>
								<hr>
								<h4>Videos</h4>
								<div class="row">
									@foreach($data as $image)
									@if($image->videos!=null)
									@if($image->service_type=='gallery')
									<div class="col-md-4" style="margin-top:20px;position: relative;">
										<iframe style="width: 100%;height: 230px;" src="{{$image->videos}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
										<div class="closeImage2"><a href="{{config('app.baseURL')}}/hotel/delete-image/{{$image->id}}">&times;</a></div>
										<div>
											<!-- <a href="{{config('app.baseURL')}}/hotel/delete-image/{{$image->id}}"><button type="button" class="btn btn-danger">Delete</button></a> -->
										</div>
									</div>
									@endif
									@endif
									@endforeach
								</div>
							</div>
							<div class="tab-pane fade" id="primarycontact" role="tabpanel">
								<h4>Images/Videos</h4>
								@foreach($facilities as $facility)
								<h6>{{$facility->name}}</h6>
								<div class="row">
									@foreach($data as $image)
									@if($image->image!=null)
									@if($image->service_type=='facilities')
									@if($image->facilities_type==$facility->name)
									<div class="col-md-3 AllImg" style="margin-top:20px;position: relative;">
										<img src="{{config('app.baseURL')}}/storage/app/{{$image->image}}" style="width:100%">
										<div class="closeImage"><a href="{{config('app.baseURL')}}/hotel/delete-image/{{$image->id}}">&times;</a></div>
									</div>
									@endif
									@endif
									@endif
									@endforeach
								</div>
								<div class="row">
									@foreach($data as $image)
									@if($image->videos!=null)
									@if($image->service_type=='facilities')
									@if($image->facilities_type==$facility->name)
									<div class="col-md-4" style="margin-top:20px;position: relative;">
										<iframe style="width: 100%;height: 230px;" src="{{$image->videos}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
										<div class="closeImage2"><a href="{{config('app.baseURL')}}/hotel/delete-image/{{$image->id}}">&times;</a></div>
										<div>
											<!-- <a href="{{config('app.baseURL')}}/hotel/delete-image/{{$image->id}}"><button type="button" class="btn btn-danger">Delete</button></a> -->
										</div>
									</div>
									@endif
									@endif
									@endif
									@endforeach
								</div>
								<hr>
								@endforeach
														
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>


	</div>
</div>
<!--end page wrapper -->
@endsection