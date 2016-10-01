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
<?php //echo "<pre>";
//print_r($result); exit;?>
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
						<th width="20%">Product</th>
						<th width="8%">Production Quantity</th>
						<th width="10%">Box Type<small class="mandatory"> *</small></th>
						<th width="10%">Type Of Packing<small class="mandatory"> *</small></th>
						<th width="8%">Quantity Per Box</th>
						<th width="8%">Box Received<small class="mandatory"> *</small></th>
						<th width="10%">Quantity Received</th>
						<th width="6%">Partial Quantity</th>
						<th >Done</th>
						@if(!$readOnly)
						<th width="8%" class="center" >Action</th>
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
						{!! Form::text("machine[".$key['id']."]",$key['machine'],array('class' => 'form-control invertMachine','placeholder'=>'Machine','id'=>'machine_'.$key["id"],'readonly'=>true)) !!}
						</td>
						<td>
						{!! Form::text("product[".$key['id']."]",$key['product'],array('class' => 'form-control invertProduct','placeholder'=>'Product','id'=>'product_'.$key["id"],'readonly'=>true,"rel"=>$key['productId'])) !!}
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
						{!! Form::select("typeOfPacking[".$key['id']."]",$key['typeOfPackingList'],$key['typeOfPacking'],['id'=>'typeOfPacking_'.$key['id'],'class'=>'form-control typeOfPackingClass','onchange'=>'getQtyPerBox(this.value,'.$key["id"].')']) !!}			
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

						<td>
						{!! Form::text("partialQuantity[".$key['id']."]",$key['partialQuantity'],array('class' => 'form-control partialQuantity','placeholder'=>'Partial Quantity','id'=>'partialQuantity_'.$key['id'],'maxlength'=>5,'onblur'=>'checkPartialQty('.$key["id"].')')) !!}
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
	var errors1 = [];
	var errors2 = [];
	
	var checkedCount = 0, totalMachine = 0;
	var msg = '';
	$('.isCompleted').each(function (index) {
		totalMachine = totalMachine + 1;
	    var id = $(this).attr('id');
	    if($('#' + id).is(":checked")){

	    	checkedCount = checkedCount + 1;
	    	// check for all values
            var typeOfBox = $(".typeOfBoxClass:eq(" + index + ")").val();
            var typeOfPackingClass = $(".typeOfPackingClass:eq(" + index + ")").val();
	    	var quantityPerBox = $(".quantityPerBox:eq(" + index + ")").val();
	    	var boxReceived = $(".boxReceived:eq(" + index + ")").val();
	    	var qtyReceive = $(".qtyReceiveClass:eq(" + index + ")").val();
	    	 var machine = $(".invertMachine:eq(" + index + ")").val();
	        var product = $(".invertProduct:eq(" + index + ")").val();
	        var partialQuantity = $(".partialQuantity:eq(" + index + ")").val();
	    	if(typeOfBox  == '' || quantityPerBox == '' || boxReceived == '' || qtyReceive == '' || typeOfPackingClass == '' || partialQuantity == ''){
	    		console.log('Error push');
	    		errors.push(index);
	    	}else if(parseFloat(qtyReceive) < parseFloat(partialQuantity)){
	    		errors2.push(parseInt(index)+1);
    		}else{
	    		var previousMachine = $(".invertMachine:eq(" + (parseInt(index) - 1) + ")").val();
	    		var previousProduct = $(".invertProduct:eq(" + (parseInt(index) - 1) + ")").val();
	    		var previousBoxType = $(".typeOfBoxClass:eq(" + (parseInt(index) - 1) + ")").val();
	    		var previousTypeOfPacking = $(".typeOfPackingClass:eq(" + (parseInt(index) - 1) + ")").val();
	    		if(previousMachine == machine && previousProduct == product && previousBoxType == typeOfBox && previousTypeOfPacking == typeOfPackingClass){
	    			errors1.push(index);
	    		}
	    	}
	    }else if(parseFloat(qtyReceive) < parseFloat(partialQuantity)){
    		errors2.push(parseInt(index)+1);
    	}else{
	    	var typeOfBox = $(".typeOfBoxClass:eq(" + index + ")").val();
            var typeOfPackingClass = $(".typeOfPackingClass:eq(" + index + ")").val();
	    	var machine = $(".invertMachine:eq(" + index + ")").val();
	        var product = $(".invertProduct:eq(" + index + ")").val();
	    	
    		var previousMachine = $(".invertMachine:eq(" + (parseInt(index) - 1) + ")").val();
    		var previousProduct = $(".invertProduct:eq(" + (parseInt(index) - 1) + ")").val();
    		var previousBoxType = $(".typeOfBoxClass:eq(" + (parseInt(index) - 1) + ")").val();
    		var previousTypeOfPacking = $(".typeOfPackingClass:eq(" + (parseInt(index) - 1) + ")").val();
    		if(previousMachine == machine && previousProduct == product && previousBoxType == typeOfBox && previousTypeOfPacking == typeOfPackingClass){
    			errors1.push(parseInt(index) + 1);
    		}
	    }
	});
	if(errors.length > 0){
		jAlert("Please fill all the required fields.");
	}else if(errors1.length > 0){
	    jAlert("Type of packing can't be same. Please cross check all record at row "+ errors1.toString());
	}else if(errors2.length > 0){
		jAlert("Partial Quantity should be less than quantity per box at row "+errors2.toString());
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
	var errors1 = [];
	var errors2 = [];
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
            var machine = $(".invertMachine:eq(" + index + ")").val();
	        var product = $(".invertProduct:eq(" + index + ")").val();
            var typeOfPacking = $(".typeOfBoxClass:eq(" + index + ")").val();
            var typeOfPackingClass = $(".typeOfPackingClass:eq(" + index + ")").val();
	    	var quantityPerBox = $(".quantityPerBox:eq(" + index + ")").val();
	    	var boxReceived = $(".boxReceived:eq(" + index + ")").val();
	    	var qtyReceive = $(".qtyReceiveClass:eq(" + index + ")").val();
	    	var partialQuantity = $(".partialQuantity:eq(" + index + ")").val();

	    	if(typeOfBox  == '' || quantityPerBox == '' || boxReceived == '' || qtyReceive == '' || typeOfPackingClass == '' || partialQuantity == ''){
	    		errors.push(index);
	    	}else if(parseFloat(qtyReceive) < parseFloat(partialQuantity)){
	    		errors2.push(parseInt(index)+1);
    		}else{
	    		var previousMachine = $(".invertMachine:eq(" + (parseInt(index) - 1) + ")").val();
	    		var previousProduct = $(".invertProduct:eq(" + (parseInt(index) - 1) + ")").val();
	    		var previousBoxType = $(".typeOfBoxClass:eq(" + (parseInt(index) - 1) + ")").val();
	    		var previousTypeOfPacking = $(".typeOfPackingClass:eq(" + (parseInt(index) - 1) + ")").val();
	    		if(previousMachine == machine && previousProduct == product && previousBoxType == typeOfBox && previousTypeOfPacking == typeOfPackingClass){
	    			errors1.push(parseInt(index)+1);
	    		}
	    	}
	    }else{
	    	errors.push(index);
	    }
	});
	if(errors.length > 0){
		jAlert("Please fill all the required fields.");
	}else if(errors1.length > 0){
	    jAlert("Type of packing can't be same. Please cross check all record at row "+ errors1.toString());
	}else if(errors2.length > 0){
		jAlert("Partial Quantity should be less than quantity per box at row "+errors2.toString());
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

function getQtyPerBox (typeOfPacking,index,productId) {
	if(typeof productId == 'undefined'){
		var productId = $("#productId_"+index).val();
	}else{
		var productId = productId;
	}
	var typeOfBox = $("#typeOfBox_"+index).val();

	$.ajax({
        url : base_url+"/invert/get-quantity-per-box",
        method : "POST",
        data : { 'typeOfBox' : typeOfBox,'productId' : productId ,'typeOfPacking' : typeOfPacking},
        cache : false,
        beforeSend : function(){
            $("#loading1_"+index).show();
        },
        success:function(data){
            if(data.success == 1){
                $("#quantityPerBox_"+index).val(data.data);
				$('#boxReceived_'+index).trigger('keyup');

            }else{
                alert(data.data)
            }
            $("#loading1_"+index).hide();
        },
        done : function (data){
            $("#loading1_"+index).hide(); 
        },
        fail :function () {
            $("#loading_"+index).hide(); 
            alert("error")
        }
    });
}

function getTypeOfPacking (typeOfBox,index,productId) {
	if(typeof productId == 'undefined'){
		var productId = $("#productId_"+index).val();
	}else{
		var productId = productId;
	}
	if(typeOfBox == ''){
		$('#typeOfPacking_'+index).html('');
		
		$('#typeOfPacking_'+index).append($("<option/>", {
	        value: '',
	        text: 'Select'
	    }));
	    $("#quantityPerBox_"+index).val('');
	    $("#boxReceived_"+index).val('');
	    $("#quantityReceived_"+index).val('');
	}else{
		$.ajax({
	        url : base_url+"/invert/get-type-of-packing",
	        method : "POST",
	        data : { 'typeOfBox' : typeOfBox,'productId' : productId },
	        cache : false,
	        beforeSend : function(){
	            $("#loading_"+index).show();
	        },
	        success:function(data){
	            if(data.success == 1){
	            	if(data.data.length > 0){
	            		var alreadyValue = $('#typeOfPacking_'+index).val();
	            		$('#typeOfPacking_'+index).html('');
	            		if(data.data.length == 1){
	            			$.each(data.data, function(key, value) { 
							    $('#typeOfPacking_'+index).append($("<option/>", {
							        value: value.id,
							        text: value.typeOfPacking
							    }));
							});
	                		$("#quantityPerBox_"+index).val(data.data[0].qtyPerBox);
							$('#boxReceived_'+index).trigger('keyup');
	            		}else{
	            			$('#typeOfPacking_'+index).append($("<option/>", {
						        value: '',
						        text: 'Select'
						    }));

	            			$.each(data.data, function(key, value) { 
							    $('#typeOfPacking_'+index).append($("<option/>", {
							        value: value.id,
							        text: value.typeOfPacking
							    }));
							});						
	            		}
	            	}
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
		        var machine = $(".invertMachine:eq(" + index + ")").val();
	        	var product = $(".invertProduct:eq(" + index + ")").val();
		        var typeOfBox = $(".typeOfBoxClass:eq(" + index + ")").val();
		        var typeOfPackingClass = $(".typeOfPackingClass:eq(" + index + ")").val();
		    	var quantityPerBox = $(".quantityPerBox:eq(" + index + ")").val();
		    	var boxReceived = $(".boxReceived:eq(" + index + ")").val();
		    	var qtyReceive = $(".qtyReceiveClass:eq(" + index + ")").val();
		    	var partialQuantity = $(".partialQuantity:eq(" + index + ")").val();
		    	if(qtyReceive  == '' || typeOfBox == '' || quantityPerBox == '' || boxReceived == '' || typeOfPackingClass == '' || partialQuantity == ''){
		    		$(this).attr('checked',false);
		    		jAlert("Can not marked it as checked. Please fill required fields.");
		    	}else if(parseFloat(qtyReceive) < parseFloat(partialQuantity)){
					jAlert("Partial Quantity should be less than quantity per box.");
	    		}else{
	    			if(index != "0"){
			    		var previousMachine = $(".invertMachine:eq(" + (parseInt(index) - 1) + ")").val();
			    		var previousProduct = $(".invertProduct:eq(" + (parseInt(index) - 1) + ")").val();
			    		var previousBoxType = $(".typeOfBoxClass:eq(" + (parseInt(index) - 1) + ")").val();
			    		var previousTypeOfPacking = $(".typeOfPackingClass:eq(" + (parseInt(index) - 1) + ")").val();
			    		console.log("machine " + machine + " "+ previousMachine);
			    		console.log("product "+product + " "+ previousProduct);
			    		console.log("typeOfBox "+typeOfBox + " "+ previousBoxType);
			    		console.log("typeOfPackingClass "+typeOfPackingClass + " "+ previousTypeOfPacking);
			    		if(previousMachine == machine && previousProduct == product && previousBoxType == typeOfBox && previousTypeOfPacking == typeOfPackingClass){
			    			$(this).attr('checked',false);
			    			jAlert("Can not marked it as checked. Type of packing can't be same.");
			    		}
			    	}
		    	}
	    	}      
		});
		updateBeerCount();
	}
});	

$(document).ready(function (){
	$(".typeOfBoxClass").each(function (index){
		var id = $(this).attr('id');
		var length = $('select#'+id+' option').length;
		var value = $(this).val();
		if(value == ''){
			if(length == 2){
				$('#'+id+' option:eq(1)').attr('selected', 'selected');
				$("#"+id).trigger('onchange');
			}
		}
		
	})
	$('.isCompleted').change(function() {
	    if($(this).is(":checked")) {
	        var index = $('.isCompleted').index(this);
	        var machine = $(".invertMachine:eq(" + index + ")").val();
	        var product = $(".invertProduct:eq(" + index + ")").val();
	        var typeOfBox = $(".typeOfBoxClass:eq(" + index + ")").val();
	    	var quantityPerBox = $(".quantityPerBox:eq(" + index + ")").val();
	    	var typeOfPackingClass = $(".typeOfPackingClass:eq(" + index + ")").val();
	    	var boxReceived = $(".boxReceived:eq(" + index + ")").val();
	    	var qtyReceive = $(".qtyReceiveClass:eq(" + index + ")").val();
	    	var partialQuantity = $(".partialQuantity:eq(" + index + ")").val();
	    	if(qtyReceive  == '' || typeOfBox == '' || quantityPerBox == '' || boxReceived == '' || typeOfPackingClass == '' || partialQuantity == ''){
	    		$(this).attr('checked',false);
	    		jAlert("Can not marked it as checked. Please fill required fields.");
	    	}else if(parseFloat(qtyReceive) < parseFloat(partialQuantity)){
				jAlert("Partial Quantity should be less than quantity per box.");
	    	}else{
	    		if(index != "0"){
	    			var previousMachine = $(".invertMachine:eq(" + (parseInt(index) - 1) + ")").val();
		    		var previousProduct = $(".invertProduct:eq(" + (parseInt(index) - 1) + ")").val();
		    		var previousBoxType = $(".typeOfBoxClass:eq(" + (parseInt(index) - 1) + ")").val();
		    		var previousTypeOfPacking = $(".typeOfPackingClass:eq(" + (parseInt(index) - 1) + ")").val();
		    		if(previousMachine == machine && previousProduct == product && previousBoxType == typeOfBox && previousTypeOfPacking == typeOfPackingClass){
		    			$(this).attr('checked',false);
		    			jAlert("Can not marked it as checked. Type of packing can't be same.");
		    		}
	    		}
	    	}

    	}else{

    	}     
	});
})
function generateData (id) {
	var html = 
		'<tr id="'+indexing+'">'+
			'<td class="sr_no">1</td>'+
			'<td>'+
				'<input type="text" value="'+$("#machine_"+id).val()+'" name="machine['+indexing+']" readonly="1" id="machine_'+indexing+'" placeholder="Machine" class="form-control invertMachine">'+
			'</td>'+
			'<td>'+
				'<input type="text" value="'+$("#product_"+id).val()+'" name="product['+indexing+']" readonly="1" id="product_'+indexing+'" placeholder="Product" class="form-control invertProduct" rel="'+$("#product_"+id).attr("rel")+'">'+
			'</td>' +
			'<td>' +
				'<input type="text" value="'+$("#productionueQuantity_"+id).val()+'" name="productionQuantity['+indexing+']" readonly="1" maxlength="10" id="productionueQuantity_'+indexing+'" placeholder="Production Quantity" class="form-control productionQuantity">'+
			'</td>'+
			'<td>'+
				'<select name="typeOfBox['+indexing+']" onchange="getTypeOfPacking(this.value,'+indexing+','+$("#product_"+id).attr("rel")+')" class="form-control typeOfBoxClass" id="typeOfBox_'+indexing+'">';
				$("#typeOfBox_"+id+" option").each(function()
				{
					html += '<option value="'+$(this).val()+'">'+$(this).text()+'</option>';
				});
			html += '</select>'+
				'<div style="display:none" class="error validationAlert validationError" id="loading_'+indexing+'">Loading....</div>'+
			'</td>'+
			'<td>' +
				'<select name="typeOfPacking['+indexing+']" onchange="getQtyPerBox(this.value,'+indexing+','+$("#product_"+id).attr("rel")+')" class="form-control typeOfPackingClass" id="typeOfPacking_'+indexing+'">';
				$("#typeOfPacking_"+id+" option").each(function()
				{
					html += '<option value="'+$(this).val()+'">'+$(this).text()+'</option>';
				});
				html += '</select>'+
				'<div style="display: none;" class="error validationAlert validationError" id="loading1_'+indexing+'">Loading....</div>'+
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
			'<td>'+
				'<input type="text" name="partialQuantity['+indexing+']" readonly="1" id="partialQuantity_'+indexing+'" placeholder="Partial Quantity" class="form-control partialQuantity">'+
			'</td>'+
			'<td style="text-align:center;">'+
				'<input type="checkbox" value="Y" name="isCompleted['+indexing+']" id="isCompleted_'+indexing+'" class="isCompleted">'+
			'</td>'+						 
			'<td align="right" class="add-more-btn">'+
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

function checkPartialQty (id) {
	var partialQuantity = $("#partialQuantity_"+id).val();
	var qtyPerBox = $("#quantityPerBox_"+id).val();

	if(qtyPerBox == ''){
		$("#partialQuantity_"+id).val(0);
		jAlert("Please enter quantity per box first.");
		return false;
	}else{
		if(parseFloat(partialQuantity) > parseFloat(qtyPerBox)){
			jAlert("Partial Quantity should be less than quantity per box.");
			$("#partialQuantity_"+id).focus();
			return false;
		}
	}
}

<?php if($result['success']) { ?>
$("#shift").attr('disabled',true);
$("#date").attr('disabled',true);
$("#saveButton").attr('disabled',true);
<?php } ?>
</script>
