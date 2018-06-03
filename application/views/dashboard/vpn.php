<?php //print_r($podaci)?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/MainTemplate.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>VPN clients</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<?php $this->load->view('links/links'); ?>

  <div class="editingwindow">
    <div class="price">VPN Clients</div>
    <div class="quarter">
      <p align="center">User</p>
      <form id="form1" name="form1" method="post" action="">
        <label>
          <div align="center">
            <select name="select" id="select">
              <option value=''></option>
              <?php
              $i=0;
                foreach($podaci as $a=>$b)
                {
                  printf("<option value='%s'>%s</option>",$i,$b['username']);
                  $i++;
                }
              ?>
            </select>
          </div>
        </label>
      </form>
    </div>
    <div class="quarter">
      <p align="center">Password</p>
      <form id="form2" name="form2" method="post" action="">
        <label>
          <div align="center">
            <input type="text" name="textfield2" id="textfield2" />
          </div>
        </label>
      </form>
    </div>
    <div class="quarter">
      <p align="center">App Name</p>
      <form id="form3" name="form3" method="post" action="">
        <label>
          <div align="center">
            <input type="text" name="textfield3" id="textfield3" />
          </div>
        </label>
      </form>
    </div>
    <div class="quarter">
      <p align="center">Credits Remaining</p>
      <form id="form4" name="form4" method="post" action="">
        <label>
          <div align="center">
            <input type="text" name="textfield4" id="textfield4" />
          </div>
        </label>
      </form>
    </div>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <form id="form5" name="form5" method="post" action="">
      <div align="center">
        <p>
          <input type="button" name="button1" id="button1" value="Download job.txt" />
        </p>
        <p>
          <input type="button" name="button2" id="button2" value="Download Client Emails" />
        </p>
      </div>
    </form>
    <p>&nbsp;</p>
  </div>
  <!-- InstanceEndEditable --></div>
<div class="footer">
  <div align="center">visit <a href="http://www.avstream.tv">www.avstream.tv</a> for the latest news</div>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  var array=[<?php
    $i=0;
    foreach($podaci as $a=>$b)
    {
      printf("['%s','%s','%s','%s','%s','%s'],",$i,$b['username'],$b['password'],$b['username'],$b['saldo'],$b['appname']);
      $i++;
    }
  ?>[]];
$('#select').on('change', function() {
  $("#textfield2").val(array[this.value][2]);
  $("#textfield3").val(array[this.value][5]);
  $("#textfield4").val(array[this.value][4]);
});
  $('#button1').click(function() 
  {
    location.href = "<?php echo base_url(); ?>dashboard/downloadfile?u="+$("#select option:selected").text();
  }); 
  $('#button2').click(function() 
  {
    location.href = "<?php echo base_url(); ?>dashboard/downloadclientemails";
  });             

</script>
<!-- InstanceEnd --></html>
