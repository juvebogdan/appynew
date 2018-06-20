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
    <p align="center">Credits are added instantly after purchase<br />
    </p>
    <div class="trueHalf">
      <p align="center"><strong>Purchase</strong></p>
      <p align="center">Credits
        <select name="select" id="select">
          <option selected="selected">50</option>
          <option>100</option>
          <option>250</option>
          <option>500</option>
          <option>1000</option>
          <option>2000</option>
        </select>
      </p>
      <p align="center">Credits cost £1 per credit</p>
  <form id="form1" name="form1" method="post" action="">
    <div align="center">
      <input type="submit" id='stripeButton' name="button" id="button" value="Purchase"/>
    </div>
  </form>
    <div align="center" id="forma2" style='background-color:white'>
      <form action="https://www.ammakeup.co.uk/Plans/buyautonew.php" method="POST" id="kesa">
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
        <input type="hidden"  id='amount' name="amount" value="">
        <input type="hidden"  name="username" value="<?php echo $_SESSION['username'] ?>">
      </form>
    </div>  
    </div>
    <div class="trueHalf">
      <p align="center"><strong>Remaining Credits      </strong></p>
      <div align="center">
        <h1><?php echo $credits; ?></h1>
      </div>
      <p align="right">&nbsp;</p>
    </div>
<p align="left">&nbsp;</p>
  </div>
  <div class="editingwindow">
    <hr />
    <p>How the credits system works<span class="tiny"></span></p>
    <p class="tiny">We have 6 different tariffs and each tarriff will consume a different amount of credits based on it duration.</p>
    <table width="597" border="0" cellspacing="5">
      <tr>
        <td width="297"><div align="center"><strong>Duration</strong></div></td>
        <td width="300"><div align="center"><strong>Credit Cost</strong></div></td>
      </tr>
      <tr>
        <td><div align="center">Trial (24 hours Mon - Fri)</div></td>
        <td><div align="center">0</div></td>
      </tr>
      <tr>
        <td><div align="center">Weekender (48 hours Fri &amp; Sat)</div></td>
        <td><div align="center">1</div></td>
      </tr>
      <tr>
        <td><div align="center">1 Month</div></td>
        <td><div align="center">3</div></td>
      </tr>
      <tr>
        <td><div align="center">3 Months</div></td>
        <td><div align="center">9</div></td>
      </tr>
      <tr>
        <td><div align="center">6 Months</div></td>
        <td><div align="center">15</div></td>
      </tr>
      <tr>
        <td><div align="center">12 Months</div></td>
        <td><div align="center">30</div></td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <p class="tiny">When you are low on credits we will email you.</p>
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
    $('#amount').val($( "#select option:selected" ).val());
    $('.stripe-button-el').trigger("click");
  }      
});
</script>
<!-- InstanceEnd --></html>
