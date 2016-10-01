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
<div id="main-container" class="main-container">  
   <div class="breadcrumb-wrapper container-fluid white-bg">
		<div class="row">
			<div class="col-lg-12 col-md-12">
				<ol class="breadcrumb">
					<li>
						Production
					</li>
					<li>
						<a href="{!! URL::to('mold') !!}">Manage Molds</a>
					</li>
					<li class="active">
						<strong>Edit Mold</strong>
					</li>					
				</ol>
			</div>
		</div>
	</div>
	<div class="pageHeading container-fluid">
		<div class="row ">			
			<div class="page-title-wrapper">			
				<div class="col-lg-12">
					<h2 class="page-header">Edit Mold</h2>					
				</div>							
			</div>			
		</div>
	</div><!-- pageHeading end -->
    <div class="main-container-inner container-fluid selectDropdownDdl">	
		<!-- Form row start -->
		<div class="row">
			<div class="col-xs-12">
				<section id="groupDetail" class="form-container">
						{!! Form::model($mold, array('method' => 'PATCH', 'route' => array('mold.update', $mold->id),'name'=>'frm','onsubmit'=>' return validateMold()')) !!}
						<div class="form-control-wrapper">
							<div class="form-group">
								<div class="row">
									<div class="col-sm-4">											
										{!! HTML::decode( Form::label('mold_name', 'Name <small class="mandatory">*</small>')) !!}
										<div class="input-group">
											{!! Form::text('mold_name',null,array('placeholder'=>'Mold Name','id'=>'mold_name','class'=>'form-control')) !!}
											<a class="input-group-addon icon-wrap-red" href="javascript:void(0)" onclick="generateMoldName()"><span class="glyphicon glyphicon-refresh"></span></a>
										</div>
										<div id="loading" class="" style="display:none">Loading....</div>
										
										<div id="mold_name_alert" class="error validationAlert validationError">{!!$errors->first('mold_name')!!}</div>
									</div>
									<div class="col-sm-4"> 
										{!! HTML::decode( Form::label('mold_no', 'Mold # <small class="mandatory">*</small>')) !!}
										<div class="input-group">
										{!! Form::text('mold_no',null,array('placeholder'=>'Mold #','id'=>'mold_no','class'=>'form-control')) !!}
										<a class="input-group-addon icon-wrap-red" href="javascript:void(0)" onclick="generateMoldNo()"><span class="glyphicon glyphicon-refresh"></span></a>
										</div>
										<div id="loading1" class="" style="display:none">Loading....</div>
										<div id="mold_no_alert" class="error validationAlert validationError">{!! $errors->first('mold_no') !!}</div>
										
									</div>
									<div class="col-sm-4">	
										{!! HTML::decode( Form::label('store', 'Class/Store <small class="mandatory">*</small>')) !!}
										{!! Form::select('store_id',$data['store'],null,['id'=>'store_id','class'=>'form-control']) !!}
										<div id="store_id_alert" class="error validationAlert validationError">{!! $errors->first('store_id') !!}</div>
									</div>
								</div>
							</div>	
							<div class="form-group">
								<div class="row">
									<div class="col-sm-4"> 	
										{!! HTML::decode(Form::label('Type', 'Type'))!!}
										{!! Form::select('type_id',$data['type'],null,['id'=>'type_id','class'=>'form-control']) !!}
										<div id="type_id_alert" class="error validationAlert validationError">{!! $errors->first('type_id') !!}</div>									
									</div>
									<div class="col-sm-4 ddl"> 
										{!! HTML::decode( Form::label('drawing_no', 'Drawing # <small class="mandatory">*</small>')) !!}
										{!! Form::select('drawing_id',$data['drawing'],null,['id'=>'drawing_id','class'=>'form-control selectpicker','data-live-search'=>true,'data-size'=>7]) !!}
										
										<div id="drawing_id_alert" class="error validationAlert validationError">{!! $errors->first('drawing_id') !!}</div>											
									</div>
									<div class="col-sm-4">		
										{!! HTML::decode( Form::label('manufactures', 'Manufacturer <small class="mandatory">*</small>')) !!}
										{!! Form::select('manufacturer_id',$data['manufacturer'],null,['id'=>'manufacturer_id','class'=>'form-control']) !!}
										<div id="manufacturer_id_alert" class="error validationAlert validationError">{!! $errors->first('manufacturer_id') !!}</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-sm-4"> 						
										{!! HTML::decode(Form::label('unit_id', 'Unit <small class="mandatory">*</small>')) !!}
										{!! Form::select('unit_id',$data['unit'],null,['id'=>'unit_id','class'=>'form-control']) !!}
										<div id="unit_id_alert" class="error validationAlert validationError">{!!$errors->first('unit_id')!!}</div>
									</div>
									<div class="col-sm-4"> 
										{!! HTML::decode(Form::label('priority', 'Priority <small class="mandatory">*</small>')) !!}
										{!! Form::select('priority',$data['priority'],null,['id'=>'priority','class'=>'form-control']) !!}
										<div id="priority_alert" class="error validationAlert validationError">{!!$errors->first('priority')!!}</div>
									</div>
									<div class="col-sm-4">											
										{!! HTML::decode(Form::label('status', 'Status <small class="mandatory">*</small>')) !!}
										{!! Form::select('status',$data['status'],null,['id'=>'status','class'=>'form-control']) !!}
										<div id="status_alert" class="error validationAlert validationError">{!!$errors->first('status')!!}</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-4 col-sm-4">					
										{!! HTML::decode( Form::label('hot_runner_type', 'Hot Runner Capacity<small class="mandatory">*</small>')) !!}
										{!! Form::text('hot_runner_capacity_c',null,array('placeholder'=>'Hot Runner Capacity - Centre','id'=>'hot_runner_capacity_c','class'=>'form-control')) !!}
										<div id="hot_runner_capacity_c_alert" class="error validationAlert validationError">{!! $errors->first('hot_runner_capacity_c') !!}</div>
									</div>
									<div class="col-md-4 col-sm-4">					
										{!! HTML::decode( Form::label('mold_temp_control_zone', 'Mold Temp. Control Zones <small class="mandatory">*</small>')) !!}
										{!! Form::text('mold_temp_control_zone_c',null,array('placeholder'=>'Mold Temp. Control Zones - Centre','id'=>'mold_temp_control_zone_c','class'=>'form-control')) !!}
										<div id="mold_temp_control_zone_c_alert" class="error validationAlert validationError">{!! $errors->first('mold_temp_control_zone_c') !!}</div>
									</div>
									<div class="col-md-4 col-sm-4">					
										{!! HTML::decode( Form::label('weighted_avg_wt', 'Weighted Avg. Weight<small class="mandatory">*</small>')) !!}
										{!! Form::text('weighted_avg_wt',null,array('placeholder'=>'Weighted Avg. Weight - Centre','id'=>'weighted_avg_wt','class'=>'form-control')) !!}
										<div id="weighted_avg_wt_alert" class="error validationAlert validationError">{!! $errors->first('weighted_avg_wt') !!}</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-sm-4 ddl"> 						
										{!! HTML::decode(Form::label('mother_mold', 'Mother Mold<small class="mandatory">*</small>')) !!}
										{!! Form::select('mother_mold',$data['motherMold'],null,['id'=>'mother_mold','class'=>'form-control selectpicker','data-live-search'=>true,'data-size'=>10]) !!}
										<div id="blow_mold_alert" class="error validationAlert validationError">{!!$errors->first('mother_mold')!!}</div>
									</div>
									<div class="col-sm-4 ddl">											
										{!! HTML::decode(Form::label('injection_mold', 'Injection Mold<small class="mandatory">*</small>')) !!}
										{!! Form::select('injection_mold',$data['injectionMold'],null,['id'=>'injection_mold','class'=>'form-control selectpicker','data-live-search'=>true,'data-size'=>10]) !!}
										<div id="injection_mold_alert" class="error validationAlert validationError">{!!$errors->first('injection_mold')!!}</div>
									</div>
									<div class="col-sm-4 ddl"> 
										{!! HTML::decode(Form::label('blow_mold', 'Blow Mold<small class="mandatory">*</small>')) !!}
										{!! Form::select('blow_mold',$data['blowMold'],null,['id'=>'blow_mold','class'=>'form-control selectpicker','data-live-search'=>true,'data-size'=>10]) !!}
										<div id="blow_mold_alert" class="error validationAlert validationError">{!!$errors->first('blow_mold')!!}</div>
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
</div><!-- Container end -->


<script type="text/javascript">
var moldTradeName = '';
    function validateMold()
    {
    	return true;
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
        
    }

    function generateMoldNo () {
    	$("#loading1").show();
        var motherMold = $("#mother_mold").val();
        var injectionMold = $("#injection_mold").val();
        var blowMold = $("#blow_mold").val();
        var moldNo = '';

        if(motherMold == ''){
    		$("#loading1").hide();
            jAlert('Please select Mother Mold.');
            return false;
        }
        if(injectionMold == ''){
    		$("#loading1").hide();
            jAlert('Please select Injection Mold.');
            return false;
        }
        if(blowMold == ''){
    		$("#loading1").hide();
            jAlert('Please select Blow Mold.');
            return false;
        }
		
       	motherMold = $("#mother_mold option:selected").text();
       	injectionMold = $("#injection_mold option:selected").text();
       	blowMold = $("#blow_mold option:selected").text();

       	moldNo = motherMold+"/"+injectionMold+"/"+blowMold;

       	$("#mold_no").val(moldNo);
        
    	$("#loading1").hide();
    }

    function generateMoldName () {
        var moldNo = $("#mold_no").val();
        var drawingNo = $("#drawing_id").val();
        var moldName = '';

        if(moldNo == ''){
            alert('Please enter Mold number.');
            return false;
        }
        if(drawingNo == '' || drawingNo === undefined){
            alert('Please select drawing number.');
            return false;
        }
        $.ajax({
                url : base_url+"/drawings/getMoldTradeName",
                method : "POST",
                data : { 'drawingId' : drawingNo },
                cache : false,
                beforeSend : function(){
                    $("#loading").show();
                },
                success:function(data){
                    console.log(data);
                    if(data.success == 1){
                        moldTradeName = data.data;
                        if(moldNo != '' && drawingNo != ''){
				            if(moldTradeName != ''){
				                moldName +=  moldTradeName +", "+moldNo;
				            }else{
				                moldName += moldNo;
				            }
				        } 
				        $("#mold_name").val(moldName);
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

    function redirectUrl () {
    	doCancel("{!! URL::to('mold') !!}")
    }
    $("#std_rejection_l , #std_rejection_c, #std_rejection_h, #std_purging_l , #std_purging_c, #std_purging_h , #hot_runner_capacity_l, #hot_runner_capacity_c,#hot_runner_capacity_h, #mold_temp_control_zone_l,#mold_temp_control_zone_c,#mold_temp_control_zone_h").ForceNumericOnly();
</script>
@stop 