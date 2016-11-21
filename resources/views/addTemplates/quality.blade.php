   <article class="panel panel-default">
      <div class="panel-heading">
         <h4 class="panel-title">
           <a data-toggle="collapse" id="qualityAchorTag" data-parent="#accordion" href="#quality">Quality</a>
         </h4>
      </div>
      <div id="quality" class="panel-collapse collapse">
         <div class="panel-body">
            <div class="row">
               <div class="col-lg-12">

                     <div class="form-wrapper row">
                        <div class="col-lg-6">
                           <div class="row">
                              <div class="col-lg-12">
                                 <div class="row">
                                    <div class="col-lg-6">
                                       <div class="form-group">
                                          {!! HTML::decode(Form::label('tm', 'Tone & Manner <small class="mandatory">*</small>')) !!}
                                           {!! Form::select('tm',$data['tmData']['list'],null,['id'=>'tm','class'=>'form-control','onchange'=>'checkMaxSceoreAndArch(this.id,this.value)']) !!}
                                          <div id="tm_alert" class="error validationAlert validationError">{!!$errors->first('tm')!!}</div>
                                       </div>
                                    </div>
                                    <div class="col-lg-3">
                                       <div class="form-group">
                                          {!! HTML::decode(Form::label('tmMax', 'Max <small class="mandatory">*</small>')) !!}
                                          {!! Form::text('tmMax',null,["placeholder"=>"Max",'id'=>'tmMax','class'=>'form-control','readonly'=>true]) !!} 
                                          <div id="tmMax_alert" class="error validationAlert validationError">{!!$errors->first('tmMax')!!}</div>

                                       </div>
                                    </div>
                                    <div class="col-lg-3">
                                       <div class="form-group">
                                          {!! HTML::decode(Form::label('tmAch', 'Achieve <small class="mandatory">*</small>')) !!}
                                          {!! Form::text('tmAch',null,["placeholder"=>"Ach",'id'=>'tmAch','class'=>'form-control','readonly'=>true]) !!} 
                                          <div id="tmAch_alert" class="error validationAlert validationError">{!!$errors->first('tmAch')!!}</div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-lg-6">
                                       <div class="form-group">
                                           {!! HTML::decode(Form::label('cm', 'Communication <small class="mandatory">*</small>')) !!}
                                           {!! Form::select('cm',$data['cmData']['list'],null,['id'=>'cm','class'=>'form-control','onchange'=>'checkMaxSceoreAndArch(this.id,this.value)']) !!}
                                          <div id="cm_alert" class="error validationAlert validationError">{!!$errors->first('cm')!!}</div>
                                       </div>
                                    </div>
                                    <div class="col-lg-3">
                                       <div class="form-group">
                                         {!! HTML::decode(Form::label('cmMax', 'Max <small class="mandatory">*</small>')) !!}
                                          {!! Form::text('cmMax',null,["placeholder"=>"Max",'id'=>'cmMax','class'=>'form-control','readonly'=>true]) !!} 
                                          <div id="cmMax_alert" class="error validationAlert validationError">{!!$errors->first('cmMax')!!}</div>

                                       </div>
                                    </div>
                                    <div class="col-lg-3">
                                       <div class="form-group">
                                          {!! HTML::decode(Form::label('cmAch', 'Ach <small class="mandatory">*</small>')) !!}
                                          {!! Form::text('cmAch',null,["placeholder"=>"Ach",'id'=>'cmAch','class'=>'form-control','readonly'=>true]) !!} 
                                          <div id="cmAch_alert" class="error validationAlert validationError">{!!$errors->first('cmAch')!!}</div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-lg-6">
                                       <div class="form-group">
                                        {!! HTML::decode(Form::label('chp', 'Correct Hold <small class="mandatory">*</small>')) !!}
                                           {!! Form::select('chp',$data['chpData']['list'],null,['id'=>'chp','class'=>'form-control','onchange'=>'checkMaxSceoreAndArch(this.id,this.value)']) !!}
                                          <div id="chp_alert" class="error validationAlert validationError">{!!$errors->first('chp')!!}</div>
                                       </div>
                                    </div>
                                    <div class="col-lg-3">
                                       <div class="form-group">
                                          {!! HTML::decode(Form::label('chpMax', 'Max <small class="mandatory">*</small>')) !!}
                                          {!! Form::text('chpMax',null,["placeholder"=>"Max",'id'=>'chpMax','class'=>'form-control','readonly'=>true]) !!} 
                                          <div id="chpMax_alert" class="error validationAlert validationError">{!!$errors->first('chpMax')!!}</div>
                                       </div>
                                    </div>
                                    <div class="col-lg-3">
                                       <div class="form-group">
                                          {!! HTML::decode(Form::label('chpAch', 'Achieve <small class="mandatory">*</small>')) !!}
                                          {!! Form::text('chpAch',null,["placeholder"=>"Ach",'id'=>'chpAch','class'=>'form-control','readonly'=>true]) !!} 
                                          <div id="chpAch_alert" class="error validationAlert validationError">{!!$errors->first('chpAch')!!}</div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-lg-6">
                                       <div class="form-group">
                                        {!! HTML::decode(Form::label('poa', 'Personal Accountability and Ownership <small class="mandatory">*</small>')) !!}
                                           {!! Form::select('poa',$data['poaData']['list'],null,['id'=>'poa','class'=>'form-control','onchange'=>'checkMaxSceoreAndArch(this.id,this.value)']) !!}
                                          <div id="poa_alert" class="error validationAlert validationError">{!!$errors->first('poa')!!}</div>
                                       </div>
                                    </div>
                                    <div class="col-lg-3">
                                       <div class="form-group">
                                          {!! HTML::decode(Form::label('poaMax', 'Max <small class="mandatory">*</small>')) !!}
                                          {!! Form::text('poaMax',null,["placeholder"=>"Max",'id'=>'poaMax','class'=>'form-control','readonly'=>true]) !!} 
                                          <div id="poaMax_alert" class="error validationAlert validationError">{!!$errors->first('poaMax')!!}</div>
                                       </div>
                                    </div>
                                    <div class="col-lg-3">
                                       <div class="form-group">
                                         {!! HTML::decode(Form::label('poaAch', 'Achieve <small class="mandatory">*</small>')) !!}
                                          {!! Form::text('poaAch',null,["placeholder"=>"Ach",'id'=>'poaAch','class'=>'form-control','readonly'=>true]) !!} 
                                          <div id="poaAch_alert" class="error validationAlert validationError">{!!$errors->first('poaAch')!!}</div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-lg-6">
                                       <div class="form-group">
                                           {!! HTML::decode(Form::label('delighter', 'Delighters Used <small class="mandatory">*</small>')) !!}
                                           {!! Form::select('delighter',$data['delighterData']['list'],null,['id'=>'delighter','class'=>'form-control','onchange'=>'checkMaxSceoreAndArch(this.id,this.value)']) !!}
                                          <div id="delighter_alert" class="error validationAlert validationError">{!!$errors->first('delighter')!!}</div>
                                       </div>
                                    </div>
                                    <div class="col-lg-3">
                                       <div class="form-group">
                                          {!! HTML::decode(Form::label('delighterMax', 'Max <small class="mandatory">*</small>')) !!}
                                          {!! Form::text('delighterMax',null,["placeholder"=>"Max",'id'=>'delighterMax','class'=>'form-control','readonly'=>true]) !!} 
                                          <div id="delighterMax_alert" class="error validationAlert validationError">{!!$errors->first('delighterMax')!!}</div>
                                       </div>
                                    </div>
                                    <div class="col-lg-3">
                                       <div class="form-group">
                                          {!! HTML::decode(Form::label('delighterAch', 'Achieve <small class="mandatory">*</small>')) !!}
                                          {!! Form::text('delighterAch',null,["placeholder"=>"Ach",'id'=>'delighterAch','class'=>'form-control','readonly'=>true]) !!} 
                                          <div id="delighterAch_alert" class="error validationAlert validationError">{!!$errors->first('delighterAch')!!}</div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-lg-6">
                                       <div class="form-group">
                                         {!! HTML::decode(Form::label('su', 'System Usage <small class="mandatory">*</small>')) !!}
                                           {!! Form::select('su',$data['suData']['list'],null,['id'=>'su','class'=>'form-control','onchange'=>'checkMaxSceoreAndArch(this.id,this.value)']) !!}
                                          <div id="su_alert" class="error validationAlert validationError">{!!$errors->first('su')!!}</div>
                                       </div>
                                    </div>
                                    <div class="col-lg-3">
                                       <div class="form-group">
                                          {!! HTML::decode(Form::label('suMax', 'Max <small class="mandatory">*</small>')) !!}
                                          {!! Form::text('suMax',null,["placeholder"=>"Max",'id'=>'suMax','class'=>'form-control','readonly'=>true]) !!} 
                                          <div id="suMax_alert" class="error validationAlert validationError">{!!$errors->first('suMax')!!}</div>
                                       </div>
                                    </div>
                                    <div class="col-lg-3">
                                       <div class="form-group">
                                          {!! HTML::decode(Form::label('suAch', 'Achieve <small class="mandatory">*</small>')) !!}
                                          {!! Form::text('suAch',null,["placeholder"=>"Ach",'id'=>'suAch','class'=>'form-control','readonly'=>true]) !!} 
                                          <div id="suAch_alert" class="error validationAlert validationError">{!!$errors->first('suAch')!!}</div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-lg-6">
                                       <div class="form-group">
                                          {!! HTML::decode(Form::label('sct', 'Correct CT/SCT <small class="mandatory">*</small>')) !!}
                                          {!! Form::select('sct',$data['sctData']['list'],null,['id'=>'sct','class'=>'form-control','onchange'=>'checkMaxSceoreAndArch(this.id,this.value)']) !!}
                                          <div id="sct_alert" class="error validationAlert validationError">{!!$errors->first('sct')!!}</div>
                                       </div>
                                    </div>
                                    <div class="col-lg-3">
                                       <div class="form-group">
                                         {!! HTML::decode(Form::label('sctMax', 'Max <small class="mandatory">*</small>')) !!}
                                          {!! Form::text('sctMax',null,["placeholder"=>"Max",'id'=>'sctMax','class'=>'form-control','readonly'=>true]) !!} 
                                          <div id="sctMax_alert" class="error validationAlert validationError">{!!$errors->first('sctMax')!!}</div>
                                       </div>
                                    </div>
                                    <div class="col-lg-3">
                                       <div class="form-group">
                                          {!! HTML::decode(Form::label('sctAch', 'Achieve <small class="mandatory">*</small>')) !!}
                                          {!! Form::text('sctAch',null,["placeholder"=>"Ach",'id'=>'sctAch','class'=>'form-control','readonly'=>true]) !!} 
                                          <div id="sctAch_alert" class="error validationAlert validationError">{!!$errors->first('sctAch')!!}</div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-lg-6">
                                       <div class="form-group">
                                          {!! HTML::decode(Form::label('ocr', 'OCR <small class="mandatory">*</small>')) !!}
                                          {!! Form::select('ocr',$data['ocrData']['list'],null,['id'=>'ocr','class'=>'form-control','onchange'=>'checkMaxSceoreAndArch(this.id,this.value)']) !!}
                                          <div id="ocr_alert" class="error validationAlert validationError">{!!$errors->first('ocr')!!}</div>
                                       </div>
                                    </div>
                                    <div class="col-lg-3">
                                       <div class="form-group">
                                          {!! HTML::decode(Form::label('ocrMax', 'Max <small class="mandatory">*</small>')) !!}
                                          {!! Form::text('ocrMax',null,["placeholder"=>"Max",'id'=>'ocrMax','class'=>'form-control','readonly'=>true]) !!} 
                                          <div id="ocrMax_alert" class="error validationAlert validationError">{!!$errors->first('ocrMax')!!}</div>
                                       </div>
                                    </div>
                                    <div class="col-lg-3">
                                       <div class="form-group">
                                            {!! HTML::decode(Form::label('ocrAch', 'Achieve <small class="mandatory">*</small>')) !!}
                                          {!! Form::text('ocrAch',null,["placeholder"=>"Ach",'id'=>'ocrAch','class'=>'form-control','readonly'=>true]) !!} 
                                          <div id="ocrAch_alert" class="error validationAlert validationError">{!!$errors->first('ocrAch')!!}</div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <!-- .item -->
                           </div>
                           <!-- .row -->	                                        
                        </div>
                        <div class="col-lg-6">
                           <div class="form-group">
                              {!! HTML::decode(Form::label('qualityComment1', 'Comment')) !!}
                              {!! Form::textarea('qualityComment1',null,['placeholder'=>'Comment','id'=>'qualityComment1','size' => '30x3','class'=>'form-control']) !!}
                              <div id="qualityComment1_alert" class="error validationAlert validationError">{!! $errors->first('qualityComment1') !!}</div>
                           </div>
                        </div>                            
                     </div>
                     <!-- .form-wrapper -->
                     <div class="form-wrapper">
                        <div class="row">
                           <div class="col-lg-3">
                              <div class="form-group">
                                  {!! HTML::decode(Form::label('pg', 'Process Gap <small class="mandatory">*</small>')) !!}
                                 {!! Form::select('pg',$data['otherQuality'],null,['id'=>'pg','class'=>'form-control','onchange'=>'updateOcr()']) !!}
                                 <div id="pg_alert" class="error validationAlert validationError">{!!$errors->first('pg')!!}</div>
                              </div>
                              <div class="form-group">
                                 {!! HTML::decode(Form::label('osat', 'OSAT <small class="mandatory">*</small>')) !!}
                                 {!! Form::select('osat',$data['osat'],null,['id'=>'osat','class'=>'form-control']) !!}
                                 <div id="osat_alert" class="error validationAlert validationError">{!!$errors->first('osat')!!}</div>
                              </div>
                             <!--  <div class="form-group">
                                 {!! HTML::decode(Form::label('rsat', 'RSAT <small class="mandatory">*</small>')) !!}
                                 {!! Form::select('rsat',$data['otherQuality'],null,['id'=>'rsat','class'=>'form-control']) !!}
                                 <div id="rsat_alert" class="error validationAlert validationError">{!!$errors->first('rsat')!!}</div>
                              </div> -->
                              <div class="form-group">
                                 {!! HTML::decode(Form::label('appreciation', 'Appreciation <small class="mandatory">*</small>')) !!}
                                 {!! Form::select('appreciation',$data['otherQuality'],null,['id'=>'appreciation','class'=>'form-control','onchange'=>'checkAppreciation()']) !!}
                                 <div id="appreciation_alert" class="error validationAlert validationError">{!!$errors->first('appreciation')!!}</div>
                              </div>
                           </div>
                           <div class="col-lg-6 col-lg-offset-3">
                              <div class="form-group">
                                 {!! Form::textarea('qualityComment2',null,['placeholder'=>'Comment','id'=>'qualityComment2','size' => '30x3','class'=>'form-control']) !!}
                              <div id="qualityComment2_alert" class="error validationAlert validationError">{!! $errors->first('qualityComment2') !!}</div>
                              </div>
                           </div>
                        </div>
                     </div>
                  
               </div>
            </div>
         </div>
      </div>
   </article>

<!-- #quality -->

