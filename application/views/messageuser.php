<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/MainTemplate.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Message Users</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<?php $this->load->view('links/links'); ?>

  <!-- InstanceBeginEditable name="EditingPane" -->
  <div class="editingwindow">
  <div class="price">
    <div align="center">
      <p>Message Users<br />
      <span class="tiny">This facility will send a message direct to the users screen the next time their device is launched.</span>    </p>
</div>
  </div></div>
  <div class="editingwindow">
    <div class="trueHalf">
      <p><u>Send to  user group      </u></p>
      <p>
        <input type="radio" name="radio" id="radio" value="new" />
        New Users (Last 30 days)<br />
        <input type="radio" name="radio" id="radio2" value="all" />
        All Users<br />
        <input type="radio" name="radio" id="radio3" value="iptv" />
IPTV Users </p>
    </div>
    <div class="trueHalf">
      <p><u>Send to an individual user</u></p>
      <p>Email Address 
        <input type="text" name="user" id="user" />
        <input type="button" name="search" id="search" value="Find" />
      </p>
    </div>
  </div>
  <div class="editingwindow">
    <p>Message</p>
      <label>
        <textarea name="textarea2" id="message" cols="45" rows="5" placeholder="Enter message..."></textarea>
      </label>
      <input type="button" name="button2" id="sendmessage" value="Send Message" />
    <p>&nbsp;</p>
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
        <input type='button' id='sendtomany' value='Send Message' style='visibility: hidden;'>
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
  $('#search').on('click',function() {
      $('#sendtomany').css("visibility", "hidden");
      var formData = new FormData();
      formData.append('user',$('#user').val());
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
              $('#sendtomany').css("visibility", "visible");
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

$('#sendtomany').on('click',function() {
  var formData = new FormData();
  formData.append('number',$( "#number" ).val());
  for (var i=0; i<$('#number').val(); i++) {
    if ($("#user" + i).is(':checked')) {
      formData.append('user' + i,$("#user" + i).val());
    }                   
  }
  formData.append('message',$('#message').val());
  $.ajax({
      url: '<?php echo base_url(); ?>appy/sendtomany', 
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
$('#sendmessage').on('click',function() {
  if (typeof $('input[name=radio]:checked').val()!=='undefined') {
      var formData = new FormData();
      formData.append('message',$('#message').val());
      formData.append('group',$('input[name=radio]:checked').val());
      $.ajax({
          url: '<?php echo base_url(); ?>appy/sendmessage', 
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
  }
  else {
    alert('You must select a group to send message');
  }
});

});
</script>
<!-- InstanceEnd --></html>
