@extends('layouts.app')
@section('content')
<style type="text/css">
	.spanIcon{
		color: #fff;
	}
	.uploadPClass{
		width: 45px;
		height: 45px;
		font-weight: bold;
		font-size: 22px;
		background-color: #da251d;
		padding: 10px;
		display: inline-block;
		color: #fff;
		text-transform: uppercase;
		line-height: 24px;
		padding-left: 12px;
		border-radius: 50%;
		margin-left: 8px;
	}
	.uploadSClass{
		width: 45px;
		height: 45px;
		font-weight: bold;
		font-size: 22px;
		background-color: #0093dd;
		padding: 10px;
		display: inline-block;
		color: #fff;
		text-transform: uppercase;
		line-height: 24px;
		padding-left: 12px;
		border-radius: 50%;
		margin-left: 8px;
	}

	.sidebar-wrapper {
		box-shadow: none !important;
	}
	.topbar{
		box-shadow: none !important;
	}
	.back-to-top{
		display: none !important;
	}

	.nameClass,.nameClass1{
		width: 40px;
		height: 40px;
		font-weight: bold;
		font-size: 16px;
		background-color: #da251d;
		padding: 10px;
		color: #fff;
		text-transform: uppercase;
		line-height: 22px;
		padding-left: 13px;
		border-radius: 50%;
		margin-top: 10px;
	}
	.nameClass1{
		background-color: #adbe18 !important;
	}
	.messageClass,.messageClass1{
		background-color: #fff;
		display: inline-block;
		padding: 18px;
		max-width: 50%;
		position: relative;
		word-wrap: break-word;
		border: 1px grey;
		border-radius: 10px 10px 10px 10px;
		box-shadow: 0.5px 0.5px 2px #c2bdbd;
	}

	.messageClass1{
		box-shadow: 0.1px 0.2px 1px #c2bdbd !important;
	}
	.messageClass::before{
		content: "";
		position: absolute;
		width: 10px;
		height: 10px;
		background: #fff;
		left: -4px;
		top: 42%;
		box-shadow: 0.5px 0.5px 2px #c2bdbd;
		transform: rotate(45deg);
		z-index: -1;
	}
	.messageClass::after{
		content: "";
		position: absolute;
		width: 10px;
		height: 10px;
		background: #fff;
		left: -2px;
		top: 42%;
		transform: rotate(45deg);
	}

	.messageClass1::before{
		content: "";
		position: absolute;
		width: 10px;
		height: 10px;
		background: #fff;
		right: -4px;
		top: 42%;
		box-shadow: 0.5px 0.5px 2px #c2bdbd;
		transform: rotate(45deg);
		z-index: -1;
	}
	.messageClass1::after{
		content: "";
		position: absolute;
		width: 10px;
		height: 10px;
		background: #fff;
		right: -2px;
		top: 42%;
		transform: rotate(45deg);
	}


	.hrefClass{
		color: #0093dd;
	}
	.page-wrapper{
		background:linear-gradient(0deg,rgba(30, 57, 7.272),rgba(1.220, 57, 84)), url("{{config('app.baseURL')}}/assets/images/pattern.jpg");
		background-size: inherit;
		background-blend-mode: multiply;
		margin-top: 0px !important;
		margin-bottom: 10px !important;
	}
	.page-content{
		padding-top: 60px;
		padding-bottom: 40px;
		min-height: calc(100vh - 66px);
	}

	.footerTextDiv
	{
		/*background:linear-gradient(0deg,rgba(30, 57, 7.272),rgba(30, 57, 7.272)), url("{{config('app.baseURL')}}/assets/images/pattern.jpg");*/
		/*background-size: inherit;*/
		/*background-blend-mode: multiply;*/
		margin-top: 0px !important;
		position: fixed;
		padding: 10px;
		bottom: 0;
		left: 250px;
		background: #1e3954;
		width: 100%;
		z-index: 9999;
	}
	.wrapper.toggled .footerTextDiv {
		left: 70px;
	}
	.footerTextDiv input{
		height: 45px;
		width: 100%;
		border-radius: 30px;
	}

	@media(max-width: 960px){
		.footerTextDiv{
			left: 0;
		}
		.messageClass,.messageClass1{
			padding: 10px;
		}
		.messageClass{
			margin-left: 30px !important;
		}
		.timeClass{
			margin-left: 30px !important;
		}
	}

	@media(max-width: 600px){
		.footerTextDiv{
			left: 0;
		}
		.messageClass,.messageClass1{
			padding: 10px;
		}
		.messageClass{
			margin-left: 40px !important;
		}
		.timeClass{
			margin-left: 40px !important;
		}
	}


</style>
<!--start page wrapper -->
<div class="page-wrapper">
	<div class="page-content">
				<!-- <h6 class="mb-0 text-uppercase" style="display:inline-block;">All Notifications</h6>
					<hr/> -->
					<div class="page-wrapper1" id="page-wrapper1">
						@foreach($messages as $data)
						@if(Auth::user()->id==$data->user_id)
						<div class="row" style="margin-top:14px;">
							<div class="col-lg-12">
								<div class="" style="display:flex;width: 100%;">

									<div style="width: 95%;text-align: right;">
										<div class="messageClass1"><div style="text-align:left;"><?php echo $data->message;?></div></div>
										<div style="text-align:right;font-size: 12px;margin-top: 2px;margin-right: 2px;color: lightgrey;">{{$data->created_at->format('d-m-Y H:i')}}</div>
									</div>
									<div style="width: 5%;margin-left: 20px;">
										<div class="nameClass1" style="display:inline-block"><?php 
										$data1=explode(" ", $data->user->name);
										foreach($data1 as $val)
										{
											echo substr($val,0,1);
										}
									?></div>
									<span class="spanIcon dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx bx-dots-vertical-rounded"></i></span>

									<ul class="dropdown-menu dropdown-menu-end">
										
										@if($data->message=='<i>This message was deleted</i>')
										<li><a class="dropdown-item" href="javascript:;" onclick="deleteMessage('{{$data->id}}','1')"><i class="bx bx-trash"></i><span>Remove Permanently</span></a>
										</li>
										@else
										<li><a class="dropdown-item" href="javascript:;" onclick="deleteMessage('{{$data->id}}','0')"><i class="bx bx-trash"></i><span>Delete</span></a>
										</li>
										@endif

									</ul>
								</div>
							</div>
						</div>
					</div>
					@else
					<div class="row" style="margin-top:14px;">
						<div class="col-lg-12">
							<div class="" style="display:flex;width: 100%;">
								<div style="width: 4%;">
									<div class="nameClass"><?php 
									$data1=explode(" ", $data->user->name);
									foreach($data1 as $val)
									{
										echo substr($val,0,1);
									}
								?></div>
							</div>
							<div style="width: 95%;">
								<div class="messageClass"><?php echo $data->message;?></div>
								<div class="timeClass" style="text-align:left;font-size: 12px;margin-top: 2px;margin-left: 2px;color: lightgrey;">{{$data->created_at->format('d-m-Y H:i')}}</div>
							</div>
						</div>
					</div>
				</div>
				@endif
				@endforeach

			</div>
			<div>

			</div>
			<div class="footerTextDiv">
				<div style="display:flex;width: 100%;">
					<div style="width:70%">						
						<input type="text" id="search" autocomplete="off" placeholder="Type Message ..." class="form-control" style="padding-left: 20px;" name="">
					</div>
					<div style="width:30%">						
						<div class="uploadPClass" style="cursor:pointer;" onclick="insertImage()"><i class="bx bx-file"></i></div>
						<form id="form" style="display:inline-block" enctype="multipart/form-data">
							@csrf
							<input type="file" hidden id="fileClick" name="image" onchange="showImg4(event)">
							<input type="submit" name="submit" id="submit" hidden>
						</form>
						<div class="uploadSClass" style="cursor:pointer;" onclick="insertData()"><i class="bx bx-send"></i></div>
					</div>
				</div>
			</div>

			<div class="col">

				<!-- Modal -->
				<div class="modal fade" id="exampleVerticallycenteredModal" tabindex="-1" aria-hidden="true" style="z-index: 99999;">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Image Preview</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<div>
									<img id="output3" style="width: 100%;" />
								</div>   
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
								<button type="button" onclick="callToSend()" class="btn btn-primary">Send <i class="bx bx-send"></i></button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function () {
			// $("html, body").animate({ scrollTop: $(document).height() }, 200);
			intervalCall();
		});

		function intervalCall()
		{
			setInterval(function(){
				if(!$("#page-wrapper1").hasClass("active"))
				{
					$(".page-wrapper1").load(location.href+" .page-wrapper1>*","");
					// $("html, body").animate({ scrollTop: $(document).height() }, 200);
					$('html, body').scrollTop( $(document).height() );

				}
			}, 500);
		}

		$("#search").keyup(function(event){
			if($(this).val().length!=0)
			{
				if (event.keyCode === 13) {
					name=$(this).val();
					callAjax(name);
				}
			}
		});

		function callToo(){
			// $("html, body").animate({ scrollTop: $(document).height() });
			$('html, body').scrollTop( $(document).height() );


		}

		$("#page-wrapper1").mouseenter(function(){
			$("#page-wrapper1").addClass('active');
		});
		$("#page-wrapper1").mouseleave(function(){
			$("#page-wrapper1").removeClass('active');
		});

		function insertData()
		{
			var ans=$("#search").val();
			if(ans.length!=0)
			{
				callAjax(ans);
			}
		}

		function callAjax(name)
		{
			$.ajax({
				url: "{{config('app.baseURL')}}/notification/add-message",
				type: 'GET',
				data: {name:name},
				success:function(data)
				{
					if(data==1)
					{
						$("#search").val("");
						$("#search").focus();
						$(".page-wrapper1").load(location.href+" .page-wrapper1>*","");
						callToo();
					}	
				}
			});
		}

		function insertImage()
		{
			$("#fileClick").click();
		}
		function callToSend()
		{
			$("#submit").click();
		}


		function getImage(src)
		{
			alert(src);
		}

		function showImg4(event){
			var output3 = document.getElementById('output3');
			output3.src = URL.createObjectURL(event.target.files[0]);
			output3.onload = function() {
				URL.revokeObjectURL(output3.src)
			}
			$("#exampleVerticallycenteredModal").modal('show');
		}

		function deleteMessage(id,ans)
		{
			$.ajax({
				url: "{{config('app.baseURL')}}/notification/delete-message",
				type: 'GET',
				data: {id:id,ans:ans},
				success:function(data)
				{
					if(data==1)
					{
						$(".page-wrapper1").load(location.href+" .page-wrapper1>*","");
								// callToo();
							}	
						}
					});
		}

		$("#form").on('submit',(function(e) {
			$("#exampleVerticallycenteredModal").modal('hide');			
			$("#submit").attr('disabled','disabled');			
			e.preventDefault();
			$.ajax({
				url: "{{config('app.baseURL')}}/notification/add-image",
				type: "POST",
				data:  new FormData(this),
				contentType: false,
				cache: false,
				processData:false,
				success: function(data)
				{
					$("#submit").removeAttr('disabled','disabled');	
					if(data==1)
					{
						$(".page-wrapper1").load(location.href+" .page-wrapper1>*","");
					}
				}
			});
		}));
	</script>
	@endsection