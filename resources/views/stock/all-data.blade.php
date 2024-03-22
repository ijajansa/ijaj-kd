@extends('layouts.app')
@section('content')
<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<h6 class="mb-0 text-uppercase" style="display:inline-block;">All @if($product_type==2) Ribbon @elseif($product_type==3) Scanner @elseif($product_type==4) Printer @else Label @endif</h6>
				<hr/>

				<div class="card">
					<div class="card-body">
						<p  align="right">
							<a href="{{config('app.baseURL')}}/stock/add/{{$product_type}}"><button type="button" id="submitBtn" class="btn btn-success"><i class="bx bx-plus"></i> Add New  @if($product_type==2) Ribbon @elseif($product_type==3) Scanner @elseif($product_type==4) Printer @else Label @endif</button></a></p>
						<div class="table-responsive">
							<table id="example" class="table table-hover table-striped table-bordered" style="width:100%">
								@if($product_type==3)
								<thead>
									<tr>
										<th>Sr No.</th>
										<th>Product</th>
										<th>Brand</th>
										<th>Model</th>
										<th>Barcode Type</th>
										<th>Quantity</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($values as $key=>$order)
									<tr>
										<td>{{++$key}}</td>
										<td>{{$order->product->name}}</td>	
										<td>{{$order->brand}}</td>	
										<td>{{$order->model}}</td>	
										<td>{{$order->barcode_type}}</td>
										<td>{{$order->quantity}}</td>
										<td><button class="btn btn-primary">Edit</button></td>
									</tr>
									@endforeach
								</tbody>

								@elseif($product_type==4)
								<thead>
									<tr>
										<th>Sr No.</th>
										<th>Product</th>
										<th>Brand</th>
										<th>Model</th>
										<th>Resolution</th>
										<th>Quantity</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($values as $key=>$order)
									<tr>
										<td>{{++$key}}</td>
										<td>{{$order->product->name}}</td>	
										<td>{{$order->brand}}</td>	
										<td>{{$order->model}}</td>	
										<td>{{$order->resolution}}</td>	
										<td>{{$order->quantity}}</td>
										<td><button class="btn btn-primary">Edit</button></td>

									</tr>
									@endforeach
								</tbody>

								@elseif($product_type==2)
								<thead>
									<tr>
										<th>Sr No.</th>
										<th>Product</th>
										<th>Size</th>
										<th>Grade</th>
										<th>Our Product Code</th>
										<th>Ink</th>
										<th>Core</th>
										<th>Quantity</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($values as $key=>$order)
									<tr>
										<td>{{++$key}}</td>
										<td>{{$order->product->name}}</td>	
										<td>{{$order->label_size1}} {{$order->label_type1}} X {{$order->label_size2}} {{$order->label_type2}}</td>	
										<td>{{$order->grade}}</td>	
										<td>{{$order->our_product_code}}</td>	
										<td>{{$order->ink}}</td>	
										<td>{{$order->core}}</td>	
										<td>{{$order->quantity}}</td>	
										<td><button class="btn btn-primary">Edit</button></td>

									</tr>
									@endforeach
								</tbody>
								@endif
							</table>
						</div>
					</div>
				</div>
				
			</div>
		</div>
@endsection