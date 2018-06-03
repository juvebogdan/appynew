<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="Templates/MainTemplate.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>IPTV Playlist</title>

<?php $this->load->view('links/links'); ?> 
  <!-- InstanceBeginEditable name="EditingPane" -->
  <div class="editingwindow">
    <div class="price">
      <div align="center">Upload your IPTV playlist data</div>
    </div>
    <div class="halfpanel">
      <p align="center"><strong>M3U Playlist with details URL</strong>        </p>
      <?php echo form_open('', 'id="form1"'); ?>
        <div align="center">
            <input type="text" name="textfield" id="m3u" value='<?php echo $m3u; ?>'/>
            <input type="submit" name="button" id="submitm3u" value="Submit" />
        </div>
      <?php echo form_close(); ?>
    </div>
    <div class="halfpanel">
      <p align="center"><strong>EPG URL</strong>        </p>
      <?php echo form_open('', 'id="form2"'); ?>
        <div align="center">
              <input type="text" name="textfield2" id="epg" value='<?php echo $epg; ?>'/>
              <input type="submit" name="button2" id="submitepg" value="Submit" />
        </div>
      <?php echo form_close(); ?> 
    </div>
    <div style='margin-top:15px;margin-bottom:10px; display: none' id="loadingDiv">
      <div align="center">
        <img src="<?php echo base_url(); ?>gif/ajax-loader.gif" style=""/>
      </div>
    </div>    
  </div>
  <div class="editingwindow">
    <div class="price">
      <div align="center">
        <hr />
      Live Channel Groups</div>
    </div>
    <div class="trueHalf">Select a Group Title
      <?php echo form_open('', 'id="form3"'); ?>
        <label>
          <select class="w3-select" name="select2" id="group-titles" style="width: 100%">
            <option value=''>Choose a channel group</option>
            <?php
              foreach($live_group_titles as $ime=>$kanal)
              {
                if(!in_array($ime, $l247) && !in_array($ime, $sport))
                {
                  printf("<option value='%s'>%s</option>",str_replace(' ', '', $ime),$ime);
                }
              }
            ?>            
          </select>
          <br>
          <br>
          <br>
          <br>
          <br>
          <input type="radio" name="rbnNumber" value="247" /> Move Group to 24/7 Shows <br/>
          <input type="radio" name="rbnNumber" value="sports" /> Move Group to Sports <br/>
          <input type='button' id='movebutton' value='Submit' />
        </label>
    </div>
    <div class="trueHalf">
      <p align="center">Image Preview</p>
      <p align="center"><img alt="" class='img1' style='width:170px;height:100px;border:1px solid red;' /><br />
        <span class="tiny">Image dimensions 340px x 200px in PNG format</span></p>
      <p align="center">
        <input class="button" type="file" name="icon" id="imgInp" value='BROWSE' style="display: none;"/>
        
        <input type="button" class="button" onclick="document.getElementById('imgInp').click();" value='BROWSE' />
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button id="save1" class="button"><i id='load1' class=""></i> SAVE</button>
      </p>
    </div>
    <?php echo form_close(); ?>
  </div>
  <div class="editingwindow">
    <hr />
    <div class="price">
      <div align="center">Live Channel Images</div>
    </div>
    <div class="trueHalf">Select a Channel
      <form id="form3" name="form3" method="post" action="">
            </br>
        <p>
          <label>
            <select class="w3-select" name="select" id="live-group-titles" style="width: 100%">
              <option value=''>Choose a channel group</option>
              <?php
                foreach($live_group_titles as $ime=>$kanal)
                {
                  if(!in_array($ime, $l247) && !in_array($ime, $sport))
                  {
                    printf("<option value='%s'>%s</option>",str_replace(' ', '', $ime),$ime);
                  }
                }
              ?>                         
            </select>
          </label>
        </p>
        <p>
          <label>
            <select class="w3-select" name="select" id="channels" style="width: 100%">
            <option value="">Choose a Channel</option>            
            </select>
          </label>
        </p>        
      </form>
    </div>
    <div class="trueHalf">
      <p align="center">Image Preview</p>
      <p align="center"><img alt="" class='img2' style='width:150px;height:137px;border:1px solid red;' /><br />
      <span class="tiny">Image dimensions 550px x 502px in PNG format      </span></p>
      <p align="center">
        <input class="button" type="file" name="icon" id="imgInp2" value='BROWSE' style="display: none;"/>
        
        <input type="button" class="button" onclick="document.getElementById('imgInp2').click();" value='BROWSE' />
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button id="save2" class="button"><i id='load2' class=""></i> SAVE</button>
      </p>
    </div>
<p>&nbsp;</p>
  </div>
  <!-- InstanceEndEditable --></div>
<div class="alert alert-success alert-flash" role="alert" id='flash' style='display: none;'>
  <strong>Data is updated</strong>
</div>  
<div class="footer">
  <div align="center">visit <a href="http://www.avstream.tv">www.avstream.tv</a> for the latest news</div>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>js/flash.js"></script>
<script type="text/javascript">
<?php

$php_array = $live_group_titles;
$js_array = json_encode($php_array);
echo "var channels = ". $js_array . ";\n";

?>

  $('#live-group-titles').on('change', function() {
    $('#channels option').remove();
    if (this.selectedIndex!=0) {
      $.each(channels[this.options[this.selectedIndex].text], function(){
          $('#channels').append($('<option>', { 
              value: this.name.trim().replace(/\s+/g, ''),
              text : this.name.trim() 
          }));          
      });
    } 
  });

  $("#movebutton").click(function()
    {
      if($('#group-titles').val()=='')
      {
        alert('Please select group title');
      }
      else
      {
        if($('input[name=rbnNumber]').is(':checked'))
        {
            var formData = new FormData();
            formData.append('location',$('input[name=rbnNumber]:checked').val());
            formData.append('name',$("#group-titles option:selected").text());
            $.ajax({
                url: 'http://appy.zone/appynew/playlist/move', 
                method: "post",
                data: formData,
                contentType: false,       
                cache: false,  
                processData:false,                             
                success: function(data)
                {
                  alert('Move done!');
                  var oval=$('#group-titles').val();
                  $('#group-titles option[value="'+oval+'"]').remove();
                  $('.w3-select option[value="'+oval+'"]').remove();
                }
            });
        }
        else
        {
          alert('Please check the radio button');
        }
      }
    });



</script>
<script src="<?php echo base_url(); ?>js/playlist.js"></script>
<!-- InstanceEnd --></html>
