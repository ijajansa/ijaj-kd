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
						<form class="row g-3" method="POST" action="{{config('app.baseURL')}}/production/edit/{{$order->order_id}}">
							@csrf
							<div class="col-md-6">
								<label for="inputFirstName" class="form-label">Customer Name <span class="text-danger" style="font-weight: bold;">*</span></label>
								<input type="text" name="name" class="form-control" id="inputFirstName" value="{{$order->customer->customer_name}}" required readonly>
							</div>
							<div class="col-md-6">
								<label for="inputFirstName2" class="form-label">Customer Email <span class="text-danger" style="font-weight: bold;">*</span></label>
								<input type="email" name="email" class="form-control" id="inputFirstName2" value="{{$order->customer_email}}" required readonly>
							</div>
							<div class="col-md-6">
								<label for="inputFirstName2" class="form-label">Customer Contact Number <span class="text-danger" style="font-weight: bold;">*</span></label>
								<input type="text" name="customer_contact_number" class="form-control" id="inputFirstName2" value="{{$order->customer_contact_number}}" required readonly>
							</div>
							<div class="col-md-6">
								<label for="inputOrderType" class="form-label">Order Type <span class="text-danger" style="font-weight: bold;">*</span></label>
								<select id="inputOrderType" name="product_type" class="form-select" disabled>
									<option value="{{$order->product_type}}" selected>{{$order->type->name}}</option>
									@foreach($product_type as $product)
									<option value="{{$product->id}}">{{$product->name}}</option>
									@endforeach
								</select>
							</div>
<!-- 									<div class="col-md-6">
										<label for="inputLastName" class="form-label">Label/Ribbon Size <span class="text-danger" style="font-weight: bold;">*</span></label>
										<input type="text" class="form-control" id="inputLastName" name="label_size" value="{{$order->label_size}}" required readonly>
									</div> -->
									<div class="col-md-6">
										<div class="row">
											<label for="inputLastName" class="form-label">Label/Ribbon Size <span class="text-danger" style="font-weight: bold;">*</span></label>
											<div class="col-md-3">
												<input type="text" class="form-control" id="inputLastName" name="label_size" value="{{$order->label_size}}" placeholder="Width" required>
											</div>
											<div class="col-md-3">
												<select class="form-control form-select" name="label_type1" id="label_type1">
													<option value="mm">mm</option>
													<option value="in">inch</option>
												</select>
											</div>
											<div class="col-md-3">
												<input type="text" class="form-control" id="inputLastName" name="label_size1" value="{{$order->label_size1}}" placeholder="Height" required>
											</div>
											<div class="col-md-3">
												<select class="form-control form-select" id="label_type2" name="label_type2">
													<option value="mm">mm</option>
													<option value="in">inch</option>
												</select>
											</div>
										</div>
										
									</div>
									<div class="col-md-6">
										<div class="row">
											<label for="inputLastName" class="form-label">Label Gap (mm) <span class="text-danger" style="font-weight: bold;">*</span></label>
											<div class="col-md-12">
												<input type="text" class="form-control" id="inputLastName" name="label_gap" value="{{$order->label_gap}}" placeholder="Gap" required>
											</div>

										</div>
										
									</div>
									<div class="col-md-6">
										<label for="inputLastName" class="form-label">Label Across <span class="text-danger" style="font-weight: bold;">*</span></label>
										<select class="form-select form-control" name="label_across" id="labelAcross" required>
											<option value="">Select</option>
											<option value="1">1 Up</option>
											<option value="2">2 Up</option>
											<option value="3">3 Up</option>
											<option value="4">4 Up</option>
											<option value="5">5 Up</option>
											<option value="6">6 Up</option>
											<option value="7">7 Up</option>
											<option value="8">8 Up</option>
											<option value="9">9 Up</option>
											<option value="10">10 Up</option>
										</select>
									</div>
									<div class="col-md-6">
										<label for="inputLastName2" class="form-label">Core Size <span class="text-danger" style="font-weight: bold;">*</span></label>
										<!-- <input type="text" class="form-control" id="inputLastName2" name="core_size" required> -->
										<select class="form-select form-control" id="coreSize" name="core_size" required>
											<option value="">Select</option>
											<option value="1.0">1'0"</option>
											<option value="1.5">1'5"</option>
											<option value="3.0">3'0"</option>
										</select>
									</div>
									
									<div class="col-md-6">
										<label for="inputEmail" class="form-label">Each Roll Label Quantity <span class="text-danger" style="font-weight: bold;">*</span></label>
										<input name="each_label_qty" type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control" id="inputEmail" value="{{$order->each_label_qty}}" required readonly>
									</div>
									
									<div class="col-md-6">
										<label for="inputEmail2" class="form-label">Total Quantity <span class="text-danger" style="font-weight: bold;">*</span></label>
										<input type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control" id="inputEmail2" name="total_qty"  value="{{$order->quantity}}" required readonly>
									</div>
									<div class="col-md-6">
										<label for="inputEmail2" class="form-label">No.of Rolls <span class="text-danger" style="font-weight: bold;">*</span></label>
										<input type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control" id="inputEmail2" name="rolls"  value="{{$order->rolls}}" required readonly>
									</div>
									<div class="col-md-6">
										<label for="inputCity" class="form-label">P.O.Number</label>
										<input type="text" name="ponumber" class="form-control" id="inputCity" required  value="{{$order->po_number}}" readonly>
									</div>
									<div class="col-md-6">
										<label for="inputState" class="form-label">P.O.Date</label>
										<input type="date" name="podate"  value="{{$order->po_date}}" readonly class="form-control" id="inputState">
									</div>
									<div class="col-md-12">
										<hr>
										<h5>Material Details</h5>
									</div>
									<div class="col-md-6">
										<label for="inputPassword" class="form-label">Material <span class="text-danger" style="font-weight: bold;">*</span></label>
										<select class="form-control form-select" name="material" disabled>
											@foreach($material as $data)
											<option value="{{$data->id}}" @if($order->material==$data->id) selected @endif>{{$data->our_product_code}}</option>
											@endforeach
										</select>
									</div>
									<div class="col-md-12">
										<table id="example" class="table table-striped table-condensed">
											<thead>
											<tr>
												<th>Select</th>
												<th>Size</th>
												<th>Rolls</th>
												<th>Supplier Product Code</th>
											</tr>
											</thead>
											<tbody>
											@foreach($material_details as $chk)
											<tr id="{{$chk->id}}">
												<td><input type="checkbox" id="chk{{$chk->id}}" name="" class="form-check-input"></td>
												<td><b>{{$chk->width}} mm X {{$chk->height}} mm</b></td>
												<td><b>{{$chk->rolls}}</b></td>
												<td>{{$chk->supplier_product_code}}</td>
											</tr>
											@endforeach
											</tbody>
										</table>
									</div>
									<div class="col-md-12">
										<hr>
										<h5>Other Details</h5>
									</div>
									<div class="col-md-6">
										<label for="inputState1" class="form-label">Select Machine</label>
										<select class="form-select" required name="machine_id">
											<option value="">Select</option>
											@foreach($machine as $machines)
											<option value="{{$machines->id}}">{{$machines->machine_name}}</option>
											@endforeach
										</select>
									</div>
									<div class="col-md-6">
										<label for="inputState2" class="form-label">Operator Name</label>
										<!-- <input type="text" name="operator_name" class="form-control" id="inputState2"> -->
										<select class="form-select form-control" name="operator_name" id="inputState2" required>
											<option value="">Select</option>
											@foreach($employee as $emp)
											<option value="{{$emp->id}}">{{$emp->name}}</option>
											@endforeach
										</select>
									</div>
									<div class="col-md-6">
										<label for="inputState3" class="form-label">Job Card</label>
										<input type="text" name="job_card" value="JOB{{$count+1}}" class="form-control" id="inputState3">
									</div>
									<div class="col-12">
										<div class="form-check">
											<input class="form-check-input" type="checkbox" id="gridCheck" required>
											<label class="form-check-label" for="gridCheck">Please click the button before submitting the above details</label>
										</div>
									</div>
									<div class="col-12">
										<button type="submit" class="btn btn-primary px-5">Add To Production</button>&nbsp;<a href="{{config('app.baseURL')}}/production/all"><button type="button" class="btn btn-outline-primary px-5">Back</button></a>
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

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

		<script type="text/javascript">
			val1="{{$order->label_across}}";
			$('#labelAcross option[value="'+val1+'"]').attr("selected", "selected");
		</script>

		<script>
			$(document).ready(function() {
				val="{{$order->product_type}}";
				$("#inputOrderType option[value='"+val+"']").attr('selected',true);
			});
		</script>
		<script>
			$(document).ready(function() {
				val="{{$order->core_size}}";
				$("#coreSize option[value='"+val+"']").attr('selected',true);
			});
		</script>		
		<script>
			$(document).ready(function() {
				val="{{$order->label_type1}}";
				$("#label_type1 option[value='"+val+"']").attr('selected',true);
			});
		</script>		
		<script>
			$(document).ready(function() {
				val="{{$order->label_type2}}";
				$("#label_type2 option[value='"+val+"']").attr('selected',true);
			});
		</script>
		
		@endsection