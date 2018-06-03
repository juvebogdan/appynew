<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/MainTemplate.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Gaming</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<?php $this->load->view('links/links'); ?>

  <!-- InstanceBeginEditable name="EditingPane" -->
    <div class="editingwindow">
      <p align="center" class="price">Gaming</p>
      <p align="left"><u>Please upload a banner image for the Gaming screen</u></p>
      <div class="trueHalf">
        <p>
          <input type="file" name="fileField" id="imgInp" value="Choose File" />
          <br />
          <span class="tiny">Banner images are advertisment images</span><br />
          <strong>1920 x 350 .png</strong></p>
      </div>
      <div class="trueHalf">Preview<br />
      <?php
      if (file_exists('/var/www/appy.zone/public_html/' . $_SESSION['username'] . '/V5/gaming/banner/image.png')) {
        echo "<img class='img1' style='width:300px;height:55px;border:1px solid red;' src='http://appy.zone/" . $_SESSION['username'] . "/V5/gaming/banner/image.png'/>";
      } 
      else {
        echo "<img class='img1' style='width:300px;height:55px;border:1px solid red;'/>";        
      }
      ?>
      </div>
      <p>&nbsp;</p>
  </div>
  <?php echo form_open_multipart('', 'id="form1" method="post"'); ?>
    <div class="editingwindow">
      <p><strong><u>Call to Action Button on Banner</u></strong></p>
      <div class="trueHalf">
        <p>Show Button?
          <input type="checkbox" name="checkbox" id="checkbox" <?php 
              if ($checkboxstate[0]==1) {
                  echo " checked";
              }
           ?>/>
        </p>
      </div>
      <div class="trueHalf">
        <p align="right" id='actionclick' <?php 
          if ($checkboxstate[0]!=1) {
            echo ' style="display: none;"';
          }
        ?>>Action on Click:
          <select name="select" id="actions">
            <option></option>
            <option value='1' <?php $x=(isset($banneraction[0])&&trim($banneraction[0])=="1") ? "selected" : "";echo " " . $x; ?>>IPTV Payment</option>
            <option value='2' <?php $x=(isset($banneraction[0])&&trim($banneraction[0])=="2") ? "selected" : "";echo " " . $x; ?>>Install/Launch App</option>
            <option value='3' <?php $x=(isset($banneraction[0])&&trim($banneraction[0])=="3") ? "selected" : "";echo " " . $x; ?>>Open Web Page</option>
          </select>
        </p>
        <p align="right" id='urlclick' <?php 
            if (isset($banneraction[0]) && $banneraction[0]!=2 && $banneraction[0]!=3) {
              echo 'style="display: none;"';
            }
        ?>>URL:
          <input type="text" name="url" id="url" <?php 
            if (isset($banneraction[0]) && $banneraction[0]==2) {
                echo ' value="' . $url[0] . '"';
            }
            else if (isset($banneraction[0]) && $banneraction[0]==3) {
                echo ' value="' . $weburl[0] . '"';
            }
            else {
              echo ' value=""';
            }
          ?>/>
        </p>
        <p align="right" id='packageclick' <?php 
            if (isset($banneraction[0])&&$banneraction[0]!=2) {
              echo 'style="display: none;"';
            }
        ?>> Package:
          <input type="text" name="package" id="package"  <?php 
            if (isset($banneraction[0])&&$banneraction[0]==2) {
                echo ' value="' . $package[0] . '"';
            }
            else {
              echo ' value=""';
            }
          ?>/>
        </p>
      </div>
<p>&nbsp;</p>
    </div>
    <div class="editingwindow">
      <hr />
      <p>The gaming section is static. Please help support the gaming section by uploading ROMs in the uploads section and make them available to the whole community.</p>
      <hr />
      <div align="center">Once you have completed this form please press submit      </div>
        <div align="center">
          <input type="submit" name="submit" id="submitbutton" value="Submit" />
        </div>
    </div>
    <div style='margin-top:15px;margin-bottom:10px' id="loadingDiv">
      <div align="center">
        <img src="<?php echo base_url(); ?>gif/ajax-loader.gif" style=""/>
      </div>
    </div>
  <!-- InstanceEndEditable --></div>
<?php echo form_close(); ?>
<div class="footer">
  <div align="center">visit <a href="http://www.avstream.tv">www.avstream.tv</a> for the latest news</div>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $('#loadingDiv').hide();
  var filesArray = [];
  $('#form1 :checkbox').change(function() {
      // this will contain a reference to the checkbox   
      if (this.checked) {
          $('#actionclick').show();
      } else {
          $("#actions").val('');
          $('#actionclick').hide();
          $('#urlclick').hide();
          $('#packageclick').hide();
      }
  });

  $('#actions').on('change', function() {
      if($( "#actions option:selected" ).text()=='IPTV Payment') {
          $('#urlclick').hide();
          $('#packageclick').hide();
          $('#url').val('');
          $('#package').val('');          
      }
      else if ($("#actions option:selected").text()=='Install/Launch App') {
          $('#urlclick').show();
          $('#packageclick').show();
      }
      else if ($("#actions option:selected").text()=='Open Web Page') {
          $('#urlclick').show();
          $('#packageclick').hide();
          $('#package').val('');                    
      }
  });

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
  $("#imgInp").on('change', previewFiles);
  $("#button1").click(function() { 
    $("#build2").show();
  });
  $("#button2").click(function() {
    $("#build3").show();
  }); 
  $("#button3").click(function() {
    $("#build4").show();
  }); 
  $("#button4").click(function() {
    $("#build5").show();
  }); 

  function submitForm(e)
  {     
    e.preventDefault();                
    var formData = new FormData();
    var checkboxStatus;

    for(var i= 0, file; file = filesArray[i]; i++)
    {
        formData.append('files[]', file);
    }
    formData.append('checkstatus',$("#checkbox").is(':checked'));
    formData.append('hexcolor',$('#colorpickerField1').val());
    formData.append('action',$( "#actions option:selected" ).val());
    formData.append('url',$( "#url" ).val());
    formData.append('package',$( "#package" ).val());   
      if (filesArray.length == 1) {
          $.ajax({
              url: '<?php echo base_url(); ?>appy/gamingsubmit', 
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
                $('input[type="submit"]').prop('disabled', false);
                $("#loadingDiv").hide();                
              }
          });
      }
      else {
        alert("Please upload banner image");
      }
  }

 $('#form1').on('submit', submitForm); 

});
</script>
</html>
<!-- The Modal -->S