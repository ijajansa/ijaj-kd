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
					<hr/>

					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-lg-3">
									<label>From Date :</label>
									<input type="date" id="from_date" onchange="getFirstDate()" class="form-control" style="width: 100%;display: inline-block;">	
								</div>
								<div class="col-lg-3">
									<label>To Date :</label>
									<input type="date" id="date" onchange="getFirstDate()" class="form-control" style="width: 100%;display: inline-block;">	
								</div>
								<div class="col-lg-3">
									<label>QRCode ID</label>
									<input type="text" onkeyup="getFirstDate()" id="barcode_id" class="form-control" placeholder="QRCode ID" style="width: 100%;display: inline-block;">
								</div>
							    <div class="col-lg-3">
							    	<label>Inspector Name/ Mobile Number</label>
									<input type="text" id="name" onkeyup="getFirstDate()" class="form-control" placeholder="Inspector Name/ Mobile Number" style="width: 100%;display: inline-block;">
							    </div>
							    <div class="col-lg-3" style="margin-top: 20px;">
							    	<label>Ward Name</label>
									<input type="text" id="ward" onkeyup="getFirstDate()" class="form-control" placeholder="Ward Name" style="width: 100%;display: inline-block;">
							    </div>

							    <div class="col-lg-3" style="margin-top: 20px;">
							    	<label>Hajeri Shed</label>
									<input type="text" id="shed" onkeyup="getFirstDate()" class="form-control" placeholder="Hajeri Shed" style="width: 100%;display: inline-block;">
							    </div>

							    <div class="col-lg-3" style="margin-top: 20px;">
							    	<label>Area Name</label>
									<input type="text" id="area" onkeyup="getFirstDate()" class="form-control" placeholder="Area Name" style="width: 100%;display: inline-block;">
							    </div>
							</div>
							    <hr>
							
							<div class="">
								<table id="example" class="table table-hover table-striped table-bordered table-responsive" style="">
									<thead>
										<tr>
											<th style="width:20px !important;">Sr. No</th>
											<th>Incharge Person</th>
											<!-- <th>QRCode ID</th> -->
											<th>Area Name</th>
											<!-- <th>Section1 Before Work Image</th>
											<th>Section1 After Work Image</th>
											<th>Section1 Before Work Latlng</th>
											<th>Section1 After Work Latlng</th> -->
											<th>Created Date</th>
											<th>Action</th>
										</tr>
									</thead>
									
								</table>
							</div>
						</div>
					</div>

				</div>
			</div>

			 <script type="text/javascript">
                    
                    function getFirstDate()
			 		{
			 			$("#example").DataTable().clear().destroy();
			 			callAjax();
			 		}

			        $(document).ready(function(){
			        	callAjax();		        
			        });


			        function callAjax(){
                        from_date=$("#from_date").val();
			        	date=$("#date").val();
			        	barcode_id=$("#barcode_id").val();
			        	name=$("#name").val();
			        	ward=$("#ward").val();
			        	shed=$("#shed").val();
			        	area=$("#area").val();

			        	$("#example").dataTable({
			            "processing": true,
			            "serverSide": true,
			            "responsive": true,
			            ajax:"{{config('app.baseURL')}}/report/allData?from_date="+from_date+"&to_date="+date+"&barcode_id="+barcode_id+"&name="+name+"&ward="+ward+"&shed="+shed+"&area="+area,
			            "order":[
			            [0,"asc"]
			            ],
			            "columns":[
			            {
			              "mData":"sr"
			            },{
			              "mData":"user.name"
			            },
			            // {
			            //   "mData":"barcode_id"
			            // }, 
			            {
			                "mData":"barcode.address"
			               },
			            // },
			            // {
			            //     "targets":-1,
			            //     "mData": "id",
			            //     "bSortable": false,
			            //     "ilter":false,
			            //     "mRender": function(data, type, row){
			            //             return '<a target="_blank" href="{{config("app.baseURL")}}/storage/app/'+row.after_work+'">'+row.after_work+'</a>';
			            //     },
			                
			            // },
			            // {
			            //   "mData":"before_latlng"
			            // },
			            // {
			            //   "mData":"after_latlng"
			            // },
			             {
			              "mData":"enquiry"
			            },

			            {
			                "targets":-1,
			                "mData": "id",
			                "bSortable": false,
			                "ilter":false,
			                "mRender": function(data, type, row){
			                        return '<a href="{{config("app.baseURL")}}/report/view/'+row.id+'"> <button class="btn btn-primary" style="font-size: 14px;"><i style="font-size:18px;" class="bx bxs-edit"></i> View Details</button></a>';
			                },
			                
			            }

			           
			            ]

			          });
			        }



			        function callExportButton()
			        {
			            from_date=$("#from_date").val();
			        	date=$("#date").val();
			        	barcode_id=$("#barcode_id").val();
			        	name=$("#name").val();
			        	window.location.href="{{config('app.baseURL')}}/report/export-excel?from_date="+from_date+"&to_date="+date+"&barcode_id="+barcode_id+"&name="+name+"&ward="+ward+"&shed="+shed+"&area="+area;
			        }
			      </script>
			<!--end page wrapper -->
			@endsection