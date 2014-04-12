
	function onlookup(input){
    	var iframe = document.getElementById("ifr_lookup_id");
		var field = document.getElementById( input.id + "_field" );
		var table = document.getElementById( input.id + "_table" );
		var field_result = document.getElementById( input.id + "_field_result" );
		var id_result = document.getElementById( input.id + "_id_result" );
		var sid_get = document.getElementById( input.id + "_sid_get" );
		var include = document.getElementById( input.id + "_include" );
		
		
		if ( iframe && field && table && field_result && id_result && sid_get ) {
			iframe.src = "robo_lookup_lite.php?" + sid_get.value + "&lk_field=" + field.value + "&lk_value=" + input.value + "&lk_table=" + table.value + "&lk_field_result=" + field_result.value + "&lk_input_id=" + id_result.value + "&lk_include=" + include.value;
		}
		
	}
	

	function lookup_return(input_id, input_value){
		var input = document.getElementById( input_id );
		if ( input ) {
			input.value = input_value;
		}
	}
