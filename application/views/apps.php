<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/MainTemplate.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Applications</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<?php $this->load->view('links/links'); ?>

  <!-- InstanceBeginEditable name="EditingPane" -->
    <div class="editingwindow">
      <p align="center" class="price">Applications</p>
      <p align="left"><u>Please upload a banner image for the Applications screen</u></p>
      <div class="trueHalf">
        <p>
          <input type="file" name="fileField" id="imgInp" value="Choose File" />
          <br />
          <span class="tiny">Banner images are advertisment images</span><br />
          <strong>1920 x 350 .png</strong></p>
      </div>
      <div class="trueHalf">Preview<br />
      <?php
      if (file_exists('/var/www/appy.zone/public_html/' . $username . '/V5/apps/banner/image.png')) {
        echo "<img class='img1' style='width:300px;height:55px;border:1px solid red;' src='http://appy.zone/" . $username . "/V5/apps/banner/image.png'/>";
      } 
      else {
        echo "<img class='img1' style='width:300px;height:55px;border:1px solid red;'/>";        
      }
      //kupim podatke za checkboxove
      if(file_exists('/var/www/appy.zone/public_html/' . $username . '/V5/apps/row1.txt'))
      {
      	//print_r($builds);
      	foreach(file('/var/www/appy.zone/public_html/' . $username . '/V5/apps/row1.txt') as $l) 
      	{
      		$row1[]=$l;
      	}
      	//print_r($row1);
      }
      else
        {
          $row1[]='';
        }
      if(file_exists('/var/www/appy.zone/public_html/' . $username . '/V5/apps/row2.txt'))
      {
        //print_r($builds);
        foreach(file('/var/www/appy.zone/public_html/' . $username . '/V5/apps/row2.txt') as $l) 
        {
          $row2[]=$l;
        }
        //print_r($row1);
      }
      else
        {
          $row2[]='';
        }
      if(file_exists('/var/www/appy.zone/public_html/' . $username . '/V5/apps/row3.txt'))
      {
        //print_r($builds);
        foreach(file('/var/www/appy.zone/public_html/' . $username . '/V5/apps/row3.txt') as $l) 
        {
          $row3[]=$l;
        }
        //print_r($row1);
      }
     else
        {
          $row3[]='';
        }
      if(file_exists('/var/www/appy.zone/public_html/' . $username . '/V5/apps/row4.txt'))
      {
        //print_r($builds);
        foreach(file('/var/www/appy.zone/public_html/' . $username . '/V5/apps/row4.txt') as $l) 
        {
          $row4[]=$l;
        }
      }
     else
        {
          $row4[]='';
        }
      if(file_exists('/var/www/appy.zone/public_html/' . $username . '/V5/apps/row5.txt'))
      {
        //print_r($builds);
        foreach(file('/var/www/appy.zone/public_html/' . $username . '/V5/apps/row5.txt') as $l) 
        {
          $row5[]=$l;
        }
      }
     else
        {
          $row5[]='';
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
                if (isset($url[0])) {
                  echo ' value="' . $url[0] . '"';
                }
                else {
                  echo ' value=""';
                }
            }
            else if (isset($banneraction[0]) && $banneraction[0]==3) {
                if (isset($weburl[0])) {
                  echo ' value="' . $weburl[0] . '"';
                }
                else {
                  echo ' value=""';
                }
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
      <p><u>Create the Apps Rows</u></p>
    <div id='content'>
      <div class="trueHalf" id='build1'>
        <div align="center">
          <p>Row 1<br />
            Title:
            <input type="text" name="title1" id="title1" value='<?php if (isset($titles[0])) echo $titles[0]; ?>'/>
          </p>
          <p>
            <input type="button" name="row1builds" id="row1builds" value="Add Apps" />
          </p>
          <p>
            <input type="button" name="button1" id="button1" value="Add Another Row" />
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
          <p>Row 2<br />
            Title:
            <input type="text" name="title2" id="title2" value='<?php if (isset($titles[1])) echo $titles[1]; ?>'/>
          </p>
          <p>
            <input type="button" name="row2builds" id="row2builds" value="Add Apps" />
          </p>
          <p>
            <input type="button" name="button2" id="button2" value="Add Another Row" />
            <br />
          </p>
        </div>
      </div>
      <div class="trueHalf" id='build3' <?php 
          if ($rows[0]<3) {
            echo ' style="display:none;"';
          }
      ?>'>
        <div align="center">
          <p>Row 3<br />
            Title:
            <input type="text" name="title3" id="title3" value='<?php if (isset($titles[2])) echo $titles[2]; ?>'/>
          </p>
          <p>
            <input type="button" name="row3builds" id="row3builds" value="Add Apps" />
          </p>
          <p>
            <input type="button" name="button3" id="button3" value="Add Another Row" />
            <br />
          </p>
        </div>
      </div>
      <div class="trueHalf" id='build4' <?php 
          if ($rows[0]< 4) {
            echo ' style="display:none;"';
          }
      ?>'>
        <div align="center">
          <p>Row 4<br />
            Title:
            <input type="text" name="title4" id="title4" value='<?php if (isset($titles[3])) echo $titles[3]; ?>'/>
          </p>
          <p>
            <input type="button" name="row4builds" id="row4builds" value="Add Apps" />
          </p>
          <p>
            <input type="button" name="button4" id="button4" value="Add Another Row" />
            <br />
          </p>
        </div>
      </div>
      <div class="trueHalf" id='build5' <?php 
          if ($rows[0]<5) {
            echo ' style="display:none;"';
          }
      ?>'>
        <div align="center">
          <p>Row 5<br />
            Title:
            <input type="text" name="title5" id="title5" value='<?php if (isset($titles[4])) echo $titles[4]; ?>'/>
          </p>
          <p>
            <input type="button" name="row5builds" id="row5builds" value="Add Apps" />
          </p>
          <p>
            <input type="button" name="button5" id="button5" value="Add Another Row" />
            <br />
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
    <p>&nbsp;</p></div>
    <div class="editingwindow">
      <div align="center">
      <input type="button" name="buttondel" id="buttondel" value="Delete last row" />
      <hr />
      <div align="center">Once you have completed this form please press submit      </div>
      <form id="form2" name="form2" method="post" action="">
        
          <input type="submit" name="submit" id="submitbutton" value="Submit" />
        </div>
      </form>
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
<div id="modal1" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span id="close1" class='close'>&times;</span>
      <h3>Row 1 Build</h3>
    </div>
    <div class="modal-body">
      <fieldset>
        <div class='overflow-content' style='width:50%;position:relative;float:left;display:block'>
          <?php if(isset($builds) && count($builds)!=0): ?>
          <legend>Please select Apps</legend>
            <?php $brvr=0; 
            //print_r($buildtitles);
            for ($i=0; $i<count($builds); $i++):
            $pok=0;
            if(isset($row1))
            {
              foreach($row1 as $broj=>$vr)
              {
                  if(trim($vr)==trim($builds[$i]))
                  {
                    $rownew1[$brvr]['title']=trim($builds[$i]);
                    $rownew1[$brvr]['ime']=trim($buildtitles[$i]);
                    $brvr+=1;
                    $pok=1;
                  }
              }
            }
            //print_r($rownew1);
              ?>
            <input type="checkbox" name="kodibuild" id="kodi1build<?php echo $i+1?>" <?php if($pok==1)print("checked");?> value="<?php echo $builds[$i]?>" title="<?php echo $buildtitles[$i]?>" class='kd1' /><label for="track"><img class='img' style='width:50px;height:50px;border:1px solid red;' src='<?php echo $buildimages[$i];?>'/>&nbsp;<?php echo $buildtitles[$i]?> - <?php echo $buildsizes[$i]?>MB</label><br /><br />
            <?php endfor; ?>
          <?php else :?>
           <legend>No Apps available</legend> 
          <?php endif;?>
          <?php //print_r($rownew1);?>        
        </div>
        <div class='overflow-content list1'  style='width:40%;position:relative;float:left;display:block'>
        	<h4 style='text-align:center'>Select the apps in the order you would like them to display in your app.</h4>
        	<br>
          <?php
            if(isset($row1))
            {
              foreach($row1 as $broj=>$niz)
              {
                if(strlen($niz)>5)
                {
                  $djelovi=explode(";",$niz);
                  printf("<h5 title='%s'>%s</h5>",$niz,$djelovi[1]);                  
                }
              }
            }
          ?>
        </div>
      </fieldset>
    </div>
    <div class="modal-footer">
      <h4>Avstream</h4>
      <input type='button' value='OK' style='font-size:20px' onclick='$(".modal").hide();'/>
    </div>
  </div>

</div>
<div id="modal2" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span id="close2" class='close'>&times;</span>
      <h3>Row 2 Build</h3>
    </div>
    <div class="modal-body">
      <fieldset>
        <div class='overflow-content' style='width:50%;position:relative;float:left;display:block'>
          <?php if(isset($builds) && count($builds)!=0): ?>
          <legend>Please select Apps</legend>
            <?php $brvr=0;
             for ($i=0; $i<count($builds); $i++): 
            $pok=0;
            if(isset($row2))
            {
            foreach($row2 as $broj=>$vr)
              {
                  if(trim($vr)==trim($builds[$i]))
                  {
                    $rownew2[$brvr]['title']=trim($builds[$i]);
                    $rownew2[$brvr]['ime']=trim($buildtitles[$i]);
                    $brvr+=1;
                    $pok=1;
                  }
              }
            }
            ?>
            <input type="checkbox" name="kodibuild" id="kodi2build<?php echo $i+1?>" <?php if($pok==1)print("checked");?> value="<?php echo $builds[$i]?>" title="<?php echo $buildtitles[$i]?>" class='kd2' /><label for="track"><img class='img' style='width:50px;height:50px;border:1px solid red;' src='<?php echo $buildimages[$i];?>'/>&nbsp;<?php echo $buildtitles[$i]?> - <?php echo $buildsizes[$i]?>MB</label><br /><br />
            <?php endfor; ?>
          <?php else :?>
           <legend>No Apps available</legend> 
          <?php endif;?>        
        </div>
        <div class='overflow-content list2'  style='width:40%;position:relative;float:left;display:block'>
        	<h4 style='text-align:center'>Select the apps in the order you would like them to display in your app.</h4>
        	<br>
          <?php
            if(isset($row2))
            {
              foreach($row2 as $broj=>$niz)
              {
                if(strlen($niz)>5)
                {
                  $djelovi=explode(";",$niz);
                  printf("<h5 title='%s'>%s</h5>",$niz,$djelovi[1]);                  
                }
              }
            }
          ?>
        </div>
      </fieldset>
    </div>
    <div class="modal-footer">
      <h4>Avstream</h4>
      <input type='button' value='OK' style='font-size:20px' onclick='$(".modal").hide();'/>
    </div>
  </div>

</div>
<div id="modal3" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span id="close3" class='close'>&times;</span>
      <h3>Row 3 Build</h3>
    </div>
    <div class="modal-body">
      <fieldset>
        <div class='overflow-content' style='width:50%;position:relative;float:left;display:block'>
          <?php if(isset($builds) && count($builds)!=0): ?>
          <legend>Please select Apps</legend>
            <?php $brvr=0;
             for ($i=0; $i<count($builds); $i++): 
            $pok=0;
            if(isset($row3))
            {
            foreach($row3 as $broj=>$vr)
              {
                  if(trim($vr)==trim($builds[$i]))
                  {
                    $rownew3[$brvr]['title']=trim($builds[$i]);
                    $rownew3[$brvr]['ime']=trim($buildtitles[$i]);
                    $pok=1;
                    $brvr+=1;
                  }
              }
            }
            ?>
            <input type="checkbox" name="kodibuild" id="kodi3build<?php echo $i+1?>" <?php if($pok==1)print("checked");?> value="<?php echo $builds[$i]?>" title="<?php echo $buildtitles[$i]?>" class='kd3' /><label for="track"><img class='img' style='width:50px;height:50px;border:1px solid red;' src='<?php echo $buildimages[$i];?>'/>&nbsp;<?php echo $buildtitles[$i]?> - <?php echo $buildsizes[$i]?>MB</label><br /><br />
            <?php endfor; ?>
          <?php else :?>
           <legend>No Apps available</legend> 
          <?php endif;?>        
        </div>
        <div class='overflow-content list3'  style='width:40%;position:relative;float:left;display:block'>
        	<h4 style='text-align:center'>Select the apps in the order you would like them to display in your app.</h4>
        	<br>
          <?php
            if(isset($row3))
            {
              foreach($row3 as $broj=>$niz)
              {
                if(strlen($niz)>5)
                {
                  $djelovi=explode(";",$niz);
                  printf("<h5 title='%s'>%s</h5>",$niz,$djelovi[1]);                  
                }
              }
            }
          ?>
        </div>
      </fieldset>
    </div>
    <div class="modal-footer">
      <h4>Avstream</h4>
      <input type='button' value='OK' style='font-size:20px' onclick='$(".modal").hide();'/>
    </div>
  </div>

</div>
<div id="modal4" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span id="close4" class='close'>&times;</span>
      <h3>Row 4 Build</h3>
    </div>
    <div class="modal-body">
      <fieldset>
        <div class='overflow-content' style='width:50%;position:relative;float:left;display:block'>
          <?php if(isset($builds) && count($builds)!=0): ?>
          <legend>Please select Apps</legend>
            <?php $brvr=0;
             for ($i=0; $i<count($builds); $i++):
            $pok=0;
            if(isset($row4))
              {
                foreach($row4 as $broj=>$vr)
              {
                  if(trim($vr)==trim($builds[$i]))
                  {
                    $rownew4[$brvr]['title']=trim($builds[$i]);
                    $rownew4[$brvr]['ime']=trim($buildtitles[$i]);
                    $pok=1;
                    $brvr+=1;
                  }
              }
            }
             ?>
            <input type="checkbox" name="kodibuild" id="kodi4build<?php echo $i+1?>" <?php if($pok==1)print("checked");?> value="<?php echo $builds[$i]?>" title="<?php echo $buildtitles[$i]?>" class='kd4' /><label for="track"><img class='img' style='width:50px;height:50px;border:1px solid red;' src='<?php echo $buildimages[$i];?>'/>&nbsp;<?php echo $buildtitles[$i]?> - <?php echo $buildsizes[$i]?>MB</label><br /><br />
            <?php endfor; ?>
          <?php else :?>
           <legend>No Apps available</legend> 
          <?php endif;?>        
        </div>
        <div class='overflow-content list4'  style='width:40%;position:relative;float:left;display:block'>
        	<h4 style='text-align:center'>Select the apps in the order you would like them to display in your app.</h4>
        	<br>
          <?php
            if(isset($row4))
            {
              foreach($row4 as $broj=>$niz)
              {
                if(strlen($niz)>5)
                {
                  $djelovi=explode(";",$niz);
                  printf("<h5 title='%s'>%s</h5>",$niz,$djelovi[1]);                  
                }
              }
            }
          ?>
        </div>
      </fieldset>
    </div>
    <div class="modal-footer">
      <h4>Avstream</h4>
      <input type='button' value='OK' style='font-size:20px' onclick='$(".modal").hide();'/>
    </div>
  </div>

</div>
<div id="modal5" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span id="close5" class='close'>&times;</span>
      <h3>Row 5 Build</h3>
    </div>
    <div class="modal-body">
      <fieldset>
        <div class='overflow-content' style='width:50%;position:relative;float:left;display:block'>
          <?php if(isset($builds) && count($builds)!=0): ?>
          <legend>Please select Apps</legend>
            <?php $brvr=0;
             for ($i=0; $i<count($builds); $i++):
            $pok=0;
            if(isset($row5))
              {
            foreach($row5 as $broj=>$vr)
              {
                  if(trim($vr)==trim($builds[$i]))
                  {
                    $rownew5[$brvr]['title']=trim($builds[$i]);
                    $rownew5[$brvr]['ime']=trim($buildtitles[$i]);
                    $pok=1;
                    $brvr+=1;
                  }
              }
            }
             ?>
            <input type="checkbox" name="kodibuild" id="kodi5build<?php echo $i+1?>" <?php if($pok==1)print("checked");?> value="<?php echo $builds[$i]?>" title="<?php echo $buildtitles[$i]?>" class='kd5' /><label for="track"><img class='img' style='width:50px;height:50px;border:1px solid red;' src='<?php echo $buildimages[$i];?>'/>&nbsp;<?php echo $buildtitles[$i]?> - <?php echo $buildsizes[$i]?>MB</label><br /><br />
            <?php endfor; ?>
          <?php else :?>
           <legend>No Apps available</legend> 
          <?php endif;?>        
        </div>
        <div class='overflow-content list5'  style='width:40%;position:relative;float:left;display:block'>
        	<h4 style='text-align:center'>Select the apps in the order you would like them to display in your app.</h4>
        	<br>
          <?php
            if(isset($row5))
            {
              foreach($row5 as $broj=>$niz)
              {
                if(strlen($niz)>5)
                {
                  $djelovi=explode(";",$niz);
                  printf("<h5 title='%s'>%s</h5>",$niz,$djelovi[1]);                  
                }
              }
            }
          ?>
        </div>
      </fieldset>
    </div>
    <div class="modal-footer">
      <h4 style='width:48%'>Avstream</h4>
      <input type='button' value='OK' style='font-size:20px' onclick='$(".modal").hide();'/>
    </div>
  </div>

</div>
<script>
$(".kd5").change(function() {
    if(this.checked) 
    {
       $(".list5").append("<h5 title='"+$(this).val()+"'>"+$(this).attr('title')+"</h5>");
    }
    else
    {
    	$(".list5 h5:contains('"+$(this).attr('title')+"')").remove();
    }
});
$(".kd4").change(function() {
    if(this.checked) 
    {
       $(".list4").append("<h5 title='"+$(this).val()+"'>"+$(this).attr('title')+"</h5>");
    }
    else
    {
    	$(".list4 h5:contains('"+$(this).attr('title')+"')").remove();
    }
});
$(".kd3").change(function() {
    if(this.checked) 
    {
       $(".list3").append("<h5 title='"+$(this).val()+"'>"+$(this).attr('title')+"</h5>");
    }
    else
    {
    	$(".list3 h5:contains('"+$(this).attr('title')+"')").remove();
    }
});
$(".kd2").change(function() {
    if(this.checked) 
    {
       $(".list2").append("<h5 title='"+$(this).val()+"'>"+$(this).attr('title')+"</h5>");
    }
    else
    {
    	$(".list2 h5:contains('"+$(this).attr('title')+"')").remove();
    }
});
$(".kd1").change(function() {
    if(this.checked) 
    {
       $(".list1").append("<h5 title='"+$(this).val()+"'>"+$(this).attr('title')+"</h5>");
    }
    else
    {
    	$(".list1 h5:contains('"+$(this).attr('title')+"')").remove();
    }
});
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
    if ($('#build1').css('display')!='none') {
      formData.append('rows',1);
    }
    if ($('#build2').css('display')!='none') {
      formData.append('rows',2);
    }
    if ($('#build3').css('display')!='none') {
      formData.append('rows',3);
    }
    if ($('#build4').css('display')!='none') {
      formData.append('rows',4);
    }
    if ($('#build5').css('display')!='none') {
      formData.append('rows',5);
    }            
    for (var i=1; i<=5; i++) {
      formData.append('title' + i,$('#title' + i).val());
    }
    /*for (var i=1; i<=<?php if(isset($builds)) echo count($builds); else echo 0;?>; i++) {
      if ($("#kodi1build" + i).is(':checked')) {
        formData.append('kodi1build' + i,$("#kodi1build" + i).val());
      }
      if ($("#kodi2build" + i).is(':checked')) {
        formData.append('kodi2build' + i,$("#kodi2build" + i).val());
      } 
      if ($("#kodi3build" + i).is(':checked')) {
        formData.append('kodi3build' + i,$("#kodi3build" + i).val());
      } 
      if ($("#kodi4build" + i).is(':checked')) {
        formData.append('kodi4build' + i,$("#kodi4build" + i).val());
      } 
      if ($("#kodi5build" + i).is(':checked')) {
        formData.append('kodi5build' + i,$("#kodi5build" + i).val());
      }                    
    }*/
    var j=1;
    $( ".list5 h5" ).each(function() {
	  //alert($(this).attr('title'));
	  formData.append('kodi5build' + j,$(this).attr('title'));
	  j=j+1;
	});
	j=1;
	$( ".list4 h5" ).each(function() {
	  //alert($(this).attr('title'));
	  formData.append('kodi4build' + j,$(this).attr('title'));
	  j=j+1;
	});
	j=1;
	$( ".list3 h5" ).each(function() {
	  //alert($(this).attr('title'));
	  formData.append('kodi3build' + j,$(this).attr('title'));
	  j=j+1;
	});
	j=1;
	$( ".list2 h5" ).each(function() {
	  //alert($(this).attr('title'));
	  formData.append('kodi2build' + j,$(this).attr('title'));
	  j=j+1;
	});
	j=1;
	$( ".list1 h5" ).each(function() {
	  //alert($(this).attr('title'));
	  formData.append('kodi1build' + j,$(this).attr('title'));
	  j=j+1;
	});
    formData.append('buildcount','<?php if(isset($builds)) echo count($builds); else echo 0;?>');    
      //if (filesArray.length == 1) {
        console.log(formData);
          $.ajax({
              url: '<?php echo base_url(); ?>appy/appsbuildsupload', 
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
      //}
      //else {
      //  alert("Please upload banner image");
      //}
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
<script>
var modal1 = document.getElementById('modal1');
var modal2 = document.getElementById('modal2');
var modal3 = document.getElementById('modal3');
var modal4 = document.getElementById('modal4');
var modal5 = document.getElementById('modal5');

// Get the button that opens the modal
var btn1 = document.getElementById("row1builds");
var btn2 = document.getElementById("row2builds");
var btn3 = document.getElementById("row3builds");
var btn4 = document.getElementById("row4builds");
var btn5 = document.getElementById("row5builds");

// Get the <span> element that closes the modal
var span1 = document.getElementById("close1");
var span2 = document.getElementById("close2");
var span3 = document.getElementById("close3");
var span4 = document.getElementById("close4");
var span5 = document.getElementById("close5");
// When the user clicks the button, open the modal 
btn1.onclick = function() {
    modal1.style.display = "block";
}
btn2.onclick = function() {
    modal2.style.display = "block";
}
btn3.onclick = function() {
    modal3.style.display = "block";
}
btn4.onclick = function() {
    modal4.style.display = "block";
}
btn5.onclick = function() {
    modal5.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span1.onclick = function() {
    modal1.style.display = "none";
}
span2.onclick = function() {
    modal2.style.display = "none";
}
span3.onclick = function() {
    modal3.style.display = "none";
}
span4.onclick = function() {
    modal4.style.display = "none";
}
span5.onclick = function() {
    modal5.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal1 || event.target == modal2 || event.target == modal3 || event.target == modal4 || event.target == modal5) {
        modal1.style.display = "none";
        modal2.style.display = "none";
        modal3.style.display = "none";
        modal4.style.display = "none";
        modal5.style.display = "none";
    }
}
</script>
</html>
<!-- The Modal -->