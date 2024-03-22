@extends('layouts.app')
@section('content')
<head>
<!--plugins-->
	<link href="{{config('app.baseURL')}}/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="{{config('app.baseURL')}}/assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
	<link href="{{config('app.baseURL')}}/assets/plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />
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
	
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="{{config('app.baseURL')}}/assets/css/dark-theme.css" />
	<link rel="stylesheet" href="{{config('app.baseURL')}}/assets/css/semi-dark.css" />
	<link rel="stylesheet" href="{{config('app.baseURL')}}/assets/css/header-colors.css" />
</head>

<!--start page wrapper -->
<div class="page-wrapper">
	<div class="page-content">
		<div class="row">
			<div class="col-xl-12">
				<div class="card border-top border-0 border-4 border-primary">
					<div class="card-body p-5">
						<div class="card-title d-flex align-items-center">
							<div><i class="bx bxs-user-plus me-1 font-22 text-primary"></i>
							</div>
							<h5 class="mb-0 text-primary">Send Offers</h5>
						</div>
						<hr>
						<form method="POST" action="{{config('app.baseURL')}}/offer/add" class="row g-3">
							@csrf

							<div class="col-6">
										<label class="form-label">Mobile Number</label>
										<select class="multiple-select" name="mobile_number[]" data-placeholder="Choose anything" multiple="multiple">
											@foreach($data as $datas)
											<option value="{{$datas->mobile_number}}">{{$datas->mobile_number}}</option>
											@endforeach
										</select>
							</div>

							<div class="col-12 email">
							</div>
							<div class="col-6 email">
								<label for="inputEmailAddress" class="form-label">Message</label>

								<textarea required placeholder="Message" class="form-control" rows="5" name="message" id="message"></textarea>
							</div>
						
							<div class="col-12">
								<button type="submit" class="btn btn-primary px-5">Send To All</button>
							</div>
						</form>
					</div>
				</div>

			</div>
		</div>
		<!--end row-->

	</div>
</div>
<!--end page wrapper -->
<script src="{{config('app.baseURL')}}/assets/plugins/select2/js/select2.min.js"></script>
<script>
		$('.multiple-select').select2({
			theme: 'bootstrap4',
			width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
			placeholder: $(this).data('placeholder'),
			allowClear: Boolean($(this).data('allow-clear')),
		});
	</script>
	
@endsection