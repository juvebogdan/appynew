  $('#checkboxyes').change(function() {   
      if (this.checked) {
          $('#checkboxno').prop('checked', false);
      } else {
        $('#checkboxno').prop('checked', true);
      }
  });
  $('#checkboxno').change(function() {
      // this will contain a reference to the checkbox   
      if (this.checked) {
          $('#checkboxyes').prop('checked', false);
      } else {
        $('#checkboxyes').prop('checked', true);
      }
  });

$('#submit').click(function(e){
    e.preventDefault();
    var formData = new FormData();
    formData.append('cost',$('#cost').val());
    formData.append('annual',$('#annual').val());
    formData.append('checkyes',$("#checkboxyes").is(':checked'));
    formData.append('checkno',$("#checkboxno").is(':checked'));
    formData.append('freetrialtype',$( "#freetrialtype option:selected" ).val());
    formData.append('duration',$('#duration').val());
    formData.append('ppusername',$('#ppusername').val());
    formData.append('pppassword',$('#pppassword').val());
    formData.append('secret',$('#secret').val());
    formData.append('public',$('#public').val());
    $.ajax({
        url: 'http://appy.zone/appynew/unlock/devjob', 
        method: "post",
        data: formData,
        contentType: false,       
        cache: false,
        dataType: 'json',             
        processData:false, 
        beforeSend: function() {
            $("#load").addClass('fa fa-circle-o-notch fa-spin');
        },                                     
        success: function(data)
        {
            $("#load").removeClass('fa fa-circle-o-notch fa-spin');
            if (data.success) {
              alert('success');
              window.location.replace("http://appy.zone/appynew");
            }
            else {
              alert(data.error);
            }
        }
    });
});  