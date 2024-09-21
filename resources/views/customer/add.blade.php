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
<script type="text/javascript">
	function blockSpecialChar(e) {
		var k = e.keyCode;
		return (
			(k >= 65 && k <= 90) ||  // A-Z
			(k >= 97 && k <= 122) || // a-z
			k === 8 ||               // Backspace
			k === 32                 // Space
		);
	}
</script>
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
							<h5 class="mb-0 text-primary" style="font-weight: bold;">Add HOD</h5>
						</div>
						<hr>
						<form class="row g-3" method="POST" action="{{config('app.baseURL')}}/user/add">
							@csrf
							<div class="col-md-6">
								<label for="inputFirstName2" class="form-label">Name</label>
								<input type="text" name="name"  class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" onkeypress="return blockSpecialChar(event)"  placeholder="Name">
								@error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
							</div>
							
							<div class="col-md-6">
								<label for="inputFirstName2" class="form-label">Designation</label>
								<input type="text" name="designation"  class="form-control @error('designation') is-invalid @enderror" value="{{old('designation')}}" onkeypress="return blockSpecialChar(event)"  placeholder="Designation">
								@error('designation')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
							</div>

							<div class="col-md-6">
								<label for="inputFirstName2" class="form-label">Email Address</label>
								<input type="email" name="email" class="form-control @error('email') is-invalid @enderror"  value="{{old('email')}}" placeholder="Email Address">
								@error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
							</div>
							<div class="col-md-6">
								<label for="inputFirstName2" class="form-label">Contact Number</label>
								<input type="text" name="contact_number"  value="{{old('contact_number')}}" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="10" minlength="10"  class="form-control @error('contact_number') is-invalid @enderror" placeholder="Contact Number">
								@error('contact_number')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
							</div>
							<div class="col-md-6">
								<label for="inputFirstName2" class="form-label">Select Category</label>
								<select class="form-control multiple-select form-select @error('category_id') is-invalid @enderror"  name="category_id[]" multiple="multiple" placeholder="Select Category">
									<option value="" disabled hidden>Select Category</option>
									@foreach($categories as $category)
									<option value="{{$category->id}}" @if(old('category_id')==$category->id) selected @endif>{{$category->name}}</option>
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
							<div class="col-12">
								<button type="submit" class="btn btn-primary px-5">Register</button>
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

<script type="text/javascript">

	function getArea1()
	{
		ward_id=$("#ward_id").val();
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
					$("#area_id").html(data);
				}
			});
		}
	}

	function getArea(ward_id)
	{
		if(ward_id.length!=0)
		{
			$.ajax({
				url: "{{config('app.baseURL')}}/user/get-area",
				type:"GET",
				data:{ward_id:ward_id},
				success:function(data)
				{
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
					$("#shed_id").html(data);
				}
			});
		}
	}
</script>
@endsection