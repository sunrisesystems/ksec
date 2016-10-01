<div class="pageTableHeading">
	<div class="row ">			
		<div class="page-title">			
			<div class="col-lg-12">
				<h3 class="page-header">FG Return Slip</h3>					
			</div>							
		</div>			
	</div>
</div><!-- pageTableHeading end -->
@if($result['success'])
{!! Form::open(['url' => 'invert/save-invert-data','id'=>'invertEntryForm']) !!}
<div class="row">
	<div class="form-control-wrapper col-md-12" >
		<div class="form-group table-big">
			@if(!empty($result['data']))
			<?php $count = 0; 
			if($result['isCompleted'] == 'Y')
				$readOnly = true;
			else
				$readOnly = false;
			?>
			<table class="table table-bordered" id="invertTable">
				<thead>
					<tr>
						<th>#</th>
						<th >Machine</th>
						<th >Product</th>
						<th >Production Quantity</th>
						<th>Box Type<small class="mandatory"> *</small></th>
						<th >Type Of Packing<small class="mandatory"> *</small></th>
						<th >Quantity Per Box</th>
						<th >Box Received<small class="mandatory"> *</small></th>
						<th >Quantity Received</th>
						<th >Done</th>
						@if(!$readOnly)
						<th class="center">Action</th>
						@endif
					</tr>
				</thead>
				<tbody class="input_fields_wrap">
					{!! Form::hidden("invert",$result['invertId'],array('class' => 'form-control','placeholder'=>'Machine','id'=>'invert','readonly'=>true)) !!}

					{!! Form::hidden("invertCompleted",$result['isCompleted'],array('class' => 'form-control','placeholder'=>'Machine','id'=>'invertCompleted','readonly'=>true)) !!}

					@foreach($result['data'] as $key)
					{!! Form::hidden("invertDetail[]",$key['id'],array('id'=>'invert_detail_'.$key["id"])) !!}
					{!! Form::hidden("productId[".$key['id']."]",$key['productId'],array('id'=>'productId_'.$key["id"])) !!}
					{!! Form::hidden("machineId[".$key['id']."]",$key['machineId'],array('id'=>'machineId_'.$key["id"])) !!}
					<tr id="{!! $key['id'] !!}">
						<td class="sr_no">{!! ++$count !!}</td>
						<td>
						{!! Form::text("machine[".$key['id']."]",$key['machine'],array('class' => 'form-control','placeholder'=>'Machine','id'=>'machine_'.$key["id"],'readonly'=>true)) !!}
						</td>
						<td>
						{!! Form::text("product[".$key['id']."]",$key['product'],array('class' => 'form-control','placeholder'=>'Product','id'=>'product_'.$key["id"],'readonly'=>true,"rel"=>$key['productId'])) !!}
						</td>

						<td>
						{!! Form::text("productionQuantity[".$key['id']."]",$key['productionQuantity'],array('class' => 'form-control productionQuantity','placeholder'=>'Production Quantity','id'=>'productionueQuantity_'.$key["id"],'maxlength'=>10,'readonly'=>true)) !!}
						</td>

						<td>
						<?php if($readOnly) {?>
						{!! Form::text("typeOfBox[".$key['id']."]",$key['boxType'][$key['typeOfBox']],array('class' => 'form-control typeOfBoxClass','placeholder'=>'Short Counter','id'=>'typeOfBox_'.$key['id'],'maxlength'=>10,'readonly'=>true)) !!}
						<?php } else { 
							 $r = $key["productId"];?>
							{!! Form::select("typeOfBox[".$key['id']."]",$key['boxType'],$key['typeOfBox'],['id'=>'typeOfBox_'.$key['id'],'class'=>'form-control typeOfBoxClass','onchange'=>'getTypeOfPacking(this.value,'.$key["id"].')']) !!}			
						<?php } ?>
						<div id="loading_{!! $key['id'] !!}" class="error validationAlert validationError" style="display:none">Loading....</div>
						</td>
						<td>
						{!! Form::select("typeOfPacking[".$key['id']."]",$key['typeOfPacking'],$key['typeOfPacking'],['id'=>'typeOfPacking_'.$key['id'],'class'=>'form-control typeOfPackingClass','onchange'=>'getQtyPerBox(this.value,'.$key["id"].')']) !!}			
						<div id="loading1_{!! $key['id'] !!}" class="error validationAlert validationError" style="display:none">Loading....</div>
						</td>
						<td>
						{!! Form::text("quantityPerBox[".$key['id']."]",$key['quantityPerBox'],array('class' => 'form-control quantityPerBox','placeholder'=>'Quantity Per Box','id'=>'quantityPerBox_'.$key['id'],'readonly'=>true)) !!}
						</td>
						<td>
						<?php if($readOnly) {?>
							{!! Form::text("boxReceived[".$key['id']."]",$key['boxReceived'],array('class' => 'form-control boxReceived','placeholder'=>'Box Received','id'=>'boxReceived_'.$key['id'],'maxlength'=>3,'readonly'=>true,'onkeyup'=>'getQuantityRecieved(this.value,'.$key["id"].')')) !!}
						<?php } else { ?>
							{!! Form::text("boxReceived[".$key['id']."]",$key['boxReceived'],array('class' => 'form-control boxReceived','placeholder'=>'Box Received','id'=>'boxReceived_'.$key['id'],'maxlength'=>3,'onkeyup'=>'getQuantityRecieved(this.value,'.$key["id"].')')) !!}
						<?php } ?>
						</td>

						<td>
						{!! Form::text("quantityReceived[".$key['id']."]",$key['quantityReceived'],array('class' => 'form-control qtyReceiveClass','placeholder'=>'Quantity Received','id'=>'quantityReceived_'.$key['id'],'readonly'=>true)) !!}
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
						@if(! $readOnly) 
						<td class="	add-more-btn" align="center">
							<span><a href="javascript:void(0)" class="add_field_buttonDT btn btn-default"><i class="glyphicon glyphicon-plus add-row"></i></a></span>
							<span><a href="javascript:void(0)" class="remove_field_buttonDT btn btn-default"><i class="glyphicon glyphicon-minus remove-row"></i></a></span>
						</td>
						@endif
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
			{!! Form::button('Save', array('class' => 'btn btn-red','onclick'=>'return validateInvertData()')) !!}
			{!! Form::button('Save & Complete', array('class' => 'btn btn-red','onclick'=>'return validateAllInvertData()')) !!}
		</div>
	<?php } ?>
	</div>
	</div>
</div>
{!! Form::close() !!}
@else
<div class="{!! $result['class'] !!}">{!! $result['data'] !!}</div>
@endif
<script>
$(".boxReceived").ForceNumericOnly();
var wrapperDT         = $(".input_fields_wrap"); //Fields wrapper
var max_fields      = 50; //maximum input boxes allowed
var add_buttonDT     = $(".add_field_buttonDT"); //Add button ID
var x = 1, indexing = -1; //initlal text box count
var noOfRows = '{!! count(@$result["data"])!!}';

function validateInvertData () {
	var errors = [];
	var checkedCount = 0, totalMachine = 0;
	var msg = '';
	$('.isCompleted').each(function (index) {
		totalMachine = totalMachine + 1;
	    var id = $(this).attr('id');
	    if($('#' + id).is(":checked")){
	    	checkedCount = checkedCount + 1;
	    	// check for all values
            var typeOfBox = $(".typeOfBoxClass:eq(" + index + ")").val();
	    	var quantityPerBox = $(".quantityPerBox:eq(" + index + ")").val();
	    	var boxReceived = $(".boxReceived:eq(" + index + ")").val();
	    	var qtyReceive = $(".qtyReceiveClass:eq(" + index + ")").val();

	    	if(typeOfBox  == '' || quantityPerBox == '' || boxReceived == '' || qtyReceive == ''){
	    		errors.push(index);
	    	}
	    }
	});
	if(errors.length > 0){
		jAlert("Please fill all the required fields.");
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
		    		$('#invertEntryForm').submit();
		        }
		    });
		}else{
			$('#invertEntryForm').submit();
		}
		
	}
	return false;
}

function validateAllInvertData () {
	var errors = [];
	var checkedCount = 0, totalMachine = 0;
	var msg = '';
	$('.isCompleted').each(function (index) {
		totalMachine = totalMachine + 1;
	    var id = $(this).attr('id');
	    if($('#' + id).is(":checked")){
	    	checkedCount = checkedCount + 1;
	    	// check for all values 
	    	var index = $('.isCompleted').index(this);
            var typeOfBox = $(".typeOfBoxClass:eq(" + index + ")").val();
	    	var quantityPerBox = $(".quantityPerBox:eq(" + index + ")").val();
	    	var boxReceived = $(".boxReceived:eq(" + index + ")").val();
	    	var qtyReceive = $(".qtyReceiveClass:eq(" + index + ")").val();

	    	if(typeOfBox  == '' || quantityPerBox == '' || boxReceived == '' || qtyReceive == ''){
	    		errors.push(index);
	    	}
	    }else{
	    	errors.push(index);
	    }
	});
	if(errors.length > 0){
		jAlert("Please fill all the required fields.");
	}else{
		msg = 'You clicked on Save & Complete. You will not able to edit this entry. Do you want to continue?';
		if(msg != ''){
			jConfirm(msg, '', function(r) {
		        if (r) {
		        	$('#invertCompleted').val('Y');
		    		$('#invertEntryForm').submit();
		        }
		    });
		}
		
	}
	return false;
}

function getQtyPerBox (typeOfBox,productId,index) {
	$.ajax({
        url : base_url+"/invert/get-quantity-per-box",
        method : "POST",
        data : { 'typeOfBox' : typeOfBox,'productId' : productId },
        cache : false,
        beforeSend : function(){
            $("#loading_"+index).show();
        },
        success:function(data){
            if(data.success == 1){
                $("#quantityPerBox_"+index).val(data.data);
            }else{
                alert(data.data)
            }
            $("#loading_"+index).hide();
        },
        done : function (data){
            $("#loading_"+index).hide(); 
        },
        fail :function () {
            $("#loading_"+index).hide(); 
            alert("error")
        }
    });
}

function getQuantityRecieved (value,index) {

    var quantityPerBox = $("#quantityPerBox_"+index).val();

    var qtyRecieved = '';

    if(value != ''){
    	qtyRecieved = parseInt(value) * parseInt(quantityPerBox);

    }
    $("#quantityReceived_"+index).val(qtyRecieved);
	
}
$(wrapperDT).on("click",".remove_field_buttonDT", function(e){ 
	if(noOfRows >= 0){
		e.preventDefault(); 
		var id = $(this).closest('tr').attr('id');
		$(this).closest('tr').remove(); 
		x--;
		noOfRows-- ;
		$("#invert_detail_"+id).remove();
		$("#productId_"+id).remove();
		$("#machineId_"+id).remove();
	}else{
		e.preventDefault()
	}
	updateBeerCount();

});	

$(wrapperDT).on("click",".add_field_buttonDT", function(e){ 
	e.preventDefault();
	if(noOfRows < max_fields){ //max input box allowed
		x++; //text box increment
		noOfRows++;
		var id = $($(this)).closest('tr').attr('id');
		var data = generateData(id);
		$($(this).closest('tr')).after(data);
		$("#invertEntryForm").append('<input type="hidden" value="'+indexing+'" name="invertDetail[]" id="invert_detail_'+indexing+'">');

		$("#invertEntryForm").append('<input type="hidden" value="'+$("#productId_"+id).val()+'" name="productId['+indexing+']" id="productId_'+indexing+'">');
		$("#invertEntryForm").append('<input type="hidden" value="'+$("#machineId_"+id).val()+'" name="machineId['+indexing+']" id="machineId_'+indexing+'">');
		indexing--;
		$('.isCompleted').change(function() {
		    if($(this).is(":checked")) {
		        var index = $('.isCompleted').index(this);
		        var typeOfBox = $(".typeOfBoxClass:eq(" + index + ")").val();
		    	var quantityPerBox = $(".quantityPerBox:eq(" + index + ")").val();
		    	var boxReceived = $(".boxReceived:eq(" + index + ")").val();
		    	var qtyReceive = $(".qtyReceiveClass:eq(" + index + ")").val();
		    	if(qtyReceive  == '' || typeOfBox == '' || quantityPerBox == '' || boxReceived == ''){
		    		$(this).attr('checked',false);
		    		jAlert("Can not marked it as checked. Please fill required fields.");
		    	}
	    	}      
		});
		updateBeerCount();
	}
});	

$(document).ready(function (){
	$('.isCompleted').change(function() {
	    if($(this).is(":checked")) {
	        var index = $('.isCompleted').index(this);
	        var typeOfBox = $(".typeOfBoxClass:eq(" + index + ")").val();
	    	var quantityPerBox = $(".quantityPerBox:eq(" + index + ")").val();
	    	var boxReceived = $(".boxReceived:eq(" + index + ")").val();
	    	var qtyReceive = $(".qtyReceiveClass:eq(" + index + ")").val();
	    	if(qtyReceive  == '' || typeOfBox == '' || quantityPerBox == '' || boxReceived == ''){
	    		$(this).attr('checked',false);
	    		jAlert("Can not marked it as checked. Please fill required fields.");
	    	}
    	}      
	});
})
function generateData (id) {
	var boxType = '{!! json_encode(@$result["boxTypes"])!!}';
	boxType = jQuery.parseJSON(boxType);
	var html = 
		'<tr id="'+indexing+'">'+
			'<td class="sr_no">1</td>'+
			'<td>'+
				'<input type="text" value="'+$("#machine_"+id).val()+'" name="machine['+indexing+']" readonly="1" id="machine_'+indexing+'" placeholder="Machine" class="form-control">'+
			'</td>'+
			'<td>'+
				'<input type="text" value="'+$("#product_"+id).val()+'" name="product['+indexing+']" readonly="1" id="product_'+indexing+'" placeholder="Product" class="form-control" rel="'+$("#product_"+id).attr("rel")+'">'+
			'</td>' +
			'<td>' +
				'<input type="text" value="'+$("#productionueQuantity_"+id).val()+'" name="productionQuantity['+indexing+']" readonly="1" maxlength="10" id="productionueQuantity_'+indexing+'" placeholder="Production Quantity" class="form-control productionQuantity">'+
			'</td>'+
			'<td>'+
				'<select name="typeOfBox['+indexing+']" onchange="getQtyPerBox(this.value,'+$("#product_"+id).attr("rel")+','+indexing+')" class="form-control typeOfBoxClass" id="typeOfBox_'+indexing+'">'+
					'<option value="">Select</option>';
				
				for(var i in boxType){
					html += '<option value="'+boxType[i]["id"]+'">'+boxType[i]["value"]+'</option>';
				}
			html += '</select>'+
				'<div style="display:none" class="error validationAlert validationError" id="loading_'+indexing+'">Loading....</div>'+
			'</td>'+
			'<td>'+
				'<input type="text" name="quantityPerBox['+indexing+']" readonly="1" id="quantityPerBox_'+indexing+'" placeholder="Quantity Per Box" class="form-control quantityPerBox">'+
			'</td>'+
			'<td>'+
				'<input type="text" name="boxReceived['+indexing+']" onkeyup="getQuantityRecieved(this.value,'+indexing+')" maxlength="3" id="boxReceived_'+indexing+'" placeholder="Box Received" class="form-control boxReceived">'+
			'</td>'+
			'<td>'+
				'<input type="text" name="quantityReceived['+indexing+']" readonly="1" id="quantityReceived_'+indexing+'" placeholder="Quantity Received" class="form-control qtyReceiveClass">'+
			'</td>'+
			'<td style="text-align:center;">'+
				'<input type="checkbox" value="Y" name="isCompleted['+indexing+']" id="isCompleted_'+indexing+'" class="isCompleted">'+
			'</td>'+						 
			'<td align="right" class="col-md-2	add-more-btn">'+
				'<span><a class="add_field_buttonDT btn btn-default" href="javascript:void(0)"><i class="glyphicon glyphicon-plus add-row"></i></a></span>'+
				'<span><a class="remove_field_buttonDT btn btn-default" href="javascript:void(0)"><i class="glyphicon glyphicon-minus remove-row"></i></a></span>'+
			'</td>'+
	'</tr>';
	return html;
}

function updateBeerCount() {
    $(".sr_no").each(function (index) {
        $(this).html(index + 1);
    });
}
</script>
