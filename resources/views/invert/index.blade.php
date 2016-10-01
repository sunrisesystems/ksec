@extends('layout.admin')
@section('content')
<script type="text/javascript">
	$(document).ready(function() {
		$('#date').datetimepicker({
	    	format:'d-m-Y',
	  		formatDate:'d-m-Y',
	  		//mask: true,
	  		//minDate : '-02-01-1970',
	  		maxDate : 0,
	  		timepicker:false,
	  	/*	theme:'dark',*/
	  		onSelectTime:function(dp,$input){
	  			$("#date").datetimepicker('hide');
	  		}, 
	    });
	})

	function validateSearch()
    {
        $("#error_alert").html("");
		var date = $("#date").val();
		var shift = $("#shift").val();
		
		if(shift == "" && date == "")
		{
			$("#error_alert").html("<?php echo Lang::get('messages.search_req');?>");
			return false;
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
						Inventory
					</li>
					<li>
						Transaction
					</li>					
					<li class="active">
						<strong>Manage FG Inward</strong>
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
		{!! Form::open(array('url' => 'invert/','method'=>'GET','onSubmit' => 'return validateSearch()')) !!}
		<div class="form-control-wrapper">
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4"> 						
						{!! HTML::decode( Form::label('date', 'Date <small class="mandatory">*</small>')) !!}
						{!! Form::text('date',Request::get('date'),array('class' => 'form-control','placeholder'=>'Date','id'=>'date','readonly'=>true)) !!}
					</div>
					<div class="col-sm-4"> 						
						{!! HTML::decode( Form::label('shift', 'Shift <small class="mandatory">*</small>')) !!}
						{!! Form::select('shift',$data['shift'],Request::get('shift'), ['id'=>'shift','class' => 'form-control']) !!}
					</div>
				</div>
			</div>				
			<div id="error_alert" class="error validationAlert validationError"></div>	
			<!-- action wrapper -->
			<div class="form-group action">
				<div class="col-lg-12 pull-center buttons"> 
					{!! Form::submit('Search', array('class' => 'btn btn-red')) !!}			
					<button type="button" class="btn btn-black" onclick="doCancel('{!! URL::to('invert') !!}')">Cancel</button>
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
				<div class="col-lg-7">
					<h2 class="page-header">Manage FG Inward</h2>					
				</div>
				<div class="col-lg-5">
					<div class="title-action">
						<a title="View FG Inward" class="btn btn-white add-user" href="{!! URL::to('invert/show')!!}">
							<i class="glyphicon glyphicon-search"></i> View FG Inward
						</a>
						<a title="Add/Edit FG Inward" class="btn btn-white add-user" href="{!! URL::to('invert/create')!!}">
							<i class="glyphicon glyphicon-plus"></i> Add/Edit FG Inward
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
		<div class="{!! Session::get('class') !!}" id="message">
			<div class="row pageHeading">
				<div class="col-xs-12">
					{!! Session::get('message') !!}
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				@if(count($invertData->getListDTO()))			
				<div class="table-responsive">
					<table id="drawingList" class="category table table-hover">
						<thead>
							<tr>
								<th width="10%" class="right">#</th>
								<th class="right">Date</th>
								<th class="left">Shift</th>  
								<th class="left">Is Completed</th>  
								<th class="right"># of Machine</th> 
								<!--<th class="right">Total Downtime(in hr:min)</th>
								<th class="right">Total Rejection(in Pieces)</th> -->
								<th class="right">Last Modified Datetime</th>								
							</tr>
						</thead>
					 	<?php $count = ($invertData->getCount() * Config::get('global_vars.PAGINATION_LIMIT')) - Config::get('global_vars.PAGINATION_LIMIT') + 1;
					  ?>
						<tbody>		
						@foreach($invertData->getListDTO() as $key)					
							<tr>
								<td align="right">{!! $count++ !!}</td>
								<td align="right">{!! $key->getDate() !!}</td>
								<td>{!! $data['shift'][$key->getShift()]!!}</td>
								@if($key->getIsCompleted() == 'Y')
								<td>Yes</td>
								@else
								<td>No</td>
								@endif
								<td align="right">{!! $key->getTotalMachine() !!}</td>
								<!--<td align="right">{!! $key->getTotalDowntime() !!}</td> -->
								<!--<td align="right">{!! $key->getTotalRejection() !!}</td> -->
								<td align="right">{!! $key->getUpdatedTime() !!}</td>							
							</tr>
							@endforeach												
						</tbody>
				  </table><!-- table end -->
				 {!! $invertData->links !!}
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
		if($("#date").val() != "" || $("#shift").val() != "")
		{
			var $slidedown = $('.searchForm');
			$slidedown.slideDown();
			$('.close-filter').fadeIn('slowly');
			
		}  
	});
</script>
@stop