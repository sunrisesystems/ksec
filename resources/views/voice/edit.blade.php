@extends('layout.admin')
@section('content')
<section class="inner-form-wrapper">
	<div id="inner-wrapper">
        <div class="breadcrumb-wrapper white-bg">
            <ol class="breadcrumb">
                <li>
                    <a href="{!! URL::to('voice') !!}">Voice</a>
                </li>
                <li class="active">
                    <strong>Edit Voice</strong>
                </li>               
            </ol>               
        </div>
        
        <article>
            <div class="row">
            	<div class="col-lg-12">
                    {!! Form::model($voice, ['method' => 'PATCH', 'route' => ['voice.update', $voice->id],'name'=>'frm','onsubmit'=>' return validateVoiceForm()']) !!}

            		@include('editTemplates.inbondprocess',$voice)
                    <div class="panel-group" id="accordion">
                		@include('editTemplates.fatal',$voice)
    			
    					@include('editTemplates.adherence',$voice)

                		@include('editTemplates.quality',$voice)
            		</div>
                    <div class="form-action text-center">
                        {!! Form::submit('Submit', array('class' => 'btn btn-primary')) !!}
                        {!! Form::button('Cancel', ['class' => 'btn btn-secondary','onclick'=>'redirectUrl()']) !!} 
                      
                    </div>
                    {!! Form::close() !!}
            	</div>
            </div>
        </article>

  
	</div>
</section>
<script type="text/javascript">
    $(document).ready(function () {
        //$("#side-menu").hide();
        $("body").toggleClass("mini-navbar");
        @if($errors->first('fatalComment'))
            $('#fatalAnchorTag').trigger('click');
        @endif

        @if($errors->first('knowledge') || $errors->first('securityVerification') || $errors->first('callBackSeverity') || $errors->first('adherenceOther') || $errors->first('adherenceComment'))
            $('#adherenceAnchorTag').trigger('click');
        @endif 

         @if($errors->first('tm') || $errors->first('sm') || $errors->first('chp') || $errors->first('delighter') || $errors->first('pg') || $errors->first('ocr') || $errors->first('poa') || $errors->first('su') || $errors->first('sct') || $errors->first('osat') || $errors->first('rsat') || $errors->first('appreciation'))
            $('#qualityAchorTag').trigger('click');
        @endif 
        
        $("#callType").trigger("change");
        setTimeout(function(){
            @if(count($errors))
                $("#subCallType").val({!! Request::old('subCallType') !!})
            @else
                $("#subCallType").val({!! $voice->subcalltype_id !!})
            @endif
        }, 2000);
        
        @if(count($errors))
            $("#tm,#cm,#chp,#poa,#delighter,#su,#sct,#ocr,#pg").trigger("change");
            checkFatal()
            checkAdherence();       
        @endif
    });

    function checkFatal() {
      var reason1 = $("#fatalReason1").val();
      var reason2 = $("#fatalReason2").val();
      if(reason1 != '' || reason2 != ''){
         $("#fatalTd").html("Yes");
      }else{
         $("#fatalTd").html("No");
      }
    }

    function redirectUrl () {
        doCancel("{!! URL::to('voice') !!}")
    }

    function getSubCallType(callTypeId) {
        if(callTypeId != ''){
            $.ajax({
                url : base_url+"/getCSubCallTypes",
                method : "get",
                data : { 'callType' : callTypeId },
                cache : false,
                beforeSend : function(){
                    
                },
                success:function(data){
                    $("#subCallTypeDiv").html(data);
                },
                done : function (data){
                },
                error :function (xhr, status, err) {
                    var responseJSON = JSON.parse(xhr.responseText);
                    for (var key in responseJSON) 
                    {
                        $("#"+key+"_alert").html(responseJSON[key]).show();
                    }   
                }
            });
        }else{
            $("#subCallType").html('');
            $('#subCallType').append(
                $('<option />')
                    .text('Select')
                    .val('')
            );

        }
    }

    function validateVoiceForm() {
        calculateQualityScore();
        var maxQuality = $("#maxQuality").html();

        if(parseFloat(maxQuality) == 0.00){
            jAlert("{!! Lang::get('messages.zero_quality')!!}");
            return false;
        }
            return true;
    }

    function checkAdherence() {
        var knowledge = $("#knowledge").val();
        var securityVerification = $("#securityVerification").val();
        var callBackSeverity = $("#callBackSeverity").val();
        var adherenceOther = $("#adherenceOther").val();
       
        if(knowledge == 'No' || securityVerification == 'No' || callBackSeverity == 'No' || adherenceOther == 'No'){
            $("#adherenceTd").html("No");
        }else{
            $("#adherenceTd").html("Yes");
        }
    }

    function checkAppreciation() {
        var appreciation = $("#appreciation").val();
        if(appreciation == ''){
            $("#appreciationTd").html('No')
        }else{
            $("#appreciationTd").html(appreciation);

        }
    }

    function checkMaxSceoreAndArch(fieldId,fieldValue) {
        if(fieldId == 'tm'){
            var data = {!! json_encode($data['tmData']['details']) !!};
        }
        if(fieldId == 'cm'){
            var data = {!! json_encode($data['cmData']['details']) !!};
        }
        if(fieldId == 'chp'){
            var data = {!! json_encode($data['chpData']['details']) !!};
        }
        if(fieldId == 'poa'){
            var data = {!! json_encode($data['poaData']['details']) !!};
        }
        if(fieldId == 'delighter'){
            var data = {!! json_encode($data['delighterData']['details']) !!};
        }
        if(fieldId == 'su'){
            var data = {!! json_encode($data['suData']['details']) !!};
        }
        if(fieldId == 'sct'){
            var data = {!! json_encode($data['sctData']['details']) !!};
        }
        if(fieldId == 'ocr'){
            var data = {!! json_encode($data['ocrData']['details']) !!};
        }
        if(fieldValue !== ''){
            jQuery.each(data, function( key, val ) {
                if(key == fieldValue){
                    $("#"+fieldId+"Max").val(val.maxscore);
                    $("#"+fieldId+"Ach").val(val.achscore);
                    calculateQualityScore();
                }
            });
        }else{
            $("#"+fieldId+"Max").val(0.00);
            $("#"+fieldId+"Ach").val(0.00);
        }

    }

    function updateOcr() {
        var pg = $("#pg").val();
        var ocr = $("#ocr").val();
        var data = {!! json_encode($data['ocrData']['details']) !!};

        if(pg == 'Yes' || ocr == 'Y'){
            jQuery.each(data, function( key, val ) {
                if(key == 'Y'){
                    $("#ocrMax").val(val.maxscore);
                    $("#ocrAch").val(val.achscore);
                }
            });
        }else{
            jQuery.each(data, function( key, val ) {
                if(key == ocr){
                    $("#ocrMax").val(val.maxscore);
                    $("#ocrAch").val(val.achscore);
                }
            });
        }
        calculateQualityScore();
    }

    function calculateQualityScore() {
        var tmMax = $("#tmMax").val();
        var cmMax = $("#cmMax").val();
        var chpMax = $("#chpMax").val();
        var poaMax = $("#poaMax").val();
        var delighterMax = $("#delighterMax").val();
        var suMax = $("#suMax").val();
        var sctMax = $("#sctMax").val();
        var ocrMax = $("#ocrMax").val();

        var qualityMax = 0;

        if(tmMax !== ''){
            qualityMax += parseFloat(tmMax);
        }
        if(cmMax !== ''){
            qualityMax += parseFloat(cmMax);
        }
        if(chpMax !== ''){
            qualityMax += parseFloat(chpMax);
        }
        if(poaMax !== ''){
            qualityMax += parseFloat(poaMax);
        }
        if(delighterMax !== ''){
            qualityMax += parseFloat(delighterMax);
        }
        if(suMax !== ''){
            qualityMax += parseFloat(suMax);
        }
        if(sctMax !== ''){
            qualityMax += parseFloat(sctMax);
        }
        if(ocrMax !== ''){
            qualityMax += parseFloat(ocrMax);
        }

        $("#maxQuality").html(parseFloat(qualityMax).toFixed(2));

        var tmAch = $("#tmAch").val();
        var cmAch = $("#cmAch").val();
        var chpAch = $("#chpAch").val();
        var poaAch = $("#poaAch").val();
        var delighterAch = $("#delighterAch").val();
        var suAch = $("#suAch").val();
        var sctAch = $("#sctAch").val();
        var ocrAch = $("#ocrAch").val();

        var qualityAch = 0;

        if(tmAch !== ''){
            qualityAch += parseFloat(tmAch);
        }
        if(cmAch !== ''){
            qualityAch += parseFloat(cmAch);
        }
        if(chpAch !== ''){
            qualityAch += parseFloat(chpAch);
        }
        if(poaAch !== ''){
            qualityAch += parseFloat(poaAch);
        }
        if(delighterAch !== ''){
            qualityAch += parseFloat(delighterAch);
        }
        if(suAch !== ''){
            qualityAch += parseFloat(suAch);
        }
        if(sctAch !== ''){
            qualityAch += parseFloat(sctAch);
        }
        if(ocrAch !== ''){
            qualityAch += parseFloat(ocrAch);
        }
        $("#achQuality").html(parseFloat(qualityAch).toFixed(2));

        if(parseFloat(qualityAch) != 0 && parseFloat(qualityMax) != 0){
            var quality = (parseFloat(qualityAch) / parseFloat(qualityMax)) * 100;
            $("#qualityTd").html(parseFloat(quality).toFixed(2)+"%");
        }
        
    }
</script>
@stop