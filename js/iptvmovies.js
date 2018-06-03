  $('#notfound').on('change', function() {
      $("#edittitle").val($('#notfound').val());  
      $('.img2').attr('src','');
      $('#desc').val('');       
  }); 

  $('#manualtitle').on('change', function() {
      $("#manualedittitle").val($('#notfound').val());  
      $('.img1').attr('src','');
      $('#manualdesc').val(''); 
      $('#manualedittitle').val('');

      var formData = new FormData();
      formData.append('manualtitle',$( "#manualtitle option:selected" ).val());
      $.ajax({         
        type: 'POST',
        url: "http://appy.zone/appynew/playlist/populate/movies",
        data: formData,
        contentType: false,       
        cache: false, 
        dataType: 'json',            
        processData:false,       
        success: function(data){ 
          console.log(data);
          if (data.success=='0') {      
            alert(data.error);
          }
          else {                      
            $("#manualedittitle").val(data.editedtitle); 
            $("#manualgenre").val(data.manualgenre);
            $("#manualdesc").val(data.manualdesc);
            $("#manualimgurl").val(data.manualimgurl);
            $(".img1").attr('src',data.manualimgurl);
          }
        }
      });      
  });

  $('#showimgurl').click(function(){
      $('.img1').attr('src',$('#manualimgurl').val());
  });

  $("#search").click(function(e) {
    e.preventDefault();
    var formData = new FormData();
    formData.append('edittitle',$('#edittitle').val());
    formData.append('title',$( "#notfound option:selected" ).text()); 
    formData.append('titlelink',$('#titlelink').val());
    if (!$("#load1").hasClass("fa fa-circle-o-notch fa-spin")) {
      $.ajax({         
        type: 'POST',
        url: "http://appy.zone/appynew/playlist/imdb/search",
        data: formData,
        contentType: false,       
        cache: false, 
        dataType: 'json',            
        processData:false,
        beforeSend: function() {
            $("#load1").addClass('fa fa-circle-o-notch fa-spin');
        },        
        success: function(data){ 
          console.log(data);
          $("#load1").removeClass('fa fa-circle-o-notch fa-spin');
          if (data.success=='0') { 
      		$('.img2').attr('src','');
      		$('#desc').val('');               
          	flasherror();
          }
          else {
          	$('.img2').attr('src',data.data.Poster);
          	$('#desc').val(data.data.Plot);
          }
        }
      });
    }       
  });

  $("#submit").click(function(e) {
    e.preventDefault();
    var formData = new FormData();
    formData.append('edittitle',$('#edittitle').val());
    formData.append('title',$( "#notfound option:selected" ).text()); 
    formData.append('titlelink',$('#titlelink').val());
    if (!$("#load2").hasClass("fa fa-circle-o-notch fa-spin")) {
      $.ajax({         
        type: 'POST',
        url: "http://appy.zone/appynew/playlist/imdb/submit",
        data: formData,
        contentType: false,       
        cache: false, 
        dataType: 'json',            
        processData:false,
        beforeSend: function() {
            $("#load2").addClass('fa fa-circle-o-notch fa-spin');
        },        
        success: function(data){ 
          console.log(data);
          $("#load2").removeClass('fa fa-circle-o-notch fa-spin');
          if (data.success=='0') {      
          	flasherror();
          }
          else {
            $('#notfound').empty();
            var $dropdown = $("#notfound");
            $.each(data.data, function() {
                $dropdown.append($("<option />").val(this).text(this));
            });            
          	$('.img2').attr('src','');
          	$('#desc').val('');
            $('#titlelink').val('');
            $("#edittitle").val($('#notfound').val()); 
          	flash();
          }
        }
      });
    }       
  }); 

  var filesArray3 = [];
  $("#imgInp3").on('change', previewFiles3);

      function previewFiles3( e ) {
    
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
            $('.img3').attr('src', e.target.result);
              if (eventTrigger=='imgInp3') {
                filesArray3[0] = theFile;
              }              
              console.log(filesArray3);
            };
          })(f);
          reader.readAsDataURL(f);
          $(e.target).prop("value", "");
      }
  } 

  $("#save3").click(function(e) {
    e.preventDefault();
    var formData = new FormData();
    for(var i= 0, file; file = filesArray3[i]; i++)
    {
        formData.append('files[]', file);
    }
    formData.append('title',$('#movies').val());
    formData.append('fulltitle',$( "#movies option:selected" ).text()); 
    if (filesArray3.length == 1 && $('#movies').val()!='') {
        if (!$("#load3").hasClass("fa fa-circle-o-notch fa-spin")) {
          $.ajax({         
            type: 'POST',
            url: "http://appy.zone/appynew/playlist/uploadimage/movie",
            data: formData,
            contentType: false,       
            cache: false,             
            processData:false,
            beforeSend: function() {
                $("#load3").addClass('fa fa-circle-o-notch fa-spin');
            },        
            success: function(data){ 
              console.log(data);
              $('#movies')
              $("#load3").removeClass('fa fa-circle-o-notch fa-spin');       
              flash();
            }
          });
        }
    }
    else {
      alert("Please upload an image and select genre");
    }       
  });


  $("#manualsubmit").click(function(e) {
    e.preventDefault();
    var formData = new FormData();
    formData.append('manualedittitle',$('#manualedittitle').val());
    formData.append('manualtitle',$( "#manualtitle option:selected" ).val());
    formData.append('manualgenre',$( "#manualgenre option:selected" ).text()); 
    formData.append('manualdesc',$('#manualdesc').val());
    formData.append('manualimgurl',$('#manualimgurl').val());
    if (!$("#load4").hasClass("fa fa-circle-o-notch fa-spin")) {
      $.ajax({         
        type: 'POST',
        url: "http://appy.zone/appynew/playlist/manualedit/movies",
        data: formData,
        contentType: false,       
        cache: false, 
        dataType: 'json',            
        processData:false,
        beforeSend: function() {
            $("#load4").addClass('fa fa-circle-o-notch fa-spin');
        },        
        success: function(data){ 
          console.log(data);
          $("#load4").removeClass('fa fa-circle-o-notch fa-spin');
          if (data.success=='0') {      
            alert(data.error);
          }
          else { 
            $('#notfound').empty();
            var $dropdown = $("#notfound");
            $.each(data.data, function() {
                $dropdown.append($("<option />").val(this).text(this));
            });                      
            $('.img1').attr('src','');
            $('#manualdesc').val('');
            $('#manualimgurl').val('');
            $('#manualedittitle').val('');
            flash();
            //alert('In testing');
          }
        }
      });
    }       
  });