function insertphp(){
	console.log("insertphp called");
	$.ajax({
		url: 'insert.php',
		type: 'PUT',
		dataType: "json",
		success: function(response){
			console.log(data,response);
		},
		error: function(response) {
			console.log(response);
			console.log('error!'); 
		}
	});
	return false;

}
