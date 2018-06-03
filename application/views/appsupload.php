<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/MainTemplate.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Upload Apps</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<?php $this->load->view('links/links'); ?>

  <!-- InstanceBeginEditable name="EditingPane" -->
  <?php echo form_open_multipart('', 'id="form1" method="post"'); ?>
    <div class="editingwindow">
      <p align="center"><strong>Upload App Data to the server</strong></p>
      <div class="trueHalf">
        <p align="center">Name of App:
          <label>
            <input type="text" name="buildname" id="buildname" />
          </label>
          <br />
</p>
        <p align="center">Genre:
  <select name="select2" id="genre">
    <option>Games</option>
    <option>Streaming</option>
    <option>Tools</option>
  </select>
  <br />
        </p>
        <p align="center">Download URL:
  <input type="text" name="url" id="url" />
  <br />
        </p>
        <p align="center">Package Name:
  <input type="text" name="package" id="package" />
  <br />
        </p>
        <p align="center">App Image:
  <input type="file" name="button" id="imgInp" value="Browse" />
  <br />
  <span class="tiny">340 x 201 pixels PNG format</span></p>
        <p align="center">
          <input type="submit" name="button2" id="button2" value="Submit" />
        </p>
    <div style='margin-top:15px;margin-bottom:10px' id="loadingDiv1">
      <div align="center">
        <img src="<?php echo base_url(); ?>gif/ajax-loader.gif" style=""/>
      </div>
    </div>         
      </div>
      <div class="trueHalf">Image Preview<br />
      <img alt="" class='img1' style='width:300px;height:165px;border:1px solid red;' /> </div>
<p>&nbsp;</p>
  <?php echo form_close(); ?>
    </div>
    <?php echo form_open_multipart('', 'id="form2" method="post"'); ?>
    <div class="editingwindow">
      <div align="center">
        <hr />
        <p><strong>Edit an existing App</strong>        </p>
           <p align="center">Select build to edit: 
              <select name="select" id="selectbuilds">
                <option></option>
                <?php foreach($builds as $build):?>
                  <?php $currentbuild = explode(';',$build);?>
                    <option value='<?php echo $build;?>'><?php if(isset($currentbuild[1])) {echo $currentbuild[1];} else {echo "";}?></option>
                <?php endforeach;?>                
              </select>
            </p>
        <div class="trueHalf">
          <p align="center">Edit Name of App:
            <label>
              <input type="text" name="editname" id="editname" />
            </label>
          </p>
          <p align="center">Edit Genre:
            <select name="select" id="editgenre">
    <option>Games</option>
    <option>Streaming</option>
    <option>Tools</option>
  </select>
            <br />
        </p>
          <p align="center">Edit Download URL:
  <input type="text" name="editurl" id="editurl" />
            <br />
          </p>
          <p align="center">Edit Package Name:
  <input type="text" name="editpackage" id="editpackage" />
            <br />
          </p>
          <p align="center">Edit App Image:
  <input type="file" name="button3" id="imgInp1" value="Browse" />
            <br />
            <span class="tiny">340 x 201 pixels PNG format</span></p>
              <div align="center">
                <input type="submit" name="button3" id="button3" value="Submit" />
              </div>
    <div style='margin-top:15px;margin-bottom:10px' id="loadingDiv2">
      <div align="center">
        <img src="<?php echo base_url(); ?>gif/ajax-loader.gif" style=""/>
      </div>
    </div>         
        </div>
        <div class="trueHalf">
          <div align="left">Image Preview<br />
          <img alt="" class='img2' style='width:300px;height:165px;border:1px solid red;' /> </div>
        </div>
<p>&nbsp;</p>
<?php echo form_close(); ?>
      </div>
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
  var filesArray1 = [];
  var filesArray2 = [];
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
  $("#imgInp").on('change', previewFiles);
  $("#imgInp1").on('change', previewFilesEdit);

  function submitForm(e)
  {     
    e.preventDefault();                
    var formData = new FormData();

    for(var i= 0, file; file = filesArray1[i]; i++)
    {
        formData.append('files[]', file);
    }
    formData.append('buildname',$('#buildname').val());
    formData.append('genre',$( "#genre option:selected" ).text());
    formData.append('url',$( "#url" ).val());
    formData.append('package',$( "#package" ).val());             
    if (filesArray1.length == 1) {
        $.ajax({
            url: '<?php echo base_url(); ?>appy/appbuildtxt', 
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

  $('#selectbuilds').on('change', function() {
      if ($( "#selectbuilds option:selected" ).val()!='') {
        var parsedbuild = $( "#selectbuilds option:selected" ).val().split(';');
        $('#editname').val(parsedbuild[1].trim());
        $('#editurl').val(parsedbuild[2].trim());
        $('#editpackage').val(parsedbuild[3]);   
        $('#editgenre').val(parsedbuild[4].trim());
        $('.img2').attr("src",parsedbuild[0].trim()); 
      }
      else {
        $('#editname').val('');
        $('#editurl').val('');
        $('#editpackage').val('');   
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
    formData.append('editpackage',$('#editpackage').val());
    formData.append('editgenre',$( "#editgenre option:selected" ).text());
    formData.append('editurl',$( "#editurl" ).val());
    formData.append('completebuild',$( "#selectbuilds" ).val().trim());           
    $.ajax({
        url: '<?php echo base_url(); ?>appy/editappsbuild', 
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


});
</script>
<!-- InstanceEnd --></html>
