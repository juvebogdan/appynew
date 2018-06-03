<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/MainTemplate.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<style>
    .level { display: flex; align-items: center; }
    .level-item { margin-right: 1em; }
    .flex { flex: 1; }
    .mr-1 { margin-right: 1em; }
    .ml-a { margin-left: auto; }
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Buy Credits</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<?php $this->load->view('links/links'); ?>

  <!-- InstanceBeginEditable name="EditingPane" -->
  <div class="editingwindow">
    <p>Order your credits online </p>
    <?php if(isset($creditStatus)): ?>
	    <div class="level">
	        <h5 class="flex">
            <?php if(isset($creditStatus)): ?>
	        	VPN credits status: <?php echo $creditStatus; ?>
          <?php endif; ?>
	        </h5>
	    </div>
	<?php endif; ?>
    <div>
      <p align="center">Monthly credits
    <select name="select" id="select">
      <option selected="selected">50</option>
      <option>100</option>
      <option>200</option>
      <option>500</option>
      <option>1000</option>
    </select>
  </p>
  <form id="form1" name="form1" method="post" action="">
    <div align="center" style='margin: : 0 auto; text-align: center;'>
      <input type="submit" id='stripeButton' name="button" id="button" value="Purchase"/>
    </div>    
  </form>
    <div align="center" id="forma2" style='background-color:white'>
      <form action="https://www.ammakeup.co.uk/Plans/charge.php" method="POST" id="kesa">
        <script
        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
        data-key="pk_live_sl2CtqWyBLXj3ePFq9f0Rfdw"
        data-amount="Checkout"
        data-name="VPN Credits"
        data-description="Buy VPN credits"
        data-image="http://www.lodi.mobi/wp-content/uploads/2016/02/new512.png"
        data-locale="auto"
        data-currency="gbp">
        </script>
        <input type="hidden"  id='amount' name="amount" value="">
        <input type="hidden"  name="username" value="<?php echo $_SESSION['username'] ?>">
      </form>
    </div>
  <p align="right">&nbsp;</p>
    </div>
    <p align="left">&nbsp;</p>
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
</html>
