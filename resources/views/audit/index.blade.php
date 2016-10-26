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
			
	</div>
	<div class="searchForm " style="display:block;">
		<div class="form-container">
		{!! Form::open(array('url' => 'audit/index','method'=>'POST','onSubmit' => 'return validateSearch()')) !!}
		<div class="form-control-wrapper">
			<div class="form-group">
				<div class="row">
					<div class="col-sm-3"> 						
						{!! Form::label('startDate', 'Start Date') !!}
						{!! Form::text('startDate',Request::get('startDate'),array("placeholder"=>"Start Date",'id'=>'startDate','class'=>'form-control','readonly'=>true)) !!}
					</div>
					<div class="col-sm-3"> 						
						{!! Form::label('endDate', 'End Date') !!}
						{!! Form::text('endDate',Request::get('endDate'),array("placeholder"=>"End Date",'id'=>'endDate','class'=>'form-control','readonly'=>true)) !!}
					</div>	
					<div class="col-sm-3">											
						{!! HTML::decode(Form::label('agent', 'Agent')) !!}
						{!! Form::select('agent[]',$data['agent'],Request::get('agent'), ['id'=>'agent','class'=>'form-control','multiple'=> 'multiple']) !!}
					</div>	
					<div class="col-sm-3">											
						{!! HTML::decode(Form::label('teamLead', 'Team Lead')) !!}
						{!! Form::select('teamLead[]',$data['teamLead'], Request::get('teamLead'), ['id'=>'teamLead','class'=>'form-control','multiple'=> 'multiple']) !!}
					</div>				
				</div>
			</div>	
			<div class="form-group">
				<div class="row">	
						
					<div class="col-sm-3">											
						{!! HTML::decode(Form::label('manager', 'Manager')) !!}
						{!! Form::select('manager[]',$data['manager'], Request::get('manager'), ['id'=>'manager','class'=>'form-control','multiple'=> 'multiple']) !!}
					</div>	
					<div class="col-sm-3">
						{!! Form::label('clientCode', 'Client Code') !!}
						{!! Form::text('clientCode',Request::get('clientCode'),array("placeholder"=>"Client Code",'id'=>'clientCode','class'=>'form-control')) !!}
					</div>	
					<div class="col-sm-3">											
						{!! HTML::decode(Form::label('process', 'Process')) !!}	
						{!! Form::select('process[]',$data['process'],Request::get('process'), ['id'=>'process','class'=>'form-control','multiple'=> 'multiple']) !!}
					</div>	
					<div class="col-sm-3">											
						{!! HTML::decode(Form::label('formName', 'Form')) !!}	
						{!! Form::select('formName[]',$data['sqForm'],Request::get('formName'), ['id'=>'formName','class'=>'form-control','multiple'=> 'multiple']) !!}
					</div>
				</div>
			</div>
			<div id="error_alert" class="error validationAlert validationError"></div>	

			<!-- action wrapper -->
			<div class="form-action text-center">				
				{!! Form::submit('Submit', array('class' => 'btn btn-primary')) !!}
               	{!! Form::button('Cancel', ['class' => 'btn btn-secondary','onclick'=>'redirectUrl()']) !!} 		
			</div><!-- action end -->
		</div><!-- Form control wrapper end -->
		{!! Form::close() !!}
		</div>
	</div><!-- Search Form end -->
	
	<div class="main-container-inner">			
		@if(Session::has('message'))
		<div class="{!! Session::get('class') !!}" id="message">			
			{!! Session::get('message') !!}			
		</div>
		@endif		
	</div><!-- main-container-inner end -->
</div><!-- container end -->	
<script>
    $("#message").fadeOut(5000);

    function redirectUrl () {
        doCancel("{!! URL::to('audit') !!}")
    }

    $(document).ready(function () {
    	$("select").multipleSelect({
        	filter: true,
        	//multiple: true,
    	});
    	$('#startDate,#endDate').datetimepicker({
	    	format:'d-M-Y',
	  		formatDate:'d-M-Y',
	  		maxDate : 0,
	  		timepicker:false,
	  		onSelectTime:function(dp,$input){
	  			$("#startDate,#endDate").datetimepicker('hide');
	  		}, 
	    });
    });
</script>
@stop