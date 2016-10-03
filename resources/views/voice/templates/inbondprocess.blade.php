<section class="panel-wrapper">
<div class="row">
  <div class="col-lg-9 col-md-8">
    <article id="inbondForm" class="panel panel-default panel-inbond">
      <div class="panel-heading">
        <h4 class="panel-title">Inbond</h4>
      </div>        
      <div class="panel-body">
        <form>
           <div class="row">
              <div class="col-lg-3 col-md-4">
                 <div class="form-group">
                    <label for="transaction-id">Transaction ID</label>
                    <input class="form-control" type="text" id="transactionID" placeholder="Transaction ID">
                 </div>
              </div>
              <div class="col-lg-3 col-md-4">
                 <div class="form-group">
                    <label for="date">Date</label>
                    <input class="form-control" type="text" id="date" placeholder="Date">
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
                    <input class="form-control" type="text" id="clientID" placeholder="Client ID">
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
        </form>
      </div><!-- .panel-body -->   
    </article>
  </div>
  <div class="col-lg-3 col-md-4">
    <article class="panel panel-default panel-score">
      <div class="panel-heading">
        <h4 class="panel-title">Score</h4>
      </div>
      <div class="panel-body">
        <p><strong>Fatal</strong>: Yes/No</p>
        <p><strong>Adherence</strong>: Yes/No</p>
        <p><strong>Quality</strong>: %</p>
        <p><strong>Appreciation</strong>: Yes/No</p>
      </div>
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