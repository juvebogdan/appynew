<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/MainTemplate.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>IPTV Income Review</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<?php $this->load->view('links/links'); ?>
  <!-- InstanceBeginEditable name="EditingPane" -->
  <div class="editingwindow">
    <p align="center"><span class="price">Income Review</span></p>
    <div class="trueHalf">
      <div align="center">Period:
        <select name="select3" id="type">
          <option selected="selected" value='all'>All Time</option>
          <option value='current'>Month to date</option>
          <option value='last'>Last Month</option>
          <option value='01'>January</option>
          <option value='02'>February</option>
          <option value='03'>March</option>
          <option value='04'>April</option>
          <option value='05'>May</option>
          <option value='06'>June</option>
          <option value='07'>July</option>
          <option value='08'>August</option>
          <option value='09'>September</option>
          <option value='10'>October</option>
          <option value='11'>November</option>
          <option value='12'>December</option>
        </select>
      </div>
    </div>
    <div class="trueHalf">
      <div align="center"></div>
    </div>
    <p align="center"><br />
    </p>
  </div>
  <div class="editingwindow">
    <table width="90%" border="1" cellspacing="5" bgcolor="#EAEAEA">
      <tr>
        <td width="38%"><strong>Type</strong></td>
        <td width="43%"><div align="center"><strong>Amount</strong></div></td>
        <td width="19%"><div align="center"><strong>Value</strong></div></td>
      </tr>
      <tr>
        <td>Users</td>
        <td><div align="center" id='numusers'><?php echo $numusers; ?></div></td>
        <td><div align="center" id='usersvalue'>£ <?php echo $valueusers; ?></div></td>
      </tr>
      <tr>
        <td>Credits</td>
        <td><div align="center" id='numcredits'><?php echo $numcredits; ?></div></td>
        <td><div align="center" id='creditsvalue'>£ <?php echo $valuecredits; ?></div></td>
      </tr>
      <tr>
        <td>Paypal fees</td>
        <td><div align="center" id='paypalfees'>-3.4% + 0.20/sale</div></td>
        <td><div align="center"><font color="#FF0000" id='paypalresult'>£ <?php echo $paypalfees; ?></font></div></td>
      </tr>
      <tr>
        <td>Stripe fees</td>
        <td><div align="center" id='stripefees'>-1.4% + 0.20/sale</div></td>
        <td><div align="center"><font color="#FF0000" id='striperesult'>£ <?php echo $stripefees; ?></font></div></td>
      </tr>
      <tr>
        <td>Partner fees</td>
        <td><div align="center">-60%</div></td>
        <td><div align="center" id='partnerfees'><font color="#FF0000">£ <?php echo $partnerfees; ?></font></div></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><div align="center"></div></td>
        <td><div align="center"></div></td>
      </tr>
      <tr>
        <td><strong>TOTAL PAYABLE</strong></td>
        <td><div align="center" id='total'></div></td>
        <td><div align="center"><strong id='totalvalue'>£ <?php echo $total; ?></strong></div></td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <p align="left" class="tiny"><strong>Users: </strong>Packages sold via Appy<br />
      <strong>Credits</strong>: Credits sold across all resellers<br />
      <strong>Paypal &amp; Stripe fees:</strong> Only user access sales are via paypal. Credits are sold via Stripe <br />
    <strong>60% partner fees:</strong> 10% to the Stripe/PayPal account holder + 40% to other partner</p>
  </div>
  <!-- InstanceEndEditable --></div>
<div class="alert alert-success alert-flash" role="alert" id='flash' style='display: none;'>
  <strong>Success</strong>
</div>
<div class="alert alert-danger alert-flash" role="alert" id='flasherror' style='display: none;'>
  <strong>Not found</strong>
</div> 
<div class="footer">
  <div align="center">visit <a href="http://www.avstream.tv">www.avstream.tv</a> for the latest news</div>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>js/flash.js"></script>
<script src="<?php echo base_url(); ?>js/incomereview.js"></script>
<!-- InstanceEnd --></html>
