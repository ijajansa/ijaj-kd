@extends('layouts.app')
@section('content')
	<!--plugins-->
    <link href="{{config('app.baseURL')}}/assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
    <link href="{{config('app.baseURL')}}/assets/plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />

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
							<h5 class="mb-0 text-primary" style="font-weight: bold;">Update System User Details</h5>
						</div>
						<hr>
						<form class="row g-3" method="POST" action="{{route('admins.update',$user->id)}}">
							@csrf
							@method('PATCH')
							<div class="col-md-6">
								<label for="inputFirstName2" class="form-label">Name</label>
								<input type="text" name="name"  class="form-control @error('name') is-invalid @enderror" value="{{old('name',$user->name)}}" placeholder="Name">
								@error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
							</div>
							<div class="col-md-6">
								<label for="inputFirstName2" class="form-label">Designation</label>
								<input type="text" name="designation"  class="form-control @error('designation') is-invalid @enderror" value="{{old('designation',$user->designation)}}" placeholder="Designation">
								@error('designation')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
							</div>

							<div class="col-md-6">
								<label for="inputFirstName2" class="form-label">Email Address</label>
								<input type="email" name="email" class="form-control @error('email') is-invalid @enderror"  value="{{old('email',$user->email)}}" placeholder="Email Address">
								@error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
							</div>
							<div class="col-md-6">
								<label for="inputFirstName2" class="form-label">Contact Number</label>
								<input type="text" name="contact_number"  value="{{old('contact_number',$user->contact_number)}}" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="10" minlength="10"  class="form-control @error('contact_number') is-invalid @enderror" placeholder="Contact Number">
								@error('contact_number')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
							</div>
							<div class="col-md-6">
								<label for="inputFirstName2" class="form-label">Select Category</label>
								<select class="form-control multiple-select form-select @error('category_id') is-invalid @enderror"  name="category_id[]" multiple="multiple">
									<option value="">Select Category</option>
									@foreach($categories as $category)
									<option value="{{$category->id}}" @if($category->is_present==1) selected @endif>{{$category->name}}</option>
									@endforeach
								</select>
								@error('category_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
							</div>
							
							<div class="col-md-6">
								<label for="inputFirstName2" class="form-label">Password</label>
								<input type="password" name="password" minlength="8"  class="form-control @error('password') is-invalid @enderror" placeholder="Password">
								@error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
							</div>
							<div class="col-md-6">
								<label for="inputFirstName2" class="form-label">Select Status</label>
								<select class="form-control form-select @error('is_active') is-invalid @enderror"  name="is_active">
									<option value="1" @if(old('is_active',$user->is_active)==1) selected @endif>Active</option>
									<option value="0" @if(old('is_active',$user->is_active)==0) selected @endif>Inactive</option>
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


<script src="{{config('app.baseURL')}}/assets/plugins/select2/js/select2.min.js"></script>

	<script>
	
		$('.multiple-select').select2({
			theme: 'bootstrap4',
			width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
			placeholder: $(this).data('placeholder'),
			allowClear: Boolean($(this).data('allow-clear')),
		});
	</script>
<!--end page wrapper -->

@endsection