@extends('layouts.app')
@section('content')
<style type="text/css">
	#example_filter{
		display: none;
	}
</style>
<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<div style="width: 100%;display: flex;">
					<div style="width:50%">
					<h6 class="mb-0 text-uppercase" style="display:inline-block;">All Barcode</h6>					
					</div>
					<div style="width:50%">
					<p align="right"><a href="{{config('app.baseURL')}}/barcode/add" class="btn btn-primary mb-lg-0"><i class='bx bxs-plus-square'></i>New Barcode</a></p>	
					</div>
				</div>
				<hr/>

				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-hover table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>Sr No.</th>
										<th>Address</th>
										<th>Description</th>
										<th>Barcode</th>
										<th>Print</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@php
									$generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
									@endphp
									@foreach($data as $key=>$datas)
									<tr>
										<td>{{++$key}}</td>
										<td>{{$datas->address}}</td>
										<td>{{$datas->details}}</td>
										<td>
											<?php $ans="Id :".$datas->id."\nAddress :".$datas->address."";?>
											<img src="data:image/png;base64,{{ base64_encode($generatorPNG->getBarcode($ans, $generatorPNG::TYPE_CODE_128)) }}" style="height: 48px;width: 200px;">

										</td>
										<td>
											<div class="d-flex order-actions">
												<form method="POST" action="{{config('app.baseURL')}}/barcode/print/{{$datas->id}}/{{$datas->address}}">
												@csrf
												<button type="submit" class="btn btn-primary btn-sm px-4">Print</button>
												</form>
											</div>
										</td>
										<td>
											<div class="d-flex order-actions">
									
												<a href="{{config('app.baseURL')}}/barcode/delete/{{$datas->id}}" class="ms-3"><i class='bx bxs-trash text-danger'></i></a>
												
											</div>
										</td>
									</tr>
									@endforeach
								</tbody>
								
							</table>
						</div>
					</div>
				</div>
				
			</div>
		</div>
		<!--end page wrapper -->
		
@endsection