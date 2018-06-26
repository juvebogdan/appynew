  $('#type').on('change', function() {
      var formData = new FormData();
      formData.append('type',$( "#type option:selected" ).val());
      console.log($( "#type option:selected" ).val());
      //$('#striperesult').text('£ 6');
      $.ajax({         
        type: 'POST',
        url: "http://appy.zone/appynew/iptvcontrol/populatedata",
        data: formData,
        contentType: false,       
        cache: false, 
        dataType: 'json',            
        processData:false,       
        success: function(data){ 
          console.log(data);
          if (data.success=='0') {      
            flasherror();
          }
          else {   
            $('#numusers').text(data.data.numusers);
            $('#usersvalue').text('£ ' + data.data.valueusers);
            $('#numcredits').text(data.data.numcredits);
            $('#creditsvalue').text('£ ' + data.data.valuecredits);
            $('#paypalresult').text('£ ' + data.data.paypalfees);
            $('#striperesult').text('£ ' + data.data.stripefees);   
            $('#partnerfees').text('£ ' + data.data.partnerfees);
            $('#totalvalue').text('£ ' + data.data.total); 
            flash();
          }
        }
      });      
  });