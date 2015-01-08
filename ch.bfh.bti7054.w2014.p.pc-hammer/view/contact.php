<div class="container">
<div class="row">
  <div class="col-md-12">
    <br>
    <br>
	<div class="alert alert-success" style="display: none"><strong><span class="glyphicon glyphicon-send"></span> Success! Message sent. (If form ok!)</strong></div>	  
    <div class="alert alert-danger" style="display: none"><span class="glyphicon glyphicon-alert"></span><strong> Error! Please check the inputs. (If form error!)</strong></div>
  </div>
  <form role="form" action="" method="post" >
    <div class="col-lg-6">
      
      <div class="form-group">
        <label for="InputName">Name</label>
        <div class="input-group">
          <input type="text" class="form-control" name="InputName" id="InputName" placeholder="Enter Name" required>
          <span class="input-group-addon"></span></div>
      </div>
      <div class="form-group">
        <label for="InputEmail">E-Mail</label>
        <div class="input-group">
          <input type="email" class="form-control" id="InputEmail" name="InputEmail" placeholder="Enter Email" required  >
          <span class="input-group-addon"></span></div>
      </div>
      <div class="form-group">
        <label for="InputMessage">Message</label>
        <div class="input-group"
>
          <textarea name="InputMessage" id="InputMessage" class="form-control" rows="5" required></textarea>
          <span class="input-group-addon"></span></div>
      </div>
      <div class="form-group">
        <label for="InputReal">What is 4+3? (Simple Spam Checker)</label>
        <div class="input-group">
          <input type="text" class="form-control" name="InputReal" id="InputReal" required>
          <span class="input-group-addon"></span></div>
      </div>
      <input type="submit" name="submit" id="submit" value="Submit" onclick="alert('Sorry no time left to finish this :(')" class="btn btn-info pull-right">
    </div>
  </form>
  <hr class="featurette-divider hidden-lg">
  <div class="col-lg-5 col-md-push-1">
    <address>
    <h3>Office Location</h3>
    <p class="lead"><a href="">PC HAMMER AG<br>
Powerstrasse 22</a><br>
      Phone: 031 234 21 21<br>
      Fax: 031 234 21 20</p>
    </address>
  </div>
</div>

</div>