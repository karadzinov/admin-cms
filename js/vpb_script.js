    //This is the Upload Function
    function upload_fn()
    {
  //alert('COOL');
  $("#file_form").vPB({
  	url: 'vpb_uploader_slider.php',
  	beforeSubmit: function()
  	{
  		$("#upload_status").html('<div style="font-family: Verdana, Geneva, sans-serif; font-size:12px; color:black;" align="center">Please wait <img src="images/admin/loading.gif" align="absmiddle" title="Upload...."/></div><br clear="all">');
  	},
  	success: function(response)
  	{
  		$('#uploadedimage').remove();
  		$("#upload_status").hide().fadeIn('slow').html(response);
  	}
  }).submit();
}
