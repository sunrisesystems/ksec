@extends('layout.admin')
@section('content')
<script type="text/javascript">
	function validateSearch()
    {
       $("#error_alert").html("");
		var name = $("#drawingNo").val();
		var status = $("#status").val();
		var shape = $("#shape").val();
		if(name == "" && status == "" && shape == "")
		{
			$("#error_alert").html("<?php echo Lang::get('messages.search_req');?>");
			return false;
		}
		return true;
	}

	$(function(){
		if($("#drawingNo").val() != "" || $("#status").val() != "" || $("#shape").val() != "")
		{
			var $slidedown = $('.searchForm');
			$slidedown.slideDown();
		}  
	});
</script>
<div id="main-container" class="main-container ">
	<div class="breadcrumb-wrapper container-fluid white-bg">
		<div class="row">
			<div class="col-lg-10 col-md-10">
				<ol class="breadcrumb">
					<li>
						Production
					</li>
					<li class="active">
						<strong>Manage Drawings</strong>
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
			{!! Form::open(array('route' => 'drawings.index','method'=>'GET','onSubmit' => 'return validateSearch()')) !!}
				<div class="form-control-wrapper">
					<div class="form-group">
						<div class="row">
							<div class="col-sm-4"> 
								{!! Form::label('drawingNo', 'Drawing No#') !!}
								{!! Form::text('drawingNo',Request::get('drawingNo'),array("placeholder"=>"Drawing No.",'id'=>'drawingNo','class'=>'form-control')) !!} 
							</div>					
							<div class="col-sm-4">											
								{!! HTML::decode(Form::label('status', 'Status <small class="mandatory">*</small>')) !!}
								{!! Form::select('status', $data['status'], Request::get('status'), ['id'=>'status','class'=>'form-control']) !!}
							</div>
							<div class="col-sm-4">											
								{!! HTML::decode(Form::label('shape', 'Shape <small class="mandatory">*</small>')) !!}
								{!! Form::select('shape', $data['shape'], Request::get('shape'), ['id'=>'shape','class'=>'form-control']) !!}
							</div>
						</div>
					</div>	
					<div id="error_alert" class="error validationAlert validationError"></div>	
					<!-- action wrapper -->
					<div class="form-group action">
						<div class="col-lg-12 pull-center buttons"> 
							{!! Form::submit('Search', array('class' => 'btn btn-red')) !!}			
							<button type="button" class="btn btn-black" onclick="doCancel('{!! URL::to('drawings') !!}')">Cancel</button>
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
					<h2 class="page-header">Manage Drawings</h2>					
				</div>
				<div class="col-lg-4">
					<div class="title-action">
						@if(count($drawings))
						<a title="Download Sheet" class="btn btn-white download-sheet" href="{!! URL::to('drawing/export') !!}">
							<i class="fa fa-file-excel-o"></i> Export
						</a>
						@endif
						<a title="Add Drawing" class="btn btn-white add-drawing" href="{!! route('drawings.create')!!}">
							<i class="glyphicon glyphicon-plus"></i> Add Drawing
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
			<div class="row ">
				<div class="col-xs-12">
					{!! Session::get('message') !!}
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				@if(count($drawings))
				<div class="table-responsive">
					<table id="drawingList" class="category table table-hover">
					<thead>
					  <tr>
						<th class="right">#</th>
						<th width="28%">Drawing No.</th>
						<th >Shape</th>
						<th class="right"><abbr data-toggle="tooltip" data-placement="bottom" title="Standard Cycle Time">SCT (s)</abbr></th>
						<th class="right"><abbr data-toggle="tooltip" data-placement="bottom" title="Standard Cavities">SC (#)</abbr></th>
						<th class="right"><abbr data-toggle="tooltip" data-placement="bottom" title="Drawing Weight">DW (g)</abbr></th>
						<th class="right"><abbr data-toggle="tooltip" data-placement="bottom" title="Average Wall Thickness" >AWT (mm)</abbr></th>
						<th class="right"><abbr data-toggle="tooltip" data-placement="bottom" title="Overflow Capacity">OFC (ml)</abbr></th>
						<th class="right"><abbr data-toggle="tooltip" data-placement="bottom" title="Neck Height">NH(mm)</abbr></th>
						<th class="center">Status</th>
						<th class="center">Actions</th>
					  </tr>
					</thead>
					<tbody>
						<?php $count = ($drawings->currentPage() * Config::get('global_vars.PAGINATION_LIMIT')) - Config::get('global_vars.PAGINATION_LIMIT') + 1;
					  ?>
						@foreach($drawings as $key)
						<tr>
							<td align="right">{!! $count++ !!}</td>
							<td>{!! $key->drawing_no !!}</td>
							<td>{!! $data['shape'][$key->bottle_shape_id] !!}</td>
							<td align="right">{!! $key->sct_c !!}</td>
							<td align="right">{!! $key->std_cavities !!}</td>
							<td align="right">{!! $key->drawing_wt_c !!}</td>
							<td align="right">{!! $key->avg_wall_thickness !!}</td>
							<td align="right">{!! $key->ofc_c !!}</td>
							<td align="right">{!! $key->neck_height_c !!}</td>
							<td align="center" class="status">
								@if($key->status == 'A')
								<span class="label-status label-warning-active">active</span>
								@endif
								@if($key->status == 'I')
								<span class="label-status label-warning-inactive">inactive</span>
								@endif
							</td>
							<td align="center" class="action-icon">
								<a data-toggle="tooltip" data-placement="bottom" title="Download Drawing" href="{!! URL::to('admin/download/'.$key->id) !!}" class="download">
									<i class="glyphicon glyphicon-download-alt"></i>
								</a>
								<a data-toggle="tooltip" data-placement="bottom" title="Edit Drawing" href="{!! URL::to('drawings/'.$key->id.'/edit') !!}" class="space">
									<i class="glyphicon glyphicon-pencil"></i>
								</a>
								<!-- <a data-toggle="tooltip" data-placement="bottom" title="View Drawing" href="" class="view"><i class="glyphicon glyphicon-search"></i></a> -->
								{!! Form::open(array('id'=>'destroyDrawing'.$key->id,'method' => 'DELETE', 'class'=>'delete-icon','route' => array('drawings.destroy', $key->id))) !!}
									<a data-toggle="tooltip" data-placement="bottom" title="Delete Drawing" class="confirmbox delete" href="javascript:void(0)" onclick="confirmDelete('{!! $key->id !!}')">
										<i class="glyphicon glyphicon-trash"></i> 
									</a>
								{!! Form::close() !!}
							</td>							
						</tr>
						@endforeach
					</tbody>
				  </table>
				  {!! $drawings->appends(Request::except('page'))->render() !!}		  
				</div>
			</div>
		</div>
	</div>
</div>
		@else

<div class="alert alert-info">No Record Found</div>

@endif
<script>
    $("#message").fadeOut(5000);
</script>
<script>

function confirmDelete(id) {
    jConfirm('<?php echo Lang::get('messages.CONFIRM_DELETE'); ?>'+" this drawing?", '', function(r) {
        if (r) {
    		$('#destroyDrawing'+id).submit();
        }
    });
}

</script>
@stop