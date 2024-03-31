@extends('layouts.app')
@section('content')
	<!--plugins-->
    <link href="{{config('app.baseURL')}}/assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
    <link href="{{config('app.baseURL')}}/assets/plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />

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
							<h5 class="mb-0 text-primary" style="font-weight: bold;">Update Product Details</h5>
						</div>
						<hr>
						<form class="row g-3" method="POST" action="{{route('products.update',$data->id)}}">
							@csrf
							@method('PATCH')
							<div class="col-md-12">
								<label for="inputFirstName2" class="form-label">Name</label>
								<input type="text" name="name"  class="form-control @error('name') is-invalid @enderror" value="{{old('name',$data->name)}}" placeholder="Name">
								@error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
							</div>
							<div class="col-md-12">
								<label for="inputFirstName2" class="form-label">Select Type</label>
								<select class="form-control form-select @error('type') is-invalid @enderror" name="type">
									<option value="1" @if(old('type',$data->type)==1) selected @endif>CND-Waste</option>
									<option value="2" @if(old('type',$data->type)==2) selected @endif>E-Waste</option>
								</select>
								@error('type')
                                	<span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
							</div>

							
							<div class="col-md-12">
								<label for="inputFirstName2" class="form-label">Select Status</label>
								<select class="form-control form-select @error('is_active') is-invalid @enderror"  name="is_active">
									<option value="1" @if(old('is_active',$data->is_active)==1) selected @endif>Active</option>
									<option value="0" @if(old('is_active',$data->is_active)==0) selected @endif>Inactive</option>
								</select>
								@error('is_active')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
							</div>
							<div class="col-12">
								<button type="submit" class="btn btn-primary px-5">Update</button>
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