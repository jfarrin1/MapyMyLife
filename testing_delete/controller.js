function deletephp(){
	console.log("deletephp called");
	uid = $('#uid').val();
	console.log(uid);
	$.ajax({
		url: 'delete.php',
		type: 'GET',
		dataType: "json",
		data: {
			id: uid
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
