@extends('layouts.app')
@section('content')
	<!--plugins-->
    <link href="{{config('app.baseURL')}}/assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
    <link href="{{config('app.baseURL')}}/assets/plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />

<!--start page wrapper -->
<div class="page-wrapper">
	<div class="page-content">

		<div class="row">
			<div class="col-xl-8">
				<div class="card border-top border-0 border-4 border-primary">
					<div class="card-body p-5">
						<div class="card-title d-flex align-items-center">
							
						
							<div style="width: 100%;display: flex;">
            					<div style="width:100%">
            					<h5 class="mb-0 text-primary" style="display:inline-block;">E Waste Sale & Recycle Form</h5>					
            					</div>
            					<div style="width:50%">
            					<p align="right"><a href="#" class="btn btn-primary mb-3 mb-lg-0">Total E-Waste Collected in (MT) : {{$total}}</a></p>	
            					</div>
            				</div>
						</div>
						<hr>
						<form class="row g-3" method="POST" enctype="multipart/form-data" action="{{url('e-processed/add')}}">
							@csrf
							<input type="hidden" name="total_qty" value={{$total}}>
							<input type="hidden" name="main_total" value={{$main_total}}>
							<div class="col-md-4">
								<label for="" class="form-label">Date</label>
								<input type="date" name="date" min="{{date('Y-m-d')}}" class="form-control @error('date') is-invalid @enderror" value="{{old('date',date('Y-m-d'))}}" placeholder="Date">
								@error('date')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
							</div>
							<div class="col-md-4">
								<label for="inputFirstName2" class="form-label">Name of Person/Party</label>
								<input type="text" name="name"  class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" placeholder="Name">
								@error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
							</div>
							
							<div class="col-md-4">
								<label for="inputFirstName2" class="form-label">Ward</label>
								<input type="text" name="ward"  class="form-control @error('ward') is-invalid @enderror" value="{{old('ward')}}" placeholder="Ward">
								@error('ward')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
							</div>

							<div class="col-md-4">
								<label for="inputFirstName2" class="form-label">Address</label>
								<input type="text" name="address" class="form-control @error('address') is-invalid @enderror"  value="{{old('address')}}" placeholder="Address">
								@error('address')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
							</div>
							<div class="col-md-4">
								<label for="inputFirstName2" class="form-label">Mobile Number</label>
								<input type="text" name="mobile_number"  value="{{old('mobile_number')}}" onkeypress="return event.charCode >= 48 && event.charCode <= 57"  class="form-control @error('mobile_number') is-invalid @enderror" placeholder="Mobile Number">
								@error('mobile_number')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
							</div>
							<div class="col-md-4">
								<label for="" class="form-label">Weight of C&D (In MT)</label>
								<input type="number" min="1" name="weight" class="form-control @error('weight') is-invalid @enderror"  value="{{old('weight')}}" placeholder="Weight">
								@error('weight')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
							</div>
							
							<div class="col-md-4">
								<label for="inputFirstName2" class="form-label">Select Category</label>
								<select class="form-control multiple-select form-select @error('category') is-invalid @enderror"  name="category">
									<option value="">Select Category</option>
									<option value="recycle" @if(old('category')=='recycle') selected @endif>Recycle</option>
									<option value="reuse" @if(old('category')=='reuse') selected @endif>Reuse</option>
								</select>
								@error('category')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
							</div>
							<div class="col-md-4">
								<label for="" class="form-label">Payment</label>
								<input type="number" min="1" name="payment" class="form-control @error('payment') is-invalid @enderror"  value="{{old('payment')}}" placeholder="Payment">
								@error('payment')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
							</div>
							
							<div class="col-md-4">
								<label for="" class="form-label">Photo / Receipt</label>
								<input type="file" name="receipt" class="form-control @error('receipt') is-invalid @enderror"  value="{{old('receipt')}}" placeholder="Payment">
								@error('receipt')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
							</div>
							
							
							<div class="col-12">
								<button type="submit" class="btn btn-primary px-5">Save & Upload</button>
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