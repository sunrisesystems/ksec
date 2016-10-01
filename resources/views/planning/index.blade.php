@extends('layout.admin')
@section('content')
<?php use Sunpet\Libraries\Lib; ?>
<script type="text/javascript">
	function validateSearch()
    {
        $("#error_alert").html("");
		var machine = $("#machine").val();
		var product = $("#product").val();
		var status = $("#status").val();
		var startDate = $("#startDate").val();
		var endDate = $("#endDate").val();
		if(product == "" && status == "" && machine == "" && startDate == "" && endDate == "")
		{
			$("#error_alert").html("<?php echo Lang::get('messages.search_req');?>");
			return false;
		}else if(startDate != "" && endDate != "") {
			if(compareTwoDates(startDate,endDate))
			{
				return true;
			}else{
				$("#error_alert").html("<?php echo Lang::get('messages.start_date_error');?>");
				return false;
			}
		}
		return true;
	}
</script>
<!-- Container Start -->
<div id="main-container" class="main-container">
	<div class="breadcrumb-wrapper container-fluid white-bg">
		<div class="row">
			<div class="col-lg-10 col-md-10">
				<ol class="breadcrumb">
					<li>
						Production
					</li>
					<li>
						Transactions
					</li>
					<li class="active">
						<strong>Manage Planning</strong>
					</li>				
				</ol>
			</div>
			<div class="col-lg-2 col-md-2 align-right">
				<a title="Close Filter" class="close-filter" style="display:none;" href="javascript:void(0)">
					<span class="label label-default"><i class="glyphicon glyphicon-remove"></i> Close</span>
				</a>
			</div>
		</div>
	</div>
	<div class="searchForm " style="display:none;">
		<div class="container-fluid">
		<div class="form-container">
			{!! Form::open(array('url' => 'planning/','method'=>'GET','onSubmit' => 'return validateSearch()')) !!}
		<div class="form-control-wrapper">
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4"> 						
						{!! HTML::decode( Form::label('machine', 'Machine <small class="mandatory">*</small>')) !!}
						{!! Form::select('machine',$data['machine'],Request::get('machine'),['id'=>'machine','class'=>'form-control']) !!}
					</div>	
					<div class="col-sm-4">											
						{!! HTML::decode(Form::label('product', 'Product <small class="mandatory">*</small>')) !!}
						{!! Form::select('product',$data['product'],Request::get('product'),['id'=>'product','class'=>'form-control']) !!}
					</div>
					<div class="col-sm-4">											
						{!! HTML::decode(Form::label('status', 'Status <small class="mandatory">*</small>')) !!}
						{!! Form::select('status', $data['status'], Request::get('status'), ['id'=>'status','class'=>'form-control']) !!}
					</div>
					
				</div>
			</div>	
			<div class="form-group">
				<div class="row">	
					<div class="col-sm-4"> 						
						{!! HTML::decode(Form::label('start_date', 'Start Date <small class="mandatory">*</small>'))!!}
						{!! Form::text('startDate',Request::get('startDate'),array('placeholder'=>'Start Date','id'=>'startDate','class'=>'form-control','readonly'=>true)) !!}
					</div>
					<div class="col-sm-4"> 						
						{!! HTML::decode(Form::label('end_date', 'End Date <small class="mandatory">*</small>'))!!}
						{!! Form::text('endDate',Request::get('endDate'),array('placeholder'=>'End Date','id'=>'endDate','class'=>'form-control','readonly'=>true)) !!}
					</div>
				</div>
			</div>	 	
			<div id="error_alert" class="error validationAlert validationError"></div>	

			<!-- action wrapper -->
			<div class="form-group action">
				<div class="col-lg-12 pull-center buttons"> 
					{!! Form::submit('Search', array('class' => 'btn btn-red')) !!}			
					<button type="button" class="btn btn-black" onclick="doCancel('{!! URL::to('planning') !!}')">Cancel</button>
				</div>									
			</div><!-- action end -->
		</div><!-- Form control wrapper end -->
		{!! Form::close() !!}
		</div>
		</div>
	</div><!-- Search Form end -->
	<div class="pageHeading container-fluid">
		<div class="row ">			
			<div class="page-title-wrapper">			
				<div class="col-lg-8">
					<h2 class="page-header">Manage Planning</h2>					
				</div>
				<div class="col-lg-4">
					<div class="title-action">
						<a title="Add User" class="btn btn-white add-planning" href="{!! URL::to('planning/create') !!}">
							<i class="glyphicon glyphicon-plus"></i> Add Planning
						</a>
						<a title="Search Filter" class="btn btn-white search-filter" href="javascript:void(0)">
							<i class="glyphicon glyphicon-filter"></i> Search
						</a>
					</div>
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
				@if(count($plannings))			
				<div class="table-responsive">
					<table id="drawingList" class="category table table-hover">
						<thead>
							<tr>
								<th class="right">#</th>
								<th class="left">Machine</th>
								<th class="left">Inhouse Serial No</th>
								<th class="left">Product</th>  
								<th class="right">Start time</th> 
								<th class="right">End time</th>
								<th class="right">Quantity</th>
								<th class="center">Status</th>
								<th class="center">Actions</th>
							</tr>
						</thead>
					 <?php $count = ($plannings->currentPage() * Config::get('global_vars.PAGINATION_LIMIT')) - Config::get('global_vars.PAGINATION_LIMIT') + 1;
					  ?>
						<tbody>
						@foreach($plannings as $key)
							<tr>
								<td align="right">{!! $count++ !!}</td>
								<td>{!! $data['machine'][$key->machine_id]!!}</td>
								<td>{!! $key->inhouse_serial_no !!}</td>
								<td>{!! $data['product'][$key->product_id]!!}</td>
								<td align="right">{!! Lib::convertDateFormat("Y-m-d H:i:s",$key->start_date_time,"d-m-Y H:i") !!}</td>
								<td align="right">{!! Lib::convertDateFormat("Y-m-d H:i:s",$key->end_date_time,"d-m-Y H:i") !!}</td>
								<td align="right">{!! $key->planning_quantity !!}</td>
								<td align="center" class="status">
									@if($key->status == 'P')
									<span class="label-status label-warning-active">planned</span>
									@elseif($key->status == 'C')
									<span class="label-status label-warning-inactive">closed</span>
									@elseif($key->status == 'R')
									<span class="label-status label-warning-running">running</span>
									@elseif($key->status == 'CN')
									<span class="label-status label-warning-inactive">cancelled</span>
									@elseif($key->status == 'SC')
									<span class="label-status label-warning-inactive">short closed</span>
									@endif
								</td>
								<td align="center" class="action-icon">		
									@if($key->status == 'P' || $key->status == 'R' || $key->status == 'SC')						
									<a href="{!!URL::to('planning/edit/'.$key->id)!!}" data-toggle="tooltip" data-placement="bottom" title="Edit Plan" class="edit-user">
										<i class="glyphicon glyphicon-pencil"></i> 
									</a>
									@else
									-
									@endif
								</td>
								
							</tr>
							@endforeach						
						</tbody>
				  </table><!-- table end -->
				 {!! $plannings->appends(Request::except('page'))->render() !!}

				</div><!-- table responsive end -->
				@else
					<div class="alert alert-info">No Record Found</div>
				@endif			
										
			</div>
		</div>
	</div><!-- main-container-inner end -->
</div><!-- container end -->	
<script>
$(function(){
	if($("#machine").val() != "" || $("#status").val() != "" || $("#product").val() != "" || $("#startDate").val() != "" || $("#endDate").val() != "")
	{
		var $slidedown = $('.searchForm');
		$slidedown.slideDown();
	}  
});
$(document).ready(function() {
	$('#startDate').datetimepicker({
    	format:'d-m-Y',
  		formatDate:'d-m-Y',
  		timepicker:false,
  	/*	theme:'dark',*/
  		onSelectTime:function(dp,$input){
  			$("#date").datetimepicker('hide');
  		}, 
    });
    $('#endDate').datetimepicker({
    	format:'d-m-Y',
  		formatDate:'d-m-Y',
  		timepicker:false,
  	/*	theme:'dark',*/
  		onSelectTime:function(dp,$input){
  			$("#date").datetimepicker('hide');
  		}, 
    });
})
</script>
@stop