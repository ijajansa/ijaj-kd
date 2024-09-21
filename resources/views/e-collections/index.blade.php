@extends('layouts.app')
@section('content')
<style>
    table tr td{
        text-align:center;
    }
</style>
<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<div style="width: 100%;display: flex;">
					<div style="width:100%">
					<h6 class="mb-0 text-uppercase" style="display:inline-block;">All Processed Report</h6>					
					</div>
				    <div style="width:50%">
					<p align="right"><a href="{{url('e-processed/export-excel')}}" class="btn btn-warning mb-3 mb-lg-0"><i class='bx bxs-download'></i>Export Excel</a>&nbsp;&nbsp;<a href="{{url('e-processed/export-pdf')}}" class="btn btn-danger mb-3 mb-lg-0"><i class='bx bxs-download'></i>Export PDF</a></p>	
					</div>
				</div>
				<hr/>

				<div class="card">
					<div class="card-body">
						
						<div class="table-responsive table-bordered">
							<table id="example" class="table table-hover table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th rowspan="2" style="text-align:center;align-content: center;">Sr No.</th>
										<th rowspan="2" style="text-align:center;align-content: center;">Date</th>
										<th rowspan="2" style="text-align:center;align-content: center;">E-Waste Collected in MT</th>
										<th colspan="3" style="text-align:center;align-content: center;">Utilization</th>
										<th rowspan="2" style="text-align:center;align-content: center;">% of Utilization</th>
									</tr>
									<tr>
									    <th style="text-align:center;align-content: center;">Recycle</th>
									    <th style="text-align:center;align-content: center;">Reuse</th>
									    <th style="text-align:center;align-content: center;">Total</th>
									</tr>
								</thead>
								<tbody>
								    @foreach($data as $key=>$record)
                                     <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{$record->added_date}}</td>
                                        <td>{{$record->total_collection}}</td>
                                        <td>{{$record->category=='recycle' ? $record->weight : 0}}</td>
                                        <td>{{$record->category=='reuse' ? $record->weight : 0}}</td>
                                        <td>{{$record->weight}}</td>
                                        <td>{{number_format(($record->weight/$record->total_collection) * 100,2)}}%</td>
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