  function alertHide() {
    setTimeout(() => {
        $('#flash').hide();
    }, 3000);    
  }

  function flash() {
    $('#flash').show();
    alertHide();
  }

  function load() {
  	$('#loadingDiv').show();
  }

  function stopload() {
  	$('#loadingDiv').hide();
  }

  function alertErrorHide() {
    setTimeout(() => {
        $('#flasherror').hide();
    }, 3000);    
  }
  
  function flasherror() {
    $('#flasherror').show();
    alertErrorHide();
  }