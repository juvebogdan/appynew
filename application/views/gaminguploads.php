<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/MainTemplate.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Upload ROMs</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<?php $this->load->view('links/links'); ?>

  <!-- InstanceBeginEditable name="EditingPane" -->
    <div class="editingwindow">
    <?php echo form_open_multipart('', 'id="form1" method="post"'); ?>
      <p align="center" class="price">Upload your ROMs to the server</p>
      <div class="trueHalf">
        <p align="center">Name of game: 
          <label>
            <input type="text" name="gamename" id="gamename" />
            <br />
            <br />
            Console:</label>
          <select name="select" id="console">
            <option selected>MAME</option>
            <option value='Sega'>Sega</option>
            <option value='N64'>N64</option>
            <option value='SNES'>SNES</option>
            <option value='PSX'>Playstation</option>
          </select>
          <label> </label>
        <br />
        </p>
        <p align="center">Genre:
  <select name="select2" id="genre">
    <option selected value='Platform'>Platform</option>
    <option value='Sports'>Sports</option>
    <option value='Fighting'>Fighting</option>
    <option value='Arcade'>Arcade</option>
    <option value='Puzzle'>Puzzle</option>
    <option value='RolePlay'>Role Play</option>
    <option value='Shootemup'>Shoot em up</option>
    <option value='FlightSimulator'>Flight Simulator</option>
  </select>
          <br />
          </p>
        <p align="center">Download URL:
  <input type="text" name="textfield2" id="url" />
          <br />
          </p>
        <p align="center">Artwork Image:
  <input type="file" name="image" id="imgInp" value="Browse" />
          <br />
          <span class="tiny">360 x 563 pixels PNG format</span>        </p>
          <div align="center">
            <input type="submit" name="button2" id="btnsubmit" value="Submit" />
          </div>
    <div style='margin-top:15px;margin-bottom:10px' id="loadingDiv">
      <div align="center">
        <img src="<?php echo base_url(); ?>gif/ajax-loader.gif" style=""/>
      </div>
    </div>           
      </div>
      <div class="trueHalf">Artwork Preview<br />
      <img alt="" class='img1' style='width:320px;height:460px;border:1px solid red;' /> </div>
<p align="center">&nbsp;</p>
      <p>&nbsp;</p>
  </div>
  <?php echo form_close(); ?>
    <div class="editingwindow">
      <div align="center">It is important that the above data is accurate. <br />
        <strong>Only submit games that we do not already have. </strong><br />
      Duplicate entries will be removed.</div>
    </div>
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
  $("#imgInp").on('change', previewFiles);

  function submitForm(e)
  {     
    e.preventDefault();                
    var formData = new FormData();
    var checkboxStatus;

    for(var i= 0, file; file = filesArray[i]; i++)
    {
        formData.append('files[]', file);
    }
    formData.append('gamename',$('#gamename').val());
    formData.append('console',$( "#console option:selected" ).val());
    formData.append('genre',$( "#genre option:selected" ).val());
    formData.append('url',$( "#url" ).val());             
    if (filesArray.length == 1) {
        $.ajax({
            url: '<?php echo base_url(); ?>appy/gaminguploadsubmit', 
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
      alert("Please upload artwork image");
    }
  }

 $('#form1').on('submit', submitForm); 

});
</script>
<!-- InstanceEnd --></html>
