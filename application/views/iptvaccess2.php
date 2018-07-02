<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/MainTemplate.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>IPTV Access</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<?php $this->load->view('links/links'); ?>

  <!-- InstanceBeginEditable name="EditingPane" -->
  <div class="editingwindow">
    <p align="center"><span class="price">IPTV Manual Access</span><br />
    <span class="tiny">Manually activate or extend a users device(s) for IPTV access</span></p>
    <p align="center">User Email or IP address: 
      <input type="text" name="textfield" id="user" />
    </p>
<!--     <p align="center">
      <input type="button" name="button" id="search" value="Find User" />
    </p> -->
<!--     <p align="center">Enter the username and password from the IPTV panel</p>
    <p align="center">Username: 
      <input type="text" name="textfield2" id="username" />
    </p>
    <p align="center">Password: 
      <input type="text" name="textfield3" id="password" />
    </p> -->
    <p align="center">Access duration: 
        <select name="select2" id="accessend">
        <option selected="selected">Select</option>
        <option value='week'>Weekender</option>
        <option value='month1'>1 Month</option>
        <option value='month3'>3 Months</option>
        <option value='month6'>6 Months</option>
        <option value='month12'>12 Months</option>
      </select>
    </p>
<!--     <p align="center">Access Ends: 
        <input class='sdt' name='accessends' id='accessend' type='text'>
      <br />
    <span class="tiny">Make sure you set this correctly. Incorrect settings could terminate access earlier that paid for.</span></p>  -->
    <p align="center">
      <input type="button" name="button2" id="submit" value="Submit" />
    </p>
    <p align="center"><span class="tiny"><strong>On Submit</strong><br />
      Your IPTV credit account will be debited<br />
      User will be emailed to notify their access<br />
    In app IPTV access will be instant</span></p>
  </div>
  <!-- InstanceEndEditable --></div>
<div class="footer">
  <div align="center">visit <a href="http://www.avstream.tv">www.avstream.tv</a> for the latest news</div>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="<?php echo base_url();?>js/jquery.datetimepicker.full.js"></script>
<div id="modal1" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span id="close1" class='close'>&times;</span>
      <h3 id='naslov'></h3>
    </div>
    <div class="modal-body">
      <fieldset>
        <div class='overflow-content' id='contentover'>
        </div>
        <input type='hidden' id='number' value=''>                 
      </fieldset>
    </div>
    <div class="modal-footer">
      <h4>Avstream</h4>
      <input type='button' value='OK' style='font-size:20px' onclick='$(".modal").hide();'/>
    </div>
  </div>
</div>
<script>
$(document).ready(function(){


  $('.sdt').datetimepicker
  ({
    format:'Y-m-d H:i',
    step:10
  });



  $('#search').on('click',function() {
      var formData = new FormData();
      formData.append('user',$('#user').val());
      var modal = document.getElementById('modal1');
      $.ajax({
          url: '<?php echo base_url(); ?>appy/lookupuseremailip',
          method: "post",
          dataType: 'json',
          data: formData,
          contentType: false,       
          cache: false,             
          processData:false,          
          success: function(result){
            $('#contentover').empty();
            if (result.status==1) {
              var length= 0;
              for(var key in result.users) {
                if(result.users.hasOwnProperty(key)){
                  length++;
                }
              }
              for(i=0;i<length;i++){
                html = '';
                html += '<input type="checkbox" name="user" id="user' + i + '" value=';
                html += '"' + result.users[i]['ID'] + '"';
                html += '">' + 'Registered on ' + result.users[i]['RegDate'] + ' on ' + result.users[i]['MacAddress'] + ', Last Online at ' + result.users[i]['LastOnline'] + '<br>';
                $('#contentover').prepend(html);
              }
              $('#number').val(length);
              $('#naslov').html('Pick User Devices');                            
              $('.modal-content').find('fieldset').attr('id','sendmessagetomany');
              modal.style.display = 'block';
            }
            else {
                $('#naslov').html('Error'); 
                $('#contentover').prepend(result.error);
                modal.style.display = 'block';              
            }
          }
      });   
  });

var modal1 = document.getElementById('modal1');
var span1 = document.getElementById("close1");
span1.onclick = function() {
    modal1.style.display = "none";
}
window.onclick = function(event) {
    if (event.target == modal1) {
        modal1.style.display = "none";
    }
}

$('#submit').on('click',function() {
  var formData = new FormData();
  formData.append('useremail',$( "#user" ).val());
  formData.append('accessduration',$('#accessend').val());
  $.ajax({
      url: '<?php echo base_url(); ?>appy/grantiptvnew', 
      type: "POST",            
      data: formData,
      contentType: false,       
      cache: false,             
      processData:false,                             
      success: function(data)   
      {
        alert(data);
        location.reload();            
      }
  });
});


});
</script>
<!-- InstanceEnd --></html>
