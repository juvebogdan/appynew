<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/MainTemplate.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Lodi Panel</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<?php $this->load->view('links/links'); ?>
  <div class="editingwindow">
    <div class="price">
      <p>Client Stats
 </p>
      <div class="quarter">
        <p align="center">Day</p>
        <h1 align="center"><?php echo $today;?></h1>
      </div>
      <div class="quarter">
        <p align="center">Week</p>
        <h1 align="center"><?php echo $thisweek;?></h1>
      </div>
      <div class="quarter">
        <p align="center">Month</p>
        <h1 align="center"><?php echo $thismonth;?></h1>
      </div>
      <div class="quarter">
        <p align="center">All</p>
        <h1 align="center"><?php echo $numall;?></h1>
      </div>
      <p>&nbsp;</p>
      <p align="center">
        <input type="submit" name="button" id="csv" value="Download Emails" />
      </p>
    </div>
  </div>
  
  <div class="editingwindow">
    <div class="price">
      <p>Look up client</p>
    </div>
    <div class="quarter">
      <div align="center">
        <p>User</p></div>
        <label>
          <div align="center">
            <select name="select" id="user" style="width: 200px">
              <option></option>
              <?php foreach($users as $user): ?>
                <option><?php echo $user['username']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </label>
    </div>
    <div class="quarter">
      <div align="center">
        <p>Password</p>
      </div>
        <label>
          <div align="center">
            <input type="text" name="textfield" id="pass" />
          </div>
        </label>
    </div>
    <div class="quarter">
      <p align="center">Total Builds
 </p>
        <label>
          <div align="center">
            <input type="text" name="textfield2" id="builds" />
          </div>
        </label>
    </div>
    <div class="quarter">
      <p align="center">Total Downloads
 </p>
        <label>
          <div align="center">
            <input type="text" name="textfield3" id="hits" />
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
$(document).ready(function(){
  $('#user').on('change', function() {
    var formData = new FormData();
    formData.append('user',this.value);
    $.ajax({
        url: '<?php echo base_url(); ?>dashboard/userlookup', 
        method: "post",
        data: formData,
        contentType: false,       
        cache: false,
        dataType: 'json',             
        processData:false,                             
        success: function(result)   
        {
          if(result.status) {
            console.log(result);
            $('#pass').val(result.users.password);
            $('#builds').val(result.builds);  
            $('#hits').val(result.hits.hits);  
          }
          else {
              alert(result.error);
          }              
        }
    });
  });

$("#csv").click(function()
{
  $.post( '<?php echo base_url(); ?>dashboard/lodicsv',function(data2)
  {
    var csvContent = "data:text/csv;charset=utf-8,";
    
    csvContent += "Email,Password,Confirmed" + "\n";
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


});
</script>
<!-- InstanceEnd --></html>
