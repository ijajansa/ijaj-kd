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
							<h5 class="mb-0 text-primary">New Area</h5>
						</div>
						<hr>
					<form class="row g-3" method="POST" action="{{config('app.baseURL')}}/barcode/add">
					@csrf
					@if(auth()->user()->role_id==1)
						<div class="col-xl-12">
						<label class="form-label blog-label">System User <span class="text-danger" style="font-weight: bold;">*</span></label>
						<select name="user_id" required class="form-control form-select @error('user_id') is-invalid @enderror" onchange="getWards(this.value)" id="inputCat">
							<option value="">Select User</option>
							@foreach($users as $user)
							<option value="{{$user->id}}" @if(old('user_id')==$user->id) selected @endif>{{$user->name}} {{" - ".$user->category_name}}</option>
							@endforeach
						</select>
						@error('user_id')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
						@enderror
						</div>
					@else
						<input type="hidden" value="{{auth()->user()->id}}" name="user_id">
					@endif
							<div class="col-md-12">
								<label for="inputFirstName2" class="form-label">Select Ward <span class="text-danger" style="font-weight: bold;">*</span></label>
								<select class="form-control form-select" id="ward_id" name="ward_id" required>
									<option value="">Select</option>
									@foreach($data as $ward)
									<option value="{{$ward->id}}">{{$ward->name}}</option>
									@endforeach
								</select>
							</div>
							
							<!-- <div class="col-md-12">
								<label for="inputFirstName2" class="form-label">Select Hajeri Shed <span class="text-danger" style="font-weight: bold;">*</span></label>
								<select class="form-control form-select" name="shed_id" id="shed_id" required>
									<option value="">Select</option>
									
								</select>
							</div>
							 -->

							<div class="col-md-12">
								<label for="inputFirstName2" class="form-label">Address <span class="text-danger" style="font-weight: bold;">*</span></label>
								<input type="text" name="address" class="form-control" id="inputFirstName2" required>
							</div>
							<!-- <div class="col-md-12">
								<label for="inputFirstName3" class="form-label">Description <span class="text-danger" style="font-weight: bold;">*</span></label>
								<textarea class="form-control" name="details" required rows="5"></textarea>
							</div>
							 -->
							<div class="col-12">
								<button type="submit" class="btn btn-primary px-5">Generate QR Code</button>
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
	function getWards(id)
	{
		if(id.length!=0)
		{
			$.ajax({
				url:"{{config('app.baseURL')}}/barcode/getWards",
				type:'GET',
				data:{id:id},
				success:function(data)
				{
					$("#ward_id").html(data);
				}
			});
		}
	}
</script>

@endsection