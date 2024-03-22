@extends('layouts.app')
@section('content')
<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<h6 class="mb-0 text-uppercase" style="display:inline-block;">New Order</h6>
				<hr/>

				<div class="card">
					<div class="card-body">
						<p  align="right">
							<button type="submit" id="submitBtn" onclick="checkFirst()" class="btn btn-success"><i class="bx bx-check"></i> Mark As Accepted</button></p>
						<div class="table-responsive">
							<table id="example" class="table table-hover table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>Sr No.</th>
										<th>Production Date</th>
										<th>Production Status</th>
										<th>Customer Name</th>
										<th>Label/Ribbon Size</th>
										<th>Core Size</th>
										<th>Material</th>
										<th>Roll For Checking</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($order as $key=>$order)
									<tr>
										<td>{{++$key}}</td>
										<td>{{$order->check_time}}</td>
										<td>
											
											@if($order->order->order_status==1)
											<div class="badge rounded-pill text-danger bg-light-danger p-2 text-uppercase px-3"><i class='bx bxs-circle align-middle me-1'></i>Pending</div>
											@elseif($order->order->order_status==2)
											<div class="badge rounded-pill text-warning bg-light-warning p-2 text-uppercase px-3"><i class='bx bxs-circle align-middle me-1'></i>Processing</div>
											@else
											<div class="badge rounded-pill text-info bg-light-info p-2 text-uppercase px-3"><i class='bx bxs-circle align-middle me-1'></i>Checking</div>
											@endif
										</td>
										<td>{{$order->order->customer->customer_name}}</td>
										<td>{{$order->order->label_size}}{{$order->order->label_type1}} X {{$order->order->label_size1}}{{$order->order->label_type2}}</td>
										<td>{{$order->order->core_size}}"</td>
										<td>{{$order->order->material_detail->our_product_code}}</td>
										<td>{{$order->check_roll}}</td>
										
										<td>
											<p align="center">
											<input type="checkbox" value="{{$order->id}}" class="form-check-input" name="accept_roll">
											</p>
										</td>
									</tr>
									@endforeach
								</tbody>
								<tfoot>
									<tr>
										<th>Sr No.</th>
										<th>Production Date</th>
										<th>Production Status</th>
										<th>Customer Name</th>
										<th>Label/Ribbon Size</th>
										<th>Core Size</th>
										<th>Material</th>
										<th>Roll For Checking</th>
										<th>Action</th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
				
			</div>
		</div>

		<script type="text/javascript">
			function checkFirst()
			{
				var tmp = [];
  				$("input").each(function() {
    			if ($(this).is(':checked')) {
      			var checked = ($(this).val());
      			tmp.push(checked);
    			}
  				});
  				if(tmp.length==0)
  				{
  					alert('Please Select Atleast 1 Order !');
  				}
  				else
  				{
  					$("#submitBtn").attr('disabled','disabled');
					$.ajax({
						url: "{{config('app.baseURL')}}/checking/accept-data",
						type: 'GET',
						data: {checking_id:tmp},
						success:function(data)
						{
							window.location.reload();
						}
					});
  				}
			}
		</script>
		<!--end page wrapper -->
@endsection