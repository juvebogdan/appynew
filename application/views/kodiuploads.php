<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/MainTemplate.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Upload Kodi Builds</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<?php $this->load->view('links/links'); ?>

  <!-- InstanceBeginEditable name="EditingPane" -->
  <?php echo form_open_multipart('', 'id="form1" method="post"'); ?>
    <div class="editingwindow">
      <p align="center" class="price">Upload Kodi Build Data to the server</p>
      <div class="trueHalf">
        <p align="center">Name of build:
          <label>
            <input type="text" name="buildname" id="buildname" />
            <br />
            <br />
            Size of build:</label>
<label> </label>
          <input name="size" type="text" id="size" size="4" />
          MB<br />
          <span class="tiny">In whole mega bytes (Example 45.34 = 45)<br />
          </span><br />
          Genre:
  <select name="select2" id="genre">
    <option selected="selected">Family</option>
    <option>Adult</option>
    <option>Kids</option>
    <option>International</option>
    <option>Sports</option>
  </select>
  <br />
        </p>
        <p align="center">Download URL:
  <input type="text" name="url" id="url" />
          <br />
        </p>
        <p align="center">Build Image:
  <input type="file" name="button" id="imgInp" value="Browse" />
          <br />
          <span class="tiny">340 x 201 pixels PNG format</span></p>
          <div align="center">
            <input type="submit" name="button2" id="button2" value="Submit" />
          </div>
    <div style='margin-top:15px;margin-bottom:10px' id="loadingDiv1">
      <div align="center">
        <img src="<?php echo base_url(); ?>gif/ajax-loader.gif" style=""/>
      </div>
    </div>           
      </div>
      <div class="trueHalf">Image Preview<br />
      <img alt="" class='img1' style='width:300px;height:165px;border:1px solid red;' /> </div>
<p align="center">&nbsp;</p>
      <p>&nbsp;</p>
  </div>
  <?php echo form_close(); ?>
  <?php echo form_open_multipart('', 'id="form2" method="post"'); ?>
    <div class="editingwindow">
      <div align="center">
        <hr />
        <p align="left"><u>Edit an existing build</u><br />
        <span class="tiny">When you edit a build it will be classed as an update </span></p>
        <div class="trueHalf">
          <div align="left">
            <p align="center">Select build to edit: 
              <select name="select" id="selectbuilds">
                <option></option>>
                <?php foreach($builds as $build):?>
                  <?php $currentbuild = explode(';',$build);?>
                    <option value='<?php echo $build;?>'><?php if(isset($currentbuild[1])) {echo $currentbuild[1];} else {echo "";}?></option>
                <?php endforeach;?>
              </select>
            </p>
            <p align="center">
              Edit Name: 
              <input type="text" name="editname" id="editname" />
              <br />
            </p>
            <p align="center">Edit Size: 
              <input name="editsize" type="text" id="editsize" size="4" />
              MB
              <br />
            </p>
            <p align="center">Edit Genre: 
              <select name="select3" id="editgenre">
                <option>Family</option>
                <option>Adult</option>
                <option>Kids</option>
                <option>International</option>
                <option>Sports</option>
              </select>
              <br />
            </p>
            <p align="center">Edit Download URL:
  <input type="text" name="editurl" id="editurl" />
              <br />
            </p>
            <p align="center">Edit Image:
  <input type="file" name="button4" id="imgInp1" value="Browse" />
              <br />
              <span class="tiny">340 x 201 pixels PNG format</span>            </p>
              <div align="center">
                <input type="submit" name="button3" id="button3" value="Submit" />
              </div>
    <div style='margin-top:15px;margin-bottom:10px' id="loadingDiv2">
      <div align="center">
        <img src="<?php echo base_url(); ?>gif/ajax-loader.gif" style=""/>
      </div>
    </div>             
          </div>
        </div>
        <div class="trueHalf">
          <div align="left">Image Preview<br />
          <img alt="" class='img2' style='width:300px;height:165px;border:1px solid red;' /> </div>
        </div>
<p>&nbsp;</p>
      </div>
    </div>
  <?php echo form_close(); ?>    
    <div class="editingwindow">
      <hr />
      <p>Create your global RSS feed message<br />
      <span class="tiny">This text will be passed in to all builds downloaed by the users over writting the current RSS feed in the build. </span></p>
      <div class="trueHalf">
        <p>Message
          <label>
          </label>
        </p>
          <label>
            <div align="center">
              <textarea name="textarea" id="rssfeed" cols="45" rows="5"></textarea>
            </div>
          </label>
  <div align="center">
    <button type="button" class="ajax" id="button">Submit</button>
  </div>
<p>&nbsp;</p>
      </div>
      <div class="trueHalf">
        <p>Upload Kodi Splash Image
          <label> </label>
        </p>
        <?php echo form_open_multipart('', 'id="form3" method="post"'); ?>
          <div align="center">
            <p>Image: 
              <input type="file" name="button4" id="imgInp2" value="Browse" />
              <span class="tiny">1920 x 1080 png </span><br />
            </p>
           <?php
            if (isset($imgsplash)) {
              echo "<p><img alt='' class='img3' src='$imgsplash' style='width:200px;height:112px;border:1px solid red;' /></p>";
            } 
            else {
              echo "<p><img alt='' class='img3' style='width:200px;height:112px;border:1px solid red;' /></p>";        
            }
            ?>            
        </div>
          <div align="center">
            <input type="submit" name="button6" id="button6" value="Submit" />
          </div>
    <div style='margin-top:15px;margin-bottom:10px' id="loadingDiv3">
      <div align="center">
        <img src="<?php echo base_url(); ?>gif/ajax-loader.gif" style=""/>
      </div>
    </div>          
        <?php echo form_close(); ?>
      </div>
      <p>&nbsp;</p>
    </div>
  <!-- InstanceEndEditable --></div>
<div class="footer">
  <div align="center">visit <a href="http://www.avstream.tv">www.avstream.tv</a> for the latest news</div>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $('#loadingDiv1').hide();
  $('#loadingDiv2').hide();
  $('#loadingDiv3').hide();
  var filesArray1 = [];
  var filesArray2 = [];
  var filesArray3 = [];
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
                filesArray1[0] = theFile;
              }
              
              console.log(filesArray1);

            };
          })(f);

                      
          reader.readAsDataURL(f);
      }
  }
    function previewFilesEdit( e ) {
    
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
                $('.img2').attr('src', e.target.result);
                filesArray2[0] = theFile;
              }
              
              console.log(filesArray2);

            };
          })(f);

                      
          reader.readAsDataURL(f);
      }
  }

    function previewFilesSplash( e ) {
    
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
                $('.img3').attr('src', e.target.result);
                filesArray3[0] = theFile;
              }
              
              console.log(filesArray3);

            };
          })(f);

                      
          reader.readAsDataURL(f);
      }
  }


  $("#imgInp").on('change', previewFiles);
  $("#imgInp1").on('change', previewFilesEdit);
  $("#imgInp2").on('change', previewFilesSplash);

  function submitForm(e)
  {     
    e.preventDefault();                
    var formData = new FormData();

    for(var i= 0, file; file = filesArray1[i]; i++)
    {
        formData.append('files[]', file);
    }
    formData.append('buildname',$('#buildname').val());
    formData.append('size',$('#size').val());
    formData.append('genre',$( "#genre option:selected" ).text());
    formData.append('url',$( "#url" ).val());             
    if (filesArray1.length == 1) {
        $.ajax({
            url: '<?php echo base_url(); ?>appy/kodibuildtxt', 
            type: "POST",            
            data: formData,
            contentType: false,       
            cache: false,             
            processData:false,
            beforeSend: function() {
              $('input[type="submit"]').prop('disabled', true);
              $("#loadingDiv1").show();
            },                             
            success: function(data)   
            {
              alert(data);
              $('input[type="submit"]').prop('disabled', false);
              $("#loadingDiv1").hide(); 
              location.reload();               
            }
        });
    }
    else {
      alert("Please upload image");
    }
  }

 $('#form1').on('submit', submitForm);
 $('#form2').on('submit', submitFormEdit); 
 $('#form3').on('submit', submitFormSplash); 

  $('#selectbuilds').on('change', function() {
      if ($( "#selectbuilds option:selected" ).val()!='') {
        var parsedbuild = $( "#selectbuilds option:selected" ).val().split(';');
        $('#editname').val(parsedbuild[1].trim());
        $('#editurl').val(parsedbuild[2].trim());
        $('#editsize').val(Math.round(parseInt(parsedbuild[3])*9.5367431640625/10000000));   
        $('#editgenre').val(parsedbuild[4].trim());
        $('.img2').attr("src",parsedbuild[0].trim()); 
      }
      else {
        $('#editname').val('');
        $('#editurl').val('');
        $('#editsize').val('');   
        $('#editgenre').val('');
        $('.img2').attr("src",'');        
      }
  });

  function submitFormEdit(e)
  {     
    e.preventDefault();                
    var formData = new FormData();

    for(var i= 0, file; file = filesArray2[i]; i++)
    {
        formData.append('files[]', file);
    }
    formData.append('editbuildname',$('#editname').val());
    formData.append('editsize',$('#editsize').val());
    formData.append('editgenre',$( "#editgenre option:selected" ).text());
    formData.append('editurl',$( "#editurl" ).val());
    formData.append('completebuild',$( "#selectbuilds" ).val().trim());           
    $.ajax({
        url: '<?php echo base_url(); ?>appy/editkodibuild', 
        type: "POST",            
        data: formData,
        contentType: false,       
        cache: false,             
        processData:false,
        beforeSend: function() {
          $('input[type="submit"]').prop('disabled', true);
          $("#loadingDiv2").show();
        },                             
        success: function(data)   
        {
          alert(data);
          $('input[type="submit"]').prop('disabled', false);
          $("#loadingDiv2").hide();  
          location.reload();               
        }
    });
  }

  function submitFormSplash(e)
  {     
    e.preventDefault();                
    var formData = new FormData();

    for(var i= 0, file; file = filesArray3[i]; i++)
    {
        formData.append('files[]', file);
    }         
    $.ajax({
        url: '<?php echo base_url(); ?>appy/uplsplash', 
        type: "POST",            
        data: formData,
        contentType: false,       
        cache: false,             
        processData:false,
        beforeSend: function() {
          $('input[type="submit"]').prop('disabled', true);
          $("#loadingDiv3").show();
        },                             
        success: function(data)   
        {
          alert(data);
          $('input[type="submit"]').prop('disabled', false);
          $("#loadingDiv3").hide();  
          location.reload();               
        }
    });
  }  

  $(".ajax").click(function() {
    var formData = new FormData();
    formData.append('message',$('#rssfeed').val());  
      $.ajax({        
        type: 'POST',
        url: "<?php echo base_url(); ?>appy/rssfeed",
        data: formData,
        contentType: false,       
        cache: false,             
        processData:false,
        success: function(data){        
          alert(data);
          location.reload();
        }
      });     
  });  


});
</script>
<!-- InstanceEnd --></html>
