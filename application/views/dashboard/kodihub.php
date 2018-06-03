<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/MainTemplate.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Kodi Hub</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<?php $this->load->view('links/links'); ?>

  <div class="editingwindow">
    <div class="price">Kodi Hub Stats</div>
    <div class="third">
      <p align="center">Total Clients</p>
      <h1 align="center"><?php echo $numclients ?></h1>
    </div>
    <div class="third">
      <p align="center">Total Builds</p>
      <h1 align="center"><?php echo $numbuilds ?></h1>
    </div>
    <div class="third">
      <p align="center">Total Downloads</p>
      <h1 align="center"><?php echo $numdownloads ?></h1>
    </div>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p align="center">
      <input type="button" name="button" id="csv" value="Download Client Emails" />
    </p>
  </div>
  <div class="editingwindow">
    <div class="price">Client &amp; Build Information</div>
    <div class="quarter">
      <p align="center">User
 </p>
        <label>
          <div align="center">
            <select name="select" id="user" style="width: 200px">
              <option></option>
              <?php foreach($users as $user): ?>
                <option><?php echo $user['email']; ?></option>
              <?php endforeach; ?>              
            </select>
          </div>
        </label>
    </div>
    <div class="quarter">
      <p align="center">Password
 </p>
        <label>
          <div align="center">
            <input type="text" name="textfield" id="pass" />
          </div>
        </label>
    </div>
    <div class="quarter">
      <p align="center">Builds</p>
        <label>
          <div align="center">
            <select name="select2" id="build">
            </select>
          </div>
        </label>
    </div>
    <div class="quarter">
      <p align="center">Downloads</p>
        <label>
          <div align="center">
            <input type="text" name="textfield2" id="downloads" />
          </div>
        </label>
    </div>
  </div>
  <div class="editingwindow">
    <div class="quarter">
      <p>Last Updated</p>
        <label>
          <input type="text" name="textfield3" id="lastupdate" />
        </label>
    </div>
    <div class="quarter">
      <p align="center">Build URL</p>
        <label>
          <div align="center">
            <input type="text" name="textfield4" id="buildurl" />
          </div>
        </label>
    </div>
<div class="quarter">
  <p align="center">Remove Build</p>
    <div align="center">
      <input type="button" name="button2" id="removebuild" value="Remove" />
    </div>
</div>
<div class="quarter">
  <p align="center">Remove User</p>
    <div align="center">
      <input type="submit" name="button3" id="removeuser" value="Remove" />
    </div>
</div>
  </div>
  <!-- InstanceEndEditable --></div>
<div class="footer">
  <div align="center">visit <a href="http://www.avstream.tv">www.avstream.tv</a> for the latest news</div>
</div>
</body>
<div id="modalremove" class="modal" >

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span id="close3" class='close'>&times;</span>
      <h3 id='naslov'>Warning</h3>
    </div>
    <div class="modal-body">
      <div class='overflow-content'>
        <p>WARNING - When you click OK build will be removed completely</p>
        <p>Click OK to continue</p>
      </div>
    </div>
    <div class="modal-footer" style='text-align:center;'>
      <button type="button" class="confirmremove" id="button" style="margin: 0 auto; width: 100px;">OK</button>
      <h4>Avstream</h4>
    </div>
  </div>

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
        <p>WARNING - When you click OK user will be deleted alongside with all his builds</p>
        <p>Click OK to continue</p>
      </div>
    </div>
    <div class="modal-footer" style='text-align:center;'>
      <button type="button" class="confirmremoveuser" id="button" style="margin: 0 auto; width: 100px;">OK</button>
      <h4>Avstream</h4>
    </div>
  </div>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$(document).ready(function(){

  var modalremove = document.getElementById('modalremove');
  var modalremoveuser = document.getElementById('modalremoveuser');
  var span3 = document.getElementById("close3");
  var span2 = document.getElementById("close2");

  span3.onclick = function() {
      modalremove.style.display = "none";
  } 
  span2.onclick = function() {
      modalremoveuser.style.display = "none";
  }  

  window.onclick = function(event) {
      if (event.target == modalremove) {
          modalremove.style.display = "none";
      } 
      if (event.target == modalremoveuser) {
          modalremoveuser.style.display = "none";
      }                  
  }    

  $('#user').on('change', function() {
    var formData = new FormData();
    formData.append('user',this.value);
    var $dropdown = $("#build");
    $.ajax({
        url: '<?php echo base_url(); ?>dashboard/kodiuserlookup', 
        method: "post",
        data: formData,
        contentType: false,       
        cache: false,
        dataType: 'json',             
        processData:false, 
        beforeSend: function() {
	        $dropdown.empty();
	        $('#pass').val('');
	        $('#downloads').val('');
	        $('#lastupdate').val('');
	        $('#buildurl').val('');            
        },                                    
        success: function(result)   
        {
          console.log(result);
          if(result.status) {
            $('#pass').val(result.password);
              if (result.builds=='nobuilds') {
                  alert('User has no builds');
              }
              else {
                $dropdown.append($("<option />").val('').text(''));
                $.each(result.builds, function() {
                    $dropdown.append($("<option />").val(this.code).text(this.title));
                });                
              }
          }
          else {
              alert(result.error);
          }              
        }
    });
  });

$("#csv").click(function()
{
  $.post( '<?php echo base_url(); ?>dashboard/kodicsv',function(data2)
  {
    var csvContent = "data:text/csv;charset=utf-8,";
    
    csvContent += "Email,Password,Active" + "\n";
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

$('#build').change(populateBuild);

function populateBuild() {
  var build = $('#build option:selected');
  if (build.val()!='') {
    var formData = new FormData();
    formData.append('code',build.val());
    $.ajax({
        url: '<?php echo base_url(); ?>dashboard/buildData', 
        method: "post",
        data: formData,
        contentType: false,       
        cache: false,
        dataType: 'json',             
        processData:false,
        beforeSend: function() {
          $('#downloads').val('');
          $('#lastupdate').val('');
          $('#buildurl').val('');
        },                                     
        success: function(result)   
        {
          console.log(result);
          if (result.status) {
            $('#downloads').val(result.buildData.clicks);
            $('#lastupdate').val(result.buildData.updated_at);
            $('#buildurl').val('https://kodihub.net/' + result.buildData.unique_chars);
          }
          else {
            alert(result.error);
          }                      
        }
    });    
  }
}

  $('#removebuild').click(function(){
    modalremove.style.display = "block";
  }); 

  $('#removeuser').click(function(){
    modalremoveuser.style.display = "block";
  });   

  $(".confirmremove").click(function() {
    modalremove.style.display = "none";
    var formData = new FormData();
    formData.append('buildname',$( "#build option:selected" ).val()); 
    if($( "#build option:selected" ).text() != '') {
      $.ajax({         
        type: 'POST',
        url: "<?php echo base_url(); ?>dashboard/removebuild",
        data: formData,
        contentType: false,       
        cache: false,             
        processData:false,
        beforeSend: function() {
          $('.confirmremove').prop('disabled',true);
          $(".confirmremove").text('Please wait');
        },        
        success: function(data){        
        	alert(data.result);
        	location.reload();
        }
      });
    }
    else {
		alert('Please select build');    
    } 
  });


  $(".confirmremoveuser").click(function() {
    modalremove.style.display = "none";
    var formData = new FormData();
    formData.append('user',$( "#user option:selected" ).text()); 
    if($( "#user option:selected" ).text() != '') {
      $.ajax({         
        type: 'POST',
        url: "<?php echo base_url(); ?>dashboard/removeuser",
        data: formData,
        contentType: false,       
        cache: false,             
        processData:false,
        beforeSend: function() {
          $('.confirmremoveuser').prop('disabled',true);
          $(".confirmremoveuser").text('Please wait');
        },           
        success: function(data){        
          alert(data.result);
          location.reload();
        }
      });
    }
    else {
    alert('Please select user');    
    } 
  });  

});
</script>
<!-- InstanceEnd --></html>
