@extends('layout.admin')
@section('content')

<section class="inner-form-wrapper">
	<div id="inner-wrapper">
        <div class="breadcrumb-wrapper white-bg">
            <ol class="breadcrumb">
                <li>
                    Voice
                </li>
                <li class="active">
                    <strong>Create Voice</strong>
                </li>               
            </ol>               
        </div>
        
        <article>
            <div class="row">
            	<div class="col-lg-12">
                    {!! Form::open(array('route' => 'voice.store' , 'onSubmit' => 'return validateVoiceForm()')) !!}
            		@include('voice.templates.inbondprocess')
                    <div class="panel-group" id="accordion">
                		@include('voice.templates.fatal')
    			
    					@include('voice.templates.adherence')

                		@include('voice.templates.quality')
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

        @if(!empty($errors))
            $("#callType").trigger("change");
            setTimeout(function(){
                $("#subCallType").val({!! Request::old('subCallType') !!})
            }, 2000);
        @endif        
    })

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
</script>
@stop