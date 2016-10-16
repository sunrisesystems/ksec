@if($result['success'])

<div class="form-group">
    {!! HTML::decode(Form::label('subCallType', 'Sub-Call Type <small class="mandatory">*</small>')) !!}
    {!! Form::select('callType',$result['data'],null,['id'=>'subCallType','class'=>'form-control']) !!}
  <div id="subCallType_alert" class="error validationAlert validationError">{!!$errors->first('subCallType')!!}</div>
</div>

@else

<div class="form-group">
    {!! HTML::decode(Form::label('subCallType', 'Sub-Call Type <small class="mandatory">*</small>')) !!}
    {!! Form::select('callType',[''=> 'Select'],null,['id'=>'subCallType','class'=>'form-control']) !!}
  <div id="subCallType_alert" class="error validationAlert validationError">{!!$errors->first('subCallType')!!}</div>
</div>

@endif
