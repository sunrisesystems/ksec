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
						Inventory
					</li>
					<li>
						<a href="{!! URL::to('product') !!}">Manage Products</a>
					</li>
					<li class="active">
						<strong>Edit Product</strong>
					</li>					
				</ol>
			</div>
		</div>
	</div>
	<div class="pageHeading container-fluid">
		<div class="row ">			
			<div class="page-title-wrapper">			
				<div class="col-lg-12">
					<h2 class="page-header">Edit Product</h2>					
				</div>							
			</div>			
		</div>
	</div><!-- pageHeading end -->
    <div class="main-container-inner container-fluid selectDropdownDdl">			
		<!-- Form row start -->
		<div class="row">
			<div class="col-xs-12">
				<section id="inputDetail" class="form-container">
						{!! Form::model($product, array('method' => 'PATCH', 'route' => array('product.update', $product->id),'name'=>'frm','onsubmit'=>' return validateProdcut()')) !!}
						<div class="form-control-wrapper">
							<div class="form-group">
								<div class="row">
									<div class="col-sm-4"> 						
										{!! HTML::decode( Form::label('trade_name', 'Trade Name <small class="mandatory">*</small>')) !!}
										<div class="input-group">
										{!! Form::text('trade_name',Request::old('trade_name'),array('placeholder'=>'Trade Name','id'=>'trade_name','class'=>'form-control')) !!}
										<a class="input-group-addon icon-wrap-red" href="javascript:void(0)" onclick="generateTradeName()"><span class="glyphicon glyphicon-refresh"></span></a>
										</div>
										<div id="loading" class="" style="display:none">Loading....</div>

										<div id="trade_name_alert" class="error validationAlert validationError">{!!$errors->first('trade_name')!!}</div>
									</div>
									<div class="col-sm-4">											
										{!! HTML::decode(Form::label('type', 'Type <small class="mandatory">*</small>')) !!}
										{!! Form::select('type_id',$data['type'],null,['id'=>'type_id','class'=>'form-control']) !!}
										<div id="type_id_alert" class="error validationAlert validationError">{!!$errors->first('type_id')!!}</div>
									</div>
									<div class="col-sm-4">											
										{!! HTML::decode(Form::label('group', 'Group <small class="mandatory">*</small>')) !!}
										{!! Form::select('group_id',$data['group'],null,['id'=>'group_id','class'=>'form-control']) !!}
										<div id="group_id_alert" class="error validationAlert validationError">{!!$errors->first('group_id')!!}</div>
									</div>
								</div>
							</div>	
							<div class="form-group">
								<div class="row">
									<div class="col-sm-4"> 						
										{!! HTML::decode(Form::label('classStoreType', 'Class/Store Type <small class="mandatory">*</small>')) !!}
										{!! Form::select('store_id',$data['store'],null,['id'=>'store_id','class'=>'form-control']) !!}
										<div id="store_id_alert" class="error validationAlert validationError">{!!$errors->first('store_id')!!}</div>
									</div>
									<div class="col-sm-4 ddl">											
										{!! HTML::decode(Form::label('drawing#', 'Drawing # <small class="mandatory">*</small>')) !!}
										{!! Form::select('drawing_id',$data['drawing'],null,['id'=>'drawing_id','class'=>'form-control selectpicker','data-live-search'=>true,'data-size'=>5]) !!}
										<div id="drawing_id_alert" class="error validationAlert validationError">{!!$errors->first('drawing_id')!!}</div>
									</div>
									<div class="col-sm-4">											
										{!! HTML::decode(Form::label('color', 'Color <small class="mandatory">*</small>')) !!}
										{!! Form::select('color_id',$data['color'],null,['id'=>'color_id','class'=>'form-control']) !!}
										<div id="color_id_alert" class="error validationAlert validationError">{!!$errors->first('color_id')!!}</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-sm-4"> 						
										{!! HTML::decode(Form::label('brand', 'Brand <small class="mandatory">*</small>')) !!}
										{!! Form::select('brand_id',$data['brand'],null,['id'=>'brand_id','class'=>'form-control']) !!}
										<div id="brand_id_alert" class="error validationAlert validationError">{!!$errors->first('brand_id')!!}</div>
									</div>
									<div class="col-sm-4">											
										{!! HTML::decode(Form::label('primaryApplication', 'Primary Application <small class="mandatory">*</small>')) !!}
										{!! Form::select('primary_application_id',$data['primaryApplication'],null,['id'=>'primary_application_id','class'=>'form-control']) !!}
										<div id="primary_application_id_alert" class="error validationAlert validationError">{!!$errors->first('primary_application_id')!!}</div>
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
									<div class="col-sm-4"> 						
										
									</div>
									<div class="col-sm-4">											
										
									</div>
									<div class="col-sm-4">											
										
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-sm-4"> 						
										
									</div>
									<div class="col-sm-4">											
										
									</div>
									<div class="col-sm-4">											
										
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-sm-4"> 						
										
									</div>
									<div class="col-sm-4">											
										
									</div>
									<div class="col-sm-4">											
										
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
	</div><!-- main-container-inner -->
</div><!-- Container end -->



<script type="text/javascript">
    function validateProduct()
    {
    	return true;
        clearAlertMsg();
        var arrElemId   = new Array();
        var arrCode     = new Array();
        var arrRefValue = new Array();
        var arrMsg      = new Array();
        var i = 0 ;

        arrElemId[i]    = 'shape_name';
        arrCode[i]      = 'IS_EMPTY';
        arrRefValue[i]  = null;
        arrMsg[i]       = '<?php echo Lang::get("messages.empty_shape")?>';
        i++;

        arrElemId[i]    = 'shape_code';
        arrCode[i]      = 'IS_EMPTY';
        arrRefValue[i]  = null;
        arrMsg[i]       = '<?php echo Lang::get("messages.empty_shape_code")?>';
        i++;

        arrElemId[i]    = 'status';
        arrCode[i]      = 'IS_EMPTY';
        arrRefValue[i]  = null;
        arrMsg[i]       = '<?php echo Lang::get("messages.empty_status")?>';
        i++;

        result = validate(document.forms[0], arrElemId, arrCode, arrRefValue, arrMsg);
        return result;

    }

    function redirectUrl () {
    	doCancel("{!! URL::to('product') !!}")
    }

    function generateTradeName () {
        var brandId = $("#brand_id").val();
        var drawingNo = $("#drawing_id").val();
        var colorId = $("#color_id").val();

        var tradeName = '';
        if(drawingNo == '' || drawingNo === undefined){
            alert('Please select drawing number.');
            return false;
        }
        if(colorId == ''){
            alert('Please select color.');
            return false;
        }
        if(brandId == ''){
            alert('Please select brand.');
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
                if(data.success == 1){
                    var moldTradeName = data.data;
                    var brand = $("#brand_id option:selected").text();
    				var color = $("#color_id option:selected").text();
		            if(moldTradeName != ''){
		                tradeName +=  moldTradeName +", "+color + ", "+brand;
		            }else{
		                tradeName += color + ", "+brand;
		            }
			        
			        $("#trade_name").val(tradeName);
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
</script>
@stop