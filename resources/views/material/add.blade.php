@extends('layouts.app')
@section('content')
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
							<h5 class="mb-0 text-primary">Add Raw Material</h5>
						</div>
						<hr>
						<form method="POST" action="{{config('app.baseURL')}}/material/add" class="row g-3">
							@csrf
							<div class="col-12">
								<label for="inputFirstName" class="form-label">Supplier Product Code <strong style="color:red;">*</strong></label>
								<input type="text" name="supplier_product_code"  class="form-control" id="inputFirstName" required>
							</div>

							<div class="col-12">
								<label for="inputFirstName" class="form-label">Product Description <strong style="color:red;">*</strong></label>
								<textarea class="form-control" name="product_description" required rows="4"></textarea>
							</div>

							<div class="col-12">
								<label for="inputFirstName1" class="form-label">Our Product Code <strong style="color:red;">*</strong></label>
								<input type="text" name="our_product_code"  class="form-control" id="inputFirstName1" required>
							</div>
							<div class="col-12">
								<label for="inputFirstName2" class="form-label"><strong>Label Stock Size</strong></label>
							</div>

							<div class="col-12">
								<div class="row">
									<div class="col-4">
										<label for="inputFirstName3" class="form-label">Width (mm) <strong style="color:red;">*</strong></label>
										<input type="text" name="width"  class="form-control" id="inputFirstName3"  onchange="callCal()" required>	
									</div>
									<div class="col-4">
										<label for="inputFirstName4" class="form-label">Height (Running) <strong style="color:red;">*</strong></label>
										<input type="text" name="height" class="form-control" id="inputFirstName4"  onchange="callCal()" required>	
									</div>
									<div class="col-4">
										<label for="inputFirstName5" class="form-label">No. of Rolls <strong style="color:red;">*</strong></label>
										<input type="number" min="1" value="1" name="rolls" class="form-control" id="inputFirstName5" required>	
									</div>
								</div>

							</div>
							<div class="col-12">
										<label for="inputFirstName6" class="form-label">Square Feet <strong style="color:red;">*</strong></label>
										<input type="text" name="feet"  class="form-control" id="inputFirstName6" readonly>
									</div>
							<div class="col-12">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" id="gridCheck2" required>
									<label class="form-check-label" for="gridCheck2">please click the checkbox before proceeding above data</label>
								</div>
							</div>
							<div class="col-12">
								<button type="submit" class="btn btn-primary px-5">Upload</button>
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
<script type="text/javascript">
			function callCal()
			{
				width=$("#inputFirstName3").val();
				height=$("#inputFirstName4").val();
				$("#inputFirstName6").val(width*height/1000);
			}
		</script>
@endsection