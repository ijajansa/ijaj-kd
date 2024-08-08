@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.min.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.jquery.min.js"></script>


<!--start page wrapper -->
<div class="page-wrapper">
	<div class="page-content">

		<div class="row">
			<div class="col-xl-8">
				<div class="card border-top border-0 border-4 border-primary">
					<div class="card-body p-5">
						<div class="card-title d-flex align-items-center">
							<div><i class="bx bx-plus me-1 font-22 text-primary"></i>
							</div>
							<h5 class="mb-0 text-primary">Generate QR Code</h5>
						</div>
						<hr>
					<form class="row g-3" method="POST" action="{{config('app.baseURL')}}/barcode/add">
					@csrf
						<div class="row g-3">
							<div class="col-md-6">
								<label for="inputFirstName2" class="form-label">Select Ward <span class="text-danger" style="font-weight: bold;">*</span></label>
								<select class="form-control form-select" id="ward_id" name="ward_id" required>
									<option value="">Select</option>
									@foreach($wards as $ward)
									<option value="{{$ward->id}}">{{$ward->name}}</option>
									@endforeach
								</select>
							</div>
							<div class="col-md-6">
							</div>
							 <div class="col-md-12">
								<label for="inputFirstName2" class="form-label">Select Category <span class="text-danger" style="font-weight: bold;">*</span></label>
								<select class="form-control form-select" id="category_id" name="category_id[]" onchange="getFields(0,this.value)" required>
									<option value="">Select</option>
									@foreach($categories as $category)
									<option value="{{$category->name}}">{{$category->name}}</option>
									@endforeach
								</select>
							</div>
						</div>
							<div id="loadContent">

							</div>
								<div class="col-lg-12">
									<button type="submit" class="btn btn-primary px-5">Generate QR Code</button>
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

<script type="text/javascript">
	var number= 1;
	function addNewCategoryRow()
	{
		data = '<div class="row" style="padding:5px 0"><div class="col-md-12">\
								<label for="inputFirstName2" class="form-label">Select Category <span class="text-danger" style="font-weight: bold;">*</span></label>\
								<select class="form-control form-select" id="category_id" name="category_id[]" onchange=getFields('+number+',this.value) required>\
									<option value="">Select</option>\
									@foreach($categories as $category)\
									<option value="{{$category->name}}">{{$category->name}}</option>\
									@endforeach\
								</select>\
							</div></div><div id="mainCont'+number+'"></div>';
		$("#loadContent").append(data);
		number++;
	}

	function getFields(number,value)
	{
		if (value) {
		var categoryName2 = value;
        // You can now use both the category ID and name in your function
    }
		data = '<div class="row" style="padding:5px 0"><div class="col-md-5">\
			<label for="inputFirstName2" class="form-label">'+categoryName2+' Name <span class="text-danger" style="font-weight: bold;">*</span></label>\
								<input type="text" name="name[]" class="form-control" id="inputFirstName2" required>\
							</div>\
							<div class="col-md-5">\
								<label for="inputFirstName2" class="form-label">Address <span class="text-danger" style="font-weight: bold;">*</span></label>\
								<input type="text" name="address[]" class="form-control" id="inputFirstName2" required>\
							</div>\
							<div class="col-md-2">\
								<label for="" style="opacity: 0;display:block"  class="form-label">button</label>\
								<button type="button" class="btn btn-primary" style="width:100%" onclick="addNewCategoryRow()"><i class="bx bx-plus"></i>New</button>\
							</div></div>';
		if(number==0)
		$("#loadContent").html(data);
		else					
		$("#mainCont"+number).html(data);
	
	}

	function getWards(id)
	{
		if(id.length!=0)
		{
			$.ajax({
				url:"{{config('app.baseURL')}}/barcode/getWards",
				type:'GET',
				data:{id:id},
				success:function(data)
				{
					$("#ward_id").html(data);
				}
			});
		}
	}
</script>

@endsection