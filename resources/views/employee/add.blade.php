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
							<h5 class="mb-0 text-primary" style="font-weight: bold;">Add Supervisor</h5>
						</div>
						<hr>
						<form class="row g-3" method="POST" action="{{config('app.baseURL')}}/employee/add">
							@csrf
							<div class="col-md-4">
								<label for="inputFirstName2" class="form-label">Name</label>
								<input type="text" name="name"  class="form-control @error('name') is-invalid @enderror" placeholder="Name" value="{{old('name')}}" onkeypress="return blockSpecialChar(event)">
								@error('name')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
							
							<div class="col-md-4">
								<label for="inputFirstName2" class="form-label">Designation</label>
								<input type="text" name="designation"  class="form-control @error('designation') is-invalid @enderror" placeholder="Designation" value="{{old('designation')}}" onkeypress="return blockSpecialChar(event)">
								@error('designation')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>

							<div class="col-md-4">
								<label for="inputFirstName2" class="form-label">Email Address</label>
								<input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}" placeholder="Email Address">
								@error('email')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
							<div class="col-md-4">
								<label for="inputFirstName2" class="form-label">Contact Number</label>
								<input type="text" name="mobile_number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="10" minlength="10"  class="form-control @error('mobile_number') is-invalid @enderror" value="{{old('mobile_number')}}" placeholder="Contact Number">
								@error('mobile_number')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>

							<div class="col-md-4">
								<label for="inputFirstName2" class="form-label">Select HOD</label>
								<select class="form-control form-select @error('inspector_id') is-invalid @enderror" id="inspector_id" name="inspector_id">
									<option value="">Select HOD</option>
									@foreach($inspectors as $inspector)
									<option value="{{$inspector->id}}">{{$inspector->name}}</option>
									@endforeach
								</select>
								@error('inspector_id')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
							<div class="col-md-4">
								<label for="inputFirstName2" class="form-label">Select Category</label>
								<select class="form-control multiple-select form-select @error('category_id') is-invalid @enderror"  name="category_id[]" multiple="multiple">
									<option value="">Select Category</option>
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
							


							
							<div class="col-md-4">
								<label for="inputFirstName2" class="form-label">Password</label>
								<input type="password" name="password" minlength="8" required class="form-control" placeholder="Password">
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
	function getInspector(id)
	{
		if(id.length!=0)
		{
			$.ajax({
				url:"{{config('app.baseURL')}}/employee/getInspectors",
				type:'GET',
				data:{id:id},
				success:function(data)
				{
					$("#inspector_id").html(data);
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
@endsection