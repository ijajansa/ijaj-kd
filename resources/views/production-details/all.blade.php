@extends('layouts.app')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<style type="text/css">
	.row p{
		margin-bottom: 10px;
		font-size: 16px;
	}
	.page-content{
		padding: 0rem 1.5rem 0.7rem 1.5rem;
	}

#searchDiv{
		position: absolute;
		width: 91%;
		background: #f9f9f9;
		border-radius: 4px;
	}
	#searchDiv button{
		padding: 10px 6px;
		padding-left: 10px;
		cursor: pointer;
		width: 100%;
		display: block;
		background: none;
		border: none;
		text-align: left;

	}
	#searchDiv button:hover{
		background: #008cff;
		color: #fff;
		border-radius: 4px;
	}

	input::-webkit-outer-spin-button,
      input::-webkit-inner-spin-button {
        display: none;
      }
</style>
<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<h4 class="text-uppercase" style="display:inline-block;">Production Details</h4>
				<hr/>
				<div class="row">
					<div class="col-lg-3">
						<p>Customer Name : <strong>{{$detail->order->customer->customer_name}}</strong></p>
						<p>Label Size : <strong>{{$detail->order->label_size}}</strong></p>
						<p>Material : <strong>{{$detail->order->material_detail->our_product_code}}</strong></p>
						</div>
					<div class="col-lg-3">
						<p>Core Size : <strong>{{$detail->order->core_size}}</strong></p>
						<p>Each Label Size : <strong>{{$detail->order->each_label_qty}}</strong></p>
						<p>Total Qty : <strong>{{$detail->order->quantity}}</strong></p>
					</div>
					<div class="col-lg-3">
						<p>No.of Rolls : <strong>{{$detail->order->rolls}}</strong></p>
						<p>Job Card : <strong>{{$detail->job_card}}</strong></p>
					</div>

				</div>
				<hr/>

				<div class="card">
					<div class="card-body">
						<!-- <form method="POST" action="{{config('app.baseURL')}}/production/order-status/{{$detail->customer_id}}"> -->
						<p  align="right">
							<!-- <button type="submit" class="btn btn-success"><i class="bx bx-check"></i> Mark As Job Done</button>&nbsp;&nbsp;&nbsp;&nbsp; -->
							<button id="addBtn" onclick="callTr()" class="btn btn-primary"><i class="bx bx-plus"></i></button></p>
							<!-- </form> -->
						<div class="table-responsive">
							<table id="example" class="table table-hover table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>Sr No.</th>
										<th>Production Date</th>
										<th>Machine Name</th>
										<th>No. of Rolls</th>
										<th>Operator Name</th>
										<th>Checking Roll</th>
										<th>Ok Roll</th>
										<th>Final Ok Roll</th>
										<th>Total Roll</th>
										<th>Status</th>
										
									</tr>
								</thead>
								<tbody>
									@foreach($data as $key=>$datas)
									<tr>
										<td>{{++$key}}</td>
										<td>{{$datas->pro_date}}</td>
										<td>{{$detail->machine->machine_name}}</td>
										<td>{{$detail->order->rolls}}</td>
										<td><input type="text" value="{{$datas->employee->name}}" class="form-control" @if($datas->is_active==0) readonly @endif></td>
										<td><input type="text" value="{{$datas->check_roll}}" class="form-control" @if($datas->is_active==0) readonly @endif></td>
										<td><input type="text" value="{{$datas->ok_roll}}" class="form-control" @if($datas->is_active==0) readonly @endif ></td>
										<td>{{$datas->final_roll}}</td>
										<td>{{$datas->total_roll}}</td>
										<td>
											@if($datas->status==1)
											<div class="badge rounded-pill text-warning bg-light-warning p-2 text-uppercase px-3"><i class='bx bxs-circle align-middle me-1'></i>Processing</div>
											@else
											<div class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3"><i class='bx bxs-circle align-middle me-1'></i>Production Done</div>
											@endif
										</td>
									</tr>
									@endforeach
								</tbody>
								<tfoot>
									<tr>
										<th>Sr No.</th>
										<th>Production Date</th>
										<th>Machine Name</th>
										<th>No. of Rolls</th>
										<th>Operator Name</th>
										<th>Checking Roll</th>
										<th>Ok Roll</th>
										<th>Final Ok Roll</th>
										<th>Total Roll</th>
										<th>Status</th>
										
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
				
			</div>
		</div>
		<!--end page wrapper -->
		<script type="text/javascript">
			function callTr()
			{
			lengh=$("tbody").find("tr").length + 1;
			data='<tr><td>'+lengh+'</td><td>Automatic Time</td><td>{{$detail->machine->machine_name}}</td><td>{{$detail->order->rolls}}</td><td style="position:relative"><input type="hidden" value="{{$datas->operator_name}}" id="operator_name"><input type="text" autocomplete="off" id="operator_name1" onkeyup="getSearchEmployee(this.value)" class="form-control" value="{{$datas->employee->name}}"><div id="searchDiv"></div></td><td><input type="number" min="0" id="check_roll" value="{{$datas->check_roll}}" class="form-control"></td>										<td><input type="number" min="0" id="ok_roll" value="{{$datas->ok_roll}}" class="form-control"></td><td>{{$datas->final_roll}}</td><td>{{$datas->total_roll}}</td><td><button class="btn btn-success btn-block" id="submitBtn" value="{{$detail->production_id}}" onclick="getCallSave()"><i class="bx bx-check"></i>Save</button>&nbsp;&nbsp;<button class="btn btn-danger btn-block" id="cancelBtn" value="{{$detail->production_id}}" onclick="getCallRemove()">&times;</button></td></tr>';
			$('#example').append(data);	
			$('#addBtn').attr('disabled', 'disabled');

  		$("html, body").animate({ scrollTop: $(document).height() }, 200);
			
			}

			function getCallSave()
			{
				push_token=$("#push").val();
				production_id=$("#submitBtn").val();
				operator_name=$("#operator_name").val();
				check_roll=$("#check_roll").val();
				ok_roll=$("#ok_roll").val();
				if(operator_name.length=="")
				{
					$("#operator_name").focus();
				}
				if(check_roll.length=="")
				{
					$("#check_roll").focus();
				}
				if(ok_roll.length=="")
				{
					$("#ok_roll").focus();
				}
				if(operator_name.length!="" && check_roll.length!="" && ok_roll.length!="")
				{
					$("#submitBtn").attr('disabled','disabled');
					$.ajax({
						url: "{{config('app.baseURL')}}/production/add-data",
						type: 'GET',
						data: {operator_name: operator_name,check_roll:check_roll,ok_roll:ok_roll,production_id:production_id,push_token:push_token},
						success:function(data)
						{
							window.location.reload();
						}
					});
				}
			}

			function getCallRemove()
			{
						$('#addBtn').removeAttr('disabled', 'disabled');
						$("#cancelBtn").parent().parent().remove();				
			}


			function getSearchEmployee(name)
			{
				
					$.ajax({
						url: "{{config('app.baseURL')}}/production/getSearchEmployee",
						type: 'GET',
						data: {name:name},
						success:function(data)
						{
							$("#searchDiv").empty();								
							$.each(data, function(index, val) {
							// console.log(val);
							$("#searchDiv").append('<button value="'+val.name+','+val.id+'" onclick="getName3(this.value)">'+val.name+'</button>');	
							});
						}
					});
				}

			function getName3(val)
			{
				var data = val.split(',');
				$("#operator_name").val(data[1]);												
				$("#operator_name1").val(data[0]);												
				$("#searchDiv").empty();
			}

		</script>
@endsection