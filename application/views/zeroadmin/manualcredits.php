<?php //print_r($appnames); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/MainTemplate.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Manual Credit Sales</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>

<body>
<?php $this->load->view('links/links'); ?>
  <div class="editingwindow">
    <p align="center" class="price">Manually add credits to client account</p>
    <div class="trueHalf">
      <p align="center"><br />
        Client Username: 
        <select name="select" id="select">
          <?php
            foreach($appnames as $broj=>$niz)
              printf("<option value='%s'>%s</option>",$niz['username'],$niz['username']);
          ?>
        </select>
      </p>
      <p align="center">Amount of credits: 
        <input name="credits" type="text" id="credits" size="8" maxlength="8" />
      </p>
      <p align="center">Value of sale: £
        <input name="value" type="text" id="value" size="8" maxlength="8" />
      </p>
      <p align="center">
        <input type="button" name="button" id="button" value="Add Credits" />
      </p>
    </div>
    <div class="trueHalf">
      <h2 align="center">Stats</h2>
      <p align="center">Period: 
        <select name="select3" id="select3">
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
<div class="alert alert-success alert-flash" role="alert" id='flash' style='display: none;'>
  <strong>Success</strong>
</div>
<div class="alert alert-danger alert-flash" role="alert" id='flasherror' style='display: none;'>
  <strong>Unsuccessful</strong>
</div> 
  <!-- InstanceEndEditable --></div>
<div class="footer">
  <div align="center">visit <a href="http://www.avstream.tv">www.avstream.tv</a> for the latest news</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>js/flash.js"></script>
<script src="<?php echo base_url(); ?>js/incomereview.js"></script>
<script type="text/javascript">
  populate();
$("#button").click(function()
  {
    var formData = new FormData();
    formData.append('credits',$( "#credits" ).val());
    formData.append('value',$( "#value" ).val());
    formData.append('appname',$( "#select option:selected" ).val());
    $.ajax({         
        type: 'POST',
        url: "http://appy.zone/appynew/iptvcontrol/addcredits",
        data: formData,
        contentType: false,       
        cache: false, 
        dataType: 'json',            
        processData:false,       
        success: function(data){ 
          if(data.success==1)
          {
            flash();
            $("#credits").val('');
            $("#value").val('');
            populate();
          }
          else
          {
            flasherror();
          }
        },
        fail : function()
        {
          flasherror();
        }
      }); 
  });

function populate()
{
      $("#textfield3").val('');
      $("#textfield4").val('');
      var formData = new FormData();
      formData.append('type',$( "#select3 option:selected" ).val());
      console.log($( "#type option:selected" ).val());
      //$('#striperesult').text('£ 6');
      $.ajax({         
        type: 'POST',
        url: "http://appy.zone/appynew/iptvcontrol/populatedatamanual",
        data: formData,
        contentType: false,       
        cache: false, 
        dataType: 'json',            
        processData:false,       
        success: function(data){ 
          console.log(data);
          if (data.success=='0') {      
            flasherror();
          }
          else {  
            $("#textfield3").val(data.data[0].amount);
            $("#textfield4").val(data.data[0].value);
            flash();
          }
        }
      }); 
}
$("#select3").change(function()
  {
    populate();
  });
</script>
<!-- InstanceEnd --></html>
