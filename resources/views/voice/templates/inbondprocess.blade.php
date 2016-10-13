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
                    {!! Form::text('date',date("d-M-Y"),array("placeholder"=>"Date",'id'=>'date','class'=>'form-control','autocomplete'=>'off','readonly'=>true)) !!} 
                    <div id="date_alert" class="error validationAlert validationError">{!!$errors->first('date')!!}</div>
                 </div>
              </div>
              <div class="col-lg-3 col-md-4">
                <div class="form-group">
                    <label>Process</label>
                    <select class="form-control">
                       <option>1</option>
                       <option>2</option>
                    </select>
                 </div>
              </div>
              <div class="col-lg-3 col-md-4">
                <div class="form-group">
                    <label>Agent</label>
                    <select class="form-control">
                       <option>1</option>
                       <option>2</option>
                    </select>
                 </div>
              </div>
              <div class="col-lg-3 col-md-4">
                <div class="form-group">
                    <label>Team Leader</label>
                    <select class="form-control">
                       <option>1</option>
                       <option>2</option>
                    </select>
                 </div>
              </div>
              <div class="col-lg-3 col-md-4">
                <div class="form-group">
                    <label>Manager</label>
                    <select class="form-control">
                       <option>1</option>
                       <option>2</option>
                    </select>
                 </div>
              </div>
              <div class="col-lg-3 col-md-4">
                <div class="form-group">
                    <label>Category</label>
                    <select class="form-control">
                       <option>1</option>
                       <option>2</option>
                    </select>
                 </div>
              </div>
              <div class="col-lg-3 col-md-4">
                <div class="form-group">
                    <label for="client-id">Client ID</label>
                    <!-- only alpha numeric-->
                    <input class="form-control" type="text" id="clientID" placeholder="Client ID" maxlength="5">
                 </div>
              </div>
              <div class="col-lg-3 col-md-4">
                <div class="form-group">
                    <label for="call-id">Call ID</label>
                    <input class="form-control" type="text" id="callID" placeholder="Call ID">
                 </div>
              </div>
              <div class="col-lg-3 col-md-4">                
                 <div class="form-group">
                    <label for="duration">Duration</label>
                    <input class="form-control" type="text" id="duration" placeholder="Duration">
                 </div>
              </div>
              <div class="col-lg-3 col-md-4"> 
                <div class="form-group">
                    <label>Call Type</label>
                    <select class="form-control">
                       <option>1</option>
                       <option>2</option>
                    </select>
                 </div>
              </div>
              <div class="col-lg-3 col-md-4">
                <div class="form-group">
                    <label>Sub-Call Type</label>
                    <select class="form-control">
                       <option>1</option>
                       <option>2</option>
                    </select>
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
            <td>Yes/No</td>
          </tr>
          <tr>
            <td><strong>Adherence</strong></td>
            <td>Yes/No</td>
          </tr>
          <tr>
            <td><strong>Quality</strong></td>
            <td>%</td>
          </tr>
          <tr>
            <td><strong>Appreciation</strong></td>
            <td>Yes/No</td>
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
  });
</script>
</section>