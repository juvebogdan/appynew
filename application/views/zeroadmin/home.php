<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/MainTemplate.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Home Screen</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<?php $this->load->view('links/links'); ?>

  <!-- InstanceBeginEditable name="EditingPane" -->
    <div class="editingwindow">
      <p align="center" class="price">Home Screen</p>
<p align="left"><u>Please upload a banner image for the homescreen</u></p>
      <div class="trueHalf">
        <p>
          <input type="file" name="fileField" id="imgInp" value="Choose File" />
          <br />
          <span class="tiny">Banner images are advertisment images</span><br />
        <strong>1920 x 350 .png</strong></p>
      </div>
      <div class="trueHalf">Preview<br />
      <?php
      if (file_exists('/var/www/appy.zone/public_html/' . $_SESSION['username'] . '/V5/home/banner/image.png')) {
        echo "<img class='img1' style='width:300px;height:55px;border:1px solid red;' src='http://appy.zone/" . $_SESSION['username'] . "/V5/home/banner/image.png'/>";
      } 
      else {
        echo "<img class='img1' style='width:300px;height:55px;border:1px solid red;'/>";        
      }
      ?>
      </div>
<p>&nbsp;</p>
<p>&nbsp;</p>
  </div>
  <?php echo form_open_multipart('', 'id="form1" method="post"'); ?>
    <div class="editingwindow">
      <p align="left"><u>Call to Action Button on Banner</u></p>
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
<p align="right">
<p>&nbsp;</p>
    </div>
    <div class="editingwindow">
      <hr />
      <p><u>Create the Home Screen Content Rows</u><br />
      <span class="tiny">The home screen is a place for fast access to user generated lists with a maximum of 2 Rows</span></p>
    <div id='content'>
      <div class="trueHalf" id='build1'>
        <div align="center">
          <p>Row 1: 
            <select name="select1" id="select1">
              <option value='3' <?php $x=(isset($actions[0])&&trim($actions[0])=="3") ? "selected" : "";echo " " . $x; ?>>Most Used IPTV</option>
              <option value='4' <?php $x=(isset($actions[0])&&trim($actions[0])=="4") ? "selected" : "";echo " " . $x; ?>>Favourites</option>
            </select>
          </p>
          <p>
          Title: 
          <input type="text" name="title1" id="title1" value='<?php if (isset($titles[0])) echo $titles[0]; ?>'/>
          <br />
          <br />
            <input type="button" name="button1" id="button1" value="Add Another Row" />
          <br />
          <br />
          </p>
        </div>
      </div>
      <div class="trueHalf" id='build2' <?php 
          if ($rows[0]<2) {
            echo ' style="display:none;"';
          }
      ?>'>
        <div align="center">
          <p>Row 2: 
            <select name="select2" id="select2">
              <option value='3' <?php $x=(isset($actions[1])&&trim($actions[1])=="3") ? "selected" : "";echo " " . $x; ?>>Most Used IPTV</option>
              <option value='4' <?php $x=(isset($actions[1])&&trim($actions[1])=="4") ? "selected" : "";echo " " . $x; ?>>Favourites</option>
            </select>
          </p>
          <p>
          Title: 
          <input type="text" name="title2" id="title2" value='<?php if (isset($titles[1])) echo $titles[1]; ?>'/>
          </p>
        </div>
      </div>                       
      <div class="trueHalf">
        <div align="center">
          <p>&nbsp;</p>
          <p>Title Font Colour:
          <input type="text" maxlength="6" size="6" id="colorpickerField1" name='hexcolor' value='<?php if (isset($font[0])) echo $font[0]; ?>' />
          <br />
          <br />
          </p>
        </div>
      </div>
    </div>
<p>&nbsp;</p>
    </div>
  <div class="editingwindow">
      <div align="center">
        <input type="button" name="buttondel" id="buttondel" value="Delete last row" />
        <hr />
        Once you have completed this form please press submit<br />
        <form id="form2" name="form2" method="post" action="">
          <input type="submit" name="button7" id="button7" value="Submit" />
        </form>
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
<script type="text/javascript" src="<?php echo base_url(); ?>js/colorpicker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/eye.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/utils.js"></script>
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
      if ($("#actions option:selected").text()=='Open Web Page') {
          $('#urlclick').show();
          $('#packageclick').hide();
          $('#package').val('');                    
      }    
      else {
          $('#urlclick').hide();
          $('#packageclick').hide();
          $('#url').val('');
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
    if ($('#build1').css('display')!='none') {
      formData.append('rows',1);
    }
    if ($('#build2').css('display')!='none') {
      formData.append('rows',2);
    }           
    for (var i=1; i<=2; i++) {
      formData.append('title' + i,$('#title' + i).val());
      formData.append('action' + i,$( "#select" + i + " option:selected" ).val());
    }    
    $.ajax({
        url: '<?php echo base_url(); ?>zeroadmin/homeupload', 
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

 $('#form1').on('submit', submitForm); 

$('#colorpickerField1').ColorPicker({
  onSubmit: function(hsb, hex, rgb, el) {
    $(el).val(hex);
    $(el).ColorPickerHide();
  },
  onBeforeShow: function () {
    $(this).ColorPickerSetColor(this.value);
  }
}).bind('keyup', function(){
  $(this).ColorPickerSetColor(this.value);
});


$("#buttondel").click(function()
{
  if($("div[id^='build']:visible:last").attr('id')!='build1')
  {
    $("div[id^='build']:visible:last").hide();
  }
});


});
</script>
<!-- InstanceEnd --></html>
