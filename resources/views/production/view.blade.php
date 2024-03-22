@extends('layouts.app')
@section('content')
<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				
				<div class="row">
					<div class="col-xl-12">
						<div class="card border-top border-0 border-4 border-primary">
							<div class="card-body p-5">
								<div class="card-title d-flex align-items-center">
									<div><i class="bx bx-file me-1 font-22 text-primary"></i>
									</div>
									<h5 class="mb-0 text-primary">View Order</h5>
								</div>
								<hr>
								<form class="row g-3" method="POST" action="{{config('app.baseURL')}}/production/edit/">
									@csrf
									<div class="col-md-6">
										<label for="inputFirstName" class="form-label">Customer Name <span class="text-danger" style="font-weight: bold;">*</span></label>
										<input type="text" name="name" class="form-control" id="inputFirstName" value="{{$production->order->customer_name}}" required readonly>
									</div>
									<div class="col-md-6">
										<label for="inputFirstName2" class="form-label">Customer Email <span class="text-danger" style="font-weight: bold;">*</span></label>
										<input type="email" name="email" class="form-control" id="inputFirstName2" value="{{$production->order->customer_email}}" required readonly>
									</div>
									<div class="col-md-6">
										<label for="inputOrderType" class="form-label">Order Type <span class="text-danger" style="font-weight: bold;">*</span></label>
										<select id="inputOrderType" name="product_type" class="form-select" disabled>
											<option value="{{$production->order->product_type}}" selected>{{$production->order->type->name}}</option>
										</select>
									</div>
									<div class="col-md-6">
										<label for="inputLastName" class="form-label">Label/Ribbon Size <span class="text-danger" style="font-weight: bold;">*</span></label>
										<input type="text" class="form-control" id="inputLastName" name="label_size" value="{{$production->order->label_size}}" required readonly>
									</div>
									<div class="col-md-6">
										<label for="inputLastName2" class="form-label">Core Size <span class="text-danger" style="font-weight: bold;">*</span></label>
										<input type="text" class="form-control" id="inputLastName2" name="core_size" value="{{$production->order->core_size}}" required readonly>
									</div>
									<div class="col-md-6">
										<label for="inputEmail" class="form-label">Each Label Quantity <span class="text-danger" style="font-weight: bold;">*</span></label>
										<input name="each_label_qty" type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control" id="inputEmail" value="{{$production->order->each_label_qty}}" required readonly>
									</div>
									<div class="col-md-6">
										<label for="inputPassword" class="form-label">Material <span class="text-danger" style="font-weight: bold;">*</span></label>
										<input type="text" class="form-control" id="inputPassword" name="material" value="{{$production->order->material}}" required  readonly>
									</div>
									<div class="col-md-6">
										<label for="inputEmail2" class="form-label">Total Quantity <span class="text-danger" style="font-weight: bold;">*</span></label>
										<input type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control" id="inputEmail2" name="total_qty"  value="{{$production->order->quantity}}" required readonly>
									</div>
									<div class="col-md-6">
										<label for="inputEmail2" class="form-label">No.of Rolls <span class="text-danger" style="font-weight: bold;">*</span></label>
										<input type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control" id="inputEmail2" name="rolls"  value="{{$production->order->rolls}}" required readonly>
									</div>
									<div class="col-md-6">
										<label for="inputCity" class="form-label">P.O.Number</label>
										<input type="text" name="ponumber" class="form-control" id="inputCity" required  value="{{$production->order->po_number}}" readonly>
									</div>
									<div class="col-md-6">
										<label for="inputState" class="form-label">P.O.Date</label>
										<input type="date" name="podate"  value="{{$production->order->po_date}}" readonly class="form-control" id="inputState">
									</div>
									<div class="col-md-6">
										<label for="inputState1" class="form-label">Select Machine</label>
										<select class="form-select" name="machine_id" disabled>
											<option value="{{$production->machine_id}}">{{$production->machine->machine_id}}</option>
										</select>
									</div>
									<div class="col-md-6">
										<label for="inputState2" class="form-label">Operator Name</label>
										<input type="text" name="operator_name" class="form-control" id="inputState2" value="{{$production->operator_name}}" readonly>
									</div>
									<div class="col-md-6">
										<label for="inputState3" class="form-label">Job Card</label>
										<input type="text" name="job_card" class="form-control" id="inputState3" value="{{$production->job_card}}" readonly>
									</div>
									<div class="col-12">
										<div class="form-check">
											<input class="form-check-input" type="checkbox" id="gridCheck" required>
											<label class="form-check-label" for="gridCheck">Please click the button before submitting the above details</label>
										</div>
									</div>
									<div class="col-12">
										<!-- <button type="submit" class="btn btn-primary px-5">Add To Production</button> -->
										&nbsp;<a href="{{config('app.baseURL')}}/production/all-data"><button type="button" class="btn btn-outline-primary px-5">Back</button></a>
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