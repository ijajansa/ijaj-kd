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
							<h5 class="mb-0 text-primary" style="font-weight: bold;">Update Supervisor Details</h5>
						</div>
						<hr>
						<form class="row g-3" method="POST" action="{{config('app.baseURL')}}/employee/edit/{{$user->id}}">
							@csrf
							<div class="col-md-4">
								<label for="inputFirstName2" class="form-label">Name</label>
								<input type="text" name="name" required class="form-control" placeholder="Name" value="{{$user->name}}">
							</div>
								<div class="col-md-4">
								<label for="inputFirstName2" class="form-label">Designation</label>
								<input type="text" name="designation"  class="form-control @error('designation') is-invalid @enderror" value="{{old('designation',$user->designation)}}" placeholder="Designation">
								
							</div>

							<div class="col-md-4">
								<label for="inputFirstName2" class="form-label">Email Address</label>
								<input type="email" name="email" class="form-control" placeholder="Email Address" value="{{$user->email}}">
							</div>
							<div class="col-md-4">
								<label for="inputFirstName2" class="form-label">Contact Number</label>
								<input type="text" name="mobile_number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="10" minlength="10" required class="form-control" placeholder="Contact Number" value="{{$user->mobile_number}}">
							</div>
							
							<div class="col-md-4">
								<label for="inputFirstName2" class="form-label">Select HOD</label>
								<select class="form-control form-select" required id="inspector_id" name="inspector_id">
									<option value="">Select HOD</option>
									@foreach($inspectors as $inspector)
									<option value="{{$inspector->id}}" @if($inspector->id==$user->inspector_id) selected @endif>{{$inspector->name}}</option>
									@endforeach
								</select>
							</div>
								<div class="col-md-4">
								<label for="inputFirstName2" class="form-label">Select Category</label>
								<select class="form-control multiple-select form-select @error('category_id') is-invalid @enderror"  name="category_id[]" multiple="multiple">
									<option value="">Select Category</option>
									@foreach($categories as $category)
									<option value="{{$category->id}}" @if($category->is_present==1) selected @endif>{{$category->name}}</option>
									@endforeach
								</select>
								
							</div>


							<!--<div class="col-md-12">-->
							<!--	<label for="inputFirstName2" class="form-label">Address</label>-->
							<!--	<textarea rows="4" name="address" class="form-control" placeholder="Address">{{$user->address}}</textarea>-->
							<!--</div>-->
							
							<div class="col-md-4">
								<label for="inputFirstName2" class="form-label">Status</label>
								<select class="form-control form-select" name="status">
									<option value="1" @if($user->is_active==1) selected @endif>Active</option>
									<option value="0" @if($user->is_active==0) selected @endif>Inactive</option>
								</select>
							</div>
							<div class="col-12">
								<button type="submit" class="btn btn-primary px-5">Update Supervisor</button>
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