function getUsers(){
	console.log("query db called");
	$.ajax({
		url: './php/getUsers.php',
		type: 'GET',
		dataType: "json",
		success: function(response){
			console.log(response);
			var data = response.data;
			$("#userTable").find("tr:gt(0)").remove();
			for (i=0; i < data.length; i++){
				var row = "<tr><td>" + data[i].id + "</td><td>" + data[i].name + "</td><td>" + data[i].age + "</td></tr>";
				$('#userTable').append(row);
			}
		},
		error: function(response) {
			console.log(response);
			console.log('error!'); 
		}
	});
	return false;

}

function getPhotos(){
        console.log("get photo called");
	uid = $('#getUserID').val();
        $.ajax({
                url: './php/getPhotos.php',
                type: 'GET',
                dataType: "json",
                data: {
                        id: uid
                },
                success: function(response){
                        console.log(response);
			var data = response.data;
                        $("#photoTable").find("tr:gt(0)").remove();
                        for (i=0; i < data.length; i++){
                                var row = "<tr><td>" + data[i].id + "</td><td>" + data[i].location + "</td><td>" + data[i].date + "</td><td><img style='max-height:200px;' src='" + data[i].url + "'>" + "</td></tr>";
                                $('#photoTable').append(row);
                        }

			
                },
                error: function(response) {
                        console.log(response);
                        console.log('error!');
                }
        });
        return false;

}

function getPosts(){
        console.log("get posts called");
        id = $('#getUserID').val();
	 $.ajax({
                url: './php/getPosts.php',
                type: 'GET',
                dataType: "json",
                data: {
                        id: id
                },
                success: function(response){
                        console.log(response);
                        var data = response.data;
                        $("#postTable").find("tr:gt(0)").remove();
                        for (i=0; i < data.length; i++){
                                var row = "<tr><td>" + data[i].id + "</td><td>" + data[i].location + "</td><td>" + data[i].date + "</td><td>" + data[i].text  + "</td></tr>";
                                $('#postTable').append(row);
                        }

                },
                error: function(response) {
                        console.log(response);
                        console.log('error!');
                }
        });
        return false;

}


