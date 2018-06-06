   var filesArray1 = [];
   var filesArray2 = [];

    function previewFiles( e ) {
    
    var files = e.target.files;
       
    var eventTrigger = e.currentTarget.id;
    
      for (var i = 0, f; f = files[i]; i++) {
          
          if (!f.type.match('image/png')) {
              alert('You must upload png image');
              continue;
          }

          var reader = new FileReader();

                      
          reader.onload = (function(theFile) {
            return function(e) {          
            $('.img1').attr('src', e.target.result);
              if (eventTrigger=='imgInp') {
                filesArray1[0] = theFile;
              }              
              console.log(filesArray1);
            };
          })(f);
          reader.readAsDataURL(f);
          $(e.target).prop("value", "");
      }
  }

  $("#imgInp").on('change', previewFiles);

    function previewFiles2( e ) {
    
    var files = e.target.files;
       
    var eventTrigger = e.currentTarget.id;
    
      for (var i = 0, f; f = files[i]; i++) {
          
          if (!f.type.match('image/png')) {
              alert('You must upload png image');
              continue;
          }

          var reader = new FileReader();

                      
          reader.onload = (function(theFile) {
            return function(e) {          
            $('.img2').attr('src', e.target.result);
              if (eventTrigger=='imgInp2') {
                filesArray2[0] = theFile;
              }              
              console.log(filesArray2);
            };
          })(f);
          reader.readAsDataURL(f);
          $(e.target).prop("value", "");
      }
  }

  $("#imgInp2").on('change', previewFiles2);  

$('#submitm3u').click(function(e){
    e.preventDefault();
    var formData = new FormData();
    formData.append('m3u',$('#m3u').val());
    $.ajax({
        url: 'http://appy.zone/appynew/playlist/m3u', 
        method: "post",
        data: formData,
        contentType: false,       
        cache: false,
        dataType: 'json',             
        processData:false,
        beforeSend: function() {
          load();
        },                             
        success: function(data)
        {
            stopload();
            if(data.success) {
                channels = data.data;
                flash();
                location.reload();
                //populateGroupTitles()
            }
            else {
                alert(data.error);
            }
        }
    });
});

$('#submitepg').click(function(e){
    e.preventDefault();
    var formData = new FormData();
    formData.append('epg',$('#epg').val());
    $.ajax({
        url: 'http://appy.zone/appynew/playlist/epg', 
        method: "post",
        data: formData,
        contentType: false,       
        cache: false,
        dataType: 'json',             
        processData:false,
        beforeSend: function() {
          load();
        },                             
        success: function(data)
        {
            //console.log(data);
            stopload();
            if(data.success) {
                flash();
            }
            else {
                alert(data.error);
            }
        }
    });
});



function populateGroupTitles() {

  $('#group-titles option').remove();
  $('#live-group-titles option').remove(); 

  $('#group-titles').append($('<option>', { 
      value: '',
      text : 'Choose a channel group' 
  }));

  $('#live-group-titles').append($('<option>', { 
      value: '',
      text : 'Choose a channel group'
  }));     
   
  $.each(channels, function(index, value){

    if (index!='') {
      $('#group-titles').append($('<option>', { 
          value: index.trim().replace(/\s+/g, ''),
          text : index.trim() 
      }));

      $('#live-group-titles').append($('<option>', { 
          value: index.trim().replace(/\s+/g, ''),
          text : index.trim() 
      })); 
    }    

  });    
}

  $("#save1").click(function(e) {
    e.preventDefault();
    var formData = new FormData();
    for(var i= 0, file; file = filesArray1[i]; i++)
    {
        formData.append('files[]', file);
    }
    formData.append('title',$('#group-titles').val());
    formData.append('fulltitle',$( "#group-titles option:selected" ).text()); 
    if (filesArray1.length == 1 && $('#group-titles').val()!='') {
        if (!$("#load1").hasClass("fa fa-circle-o-notch fa-spin")) {
          $.ajax({         
            type: 'POST',
            url: "http://appy.zone/appynew/playlist/uploadimage/title",
            data: formData,
            contentType: false,       
            cache: false,             
            processData:false,
            beforeSend: function() {
                $("#load1").addClass('fa fa-circle-o-notch fa-spin');
            },        
            success: function(data){ 
                console.log(data);
              $("#load1").removeClass('fa fa-circle-o-notch fa-spin');       
              flash();
              location.reload();
            }
          });
        }
    }
    else {
      alert("Please upload an image and select group title");
    }       
  });

$("#save2").click(function(e) {
    e.preventDefault();
    var formData = new FormData();
    for(var i= 0, file; file = filesArray2[i]; i++)
    {
        formData.append('files[]', file);
    }
    formData.append('title',$('#channels').val());
    formData.append('fulltitle',$( "#live-group-titles option:selected" ).text()); 
    if (filesArray2.length == 1 && $('#channels').val()!='') {
        if (!$("#load2").hasClass("fa fa-circle-o-notch fa-spin")) {
          $.ajax({         
            type: 'POST',
            url: "http://appy.zone/appynew/playlist/uploadimage/channel",
            data: formData,
            contentType: false,       
            cache: false,             
            processData:false,
            beforeSend: function() {
                $("#load2").addClass('fa fa-circle-o-notch fa-spin');
            },        
            success: function(data){ 
                console.log(data);
              $("#load2").removeClass('fa fa-circle-o-notch fa-spin');       
              flash();
              location.reload();
            }
          });
        }
    }
    else {
      alert("Please upload an image and select channel");
    }       
  });

  $('#channels').on('change', function() {
    //$('.img1').attr('src',this.value);
      var formData = new FormData();
      formData.append('title',$('#channels').val());
      $.ajax({         
        type: 'POST',
        url: "http://appy.zone/appynew/playlist/imagepath/channel",
        data: formData,
        contentType: false,       
        cache: false,             
        processData:false,
        success: function(data){ 
          console.log(data);
            if (data!='none') {
              $('.img2').attr('src',data);
            }
            else {
              $('.img2').removeAttr('src');
            }
        }
      });    
  });

  $('#group-titles').on('change', function() {
    //$('.img1').attr('src',this.value);
      var formData = new FormData();
      formData.append('title',$('#group-titles').val());
      $.ajax({         
        type: 'POST',
        url: "http://appy.zone/appynew/playlist/imagepath/title",
        data: formData,
        contentType: false,       
        cache: false,             
        processData:false,
        success: function(data){ 
          //console.log(data);
            if (data!='none') {
              $('.img1').attr('src',data);
            }
            else {
              $('.img1').removeAttr('src');
            }
        }
      });    
  }); 

  $("#group-remove").click(function(e) {
      e.preventDefault();
      var formData = new FormData();
      formData.append('title',$('#group-titles-remove').val());
      formData.append('fulltitle',$( "#group-titles-remove option:selected" ).text()); 
      if ($('#group-titles-remove').val()!='') {
          $.ajax({         
            type: 'POST',
            url: "http://appy.zone/appynew/playlist/groupremove/live",
            data: formData,
            contentType: false,       
            cache: false,             
            processData:false,       
            success: function(data){ 
              console.log(data);
              alert(data);
              location.reload();
            }
          });  
      }
      else {
        alert('Pick a channel group to remove');
      }    
  });
