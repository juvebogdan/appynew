<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/MainTemplate.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Manual Credit Sales</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php $this->load->view('links/links'); ?>
  <div class="editingwindow">
    <p align="center" class="price">Manually add credits to client account</p>
    <div class="trueHalf">
      <p align="center"><br />
        Client App Name: 
        <select name="select" id="select">
        </select>
      </p>
      <p align="center">Amount of credits: 
        <input name="textfield" type="text" id="textfield" size="8" maxlength="8" />
      </p>
      <p align="center">Value of sale: £
        <input name="textfield2" type="text" id="textfield2" size="8" maxlength="8" />
      </p>
      <p align="center">
        <input type="submit" name="button" id="button" value="Add Credits" />
      </p>
    </div>
    <div class="trueHalf">
      <h2 align="center">Stats</h2>
      <p align="center">Period: 
        <select name="select3" id="select3">
          <option selected="selected">All Time</option>
          <option>Month to date</option>
          <option>Last Month</option>
          <option>January</option>
          <option>February</option>
          <option>March</option>
          <option>April</option>
          <option>May</option>
          <option>June</option>
          <option>July</option>
          <option>August</option>
          <option>September</option>
          <option>October</option>
          <option>November</option>
          <option>December</option>
        </select>
      </p>
      <p align="center">Amount of credits: 
        <input name="textfield3" type="text" id="textfield3" size="8" maxlength="8" />
      </p>
      <p align="center">Value of sales: £
        <input name="textfield4" type="text" id="textfield4" size="8" maxlength="8" />
      </p>
    </div> 
<p>&nbsp;</p>
  </div>
  <!-- InstanceEndEditable --></div>
<div class="footer">
  <div align="center">visit <a href="http://www.avstream.tv">www.avstream.tv</a> for the latest news</div>
</body>
<!-- InstanceEnd --></html>
