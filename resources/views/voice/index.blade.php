@extends('layout.admin')
@section('content')

<script type="text/javascript">
	function validateSearch()
    {
        $("#error_alert").html("");
		var name = $("#type").val();
		var status = $("#status").val();
		var group = $("#group").val();
		if(name == "" && status == "" && group == "")
		{
			$("#error_alert").html("<?php echo Lang::get('messages.search_req');?>");
			return false;
		}
		return true;
	}
	$(function(){

		if($("#name").val() != "" || $("#status").val() != "" || $("#unit").val() != "" || $("#role").val() != "")
		{
			var $slidedown = $('.searchFormo');
			$slidedown.slideDown();
			$('.close-filter').fadeIn('slowly');
		}  
	});
</script>
<!-- Container Start -->
<div id="main-container" class="main-container">
	<div class="breadcrumb-wrapper">		
		<ol class="breadcrumb">
			<li>
				Voice
			</li>
			<li class="active">
				<strong>Manage Voice</strong>
			</li>				
		</ol>			
		<!-- <div class="col-lg-2 col-md-2 align-right">
			<a title="Close Filter" class="close-filter" style="display:none;" href="javascript:void(0)">
				<span class="label label-default"><i class="glyphicon glyphicon-remove"></i> Close</span>
			</a>
		</div>	 -->	
	</div>
	<div class="searchForm " style="display:none;">
		<div class="container-fluid">
		<div class="form-container">
		{!! Form::open(array('route' => 'voice.index','method'=>'GET','onSubmit' => 'return validateSearch()')) !!}
		<div class="form-control-wrapper">
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4"> 						
						{!! Form::label('name', 'Name') !!}
						{!! Form::text('name',Request::get('name'),array("placeholder"=>"Name",'id'=>'name','class'=>'form-control')) !!}
					</div>	
					<div class="col-sm-4">											
						{!! HTML::decode(Form::label('unit', 'Unit')) !!}
						{!! Form::select('unit',[],Request::get('unit'), ['id'=>'unit','class'=>'form-control']) !!}
					</div>
					<div class="col-sm-4">											
						{!! HTML::decode(Form::label('role', 'Role')) !!}
						{!! Form::select('role', [], Request::get('role'), ['id'=>'role','class'=>'form-control']) !!}
					</div>
				</div>
			</div>	
			<div class="form-group">
				<div class="row">				
					<div class="col-sm-4">											
						{!! HTML::decode(Form::label('status', 'Status <small class="mandatory">*</small>')) !!}	
						{!! Form::select('status',[],Request::get('status'), ['id'=>'status','class'=>'form-control']) !!}
					</div>
				</div>
			</div>
			<div id="error_alert" class="error validationAlert validationError"></div>	

			<!-- action wrapper -->
			<div class="form-group action">
				<div class="col-lg-12 pull-center buttons"> 
					{!! Form::submit('Search', array('class' => 'btn btn-red')) !!}			
					<button type="button" class="btn btn-black" onclick="doCancel('{!! URL::to('voice') !!}')">Cancel</button>
				</div>									
			</div><!-- action end -->
		</div><!-- Form control wrapper end -->
		{!! Form::close() !!}
		</div>
		</div>
	</div><!-- Search Form end -->
	<header class="page-header-wrapper">
		<div class="page-heading">
			<h2>Manage Voice</h2>
		</div>
		<div class="header-actions">
			<a title="Create Voice" class="btn btn-white add-user" href="{!! route('voice.create')!!}">
				<i class="glyphicon glyphicon-plus"></i> Create Voice
			</a>
		</div>
	</header>
	<div class="clearfix"></div>
	<!-- <div class="pageHeading">
		<div class="row ">			
			<div class="page-title-wrapper">			
				<div class="col-lg-8">
					<h2 class="page-header">Manage Voice</h2>					
				</div>
				<div class="col-lg-4">
					<div class="title-action">
						<a title="Create Voice" class="btn btn-white add-user" href="{!! route('voice.create')!!}">
							<i class="glyphicon glyphicon-plus"></i> Create Voice
						</a>
						<a title="Search Filter" class="btn btn-white search-filter" href="javascript:void(0)">
							<i class="glyphicon glyphicon-filter"></i> Search
						</a>
					</div>
				</div>				
			</div>			
		</div>
	</div> -->
	
	<div class="main-container-inner">			
		@if(Session::has('message'))
		<div class="{!! Session::get('class') !!}" id="message">			
			{!! Session::get('message') !!}			
		</div>
		@endif

		@if(count($sqHead->getListDTO()))
		<div class="table-responsive">
			<table id="drawingList" class="category table table-hover">
				<thead>
					<tr>
						<th class="center">#</th>
						<th class="center">Id</th>
						<th class="center">Date</th>  
						<th class="center">Process</th> 
						<th class="center">Agent</th>
						<th class="center">Manager</th>
						<th class="center">Team Lead</th>
						<th class="center">Category</th>
						<th class="center">Fatal</th>
						<th class="center">Adherence</th>
						<th class="center">Quality %</th>
						<th class="center">Actions</th>
					</tr>
				</thead>
			  <?php $count = ($sqHead->getCount() * Config::get('global_vars.PAGINATION_LIMIT')) - Config::get('global_vars.PAGINATION_LIMIT') + 1;
			 	?>
				<tbody>
					@foreach($sqHead->getListDTO() as $key => $value)
					<tr>
						<td align="center">{!! $count++ !!}</td>
						<td align="center">{!! $value->getId() !!}</td>
						<td align="center">{!! $value->getDate() !!}</td>
						<td align="center">{!! $data['process'][$value->getProcess()]!!}</td>
						<td align="center">{!! $data['agent'][$value->getAgent()]!!}</td>
						<td align="center">{!! $data['manager'][$value->getManager()]!!}</td>
						<td align="center">{!! $data['teamLead'][$value->getTl()]!!}</td>
						<td align="center">{!! $data['category'][$value->getAgentCategory()]!!}</td>
						@if($value->getFatal() == 'Y')
							<td align="center">Yes</td>
						@elseif($value->getFatal() == 'N')
							<td align="center">No</td>
						@else
							<td align="center"></td>
						@endif

						@if($value->getAdherence() == 'Y')
							<td align="center">Yes</td>
						@elseif($value->getAdherence() == 'N')
							<td align="center">No</td>
						@else
							<td align="center"></td>
						@endif

						<td align="center">{!! Lib::roundOffNumber($value->getQualityPer(),2) !!}</td>
						<td align="center" class="action-icon">								
							<a href="{!! route('voice.edit',[$value->getId()]) !!}" data-toggle="tooltip" data-placement="bottom" title="Edit Voice" class="edit-user">
								<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
							</a>
						</td>
						
					</tr>
					@endforeach
				</tbody>
		  </table><!-- table end -->
		  {!! $sqHead->getLinks() !!}
		</div><!-- table responsive end -->
		@else
			<div class="alert alert-info">No Record Found</div>
		@endif
			
	</div><!-- main-container-inner end -->
</div><!-- container end -->	
<script>
    $("#message").fadeOut(5000);
</script>
@stop