@extends('layout.admin')
@section('content')
@if (Session::has('message'))
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="{!! Session::get('class') !!}">{!! Session::get('message') !!}</div>
			</div>
		</div>
	</div>
@endif
<div class="clearfix"></div>
<div id="main-container" class="main-container ">  
    <div class="breadcrumb-wrapper container-fluid white-bg">
		<div class="row">
			<div class="col-lg-12 col-md-12">
				<ol class="breadcrumb">
					<li>
						Production
					</li>
					<li>
						Transaction
					</li>
					<li>
						<a href="{!!URL::to('hourlyEntry')!!}">Manage Hourly Entry</a>
					</li>
					<li class="active">
						<strong>Add Hourly Entry</strong>
					</li>					
				</ol>
			</div>
		</div>
	</div>
	<div class="pageHeading container-fluid">
		<div class="row ">			
			<div class="page-title-wrapper">			
				<div class="col-lg-12">
					<h2 class="page-header">Add Hourly Entry</h2>					
				</div>							
			</div>			
		</div>
	</div><!-- pageHeading end -->
    <div class="main-container-inner container-fluid">
		<!-- Form row start -->
		<div class="row">
			<div class="col-xs-12">
				<section id="dailyEntry" class="form-container">
			
						<div class="form-control-wrapper" >
							<div class="form-group">
								<div class="row">
									<div class="col-sm-4"> 						
										{!! HTML::decode( Form::label('shift', 'Shift <small class="mandatory">*</small>')) !!}
										{!! Form::select('shift',$shifts, null, ['id'=>'shift','class' => 'form-control','onchange'=>'setShiftTiming(this.value)']) !!}
										<div id="shift_alert" class="error validationAlert validationError"></div>
									</div>

									<div class="col-sm-4"> 						
										{!! HTML::decode( Form::label('date', 'Date <small class="mandatory">*</small>')) !!}
										{!! Form::text('date',null,array('class' => 'form-control','placeholder'=>'Date','id'=>'date','readonly'=>true)) !!}
										<div id="date_alert" class="error validationAlert validationError"></div>
									</div>

									<div class="col-sm-4"> 						
										{!! HTML::decode( Form::label('time', 'Time <small class="mandatory">*</small>')) !!}
										{!! Form::text('time',null,array('class' => 'form-control','placeholder'=>'Time','id'=>'time','readonly'=>true)) !!}
										<div id="time_alert" class="error validationAlert validationError"></div>
									</div>
								</div>
							</div>
							<!-- action wrapper -->
							<div class="form-group action">
								<div class="col-lg-12 pull-center buttons"> 
									{!! Form::button('Submit', array('class' => 'btn btn-red','onclick'=>"return loadHourlyData();",'id'=>'saveButton')) !!} 
									{!! Form::button('Submit...', array('class' => 'btn btn-red','id'=>'savingButton','disabled'=>true,'style'=>'display:none')) !!} 
								</div>
							</div>
						</div>

				</section><!-- section Form end -->
				
				<section id="hourlyEntryDetails" class="form-container">
					
				</section><!-- section Form end -->
			</div>
		</div><!-- Form row end -->
	</div><!-- page content -->
</div><!-- Container end -->


<script type="text/javascript">
	function setShiftTiming (shiftId) {
		var times = '{!! json_encode($shifitTimings) !!}';
		times = $.parseJSON(times);
		
		if(times.length > 0){
			$("#time").val('');
			for( var key in times ){
			   	if(times[key]['shiftId'] == shiftId){
			   		var time = times[key]['allowTime'];
					//var time = $.parseJSON(allowableTime);

			   		$('#time').datetimepicker({
				  		mask: true,
				  		datepicker:false,
				  		format:'H:i',
				  		step : 30,
				  		allowTimes : time,
				  		onSelectTime:function(dp,$input){
				  			$("#date").datetimepicker('hide');
				  		}, 
				    });
			   	}
			}
		}else{
			$('#time').datetimepicker({
		  		mask: true,
		  		datepicker:false,
		  		format:'H:i',
		  		step : 30,
		  		onSelectTime:function(dp,$input){
		  			$("#date").datetimepicker('hide');
		  		}, 
		    });
		}
	}
    function loadHourlyData()
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

        if($("#time").val() == "__:__" ){
        	$("#time_alert").html("Please select time.").show();
        	return false;
        }

        arrElemId[i]    = 'shift';
        arrCode[i]      = 'IS_EMPTY';
        arrRefValue[i]  = null;
        arrMsg[i]       = 'Please select shift.';
        i++;

        result = validate(document.forms[0], arrElemId, arrCode, arrRefValue, arrMsg);
        if(result){
        	var date = $("#date").val();
        	var time = $("#time").val();
        	var shift = $("#shift").val();

        	$.ajax({
                url : base_url+"/hourlyEntry/load-all-hourly-data",
                method : "POST",
                data : { 'date' : date,'shift':shift,'time' : time},
                cache : false,
                beforeSend : function(){
                    $("#savingButton").show();
                    $("#saveButton").hide();
                },
                success:function(data){
                	$("#shift").attr('disabled',true);
		        	$("#date").attr('disabled',true);
		        	$("#saveButton").attr('disabled',true);
                    $("#hourlyEntryDetails").html(data);
                    $("#savingButton").hide();
                    $("#saveButton").show();
                },
                done : function (data){
                    $("#savingButton").hide();
                    $("#saveButton").show();
                },
                error :function (xhr, status, err) {
                	$("#shift").attr('disabled',false);
		        	$("#date").attr('disabled',false);
		        	$("#saveButton").attr('disabled',false);
                    $("#savingButton").hide();
                    $("#saveButton").show();
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
    <?php if(Lib::isAdmin()){ ?>
	  	$('#date').datetimepicker({
	    	format:'d-m-Y',
	  		formatDate:'d-m-Y',
	  		mask: true,
	  		//minDate : '{!! date("d-m-Y",strtotime("-1 days"))!!}',
	  		maxDate : '{!! date("d-m-Y") !!}',
	  		timepicker:false,

	  		onSelectTime:function(dp,$input){
	  			$("#date").datetimepicker('hide');
	  		}, 
	    });
    <?php } else {?>
    	$('#date').datetimepicker({
	    	format:'d-m-Y',
	  		formatDate:'d-m-Y',
	  		mask: true,
	  		minDate : '{!! date("d-m-Y",strtotime("-1 days"))!!}',
	  		maxDate : '{!! date("d-m-Y") !!}',
	  		timepicker:false,

	  		onSelectTime:function(dp,$input){
	  			$("#date").datetimepicker('hide');
	  		}, 
	    });
    <?php } ?>

    /*$('#time').datetimepicker({
  		mask: true,
  		datepicker:false,
  		format:'H:i',
  		step : 5,
  		onSelectTime:function(dp,$input){
  			$("#date").datetimepicker('hide');
  		}, 
    });*/

 	function redirectUrl () {
    	doCancel("{!! URL::to('hourlyEntry') !!}")
    }
     $(document).ready(function () {
    	//$("#side-menu").hide();
    	$("body").toggleClass("mini-navbar");
       // SmoothlyMenu();
    })
</script>
@stop 