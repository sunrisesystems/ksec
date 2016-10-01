@extends('layout.admin')
@section('content')
<script type="text/javascript">
	
	$(document).ready(function() {
		$('#fromDate, #toDate').datetimepicker({
	    	format:'d-m-Y',
	  		formatDate:'d-m-Y',
	  		mask: true,
	  		maxDate : 0,
	  		timepicker:false,
	    });
	})

	$(document).ready(function(){
		var $slidedown = $('.searchForm');
			$slidedown.slideDown();
    				$("body").toggleClass("mini-navbar");
		
	})
	function submitForm()
    {

        clearAlertMsg();
        var arrElemId   = new Array();
        var arrCode     = new Array();
        var arrRefValue = new Array();
        var arrMsg      = new Array();
        var i = 0 ;

        if($("#fromDate").val() == "__-__-____" ){
        	$("#fromDate_alert").html("Please select from date.").show();
        	return false;
        }

        if($("#toDate").val() == "__-__-____" ){
        	$("#toDate_alert").html("Please select to date.").show();
        	return false;
        }

        arrElemId[i]    = 'shift';
        arrCode[i]      = 'IS_EMPTY';
        arrRefValue[i]  = null;
        arrMsg[i]       = 'Please select shift.';
        i++;

        result = validate(document.forms[0], arrElemId, arrCode, arrRefValue, arrMsg);
        if(result){
        	/*var date = $("#date").val();
        	var shift = $("#shift").val();
*/
        	/*$("#shift").attr('disabled',true);
        	$("#date").attr('disabled',true);
        	$("#saveButton").attr('disabled',true);*/
        	$.ajax({
                url : base_url+"/report/daily-production-report",
                method : "POST",
                data : $("#dailyProductionReportForm").serialize(),
                cache : false,
                beforeSend : function(){
                	$("#dailyProductionTable").html('');
                    /*$("#savingButton").show();
                    $("#saveButton").hide();*/
                },
                success:function(data){
                    $("#dailyProductionTable").html(data);
                   /* $("#savingButton").hide();
                    $("#saveButton").show();*/
                },
                done : function (data){
                    /*$("#savingButton").hide();
                    $("#saveButton").show();*/
                },
                error :function (xhr, status, err) {
                	/*$("#shift").attr('disabled',false);
        			$("#date").attr('disabled',false);
        			$("#saveButton").attr('disabled',false);
                    $("#savingButton").hide();
                    $("#saveButton").show();*/
                	var responseJSON = JSON.parse(xhr.responseText);
                	for (var key in responseJSON) 
					{
						$("#"+key+"_alert").html(responseJSON[key]).show();
					} 	
                }
            });
        }else{
        	return result;
        }

    }
</script>
<!-- Container Start -->
<div id="main-container" class="main-container ">
	<div class="breadcrumb-wrapper container-fluid white-bg">
		<div class="row">
			<div class="col-lg-10 col-md-10">
				<ol class="breadcrumb">
					<li>
						Reports
					</li>
					<li class="active">
						<strong>Production Report</strong>
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
			{!! Form::open(array('method'=>'POST', 'class'=>'form-signin','id'=>'dailyProductionReportForm' )) !!}				
		<div class="form-control-wrapper">
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4"> 						
						{!! HTML::decode(Form::label('fromDate', 'From Date <small class="mandatory">*</small>')) !!}
						{!! Form::text('fromDate',Request::get('fromDate'),array('class' => 'form-control','placeholder'=>'Date','id'=>'fromDate')) !!}		
						<div id="fromDate_alert" class="error validationAlert validationError"></div>
					</div>	
					<div class="col-sm-4"> 						
						{!! HTML::decode(Form::label('toDate', 'To Date <small class="mandatory">*</small>')) !!}
						{!! Form::text('toDate',Request::get('toDate'),array('class' => 'form-control','placeholder'=>'Date','id'=>'toDate')) !!}						
						<div id="toDate_alert" class="error validationAlert validationError"></div>
					</div>
					<div class="col-sm-4">											
						{!! HTML::decode(Form::label('shift', 'Shift <small class="mandatory">*</small>')) !!}						
						{!! Form::select('shift[]',$shifts,null, ['class' => 'form-control','size'=> 3,'multiple'=>true,'id'=>'shift']) !!}
						<div id="shift_alert" class="error validationAlert validationError"></div>
					</div>
      				{!! Form::token() !!}

				</div>
			</div>	
			<div id="error_alert" class="error validationAlert validationError"></div>	
			<!-- action wrapper -->
			<div class="form-group action">
				<div class="col-lg-12 pull-center buttons"> 
					{!! Form::button('Search', array('class' => 'btn btn-red','onclick' => 'submitForm()')) !!}			
					<button type="button" class="btn btn-black" onclick="">Cancel</button>
				</div>									
			</div><!-- action end -->
		</div><!-- Form control wrapper end -->
		{!! Form::close() !!}
		</div>
		</div>
	</div><!-- Search Form end -->
	
	
<div id="dailyProductionTable">
</div><!-- main-container-inner end -->
</div><!-- container end -->
@stop