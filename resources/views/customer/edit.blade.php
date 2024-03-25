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
    border-radius: 50%;
    font-size: 22px;
    line-height: 24px;
    padding-left: 7px;
	}

</style>


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
							<div><i class="bx bx-edit me-1 font-22 text-primary"></i>
							</div>
							<h5 class="mb-0 text-primary" style="font-weight: bold;">Update Inspector Details</h5>
						</div>
						<hr>
						<form class="row g-3" method="POST" action="{{config('app.baseURL')}}/user/edit/{{$data->id}}">
							@csrf
							<div class="col-md-4">
								<label for="inputFirstName2" class="form-label">Name</label>
								<input type="text" name="name" required class="form-control" placeholder="Name" value="{{$data->name}}">
							</div>

							<div class="col-md-4">
								<label for="inputFirstName2" class="form-label">Email Address</label>
								<input type="email" name="email" class="form-control" placeholder="Email Address" value="{{$data->email}}">
							</div>
							<div class="col-md-4">
								<label for="inputFirstName2" class="form-label">Contact Number</label>
								<input type="text" name="mobile_number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="10" minlength="10" required class="form-control" placeholder="Contact Number" value="{{$data->mobile_number}}">
							</div>
							@if(auth()->user()->role_id==1)
								<div class="col-xl-4">
								<label class="form-label blog-label">System User</label>
								<select name="user_id" required class="form-control form-select @error('user_id') is-invalid @enderror" onchange="getWards(this.value)" id="inputCat">
									<option value="">Select User</option>
									@foreach($users as $user)
									<option value="{{$user->id}}" @if(old('user_id',$data->user_id)==$user->id) selected @endif>{{$user->name}} {{" - ".$user->category_name}}</option>
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
							<div class="col-md-4">
								<label for="inputFirstName2" class="form-label">Select Ward</label>
								<select class="form-control form-select" required onchange="getArea1(this.value)" id="ward_id" name="ward_id">
									<option value="">Select Ward</option>
									@foreach($wards as $ward)
									<option value="{{$ward->id}}" @if($ward->id==$data->ward_id) selected @endif>{{$ward->name}}</option>
									@endforeach
								</select>
							</div>

							

							<div class="col-md-4">
								<label for="inputFirstName2" class="form-label">Select Area</label>
								<select class="multiple-select" required name="area_id[]" id="area_id" data-placeholder="Choose anything" multiple="multiple">
									@foreach($areas as $area)
									<option value="{{$area->id}}" @if($area->is_present==1) selected @endif>{{$area->address}}</option>
									@endforeach
								</select>
							</div>

							<div class="col-md-12">
								<label for="inputFirstName2" class="form-label">Address</label>
								<textarea rows="4" name="address" class="form-control" placeholder="Address">{{$data->address}}</textarea>
							</div>
							
							<div class="col-md-4">
								<label for="inputFirstName2" class="form-label">Status</label>
								<select class="form-control form-select" name="status">
									<option value="1" @if($data->is_active==1) selected @endif>Active</option>
									<option value="0" @if($data->is_active==0) selected @endif>Inactive</option>
								</select>
							</div>
							<div class="col-12">
								<button type="submit" class="btn btn-primary px-5">Update User</button>
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

	function getArea1(ward_id)
	{
		// ward_id=$("#shed_id").val();
		data=[];
		data.push(ward_id);
		if(data.length!=0)
		{
			$.ajax({
				url: "{{config('app.baseURL')}}/user/get-area",
				type:"GET",
				data:{ward_id:data[0]},
				success:function(data)
				{
					$("#area_id").empty();
					$("#area_id").html(data);
				}
			});
		}
	}
</script>

<script src="{{config('app.baseURL')}}/assets/plugins/select2/js/select2.min.js"></script>
	<script>
	
		$('.multiple-select').select2({
			theme: 'bootstrap4',
			width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
			placeholder: $(this).data('placeholder'),
			allowClear: Boolean($(this).data('allow-clear')),
		});
	</script>
<script type="text/javascript">
	function getHajeriShed(id)
	{
		if(id.length!=0)
		{
			$.ajax({
				url:"{{config('app.baseURL')}}/barcode/getHajeriShed",
				type:'GET',
				data:{id:id},
				success:function(data)
				{
					$("#shed_id").empty();
					$("#shed_id").html(data);
				}
			});
		}
	}
</script>
@endsection