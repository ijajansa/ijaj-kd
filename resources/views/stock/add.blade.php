@extends('layouts.app')
@section('content')

<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				
				<div class="row">
					<div class="col-xl-12">
						<div class="card border-top border-0 border-4 border-primary">
							<div class="card-body p-5">
								<div class="card-title d-flex align-items-center">
									<div><i class="bx bx-plus me-1 font-22 text-primary"></i>
									</div>
									<h5 class="mb-0 text-primary">Add New @if($product_type==2) Ribbon @elseif($product_type==3) Scanner @elseif($product_type==4) Printer @else Label @endif</h5>
								</div>
								<hr>
								<form class="row g-3" method="POST" action="{{config('app.baseURL')}}/stock/add/{{$product_type}}">
									@csrf
									
									@if($product_type==3 || $product_type==4)
									<div class="col-md-6">
										<label for="brand" class="form-label">Brand <span class="text-danger" style="font-weight: bold;">*</span></label>
										<input type="text" name="brand" class="form-control" id="brand" required>
									</div>
									<div class="col-md-6">
										<label for="model" class="form-label">Model Number <span class="text-danger" style="font-weight: bold;">*</span></label>
										<input type="text" name="model" class="form-control" id="model" required>
									</div>
									@endif
									@if($product_type==3)
									<div class="col-md-6">
										<label for="BarcodeType" class="form-label">Barcode Type <span class="text-danger" style="font-weight: bold;">*</span></label>
										<input type="text" name="barcode_type" class="form-control" id="BarcodeType" required>
									</div>
									@endif
									@if($product_type==4)
									<div class="col-md-6">
										<label for="Resolution" class="form-label">Resolution <span class="text-danger" style="font-weight: bold;">*</span></label>
										<input type="text" name="resolution" class="form-control" id="Resolution" required>
									</div>
									@endif

									@if($product_type==2)
									<div class="col-md-6">
										<label for="Supplier" class="form-label">Supplier Product Code <span class="text-danger" style="font-weight: bold;">*</span></label>
										<input type="text" name="supplier_product_code" class="form-control" id="Supplier" required>
									</div>
									<div class="col-md-6">
										<label for="our_product_code" class="form-label">Our Product Code <span class="text-danger" style="font-weight: bold;">*</span></label>
										<input type="text" name="our_product_code" class="form-control" id="our_product_code" required>
									</div>
									<div class="col-md-6">
										<div class="row">
											<label for="inputLastName" class="form-label">Ribbon Size <span class="text-danger" style="font-weight: bold;">*</span></label>
										<div class="col-md-3">
										<input type="text" class="form-control" id="inputLastName" name="label_size1" placeholder="Width" required>
											</div>
											<div class="col-md-3">
										<select class="form-control form-select" name="label_type1">
											<option value="mm">mm</option>
											<option value="in">inch</option>
										</select>
											</div>
											<div class="col-md-3">
										<input type="text" class="form-control" id="inputLastName" name="label_size2" placeholder="Height" required>
											</div>
											<div class="col-md-3">
											<select class="form-control form-select" name="label_type2">
											<option value="meter">meter</option>
										</select>
											</div>
										</div>
										
									</div>

									<div class="col-md-6">
										<label for="Grade" class="form-label">Grade <span class="text-danger" style="font-weight: bold;">*</span></label>
										<select required name="grade" class="form-control form-select" id="Grade">
											<option value="">Select</option>
											<option value="wax">Wax</option>
											<option value="wax-resin">Wax Resin</option>
											<option value="resin">Resin</option>
										</select>
									</div>

									<div class="col-md-6">
										<label for="Ink" class="form-label">Ink <span class="text-danger" style="font-weight: bold;">*</span></label>
										<select required name="ink" class="form-control form-select" id="Ink">
											<option value="">Select</option>
											<option value="in">In</option>
											<option value="out">Out</option>
										</select>
									</div>
									<div class="col-md-6">
										<label for="Core" class="form-label">Core <span class="text-danger" style="font-weight: bold;">*</span></label>
										<select required name="core" class="form-control form-select" id="Core">
											<option value="">Select</option>
											<option value="0.5">0.5"</option>
											<option value="1">1"</option>
										</select>
									</div>
									<div class="col-md-6">
										<label for="Notch" class="form-label">Notch <span class="text-danger" style="font-weight: bold;">*</span></label>
										<select required name="notch" class="form-control form-select" id="Notch">
											<option value="">Select</option>
											<option value="with_notch">With Notch</option>
											<option value="without_notch">Without Notch</option>
										</select>
									</div>
									@endif

									@if($product_type==3 || $product_type==4 || $product_type==2)
									<div class="col-md-6">
										<label for="Quantity" class="form-label">Quantity <span class="text-danger" style="font-weight: bold;">*</span></label>
										<input type="number" name="quantity" class="form-control" id="Quantity" required>
									</div>
									@endif
									<div class="col-12">
										<div class="form-check">
											<input class="form-check-input" type="checkbox" id="gridCheck" required>
											<label class="form-check-label" for="gridCheck">Please click the button before submitting the above details</label>
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
@endsection