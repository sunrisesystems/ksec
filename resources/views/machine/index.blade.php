@extends('layout.admin')
@section('content')
<script type="text/javascript">
	function validateSearch()
    {
        $("#error_alert").html("");
		var name = $("#moldingMachineName").val();
		var status = $("#status").val();
		if(name == "" && status == "")
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
					<li class="active">
						<strong>Manage Machines</strong>
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
			{!! Form::open(array('route' => 'machine.index','method'=>'GET','onSubmit' => 'return validateSearch()')) !!}
		<div class="form-control-wrapper">
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4"> 						
						{!! Form::label('moldingMachineName', 'Molding Machine Name') !!}
						 
						{!! Form::text('moldingMachineName',Request::get('moldingMachineName'), array('placeholder'=>'Molding Machine Name','id'=>'moldingMachineName','class' => 'form-control')) !!}
						<div id="machine_alert" class="error validationAlert validationError"></div>
					</div>					
					<div class="col-sm-4">											
						{!! HTML::decode(Form::label('status', 'Status <small class="mandatory">*</small>')) !!}						
						{!! Form::select('status', $data['status'], Request::get('status'), ['id'=>'status','class'=>'form-control']) !!}
						<div id="status_alert" class="error validationAlert validationError">{!!$errors->first('status')!!}</div>
					</div>
				</div>
			</div>	
			<div id="error_alert" class="error validationAlert validationError"></div>	
			<!-- action wrapper -->
			<div class="form-group action">
				<div class="col-lg-12 pull-center buttons"> 
					{!! Form::submit('Search', array('class' => 'btn btn-red')) !!}			
					<button type="button" class="btn btn-black" onclick="doCancel('{!! URL::to('machine') !!}')">Cancel</button>
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
					<h2 class="page-header">Manage Machines</h2>					
				</div>
				<div class="col-lg-4">
					<div class="title-action">
						@if(count($machines))
						<a title="Download Sheet" class="btn btn-white download-sheet" href="{!! URL::to('machine/export') !!}">
							<i class="fa fa-file-excel-o"></i> Export
						</a>
						@endif
						<a title="Add Machine" class="btn btn-white add-machine add-icons" href="{!! route('machine.create')!!}">
							<i class="glyphicon glyphicon-plus"></i> Add Machine
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
				@if(count($machines))			
				<div class="table-responsive">
					<table id="drawingList" class="category table table-hover">
						<thead>
							<tr>
								<th class="right">#</th>
								<th class="left">Molding Machine Name</th>
								<th class="left">Machine Model</th> 
								<th class="left">Manufacturing Unit</th>
								<th class="right">Manufacturing Date</th>
								<th class="right">Inhouse Serial #</th>
								<th class="center">Status</th>
								<th class="center">Actions</th>
							</tr>
						</thead>
					  	<?php $count = ($machines->currentPage() * Config::get('global_vars.PAGINATION_LIMIT')) - Config::get('global_vars.PAGINATION_LIMIT') + 1;
					  ?>
						<tbody>
						@foreach($machines as $key)
							<tr>
								<td align="right">{!! $count++ !!}</td>
								<td>{!! $key->molding_machine_name !!}</td>
								<td>{!! $data['machineModel'][$key->machine_model_id]!!}</td>
								<td>{!! $data['manufacturingUnit'][$key->manufacturing_unit]!!}</td>
								<td width="right">{!! $key->manufacturing_date !!}</td>
								<td width="right">{!! $key->inhouse_serial_no !!}</td>
								<td align="center" class="status">
									@if($key->status == 'A')
									<span class="label-status label-warning-active">active</span>
									@else
									<span class="label-status label-warning-inactive">inactive</span>
									@endif
								</td>
								<td align="center" class="action-icon">								
									<a href="{!! URL::to('machine/'.$key->id.'/edit') !!}" data-toggle="tooltip" data-placement="bottom" title="Edit Machine" class="space">
										<i class="glyphicon glyphicon-pencil"></i> 
									</a>
									{!! Form::open(array('id'=>'destroyMachine'.$key->id,'method' => 'DELETE','class'=>'delete-icon', 'route' => array('machine.destroy', $key->id))) !!}
									<a  data-toggle="tooltip" data-placement="bottom" title="Delete Machine" class="confirmbox" href="javascript:void(0)" onclick="confirmDelete('{!! $key->id !!}')">
										<i class="glyphicon glyphicon-trash"></i>
									</a>
									{!! Form::close() !!}
								</td>								
							</tr>
							@endforeach						
						</tbody>
				  </table><!-- table end -->	
				  {!! $machines->appends(Request::except('page'))->render() !!}

				</div><!-- table responsive end -->	
				@else
					<div class="alert alert-info">No Record Found</div>
				@endif			
								
			</div>
		</div>

	</div><!-- container-inner end -->
</div><!-- container end -->	


<script>
$(function(){
		if($("#moldingMachineName").val() != "" || $("#status").val() != "")
		{
			var $slidedown = $('.searchForm');
			$slidedown.slideDown();
		}  
	});
</script>
<script>

function confirmDelete(id) {
    jConfirm('<?php echo Lang::get('messages.CONFIRM_DELETE'); ?>'+" this machine?", '', function(r) {
        if (r) {
    		$('#destroyMachine'+id).submit();
        }
    });
}

</script>
@stop