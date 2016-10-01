@extends('layout.admin')
@section('content')
<script type="text/javascript">
	function validateSearch()
    {
        $("#error_alert").html("");
		var name = $("#neckSize").val();
		var status = $("#status").val();
		if(name == "" && status == "")
		{
			$("#error_alert").html("<?php echo Lang::get('messages.search_req');?>");
			return false;
		}
		return true;
	}
	$(function(){

		if($("#neckSize").val() != "" || $("#status").val() != "")
		{
			var $slidedown = $('.searchForm');
			$slidedown.slideDown();
			$('.close-filter').fadeIn('slowly');
		}  
	});
</script>
<!-- Container Start -->
<div id="main-container" class="main-container ">
	<div class="breadcrumb-wrapper container-fluid white-bg">
		<div class="row">
			<div class="col-lg-10 col-md-10">
				<ol class="breadcrumb">
					<li>
						Miscellaneous
					</li>
					<li class="active">
						<strong>Manage Neck Size</strong>
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
			{!! Form::open(array('route' => 'neckSize.index','method'=>'GET','onSubmit' => 'return validateSearch()')) !!}
				<div class="form-control-wrapper">
					<div class="form-group">
						<div class="row">
							<div class="col-sm-4">
								{!! Form::label('neck_size', 'Neck Size') !!}
								{!! Form::text('neckSize',Request::get('neckSize'),array("placeholder"=>"Neck Size",'id'=>'neckSize','class'=>'form-control')) !!} 
							</div>					
							<div class="col-sm-4">											
								{!! HTML::decode(Form::label('status', 'Status <small class="mandatory">*</small>')) !!}						
								{!! Form::select('status', $status,Request::get('status') , ['id'=>'status','class'=>'form-control']) !!}
								
							</div>
						</div>
					</div>	
					<div id="error_alert" class="error validationAlert validationError"></div>	
						
					<!-- action wrapper -->
					<div class="form-group action">
						<div class="col-lg-12 pull-center buttons"> 
							{!! Form::submit('Search', array('class' => 'btn btn-red')) !!}			
							<button type="button" class="btn btn-black" onclick="doCancel('{!! URL::to('neckSize') !!}')">Cancel</button>
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
					<h2 class="page-header">Manage Neck Size</h2>					
				</div>
				<div class="col-lg-4">
					<div class="title-action">
						<a title="Add Nick Size" class="btn btn-white add-neckSize add-icons" href="{!! route('neckSize.create')!!}">
							<i class="glyphicon glyphicon-plus"></i> Add Neck Size
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
				@if(count($neckSizes))
				<div class="table-responsive">
					<table id="drawingList" class="category table table-hover">
						<thead>
							<tr>
								<th class="right">#</th>
								<th class="left">Name</th>
								<th class="left">Description</th>
								<th class="center">Status</th>
								<th class="center">Actions</th>
							</tr>
						</thead>
						<?php $count= ($neckSizes->currentPage() * Config::get('global_vars.PAGINATION_LIMIT')) - Config::get('global_vars.PAGINATION_LIMIT') + 1;
						  ?>
						@foreach($neckSizes as $key)						
						<tbody>
							<tr>
								<td align="right">{!! $count++ !!}</td>
								<td>{!! $key->neck_size !!}</td>
								<td>{!! $key->description !!}</td>
								<td align="center" class="status">
									@if($key->status == 'A')
									<span class="label-status label-warning-active">active</span>
									@endif
									@if($key->status == 'I')
									<span class="label-status label-warning-inactive">inactive</span>
									@endif
								</td>
								<td align="center" class="action-icon">	
								
								<a href="{!! URL::to('neckSize/'.$key->id.'/edit') !!}" class="types"> 
									<i class="glyphicon glyphicon-pencil"></i>
								</a>
								{!! Form::open(array('id'=>'destroyNeckSize'.$key->id,'method' => 'DELETE','class'=>'delete-icon', 'route' => array('neckSize.destroy', $key->id))) !!}
									<a class="confirmbox" href="javascript:void(0)" onclick="confirmDelete('{!! $key->id !!}')">
										<i class="glyphicon glyphicon-trash"></i> 
									</a>
								{!! Form::close() !!}
								</td>							
							</tr>
						@endforeach
						</tbody>
					</table><!-- table end -->
					{!! $neckSizes->appends(Request::except('page'))->render() !!}
				</div><!-- table responsive end -->
				@else
					<div class="alert alert-info">No Record Found</div>
				@endif
			</div>
		</div><!-- row end -->
	</div><!-- container-inner end -->
</div><!-- container end -->

<script>
function confirmDelete(id) {
    jConfirm('<?php echo Lang::get('messages.CONFIRM_DELETE'); ?>'+" this neck size?", '', function(r) {
        if (r) {
    		$('#destroyNeckSize'+id).submit();
        }
    });
}
</script>
@stop