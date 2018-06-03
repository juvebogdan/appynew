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
    <div class="third">
      <p align="center">User</p>
        <label>
          <div align="center">
            <select name="select" id="user">
              <option value=''></option>
              <?php foreach($clients as $client): ?>
                <option value='<?php echo $client['customerId']?>'><?php echo $client['email']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </label>
    </div>
    <div class="third">
      <p align="center">Username</p>
        <label>
          <div align="center">
            <input type="text" name="textfield2" id="username" />
          </div>
        </label>
    </div>
    <div class="third">
      <p align="center">Password</p>
        <label>
          <div align="center">
            <input type="text" name="textfield3" id="pass" />
          </div>
        </label>
    </div>
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
            
  $('#user').on('change', function() {
    var formData = new FormData();
    formData.append('user',this.value);
    $.ajax({
        url: '<?php echo base_url(); ?>appy/vpnuserlookup', 
        method: "post",
        data: formData,
        contentType: false,       
        cache: false,
        dataType: 'json',             
        processData:false, 
        beforeSend: function() {
          $('#pass').val('');
          $('#username').val('');          
        },                                    
        success: function(result)   
        {
          console.log(result);
          if(result.status) {
            $('#pass').val(result.users[0].cpassword);
            $('#username').val(result.users[0].cusername);
          }
          else {
              alert(result.error);
          }              
        }
    });
  });

</script>
<!-- InstanceEnd --></html>
