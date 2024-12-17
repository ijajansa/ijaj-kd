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
					<div style="display:flex;width: 100%;">
						<div style="width: 50%;">
							<h6 class="mb-0 text-uppercase" style="display:inline-block;">All Reports</h6>				
						</div>
						<div style="width: 50%;">
							<p align="right" style="margin:0;padding: 0;"><a onclick="callExportButton()" class="btn btn-primary mb-3 mb-lg-0"><i class='bx bxs-spreadsheet'></i>Export As Excel</a></p>		
						</div>
					</div>

					<div class="card mt-2">
						<div class="card-body">
							<div class="row">
								<div class="col-lg-2">
									<label>From Date :</label>
									<input type="date" id="from_date" onchange="getFirstDate()" class="form-control" style="width: 100%;display: inline-block;" value="{{app('request')->input('from_date') }}">	
								</div>
								<div class="col-lg-2">
									<label>To Date :</label>
									<input type="date" id="date" onchange="getFirstDate()" class="form-control" style="width: 100%;display: inline-block;" value="{{app('request')->input('to_date') }}">	
								</div>
								<div class="col-lg-2">
									<label>QRCode ID</label>
									<input type="text" onchange="getFirstDate()" id="barcode_id" class="form-control" placeholder="QRCode ID" style="width: 100%;display: inline-block;" value="{{app('request')->input('barcode_id') }}">
								</div>
							    <div class="col-lg-3">
							    	<label>Supervisor Name/ Mobile Number</label>
									<input type="text" id="name" onchange="getFirstDate()" class="form-control" placeholder="Supervisor Name/ Mobile Number" style="width: 100%;display: inline-block;" value="{{app('request')->input('name') }}">
							    </div>
							    {{-- <div class="col-lg-2" style="margin-top: 20px;">
							    	<label>Ward Number</label>
									<input type="text" id="ward" onkeyup="getFirstDate()" class="form-control" placeholder="Ward Number" style="width: 100%;display: inline-block;" value="{{app('request')->input('ward') }}">
							    </div> --}}

							    <div class="col-lg-3">
							    	<label>Area Name</label>
									<input type="text" id="area" onchange="getFirstDate()" class="form-control" placeholder="Area Name" style="width: 100%;display: inline-block;" value="{{app('request')->input('area') }}">
							    </div>
								<div class="col-lg-3" style="margin-top: 15px;">
							    	<label>Select Category :</label>
									<select name="category_id" onchange="getFirstDate()" id="category_id" class="form-control form-select">
										<option value="">Select</option>
										@foreach($categories as $category)
										<option value="{{$category->id}}" {{app('request')->input('category_id') == $category->id ? 'selected':'' }}>{{$category->name}}</option>
										@endforeach
									</select>
							    </div>

								<div class="col-lg-12" style="margin-top: 20px;">
									<button type="button" class="btn btn-primary" onclick="getFirstDate()">Apply Filter</button>
							    </div>
							</div>
							    <hr>
							
							<div class="">
								<table id="example" class="table table-hover table-striped table-bordered table-responsive" style="">
									<thead>
										<tr>
											<th style="width:20px !important;">Sr. No</th>
											<th>Supervisor</th>
											<th>Area Name</th>
											<th>Category</th>
											<th>Created Date</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										@foreach($data as $key=>$value)
										<tr>
											<td>{{++$key}}</td>
											<td>{{$value?->user?->name??''}}</td>
											<td>{{$value?->barcode?->address??''}}</td>
											<td>
												<div class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>{{$value?->category?->name??''}}</div>
											</td>
											<td>{{$value?->created_at->format('d-m-Y h:i A')??''}}</td>
											<td><a href="{{config('app.baseURL')}}/report/view/{{$value->id}}"><button class="btn btn-primary" style="font-size: 14px;"><i style="font-size:18px;" class="bx bxs-edit"></i> View Details</button></a></td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>

				</div>
			</div>

			 <script type="text/javascript">
                    
                    function getFirstDate()
			 		{

                        from_date=$("#from_date").val();
			        	date=$("#date").val();
			        	barcode_id=$("#barcode_id").val();
			        	category_id=$("#category_id").val();
			        	name=$("#name").val();
			        	ward=$("#ward").val() ?? '';
			        	area=$("#area").val();

			        	window.location.href="{{config('app.baseURL')}}/report/all?from_date="+from_date+"&to_date="+date+"&barcode_id="+barcode_id+"&name="+name+"&ward="+ward+"&area="+area+"&category_id="+category_id;
			 		}


			        function callExportButton()
			        {
			            from_date=$("#from_date").val();
			        	date=$("#date").val();
			        	barcode_id=$("#barcode_id").val();
			        	category_id=$("#category_id").val();
			        	name=$("#name").val();

			        	ward=$("#ward").val() ?? '';
			        	shed=$("#shed").val();
			        	area=$("#area").val();
			        	
			        	window.location.href="{{config('app.baseURL')}}/report/export-excel?from_date="+from_date+"&to_date="+date+"&barcode_id="+barcode_id+"&name="+name+"&ward="+ward+"&shed="+shed+"&area="+area+"&category_id="+category_id;
			        }
			      </script>
			<!--end page wrapper -->
			@endsection