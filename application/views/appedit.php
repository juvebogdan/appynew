<?//php print_r($_SESSION);?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/MainTemplate.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Purchase App Edits</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<?php $this->load->view('links/links'); ?>

  <!-- InstanceBeginEditable name="EditingPane" -->
  <div class="editingwindow">
    <div align="center" class="price">
      <p>Purchase App Edits<br />
        <span class="tiny">App edits are chargeable
      and are completed on a queue system. Please only request edits via this system.<br />
      Emailed or Skyped requests will no longer be accepted.</span></p> </div>
      <div class="trueHalf">Type of Edit: 
        <select id='select' name="select" id="select">
          <option name="£24.99" value='npd' selected="selected">New Payment Details</option>
          <option name="£90.00" value='npp'>New Payment Processor</option>
          <option name="£24.99" value='nac'>New IPTV/App Charges</option>
          <option name="£24.99" value='nad'>New App Details</option>
          <option name="£ POA" value='other'>Other</option>
        </select>
      </div>
<?php echo form_open_multipart('', 'id="npd" method="post"'); ?>
<div class="trueHalf dio npd">
        <div align="right">
          <p>Type:
          <select name="select2" id="select2">
            <option name="stripe" value='Stripe' selected="selected">Stripe</option>
            <option name="square" value='Square Pay'>Squared Pay</option>
            <option name="paypal" value='PayPal'>PayPal</option>
          </select>
          </p>
          <p><label id='c1'>Live SK:</label>
          <input type="text" name="username" id="textfield" />
          </p>
          <p><label id='c2'>Live PK:</label>
              <input type="text" name="password" id="textfield2" />
          </p>
          <hr />
        <p>&nbsp;</p>
        </div>
</div>
<?php echo form_close(); ?>
<?php echo form_open_multipart('', 'id="npp" method="post"'); ?>
<div class="trueHalf dio npp" style='display:none'>
        <div align="right">
          <p>Type:
          <select name="select3" id="select3">
            <option name="stripe2" value='Stripe' selected="selected">Stripe</option>
            <option name="square2" value='Square Pay'>Squared Pay</option>
            <option name="paypal2" value='PayPal'>PayPal</option>
          </select>
          </p>
          <p><label id='c3'>Live SK:</label>
          <input type="text" name="username2" id="textfield3" />
          </p>
          <p><label id='c4'>Live PK:</label>
              <input type="text" name="password2" id="textfield4" />
          </p>
          <hr />
        <p>&nbsp;</p>
        </div>
</div>
<?php echo form_close(); ?>
<?php echo form_open_multipart('', 'id="nac" method="post"'); ?>
<div class="trueHalf dio nac" style='display:none'>
        <p align="center">New IPTV Charges</p>
        <p align="right">Monthly: 
          <select name="monthly" id="monthly">
            <option>$ USD</option>
            <option>£ GBP</option>
            <option>€ EUR</option>
          </select>
          <input name="textfield7" type="text" id="textfield7" size="4" />
        </p>
        <p align="right">Annual: 
          <select name="annual" id="annual">
            <option>$ USD</option>
            <option>£ GBP</option>
            <option>€ EUR</option>
          </select>
          <input name="textfield6" type="text" id="textfield8" size="4" />
        </p>
        <hr />
        <p align="center">New App Charges</p>
        <p align="right">New trial period: 
          <input name="trial" type="text" id="trial" size="4" /> 
          Days
        </p>
        <p align="right">Payment frequency: 
          <select name="payf" id="payf">
            <option>Daily</option>
            <option>Monthly</option>
            <option>Annual</option>
          </select>
        </p>
        <p align="right">Tariff: 
          <select name="tariff" id="tariff">
            <option>$ USD</option>
            <option>£ GBP</option>
            <option>€ EUR</option>
          </select>
          <input name="tariffv" type="text" id="tariffv" size="4" />
        </p>
</div>
<?php echo form_close(); ?>
<?php echo form_open_multipart('', 'id="nad" method="post"'); ?>
<div class="trueHalf dio nad" style='display:none'>
    <p align="left"><u>Please upload a new backgrpund image</u></p>
		<p>
			<input type="file" name="fileField1" id="imgInp1" value="Choose File" />
		</p>
	<p align="left"><u>Please upload a new app logo image</u></p>
		<p>
			<input type="file" name="fileField2" id="imgInp2" value="Choose File" />
		</p>
	<p>
            New app name:
            <input type="text" name="title1" id="appname" value=''/>
          </p>
    <p>
            New intro video URL:
            <input type="text" name="title2" id="videourl" value=''/>
          </p>
</div>
<?php echo form_close(); ?>
<?php echo form_open_multipart('', 'id="other" method="post"'); ?>
<div class="trueHalf dio other" style='display:none'>
        <p align="center">Other Edits<span class="tiny"><br />
        We will quote your edit to the email address you enter below.</span></p>
        <p>Contact Email: 
          <input type="text" name="textfield11" id="textfield11" />
        </p>
        <p>Describe your edit        
          <textarea name="textarea" id="textarea" cols="45" rows="5"></textarea>
        </p>
</div>
<?php echo form_close(); ?>
<p>&nbsp;    </p>
   
  </div>
  <div class="editingwindow">
    <div align='center' id='poruka'></div>
      <div align="center" id='zastripe'>
        <hr />
        <input  type="button" name="button" id="button" value="Submit Edit" />
      </div>
  </div>
  <!-- InstanceEndEditable --></div>
<div class="footer">
  <div align="center">visit <a href="http://www.avstream.tv">www.avstream.tv</a> for the latest news</div>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
 $("#select").change(function()
 {
  $(".dio").css('display','none');
  var klasa=$(this).val();
  $("."+klasa).css('display','block');
  //alert(klasa);
 }); 
 $("#button").click(function()
 {
  $("#button").hide();
  $("#poruka").html('<img src="../../../loadgif/ajax-loader.gif" style=""/>');

  var klasa=$("select").val();
  //alert('cao');
  if(klasa!='nad')
  {
  data=$("#"+klasa).serialize();
  data=data+"&type="+$('#select').val();
    $.ajax({
              url: '<?php echo base_url(); ?>appy/appedits', 
              type: "POST",            
              data: data,             
              success: function(data)   
              {
                if(data=='edit is uploaded')
                {
                    $("#poruka").html('Edit is uploaded. We will send you an email');
                }
                else
                {
                    $("#zastripe").html(data);  
                    $("#poruka").html('Edit is uploaded. Please pay to proceed!');   
                }
              }
          });
  }
  else
  {
    var data2 = new FormData();

    for(var i= 0, file; file = filesArray[i]; i++)
    {
        data2.append('files1[]', file);

    }
    for(var i= 0, file; file2 = filesArray1[i]; i++)
    {
        data2.append('files2[]', file2);

    }
    data2.append('NewAppname',$( "#appname" ).val());
    data2.append('NewIntroVideoURL',$( "#videourl" ).val());
    data2.append('type',"nad");
    console.log(data2);

  
  $.ajax({
              url: '<?php echo base_url(); ?>appy/appedits', 
              type: "POST",            
              data: data2,
              contentType: false,       
              cache: false,             
              processData:false,             
              success: function(data)   
              {
                if(data=='edit is uploaded')
                {
                    $("#poruka").html('Edit is uploaded. We will send you an email') 
                }
                else
                {
                    $("#zastripe").html(data);  
                    $("#poruka").html('Edit is uploaded. Please pay to proceed!')   
                }
              }
          });
  }
 });
 $("#select2").change(function()
 {
  if($(this).val()=='Stripe')
  {
    //alert('cao');
    $("#c1").html("Live SK");
    $("#c2").html("Live PK");
  }
  else
  {
    $("#c1").html("Username");
    $("#c2").html("Password");
  }
  //alert(klasa);
 }); 
  $("#select3").change(function()
 {
  if($(this).val()=='Stripe')
  {
    //alert('cao');
    $("#c3").html("Live SK");
    $("#c4").html("Live PK");
  }
  else
  {
    $("#c3").html("Username");
    $("#c4").html("Password");
  }
  //alert(klasa);
 });
var filesArray = [];
var filesArray1 = [];
$("#imgInp1").on('change', function(e)
{
  var files = e.target.files;
       
    var eventTrigger = e.currentTarget.id;
    
      for (var i = 0, f; f = files[i]; i++) {

                      
          if (!f.type.match('image.*')) {
              continue;
          }

          var reader = new FileReader();

                      
          reader.onload = (function(theFile) {
            return function(e) {          
            
              if (eventTrigger=='imgInp1') {
               
                filesArray[0] = theFile;
              }
              
              console.log(filesArray);

            };
          })(f);
          reader.readAsDataURL(f);
      }
});
$("#imgInp2").on('change', function(e)
{
  var files = e.target.files;
       
    var eventTrigger = e.currentTarget.id;
    
      for (var i = 0, f; f = files[i]; i++) {

                      
          if (!f.type.match('image.*')) {
              continue;
          }

          var reader = new FileReader();

                      
          reader.onload = (function(theFile) {
            return function(e) {          
            
              if (eventTrigger=='imgInp2') {
               
                filesArray1[0] = theFile;
              }
              
              console.log(filesArray1);

            };
          })(f);
          reader.readAsDataURL(f);
  }
});


</script>
<!-- InstanceEnd --></html>
