@extends('layout.admin')
@section('content')
<script type="text/javascript">
	function validateSearch()
    {
        $("#error_alert").html("");
		var name = $("#moldName").val();
		var status = $("#status").val();
		if(name == "" && status == "")
		{
			$("#error_alert").html("<?php echo Lang::get('messages.search_req');?>");
			return false;
		}
		return true;
	}
	$(function(){
		if($("#moldName").val() != "" || $("#status").val() != "")
		{
			var $slidedown = $('.searchForm');
			$slidedown.slideDown();
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
						Production
					</li>
					<li class="active">
						<strong>Manage Molds</strong>
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
			{!! Form::open(array('route' => 'mold.index','method'=>'GET','onSubmit' => 'return validateSearch()')) !!}
				<div class="form-control-wrapper">
					<div class="form-group">
						<div class="row">
							<div class="col-sm-4"> 						
								{!! Form::label('mold_name', 'Mold Name') !!}
								{!! Form::text('moldName',Request::get('moldName'),array("placeholder"=>"Mold Name",'id'=>'moldName','class'=>'form-control')) !!} 
							</div>					
							<div class="col-sm-4">											
								{!! HTML::decode(Form::label('status', 'Status <small class="mandatory">*</small>')) !!}								
								{!! Form::select('status', $data['status'], Request::get('status'), ['id'=>'status','class'=>'form-control']) !!}
							</div>
						</div>
					</div>	
					<div id="error_alert" class="error validationAlert validationError"></div>	

					<!-- action wrapper -->
					<div class="form-group action">
						<div class="col-lg-12 pull-center buttons"> 
							{!! Form::submit('Search', array('class' => 'btn btn-red')) !!}			
							<button type="button" class="btn btn-black" onclick="doCancel('{!! URL::to('mold') !!}')">Cancel</button>
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
					<h2 class="page-header">Manage Molds</h2>					
				</div>
				<div class="col-lg-4">
					<div class="title-action">
						@if(count($molds))
						<a title="Download Sheet" class="btn btn-white download-sheet" href="{!! URL::to('mold/export') !!}">
							<i class="fa fa-file-excel-o"></i> Export
						</a>
						@endif
						<a title="Add Mold" class="btn btn-white add-mold add-icons" href="{!! route('mold.create')!!}">
							<i class="glyphicon glyphicon-plus"></i> Add Mold
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
				@if(count($molds))
				<div class="table-responsive">
					<table id="drawingList" class="category table table-hover">
						<thead>
							<tr>
								<th class="right">#</th>
								<th class="left">Name</th>
								<th class="center">Status</th>
								<th class="center">Actions</th>
							</tr>
						</thead>
						<?php $count= ($molds->currentPage() * Config::get('global_vars.PAGINATION_LIMIT')) - Config::get('global_vars.PAGINATION_LIMIT') + 1;
						  ?>
						  @foreach($molds as $key)						
						<tbody>
							<tr>
								<td align="right">{!! $count++ !!}</td>
								<td>{!! $key->mold_name !!}</td>
								<td align="center" class="status">
									@if($key->status == 'A')
									<span class="label-status label-warning-active">active</span>
									@endif
									@if($key->status == 'I')
									<span class="label-status label-warning-inactive">inactive</span>
									@endif
								</td>
								<td align="center" class="action-icon">		
								
								<a href="{!! URL::to('mold/'.$key->id.'/edit') !!}" data-toggle="tooltip" data-placement="bottom" title="Edit Mold" class="editMold"> 
									<i class="glyphicon glyphicon-pencil"></i>
								</a>
								<!-- <button href="javascript:void(0)" data-toggle="modal"  data-target="#replicateMold"  data-placement="bottom" title="Replicate Mold" class="replicateMold"> 
									<i class="fa fa-files-o"></i>
								</button> -->
								{!! Form::open(array('id'=>'destroyMold'.$key->id,'method' => 'DELETE', 'class'=>'delete-icon','route' => array('mold.destroy', $key->id))) !!}
								<a class="confirmbox" href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" title="Delete Mold" onclick="confirmDelete('{!! $key->id !!}')">
									<i class="glyphicon glyphicon-trash"></i> 
								</a>
								{!! Form::close() !!}
								</td>							
							</tr>
						@endforeach
						</tbody>
					</table><!-- table end -->
					{!! $molds->appends(Request::except('page'))->render() !!}
				</div><!-- table responsive end -->
				@else
					<div class="alert alert-info">No Record Found</div>
				@endif
			</div>
		</div><!-- row end -->
	</div><!-- container-inner end -->
</div><!-- container end -->

<!-- Modal -->
<div id="replicateMold" class="modal fade replicateMoldModal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
		<h4 class="modal-title">Replicate Mold</h4>
      </div>
      <div class="modal-body">
        <div class="main-container-inner container-fluid">
		<!-- Form row start -->
			<div class="row">
				<div class="col-xs-12">
					<section id="groupDetail" class="form-container">
							{!! Form::open() !!}
							<div class="form-control-wrapper">
								<div class="form-group">
									<div class="row">
										<div class="col-sm-4">											
											{!! HTML::decode(Form::label('drawingNo', 'Drawing # <small class="mandatory">*</small>')) !!}						
											{!! Form::select('drawingNo', ['drawing 1', 'drawing 2'], null, ['id'=>'drawingNo','class'=>'form-control']) !!}
											<div id="drawingNo_alert" class="error validationAlert validationError">{!!$errors->first('drawingNo')!!}</div>
										</div>
										<div class="col-sm-4"> 
											{!! HTML::decode( Form::label('mold_no', 'Mold # <small class="mandatory">*</small>')) !!}
											{!! Form::text('mold_no',null,array('placeholder'=>'Mold #','id'=>'mold_no','class'=>'form-control')) !!}
											<div id="mold_no_alert" class="error validationAlert validationError">{!! $errors->first('mold_no') !!}</div>										
										</div>
										<div class="col-sm-4">											
											{!! HTML::decode(Form::label('prority', 'Prority <small class="mandatory">*</small>')) !!}						
											{!! Form::select('prority', ['Primary', 'Secondary'], null, ['id'=>'prority','class'=>'form-control']) !!}
											<div id="prority_alert" class="error validationAlert validationError">{!!$errors->first('prority')!!}</div>
										</div>
										
									</div>
								</div>	
								
								
										
								<!-- action wrapper -->
								<div class="form-group action">
									<div class="col-lg-12 pull-center buttons"> 
										{!! Form::submit('Save', array('class' => 'btn btn-red')) !!}
										{!! Form::button('Cancel', ['class' => 'btn btn-black','data-dismiss'=>'modal']) !!} 
									</div>									
								</div><!-- action end -->
							</div><!-- Form control wrapper end -->	
						{!! Form::close() !!}
					</section><!-- section Form end -->
				</div>
			</div><!-- Form row end -->
		</div><!-- page content -->
		</div>      
	</div>
  </div>
</div>
  
<script>
    $("#message").fadeOut(5000);
</script>
<script>
function confirmDelete(id) {
    jConfirm('<?php echo Lang::get('messages.CONFIRM_DELETE'); ?>'+" this Mold?", '', function(r) {
        if (r) {
    		$('#destroyMold'+id).submit();
        }
    });
}
</script>
@stop