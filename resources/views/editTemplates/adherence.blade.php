
   <article class="panel panel-default">
      <div class="panel-heading">
         <h4 class="panel-title">
           <a data-toggle="collapse" id="adherenceAnchorTag" data-parent="#accordion" href="#adherence">Adherence</a>
         </h4>
      </div>
      <div id="adherence" class="panel-collapse collapse">
         <div class="panel-body">
            <div class="row">
               <div class="col-lg-12">
     
                     <div class="form-wrapper row">
                        <div class="col-lg-4 col-md-4">
                           <div class="form-group">
                              {!! HTML::decode(Form::label('knowledge', 'Accuracy of Information/Knowledge <small class="mandatory">*</small>')) !!}
                              {!! Form::select('knowledge',$data['adherence'],@$voice->sqAdherence->aik,['id'=>'knowledge','class'=>'form-control','onchange'=>'checkAdherence()']) !!}
                              <div id="knowledge_alert" class="error validationAlert validationError">{!!$errors->first('knowledge')!!}</div>
                           </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                           <div class="form-group">
                              {!! HTML::decode(Form::label('securityVerification', 'Security Verfication <small class="mandatory">*</small>')) !!}
                              {!! Form::select('securityVerification',$data['adherence'],@$voice->sqAdherence->sv,['id'=>'securityVerification','class'=>'form-control','onchange'=>'checkAdherence()']) !!}
                              <div id="securityVerification_alert" class="error validationAlert validationError">{!!$errors->first('securityVerification')!!}</div>
                           </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                           <div class="form-group">
                              {!! HTML::decode(Form::label('callBackSeverity', 'Call Back Severity <small class="mandatory">*</small>')) !!}
                              {!! Form::select('callBackSeverity',$data['adherence'],@$voice->sqAdherence->cbs,['id'=>'callBackSeverity','class'=>'form-control','onchange'=>'checkAdherence()']) !!}
                              <div id="callBackSeverity_alert" class="error validationAlert validationError">{!!$errors->first('callBackSeverity')!!}</div>
                           </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                           <div class="form-group">
                              {!! HTML::decode(Form::label('adherenceOther', 'Other <small class="mandatory">*</small>')) !!}
                              {!! Form::select('adherenceOther',$data['adherence'],@$voice->sqAdherence->other,['id'=>'adherenceOther','class'=>'form-control','onchange'=>'checkAdherence()']) !!}
                              <div id="adherenceOther_alert" class="error validationAlert validationError">{!!$errors->first('adherenceOther')!!}</div>
                           </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                           <div class="form-group">
                              {!! HTML::decode(Form::label('adherenceComment', 'Comment')) !!}
                              {!! Form::textarea('adherenceComment',@$voice->sqAdherence->comment,['placeholder'=>'Comment','id'=>'adherenceComment','size' => '30x3','class'=>'form-control']) !!}
                              <div id="adherenceComment_alert" class="error validationAlert validationError">{!! $errors->first('adherenceComment') !!}</div>
                           </div>
                        </div>
                     </div>
                  
               </div>
            </div>
         </div>
      </div>
   </article>

<!-- #adherence -->