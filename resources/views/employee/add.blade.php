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
							<h5 class="mb-0 text-primary" style="font-weight: bold;">Add Employee</h5>
						</div>
						<hr>
						<form class="row g-3" method="POST" action="{{config('app.baseURL')}}/employee/add">
							@csrf
							<div class="col-md-4">
								<label for="inputFirstName2" class="form-label">Name</label>
								<input type="text" name="name" required class="form-control" placeholder="Name">
							</div>

							<div class="col-md-4">
								<label for="inputFirstName2" class="form-label">Email Address</label>
								<input type="email" name="email" class="form-control" placeholder="Email Address">
							</div>
							<div class="col-md-4">
								<label for="inputFirstName2" class="form-label">Contact Number</label>
								<input type="text" name="mobile_number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="10" minlength="10" required class="form-control" placeholder="Contact Number">
							</div>

							@if(auth()->user()->role_id==1)
								<div class="col-xl-4">
								<label class="form-label blog-label">System User</label>
								<select name="user_id" required class="form-control form-select @error('user_id') is-invalid @enderror" onchange="getInspector(this.value)" id="inputCat">
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
							<div class="col-md-4">
								<label for="inputFirstName2" class="form-label">Select Inspector</label>
								<select class="form-control form-select" required id="inspector_id" name="inspector_id">
									<option value="">Select Inspector</option>
									@foreach($inspectors as $inspector)
									<option value="{{$inspector->id}}">{{$inspector->name}}</option>
									@endforeach
								</select>
							</div>
							
							<div class="col-md-12">
								<label for="inputFirstName2" class="form-label">Address</label>
								<textarea rows="4" name="address" class="form-control" placeholder="Address"></textarea>
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
@endsection