@extends('layout.admin')
@section('content')
<script type="text/javascript">
	function validateSearch()
    {
        clearAlertMsg();
        var arrElemId   = new Array();
        var arrCode     = new Array();
        var arrRefValue = new Array();
        var arrMsg      = new Array();
        var i = 0 ;

        arrElemId[i]    = 'shape';
        arrCode[i]      = 'IS_EMPTY';
        arrRefValue[i]  = null;
        arrMsg[i]       = '<?php echo Lang::get("messages.empty_shape")?>';
        i++;

        result = validate(document.forms[0], arrElemId, arrCode, arrRefValue, arrMsg);
        return result;
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
						<strong>Manage Machine Models</strong>
					</li>				
				</ol>
			</div>
			<div class="col-lg-2 col-md-2 align-right">
				<a title="Close Filter" class="btn btn-white close-filter" style="display:none;" href="javascript:void(0)">
					<span class="label label-default"><i class="glyphicon glyphicon-remove"></i> Close</span>
				</a>
			</div>
		</div>
	</div>
	<div class="searchForm " style="display:none;">
		<div class="container-fluid">
		<div class="form-container">
		{!! Form::open(array('route' => 'machineModel.index','method'=>'GET','onSubmit' => 'return validateSearch()')) !!}
		<div class="form-control-wrapper">
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4"> 						
						{!! HTML::decode( Form::label('machine_model', 'Machine Model <small class="mandatory">*</small>')) !!}
						{!! Form::text('machineModel',Request::get('machine_model'),array("placeholder"=>"Machine Model",'id'=>'machine_model','class'=>'form-control')) !!} 
						<div id="machine_model_alert" class="error validationAlert validationError"></div>
					</div>					
					<div class="col-sm-4">											
						{!! HTML::decode( Form::label('status', 'status <small class="mandatory">*</small>')) !!}
						{!! Form::select('status',$data['status'],null,['id'=>'status','class'=>'form-control']) !!}
						<div id="status_alert" class="error validationAlert validationError"></div>
					</div>
				</div>
			</div>		
			<!-- action wrapper -->
			<div class="form-group action">
				<div class="col-lg-12 pull-center buttons"> 
					{!! Form::submit('Search', array('class' => 'btn btn-red')) !!}			
					<button type="button" class="btn btn-black" onclick="doCancel('{!! URL::to('machineModel') !!}')">Cancel</button>
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
					<h2 class="page-header">Manage Machine Models</h2>					
				</div>
				<div class="col-lg-5">
					<div class="title-action">
						@if(count($machineModels))
						<a title="Download Sheet" class="btn btn-white download-sheet" href="{!! URL::to('machineModel/export') !!}">
							<i class="fa fa-file-excel-o"></i> Export
						</a>
						@endif
						<a title="Add Machine Model" class="btn btn-white add-machineModel add-icons" href="{!! route('machineModel.create')!!}">
							<i class="glyphicon glyphicon-plus"></i> Add Machine Model
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
		<div class="{!! Session::get('class') !!}" id="message" style="display:none;">
			<div class="row pageHeading">
				<div class="col-xs-12">
					{!! Session::get('message') !!}
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-xs-12">
				@if(count($machineModels))
				<div class="table-responsive">
					<table id="machineModelList" class="category table table-hover">
						<thead>
							<tr>
								<th class="right">#</th>
								<th align="left">Machine Model</th>    
								<th class="center">Status</th>
								<th class="center">Actions</th>
							</tr>
						</thead>  
						<tbody>
							  <?php $count = ($machineModels->currentPage() * Config::get('global_vars.PAGINATION_LIMIT')) - Config::get('global_vars.PAGINATION_LIMIT') + 1;
							  ?>
							  @foreach($machineModels as $key)

								<tr>
									<td align="right">{!! $count++ !!}</td>
									<td>{!! $key->machine_model !!}</td>
									<td align="center" class="status">
										@if($key->status == 'A')
										<span class="label-status label-warning-active">active</span>
										@endif
										@if($key->status == 'I')
										<span class="label-status label-warning-inactive">inactive</span>
										@endif
									</td>
									<td align="center" class="action-icon">
										
										<a href="{!! URL::to('machineModel/'.$key->id.'/edit') !!}"  data-toggle="tooltip" data-placement="bottom" title="Edit Machine Model" class="space">
											<i class="glyphicon glyphicon-pencil"></i> 
										</a>
										{!! Form::open(array('id'=>'destroyMachineModel'.$key->id,'method' => 'DELETE','class'=>'delete-icon', 'route' => array('machineModel.destroy', $key->id))) !!}
										<a data-toggle="tooltip" data-placement="bottom" title="Delete Shape" class="confirmbox" href="javascript:void(0)" onclick="confirmDelete('{!! $key->id !!}')">
											<i class="glyphicon glyphicon-trash"></i>
										</a>										
										{!! Form::close() !!}
									</td>
								</tr>
								@endforeach
						</tbody>
					</table>
					{!! $machineModels->appends(Request::except('page'))->render() !!}
				</div><!-- table responsive end -->
				@else
					<div class="alert alert-info">No Record Found</div>
				@endif
			</div>
		</div>
	</div><!-- container-inner end -->
</div><!-- container end -->

<script>
    $("#message").fadeOut(5000);
</script>
<script>

function confirmDelete(id) {
    jConfirm('<?php echo Lang::get('messages.CONFIRM_DELETE'); ?>'+" this machine model?", '', function(r) {
        if (r) {
    		$('#destroyMachineModel'+id).submit();
        }
    });
}

</script>
@stop