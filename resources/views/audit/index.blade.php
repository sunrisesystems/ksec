@extends('layout.admin')
@section('content')
<?php
$process = [
	1 => 'Process1',
	2 => 'Process2',
	3 => 'Process3',
	4 => 'Process4',
	5 => 'Process5',
	6 => 'Process6',
	7 => 'Process7',
	8 => 'Process8',
];

?>
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
				Audit
			</li>
			<li class="active">
				<strong>Manage Audit</strong>
			</li>				
		</ol>			
		<!-- <div class="col-lg-2 col-md-2 align-right">
			<a title="Close Filter" class="close-filter" style="display:none;" href="javascript:void(0)">
				<span class="label label-default"><i class="glyphicon glyphicon-remove"></i> Close</span>
			</a>
		</div>	 -->	
	</div>
	<div class="searchForm " style="display:block;">
		<div class="container-fluid">
		<div class="form-container">
		{!! Form::open(array('route' => 'audit.index','method'=>'GET','onSubmit' => 'return validateSearch()')) !!}
		<div class="form-control-wrapper">
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4"> 						
						{!! Form::label('startDate', 'Start Date') !!}
						{!! Form::text('startDate',Request::get('startDate'),array("placeholder"=>"Start Date",'id'=>'startDate','class'=>'form-control')) !!}
					</div>
					<div class="col-sm-4"> 						
						{!! Form::label('endDate', 'End Date') !!}
						{!! Form::text('endDate',Request::get('endDate'),array("placeholder"=>"End Date",'id'=>'endDate','class'=>'form-control')) !!}
					</div>	
					<div class="col-sm-4">											
						{!! HTML::decode(Form::label('agent', 'Agent')) !!}
						{!! Form::select('agent',[],Request::get('agent'), ['id'=>'agent','class'=>'form-control']) !!}
					</div>
					
				</div>
			</div>	
			<div class="form-group">
				<div class="row">	
					<div class="col-sm-4">											
						{!! HTML::decode(Form::label('teamLead', 'Team Lead')) !!}
						{!! Form::select('teamLead', [], Request::get('teamLead'), ['id'=>'teamLead','class'=>'form-control']) !!}
					</div>	
					<div class="col-sm-4">											
						{!! HTML::decode(Form::label('manager', 'Manager')) !!}
						{!! Form::select('manager', [], Request::get('manager'), ['id'=>'manager','class'=>'form-control']) !!}
					</div>	
					<div class="col-sm-4">
						{!! Form::label('clientCode', 'Client Code') !!}
						{!! Form::text('clientCode',Request::get('clientCode'),array("placeholder"=>"Client Code",'id'=>'clientCode','class'=>'form-control')) !!}
					</div>		
				</div>
			</div>
			<div class="form-group">
				<div class="row">	
					<div class="col-sm-4">											
						{!! HTML::decode(Form::label('process', 'Process')) !!}	
						{!! Form::select('process',$process,Request::get('process'), ['id'=>'process','class'=>'form-control','multiple'=> 'multiple']) !!}
					</div>
					<div class="col-sm-4">											
						{!! HTML::decode(Form::label('formName', 'Form')) !!}	
						{!! Form::select('formName',[],Request::get('formName'), ['id'=>'formName','class'=>'form-control']) !!}
					</div>
				</div>
			</div>
			<div id="error_alert" class="error validationAlert validationError"></div>	

			<!-- action wrapper -->
			<div class="form-group action">
				<div class="col-lg-12 pull-center buttons"> 
					{!! Form::submit('Submit', array('class' => 'btn btn-primary')) !!}
                   	{!! Form::button('Cancel', ['class' => 'btn btn-secondary','onclick'=>'redirectUrl()']) !!} 
				</div>									
			</div><!-- action end -->
		</div><!-- Form control wrapper end -->
		{!! Form::close() !!}
		</div>
		</div>
	</div><!-- Search Form end -->
	<!-- <div class="pageHeading container-fluid">
		<div class="row ">			
			<div class="page-title-wrapper">			
				<div class="col-lg-8">
					<h2 class="page-header">Manage Audit</h2>					
				</div>			
			</div>			
		</div>
	</div> --><!-- pageHeading end -->
	
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
		
	</div><!-- main-container-inner end -->
</div><!-- container end -->	
<script>
    $("#message").fadeOut(5000);
    $("select").multipleSelect({
        filter: true
    });
    function redirectUrl () {
        doCancel("{!! URL::to('audit') !!}")
    }
</script>
@stop