@extends('layout.admin')
@section('content')
<script type="text/javascript">
	function validateSearch()
    {
        $("#error_alert").html("");
		var defectNature = $("#defectNature").val();
		var defectReason = $("#defectReason").val();
		var defect = $("#defect").val();
		var status = $("#status").val();
		if(defectNature == "" && status == "" && defectReason == "" && defect == "")
		{
			$("#error_alert").html("<?php echo Lang::get('messages.search_req');?>");
			return false;
		}
		return true;
	}

</script>

<!-- Container Start -->
<div id="main-container" class="main-container ">
	<div class="breadcrumb-wrapper container-fluid white-bg">
		<div class="row">
			<div class="col-lg-10 col-md-10">
				<ol class="breadcrumb">
					<li>
						Production
					</li>
					<li class="active">
						<strong>Manage Defect</strong>
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
			{!! Form::open(array('route' => 'defect.index','method'=>'GET','onSubmit' => 'return validateSearch()')) !!}
			
				<div class="form-control-wrapper">
					<div class="form-group">
						<div class="row">
							<div class="col-sm-4">											
								{!! HTML::decode(Form::label('rejectionNature', 'Defect Nature <small class="mandatory">*</small>')) !!}						
								{!! Form::select('defectNature',$data['defectNature'], Request::get('defectNature'), ['id'=>'defectNature','class'=>'form-control']) !!}
								<div id="defectNature_alert" class="error validationAlert validationError">{!!$errors->first('defectNature')!!}</div>
							</div>
							<div class="col-sm-4">											
								{!! HTML::decode(Form::label('rejectionReason', 'Defect Reason <small class="mandatory">*</small>')) !!}						
								{!! Form::select('defectReason', $data['defectReason'], Request::get('defectReason'), ['id'=>'defectReason','class'=>'form-control']) !!}
								<div id="defectReason_alert" class="error validationAlert validationError">{!!$errors->first('defectReason')!!}</div>
							</div>
							<div class="col-sm-4"> 
								{!! HTML::decode(Form::label('rejection', 'Defect <small class="mandatory">*</small>')) !!}
								{!! Form::text('defect',Request::get('defect'),array("placeholder"=>"Defect",'id'=>'defect','class'=>'form-control')) !!}
								<div id="defect_alert" class="error validationAlert validationError">{!!$errors->first('defect')!!}</div>
							</div>								
						</div>
					</div>	
					<div class="form-group">
						<div class="row">
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
							<button type="button" class="btn btn-black" onclick="doCancel('{!! URL::to('defect') !!}')">Cancel</button>
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
					<h2 class="page-header">Manage Defect</h2>					
				</div>
				<div class="col-lg-4">
					<div class="title-action">
						@if(count($defects))
						<a title="Download Sheet" class="btn btn-white download-sheet" href="{!! URL::to('defect/export') !!}">
							<i class="fa fa-file-excel-o"></i> Export
						</a>
						@endif
						<a title="Add Defect" class="btn btn-white add-rejection add-icons" href="{!! route('defect.create')!!}">
							<i class="glyphicon glyphicon-plus"></i> Add Defect
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
				@if(count($defects))			
				<div class="table-responsive">
					<table id="rejectionList" class="category table table-hover">
						<thead>
							<tr>
								<th class="right">#</th>
								<th class="left">Defect Nature</th>      
								<th>Defect Reason</th>
								<th>Defect</th>
								<th width="15%">Causes Cavity Block</th>
								<th class="center">Status</th>
								<th width="20%" class="center">Actions</th>
							</tr>
						</thead>
					  	<?php $count = ($defects->currentPage() * Config::get('global_vars.PAGINATION_LIMIT')) - Config::get('global_vars.PAGINATION_LIMIT') + 1;
					 ?>
						<tbody>
						@foreach($defects as $key)

							<tr>
								<td align="right">{!! $count++ !!}</td>
								<td width="25%">{!! @$data['defectNature'][$key->defect_nature_id]!!}</td>
								<td width="25%">{!! @$data['defectReason'][$key->defect_reason_id]!!}</td>
								<td width="25%">{!! $key->defect !!}</td>
								<td align="center">
									@if($key->ccb == 'Y')
									{!! "Yes" !!}
									@else
									{!! "No" !!}
									@endif
								</td>
								<td align="center" class="status">
									@if($key->status == 'A')
									<span class="label-status label-warning-active">active</span>
									@else
									<span class="label-status label-warning-inactive">inactive</span>
									@endif
								</td>
								<td align="center" class="action-icon">								
									<a href="{!! URL::to('defect/'.$key->id.'/edit') !!}" data-toggle="tooltip" data-placement="bottom" title="Edit Defect" class="space">
										<i class="glyphicon glyphicon-pencil"></i> 
									</a>
									{!! Form::open(array('id'=>'destroyDefect'.$key->id,'method' => 'DELETE','class'=>'delete-icon', 'route' => array('defect.destroy', $key->id))) !!}
										<a  data-toggle="tooltip" data-placement="bottom" title="Delete Defect" class="confirmbox" href="javascript:void(0)" onclick="confirmDelete('{!! $key->id !!}')">
											<i class="glyphicon glyphicon-trash"></i>
										</a>
									{!! Form::close() !!}
								</td>
								
							</tr>
							@endforeach						
						
						</tbody>
				  </table><!-- table end -->
				  {!! $defects->appends(Request::except('page'))->render() !!}
				  
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
		if($("#defectNature").val() != "" || $("#status").val() != "" || $("#defectReason").val() != "" || $("#defect").val() != "")
		{
			var $slidedown = $('.searchForm');
			$slidedown.slideDown();
		}  
	});
</script>
<script>
function confirmDelete(id) {
    jConfirm('<?php echo Lang::get('messages.CONFIRM_DELETE'); ?>'+" this Defect?", '', function(r) {
        if (r) {
    		$('#destroyDefect'+id).submit();
        }
    });
}
</script>
@stop