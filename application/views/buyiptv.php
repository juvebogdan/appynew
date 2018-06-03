<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/MainTemplate.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Buy Credits</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<?php $this->load->view('links/links'); ?>

  <!-- InstanceBeginEditable name="EditingPane" -->
  <div class="editingwindow">
    <p>Order your credits online<br />
    <span class="tiny">Your IPTV panel will be opened after your first purchase</span>    </p>
    <div class="trueHalf">
      <p align="right">Monthly credits
    <select name="select" id="select">
      <option selected="selected"></option>
      <option>10</option>
      <option>20</option>
      <option>50</option>
      <option>100</option>
    </select>
  </p>
  <p align="right">Annual credits
    <select name="select2" id="select2">
      <option selected="selected"></option>
      <option>5</option>
      <option>10</option>
      <option>15</option>
      <option>20</option>
      <option>50</option>
    </select>
  </p>
  <form id="form1" name="form1" method="post" action="">
    <div align="center">
      <input type="submit" id='stripeButton' name="button" id="button" value="Purchase"/>
    </div>
  </form>
    <div align="center" id="forma2" style='background-color:white'>
      <form action="https://www.ammakeup.co.uk/Plans/appyzone.php" method="POST" id="kesa">
        <script
        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
        data-key="pk_live_sl2CtqWyBLXj3ePFq9f0Rfdw"
        data-amount="Checkout"
        data-name="IPTV Credits"
        data-description="Buy IPTV credits"
        data-image="http://www.lodi.mobi/wp-content/uploads/2016/02/new512.png"
        data-locale="auto"
        data-currency="gbp">
        </script>
        <input type="hidden"  id='monthly' name="monthly" value="">
        <input type="hidden"  id='anual' name="anual" value="">
        <input type="hidden"  name="username" value="<?php echo $_SESSION['username'] ?>">
      </form>
    </div>
  <p align="right">&nbsp;</p>
    </div>
    <p align="left">&nbsp;</p>
  </div>
  <div class="editingwindow">
    <hr />
    <p><a href="http://xtream-codes.is-found.org/">Click here     to login to your IPTV panel<br />
    </a><span class="tiny">Username and password are the same as your appy zone credentials</span></p>
    <p>Once logged in select &quot;Create New Line&quot;<br />
      Enter a username for your client, select a package.<br />
      A new option will appear. Choose official line or test line.<br />
      An official line will use a credit.<br />
    A test line will grant 24 hours free access and is does not use any credits.<br />
    <span class="tiny">    *You may only give out 20 test lines in a 24 hour period</span>  </p>
  </div>
  <p>&nbsp;</p>
  <!-- InstanceEndEditable --></div>
<div class="footer">
  <div align="center">visit <a href="http://www.avstream.tv">www.avstream.tv</a> for the latest news</div>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
$(document).ready(function(){

  $('#forma2').hide();
  $('#form1').on('submit', submitForm);

  function submitForm(e){
    e.preventDefault();
    $('#monthly').val($( "#select option:selected" ).val());
    $('#anual').val($( "#select2 option:selected" ).val());
    $('.stripe-button-el').trigger("click");
  }      
});
</script>
<!-- InstanceEnd --></html>
