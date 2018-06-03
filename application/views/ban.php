<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/MainTemplate.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Ban User or Grant Full Access</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<?php $this->load->view('links/links'); ?>

  <!-- InstanceBeginEditable name="EditingPane" -->
  <div class="editingwindow">
    <p align="center"><span class="price">Ban/Unban Users or Grant Full Access</span><br />
    <span class="tiny">Use this feature to prevent unathorised access or allow full paid access</span></p>
    <p align="center">User Email Address: 
      <input type="text" name="email" id="email" />
    </p>
    <p align="center">
      <input type="button" name="button" id="ban" value="Ban/Unban User" />
      <input type="button" name="button2" id="fullaccess" value="Grant Full Access" />
    </p>
    <p align="center" class="tiny">If the user is already banned enter their email address and select Ban/Unban</p>
    <hr />
  </div>
  <!-- InstanceEndEditable --></div>
<div class="footer">
  <div align="center">visit <a href="http://www.avstream.tv">www.avstream.tv</a> for the latest news</div>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
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
        <input type='button' id='grant' value='Grant Access' style='visibility: hidden;'>
        <input type='hidden' id='number' value=''>                 
      </fieldset>
    </div>
    <div class="modal-footer">
      <h4>Avstream</h4>
    </div>
  </div>
</div>
<script>
$(document).ready(function(){

$('#ban').on('click',function() {
    var formData = new FormData();
    formData.append('email',$('#email').val());
    $.ajax({
        url: '<?php echo base_url(); ?>appy/banunban', 
        type: "POST",            
        data: formData,
        contentType: false,       
        cache: false,             
        processData:false,                             
        success: function(data)   
        {
          alert(data);
          modal1.style.display = "none";
          $('#contentover').empty();
          $('#email').val('');              
        }
    });          
});

  $('#fullaccess').on('click',function() {
      $('#grant').css("visibility", "hidden");
      var formData = new FormData();
      formData.append('user',$('#email').val());
      var modal = document.getElementById('modal1');
      $.ajax({
          url: '<?php echo base_url(); ?>appy/lookupuser',
          method: "post",
          dataType: 'json',
          data: formData,
          contentType: false,       
          cache: false,             
          processData:false,          
          success: function(result){
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
                html += '">' + 'Registered on ' + result.users[i]['RegDate'] + ' on ' + result.users[i]['MacAddress'] + '<br>';
                $('#contentover').prepend(html);
              }
              $('#number').val(length);
              $('#naslov').html('Pick User Devices');                            
              $('.modal-content').find('fieldset').attr('id','sendmessagetomany');
              $('#grant').css("visibility", "visible");
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
    $('#contentover').empty();
}
window.onclick = function(event) {
    if (event.target == modal1) {
        modal1.style.display = "none";
        $('#contentover').empty();
    }
}

$('#grant').on('click',function() {
  var formData = new FormData();
  formData.append('number',$( "#number" ).val());
  for (var i=0; i<$('#number').val(); i++) {
    if ($("#user" + i).is(':checked')) {
      formData.append('user' + i,$("#user" + i).val());
    }                   
  }
  $.ajax({
      url: '<?php echo base_url(); ?>appy/grant', 
      type: "POST",            
      data: formData,
      contentType: false,       
      cache: false,             
      processData:false,                             
      success: function(data)   
      {
        alert(data);
        modal1.style.display = "none";
        $('#contentover').empty();              
      }
  });
});

});
</script>
<!-- InstanceEnd --></html>
