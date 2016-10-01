<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h3 class="modal-title" id="addDowntimeLabel">Add Downtime <h5>Shift Time - {!! $downtimeData["shiftTiming"]["startDate"]!!} to {!! $downtimeData["shiftTiming"]["endDate"]!!}</h5></h3>
		</div>
		<div class="modal-body">
			<section id="addDowntimeForm" class="form-container modal-form">
				{!! Form::open() !!}
					<div class="row" >
						<div class="form-control-wrapper col-md-12" >
							<div class="form-group table-responsive">
							{!! Form::hidden('dailyEntryMachineId',$downtimeData['dailyEntryMachineId'],array('class' => 'form-control qty','placeholder'=>'qty','id'=>'dailyEntryMachineIdDowntime','maxlength'=>5)) !!}
								<table class="table table-bordered" id="downtimeTable">
									<thead>
										<tr class="row">
											<th class="col-md-3">Subreason</th>
											<th class="col-md-2">Start time</th>
											<th class="col-md-2">End time</th>
											<th class="col-md-3">Comment</th>
											<th class="col-md-2 right" >Add</th>					
										</tr>
									</thead>
									<tbody class="input_fields_wrapDT">
										@if(!empty($downtimeData['data']))
										@foreach($downtimeData['data'] as $key => $value)
										<tr class="row downtimeRow">
											<td class="col-md-3">
											{!! Form::select('subreason',$downtimeData['downtimeSubreason'], $value['subreasonId'], ['id'=>'subreason','class' => 'form-control downtimeSubReason']) !!}
											</td>
											<td class="col-md-2">
											{!! Form::text('start_time',$value['startDateTime'],array('class' => 'form-control pickTime startDateTime','placeholder'=>'Start Time','id'=>'start_time','readonly'=>true)) !!}
											</td>
											<td class="col-md-2">
											{!! Form::text('end_time',$value['endDateTime'],array('class' => 'form-control pickTime endDateTime','placeholder'=>'End Time','id'=>'end_time','readonly'=>true)) !!}
											</td>
											<td class="col-md-3">
											{!! Form::text('comment',$value['comment'],array('class' => 'form-control  downtimeComment','placeholder'=>'Comment','id'=>'comment')) !!}
											</td>
											<td class="col-md-2	add-more-btn" align="right">
												<span><a href="javascript:void(0)" class="add_field_buttonDT btn btn-default"><i class="glyphicon glyphicon-plus add-row"></i></a></span>
												<span><a href="javascript:void(0)" class="add_field_buttonDT btn btn-default"><i class="glyphicon glyphicon-minus remove-row"></i></a></span>
											</td>
										</tr>
										@endforeach
										@else
										<tr class="row downtimeRow">
											<td class="col-md-3">
											{!! Form::select('subreason',$downtimeData['downtimeSubreason'], null, ['id'=>'subreason','class' => 'form-control downtimeSubReason']) !!}
											</td>
											<td class="col-md-2">
											{!! Form::text('start_time',null,array('class' => 'form-control startDateTime','placeholder'=>'Start Time','id'=>'start_time','readonly'=>true)) !!}
											</td>
											<td class="col-md-2">
											{!! Form::text('end_time',null,array('class' => 'form-control endDateTime','placeholder'=>'End Time','id'=>'end_time','readonly'=>true)) !!}
											</td>
											<td class="col-md-3">
											{!! Form::text('comment',null,array('class' => 'form-control downtimeComment','placeholder'=>'Comment','id'=>'comment')) !!}
											</td>
											<td class="col-md-2	add-more-btn" align="right">
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
							<div class="col-lg-12 pull-center buttons"> 
								{!! Form::button('Save', array('class' => 'btn btn-red','onclick'=>'saveDowntimeData()')) !!}
							</div>
						</div>
					</div>
				{!! Form::close() !!}
			</section><!-- section Form end -->
		</div>			
	</div>
</div>

<script type="text/javascript">
		var allowMinDate = '{!! $downtimeData["shiftTiming"]["startDate"]!!}';
		var allowMaxDate = '{!! $downtimeData["shiftTiming"]["endDate"]!!}';
		var allowableTime = '{!! $downtimeData["shiftTiming"]["time"]!!}';
		var time = $.parseJSON(allowableTime);
	$(function() {
		//console.log(time);
		$(".startDateTime").datetimepicker({
			format:'d-m-Y H:i',
	  		formatDate:'d-m-Y H:i',
	  		step : 5,
	  		minDate : allowMinDate,
	  		maxDate : allowMaxDate,
	  		allowTimes : time,
	  		/*onChangeDateTime : function(dp,$input){
	  			$input.blur();
	  			$input.datetimepicker('hide');
	  			validateDateTime1($input.val(),allowMinDate,allowMaxDate);
	  		},*/
	  		onSelectTime:function(dp,$input){
	  			$input.blur();
	  			$input.datetimepicker('hide');
	  			validateDateTime1($input.val(),allowMinDate,allowMaxDate);
	  		}, 
		});

		$(".endDateTime").datetimepicker({
			format:'d-m-Y H:i',
	  		formatDate:'d-m-Y H:i',
	  		step : 5,
	  		minDate : allowMinDate,
	  		maxDate : allowMaxDate,
	  		allowTimes : time,
	  		/*onChangeDateTime : function(dp,$input){
	  			$input.blur();
	  			$input.datetimepicker('hide');
	  			validateDateTime1($input.val(),allowMinDate,allowMaxDate);
	  		},*/
	  		onSelectTime:function(dp,$input){
	  			$input.blur();
	  			$input.datetimepicker('hide');
	  			validateDateTime1($input.val(),allowMinDate,allowMaxDate);
	  		}, 
		});
	})
	$(document).ready(function(){
    	$(".qty").ForceNumericOnly();
		$('#downtimeTable').dynoTable({
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
	        	$(".downtimeRow").each(function(index){
	                var length=0;
	                $(this).addClass('xyz'+index);
	                var length = $(".downtimeRow").length;
	                if(parseInt(length)-1 == parseInt(index))
	                {
	                    $('.xyz'+index +' .startDateTime').val('');
	                    $('.xyz'+index +' .endDateTime').val('');
	                    $('.xyz'+index +' .downtimeSubreason').val('');
	                    $('.xyz'+index +' .downtimeComment').val('');
	                }
	            });
	           	$(".startDateTime").datetimepicker({
					format:'d-m-Y H:i',
			  		formatDate:'d-m-Y H:i',
			  		step : 5,
			  		minDate : allowMinDate,
			  		maxDate : allowMaxDate,
			  		allowTimes : time,
			  		/*onChangeDateTime : function(dp,$input){
			  			$input.blur();
			  			$input.datetimepicker('hide');
			  			validateDateTime1($input.val(),allowMinDate,allowMaxDate);
			  		},*/
			  		onSelectTime:function(dp,$input){
			  			$input.blur();
			  			$input.datetimepicker('hide');
			  			validateDateTime1($input.val(),allowMinDate,allowMaxDate);
			  		}, 
				});

				$(".endDateTime").datetimepicker({
					format:'d-m-Y H:i',
			  		formatDate:'d-m-Y H:i',
			  		step : 5,
			  		minDate : allowMinDate,
			  		maxDate : allowMaxDate,
			  		allowTimes : time,
			  		/*onChangeDateTime : function(dp,$input){
			  			$input.blur();
			  			$input.datetimepicker('hide');
			  			validateDateTime1($input.val(),allowMinDate,allowMaxDate);
			  		},*/
			  		onSelectTime:function(dp,$input){
			  			$input.blur();
			  			$input.datetimepicker('hide');
			  			validateDateTime1($input.val(),allowMinDate,allowMaxDate);
			  		}, 
				});
	        }
	    });
	});

	function validateAllData () {
		var result = true;
        $('.downtimeSubreason').each(function (index) {
            var subreason = $(this).val();
            var startDateTime = $(".startDateTime:eq(" + index + ")").val();
            var endDateTime = $(".endDateTime:eq(" + index + ")").val();
            var comment = $(".downtimeComment:eq(" + index + ")").val();
            if(subreason == '' || startDateTime == '' || endDateTime == ''){
            	result = false;
            }else {
            	
            }      	
        });
        return result;
	}

	function validateStartTime () {
		var result = true;
        $('.downtimeSubreason').each(function (index) {
            var subreason = $(this).val();
            var startDateTime = $(".startDateTime:eq(" + index + ")").val();
            var endDateTime = $(".endDateTime:eq(" + index + ")").val();
            var comment = $(".downtimeComment:eq(" + index + ")").val();
         
        	if(validateDateTime1(startDateTime,allowMinDate,allowMaxDate)) {
            	result = true;
            }else{
            	result = false;
            }      	
        });
        return result;
	}

	function validateEndTime () {
		var result = true;
        $('.downtimeSubreason').each(function (index) {
            var subreason = $(this).val();
            var startDateTime = $(".startDateTime:eq(" + index + ")").val();
            var endDateTime = $(".endDateTime:eq(" + index + ")").val();
            var comment = $(".downtimeComment:eq(" + index + ")").val();
         
        	if(validateDateTime1(endDateTime,allowMinDate,allowMaxDate)) {
            	result = true;
            }else{
            	result = false;
            }      	
        });
        return result;
	}

	function compareStartTimeEndTime1 () {
		var result = true;
        $('.downtimeSubreason').each(function (index) {
            var subreason = $(this).val();
            var startDateTime = $(".startDateTime:eq(" + index + ")").val();
            var endDateTime = $(".endDateTime:eq(" + index + ")").val();
            var comment = $(".downtimeComment:eq(" + index + ")").val();
         
        	if(compareStartTimeEndTime(startDateTime,startDateTime)) {
            	result = true;
            }else{
            	result = false;
            }      	
        });
        return result;
	}
	function saveDowntimeData () {
		var id = $('#dailyEntryMachineIdDowntime').val();
		if(validateAllData()){
			// now validate startime
			if(validateStartTime()){
				// now validate end time 
				if(validateEndTime()){
					// now compare start time and end time
					if(compareStartTimeEndTime1()){
						var data = '[';
				        $('.downtimeSubreason').each(function (index) {
				            if (index != 0) data += ',';
				            var subreason = $(this).val();
			            	var startDateTime = $(".startDateTime:eq(" + index + ")").val();
			            	var endDateTime = $(".endDateTime:eq(" + index + ")").val();
			            	var comment = $(".downtimeComment:eq(" + index + ")").val();
				            data += '{"subreason":"'+subreason+'","startDateTime":"'+startDateTime+'","endDateTime":"'+endDateTime+'","comment":"' + comment + '"}';
				        });
				        data += ']';
				        if($("#isCompleted_"+id).is(":checked")){
				        	var isCompleted = 'Y';
				        }else{
				        	var isCompleted = 'N';
				        }
				        var postdata = 'dailyEntryMachineId='+$('#dailyEntryMachineIdDowntime').val()+'&downtime=' + data+'&shotCounter='+$("#shortCounter_"+id).val()+'&shotCounterTimer='+$("#shortCounterTimer_"+id).val()+'&purging='+$("#purging_"+id).val()+'&productionQuantity='+$("#productionQuantity_"+id).val()+'&isCompleted='+isCompleted+'&totalRejection='+$("#totalRejection_"+id).val();
				        
				        $.ajax({
			                url: base_url+"/saveDowntime",
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
			           				var downtimeSpanId = $('#dailyEntryMachineIdDowntime').val();
			           				$("#totalDowntime_"+downtimeSpanId).html(data.totalDowntime);
			            			$("#addDowntime").modal('hide');
			           			}
			                },
			                error: function () {
								$("#savingBtn").hide();
			                    $("#saveBtn").show();
			                    $("#errorMsg").html('It seems our server is busy at this moment. Please try again after sometime.').show();
			                }
			            });
					}else{
						jAlert("End date time should be greater then start date time.","Error!!");
					}
				}
			}else{

			}
		}else{
			jAlert("Please fill all the fields.","Error!!");
		}
	}

	function validateDateTime1 (inputDateTime,strtDateTime,endDateTime) {
  	if(checkDateTimeWithShiftTime(inputDateTime,strtDateTime,endDateTime)){
  		return true;
  	}else{
  		jAlert("Please select time between shift start time and shift end time.","Error!!");
  		return false;
  	}
}

</script>