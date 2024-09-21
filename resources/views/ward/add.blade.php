@extends('layouts.app')
@section('content')
<script type="text/javascript">
	function blockSpecialChar(e) {
		var k = e.keyCode;
		return (
			(k >= 65 && k <= 90) ||  // A-Z
			(k >= 97 && k <= 122) || // a-z
			k === 8 ||               // Backspace
			(k >= 48 && k <= 57) ||  // 0-9
			k === 32                 // Space
		);
	}
</script>
<!--start page wrapper -->
<div class="page-wrapper">
	<div class="page-content">
		<div class="row">
			<div class="col-xl-6">
				<div class="card border-top border-0 border-4 border-primary">
					<div class="card-body p-5">
						<div class="card-title d-flex align-items-center">
							<div><i class="bx bxs-user-plus me-1 font-22 text-primary"></i>
							</div>
							<h5 class="mb-0 text-primary">Update Ward Details</h5>
						</div>
						<hr>
						<form method="POST" action="{{config('app.baseURL')}}/wards/edit/{{$data->id}}" class="row g-3">
							@csrf
							<div class="col-6">
								<label for="inputLastName1" class="form-label">Ward Number</label>
									<input type="text" value="{{$data->ward_number}}" class="form-control" id="name" placeholder="Ward Number" name="ward_number" required  onkeypress="return blockSpecialChar(event)"/>
							</div>
							<div class="col-6">
								<label for="inputLastName1" class="form-label">Ward Name</label>
									<input type="text" value="{{$data->name}}" class="form-control" id="name" placeholder="Ward Name" name="name" required  onkeypress="return blockSpecialChar(event)"/>
							</div>
					<!--@if(auth()->user()->role_id==1)-->
					<!--	<div class="col-xl-12">-->
					<!--	<label class="form-label blog-label">System User</label>-->
					<!--	<select name="user_id" required class="form-control form-select @error('user_id') is-invalid @enderror" id="inputCat">-->
					<!--		<option value="">Select User</option>-->
					<!--		@foreach($users as $user)-->
					<!--		<option value="{{$user->id}}" @if(old('user_id',$data->user_id)==$user->id) selected @endif>{{$user->name}} {{" - ".$user->category_name}}</option>-->
					<!--		@endforeach-->
					<!--	</select>-->
					<!--	@error('user_id')-->
					<!--	<span class="invalid-feedback" role="alert">-->
					<!--		<strong>{{ $message }}</strong>-->
					<!--	</span>-->
					<!--	@enderror-->
					<!--	</div>-->
					<!--@else-->
					<!--	<input type="hidden" value="{{auth()->user()->id}}" name="user_id">-->
					<!--	@endif-->
							<div class="col-12">
								<label for="inputLastName1" class="form-label">Status</label>
								<select name="status" class="form-control form-select">
									<option value="1" @if($data->is_active==1) selected @endif>Active</option>
									<option value="0" @if($data->is_active==0) selected @endif>Inactive</option>
								</select>
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