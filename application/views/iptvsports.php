<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/MainTemplate.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>IPTV Sports</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
  <?php $this->load->view('links/links'); ?>
  <!-- InstanceBeginEditable name="EditingPane" -->
  <div class="editingwindow">
    <div class="price">
      <div align="center">
        <p>Sports<br />
          <span class="tiny">Create image tiles and Channel Images for your Sports section</span></p>
      </div>
    </div>
    <div class="trueHalf">Select a Sports Title
      <?php echo form_open('', 'id="form3"'); ?>
        <p>
          <label>
            <select class="w3-select" name="select2" id="group-titles" style="width: 100%">
            <option value=''>Choose a channel group</option>
            <?php
              foreach($live_group_titles as $ime=>$kanal)
              {
                if(in_array($ime, $sport))
                {
                  printf("<option value='%s'>%s</option>",str_replace(' ', '', $ime),$ime);
                }
              }
            ?>            
          </select>
          </label>
        </p>
      </form>
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
      <?php echo form_close(); ?>
    </div>
    <div class="price"></div>
  </div>
  <div class="editingwindow">
    <hr />
    <div class="price">
      <div align="center">Sports Channel Images</div>
    </div>
    <div class="trueHalf">Select a Sports Title
      <form id="form" name="form5" method="post" action="">
        <label>
          <select id='live-group-titles' class="w3-select" name="select3" id="live-group-titles" style="width: 100%">
            <option value=''>Choose a channel group</option>
            <?php
              foreach($live_group_titles as $ime=>$kanal)
              {
                if(in_array($ime, $sport))
                {
                  printf("<option value='%s'>%s</option>",str_replace(' ', '', $ime),$ime);
                }
              }
            ?>            
          </select>
        </label>
      </form>
      Select a Live Channel
      <form id="form2" name="form3" method="post" action="">
        <label>
          <select class="w3-select" name="select" id="channels" style="width: 100%">
            <option value="">Choose a Channel</option>            
            </select>
        </label>
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
//
var filesArray1 = [];
   var filesArray2 = [];

    function previewFiles( e ) {
    
    var files = e.target.files;
       
    var eventTrigger = e.currentTarget.id;
    
      for (var i = 0, f; f = files[i]; i++) {
          
          if (!f.type.match('image/png')) {
              alert('You must upload png image');
              continue;
          }

          var reader = new FileReader();

                      
          reader.onload = (function(theFile) {
            return function(e) {          
            $('.img1').attr('src', e.target.result);
              if (eventTrigger=='imgInp') {
                filesArray1[0] = theFile;
              }              
              console.log(filesArray1);
            };
          })(f);
          reader.readAsDataURL(f);
          $(e.target).prop("value", "");
      }
  }

  $("#imgInp").on('change', previewFiles);
//
  $("#save1").click(function(e) {
    e.preventDefault();
    var formData = new FormData();
    for(var i= 0, file; file = filesArray1[i]; i++)
    {
        formData.append('files[]', file);
    }
    formData.append('title',$('#group-titles').val());
    formData.append('fulltitle',$( "#group-titles option:selected" ).text()); 
    if (filesArray1.length == 1 && $('#group-titles').val()!='') {
        if (!$("#load1").hasClass("fa fa-circle-o-notch fa-spin")) {
          $.ajax({         
            type: 'POST',
            url: "http://appy.zone/appynew/playlist/uploadimage/sports",
            data: formData,
            contentType: false,       
            cache: false,             
            processData:false,
            beforeSend: function() {
                $("#load1").addClass('fa fa-circle-o-notch fa-spin');
            },        
            success: function(data){ 
                console.log(data);
              $("#load1").removeClass('fa fa-circle-o-notch fa-spin');       
              flash();
            }
          });
        }
    }
    else {
      alert("Please upload an image and select group title");
    }       
  });

    $("#group-titles").change(function()
  {
      var ime=$(this).val();
      ime=ime.replace('|', '');
      var src='http://appy.zone/<?php echo $_SESSION['username'] ?>/iptv/images/sports/'+ime+'.png';
      $(".img1").attr("src", src);

  });


      function previewFiles2( e ) {
    
    var files = e.target.files;
       
    var eventTrigger = e.currentTarget.id;
    
      for (var i = 0, f; f = files[i]; i++) {
          
          if (!f.type.match('image/png')) {
              alert('You must upload png image');
              continue;
          }

          var reader = new FileReader();

                      
          reader.onload = (function(theFile) {
            return function(e) {          
            $('.img2').attr('src', e.target.result);
              if (eventTrigger=='imgInp2') {
                filesArray2[0] = theFile;
              }              
              console.log(filesArray2);
            };
          })(f);
          reader.readAsDataURL(f);
          $(e.target).prop("value", "");
      }
  }

  $("#imgInp2").on('change', previewFiles2);

$("#save2").click(function(e) {
    e.preventDefault();
    var formData = new FormData();
    for(var i= 0, file; file = filesArray2[i]; i++)
    {
        formData.append('files[]', file);
    }
    formData.append('title',$('#channels').val());
    formData.append('fulltitle',$( "#live-group-titles option:selected" ).text()); 
    if (filesArray2.length == 1 && $('#channels').val()!='') {
        if (!$("#load2").hasClass("fa fa-circle-o-notch fa-spin")) {
          $.ajax({         
            type: 'POST',
            url: "http://appy.zone/appynew/playlist/uploadimage/sportchannel",
            data: formData,
            contentType: false,       
            cache: false,             
            processData:false,
            beforeSend: function() {
                $("#load2").addClass('fa fa-circle-o-notch fa-spin');
            },        
            success: function(data){ 
                console.log(data);
              $("#load2").removeClass('fa fa-circle-o-notch fa-spin');       
              flash();
            }
          });
        }
    }
    else {
      alert("Please upload an image and select channel");
    }       
  });

  function imgpreview()
  {
      var ime=$('#channels').val();
      ime = ime.replace(/\:|\¬|\||\,|\/|\\/g,'');
      ime=ime.replace(' ', '');
      <?php
      if($_SESSION['username']=='FissNew')
        echo "var src='http://appy.zone/iptv/images/live/'+ime+'.png';";
      else
        echo "var src='http://appy.zone/".$_SESSION['username']."/iptv/images/live/'+ime+'.png';";
      ?>
      //var src='http://appy.zone/<?php echo $_SESSION['username'] ?>/iptv/images/live/'+ime+'.png';
      $(".img2").attr("src", src);

  };
  $("#live-group-titles,#channels").on('change',imgpreview);

  </script>
<!-- InstanceEnd --></html>
