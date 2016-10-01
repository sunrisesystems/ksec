<div class="pageTableHeading">
	<div class="row ">			
		<div class="page-title">			
			<div class="col-lg-12">
				<h3 class="page-header">Hourly Entry Details</h3>					
			</div>							
		</div>			
	</div>
</div><!-- pageTableHeading end -->
@if($result['success'])
<?php //echo "<pre>";
//print_r($result); exit;?>
{!! Form::open(['id'=>'hourlyEntryForm']) !!}
<div class="row">
	<div class="form-control-wrapper col-md-12" >
		<div class="form-group">
			@if(!empty($result['data']))
			<?php $count = 0; 
			if($result['isCompleted'] == 'Y')
				$readOnly = true;
			else
				$readOnly = false;
			?>
			<table class="table table-bordered" id="hourlyEntryTable">
				<thead>
					<tr>
						<th>#</th>
						<th >Machine</th>
						<th width="30%">Product</th>
						<th>Cycle Time<small class="mandatory"> *</small></th>
						<th>Cavity Blocks<small class="mandatory"> *</small></th>
						<th>Average Weight<small class="mandatory"> *</small></th>
						<th >Done</th>
					</tr>
				</thead>
				<tbody class="input_fields_wrap">
					{!! Form::hidden("hourlyEntryId",$result['hourlyEntryId'],array('class' => 'form-control ','placeholder'=>'Machine','id'=>'hourlyEntryId','readonly'=>true)) !!}

					{!! Form::hidden("houryEntryCompleted",$result['isCompleted'],array('class' => 'form-control','placeholder'=>'Machine','id'=>'houryEntryCompleted','readonly'=>true)) !!}

					@foreach($result['data'] as $key)
					{!! Form::hidden("hourlyDetail",$key['id'],array('class'=>'hourlyDetail')) !!}
					{!! Form::hidden("productId",$key['productId'],array('class' => 'hourlyProductId')) !!}
					{!! Form::hidden("machineId",$key['machineId'],['class'=>'hourlyMachineId']) !!}
					{!! Form::hidden("stdCtp10",$key['stdCtp10'],['class'=>'stdCtp10']) !!}
					{!! Form::hidden("stdCtm10",$key['stdCtm10'],['class'=>'stdCtm10']) !!}
					{!! Form::hidden("stdWtp10",$key['stdWtp10'],['class'=>'stdWtp10']) !!}
					{!! Form::hidden("stdWtm10",$key['stdWtm10'],['class'=>'stdWtm10']) !!}

					{!! Form::hidden("stdWt",$key['stdWt'],['class'=>'stdWt']) !!}
					{!! Form::hidden("stdCt",$key['stdCt'],['class'=>'stdCt']) !!}
										
					<tr id="{!! $key['id'] !!}">
						<td class="sr_no">{!! ++$count !!}</td>
						<td>
						{!! Form::text("machine",$key['machine'],array('class' => 'form-control hourlyMachine','placeholder'=>'Machine','id'=>'machine_'.$key["id"],'readonly'=>true)) !!}
						</td>
						<td>
						{!! Form::text("product",$key['product'],array('class' => 'form-control hourlyProduct','placeholder'=>'Product','id'=>'product_'.$key["id"],'readonly'=>true,"rel"=>$key['productId'])) !!}
						</td>

						<td>
						{!! Form::text("cycleTime[".$key['id']."]",$key['cycleTime'],array('class' => 'form-control cycleTime','placeholder'=>'Cycle Time','id'=>'cycleTime_'.$key["id"],'maxlength'=>5)) !!}
						</td>
						
						<td>
						{!! Form::text("cavityBlock[".$key['id']."]",$key['cavityBlock'],array('class' => 'form-control cavityBlock','placeholder'=>'Cavity Blocks','id'=>'cavityBlock_'.$key['id'],'maxlength'=>5)) !!}
						</td>

						<td>
						{!! Form::text("averageWt[".$key['id']."]",$key['averageWt'],array('class' => 'form-control averageWt','placeholder'=>'Average Weight','id'=>'averageWt_'.$key['id'],'maxlength'=>7)) !!}
						</td>
						
						<td style="text-align:center;">
						@if($readOnly)
							{!! Form::checkbox("isCompleted[".$key['id']."]", 'Y', true,['class'=>'isCompleted','id' => "isCompleted_".$key['id'],'disabled'=>true]) !!}
						@elseif($key['isCompleted'] == 'Y')
							{!! Form::checkbox("isCompleted[".$key['id']."]", 'Y', true,['class'=>'isCompleted','id' => "isCompleted_".$key['id']]) !!}
						@else
						{!! Form::checkbox("isCompleted[".$key['id']."]", 'Y', false,['class'=>'isCompleted','id'=>"isCompleted_".$key['id']]) !!}
						@endif
						</td>
					</tr>
					@endforeach	
				</tbody>
			</table>
			@endif
		</div>							
	</div>
	<!-- action wrapper -->
	<div class="form-group action">
	<?php //if(! $readOnly) {?>
		<div class="col-lg-12 pull-center buttons"> 
			{!! Form::button('Save', array('class' => 'btn btn-red','onclick'=>'return validateHourlyData()')) !!}
			{!! Form::button('Save & Complete', array('class' => 'btn btn-red','onclick'=>'return validateAllHourlyData()')) !!}
		</div>
	<?php //} ?>
	</div>
	</div>
</div>
{!! Form::close() !!}
@else
<div class="{!! $result['class'] !!}">{!! $result['data'] !!}</div>
@endif
<script>
$(".cycleTime,.cavityBlock,.averageWt").ForceNumericOnly();
function validateHourlyData () {
	var errors = [];
	var errors1 = [];
	var stdCtp = []; var stdCtm = []; var stdWtp = []; var stdwtm = [];
	var checkedCount = 0, totalMachine = 0;
	var msg = '';
	$('.isCompleted').each(function (index) {
		totalMachine = totalMachine + 1;
	    var id = $(this).attr('id');
	    if($('#' + id).is(":checked")){

	    	checkedCount = checkedCount + 1;
	    	// check for all values
            var cycleTime = $(".cycleTime:eq(" + index + ")").val();
            var cycleTimep10 = $(".stdCtp10:eq(" + index + ")").val();
            var cycleTimem10 = $(".stdCtm10:eq(" + index + ")").val();
            var cavityBlock = $(".cavityBlock:eq(" + index + ")").val();
	    	var averageWt = $(".averageWt:eq(" + index + ")").val();
	    	var averageWtp10 = $(".stdWtp10:eq(" + index + ")").val();
	    	var averageWtm10 = $(".stdWtm10:eq(" + index + ")").val();
	    	if(cycleTime  == '' || cavityBlock == '' || averageWt == ''){
	    		errors.push(index);
	    	}
	    }
	});
	if(errors.length > 0){
		jAlert("Please fill all the required fields.");
	}else if(errors1.length > 0){
	    jAlert("Type of packing can't be same. Please cross check all record at row "+ errors1.toString());
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
		    		saveHourlyEntryData();
		        }
		    });
		}else{
    		saveHourlyEntryData();
		}
		
	}
	return false;
}

function saveHourlyEntryData () {
	var data = "[";
	$('.isCompleted').each(function (index) {
        if (index != 0) data += ',';
        if($(this).is(":checked"))
    	    var isCompleted = 'Y';
    	else
    	    var isCompleted = 'N';

    	var machine = $(".hourlyMachineId:eq(" + index + ")").val();
    	var product = $(".hourlyProductId:eq(" + index + ")").val();
    	var hourlyDetailId = $(".hourlyDetail:eq(" + index + ")").val();
    	var cycleTime = $(".cycleTime:eq(" + index + ")").val();
    	var cavityBlock = $(".cavityBlock:eq(" + index + ")").val();
    	var averageWt = $(".averageWt:eq(" + index + ")").val();
        data += '{"hourlyDetailId":"'+hourlyDetailId+'","isCompleted":"'+isCompleted+'","cycleTime":"'+cycleTime+'","cavityBlock":"'+cavityBlock+'","averageWt":"'+averageWt+'"}';
    });
    data += ']';
	
    var postdata = 'hourlyEntryId='+$('#hourlyEntryId').val()+'&houryEntryCompleted='+$("#houryEntryCompleted").val()+'&hourlyEntry=' + data;
    
    $.ajax({
        url: base_url+"/hourlyEntry/save-hourly-entry-data",
        type: 'post',
        data: postdata,
        beforeSend: function (arr, $form, options) {
           	$('#preloader').show();
   			$('#background-loader').show();
        },
        	complete: function () {
		
        },
        success: function (data) {
			$('#preloader').hide();
   			$('#background-loader').hide();
   			if(data.success == 1)
   			{
   				window.location.href = base_url+"/hourlyEntry"
   			}else{
   				jAlert(data.data)
   			}
        },
        error: function () {
			$("#savingBtn").hide();
            $("#saveBtn").show();
            $("#errorMsg").html('It seems our server is busy at this moment. Please try again after sometime.').show();
        }
    });
}

function validateAllHourlyData () {
	var errors = [];
	var errors1 = [];
	var checkedCount = 0, totalMachine = 0;
	var msg = '';
	$('.isCompleted').each(function (index) {
		totalMachine = totalMachine + 1;
	    var id = $(this).attr('id');
	    if($('#' + id).is(":checked")){
	    	checkedCount = checkedCount + 1;
	    	
	    	// check for all values
            var cycleTime = $(".cycleTime:eq(" + index + ")").val();
            var cavityBlock = $(".cavityBlock:eq(" + index + ")").val();
	    	var averageWt = $(".averageWt:eq(" + index + ")").val();
	    	if(cycleTime  == '' || cavityBlock == '' || averageWt == ''){
	    		errors.push(index);
	    	}
	    }else{
	    	errors.push(index);
	    }
	});
	if(errors.length > 0){
		jAlert("Please fill all the required fields.");
	}else if(errors1.length > 0){
	    jAlert("Type of packing can't be same. Please cross check all record at row "+ errors1.toString());
	}else{
		msg = 'You clicked on Save & Complete. You will not able to edit this entry. Do you want to continue?';
		if(msg != ''){
			jConfirm(msg, '', function(r) {
		        if (r) {
		        	$('#houryEntryCompleted').val('Y');
		    		saveHourlyEntryData();
		        }
		    });
		}
		
	}
	return false;
}
	
$(document).ready(function (){
	
	$('.isCompleted').change(function() {
	    if($(this).is(":checked")) {
	        var index = $('.isCompleted').index(this);
	        var machine = $(".hourlyMachine:eq(" + index + ")").val();
	        var product = $(".hourlyProduct:eq(" + index + ")").val();
	        var cycleTime = $(".cycleTime:eq(" + index + ")").val();
	    	var cavityBlock = $(".cavityBlock:eq(" + index + ")").val();
	    	var averageWt = $(".averageWt:eq(" + index + ")").val();
	    	var averageWtp10 = $(".stdWtp10:eq(" + index + ")").val();
	    	var averageWtm10 = $(".stdWtm10:eq(" + index + ")").val();
	    	var cycleTimep10 = $(".stdCtp10:eq(" + index + ")").val();
            var cycleTimem10 = $(".stdCtm10:eq(" + index + ")").val();
             var stdCt = $(".stdCt:eq(" + index + ")").val();
            var stdWt = $(".stdWt:eq(" + index + ")").val();
	    	if(cycleTime  == '' || cavityBlock == '' || averageWt == ''){
	    		$(this).attr('checked',false);
	    		jAlert("Can not marked it as checked. Please fill required fields.");
	    	}
	    	if((parseFloat(cycleTime) < parseFloat(cycleTimem10)) && (parseFloat(averageWt) < parseFloat(averageWtm10))){
	    		jAlert("Entered cycle time & average weight are less than 10% of standard values.<br>Standard cycle time : "+stdCt+"<br>Standard Weight : "+stdWt);
	    	}
	    	else if((parseFloat(cycleTime) > parseFloat(cycleTimep10)) && (parseFloat(averageWt) > parseFloat(averageWtp10))){
	    		jAlert("Entered cycle time & average weight are greater than 10% of standard values.<br>Standard cycle time : "+stdCt+"<br>Standard Weight : "+stdWt);
	    	}
	    	else if((parseFloat(cycleTime) > parseFloat(cycleTimep10)) && (parseFloat(averageWt) < parseFloat(averageWtm10))){
	    		jAlert("Entered cycle time is greater than 10% of standard cycle time and average weight is less than 10% of standard weight.<br>standard cycle time : "+stdCt+"<br>Standard Weight : "+stdWt);
	    	}
	    	else if((parseFloat(cycleTime) < parseFloat(cycleTimem10)) && (parseFloat(averageWt) > parseFloat(averageWtp10))){
	    		jAlert("Entered cycle time is less than 10% of standard cycle time and average weight is greater than 10% of standard weight.<br>standard cycle time : "+stdCt+"<br>Standard Weight : "+stdWt);
	    	}
			else if(parseFloat(cycleTime) < parseFloat(cycleTimem10)){
	    		jAlert("Entered cycle time is less than 10% of standard cycle time.<br>Standard cycle time : "+stdCt);
	    	}
	    	else if(parseFloat(cycleTime) > parseFloat(cycleTimep10)){
	    		jAlert("Entered cycle time is greater than 10% of standard cycle time.<br>Standard cycle time : "+stdCt);
	    	}
	    	else if(parseFloat(averageWt) < parseFloat(averageWtm10)){
	    		jAlert("Entered average weight is less than 10% of standard weight.<br>Standard weight : "+stdWt);
	    	}
	    	else if(parseFloat(averageWt) > parseFloat(averageWtp10)){
	    		jAlert("Entered average weight is greater than 10% of standard weight.<br>Standard weight : "+stdWt);
	    	}

    	}else{

    	}     
	});
})
</script>
