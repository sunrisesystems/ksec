@extends('layout.admin')
@section('content')
<script type="text/javascript">
	$(document).ready(function() {
		$('#date').datetimepicker({
	    	format:'d-m-Y',
	  		formatDate:'d-m-Y',
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
						Production
					</li>
					<li>
						Transaction
					</li>					
					<li class="active">
						<strong>Manage Hourly Entry</strong>
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
		{!! Form::open(array('url' => 'hourlyEntry/','method'=>'GET','onSubmit' => 'return validateSearch()')) !!}
		<div class="form-control-wrapper">
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4"> 						
						{!! HTML::decode( Form::label('date', 'Date <small class="mandatory">*</small>')) !!}
						{!! Form::text('date',Request::get('date'),array('class' => 'form-control','placeholder'=>'Date','id'=>'date','readonly'=>true)) !!}
					</div>
					<div class="col-sm-4"> 						
						{!! HTML::decode( Form::label('shift', 'Shift <small class="mandatory">*</small>')) !!}
						{!! Form::select('shift',$shifts,Request::get('shift'), ['id'=>'shift','class' => 'form-control']) !!}
					</div>
				</div>
			</div>				
			<div id="error_alert" class="error validationAlert validationError"></div>	
			<!-- action wrapper -->
			<div class="form-group action">
				<div class="col-lg-12 pull-center buttons"> 
					{!! Form::submit('Search', array('class' => 'btn btn-red')) !!}			
					<button type="button" class="btn btn-black" onclick="doCancel('{!! URL::to('hourlyEntry') !!}')">Cancel</button>
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
					<h2 class="page-header">Manage Hourly Entry</h2>					
				</div>
				<div class="col-lg-4">
					<div class="title-action">
						<a title="Add User" class="btn btn-white add-user" href="{!! URL::to('hourlyEntry/create')!!}">
							<i class="glyphicon glyphicon-plus"></i> Add Hourly Entry
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
		<div class="{!! Session::get('class') !!}">
			<div class="row pageHeading">
				<div class="col-xs-12">
					{!! Session::get('message') !!}
				</div>
			</div>
		</div>
		@endif
		<div class="row">
			<div class="col-xs-12">
				@if(!empty($input))
				@if(count($hourlyEntryData->getListDTO()))			
				<div class="table-responsive">
					<table id="drawingList" class="category table table-hover">
						<thead>
							<tr>
								<th width="10%" class="right">#</th>
								<th class="right">Date</th>
								<th class="right">Shift</th>  
								<th class="right">Time</th>  
								<th class="right">Is Completed</th>  
								<th class="center">Actions</th> 								
							</tr>
						</thead>
					 	<?php $count = ($hourlyEntryData->getCount() * Config::get('global_vars.PAGINATION_LIMIT')) - Config::get('global_vars.PAGINATION_LIMIT') + 1;
					  ?>
						<tbody>		
						@foreach($hourlyEntryData->getListDTO() as $key)					
							<tr>
								<td align="right">{!! $count++ !!}</td>
								<td align="right">{!! $key->getDate() !!}</td>
								<td align="right">{!! $shifts[$key->getShift()]!!}</td>
								<td align="right">{!! $key->getTime() !!}</td>
								@if($key->getIsCompleted() == 'Y')
								<td align="right">Yes</td>
								@else
								<td align="right">No</td>
								@endif
								<td align="center" class="action-icon">
									@if($key->getAllowDelete() == 'Y')
									<a href="{!! URL::to('hourlyEntry/edit/'.$key->id) !!}" data-toggle="tooltip" data-placement="bottom" title="Edit Hourly Entry" class="space">
										<i class="glyphicon glyphicon-pencil"></i> 
									</a>
									<a href="{!! URL::to('hourlyEntry/show/'.$key->id) !!}" data-toggle="tooltip" data-placement="bottom" title="View Hourly Entry" class="space">
										<i class="glyphicon glyphicon-search"></i> 
									</a>
									{!! Form::open(array('id'=>'destroyHourlyEntry'.$key->id,'class'=>'delete-icon', 'url' => array('hourlyEntry/delete-hourly-entry', $key->id))) !!}
										<a  data-toggle="tooltip" data-placement="bottom" title="Delete Hourly Entry" class="confirmbox" href="javascript:void(0)" onclick="confirmDelete('{!! $key->id !!}')">
											<i class="glyphicon glyphicon-trash"></i>
										</a>
									{!! Form::close() !!}
									@else
									<a href="{!! URL::to('hourlyEntry/show/'.$key->id) !!}" data-toggle="tooltip" data-placement="bottom" title="View Hourly Entry" class="space">
										<i class="glyphicon glyphicon-search"></i> 
									</a>
									@endif
								</td>
							</tr>
							@endforeach												
						</tbody>
				  </table><!-- table end -->
				 {!! $hourlyEntryData->links !!}
				</div><!-- table responsive end -->
				@else
					<div class="alert alert-info">No record found.</div>
				@endif
				@else
					<div class="alert alert-info">Please select date and shift to search records.</div>
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

function confirmDelete(id) {
    jConfirm('<?php echo Lang::get('messages.CONFIRM_DELETE'); ?>'+" this hourly entry?", '', function(r) {
        if (r) {
    		$('#destroyHourlyEntry'+id).submit();
        }
    });
}
</script>
@stop