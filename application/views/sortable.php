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

    </div>
  </div>
  <div class="editingwindow">
      <button id='sortbtn'>test</button>
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
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#sortable" ).sortable();
    $( "#sortable" ).disableSelection();
  } );
  </script>

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
<!--             <?php for($i=0; $i<count($livelist); $i++):?>
              <?php $src = trim(explode(';', $livelist[$i])[0]); ?>
              <?php 
                echo  "<li class='ui-state-default' id='item-" . trim($livelist[$i]) . "'><img alt='' class='img2' style='width:25px;height:25px;border:1px solid red;' src='" . $src . "' /> " . trim(explode(';', $livelist[$i])[1]) . 
              "</li>";
              ?>
            <?php endfor?> -->
            <?php for($i=1; $i<=count($livelist); $i++):?>
              <?php preg_match_all('/(["\'])(?:(?=(\\\\?))\2.)*?\1/', $livelist[$i]['naslov'], $matches, PREG_OFFSET_CAPTURE);
               ?>
              <?php 
                echo  "<li class='ui-state-default' id='item-" . str_replace('"', '', $matches[0][0][0]) . "///" . str_replace('"', '', $matches[0][1][0]) . "///" . str_replace('"', '', $matches[0][2][0]) . "'><img alt='' class='img2' style='width:25px;height:25px;border:1px solid red;' src='" . str_replace('"', '', $matches[0][1][0]) . "' /> " . str_replace('"', '', $matches[0][0][0]) . 
              "</li>";
              ?>
            <?php endfor?>           
          </ul>    
        </div>
      </fieldset>
    </div>
    <div class="modal-footer">
      <h4 style='width:48%'>Avstream</h4>
      <input type='button' id='submit' value='OK' style='font-size:20px'/>
    </div>
  </div>

</div>
<script>
var listdata;
var modal1 = document.getElementById('modal1');

// Get the button that opens the modal
var btn1 = document.getElementById("sortbtn");

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

$('#submit').click(function(){
  $(".modal").hide();
  console.log(listdata);
  $.ajax({
      data: listdata,
      type: 'POST',
      url: '<?php echo base_url(); ?>testing/sortlist247',
      success: function(data)   
      {
        alert(data);               
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
