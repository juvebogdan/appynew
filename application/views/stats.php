<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/MainTemplate.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>App Stats</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<?php $this->load->view('links/links'); ?>

  <!-- InstanceBeginEditable name="EditingPane" -->
  <div class="editingwindow">
    <div align="center" class="price">
      <p>User Totals</p>
      <div class="quarter">
        <p><u>Today</u></p>
        <p class="price"><?php echo $today; ?></p>
      </div>
      <div class="quarter">
        <p><u>Week</u></p>
        <p class="price"><?php echo $thisweek; ?></p>
      </div>
      <div class="quarter">
        <p><u>Month</u></p>
        <p class="price"><?php echo $thismonth; ?></p>
      </div>
      <div class="quarter">
        <p><u>Total</u></p>
        <p class="price"><?php echo $allusers; ?></p>
      </div>
        <input type="submit" name="button6" id="csv" value="Download Full CVS" />
    </div>
  </div>
  <div class="editingwindow">
    <hr />
    <div align="center" class="price">
      <p>Look Up &amp; Edit User</p> </div>
      <div class="quarter">
        <p align="center">Email Address</p>
            <div align="center">
              <p>
                <input type="text" name="email" id="email" />
              </p>
              <p>
                <input type="submit" name="emailsubmit" id="emailsubmit" value="Find User" />
              </p>
          </div>
          <div align="center"></div>
      </div>
      <div class="quarter">
        <p align="center">End Trial Date</p>
          <label>
            <div align="center">
              <p>
                <input type="text" name="trial" id="datepicker" />
              </p>
              <p>
            <input type="submit" name="button2" id="edittrial" value="Edit Date" /></p></div>
      </div>
      <div class="quarter">
        <p align="center">Paid Status</p>
          <label>
            <div align="center">
              <p>
                <label>
                  <input type="text" name="status" id="status" />
                </label>
              </p>
              <p>
        <input type="submit" name="button3" id="swap" value="Swap" /></p></div>
      </div>
      <div class="quarter">
        <p align="center">Email Pin Verify</p>
          <label>
            <div align="center">
              <p>
                <input type="text" name="pin" id="pin" />
              </p>
              <p>
                <input type="submit" name="button4" id="copyButton" value="Copy to Clipboard" /></p></div>
      </div>
<p>&nbsp;</p>
   
  </div>
  <div class="editingwindow">
    <div class="quarter">
      <p align="center">IP Address</p>
          <div align="center">
            <p>
              <input type="text" name="ip" id="ip" />
            </p>
            <p>
              <input type="button" name="ipsubmit" id="ipsubmit" value="Find User by IP" />
            </p>
          </div>
        </label>
    </div>
    <div class="quarter">
      <p align="center">Country</p>
      <form id="form6" name="form6" method="post" action="">
        <label>
          <div align="center">
            <input type="text" name="country" id="country" />
          </div>
        </label>
      </form>
    </div>
    <div class="quarter">
      <p align="center">Last Online      </p>
      <form id="form7" name="form6" method="post" action="">
      <div align="center">
          <input type="text" name="lastonline" id="lastonline" />
        </div>
      </form>
    </div>
    <div class="quarter">
        <p align="center">IPTV End Date</p>
          <label>
            <div align="center">
              <p>
                <input type="text" name="editend" id="editend" />
              </p>
              <p>
            <input type="submit" name="buttonend" class="editend" value="Edit Date" /></p></div>
    </div>
    <div class="container">
      <div align="center">
        <input type="button" name="button7" id="deleteuser" value="Delete User" />
      </div>
    </div>    
<div></div>
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
      <input type="button" name="statsbutton" id="statsbutton" value="OK" />
    </div>
  </div>
</div>
<script>
$(document).ready(function(){
  $('#emailsubmit').on('click',function() {
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
                html += '<input type="radio" name="user" id="user' + i + '" value=';
                html += '"' + result.users[i]['ID'] + '"';
                html += '">' + 'Registered on ' + result.users[i]['RegDate'] + ' on ' + result.users[i]['MacAddress'] + ', Last Online at ' + result.users[i]['LastOnline'] + '<br>';
                $('#contentover').prepend(html);
              }
              $('#number').val(length);
              $('#naslov').html('Pick one user Device');                            
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



  $('#ipsubmit').on('click',function() {
      var formData = new FormData();
      formData.append('user',$('#ip').val());
      var modal = document.getElementById('modal1');
      $.ajax({
          url: '<?php echo base_url(); ?>appy/lookupuserip',
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
                html += '<input type="radio" name="user" id="user' + i + '" value=';
                html += '"' + result.users[i]['ID'] + '"';
                html += '">' + 'Registered on ' + result.users[i]['RegDate'] + ' on ' + result.users[i]['MacAddress'] + ', Last Online at ' + result.users[i]['LastOnline'] + '<br>';
                $('#contentover').prepend(html);
              }
              $('#number').val(length);
              $('#naslov').html('Pick one user Device');                            
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

$('#statsbutton').on('click',function() {
  var formData = new FormData();
  formData.append('user',$('input[name=user]:checked').val());
  $.ajax({
      url: '<?php echo base_url(); ?>appy/userdetails', 
      method: "post",
      dataType: 'json',
      data: formData,
      contentType: false,       
      cache: false,             
      processData:false,                             
      success: function(result)   
      {
        modal1.style.display = "none";
        console.log(result);      

        $('#datepicker').val(result[0].trial);
        $('#ip').val(result[0].ip);
        $('#country').val(result[1].country);
        $('#lastonline').val(result[0].LastOnline);
        $('#editend').val(result[0].AccessDuration);
        $('#email').val(result[0].Email);

        if (result[0].Paid == '1') {
          $('#status').val('PAID'); 
        }
        else {
          $('#status').val('UNPAID');
        }
        if (result[0].pinPassed == '1') {
          $('#pin').val('VERIFIED'); 
        }
        else {
          $('#pin').val(result[0].pinPassed);
        }                
      }
  });
});

$('#swap').on('click',function() {
  var formData = new FormData();
  formData.append('user',$('input[name=user]:checked').val());
  $.ajax({
      url: '<?php echo base_url(); ?>appy/swappaid', 
      method: "post",
      data: formData,
      contentType: false,       
      cache: false,             
      processData:false,                             
      success: function(result)   
      {
        if (result=='1') {
            $('#status').val('PAID');
        }
        else if(result=='0') {
            $('#status').val('UNPAID');
        }                 
      }
  });
});

$('#edittrial').on('click',function() {
  var formData = new FormData();
  formData.append('user',$('input[name=user]:checked').val());
  formData.append('date',$('#datepicker').val());
  $.ajax({
      url: '<?php echo base_url(); ?>appy/edittrial', 
      method: "post",
      data: formData,
      contentType: false,       
      cache: false,             
      processData:false,                             
      success: function(result)   
      {
        $('#datepicker').val(result);
        alert('success');                 
      }
  });
});

$('#deleteuser').on('click',function() {
  var formData = new FormData();
  formData.append('user',$('input[name=user]:checked').val());
  $.ajax({
      url: '<?php echo base_url(); ?>appy/deleteuser', 
      method: "post",
      data: formData,
      contentType: false,       
      cache: false,             
      processData:false,                             
      success: function(result)   
      {
        alert(result);                 
      }
  });
});

function copyToClipboard(elem) {
    // create hidden text element, if it doesn't already exist
    var targetId = "_hiddenCopyText_";
    var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
    var origSelectionStart, origSelectionEnd;
    if (isInput) {
        // can just use the original source element for the selection and copy
        target = elem;
        origSelectionStart = elem.selectionStart;
        origSelectionEnd = elem.selectionEnd;
    } else {
        // must use a temporary form element for the selection and copy
        target = document.getElementById(targetId);
        if (!target) {
            var target = document.createElement("textarea");
            target.style.position = "absolute";
            target.style.left = "-9999px";
            target.style.top = "0";
            target.id = targetId;
            document.body.appendChild(target);
        }
        target.textContent = elem.textContent;
    }
    // select the content
    var currentFocus = document.activeElement;
    target.focus();
    target.setSelectionRange(0, target.value.length);
    
    // copy the selection
    var succeed;
    try {
        succeed = document.execCommand("copy");
    } catch(e) {
        succeed = false;
    }
    // restore original focus
    if (currentFocus && typeof currentFocus.focus === "function") {
        currentFocus.focus();
    }
    
    if (isInput) {
        // restore prior selection
        elem.setSelectionRange(origSelectionStart, origSelectionEnd);
    } else {
        // clear temporary content
        target.textContent = "";
    }
    alert('copied');
    return succeed;
}

document.getElementById("copyButton").addEventListener("click", function() {
    copyToClipboard(document.getElementById("pin"));
});


$("#csv").click(function()
{
  $.post( '<?php echo base_url(); ?>appy/csv',function(data2)
  {
    var csvContent = "data:text/csv;charset=utf-8,";
    
    csvContent += "DeviceID,MacAddress,RegDate,EndTrial,Email,Paid,CustomerId,pinPassed,trial,Kill" + "\n";
    var data  = JSON.parse(data2);
    console.log(data2);

    data.forEach(function(infoArray, index)
    {
      dataString = infoArray.join(",");
      csvContent += index < data.length ? dataString+ "\n" : dataString;
    }); 
    var encodedUri = encodeURI(csvContent);
    var link = document.createElement("a");
    link.setAttribute("href", encodedUri);
    link.setAttribute("download", "my_data.csv");
    document.body.appendChild(link); // Required for FF
    link.click();
  });
});

$('.editend').on('click',function() {
  var formData = new FormData();
  formData.append('user',$('input[name=user]:checked').val());
  formData.append('date',$('#editend').val());
  $.ajax({
      url: '<?php echo base_url(); ?>appy/editend', 
      method: "post",
      data: formData,
      contentType: false,       
      cache: false,             
      processData:false,                             
      success: function(result)   
      {
        $('#editend').val(result);
        alert('success');                 
      }
  });
});



});
</script>
<script>
  $( function() {
    $("#datepicker").datepicker({ dateFormat: 'yy-mm-dd' });
  $('#editend').datetimepicker
  ({
    format:'Y-m-d H:i',
    step:10
  });
  } );
</script>
<!-- InstanceEnd --></html>
