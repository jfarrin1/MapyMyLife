// This is called with the results from from FB.getLoginStatus().
function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
        // Logged into your app and Facebook.
        getUserData();
    } else if (response.status === 'not_authorized') {
        // The person is logged into Facebook, but not your app.
        document.getElementById('status').innerHTML = 'Please log ' +
          'into this app.';
    } else {
        // The person is not logged into Facebook, so we're not sure if
        // they are logged into this app or not.
        document.getElementById('status').innerHTML = 'Please log ' +
          'into Facebook.';
    }
}

// This function is called when someone finishes with the Login
// Button.  See the onlogin handler attached to it in the sample
// code below.
function checkLoginState() {
    FB.getLoginStatus(function (response) {
        statusChangeCallback(response);
    });
}

window.fbAsyncInit = function () {
    FB.init({
        appId: '1222853444476821',
        cookie: true,  // enable cookies to allow the server to access
        // the session
        xfbml: true,  // parse social plugins on this page
        version: 'v2.8' // use graph api version 2.8
    });

    // Now that we've initialized the JavaScript SDK, we call
    // FB.getLoginStatus().  This function gets the state of the
    // person visiting this page and can return one of three states to
    // the callback you provide.  They can be:
    //
    // 1. Logged into your app ('connected')
    // 2. Logged into Facebook, but not your app ('not_authorized')
    // 3. Not logged into Facebook and can't tell if they are logged into
    //    your app or not.
    //
    // These three cases are handled in the callback function.

    FB.getLoginStatus(function (response) {
        statusChangeCallback(response);
    });

};

// Load the SDK asynchronously
(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));


function storeFbPhotos(photos){
  if (photos != null){
    for (i=0; i < photos.length; i++){
	    photoDate = photos[i].created_time.substring(0,10) + ' ' + photos[i].created_time.substring(11,19);
	if(photos[i].place.location == null || photos[i].place.location.city == null || photos[i].place.location.country == null){
//		coordsToName({fb_id: userObject.fb_id, lat: photos[i].place.location.latitude, lng: photos[i].place.location.longitude, url: photos[i].images[0].source, date: photoDate, caption: photos[i].name}, insertPhoto);
		console.log('no location: ', photos[i].place);
	} else {
	    insertPhoto({fb_id: userObject.fb_id,
		lat: photos[i].place.location.latitude,
		lng: photos[i].place.location.longitude,
		url: photos[i].images[0].source,
		datetime: photoDate,
                country: photos[i].place.location.country,
                city: photos[i].place.location.city,
		caption: photos[i].name }
	    );	
	}
    }
    addFacebook()
  }
}

function storeFbFriends(friends){
	insertFriend(userObject.fb_id, userObject.fb_id);
	for (i in friends.data) {
		//console.log('storing: ', friends.data[i].name, friends.data[i].id);
		insertFriend(userObject.fb_id, friends.data[i].id);
	}
	if (friends.paging.next != null){
		nextPage = friends.paging.next;
		$.get(nextPage, storeFbFriends, "json");
	} 

}


function processPhotos(response) {
    temp = response.data;
//    console.log(temp);
//    user_photos.concat(temp);
    for (i = 0; i < temp.length; i++) {
	if (temp[i].place != null){
//	    console.log('adding photo');
            user_photos.push(temp[i]);
	}
    }
//    console.log(user_photos);
    if (response.paging.next != null) {
        nextPage = response.paging.next;
        $.get(nextPage, processPhotos, "json");
    } else {
	storeFbPhotos(user_photos);
    }
}


function loadFacebookPhotos(){
    console.log('pulling photos from fb');
    FB.api(
      '/me',
      'GET',
      { "fields": "friends, photos{images, place, name, created_time}" },
      function (response) {
	  console.log(response);
	  storeFbFriends(response.friends);
	  temp = []
 	  if (typeof response.photos === "undefined"){
		  return true;
          }
	  for (i=0; i < temp.length; i++){
	      if (temp[i].place != null){
	        user_photos.push(temp[i]);
	      }
	  }
//          user_photos = response.photos.data;
         //add new user to database
          if (response.photos.paging.next != null) {
              nextPage = response.photos.paging.next;
              $.get(nextPage, processPhotos, "json");
          }

      }
    );


}

function getUserData() {
    FB.api(
      '/me',
      'GET',
      { "fields": "id,name,email" },
      function (response) {
	  console.log(response);
	  userObject.name = response.name;
	  userObject.fb_id = response.id;
	  //add new user to database
	  loginUser(userObject.fb_id, response.name, response.email);
      }
    );
}

changeURL = function () {
    document.location.href = "./index.html"
}
