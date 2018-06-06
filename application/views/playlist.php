<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="Templates/MainTemplate.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>IPTV Playlist</title>
  <style>
  #sortable { list-style-type: none; margin: 0; padding: 0; width: 100%; }
  #sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; height: 28px; }
  </style>

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
      <div align="center">Organise the Group Tiles</div>
    </div>
    <div class="trueHalf">
      <p><strong><br />
      Remove Group from App Display</strong></p>
      <p>Select a Group Title
      </p>
      <?php echo form_open('', 'id="form5"'); ?>
        <label>
          <select class="w3-select" name="select5" id="group-titles-remove" style="width: 100%">
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
      <p align="center"><br />
        <input type="button" name="button10" id="group-remove" value="Remove" />
        <br />
      <span class="tiny">To re add the group to your app re upload an image for it in the section above. </span></p>
</div>
    <div class="trueHalf">
      <p align="center"><br />
      <strong>Re Order the Group Tiles in your App</strong></p>
      <p align="center">
        <input type="button" name="button6" id="organise-live" value="Organise" />
        <br />
        <br />
      <span class="tiny">Click the button to open the pop out window. Drag and drop your Group images in to the order you want and click update.</span></p>
      <form id="form10" name="form4" method="post" action="">
        <div align="center"></div>
      </form>
    </div>
    <p>&nbsp;</p>
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
<div id="modal1" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span id="close1" class='close'>&times;</span>
      <h3>Drag and Drop to change order</h3>
    </div>
    <div class="modal-body">
      <fieldset>
        <div class='overflow-content' style='width:60%;margin: 0 auto;display:block'>
          <ul id="sortable">
            <?php for($i=0; $i<count($livelist); $i++):?>
              <?php $src = trim(explode(';', $livelist[$i])[0]); ?>
              <?php 
                echo  "<li class='ui-state-default' id='item-" . trim($livelist[$i]) . "'><img alt='' class='img2' style='width:25px;height:25px;border:1px solid red;' src='" . $src . "' /> " . trim(explode(';', $livelist[$i])[1]) . 
              "</li>";
              ?>
            <?php endfor?>           
          </ul>    
        </div>
      </fieldset>
    </div>
    <div class="modal-footer">
      <h4 style='width:48%'>Avstream</h4>
      <input type='button' id='organise-live-submit' value='OK' style='font-size:20px'/>
    </div>
  </div>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>js/flash.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#sortable" ).sortable();
    $( "#sortable" ).disableSelection();
  } );
  </script>
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
<script>
var listdata;
var modal1 = document.getElementById('modal1');

// Get the button that opens the modal
var btn1 = document.getElementById("organise-live");

// Get the <span> element that closes the modal
var span1 = document.getElementById("close1");

// When the user clicks the button, open the modal 
btn1.onclick = function() {
    modal1.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span1.onclick = function() {
    modal1.style.display = "none";
}


// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal1) {
        modal1.style.display = "none";
    }
}

$('#organise-live-submit').click(function(){
  $(".modal").hide();
  console.log(listdata);
  $.ajax({
      data: listdata,
      type: 'POST',
      url: '<?php echo base_url(); ?>playlist/sortlist',
      success: function(data)   
      {
        flash();               
      }      
  });  
});

$(document).ready(function () {
    $('#sortable').sortable({
        axis: 'y',
        stop: function (event, ui) {
          listdata = $(this).sortable('serialize');
          //console.log(listdata);
  }
    });
});

</script>
<!-- InstanceEnd --></html>
