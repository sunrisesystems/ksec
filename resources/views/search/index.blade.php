@extends('layout.admin')
@section('content')

<script type="text/javascript">
	function validateSearch()
    {
        $("#error_alert").html("");
		var keyword = $("#keyword").val();
		
		if(keyword == "")
		{
			$("#error_alert").html("<?php echo Lang::get('messages.search_keyword_req');?>");
			return false;
		}
		return true;
	}
	$(function(){

		if($("#keyword").val() != "")
		{
			var $slidedown = $('.searchForm');
			$slidedown.slideDown();
			//$('.close-filter').fadeIn('slowly');
		}  
	});
</script>
<!-- Container Start -->
<div id="main-container" class="main-container">
	<div class="breadcrumb-wrapper container-fluid white-bg">
		<div class="row">
			<div class="col-lg-10 col-md-10">
				<ol class="breadcrumb">
					<li>
						Product
					</li>
					<li class="active">
						<strong>Search</strong>
					</li>				
				</ol>
			</div>
			<!-- <div class="col-lg-2 col-md-2 align-right">
				<a title="Close Filter" class="close-filter" style="display:none;" href="javascript:void(0)">
					<span class="label label-default"><i class="glyphicon glyphicon-remove"></i> Close</span>
				</a>
			</div> -->
		</div>
	</div>
	<div class="searchForm " style="display:block;">
		<div class="container-fluid">
		<div class="form-container">
		{!! Form::open(array('url' => 'search','method'=>'GET','onSubmit' => 'return validateSearch()')) !!}
		<div class="form-control-wrapper">
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4"> 						
						{!! HTML::decode(Form::label('keyword', 'Search Keyword <small class="mandatory">*</small>')) !!}
						{!! Form::text('keyword',Request::get('keyword'),array("placeholder"=>"Product, Category, Offers etc",'id'=>'keyword','class'=>'form-control')) !!}
					</div>	
				</div>
			</div>	
			<div id="error_alert" class="error validationAlert validationError"></div>	

			<!-- action wrapper -->
			<div class="form-group action">
				<div class="col-lg-12 pull-center buttons"> 
					{!! Form::submit('Search', array('class' => 'btn btn-red')) !!}
				</div>									
			</div><!-- action end -->
		</div><!-- Form control wrapper end -->
		{!! Form::close() !!}
		</div>
		</div>
	</div><!-- Search Form end -->
	@if(!empty(Request::get('keyword')))
	<div class="pageHeading container-fluid" style="display:block">
		<div class="row ">			
			<div class="page-title-wrapper">			
				<div class="col-lg-8">
					<h2 class="page-header">Search Result</h2>					
				</div>			
			</div>			
		</div>
	</div><!-- pageHeading end -->
	
	<div class="main-container-inner container-fluid">			
		@if(Session::has('message'))
		<div class="{!! Session::get('class') !!}" id="message">
			<div class="row pageHeading">
				<div class="col-xs-12">
					{!! Session::get('message') !!}
				</div>
			</div>
		</div>
		@endif
		<div class="row">
			<div class="col-xs-12">
				@if(count($employees->getListDTO()))
				<div class="table-responsive">
					<table id="drawingList" class="category table table-hover">
						<thead>
							<tr>
								<th class="center">#</th>
								<th class="center">System ID</th>
								<th class="center">Emp Code</th>  
								<th class="center">Name</th> 
								<th class="center">Allow Login</th>
								<th class="center">Emp Type</th>
								<th class="center">Department</th>
								<th class="center">Status</th>
								<th class="center">Actions</th>
							</tr>
						</thead>
					  <?php $count = ($employees->getCount() * Config::get('global_vars.PAGINATION_LIMIT')) - Config::get('global_vars.PAGINATION_LIMIT') + 1;
					 	?>
						<tbody>
							@foreach($employees->getListDTO() as $key)
							<tr>
								<td align="center">{!! $count++ !!}</td>
								<td align="center">{!! $key->getSystemId() !!}</td>
								<td align="center">{!! $key->getEmpCode() !!}</td>
								<td align="center">{!! $key->getName() !!}</td>
								@if($key->getAllowLogin() == 'Y')
								<td align="center">Yes</td>
								@else
								<td align="center">No</td>
								@endif
								<td align="center">{!! $data['empType'][$key->getEmpType()]!!}</td>
								<td align="center">{!! $data['department'][$key->getDepartment()]!!}</td>
								<td align="center" class="status">
									@if($key->getStatus() == 'A')
									<span class="label-status label-warning-active">active</span>
									@else
									<span class="label-status label-warning-inactive">inactive</span>
									@endif
								</td>
								<td align="center" class="action-icon">								
									<a href="{!! route('employees.edit',[$key->getId()]) !!}" data-toggle="tooltip" data-placement="bottom" title="Edit Employee" class="edit-user">
										<i class="glyphicon glyphicon-pencil"></i> 
									</a>
									<!-- <a href="{!! URL::to('employees/reset-password/'.$key->getId()) !!}" data-toggle="tooltip" data-placement="bottom" title="Reset Password" class="resetPass">
										<i class="glyphicon glyphicon-lock"></i> 
									</a> -->
								</td>
								
							</tr>
							@endforeach
						</tbody>
				  </table><!-- table end -->
				  {!! $employees->getLinks() !!}
				</div><!-- table responsive end -->
				@else
					<div class="alert alert-info">No Record Found</div>
				@endif
			</div>
		</div>
	</div>
	@endif
	<!-- main-container-inner end -->
</div><!-- container end -->	
<script>
    $("#message").fadeOut(5000);
</script>
@stop