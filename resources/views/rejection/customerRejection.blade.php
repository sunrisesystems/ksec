<div class="pageTableHeading">
	<div class="row ">			
		<div class="page-title">			
			<div class="col-lg-12">
				<h3 class="page-header">Rejection Details</h3>
			</div>	
			<div class="clear"></div>						
		</div>			
	</div>
</div><!-- pageTableHeading end -->
@if($result['success'])
{!! Form::open(['url' => 'saveRejectionReturn','id'=>'rejectionReturnForm']) !!}
<div class="row">
	<div class="form-control-wrapper col-md-12" >
		<div class="form-group table-responsive panel-body">
			<?php $count = 0; 
			if($result['isCompleted'] == 'Y')
				$readOnly = true;
			else
				$readOnly = false;
			?>
			<table class="table table-bordered" id="rejectionInwardTable">
				<thead>
					<tr>
						<th>#</th>
						<th >Color<small class="mandatory"> *</small></th>
						<th>Qty As Per QC (Kgs)<small class="mandatory"> *</small></th>
						<th>Qty Recieved By Stores (Kgs)<small class="mandatory"> *</small></th>
						<th>Done</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					{!! Form::hidden("rejectionInwardId",$result['rejectionInwardId'],array('class' => 'form-control','id'=>'rejectionInwardId','readonly'=>true)) !!}
					@if(!empty($result['data']))
					@foreach($result['data'] as $key)
					<?php $rowReadonly = false;
					if($key['isCompleted'] == 'Y')
						$rowReadonly = true;?>
					<tr class="rejectionRow">
						<td class="sr_no">{!! ++$count !!}</td>
						<td>
						{!! Form::select('color',$result['color'], $key['color'], ['id'=>'color','class' => 'form-control color','readonly'=>$rowReadonly]) !!}
						</td>
						<td>
						{!! Form::text("qtyAsPerQc",$key['qtyAsPerQc'],array('class' => 'form-control qtyAsPerQc','placeholder'=>'Qty as per QC','maxlength'=>5,'readonly'=>$rowReadonly)) !!}
						</td>
						<td>
						{!! Form::text("qtyRecievedByStore",$key['qtyRecievedByStore'],array('class' => 'form-control qtyRecievedByStore','placeholder'=>'Qty Recieved By Store','maxlength'=>5,'readonly'=>$rowReadonly)) !!}
						</td>
						<td style="text-align:center;">
						@if($readOnly)
							{!! Form::checkbox("isCompleted", 'Y', true,['class'=>'isCompleted','id' => "isCompleted"]) !!}
						@elseif($key['isCompleted'] == 'Y')
							{!! Form::checkbox("isCompleted", 'Y', true,['class'=>'isCompleted','id' => "isCompleted"]) !!}
						@else
						{!! Form::checkbox("isCompleted[".$key['id']."]", 'Y', false,['class'=>'isCompleted','id'=>"isCompleted"]) !!}
						@endif
						</td>
						<td class="add-more-btn" align="center">
							<span><a href="javascript:void(0)" class="add_field_buttonDT btn btn-default"><i class="glyphicon glyphicon-plus add-row"></i></a></span>
							<span><a href="javascript:void(0)" class="add_field_buttonDT btn btn-default"><i class="glyphicon glyphicon-minus remove-row"></i></a></span>
						</td>
					</tr>
					@endforeach	
					@else
					<tr class="rejectionRow">
						<td class="sr_no">{!! ++$count !!}</td>
						<td>
						{!! Form::select('color',$result['color'], null, ['id'=>'color','class' => 'form-control color']) !!}
						</td>
						<td>
						{!! Form::text("qtyAsPerQc",'',array('class' => 'form-control qtyAsPerQc','placeholder'=>'Qty as per QC','maxlength'=>5)) !!}
						</td>
						<td>
						{!! Form::text("qtyRecievedByStore",'',array('class' => 'form-control qtyRecievedByStore','placeholder'=>'Qty Recieved By Store','maxlength'=>5)) !!}
						</td>
						<td style="text-align:center;">
						
						{!! Form::checkbox("isCompleted", 'Y',false,['class'=>'isCompleted']) !!}
						</td>
						<td class="add-more-btn" align="center">
							<span><a href="javascript:void(0)" class="add_field_buttonDT btn btn-default"><i class="glyphicon glyphicon-plus add-row"></i></a></span>
							<span><a href="javascript:void(0)" class="add_field_buttonDT btn btn-default"><i class="glyphicon glyphicon-minus remove-row"></i></a></span>
						</td>
					</tr>
					@endif
				</tbody>
			</table>
		</div>							
	</div>
	<!-- action wrapper -->
	<div class="form-group action">
	<?php //if(! $readOnly) {?>
		<div class="col-lg-12 pull-center buttons"> 
			{!! Form::button('Save', array('class' => 'btn btn-red','onclick'=>'return submitCustomerRejection()')) !!}
		</div>
	<?php //} ?>
	</div>
	</div>
</div>
{!! Form::close() !!}
@else
<div class="alert alert-info">{!! $result['data'] !!}</div>
@endif
<script>
$(document).ready(function(){
	$(".qtyAsPerQc,.qtyRecievedByStore").ForceNumericOnly();

	$('.isCompleted').change(function() {
        var index = $('.isCompleted').index(this);
        if($(this).is(":checked")) {
            var color = $(".color:eq(" + index + ")").val();
	    	var qtyAsPerQc = $(".qtyAsPerQc:eq(" + index + ")").val();
	    	var qtyRecievedByStore = $(".qtyRecievedByStore:eq(" + index + ")").val();
	    	
	    	if(color  == '' || qtyAsPerQc == '' || qtyRecievedByStore == ''){
	    		$(this).attr('checked',false);
	    		jAlert("Can not marked it as checked. Please fill required fields.");
	    	}else{
	    		$(".color:eq(" + index + ")").attr('disabled',true);
	    		$(".qtyAsPerQc:eq(" + index + ")").attr('readOnly',true);
	    		$(".qtyRecievedByStore:eq(" + index + ")").attr('readOnly',true);
	    	}
        } else{
        	$(".color:eq(" + index + ")").attr('disabled',false);
        	$(".color:eq(" + index + ")").attr('readonly',false);
	    	$(".qtyAsPerQc:eq(" + index + ")").attr('readOnly',false);
	    	$(".qtyRecievedByStore:eq(" + index + ")").attr('readOnly',false);
        }     
    });

	$('#rejectionInwardTable').dynoTable({
        removeClass: '.remove-row', //Custom remover class name in beers table
        cloneClass: '.add-row', //Custom cloner class name in beers table
        lastRowRemovable: false, //Don't let the table be empty. Never run out of beer
        orderable: true, //beers can be rearranged
        //class for the click and draggable drag handle
        onRowRemove: function () {
           // updateBeerCount();
            //$('#msg').html("<span style='color:crimson'>Message: You deleted the row successfully</span>");
        },
        onRowClone: function () {
        	//check for validation
        	$(".rejectionRow").each(function(index){
                var length=0;
                $(this).addClass('xyz'+index);
                var length = $(".rejectionRow").length;
                if(parseInt(length)-1 == parseInt(index))
                {
                    $('.xyz'+index +' .color').val('');
                    $('.xyz'+index +' .color').attr('disabled',false);
                    $('.xyz'+index +' .color').attr('readonly',false);
                    $('.xyz'+index +' .qtyAsPerQc').val('');
                    $('.xyz'+index +' .qtyAsPerQc').attr('readOnly',false);
                    $('.xyz'+index +' .qtyRecievedByStore').val('');
                    $('.xyz'+index +' .qtyRecievedByStore').attr('readonly',false);
                    $('.xyz'+index +' .isCompleted').attr('checked',false);
                }
            });
            updateBeerCount();
			$(".qtyAsPerQc,.qtyRecievedByStore").ForceNumericOnly();

			$('.isCompleted').change(function() {
		        var index = $('.isCompleted').index(this);
		        if($(this).is(":checked")) {
		            var color = $(".color:eq(" + index + ")").val();
			    	var qtyAsPerQc = $(".qtyAsPerQc:eq(" + index + ")").val();
			    	var qtyRecievedByStore = $(".qtyRecievedByStore:eq(" + index + ")").val();
			    	
			    	if(color  == '' || qtyAsPerQc == '' || qtyRecievedByStore == ''){
			    		$(this).attr('checked',false);
			    		jAlert("Can not marked it as checked. Please fill required fields.");
			    	}else{
			    		$(".color:eq(" + index + ")").attr('disabled',true);
			    		$(".qtyAsPerQc:eq(" + index + ")").attr('readOnly',true);
			    		$(".qtyRecievedByStore:eq(" + index + ")").attr('readOnly',true);
			    	}
		        } else{
		        	$(".color:eq(" + index + ")").attr('disabled',false);
		        	$(".color:eq(" + index + ")").attr('readonly',false);
			    	$(".qtyAsPerQc:eq(" + index + ")").attr('readOnly',false);
			    	$(".qtyRecievedByStore:eq(" + index + ")").attr('readOnly',false);
		        }     
		    });

        }
    });
});

function updateBeerCount() {
    $(".sr_no").each(function (index) {
        $(this).html(index + 1);
    });
}
function validateData () {
	var result = true;
    $('.isCompleted').each(function (index) {
    	var isCompleted = $(this).val();
        var color = $(".color:eq(" + index + ")").val();
        var qtyRecievedByStore = $(".qtyRecievedByStore:eq(" + index + ")").val();
        var qtyAsPerQc = $(".qtyAsPerQc:eq(" + index + ")").val();
        if(isCompleted == '' || color == '' || qtyAsPerQc == '' || qtyRecievedByStore == ''){
        	result = false;
        }else {
        	
        }      	
    });
    return result;
}

function submitCustomerRejection() {
	if(validateData()){
		var data = '[';
	    $('.isCompleted').each(function (index) {
	        if (index != 0) data += ',';
	        if($(this).is(":checked"))
    	    	var isCompleted = 'Y';
    		else
    	    	var isCompleted = 'N';
	    	var color = $(".color:eq(" + index + ")").val();
	    	var qtyAsPerQc = $(".qtyAsPerQc:eq(" + index + ")").val();
	    	var qtyRecievedByStore = $(".qtyRecievedByStore:eq(" + index + ")").val();
	        data += '{"color":"'+color+'","qtyAsPerQc":"'+qtyAsPerQc+'","qtyRecievedByStore":"'+qtyRecievedByStore+'","isCompleted":"'+isCompleted+'"}';
	    });
	    data += ']';
	    
	    var postdata = 'rejectionInwardId='+$('#rejectionInwardId').val()+'&rejection=' + data;
	    
	    $.ajax({
	        url: base_url+"/rejection/save-customer-rejection",
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
	   				window.location.href = base_url+"/rejection"
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
	}else{
			jAlert("Please fill all the fields.","Error!!");
	}
}
</script>
