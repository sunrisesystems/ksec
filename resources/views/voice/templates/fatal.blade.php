
<article class="panel panel-default">
   <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" id="fatalAnchorTag" data-parent="#accordion" href="#fatal">Fatal</a>
      </h4>
   </div>
   <div id="fatal" class="panel-collapse collapse">
      <div class="panel-body">
         
            <div class="row">
               <div class="col-lg-4 col-md-4">
                  <div class="form-group">
                     {!! HTML::decode(Form::label('reason1', 'Reason 1')) !!}
                     {!! Form::select('fatalReason1',$data['fatalReason'],null,['id'=>'fatalReason1','class'=>'form-control']) !!}
                     <div id="fatalReason1_alert" class="error validationAlert validationError">{!!$errors->first('fatalReason1')!!}</div>
                  </div>
               </div>
               <div class="col-lg-4 col-md-4">
                  <div class="form-group">
                     {!! HTML::decode(Form::label('reason2', 'Reason 2')) !!}
                     {!! Form::select('fatalReason2',$data['fatalReason'],null,['id'=>'fatalReason2','class'=>'form-control']) !!}
                     <div id="fatalReason2_alert" class="error validationAlert validationError">{!!$errors->first('fatalReason2')!!}</div>
                  </div>
               </div>
               <div class="col-lg-4 col-md-4">
                  <div class="form-group">
                     {!! HTML::decode(Form::label('fatalComment', 'Comment')) !!}
                     {!! Form::textarea('fatalComment',null,['placeholder'=>'Comment','id'=>'fatalComment','size' => '30x3','class'=>'form-control']) !!}
                              <div id="fatalComment_alert" class="error validationAlert validationError">{!! $errors->first('fatalComment') !!}</div>
                  </div>
               </div>
            </div>
         
      </div>
   </div>
</article>
