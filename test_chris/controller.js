function updatephp(){
	console.log("updatephp called");
	$.ajax({
		url: 'update.php',
		type: 'GET',
		dataType: "json",
		data: {
			age: 19
		},
		success: function(response){
			console.log(response);
		},
		error: function(response) {
			console.log(response);
			console.log('error!'); 
		}
	});
	return false;

}
