@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.min.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.jquery.min.js"></script>


<!--start page wrapper -->
<div class="page-wrapper">
	<div class="page-content">

		<div class="row">
			<div class="col-xl-6">
				<div class="card border-top border-0 border-4 border-primary">
					<div class="card-body p-5">
						<div class="card-title d-flex align-items-center">
							<div><i class="bx bx-plus me-1 font-22 text-primary"></i>
							</div>
							<h5 class="mb-0 text-primary">New Barcode</h5>
						</div>
						<hr>
						<form class="row g-3" method="POST" action="{{config('app.baseURL')}}/barcode/add">
							@csrf
							
							<div class="col-md-12">
								<label for="inputFirstName2" class="form-label">Address <span class="text-danger" style="font-weight: bold;">*</span></label>
								<input type="text" name="address" class="form-control" id="inputFirstName2" required>
							</div>
							<div class="col-md-12">
								<label for="inputFirstName3" class="form-label">Description <span class="text-danger" style="font-weight: bold;">*</span></label>
								<textarea class="form-control" name="details" required rows="5"></textarea>
							</div>
							
							<div class="col-12">
								<button type="submit" class="btn btn-primary px-5">Generate Barcode</button>
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

@endsection