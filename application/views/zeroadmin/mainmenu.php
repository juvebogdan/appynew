<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/MainTemplate.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Menu Options</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<style type="text/css">
body,td,th {
	color: #333;
}
</style>
<!-- InstanceEndEditable -->
<?php $this->load->view('links/links'); ?>

  <!-- InstanceBeginEditable name="EditingPane" -->
  <div class="editingwindow">
      <h2 align="center" class="price">Set up the Menu Options &amp; Background Image</h2>
      <p align="center">&nbsp;</p>
      <p><u>Global Background</u></p>
      <div class="trueHalf">
        <p>
          <input type="file" name="fileField2" id="imgInp" value="Choose File" />
          <br />
          <span class="tiny">Solid coloured backgrounds or textures work best</span><br />
          <strong>1920 x 1080 .png</strong></p>
      </div>
      <div class="trueHalf">Preview<br />
      <?php
      if (file_exists('/var/www/appy.zone/public_html/' . $_SESSION['username'] . '/V5/bg.png')) {
        echo "<img class='img1' style='width:256px;height:144px;border:1px solid red;' src='http://appy.zone/" . $_SESSION['username'] . "/V5/bg.png'/>";
      } 
      else {
        echo "<img class='img1' style='width:256px;height:144px;border:1px solid red;'/>";        
      }
      ?>
      </div>
<p>&nbsp;</p>
  </div>
  <?php echo form_open_multipart('', 'id="form1" method="post"'); ?>
  <div class="editingwindow">
  <hr />
      <p><u>IPTV Menu Title</u><br />
      <span class="tiny">Header menu titles from left to right after the Home title. Home & Settings are fixed in position.</span></p>
      <div class="trueHalf">
          <p align="center"><strong>IPTV Menu Title</strong></p>
          <p align="center">
            Label: 
            <label>
              <input type="text" name="textfield1" id="textfield1" value='<?php echo $titles[0] ?>'/>
            </label>
          </p>
          <p align="center"> Action
            <label>
              <select name="select1" id="select1">
                <option value='2' <?php $x=trim($actions[0])=="2" ? "selected" : "";echo $x; ?>>IPTV</option>
              </select>
            </label>
          </p>
      </div>
    </div>
    <div class="editingwindow">
      <div align="center">
        <hr />
        Once you have completed this form please press submit</div>
        <div align="center">
          <input type="submit" name="button" id="button" value="Submit" />
        </div>
    </div>
    <div style='margin-top:15px;margin-bottom:10px' id="loadingDiv">
      <div align="center">
        <img src="<?php echo base_url(); ?>gif/ajax-loader.gif" style=""/>
      </div>
    </div>    
<?php echo form_close(); ?>
  <!-- InstanceEndEditable --></div>
<div class="footer">
  <div align="center">visit <a href="http://www.avstream.tv">www.avstream.tv</a> for the latest news</div>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $('#loadingDiv').hide();
  var filesArray = [];
  function previewFiles( e ) {
    
    var files = e.target.files;
       
    var eventTrigger = e.currentTarget.id;
    
      for (var i = 0, f; f = files[i]; i++) {

                      
          if (!f.type.match('image.*')) {
              continue;
          }

          var reader = new FileReader();

                      
          reader.onload = (function(theFile) {
            return function(e) {          
            
              if (eventTrigger=='imgInp') {
                $('.img1').attr('src', e.target.result);
                filesArray[0] = theFile;
              }
              
              console.log(filesArray);

            };
          })(f);

                      
          reader.readAsDataURL(f);
      }
  }

  function submitForm(e)
  {        
    e.preventDefault();                
    var formData = new FormData();

    for(var i= 0, file; file = filesArray[i]; i++)
    {
        formData.append('files[]', file);
    }
      formData.append('title1',$('#textfield1').val());
      formData.append('action1',$( "#select1 option:selected" ).val());
          $.ajax({
              url: '<?php echo base_url(); ?>zeroadmin/mainmenuupload', 
              type: "POST",            
              data: formData,
              contentType: false,       
              cache: false,             
              processData:false,
              beforeSend: function() {
                $('input[type="submit"]').prop('disabled', true);
                $("#loadingDiv").show();
              },                             
              success: function(data)   
              {
                alert(data);
                console.log(data);
                $('input[type="submit"]').prop('disabled', false);
                $("#loadingDiv").hide();                
              }
          });
  }



  $("#imgInp").on('change', previewFiles);
  $('#form1').on('submit', submitForm);
});

</script>

<!-- InstanceEnd -->
</html>
