@extends('layouts.app')
@section('content')
<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<div class="row">
					<div class="col-xl-6">
						<div class="card border-top border-0 border-4 border-primary">
							<div class="card-body p-5">
								<div class="card-title d-flex align-items-center">
									<div><i class="bx bx-recycle me-1 font-22 text-primary"></i>
									</div>
									<h5 class="mb-0 text-primary">Edit Machine</h5>
								</div>
								<hr>
								<form method="POST" action="{{config('app.baseURL')}}/machine/edit/{{$machine->id}}" class="row g-3">
									@csrf
									<div class="col-12">
										<label for="inputFirstName" class="form-label">Machine ID</label>
										<input type="text" name="machine_id" value="{{$machine->machine_id}}" class="form-control" id="inputFirstName" required>
									</div>
									
									<div class="col-12">
										<label for="inputFirstName" class="form-label">Machine Name</label>
										<input type="text" name="machine_name" value="{{$machine->machine_name}}" class="form-control" id="inputFirstName" required>
									</div>
									
									
									<div class="col-12">
										<div class="form-check">
											<input class="form-check-input" type="checkbox" id="gridCheck2" required>
											<label class="form-check-label" for="gridCheck2">please click the checkbox before proceeding above data</label>
										</div>
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