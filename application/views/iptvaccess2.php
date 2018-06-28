<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/MainTemplate.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>IPTV Access</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="container">
  <?php $this->load->view('links/links'); ?>
  <!-- InstanceBeginEditable name="EditingPane" -->
  <div class="editingwindow">
    <p align="center"><span class="price">IPTV Manual Access</span><br />
    <span class="tiny">Manually activate or extend a users device(s) for IPTV access</span></p>
    <p align="center">User Email address: 
      <input type="text" name="textfield" id="textfield" />
    </p>
    <p align="center"><strong>Or</strong> User IP Address: 
      <input type="text" name="textfield4" id="textfield4" />
      <br />
      <br />
<input type="submit" name="button" id="button" value="Find User" />
    </p>
    <p align="center">Access duration:
      <select name="select2" id="select2">
        <option selected="selected">Select</option>
        <option>Weekender</option>
        <option>1 Month</option>
        <option>3 Months</option>
        <option>6 Months</option>
        <option>12 Months</option>
      </select>
    </p>
    <p align="center">
      <input type="submit" name="button2" id="button2" value="Submit" />
    </p>
    <p align="center"><span class="tiny"><strong>On Submit</strong><br />
      Your IPTV credit account will be debited<br />
      User will be emailed to notify their access<br />
    In app IPTV access will be instant</span></p>
  </div>
  <!-- InstanceEndEditable --></div>
<div class="footer">
  <div align="center">visit <a href="http://www.avstream.tv">www.avstream.tv</a> for the latest news</div>
</div>
</body>
<!-- InstanceEnd --></html>
