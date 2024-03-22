@extends('layouts.app')
@section('content')
<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<h6 class="mb-0 text-uppercase" style="display:inline-block;">All Products</h6>
				<hr/>

				<div class="card">
					<div class="card-body">
						<!-- <p  align="right">
							<button type="submit" id="submitBtn" onclick="checkFirst()" class="btn btn-success"><i class="bx bx-plus"></i> Add New Type</button></p> -->
						<div class="table-responsive">
							<table id="example" class="table table-hover table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>Sr No.</th>
										<th>Product Type</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($data as $key=>$order)
									<tr>
										<td>{{++$key}}</td>
										<td>{{$order->name}}</td>	
										<td>
											<a href="{{config('app.baseURL')}}/stock/all-data/{{$order->id}}"><button type="button" class="btn btn-primary">View Product List</button></a>
										</td>
									</tr>
									@endforeach
								</tbody>
								<tfoot>
									<tr>
										<th>Sr No.</th>
										<th>Product Type</th>
										<th>Action</th>
									</tr>
								</tfoot>
							</table>
							<?php 
							// echo $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST']."".$_SERVER['REQUEST_URI']."<br>";

							// echo config('app.baseURL')."/notification";
							//  ?>
						</div>
					</div>
				</div>
				
			</div>
		</div>
@endsection