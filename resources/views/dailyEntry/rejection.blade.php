<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h3 class="modal-title" id="addRejectionLabel">Add Rejection</h3>
		</div>
		<div class="modal-body">
			<div id="rejectionError"></div>
			<section id="addRejectionForm" class="form-container modal-form">
				{!! Form::open() !!}
					<div class="row" >
						<div class="form-control-wrapper col-md-12" >
							<div class="form-group table-responsive">
							{!! Form::hidden('dailyEntryMachineId',$rejectionData['dailyEntryMachineId'],array('class' => 'form-control qty','placeholder'=>'qty','id'=>'dailyEntryMachineId','maxlength'=>5)) !!}
								<table class="table table-bordered" id="rejectionTable">
									<thead>
										<tr class="row">
											<th class="col-md-4">Rejection</th>
											<th class="col-md-2" >Qty</th>
											<th class="col-md-4">Commment</th>
											<th class="col-md-2 right">Add</th>					
										</tr>
									</thead>
									<tbody class="input_fields_wrap">
										@if(!empty($rejectionData['data']))
										@foreach($rejectionData['data'] as $key => $value)
										<tr class="row rejectionRow">
											<td class="col-md-4">
											{!! Form::select('rejection[]', $rejectionData['defects'], $value['defectId'], ['id'=>'rejection','class' => 'form-control machineRejection']) !!}
											</td>
											<td class="col-md-2">
											{!! Form::text('qty[]',$value['quantity'],array('class' => 'form-control rejectionqty','placeholder'=>'qty','id'=>'qty','maxlength'=>5)) !!}
											</td>
											<td class="col-md-4">
											{!! Form::text('comment[]',$value['comment'],array('class' => 'form-control comment','placeholder'=>'Comment','id'=>'comment')) !!}
											</td>
											<td class="col-md-2	add-more-btn" align="right">
											<a href="javascript:void(0)" class="add_field_button btn btn-default"><i class="glyphicon glyphicon-plus add-row"></i></a>
											<a href="javascript:void(0)" class="add_field_button btn btn-default"><i class="glyphicon glyphicon-minus remove-row"></i></a>
											</td>
										</tr>
										@endforeach
										@else
										<tr class="row rejectionRow">
											<td class="col-md-4">
											{!! Form::select('rejection[]', $rejectionData['defects'], null, ['id'=>'rejection','class' => 'form-control machineRejection']) !!}
											</td>
											<td class="col-md-2">
											{!! Form::text('qty[]',null,array('class' => 'form-control rejectionqty','placeholder'=>'qty','id'=>'qty','maxlength'=>5)) !!}
											</td>
											<td class="col-md-4">
											{!! Form::text('comment[]',null,array('class' => 'form-control comment','placeholder'=>'Comment','id'=>'comment')) !!}
											</td>
											<td class="col-md-2	add-more-btn" align="right">
											<a href="javascript:void(0)" class="add_field_button btn btn-default"><i class="glyphicon glyphicon-plus add-row"></i></a>
											<a href="javascript:void(0)" class="add_field_button btn btn-default"><i class="glyphicon glyphicon-minus remove-row"></i></a>
											</td>
										</tr>
										@endif
									</tbody>
								</table>
							</div>
						</div>
						<!-- action wrapper -->
						<div class="form-group action">
							<div class="col-lg-12 pull-center buttons"> 
								{!! Form::button('Save', array('class' => 'btn btn-red','onclick'=>'saveRejectionData()')) !!}
							</div>
						</div>
					</div>
				{!! Form::close() !!}
			</section><!-- section Form end -->
		</div>			
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
    	$(".qty").ForceNumericOnly();
		$('#rejectionTable').dynoTable({
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
	                    $('.xyz'+index +' .machineRejection').val('');
	                    $('.xyz'+index +' .rejectionqty').val('');
	                    $('.xyz'+index +' .comment').val('');
	                }
	            });
	            $('.rejectionqty').ForceNumericOnly();
	        }
	    });
	});

	function validateAllData () {
		var result = true;
        $('.machineRejection').each(function (index) {
            var rejection = $(this).val();
            var qty = $(".rejectionqty:eq(" + index + ")").val();
            var comment = $(".comment:eq(" + index + ")").val();
            if(rejection == '' || qty == ''){
            	result = false;
            }else{

            }
        });
        return result;
	}

	function saveRejectionData () {
		var id = $('#dailyEntryMachineId').val();
		var addedRejection = $("#totalRejection_"+id).val();

		if(validateAllData()){
			var tRejection = 0;
			var data = '[';
	        $('.machineRejection').each(function (index) {
	        	console.log(index);
	            if (index != 0) data += ',';
	            var rejection = $(this).val();
	            var qty = $(".rejectionqty:eq(" + index + ")").val();
	            tRejection += parseInt(qty);
	            var comment = $(".comment:eq(" + index + ")").val();
	            data += '{"rejection":"'+rejection+'","qty":"'+qty+'","comment":"' + comment + '"}';
	        });
	        data += ']';
	        
	        if(parseInt(tRejection) != parseInt(addedRejection)){
	        	jAlert("Rejection mis match. Please verify it.");
	        	return false;
	        }
	        if($("#isCompleted_"+id).is(":checked")){
	        	var isCompleted = 'Y';
	        }else{
	        	var isCompleted = 'N';
	        }
	        var postdata = 'dailyEntryMachineId='+$('#dailyEntryMachineId').val()+'&rejection=' + data+'&addedRejection='+addedRejection+'&shotCounter='+$("#shortCounter_"+id).val()+'&shotCounterTimer='+$("#shortCounterTimer_"+id).val()+'&purging='+$("#purging_"+id).val()+'&productionQuantity='+$("#productionQuantity_"+id).val()+'&isCompleted='+isCompleted;
	        
	        $.ajax({
                url: base_url+"/saveRejection",
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
           				var downtimeSpanId = $('#dailyEntryMachineId').val();
			           	$("#rejectionRecords_"+downtimeSpanId).val(data.totalRejection);
            			$("#addRejection").modal('hide');
           			}
                },
                error: function () {
					$("#savingBtn").hide();
                    $("#saveBtn").show();
                    $("#errorMsg").html('It seems our server is busy at this moment. Please try again after sometime.').show();
                }
            });
		}else{
			jAlert("Please fill all the fields.");
		}
	}

</script>