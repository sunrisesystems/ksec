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
<div id="main-container" class="main-container container">  
    <div class="main-container-inner">
		<div class="page-content">
			<!-- Page Heading row -->
			<div class="row">
				<div class="col-xs-12">
					<div class="page-title-wrapper">
						<h1 class="page-header">Add Mold</h1>
					</div>
				</div>
			</div><!-- end Heading row -->
			
			<!-- Form row start -->
			<div class="row">
				<div class="col-xs-12">
					<section id="groupDetail" class="form-container">
							{!! Form::open(array('route' => 'mold.store' , 'onSubmit' => 'return validateMold()')) !!}
							<div class="form-control-wrapper">
								<div class="form-group">
									<div class="row">
										<div class="col-sm-4">											
											{!! HTML::decode( Form::label('mold_name', 'Name <small class="mandatory">*</small>')) !!}
											<div class="input-group">
												{!! Form::text('mold_name',null,array('placeholder'=>'Mold Name','id'=>'mold_name','class'=>'form-control')) !!}
												<a class="input-group-addon icon-wrap-red" href="javascript:void(0)" onclick="generateMoldName()"><span class="glyphicon glyphicon-refresh"></span></a>
											</div>
											
											
											<div id="mold_name_alert" class="error validationAlert validationError">{!!$errors->first('mold_name')!!}</div>
										</div>
										<div class="col-sm-4"> 
											{!! HTML::decode( Form::label('mold_no', 'Mold # <small class="mandatory">*</small>')) !!}
											{!! Form::text('mold_no','',array('placeholder'=>'Mold #','id'=>'mold_no','class'=>'form-control')) !!}
											<div id="mold_no_alert" class="error validationAlert validationError">{!! $errors->first('mold_no') !!}</div>
											
										</div>
										<div class="col-sm-4">	
											{!! HTML::decode( Form::label('mold_trade_name', 'Mold Trade Name <small class="mandatory">*</small>')) !!}
											{!! Form::text('mold_trade_name','',array('placeholder'=>'Mold Trade Name','id'=>'mold_trade_name','class'=>'form-control')) !!}
											<div id="mold_trade_name_alert" class="error validationAlert validationError">{!! $errors->first('mold_trade_name') !!}</div>	
										</div>
									</div>
								</div>	
								<div class="form-group">
									<div class="row">
										<div class="col-sm-4"> 	
											{!! HTML::decode( Form::label('group', 'Group <small class="mandatory">*</small>')) !!}
											{!! Form::select('group_id',$data['group'],'',['id'=>'group_id','class'=>'form-control']) !!}
											<div id="group_id_alert" class="error validationAlert validationError">{!! $errors->first('group_id') !!}</div>											
										</div>
										<div class="col-sm-4"> 
											{!! HTML::decode( Form::label('store', 'Class/Store <small class="mandatory">*</small>')) !!}
											{!! Form::select('store_id',$data['store'],'',['id'=>'store_id','class'=>'form-control']) !!}
											<div id="store_id_alert" class="error validationAlert validationError">{!! $errors->first('store_id') !!}</div>											
										</div>
										<div class="col-sm-4">		
											{!! HTML::decode(Form::label('Type', 'Type'))!!}
											{!! Form::select('type_id',$data['type'],'',['id'=>'type_id','class'=>'form-control']) !!}
											<div id="type_id_alert" class="error validationAlert validationError">{!! $errors->first('type_id') !!}</div>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-sm-4"> 						
											{!! HTML::decode( Form::label('drawing_no', 'Drawing # <small class="mandatory">*</small>')) !!}
											{!! Form::select('drawing_id',$data['drawing'],'',['id'=>'drawing_id','onchange'=>'getMoldTradeName(this.value)','class'=>'form-control']) !!}
											<div id="loading" class="" style="display:none">Loading....</div>
											<div id="drawing_id_alert" class="error validationAlert validationError">{!! $errors->first('drawing_id') !!}</div>
										</div>
										<div class="col-sm-4"> 
											{!! HTML::decode( Form::label('manufactures', 'Manufacturer <small class="mandatory">*</small>')) !!}
											{!! Form::select('manufacturer_id',$data['manufacturer'],'',['id'=>'manufacturer_id','class'=>'form-control']) !!}
											<div id="manufacturer_id_alert" class="error validationAlert validationError">{!! $errors->first('manufacturer_id') !!}</div>
										</div>
										<div class="col-sm-4">											
											{!! HTML::decode(Form::label('unit_id', 'Unit <small class="mandatory">*</small>')) !!}
											{!! Form::select('unit_id',$data['unit'],null,['id'=>'unit_id','class'=>'form-control']) !!}
											<div id="unit_id_alert" class="error validationAlert validationError">{!!$errors->first('unit_id')!!}</div>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-md-4 col-sm-4">					
											<div class="triple-gp-wraper">					
												<div class="row">								
													<div class="col-md-12 col-sm-12">
														{!! HTML::decode(Form::label('status', 'Status <small class="mandatory">*</small>')) !!}
														{!! Form::select('status',$data['status'],null,['id'=>'status','class'=>'form-control']) !!}
														<div id="status_alert" class="error validationAlert validationError">{!!$errors->first('status')!!}</div>
														
													</div>
														
												</div> 	
											</div>
										</div>
										<div class="col-md-4 col-sm-4">					
											<div class="triple-gp-wraper">					
												<div class="row">								
													<div class="col-md-12 col-sm-12">
														{!! HTML::decode( Form::label('std_purging', 'Standard Purging %<small class="mandatory">*</small>')) !!}
													</div>
													<div class="col-sm-4">						
														{!! Form::text('std_purging_l','',array('placeholder'=>'Low','id'=>'std_purging_l','class'=>'form-control')) !!}
														<div id="std_purging_l_alert" class="error validationAlert validationError">{!! $errors->first('std_purging_l') !!}</div>
													</div>
													<div class="col-sm-4">					
														{!! Form::text('std_purging_c','',array('placeholder'=>'Center','id'=>'std_purging_c','class'=>'form-control')) !!}
														<div id="std_purging_c_alert" class="error validationAlert validationError">{!! $errors->first('std_purging_c') !!}</div>
													</div>
													<div class="col-sm-4">						
														{!! Form::text('std_purging_h','',array('placeholder'=>'High','id'=>'std_purging_h','class'=>'form-control')) !!}
														<div id="std_purging_h_alert" class="error validationAlert validationError">{!! $errors->first('std_purging_h') !!}</div>
													</div>	
												</div> 	
											</div>
										</div>
										<div class="col-md-4 col-sm-4">					
											<div class="triple-gp-wraper">					
												<div class="row">								
													<div class="col-md-12 col-sm-12">
														{!! HTML::decode( Form::label('hot_runner_type', 'Hot Runner Capacity <small class="mandatory">*</small>')) !!}
													</div>
													<div class="col-sm-4">						
														{!! Form::text('hot_runner_capacity_l','',array('placeholder'=>'Low','id'=>'hot_runner_capacity_l','class'=>'form-control')) !!}
														<div id="hot_runner_capacity_l_alert" class="error validationAlert validationError">{!! $errors->first('hot_runner_capacity_l') !!}</div> 
													</div>
													<div class="col-sm-4">					
														{!! Form::text('hot_runner_capacity_c','',array('placeholder'=>'Center','id'=>'hot_runner_capacity_c','class'=>'form-control')) !!}
														<div id="hot_runner_capacity_c_alert" class="error validationAlert validationError">{!! $errors->first('hot_runner_capacity_c') !!}</div> 
													</div>
													<div class="col-sm-4">						
														{!! Form::text('hot_runner_capacity_h','',array('placeholder'=>'High','id'=>'hot_runner_capacity_h','class'=>'form-control')) !!}
														<div id="hot_runner_capacity_h_alert" class="error validationAlert validationError">{!! $errors->first('hot_runner_capacity_h') !!}</div>
													</div>	
												</div> 	
											</div>
										</div>
									</div>
								</div>
								
								<div class="form-group">
									<div class="row">
										<div class="col-md-4 col-sm-4">					
											<div class="triple-gp-wraper">					
												<div class="row">								
													<div class="col-md-12 col-sm-12">
														{!! HTML::decode( Form::label('mold_temp_control_zone', 'Mold Temp. Control Zones <small class="mandatory">*</small>')) !!}
													</div>
													<div class="col-sm-4">						
														{!! Form::text('mold_temp_control_zone_l','',array('placeholder'=>'Low','id'=>'mold_temp_control_zone_l','class'=>'form-control')) !!}
														<div id="mold_temp_control_zone_l_alert" class="error validationAlert validationError">{!! $errors->first('mold_temp_control_zone_l') !!}</div>
													</div>
													<div class="col-sm-4">					
														{!! Form::text('mold_temp_control_zone_c','',array('placeholder'=>'Center','id'=>'mold_temp_control_zone_c','class'=>'form-control')) !!}
														<div id="mold_temp_control_zone_c_alert" class="error validationAlert validationError">{!! $errors->first('mold_temp_control_zone_c') !!}</div>
													</div>
													<div class="col-sm-4">						
														{!! Form::text('mold_temp_control_zone_h','',array('placeholder'=>'High','id'=>'mold_temp_control_zone_h','class'=>'form-control')) !!}
														<div id="mold_temp_control_zone_h_alert" class="error validationAlert validationError">{!! $errors->first('mold_temp_control_zone_h') !!}</div>
													</div>	
												</div> 	
											</div>
										</div>
										<div class="col-md-4 col-sm-4">					
											<div class="triple-gp-wraper">					
												<div class="row">								
													<div class="col-md-12 col-sm-12">
														{!! HTML::decode( Form::label('std_purging', 'Standard Rejection %<small class="mandatory">*</small>')) !!}
													</div>
													<div class="col-sm-4">						
														{!! Form::text('std_rejection_l','',array('placeholder'=>'Low','id'=>'std_rejection_l','class'=>'form-control')) !!}
														<div id="std_rejection_l_alert" class="error validationAlert validationError">{!! $errors->first('std_rejection_l') !!}</div>
													</div>
													<div class="col-sm-4">					
														{!! Form::text('std_rejection_c','',array('placeholder'=>'Center','id'=>'std_rejection_c','class'=>'form-control')) !!}
														<div id="std_rejection_c_alert" class="error validationAlert validationError">{!! $errors->first('std_rejection_c') !!}</div>
													</div>
													<div class="col-sm-4">						
														{!! Form::text('std_rejection_h','',array('placeholder'=>'High','id'=>'std_rejection_l','class'=>'form-control')) !!}
														<div id="std_rejection_h_alert" class="error validationAlert validationError">{!! $errors->first('std_rejection_h') !!}</div>
													</div>													
												</div> 	
											</div>
										</div>									
									</div>
								</div>
								<!-- action wrapper -->
								<div class="form-group action">
									<div class="col-lg-12 pull-center buttons"> 
										{!! Form::submit('Save', array('class' => 'btn btn-red')) !!}
										{!! Form::button('Cancel', ['class' => 'btn btn-black','onclick'=>'redirectUrl()']) !!} 
									</div>									
								</div><!-- action end -->
							</div><!-- Form control wrapper end -->	
						{!! Form::close() !!}
					</section><!-- section Form end -->
				</div>
			</div><!-- Form row end -->
			
		</div><!-- page content -->
	</div>
</div><!-- Container end -->






<script type="text/javascript">
    function validateMold()
    {
        clearAlertMsg();
        var arrElemId   = new Array();
        var arrCode     = new Array();
        var arrRefValue = new Array();
        var arrMsg      = new Array();
        var i = 0 ;

        arrElemId[i]    = 'neck_size';
        arrCode[i]      = 'IS_EMPTY';
        arrRefValue[i]  = null;
        arrMsg[i]       = '<?php echo Lang::get("messages.empty_neck_size")?>';
        i++;

        arrElemId[i]    = 'status';
        arrCode[i]      = 'IS_EMPTY';
        arrRefValue[i]  = null;
        arrMsg[i]       = '<?php echo Lang::get("messages.empty_status")?>';
        i++;

        result = validate(document.forms[0], arrElemId, arrCode, arrRefValue, arrMsg);
        return result;

    }

    function getMoldTradeName (drawingId) {
        $.ajax({
                url : base_url+"/drawings/getMoldTradeName",
                method : "POST",
                data : { 'drawingId' : drawingId },
                cache : false,
                beforeSend : function(){
                    $("#loading").show();
                },
                success:function(data){
                    console.log(data);
                    if(data.success == 1){
                        $("#mold_trade_name").val(data.data);
                    }else{
                        alert(data.data)
                    }
                    $("#loading").hide();
                },
                done : function (data){
                    $("#loading").hide();
                    
                },
                fail :function () {
                    $("#loading").hide();
                    alert("error")
                }
            });
    }

    function generateMoldName () {
        var moldNo = $("#mold_no").val();
        var drawingNo = $("#drawing_id").val();
        var moldTradeName = $("#mold_trade_name").val();
        var moldName = '';

        if(moldNo == ''){
            alert('Please enter Mold number.');
            return false;
        }
        if(drawingNo == '' || drawingNo === undefined){
            alert('Please select drawing number.');
            return false;
        }

        if(moldNo != '' && drawingNo != ''){
            if(moldTradeName != ''){
                moldName +=  moldTradeName +", "+moldNo;
            }else{
                moldName += moldNo;
            }
        } 
        $("#mold_name").val(moldName);
    }

    $("#std_rejection_l , #std_rejection_c, #std_rejection_h, #std_purging_l , #std_purging_c, #std_purging_h , #hot_runner_capacity_l, #hot_runner_capacity_c,#hot_runner_capacity_h, #mold_temp_control_zone_l,#mold_temp_control_zone_c,#mold_temp_control_zone_h").ForceNumericOnly();
</script>
@stop 