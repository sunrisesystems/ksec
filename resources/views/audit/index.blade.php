@extends('layout.admin')
@section('content')
<?php
?>
<script>
    function redirectUrl () {
        doCancel("{!! URL::to('audit') !!}")
    }

    function validateSearch() {
    	clearAlertMsg();
    	var startDate = $("#startDate").val();
    	var endDate = $("#endDate").val();

    	if(startDate == ''){
    		$("#error_alert").html("Select start date.");
    		return false;
    	}

    	if(endDate == ''){
    		$("#error_alert").html("Select end date.");
    		return false;
    	}

    	$.ajax({
            url : base_url+"/audit/index",
            method : "post",
            data : $("#auditForm").serialize(),
            cache : false,
            beforeSend : function(){
                
            },
            success:function(data){
                $("#auditTable").html(data);
            },
            done : function (data){
            },
            error :function (xhr, status, err) {
                var responseJSON = JSON.parse(xhr.responseText);
                for (var key in responseJSON) 
                {
                    $("#"+key+"_alert").html(responseJSON[key]).show();
                }   
            }
        });
    }
    
    $(document).ready(function () {
    	$("select").multipleSelect({
        	filter: true,
        	//multiple: true,
    	});
    	$('#startDate').datetimepicker({
	    	format:'d-M-Y',
	  		formatDate:'d-M-Y',
	  		maxDate : 0,
	  		timepicker:false,
	  		closeOnDateSelect:true,
	  		onSelectDate:function(dp,$input){
	  			var months = "<?php echo Config::get('global_vars.DATEPICKER_MONTH_SPAN'); ?>";
	  		
				var fromDate = $("#startDate").val(); 
				
				var dateSplit = fromDate.split("-");    
				     
				var objDate = new Date(dateSplit[1] + " " + dateSplit[0] + ", " + dateSplit[2]);

				var allowDate = '';	
			
				objDate.setDate( objDate.getDate() + parseInt(months) );
	  			var todaysDate = new Date();
	  			if(objDate.getTime() > todaysDate.getTime()){
	  				allowDate = '{!! date("d-M-Y") !!}'
	  			}else{	
	  				allowDate = moment(objDate).format('DD-MMM-YYYY');
	  			}
	  			
				$('#endDate').datetimepicker({
			    	format:'d-M-Y',
			  		formatDate:'d-M-Y',
			  		maxDate : allowDate,
					minDate: $("#startDate").val(),
					defaultDate : $("#startDate").val(),
			  		timepicker:false,
			  		closeOnDateSelect:true,
			    });
  			}
	    });

	 	validateSearch();
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
	<div class="searchForm audit-form" style="display:block;">
		<div class="form-container">
		{!! Form::open(array('url' => 'audit/index','method'=>'POST','onSubmit' => 'return validateSearch()','id'=>'auditForm')) !!}
		<div class="form-control-wrapper">
			<div class="form-group">
				<div class="row">
					<div class="col-sm-3"> 						
						{!! Form::label('startDate', 'Start Date') !!}
						{!! Form::text('startDate',date("d-M-Y"),array("placeholder"=>"Start Date",'id'=>'startDate','class'=>'form-control','readonly'=>true)) !!}
					</div>
					<div class="col-sm-3"> 						
						{!! Form::label('endDate', 'End Date') !!}
						{!! Form::text('endDate',date("d-M-Y"),array("placeholder"=>"End Date",'id'=>'endDate','class'=>'form-control','readonly'=>true)) !!}
					</div>	
					<div class="col-sm-3">											
						{!! HTML::decode(Form::label('agent', 'Agent')) !!}
						{!! Form::select('agent[]',$data['agent'],null, ['id'=>'agent','class'=>'form-control','multiple'=> 'multiple']) !!}
					</div>	
					<div class="col-sm-3">											
						{!! HTML::decode(Form::label('teamLead', 'Team Lead')) !!}
						{!! Form::select('teamLead[]',$data['teamLead'], null, ['id'=>'teamLead','class'=>'form-control','multiple'=> 'multiple']) !!}
					</div>				
				</div>
			</div>	
			<div class="form-group">
				<div class="row">	
						
					<div class="col-sm-3">											
						{!! HTML::decode(Form::label('manager', 'Manager')) !!}
						{!! Form::select('manager[]',$data['manager'], null, ['id'=>'manager','class'=>'form-control','multiple'=> 'multiple']) !!}
					</div>	
					<div class="col-sm-3">
						{!! Form::label('clientCode', 'Client Code') !!}
						{!! Form::text('clientCode',null,array("placeholder"=>"Client Code",'id'=>'clientCode','class'=>'form-control')) !!}
					</div>	
					<div class="col-sm-3">											
						{!! HTML::decode(Form::label('process', 'Process')) !!}	
						{!! Form::select('process[]',$data['process'],null, ['id'=>'process','class'=>'form-control','multiple'=> 'multiple']) !!}
					</div>	
					<div class="col-sm-3">											
						{!! HTML::decode(Form::label('formName', 'Form')) !!}	
						{!! Form::select('formName[]',$data['sqForm'],null, ['id'=>'formName','class'=>'form-control','multiple'=> 'multiple']) !!}
					</div>
				</div>
			</div>
			<div id="error_alert" class="error validationAlert validationError"></div>	

			<!-- action wrapper -->
			<div class="form-action text-center">				
				{!! Form::button('Submit', ['class' => 'btn btn-primary','onclick'=> 'validateSearch()']) !!}
               	{!! Form::button('Cancel', ['class' => 'btn btn-secondary','onclick'=>'redirectUrl()']) !!} 		
			</div><!-- action end -->
		</div><!-- Form control wrapper end -->
		{!! Form::close() !!}
		</div>
	</div><!-- Search Form end -->
	<div id="auditTable">
		
	</div>
</div><!-- container end -->	
@stop