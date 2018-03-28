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
				var row = "<tr><td>" + data[i].id + "</td><td>" + data[i].name + "</td><td>" + data[i].email + "</td></tr>";
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
                                var row = "<tr><td>" + data[i].id + "</td><td>" + data[i].city + "</td><td>" + data[i].country + "</td><td>"+data[i].date+"</td><td>" + data[i].caption+"</td><td><img style='max-height:200px;' src='" + data[i].url + "'>" + "</td><td style='width:250px;'>"+data[i].text+"</td></tr>";
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

function getPosts(fb_id){
        console.log("get posts called");
	 $.ajax({
                url: './php/get_posts.php',
                type: 'GET',
                dataType: "json",
                data:{
                        fb_id: fb_id
                },
                success: function(response){
                        console.log(response);
			data = response.data;
                	addPostHTML(data, 0, 1);
		},
                error: function(response) {
                        console.log(response);
                        console.log('error!');
                }
        });
        return false;

}

function addPostHTML(data, i, clearDiv){
	if (clearDiv ==1){
		$('#postBody').empty();
	}
	if (i < data.length){
		var html = "<div class=\"col-md-8\"><h3><i class=\"fa fa-map-marker\"  style=\"color:rgb(40,200,150);\"></i> " + data[i].city + ", " + data[i].country + "</h3>";
       		html += "<h5>" + data[i].date + "</h5>";
        	html += "<p>" + data[i].text + "</p></div>"
        	html += "<div class =\"col-md-4\"><i class=\"fa fa-trash-o\" aria-hidden = \"true\" style=\"float: right;\" onclick=\"deletePost(" + data[i].post_id + ")\"></i>";
        	$('#postBody').prepend(html);
		addPostHTML(data, ++i, 0);
	}

}


function loginUser(fb_id, user_name, user_email){
         console.log(fb_id,user_name,user_email);
         $.ajax({
                url: './php/insert_user.php',
                type: 'GET',
                dataType: "json",
                data: {
                        name: user_name,
			email: user_email,
			fb_id: fb_id
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

function insertPost(data){
	console.log('we here');
        $.ajax({
                url: './php/insert_post.php',
                type: 'GET',
                dataType: "json",
                data: {
			user_id: data.user_id,
                        text: data.text,
			date: data.date,
			city: data.city,
			country: data.country,
			lat: data.lat,
			lng: data.lng
                },
                success: function(response){
                        console.log(response);
			getPosts(data.user_id);
                },
                error: function(response) {
                        console.log(response);
                        console.log('error!');
                }
        });
        return false;
}


function insertFriend(user_id, friend_id){
	$.ajax({
                url: './php/insert_friend.php',
                type: 'GET',
                dataType: "json",
                data: {
                        user_id: user_id,
                        friend_id: friend_id
                },
                success: function(response){
                      //  console.log(response);
                },
                error: function(response) {
                        console.log(response);
                        console.log('error!');
                }
        });
        return false;
}

function insertPhoto(data){
//         console.log(user_name,user_email);
         $.ajax({
                url: './php/insert_photo.php',
                type: 'GET',
                dataType: "json",
                data: {
                        fb_id: data.fb_id,
                        lat: data.lat,
                        lng: data.lng,
			url: data.url,
			datetime: data.datetime,
			country: data.country,
			city: data.city,
			caption: data.caption
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



function insert_postphp(){
        console.log("insert_postphp called");
        $.ajax({
                url: './php/insert_post.php',
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

function updatephp(){
        console.log("updatephp called");
        $.ajax({
                url: './php/update.php',
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

function update_photophp(){
        console.log("updatephotophp called");
        $.ajax({
                url: './php/update_photo.php',
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
function update_postphp(){
        console.log("update_postphp called");
        $.ajax({
                url: './php/update_post.php',
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


function deleteUser(){
	console.log("deletephp called");
	uid = $('#getUserID').val();
	console.log(uid);
	$.ajax({
		url: './php/delete.php',
		type: 'GET',
		dataType: "json",
		data: {
			id: uid
		},
		success: function(response){
			console.log(response);
		},
		error: function(response) {
			console.log('error')
			console.log(response)
		}
	});
	return false;
}

function deletePost(post_id){
        console.log("deletepost: ", post_id);
        $.ajax({
                url: './php/delete_post.php',
                type: 'GET',
                dataType: "json",
                data: {
                        post_id: post_id
                },
                success: function(response){
			getPosts(userObject.fb_id)
                        console.log(response);
                },
		error: function(response) {
			console.log('error');
			console.log(response);
		}
        });
        return false;
}

function friend_paradox(fb_id){
        console.log("friend paradox called");
	 $.ajax({
                url: './php/friend_paradox.php',
                type: 'GET',
                dataType: "json",
                data:{
                        fb_id: fb_id
                },
                success: function(response){
                        console.log(response);
			data = response.data;
			o = document.getElementById('odometer');
			o.innerHTML = data;
               		console.log('success');
		},
                error: function(response) {
                        console.log(response);
                        console.log('error!');
                }
        });
        return false;

}
function user_paradox(fb_id){
        console.log("user paradox called");
	 $.ajax({
                url: './php/user_paradox.php',
                type: 'GET',
                dataType: "json",
                data:{
                        fb_id: fb_id
                },
                success: function(response){
                        console.log(response);
			data = response.data;
			o = document.getElementById('odometer2');
			o.innerHTML = data;
               		console.log('success');
		},
                error: function(response) {
                        console.log(response);
                        console.log('error!');
                }
        });
        return false;

}

function suggest_city(fb_id){
        console.log("collab filter");
        $.ajax({
                url: './php/collab_filter.php',
                type: 'GET',
                dataType: "json",
                data:{
                        fb_id: fb_id
                },
                success: function(response){
                        console.log(response);
                        data = response.data;
			console.log(data);
                        console.log('success');
			$('#city_table').find("tr:gt(0)").remove();
			collabFilter(data);
                },
                error: function(response) {
                        console.log(response);
                        console.log('error!');
                }
        });
        return false;

}

function collabFilter(data){
        var similar = [];
        var unique = [];
        for (i in data){
                if (data[i].fb_id != userObject.fb_id){
                        var exists = 0;
                        for (x in data){
                                if (data[x].fb_id == userObject.fb_id && data[x].city == data[i].city){
                                        exists = 1;
                                        break;
                                }
                        }
                        if (exists){
                                similar.push(data[i]);
                        } else {
                                unique.push(data[i]);
                        }
                }
        }
        var similarityScores = {};
        var cityScores = {};
        for (i in similar){
                if (similar[i].fb_id in similarityScores){
                        similarityScores[similar[i].fb_id]++;
                } else {
                        similarityScores[similar[i].fb_id] = 1;
                }
        }
        for (i in unique){
                if (unique[i].city in cityScores){
                        cityScores[unique[i].city] += similarityScores[unique[i].fb_id];
                } else {
                        cityScores[unique[i].city] = similarityScores[unique[i].fb_id];
                }
        }
        var max = 0;
        var maxLocation = {};
        var suggestions = [];
        for (i=0; i < 5; i ++){
                max =0;
                for (city in cityScores){
//                        console.log(city, cityScores[city]);
                        if (cityScores[city] > max && city!='null'){
                                max = cityScores[city];
                                maxLocation = {city: city, score: cityScores[city]};			
			}
                }
  		console.log(maxLocation);
		table = document.getElementById("city_table");
                var row = table.insertRow(-1);
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                cell1.innerHTML = maxLocation.city;
                cell2.innerHTML = maxLocation.score;
		suggestions.push({maxLocation});
                delete cityScores[maxLocation.city];
        }


}
