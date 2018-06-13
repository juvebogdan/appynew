<?php 
//print_r($all);
$i=0;
$options='';
$cifra=0;
  foreach($all as $a=>$b)
  {
    $options.=sprintf("<option value='%s'>%s</option>",$i,$b['username']);
    $i++;
    if($b['active']==0)
    {
      $cifra+=$b['amount'];
    }
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/MainTemplate.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Appy Zone Stats</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<?php $this->load->view('links/links'); ?>

  <div class="editingwindow">
    <div class="price">Business Stats</div>
    <div class="quarter">
      <p align="center">Stater Plan</p>
      <h1 align="center"><?php echo $plans['starter']?></h1>
      <form id="form1" name="form1" method="post" action="">
        <div align="center">
          <input type="button" name="button" id="button" value="Download Emails" />
        </div>
      </form>
    </div>
    <div class="quarter">
      <p align="center">Business Plan</p>
      <h1 align="center"><?php echo $plans['appy']?></h1>
      <form id="form2" name="form1" method="post" action="">
        <div align="center">
          <input type="button" name="button2" id="button2" value="Download Emails" />
        </div>
      </form>
    </div>
    <div class="quarter">
      <p align="center">Ultimate  Plan</p>
      <h1 align="center"><?php echo $plans['ultimate']?></h1>
      <form id="form3" name="form1" method="post" action="">
        <div align="center">
          <input type="button" name="button3" id="button3" value="Download Emails" />
        </div>
      </form>
    </div>
    <div class="quarter">
      <p align="center">Old Plans</p>
      <h1 align="center"><?php 
        echo $oldnumber;
      ?></h1>
      <form id="form4" name="form1" method="post" action="">
        <div align="center">
          <input type="button" name="button4" id="button4" value="Download Emails" />
        </div>
      </form>
    </div>
    <div class="price">
      <div align="center">
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>Total Value: £<?php echo $cifra ?></p>
      </div>
    </div>
    <div class="price">Client Details</div>
    <div class="quarter">
      <p align="center">User</p>
      <form id="form5" name="form5" method="post" action="">
        <label>
          <div align="center">
            <select name="select" id="select">
              <option></option>
              <?php
               echo $options;
              ?>
            </select>
          </div>
        </label>
      </form>
    </div>
    <div class="quarter">
      <p align="center">Password</p>
      <form id="form6" name="form6" method="post" action="">
        <label>
          <div align="center">
            <input type="text" name="textfield" id="textfield" />
          </div>
        </label>
      </form>
    </div>
<div class="quarter">
  <p align="center">Plan</p>
  <form id="form7" name="form7" method="post" action="">
    <label>
      <div align="center">
        <input type="text" name="textfield2" id="textfield2" />
      </div>
    </label>
  </form>
</div>
<div class="quarter">
  <p align="center">Login As User</p>
  <form id="form8" name="form8" method="post" action='http://appy.zone/login.php'>
    <div align="center">
      <input type='text' name='username' id='u1' value='' style='display: none' />
      <input type='text' name='password' id='p1' value='' style='display: none' />
      <input type="submit" name="Login" id="Login" value="Login" />
    </div>
  </form>
</div>
<div class="quarter">
  <p align="center">App Name</p>
  <form id="form9" name="form9" method="post" action="">
    <div align="center">
      <label>
        <input type="text" name="textfield3" id="textfield3" />
      </label>
    </div>
  </form>
</div>
<div class="quarter">
  <p align="center">Total Users</p>
  <form id="form10" name="form9" method="post" action="">
    <div align="center">
      <label>
        <input type="text" name="textfield4" id="textfield4" />
      </label>
    </div>
  </form>
</div>
<div class="quarter">
  <p align="center">Payment Due</p>
  <form id="form11" name="form9" method="post" action="">
    <div align="center">
      <label>
        <input type="text" name="textfield5" id="textfield5" />
      </label>
    </div>
  </form>
</div>
<div class="quarter">
  <p align="center">Delete User</p>
  <form id="form12" name="form9" method="post" action="">
    <div align="center">
      <input type="button" name="removeuser" id="removeuser" value="Delete" />
    </div>
  </form>
</div>
<div class="quarter">
        <p align="center">VPN Credits</p>
        <form id="form12" name="form9" method="post" action="">
          <div align="center">
            <label>
              <input type="text" name="textfield6" id="textfield6" />
            </label>
          </div>
        </form>
      </div>
      <div class="quarter">
        <p align="center">Status</p>
        <form id="form14" name="form9" method="post" action="">
          <div align="center">
            <label>
              <input type="text" name="textfield7" id="textfield7" />
            </label>
          </div>
        </form>
      </div>
      <div class="quarter">
        <p align="center">Version Code</p>
        <form id="form15" name="form9" method="post" action="">
          <div align="center">
            <label>
              <input type="text" name="textfield8" id="textfield8" />
            </label>
          </div>
        </form>
      </div>
      <div class="quarter">
        <p align="center">Edit User</p>
        <form id="form16" name="form9" method="post" action="">
          <div align="center">
            <input type="button" name="button6" id="button6" value="Edit" />
          </div>
        </form>
      </div>
      <div class="quarter">
      <p align="center">User email</p>
      <form id="form17" name="form10" method="post" action="">
        <label>
          <div align="center">
            <input type="text" name="emailuser" id="emailuser" />
          </div>
        </label>
      </form>
    </div>
<div class="price">
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <hr />
</div>
<div class="price"></div>
  </div>
  <!-- InstanceEndEditable --></div>
<div class="footer">
  <div align="center">visit <a href="http://www.avstream.tv">www.avstream.tv</a> for the latest news</div>
</div>
<div id="modalremoveuser" class="modal" >

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span id="close2" class='close'>&times;</span>
      <h3 id='naslov'>Warning</h3>
    </div>
    <div class="modal-body">
      <div class='overflow-content'>
        <p>WARNING - When you click OK user will be deleted</p>
        <p>Click OK to continue</p>
      </div>
    </div>
    <div class="modal-footer" style='text-align:center;'>
      <button type="button" class="confirmremoveuser" id="confirmremoveuser" style="margin: 0 auto; width: 100px;">OK</button>
      <h4>Avstream</h4>
    </div>
  </div>

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
    foreach($all as $a=>$b)
    {
      $b['status']=='1'?$b['status']='active':'inactive';
      printf("['%s','%s','%s','%s','%s','%s','%s','%s','%s'],",$i,$b['username'],$b['password'],$b['type'],$b['Appname'],$b['expiry_date'],$b['amount'],$b['status'],$b['email']);
      $i++;
    }
  ?>[]];
  $('#select').on('change', function() 
  {
    $("#textfield").val(array[this.value][2]);
    $("#textfield2").val(array[this.value][3]);
    $("#textfield3").val(array[this.value][4]);
    $("#textfield5").val(array[this.value][5]);
    $("#textfield7").val(array[this.value][7]);
    $("#emailuser").val(array[this.value][8])
    $('#u1').val(array[this.value][1]);
    $('#p1').val(array[this.value][2]);
      $.ajax({
        url: '<?php echo base_url(); ?>dashboard/client_users', 
        method: "post",
        data: { name: $("#select option:selected").text() },                                   
        success: function(data)   
        {
          //console.log(data);
          $("#textfield4").val(data['broj']);
          $("#textfield6").val(data['saldo']);
          $("#textfield8").val(data['code']);
        }
    });
  });
  $("#button6").click(function()
  {
    $.ajax({
        url: '<?php echo base_url(); ?>dashboard/ch_vc', 
        method: "post",
        data: { name: $("#select option:selected").text(),code: $("#textfield8").val() },                                   
        success: function()   
        {
          alert('VersionCode.txt changed successfully for user '+$("#select option:selected").text());
        }
    });
  });
  $('#confirmremoveuser').click(function() 
  {
    location.href = "<?php echo base_url(); ?>dashboard/rmuser?u="+$("#select option:selected").text();
  });
  $('#button').click(function() 
  {
    location.href = "<?php echo base_url(); ?>dashboard/downloadfile2?u=starter";
  });
  $('#button2').click(function() 
  {
    location.href = "<?php echo base_url(); ?>dashboard/downloadfile2?u=appy";
  }); 
  $('#button3').click(function() 
  {
    location.href = "<?php echo base_url(); ?>dashboard/downloadfile2?u=ultimate";
  });
  $('#button4').click(function() 
  {
    location.href = "<?php echo base_url(); ?>dashboard/downloadfile2?u=other";
  });
  $('#removeuser').click(function(){
    modalremoveuser.style.display = "block";
  });
  var modalremoveuser = document.getElementById('modalremoveuser');
  var span2 = document.getElementById("close2"); 
  span2.onclick = function() {
      modalremoveuser.style.display = "none";
  }  

  window.onclick = function(event) { 
      if (event.target == modalremoveuser) {
          modalremoveuser.style.display = "none";
      }                  
  }  
</script>
<!-- InstanceEnd --></html>
