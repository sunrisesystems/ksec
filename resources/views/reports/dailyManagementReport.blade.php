@extends('layout.admin')
@section('content')
<script type="text/javascript">
	$(document).ready(function() {
		$('#date').datetimepicker({
	    	format:'d-m-Y',
	  		formatDate:'d-m-Y',
	  		maxDate : 0,
	  		timepicker:false,
	  		onSelectTime:function(dp,$input){
	  			$("#date").datetimepicker('hide');
	  		}, 
	    });
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

        if($("#date").val() == "__-__-____" ){
        	$("#date_alert").html("Please select date.").show();
        	return false;
        }

       /* if($("#toDate").val() == "__-__-____" ){
        	$("#toDate_alert").html("Please select to date.").show();
        	return false;
        }*/

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
                url : base_url+"/report/management-report",
                method : "POST",
                data : $("#managementReportForm").serialize(),
                cache : false,
                beforeSend : function(){
                	$("#managementReportTable").html('');
                    /*$("#savingButton").show();
                    $("#saveButton").hide();*/
                },
                success:function(data){
                    $("#managementReportTable").html(data);
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
			<div class="col-lg-12 col-md-12">
				<ol class="breadcrumb">
					<li>
						Reports
					</li>
					<li class="active">
						<strong>Daily Management Report</strong>
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
			{!! Form::open(array('method'=>'POST', 'class'=>'form-signin','id'=>'managementReportForm' )) !!}				
		<div class="form-control-wrapper">
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4"> 						
						{!! HTML::decode(Form::label('date', 'Date <small class="mandatory">*</small>')) !!}
						{!! Form::text('date',Request::get('date'),array('class' => 'form-control','placeholder'=>'Date','id'=>'date')) !!}		
						<div id="date_alert" class="error validationAlert validationError"></div>
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
	</div>

<div class="main-container-inner container-fluid" id="managementReportTable">

</div><!-- container end -->
@stop