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
						<a href="{!! URL::to('item') !!}">Manage Items</a>
					</li>
					<li class="active">
						<strong>Edit Item</strong>
					</li>					
				</ol>
			</div>
		</div>
	</div>
	<div class="pageHeading container-fluid">
		<div class="row ">			
			<div class="page-title-wrapper">			
				<div class="col-lg-12">
					<h2 class="page-header">Edit Item</h2>					
				</div>							
			</div>			
		</div>
	</div><!-- pageHeading end -->
    <div class="main-container-inner container-fluid">			
		<!-- Form row start -->
		<div class="row">
			<div class="col-xs-12">
				<section id="inputDetail" class="form-container">
					{!! Form::model($item, array('method' => 'PATCH', 'route' => array('item.update', $item->id),'name'=>'frm','onsubmit'=>' return validateItem()')) !!}
						<div class="form-control-wrapper">
							<div class="form-group">
								<div class="row">
									<div class="col-sm-4">											
										{!! HTML::decode(Form::label('group', 'Group <small class="mandatory">*</small>')) !!}
										{!! Form::select('group_id',$data['group'],null,['id'=>'group_id','class'=>'form-control','onchange'=>'getType(this.value)']) !!}
										<div id="group_id_alert" class="error validationAlert validationError">{!!$errors->first('group_id')!!}</div>
									</div>
									<div class="col-sm-4">											
										{!! HTML::decode(Form::label('type', 'Type <small class="mandatory">*</small>')) !!}
										{!! Form::select('type_id',[''=>'Select'],null,['id'=>'type_id','class'=>'form-control']) !!}
										<div id="type_id_alert" class="error validationAlert validationError">{!!$errors->first('type_id')!!}</div>
									</div>
									<div class="col-sm-4"> 						
										{!! HTML::decode(Form::label('classStoreType', 'Class/Store Type <small class="mandatory">*</small>')) !!}
										{!! Form::select('store_id',$data['store'],null,['id'=>'store_id','class'=>'form-control']) !!}
										<div id="store_id_alert" class="error validationAlert validationError">{!!$errors->first('store_id')!!}</div>
									</div>
								</div>
							</div>	
							<div class="form-group">
								<div class="row">
									<div class="col-sm-4"> 						
										{!! HTML::decode( Form::label('name', 'Item Name <small class="mandatory">*</small>')) !!}
										{!! Form::text('name',null,array('placeholder'=>'Item Name','id'=>'name','class'=>'form-control')) !!}
										<div id="name_alert" class="error validationAlert validationError">{!!$errors->first('name')!!}</div>
									</div>
									<div class="col-sm-4"> 						
										{!! HTML::decode( Form::label('short_desc', 'Short Description <small class="mandatory">*</small>')) !!}
										{!! Form::text('short_desc',null,array('placeholder'=>'Short Description','id'=>'short_desc','class'=>'form-control','maxlength' => 15)) !!}
										<div id="short_desc_alert" class="error validationAlert validationError">{!!$errors->first('short_desc')!!}</div>
									</div>
									<div class="col-sm-4">											
										{!! HTML::decode(Form::label('status', 'Status <small class="mandatory">*</small>')) !!}
										{!! Form::select('status',$data['status'],null,['id'=>'status','class'=>'form-control']) !!}
										<div id="status_alert" class="error validationAlert validationError">{!!$errors->first('status')!!}</div>
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
    function validateItem()
    {
        clearAlertMsg();
        var arrElemId   = new Array();
        var arrCode     = new Array();
        var arrRefValue = new Array();
        var arrMsg      = new Array();
        var i = 0 ;

        arrElemId[i]    = 'group_id';
        arrCode[i]      = 'IS_EMPTY';
        arrRefValue[i]  = null;
        arrMsg[i]       = '<?php echo Lang::get("messages.select_group")?>';
        i++;

        arrElemId[i]    = 'type_id';
        arrCode[i]      = 'IS_EMPTY';
        arrRefValue[i]  = null;
        arrMsg[i]       = '<?php echo Lang::get("messages.select_type")?>';
        i++;

        arrElemId[i]    = 'store_id';
        arrCode[i]      = 'IS_EMPTY';
        arrRefValue[i]  = null;
        arrMsg[i]       = '<?php echo Lang::get("messages.select_store")?>';
        i++;

        arrElemId[i]    = 'name';
        arrCode[i]      = 'IS_EMPTY';
        arrRefValue[i]  = null;
        arrMsg[i]       = '<?php echo Lang::get("messages.empty_item_name")?>';
        i++;

        arrElemId[i]    = 'short_desc';
        arrCode[i]      = 'IS_EMPTY';
        arrRefValue[i]  = null;
        arrMsg[i]       = '<?php echo Lang::get("messages.empty_item_short_desc")?>';
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
    	doCancel("{!! URL::to('item') !!}")
    }

    $(document).ready(function () {
    	var groupId = '{!! $item->group_id !!}';
    	if(groupId != ''){
    		getType(groupId,'{!! $item->type_id !!}');
    	}
    })
    function getType (groupId,typeId) {
    	var types = '{!! json_encode($data["type"])!!}';
    	types = JSON.parse(types)
    	$("#type_id").html('');
    	$('#type_id').append(
		    $('<option />').text("Select").val('')
		);
    	if(types.length > 0){
    		for (var i = 0; i < types.length; i++) {
    			if(parseInt(types[i].group_id) == parseInt(groupId)){
    				$('#type_id').append(
					    $('<option />').text(types[i].type).val(types[i].id)
					);
    			}
    		};
    		$("#type_id").val(typeId)
    	}

    }
</script>
@stop