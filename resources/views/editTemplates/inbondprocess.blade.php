<section class="panel-wrapper">
<div class="row">
  <div class="col-lg-9 col-md-8">
    <article id="inbondForm" class="panel panel-default panel-inbond">
      <div class="panel-heading">
        <h4 class="panel-title">Inbond</h4>
      </div>        
      <div class="panel-body">
        
           <div class="row">
              <div class="col-lg-3 col-md-4">
                 <div class="form-group">
                    {!! HTML::decode(Form::label('date', 'Date <small class="mandatory">*</small>')) !!}
                    {!! Form::text('date',Lib::convertDateFormat("Y-m-d",$voice->trdate,"d-M-Y"),array("placeholder"=>"Date",'id'=>'date','class'=>'form-control','autocomplete'=>'off','readonly'=>true)) !!} 
                    <div id="date_alert" class="error validationAlert validationError">{!!$errors->first('date')!!}</div>
                 </div>
              </div>
              <div class="col-lg-3 col-md-4">
                <div class="form-group">
                    {!! HTML::decode(Form::label('process', 'Process <small class="mandatory">*</small>')) !!}
                    {!! Form::select('process',$data['process'],$voice->process_id,['id'=>'process','class'=>'form-control']) !!}
                    <div id="process_alert" class="error validationAlert validationError">{!!$errors->first('process')!!}</div>
                 </div>
              </div>
              <div class="col-lg-3 col-md-4">
                <div class="form-group">
                    {!! HTML::decode(Form::label('agent', 'Agent <small class="mandatory">*</small>')) !!}
                    {!! Form::select('agent',$data['agent'],$voice->agent_id,['id'=>'agent','class'=>'form-control']) !!}
                    <div id="agent_alert" class="error validationAlert validationError">{!!$errors->first('agent')!!}</div>
                 </div>
              </div>
              <div class="col-lg-3 col-md-4">
                <div class="form-group">
                    {!! HTML::decode(Form::label('teamLead', 'Team Leader <small class="mandatory">*</small>')) !!}
                    {!! Form::select('teamLead',$data['teamLead'],$voice->tl_id,['id'=>'teamLead','class'=>'form-control']) !!}
                    <div id="teamLead_alert" class="error validationAlert validationError">{!!$errors->first('teamLead')!!}</div>
                 </div>
              </div>
              <div class="col-lg-3 col-md-4">
                <div class="form-group">
                    {!! HTML::decode(Form::label('manager', 'Manager <small class="mandatory">*</small>')) !!}
                    {!! Form::select('manager',$data['manager'],$voice->manager_id,['id'=>'manager','class'=>'form-control']) !!}
                    <div id="manager_alert" class="error validationAlert validationError">{!!$errors->first('manager')!!}</div>
                 </div>
              </div>
              <div class="col-lg-3 col-md-4">
                <div class="form-group">
                    {!! HTML::decode(Form::label('category', 'Category <small class="mandatory">*</small>')) !!}
                    {!! Form::select('category',$data['category'],$voice->cat_id,['id'=>'category','class'=>'form-control']) !!}
                    <div id="category_alert" class="error validationAlert validationError">{!!$errors->first('category')!!}</div>
                 </div>
              </div>
              <div class="col-lg-3 col-md-4">
                <div class="form-group">
                    {!! HTML::decode(Form::label('clientId', 'Client ID <small class="mandatory">*</small>')) !!}
                    <!-- only alpha numeric-->
                   {!! Form::text('clientId',$voice->client_id,array("placeholder"=>"Client ID",'id'=>'clientId','class'=>'form-control')) !!} 
                    <div id="clientId_alert" class="error validationAlert validationError">{!!$errors->first('clientId')!!}</div>
                    
                 </div>
              </div>
              <div class="col-lg-3 col-md-4">
                <div class="form-group">
                     {!! HTML::decode(Form::label('callId', 'Call ID <small class="mandatory">*</small>')) !!}
                    <!-- only alpha numeric-->
                   {!! Form::text('callId',$voice->call_id,array("placeholder"=>"Call ID",'id'=>'callId','class'=>'form-control')) !!} 
                    <div id="callId_alert" class="error validationAlert validationError">{!!$errors->first('callId')!!}</div>
                 </div>
              </div>
              <div class="col-lg-3 col-md-4">                
                 <div class="form-group">
                    {!! HTML::decode(Form::label('duration', 'Duration <small class="mandatory">*</small>')) !!}
                    {!! Form::select('duration',$data['callDuration'],$voice->duration_id,['id'=>'duration','class'=>'form-control']) !!}
                    <div id="duration_alert" class="error validationAlert validationError">{!!$errors->first('duration')!!}</div>
                 </div>
              </div>
              <div class="col-lg-3 col-md-4"> 
                <div class="form-group">
                    {!! HTML::decode(Form::label('callType', 'Call Type <small class="mandatory">*</small>')) !!}
                    {!! Form::select('callType',$data['callType'],$voice->calltype_id,['id'=>'callType','class'=>'form-control','onchange' => 'getSubCallType(this.value)']) !!}
                    <div id="callType_alert" class="error validationAlert validationError">{!!$errors->first('callType')!!}</div>
                 </div>
              </div>
              <div class="col-lg-3 col-md-4" id="subCallTypeDiv">
                <div class="form-group">
                    {!! HTML::decode(Form::label('subCallType', 'Sub-Call Type <small class="mandatory">*</small>')) !!}
                    {!! Form::select('subCallType',$data['subCallType'],null,['id'=>'subCallType','class'=>'form-control']) !!}
                  <div id="subCallType_alert" class="error validationAlert validationError">{!!$errors->first('subCallType')!!}</div>
                </div>
              </div>
           </div>
       
      </div><!-- .panel-body -->   
    </article>
  </div>
  <div class="col-lg-3 col-md-4">
    <article class="panel panel-default panel-score">
      <div class="panel-heading">
        <h4 class="panel-title">Score</h4>
      </div>
      
      <table class="table">
        <tbody>
          <tr>
            <td><strong>Fatal</strong></td>
            @if($voice->fatal == 'Y')
              <td id="fatalTd">Yes</td>
            @else
              <td id="fatalTd">No</td>
            @endif
          </tr>
          <tr>
            <td><strong>Adherence</strong></td>
            @if($voice->adherence == 'Y')
              <td id="adherenceTd">Yes</td>
            @else
              <td id="adherenceTd">No</td>
            @endif
          </tr>
          <tr>
            <td><strong>Quality</strong></td>
            <td id="qualityTd">{!! Lib::roundOffNumber($voice->quality_per,2)."%" !!}</td>
              <tr>
                <td><strong>Max</strong></td>
                <td id="maxQuality">{!! Lib::roundOffNumber($voice->quality_max,2) !!}</td>
              </tr>
              <tr>
                <td><strong>Achieve</strong></td>
                <td id="achQuality">{!! Lib::roundOffNumber($voice->quality_ach,2) !!}</td>
              </tr>
          </tr>
          <tr>
            <td><strong>Appreciation</strong></td>
            @if($voice->appr == 'Y')
            <td id="appreciationTd">Yes</td>
            @else
            <td id="appreciationTd">No</td>
            @endif
          </tr>
        </tbody>
      </table>
      
    </article>
  </div>   
</div>
<script type="text/javascript">
  $(document).ready(function(){
      var $panelInbond = $('.panel-inbond').outerHeight();
      $('.panel-score').css('height',$panelInbond);
      $('.panel-inbond .row > div[class*="col-"]').matchHeight();
      $(window).resize(function(){
         $('.panel-inbond .row > div[class*="col-"]').matchHeight();
      })
  });
</script>
</section>