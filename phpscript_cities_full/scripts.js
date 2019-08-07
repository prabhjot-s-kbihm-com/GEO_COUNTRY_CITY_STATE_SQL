/*********************************************************
   @ author:         Delta Consultants Ltd
   @ product:        Myip.ms
   @ maintainer:     sales@myip.ms
   @ url:            http://myip.ms/info/cities_sql_database
   @ copyright:      Protected by copyright
**********************************************************/

$(document).ready(function() {

	/* display country icon on right side of dropdown list */ 
	if ($('#country').val()) $('.country-icon').html('<img src="images/flags/'+$('#country').val()+'.png" hspace="3" border="0">'); 
	
	$('#country').change(function() 
	{ 
		// country flag
		if ($(this).val()) $('.country-icon').html('<img src="images/flags/'+$(this).val()+'.png" hspace="3" border="0">'); 
		else $('.country-icon').html(''); 
			
		// state
		$('#state').prop('disabled', false).find('[value]').remove();
		if ($(this).val())
		{
			$('#state').append($('<option>', { value: "", text : "... loading ..." }));

			$.getJSON('ajax_items.php?c='+$('#country :selected').val(), function(data) {
				$('#state').find('[value]').remove();
				$('#state').append($('<option>', { value: "", text : " - Select State for "+$('#country :selected').text()+" - " }));
				$.each(data, function(key, val) {
					if (key == "0") $('#state').prop('disabled', true).find('[value]').remove(); else  key = key.substring(1);
					$('#state').append($('<option>', { value: key, text : val }));
				});
				if ($('#state').attr('sel')!==undefined) $('#state option[value="'+$('#state').attr('sel')+'"]').prop('selected', true);
				$("#state").change();
			});	
		}
		else
		{
			$('#state').append($('<option>', { value: "", text : " ... select country first ... " }));
			$("#state").change();
		}
		
	});

	$('#state').change(function() 
	{ 
		// city
		$('#city').find('[value]').remove();
		
		if ($(this).val())
		{	
			$('#city').append($('<option>', { value: "", text : "... loading ..." }));
			$.getJSON('ajax_items.php?c='+$('#country :selected').val()+'&s='+$('#state :selected').val(), function(data) {
				var items = [];
				$('#city').find('[value]').remove();
				$('#city').append($('<option>', { value: "", text : " - Select City for "+($('#state :selected').val()>0?$('#state :selected').text():$('#country :selected').text())+" - " }));
				$.each(data, function(key, val) {
					key = key.substring(1);
					$('#city').append($('<option>', { value: key, text : val }));
				});
				if ($('#city').attr('sel')!==undefined) $('#city option[value="'+$('#city').attr('sel')+'"]').prop('selected', true);
			});	
		}
		else
		{
			$('#city').append($('<option>', { value: "", text : " ... select state/region first ... " }));
		}
	});

	$('#country').change();
	$("#state").change();
});

