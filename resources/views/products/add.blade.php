@extends('layouts.app')
@section('content')
	<!--plugins-->
    <link href="{{config('app.baseURL')}}/assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
    <link href="{{config('app.baseURL')}}/assets/plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />
	<script type="text/javascript">
		function blockSpecialChar(e) {
			var k = e.keyCode;
			return (
				(k >= 65 && k <= 90) ||  // A-Z
				(k >= 97 && k <= 122) || // a-z
				k === 8 ||               // Backspace
				k === 32                 // Space
			);
		}
	</script>
<!--start page wrapper -->
<div class="page-wrapper">
	<div class="page-content">

		<div class="row">
			<div class="col-xl-6">
				<div class="card border-top border-0 border-4 border-primary">
					<div class="card-body p-5">
						<div class="card-title d-flex align-items-center">
							<div><i class="bx bx-plus me-1 font-22 text-primary"></i>
							</div>
							<h5 class="mb-0 text-primary" style="font-weight: bold;">Add Waste Product</h5>
						</div>
						<hr>
						<form class="row g-3" method="POST" action="{{route('products.store')}}">
							@csrf
							<div class="col-md-12">
								<label for="inputFirstName2" class="form-label">Name</label>
								<input type="text" name="name"  class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" placeholder="eg. TV, Monitor"  onkeypress="return blockSpecialChar(event)">
								@error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
							</div>
							<div class="col-md-12">
								<label for="inputFirstName2" class="form-label">Select Type</label>
								<select class="form-control form-select @error('type') is-invalid @enderror" name="type">
									@foreach($categories as $category)
									<option value="{{$category->id}}" @if(old('type')==$category->id) selected @endif>{{$category->name ?? ''}}</option>
									@endforeach
								</select>
								@error('type')
                                	<span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
							</div>

							
							<div class="col-12">
								<button type="submit" class="btn btn-primary px-5">Add</button>
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

@endsection