<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/MainTemplate.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>24/7 Shows</title>
  <style>
  #sortable { list-style-type: none; margin: 0; padding: 0; width: 100%; }
  #sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; height: 28px; }
  </style>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<?php $this->load->view('links/links'); ?>
  <div class="editingwindow">
    <div class="price">
      <div align="center">
        <p>24/7 TV Shows<br />
        <span class="tiny">Create image tiles for your 24/7 Shows section</span></p>
</div>
    </div>
  </div>
    <div class="editingwindow">
    <hr />
    <div class="price">
      <div align="center">24/7 TV Shows Images</div>
    </div>
    <div class="trueHalf">Select a 24/7 TV Show Title
      <form id="form" name="form5" method="post" action="">
        <label>
          <select id='live-group-titles' class="w3-select" name="select3" id="live-group-titles" style="width: 100%">
            <option value=''>Choose a channel group</option>
            <?php
              foreach($live_group_titles as $ime=>$kanal)
              {
                if(in_array($ime, $l247))
                {
                  printf("<option value='%s'>%s</option>",str_replace(' ', '', $ime),$ime);
                }
              }
            ?>            
          </select>
        </label>
      </form>
      Select a sub section
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
      <p align="center"><img alt="" class='img2' style='width:170px;height:100px;border:1px solid red;' /><br />
        <span class="tiny">Image dimensions 340px x 200px in PNG format</span></p>
      <p align="center">
        <input class="button" type="file" name="icon" id="imgInp2" value='BROWSE' style="display: none;"/>
        
        <input type="button" class="button" onclick="document.getElementById('imgInp2').click();" value='BROWSE' />
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button id="save2" class="button"><i id='load2' class=""></i> SAVE</button>
      </p>
    </div>
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
              for($i=1; $i <= count($livelist); $i++)
              {
                preg_match_all('/(["\'])(?:(?=(\\\\?))\2.)*?\1/', $livelist[$i]['naslov'], $matches, PREG_OFFSET_CAPTURE);
                printf("<option value='%s'>%s</option>",str_replace(' ', '', str_replace('"', '', $matches[0][0][0])),str_replace('"', '', $matches[0][0][0]));
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
            <?php for($i=1; $i<=count($livelist); $i++):?>
              <?php preg_match_all('/(["\'])(?:(?=(\\\\?))\2.)*?\1/', $livelist[$i]['naslov'], $matches, PREG_OFFSET_CAPTURE);
               ?>
              <?php 
                echo  "<li class='ui-state-default' id='item-" . $i . "'><img alt='' class='img2' style='width:25px;height:25px;border:1px solid red;' src='" . str_replace('"', '', $matches[0][1][0]) . "' /> " . str_replace('"', '', $matches[0][0][0]) . 
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
<script>
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
  $("#group-titles").change(function()
  {
      var ime=$(this).val();
      ime=ime.replace('|', '');
      var src='http://appy.zone/<?php echo $_SESSION['username'] ?>/iptv/images/247/'+ime+'.png';
      $(".img1").attr("src", src);

  });
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
    formData.append('fulltitle',$( "#channels option:selected" ).text());
    formData.append('grouptitle',$( "#live-group-titles option:selected" ).text());
    //console.log(channels[$( "#live-group-titles option:selected" ).text()]);\\
    var temparr = channels[$( "#live-group-titles option:selected" ).text()]; 
    for (var i = 0, len = temparr.length; i < len; i++) {
      if (temparr[i].name == $( "#channels option:selected" ).text()) {
        formData.append('link', temparr[i].link);
        console.log(temparr[i].link);
      }
    }
    if (filesArray2.length == 1 && $('#channels').val()!='') {
        if (!$("#load2").hasClass("fa fa-circle-o-notch fa-spin")) {
          $.ajax({         
            type: 'POST',
            url: "http://appy.zone/appynew/playlist/uploadimage/ls247channel",
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
      $ime=ime.replace(/\:|\¬|\||\,|\/|\\/g, '');
      ime=ime.replace(' ', '');
      <?php
      if($_SESSION['username']=='FissNew')
        echo "var src='http://appy.zone/iptv/images/247/'+ime+'.png';";
      else
        echo "var src='http://appy.zone/".$_SESSION['username']."/iptv/images/247/'+ime+'.png';";
      ?>
      //var src='http://appy.zone/<?php echo $_SESSION['username'] ?>/iptv/images/247/'+ime+'.png';
      $(".img2").attr("src", src);

  };
  $("#live-group-titles,#channels").on('change',imgpreview);

</script>
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
      url: '<?php echo base_url(); ?>playlist/sortlist247',
      success: function(data)   
      {
        console.log(data);
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

  $("#group-remove").click(function(e) {
      e.preventDefault();
      var formData = new FormData();
      formData.append('title',$('#group-titles-remove').val());
      formData.append('fulltitle',$( "#group-titles-remove option:selected" ).text()); 
      if ($('#group-titles-remove').val()!='') {
          $.ajax({         
            type: 'POST',
            url: "http://appy.zone/appynew/playlist/groupremove247",
            data: formData,
            contentType: false,       
            cache: false,             
            processData:false,       
            success: function(data){ 
              console.log(data);
              alert(data);
              location.reload();
            }
          });  
      }
      else {
        alert('Pick a channel group to remove');
      }    
  });

</script>
<!-- InstanceEnd --></html>
