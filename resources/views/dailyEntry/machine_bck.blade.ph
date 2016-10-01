<div class="pageTableHeading">
	<div class="row ">			
		<div class="page-title">			
			<div class="col-lg-12">
				<h3 class="page-header">Machine/Product Wise Details</h3>
				<h5 class="page-header">Shift Timing : {!!  $result["shiftTiming"]["startDate"] ." to " .$result["shiftTiming"]["endDate"]!!}</h5>					
			</div>	
			<div class="clear"></div>						
		</div>			
	</div>
</div><!-- pageTableHeading end -->
@if($result['success'])
{!! Form::open(['url' => 'saveDailyEntry','id'=>'machineForm']) !!}
<div class="row">
	<div class="form-control-wrapper col-md-12" >
		<div class="form-group table-big">
			@if(!empty($result['data']))
			<?php $count = 0; 
			if($result['isCompleted'] == 'Y')
				$readOnly = false;
			else
				$readOnly = false;
			?>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>#</th>
						<th >Machine</th>
						<th width="20%">Product</th>
						<th width="8%">Shot Counter<small class="mandatory"> *</small></th>
						<th width="10%">Shot Counter timer<small class="mandatory"> *</small></th>
						<th width="8%">Purging<small class="mandatory"> *</small></th>
						<th width="7%">Plan Id</th>
						<th width="10%">Production Quantity<small class="mandatory"> *</small></th>
						<th>Total <i class="glyphicon glyphicon-warning-sign"></i></th>
						<th width="7%">Total <i class="glyphicon glyphicon-thumbs-down"></i><small class="mandatory"> *</small></th>
						<th >Done</th>
						<?php if(! $readOnly) {?>
						<th>Action</th>
						<?php } ?>
					</tr>
				</thead>
				<tbody>
					{!! Form::hidden("dailyEntry",$result['daliyEntryId'],array('class' => 'form-control','placeholder'=>'Machine','id'=>'daily_entry','readonly'=>true)) !!}
					{!! Form::hidden("dailyEntryCompleted",$result['isCompleted'],array('class' => 'form-control','placeholder'=>'Machine','id'=>'dailyEntryCompleted','readonly'=>true)) !!}
					@foreach($result['data'] as $key)
					<?php if(isset($key['shortCounterTime']) && !empty($key['shortCounterTime'])){
						$key['shortCounterTime'] = $key['shortCounterTime'];
					}else{
						$key['shortCounterTime'] = $result["shiftTiming"]["endDate"];
					}?>
					{!! Form::hidden("dailyEntryMachine[]",$key['id'],array('class' => 'form-control','placeholder'=>'Machine','id'=>'daily_entry','readonly'=>true)) !!}
					<tr>
						<td>{!! ++$count !!}</td>
						<td>
						{!! Form::text("machine[".$key['id']."]",$key['machine'],array('class' => 'form-control','placeholder'=>'Machine','id'=>'machine','readonly'=>true)) !!}
						<div id="machine_alert" class="error validationAlert validationError">{!!$errors->first('machine')!!}</div>
						</td>
						<td>
						{!! Form::text("product[".$key['id']."]",$key['product'],array('class' => 'form-control','placeholder'=>'Product','id'=>'product','readonly'=>true)) !!}
						<div id="product_alert" class="error validationAlert validationError">{!!$errors->first('product')!!}</div>
						</td>
						<td>
						<?php if($readOnly) {?>
						{!! Form::text("shortCounter[".$key['id']."]",$key['endShortCounter'],array('class' => 'form-control shortCounter','placeholder'=>'Shot Counter','id'=>'shortCounter_'.$key['id'],'maxlength'=>10,'readonly'=>$readOnly)) !!}
						<?php } else { ?>
							{!! Form::text("shortCounter[".$key['id']."]",$key['endShortCounter'],array('class' => 'form-control shortCounter','placeholder'=>'Shot Counter','id'=>'shortCounter_'.$key['id'],'maxlength'=>10)) !!}
						<?php } ?>
						<div id="shortCounter_alert" class="error validationAlert validationError">{!!$errors->first('shortCounter')!!}</div>
						</td>
						<td>
						{!! Form::text("shortCounterTimer[".$key['id']."]",$key['shortCounterTime'],array('class' => 'form-control shortCounterTimer','placeholder'=>'Shot Counter timer','id'=>'shortCounterTimer_'.$key['id'],'readonly'=>true)) !!}
						<div id="shortCounterTimer_alert" class="error validationAlert validationError">{!!$errors->first('shortCounterTimer')!!}</div>
						</td>
						<td>
						<?php if($readOnly) {?>
							{!! Form::text("purging[".$key['id']."]",$key['purging'],array('class' => 'form-control purging','placeholder'=>'Purging','id'=>'purging_'.$key['id'],'maxlength'=>5,'readonly'=>$readOnly)) !!}
						<?php } else { ?>
							{!! Form::text("purging[".$key['id']."]",$key['purging'],array('class' => 'form-control purging','placeholder'=>'Purging','id'=>'purging_'.$key['id'],'maxlength'=>5)) !!}
						<?php } ?>
						<div id="purging_alert" class="error validationAlert validationError">{!!$errors->first('purging')!!}</div></td>
						<td>
						{!! Form::text("planId[".$key['id']."]",$key['planId'],array('class' => 'form-control planId','placeholder'=>'Plan Id','id'=>'planId','readonly'=>true)) !!}
						<div id="planId_alert" class="error validationAlert validationError">{!!$errors->first('planId')!!}</div>
						</td>
						<td>
						<?php if($readOnly) {?>
						{!! Form::text("productionQuantity[".$key['id']."]",$key['productionQuantity'],array('class' => 'form-control productionQuantity','placeholder'=>'Production Quantity','id'=>'productionQuantity_'.$key['id'],'maxlength'=>10,'readonly'=>$readOnly)) !!}
						<?php } else { ?>
						{!! Form::text("productionQuantity[".$key['id']."]",$key['productionQuantity'],array('class' => 'form-control productionQuantity','placeholder'=>'Production Quantity','id'=>'productionQuantity_'.$key['id'],'maxlength'=>10)) !!}
						<?php } ?>
						<div id="productionQuantity_alert" class="error validationAlert validationError">{!!$errors->first('productionQuantity')!!}</div>
						</td>

						<td>
						<span id="totalDowntime_{!! $key['id']!!}">{!! $key['totalDowntime']!!}</span>
						</td>

						<td>
						<?php if($readOnly) {?>
						{!! Form::text("totalRejection[".$key['id']."]",$key['totalRejection'],array('class' => 'form-control totalRejection','placeholder'=>'Total Rejection','id'=>'totalRejection_'.$key['id'],'maxlength'=>10,'readonly'=>$readOnly)) !!}
						<?php } else { ?>
						{!! Form::text("totalRejection[".$key['id']."]",$key['totalRejection'],array('class' => 'form-control totalRejectionClass','placeholder'=>'Total Rejection','id'=>'totalRejection_'.$key['id'],'maxlength'=>10,'onblur'=>'checkRejectionQty('.$key["id"].')')) !!}
						<?php } ?>

						{!! Form::hidden("rejectionRecords[".$key['id']."]",$key['rejectionRecords'],array('class' => 'form-control rejectionRecords','id'=>'rejectionRecords_'.$key['id'],'hidden'=>true)) !!}
						<!-- <span id="totalRejection_{!! $key['id']!!}" class="totalRejectionClass">{!! $key['totalRejection']!!}</span>
						 --></td>

						<td style="text-align:center;">
						@if($readOnly)
							{!! Form::checkbox("isCompleted[".$key['id']."]", 'Y', true,['class'=>'isCompleted','id' => "isCompleted_".$key['id'],'disabled'=>true]) !!}
						@elseif($key['isCompleted'] == 'Y')
							{!! Form::checkbox("isCompleted[".$key['id']."]", 'Y', true,['class'=>'isCompleted','id' => "isCompleted_".$key['id']]) !!}
						@else
						{!! Form::checkbox("isCompleted[".$key['id']."]", 'Y', false,['class'=>'isCompleted','id'=>"isCompleted_".$key['id']]) !!}
						@endif
						<div id="productionQuantity_alert" class="error validationAlert validationError">{!!$errors->first('productionQuantity')!!}</div>
						</td>
						<?php if(! $readOnly) {?>
						<td align="center" class="action-icon action-buttons">
							<!-- <button title="Rejection" type="button" class="rejection" data-toggle="modal" data-target="#addRejection"> -->
							<span><button title="Rejection" type="button" class="rejection" data-toggle="modal" data-target="" onclick="addRejection({!! $key['id']!!})">
								<i class="glyphicon glyphicon-thumbs-down"></i>
							</button></span>
							<span><button title="Downtime" type="button" class="download" data-toggle="modal" data-target="" onclick="getDowntime({!! $key['id']!!})">
								<i class="glyphicon glyphicon-warning-sign"></i>
							</button></span>
							<!-- Button trigger modal -->
						</td>
						<?php } ?>
					</tr>
					@endforeach	
				</tbody>
			</table>
			@endif
		</div>							
	</div>
	<!-- action wrapper -->
	<div class="form-group action">
	<?php if(! $readOnly) {?>
		<div class="col-lg-12 pull-center buttons"> 
			{!! Form::button('Save', array('class' => 'btn btn-red','onclick'=>'return validateData()')) !!}
			{!! Form::button('Save & Complete', array('class' => 'btn btn-red','onclick'=>'return validateAllMachineData()')) !!}
		</div>
	<?php } ?>
	</div>
	</div>
</div>
{!! Form::close() !!}
@else
<div>{!! $result['data'] !!}</div>
@endif
<script>
$(".shortCounter,.productionQuantity,.purging,.totalRejectionClass").ForceNumericOnly();

$(function() {
	var allowMinDate = '{!! $result["shiftTiming"]["startDate"]!!}';
	var allowMaxDate = '{!! $result["shiftTiming"]["endDate"]!!}';
	var allowableTime = '{!! $result["shiftTiming"]["time"]!!}';
	var time = $.parseJSON(allowableTime);
	//console.log(time);
	$(".shortCounterTimer").datetimepicker({
		format:'d-m-Y H:i',
  		formatDate:'d-m-Y H:i',
  		step : 5,
  		minDate : allowMinDate,
  		maxDate : allowMaxDate,
  		allowTimes : time,
  		//mask: true,
  	//	theme:'dark',
  		onSelectTime:function(dp,$input){
  			$input.blur();
  			$input.datetimepicker('hide');
  			validateDateTime($input.val(),allowMinDate,allowMaxDate);
  		}, 
	});
})
function validateDateTime (inputDateTime,strtDateTime,endDateTime) {
  	if(checkDateTimeWithShiftTime(inputDateTime,strtDateTime,endDateTime)){

  	}else{
  		jAlert("Please select short counter time between shift start time and shift end time.",'Error!!');
  	}
}
function addRejection(id){
	var productionQuantity = $("#productionQuantity_"+id).val();
	var totalRejection = $("#totalRejection_"+id).val();
	var addedRejection = $("#rejectionRecords_"+id).val();
	if(productionQuantity == ''){
		jAlert("Please enter production quantity.");
		return false;
	}
	if(totalRejection == ''){
		jAlert("Please enter total rejection.");
		return false;
	}

	var rejectionPerc = (100 * parseFloat(totalRejection)) / parseInt(productionQuantity);
	if(parseFloat(rejectionPerc) < 0.5){
		jAlert("Total rejection is not greater than 0.5%. So not allowed to add rejection reasons.");
		return false;
	}
	$.ajax({
        url : base_url+"/getRejection",
        method : "POST",
        data : { 'dailyEntryMachineId' : id},
        cache : false,
        beforeSend : function(){
           $('#preloader').show();
           $('#background-loader').show();
        },
        success:function(data){
            $("#addRejection").html(data).modal('show');
            $('#preloader').hide();
           	$('#background-loader').hide();
        },
        done : function (data){
        },
        error :function (xhr, status, err) {
           
        }
    });
}

function getDowntime(id){
	$.ajax({
        url : base_url+"/getDowntime",
        method : "POST",
        data : { 'dailyEntryMachineId' : id},
        cache : false,
        beforeSend : function(){
           $('#preloader').show();
           $('#background-loader').show();
        },
        success:function(data){
            $("#addDowntime").html(data).modal('show');
            $('#preloader').hide();
           	$('#background-loader').hide();
        },
        done : function (data){
        },
        error :function (xhr, status, err) {
           
        }
    });
}
function validateData () {
	var errors = [];
	var errors1 = [];
	var checkedCount = 0, totalMachine = 0,rejectionPerc = 0;
	var msg = '';
	$('.isCompleted').each(function (index) {
		totalMachine = totalMachine + 1;
	    var id = $(this).attr('id');
	    if($('#' + id).is(":checked")){
	    	checkedCount = checkedCount + 1;
	    	// check for all values 
	    	var shortCounter = $(".shortCounter:eq(" + index + ")").val();
	    	var shortCounterTimer = $(".shortCounterTimer:eq(" + index + ")").val();
	    	var purging = $(".purging:eq(" + index + ")").val();
	    	var productionQuantity = $(".productionQuantity:eq(" + index + ")").val();
	    	var rejection = $(".totalRejectionClass:eq(" + index + ")").val();
	    	var addedRejection = $(".rejectionRecords:eq("+index+")").val();
	    	if(shortCounter  == '' || shortCounterTimer == '' || purging == '' || productionQuantity == '' || rejection == ''){
	    		errors.push(index);
	    	}else{
	    		var rejectionPerc = (100 * parseFloat(rejection)) / parseInt(productionQuantity);
				if(parseFloat(rejectionPerc) > 0.5){
					if(addedRejection != '' && (parseInt(addedRejection) != parseInt(rejection))){
	    				errors1.push(parseInt(index) + 1);
					}
				}
	    	}
	    }else{
	    	var shortCounter = $(".shortCounter:eq(" + index + ")").val();
	    	var shortCounterTimer = $(".shortCounterTimer:eq(" + index + ")").val();
	    	var purging = $(".purging:eq(" + index + ")").val();
	    	var productionQuantity = $(".productionQuantity:eq(" + index + ")").val();
	    	var rejection = $(".totalRejectionClass:eq(" + index + ")").val();
	    	var addedRejection = $(".rejectionRecords:eq("+index+")").val();
	    	var rejectionPerc = (100 * parseFloat(rejection)) / parseInt(productionQuantity);
			if(parseFloat(rejectionPerc) > 0.5){
				if(addedRejection != '' && (parseInt(addedRejection) != parseInt(rejection))){
    				errors1.push(parseInt(index) + 1);
				}
			}
	    }
	});
	if(errors.length > 0){
		jAlert("Please fill all the required fields.");
	}else if(errors1.length > 0){
		jAlert("Please add total rejection reasons for row "+errors1.toString()+".");
		
	}else{
		var remaining = parseInt(totalMachine) - parseInt(checkedCount);
		if(parseInt(remaining) == 1){
			msg = remaining +" entries are pending out of "+totalMachine + " entries. Do you want to continue to save?";
		}else if(parseInt(remaining) > 1){
			msg = remaining +" entry is pending out of "+totalMachine + " entries. Do you want to continue to save?";
		}
		if(msg != ''){
			jConfirm(msg, '', function(r) {
		        if (r) {
		    		$('#machineForm').submit();
		        }
		    });
		}else{
			$('#machineForm').submit();
		}
		
	}
	return false;
}

function validateAllMachineData () {
	var errors = [];
	var checkedCount = 0, totalMachine = 0;
	var msg = '';
	$('.isCompleted').each(function (index) {
		totalMachine = totalMachine + 1;
	    var id = $(this).attr('id');
	    if($('#' + id).is(":checked")){
	    	checkedCount = checkedCount + 1;
	    	// check for all values 
	    	var shortCounter = $(".shortCounter:eq(" + index + ")").val();
	    	var shortCounterTimer = $(".shortCounterTimer:eq(" + index + ")").val();
	    	var purging = $(".purging:eq(" + index + ")").val();
	    	var productionQuantity = $(".productionQuantity:eq(" + index + ")").val();
	    	var rejection = $(".totalRejectionClass:eq(" + index + ")").val();
	    	var addedRejection = $(".rejectionRecords:eq("+index+")").val();

	    	if(shortCounter  == '' || shortCounterTimer == '' || purging == '' || productionQuantity == '' || rejection == ''){
	    		errors.push(index);
	    	}else{
	    		var rejectionPerc = (100 * parseFloat(rejection)) / parseInt(productionQuantity);
				if(parseFloat(rejectionPerc) > 0.5){
					if(addedRejection != '' && (parseInt(addedRejection) != parseInt(rejection))){
	    				errors1.push(parseInt(index) + 1);
					}
				}
	    	}
	    }else{
	    	errors.push(index);
	    }
	});
	if(errors.length > 0){
		jAlert("Please fill all the required fields.");
	}else if(errors1.length > 0){
		jAlert("Please add total rejection reasons for row "+errors1.toString()+".");
		
	}else{
		/*var remaining = parseInt(totalMachine) - parseInt(checkedCount);
		if(parseInt(remaining) == 1){
			msg = remaining +" entries are pending out of "+totalMachine + " entries. Do you want to continue to save?";
		}else if(parseInt(remaining) > 1){
			msg = remaining +" entry is pending out of "+totalMachine + " entries. Do you want to continue to save?";
		}*/
		msg = 'You clicked on Save & Complete. You will not able to edit this entry. Do you want to continue?';
		if(msg != ''){
			jConfirm(msg, '', function(r) {
		        if (r) {
		        	$('#dailyEntryCompleted').val('Y');
		    		$('#machineForm').submit();
		        }
		    });
		}
		
	}
	return false;
}
$(document).ready(function() {
   	$('.isCompleted').change(function() {
        if($(this).is(":checked")) {
            var index = $('.isCompleted').index(this);
            var shortCounter = $(".shortCounter:eq(" + index + ")").val();
	    	var shortCounterTimer = $(".shortCounterTimer:eq(" + index + ")").val();
	    	var purging = $(".purging:eq(" + index + ")").val();
	    	var productionQuantity = $(".productionQuantity:eq(" + index + ")").val();
	    	var rejection = $(".totalRejectionClass:eq(" + index + ")").val();
	    	var addedRejection = $(".rejectionRecords:eq(" + index + ")").val();
	    	if(shortCounter  == '' || shortCounterTimer == '' || purging == '' || productionQuantity == '' || rejection == ''){
	    		$(this).attr('checked',false);
	    		jAlert("Can not marked it as checked. Please fill required fields.");
	    	}else{
	    		var rejectionPerc = (100 * parseFloat(rejection)) / parseInt(productionQuantity);
				if(parseFloat(rejectionPerc) > 0.5){
					if(addedRejection != '' && (parseInt(addedRejection) != parseInt(rejection))){
		    			$(this).attr('checked',false);
						jAlert("Please add rejection reasons.");
						return false;
					}
				}
	    	}
        }      
    });
});

function checkRejectionQty (id) {
	var productionQuantity = $("#productionQuantity_"+id).val();
	var rejectionPerc = 0;
	if(productionQuantity == ''){
		$("#totalRejection_"+id).val('');
		jAlert("Please enter production quantity first.");
		return false;
	}else{
		var totalRejection = $("#totalRejection_"+id).val();
		var addedRejection = $("#rejectionRecords_"+id).val();
		if(totalRejection != ''){
			rejectionPerc = (100 * parseFloat(totalRejection)) / parseInt(productionQuantity);
			if(parseFloat(rejectionPerc) > 0.5){
				if(addedRejection != '' && (parseInt(addedRejection) != parseInt(totalRejection))){
					jAlert("Please add rejection reasons.");
					return false;
				}
			}
		}
	}
}
</script>
