<?php

// set variables




?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link rel="stylesheet" type="text/css" href="fb.css" />
<script type="text/javascript" src="http://www.climatepedia.org/scripts/jquery-1.5.min.js"></script>
</head>
<body>

<!-- BEGIN INITIAL FACEBOOK SCRIPT -->
<div id="fb-root"></div>
<button id="fb-auth">Login</button>
<button id="fb-lout">Logout</button>
<button id="fb-info">Info</button>
<button id="fb-post">Post</button>
<button id="fb-send">Send</button>
<button id="fb-feed">Feed</button>
<button id="fb-friends">Friends</button>
<button id="fb-request">Request</button>
<br>
<br>
<div id="result_uid"></div>
<br>
<div id="result_firstname"></div>
<br>
<div id="result_lastname"></div>
<br>
<div id="result_gender"></div>
<br>
<div id="result_birthday"></div>
<br>
<div id="result_friends"></div>

<script>
// This calls all of Facebook's stuff
// This is the asynchronous version so that the page doesn't get held up on loading it.
// The fb-root div is required
// All of the FB script needs to be within this window.fbAsyncInit function so that the FB object is defined
// The main fb objects are FB.init, which defines FB for FB.login, FB.logout, FB.ui and FB.api
// FB.api is used for anything that accesses FB's social graph
// Special note 1: Chrome and other webkit browsers will throw tons of "unsafe" errors due to cross-domain scripting issues... but they don't interfere with anything user-side.
// Special note 2: need to check if accessToken is still valid (expires after 2 hours) https://developers.facebook.com/blog/post/500. This doesn't really matter for our purposes though,
// as requesting stream permissions is exempt from this and everything else is a one-time action so we don't need to worry about time expirations.
// Special note 3: Browsers will block the FB windows if they aren't directly initiated by a user click
  window.fbAsyncInit = function() {
    FB.init({
      appId  : '208617862534233', // this is the appid you get after registering your domain in FB developer
      status : true, // check login status
      cookie : true, // enable cookies to allow the server to access the session
      xfbml  : true,  // parse XFBML
	// channelURL : 'http://WWW.MYDOMAIN.COM/channel.html', // channel.html file used by FB for keeping server log counts accurate, enable it if that is a requirement.
      oauth : true //enables OAuth 2.0
    });
    
    
//
// BEGIN OPTIONAL SCRIPTS
//

	// definining objects for later onclick assignments
   var authbutton = document.getElementById('fb-auth');
   var infobutton = document.getElementById('fb-info');
   var loutbutton = document.getElementById('fb-lout');
   var postbutton = document.getElementById('fb-post');
   var sendbutton = document.getElementById('fb-send');
   var feedbutton = document.getElementById('fb-feed');
   var friendsbutton = document.getElementById('fb-friends'); 
   var submitfriends = document.getElementById('fb-request'); 
  	var resultuid = document.getElementById('result_uid');
   var resultfirstname = document.getElementById('result_firstname');
   var resultlastname = document.getElementById('result_lastname');
   var resultpicture = document.getElementById('result_picture');
  	var resultgender = document.getElementById('result_gender');
  	var resultbirthday = document.getElementById('result_birthday');
  	var resultfriends = document.getElementById('result_friends');

  
  
  
  
   // LOGIN/AUTHENTICATION SCRIPT
   // This is the script that triggers a login, I bound it to an onclick event of the login button above
   // The very last option, ", {scope: xxx}" defines any extended permissions beyond basic info
   // I inserted the wall-posting (stream) permission, you can remove it to ask for only basic info
   // The list of permissions is here: https://developers.facebook.com/docs/reference/api/permissions/
   // Basic info includes name, profile picture, gender, networks, list of friends, and any public information
   // You may also want: user_about_me, user_activities, user_birthday, user_education_history, user_hometown, and/or user_interests
   // The additional info above may or may not be public and available without any extended permissions depending on their security settings
   // List of all options: https://developers.facebook.com/docs/reference/api/user/
	authbutton.onclick = function() {
   	FB.login(function(response) {
   		if (response.authResponse) {
    		 console.log('Welcome!  Fetching your information.... ');
    		 // this is the access token that is used to later gather user info, post to walls, etc.
	 	 	 var accessToken = response.authResponse.accessToken;
    	 	 FB.api('/me', function(response) {
    	   	console.log('Good to see you, ' + response.name + '.');
    	 	 });
   	   } else {
     		  console.log('User cancelled login or did not fully authorize.');
   		}
 		}, {scope: 'publish_stream, user_birthday'});  
   }
    
    
    	
    	
   // LOG OUT SCRIPT
   // This is the basic button for logging somebody out. 
   // This can be called as a response to any other function if you want to auto-logout somebody after doing something
   loutbutton.onclick = function() {
				FB.logout(function(response) {
     	    		console.log('Logged out.');
      	   }); 	
   	}
    
    
    
    
    
    // GATHER INFO SCRIPT
    // This is the script that will gather a user's basic info and dump it onto the page for you.
   // You may also want: user_about_me, user_activities, user_birthday, user_education_history, user_hometown, and/or user_interests
   // The additional info above may or may not be public and available without any extended permissions depending on their security settings
   // List of all options: https://developers.facebook.com/docs/reference/api/user/
   
    infobutton.onclick = function () {
    	FB.getLoginStatus(function(response) {
  			if (response.status === 'connected') {
    		// Everything is good
    		// response.authResponse supplies user's ID, a valid access token,
    		// a signed request, and the time the access token and signed request each expire
    		var uid = response.authResponse.userID;
    		var accessToken = response.authResponse.accessToken;
    	 	 FB.api('/me', function(response) {
    	   	resultuid.innerHTML = uid;
    	   	resultfirstname.innerHTML = response.first_name;
     	   	resultlastname.innerHTML = response.last_name;   	   	
     	   	resultgender.innerHTML = response.gender;  	
     	   	resultbirthday.innerHTML = response.birthday;
				});
    	 	 }

    		
    		else if (response.status === 'not_authorized') {
    		// user is connected to FB but our app isn't authorized
    			FB.login(function(response) {
   				if (response.authResponse) {
    					console.log('Welcome!  Fetching your information.... ');
    		 			// this is the access token that is used to later gather user info, post to walls, etc.
    					var uid = response.authResponse.userID;
	 	 	 			var accessToken = response.authResponse.accessToken;
    	 	 		   FB.api('/me', function(response) {
    	   			resultuid.innerHTML = uid;
    	   			resultfirstname.innerHTML = response.first_name;
     	   			resultlastname.innerHTML = response.last_name;   	   	
     	   			resultgender.innerHTML = response.gender;  	
     	   			resultbirthday.innerHTML = response.birthday;
						});
    	   		}	
   	   	 	else {
     		  			console.log('User cancelled login or did not fully authorize.');
   				}
 				}, {scope: 'publish_stream, user_birthday'});  
    		
    		
    		
    		
    		
    		
    		}
    		
    		else {
			// user isn't connect to FB at all    			
    			FB.login(function(response) {
   				if (response.authResponse) {
    					console.log('Welcome!  Fetching your information.... ');
    		 			// this is the access token that is used to later gather user info, post to walls, etc.
    		 			var uid = response.authResponse.userID;
	 	 	 			var accessToken = response.authResponse.accessToken;
    	 	 			FB.api('/me', function(response) {
    	   			resultuid.innerHTML = uid;
    	   			resultfirstname.innerHTML = response.first_name;
     	   			resultlastname.innerHTML = response.last_name;   	   	
     	   			resultgender.innerHTML = response.gender;  	
     	   			resultbirthday.innerHTML = response.birthday;
						});
    	   		}	
   	   	 	else {
     		  			console.log('User cancelled login or did not fully authorize.');
   				}
 				}, {scope: 'publish_stream, user_birthday'});  
    			
    			
    			
    			
    			
    			
    			
    			
    		}
    	
    	});
    }
    
    
    
   // POST TO THEIR STREAM SCRIPT
   // This is done using the Graph API so it requires the extended publish_stream permission, and can be done at any time without user interaction
   // The full list of available stuff to put into the message is here: https://developers.facebook.com/docs/reference/api/post/
   // One of the options is to:, which I think we could specific the recipients through after checking their friends list. There's no really good reason to do this though
   // (that isn't a little seedy at least), as we'd only want to do this if we were sending messages while they were offline and not as a result of their interaction.
   // The only real reason to use this script is to post stuff to their or other people's walls without their interaction.
   postbutton.onclick = function() {
   	 if (response.status === 'connected') {
    		// Everything is good
    		// response.authResponse supplies user's ID, a valid access token,
    		// a signed request, and the time the access token and signed request each expire
    		var uid = response.authResponse.userID;
    		var accessToken = response.authResponse.accessToken;
				// this is the actual script/api interface for posting. We don't need user initiation to do this.
				FB.api('/me/feed', 'post', { 
					message: 'Testing the Facebook API!',
					picture: 'http://www.climatepedia.org/css/images/einstein.png',
					name: 'Testing name',
					caption: 'Testing caption',
					description: 'Testing description',
				}, function(response) {
  					if (!response || response.error) {
  						// Oops! something went wrong. They probably weren't authenticated properly
						alert('error');
						// Unfortunately we can't initiate FB.login because this doesn't count as user-initated, so it will be blocked as a popup
						// The only way around I can think of is to display an error on the user's screen and ask them to click the log in/authorize button first.
						// This is a real issue when we've asked for basic permissions first but not extended permissions, as the authorized check returns
						// true but we don't have sufficient permissions. We may want to ask for all permissions at once to avoid this.
	
  					} else {
  						// You would return some type of confirmation here
    					alert('Post ID: ' + response.id);
  					}
				});
			}
		   else if (response.status === 'not_authorized') {
    		// user is connected to FB but our app isn't authorized
    			FB.login(function(response) {
   				if (response.authResponse) {
    					console.log('Welcome!  Fetching your information.... ');
    		 			// this is the access token that is used to later gather user info, post to walls, etc.
	 	 	 			var accessToken = response.authResponse.accessToken;
    	 	 				FB.api('/me/feed', 'post', { 
							message: 'Testing the Facebook API!',
							picture: 'http://www.climatepedia.org/css/images/einstein.png',
							name: 'Testing name',
							caption: 'Testing caption',
							description: 'Testing description',
						}, function(response) {
  						if (!response || response.error) {
  							// Oops! something went wrong. They probably weren't authenticated properly
    						alert('Error occured');
  						} else {
  							// You would return some type of confirmation here
    						alert('Post ID: ' + response.id);
  						}
				});
    	   		}	
   	   	 	else {
     		  			console.log('User cancelled login or did not fully authorize.');
   				}
 				}, {scope: 'publish_stream'});  
    		}
    		
    		else {
			// user isn't connect to FB at all    			
    			FB.login(function(response) {
   				if (response.authResponse) {
    					console.log('Welcome!  Fetching your information.... ');
    		 			// this is the access token that is used to later gather user info, post to walls, etc.
	 	 	 			var accessToken = response.authResponse.accessToken;
    	 	 				FB.api('/me/feed', 'post', { 
							message: 'Testing the Facebook API!',
							picture: 'http://www.climatepedia.org/css/images/einstein.png',
							name: 'Testing name',
							caption: 'Testing caption',
							description: 'Testing description',
						}, function(response) {
  						if (!response || response.error) {
  							// Oops! something went wrong. They probably weren't authenticated properly
    						alert('Error occured');
  						} else {
  							// You would return some type of confirmation here
    						alert('Post ID: ' + response.id);
  						}
				});
    	   		}	
   	   	 	else {
     		  			console.log('User cancelled login or did not fully authorize.');
   				}
 				}, {scope: 'publish_stream'});  

    		}
   
   
   }
    
    
   
	// SEND DIALOG - SEND PRIVATE EMAIL WITH LINK
	// This is cool because it DOES NOT require extended permissions, as it's initiated by the user
	// This will pop up in an iframe.
	// f the user isn't logged in they'll first be prompted to log in, and no permissions are requested
	// Any of the options fed to the code below are optional besides the method, just remove them if you don't want them.
	sendbutton.onclick = function() {
		FB.ui({
          method: 'send',
          name: 'Test article title',
          link: 'http://www.nytimes.com/2011/06/15/arts/people-argue-just-to-win-scholars-assert.html',
          picture: 'http://www.climatepedia.org/css/images/einstein.png',
          caption: 'Test caption',
          description: 'This is a test description, you could enter the article summary here.'
      });
	}
	

	// FEED DIALOG - POST TO WALL TO THEIR OWN WALL
	// This is also cool because it DOES NOT require extended permissions, as it's initiated by the user
	// This will pop up in an iframe
	// If the user isn't logged in they'll first be prompted to log in, and no permissions are requested
	// Any of the options fed to the code below are optional besides the method, just remove them if you don't want them.
	feedbutton.onclick = function() {
		FB.ui({
          method: 'feed',
          name: 'Test article title',
          link: 'http://www.nytimes.com/2011/06/15/arts/people-argue-just-to-win-scholars-assert.html',
          picture: 'http://www.climatepedia.org/css/images/einstein.png',
          caption: 'Test caption',
          description: 'This is a test description, you could enter the article summary here.'
      });
	}




    // SHOW FRIENDS SCRIPT
    // Show friends script
    friendsbutton.onclick = function () {
    	FB.getLoginStatus(function(response) {
  			if (response.status === 'connected') {
    		// Everything is good
    		// response.authResponse supplies user's ID, a valid access token,
    		// a signed request, and the time the access token and signed request each expire
    		var uid = response.authResponse.userID;
    		var accessToken = response.authResponse.accessToken;
						
						function onFriendsListLoaded(response)
							{
								var divTarget=document.getElementById("result_friends");
								var data=response.data;
								var friendStorage = [];
								// alert("divTarget="+divTarget+"\ndata="+data);
								for (var friendIndex=0; friendIndex<data.length; friendIndex++)
									{
									var divContainer = document.createElement("div");
									
									friendStorage[friendIndex] = "<hr><img src='http://graph.facebook.com/"+data[friendIndex].id+"/picture'></img>"+
									"<br>"+data[friendIndex].name + "<br><input type=checkbox class=friendselector id=select" + friendIndex + " name=selectfriends value=" + data[friendIndex].id + ">";
									
									alert(friendStorage[friendIndex]);
									
									
									
									
								//	divContainer.innerHTML="<hr><img src='http://graph.facebook.com/"+data[friendIndex].id+"/picture'></img>"+
								//	"<br>"+data[friendIndex].name + "<br><input type=checkbox class=friendselector id=select" + friendIndex + " name=selectfriends value=" + data[friendIndex].id + ">";
								//	divTarget.appendChild(divContainer);
									}
									
									
							}
	
						function showFriendsList()
						{
						FB.api('/me/friends', onFriendsListLoaded);  
						}
						
						showFriendsList();
    	 	 }

    		
    		else if (response.status === 'not_authorized') {
    		// user is connected to FB but our app isn't authorized
    			FB.login(function(response) {
   				if (response.authResponse) {
    					console.log('Welcome!  Fetching your information.... ');
    		 			// this is the access token that is used to later gather user info, post to walls, etc.
    					var uid = response.authResponse.userID;
	 	 	 			var accessToken = response.authResponse.accessToken;
						function onFriendsListLoaded(response)
							{
								var divTarget=document.getElementById("result_friends");
								var data=response.data;
								// alert("divTarget="+divTarget+"\ndata="+data);
								for (var friendIndex=0; friendIndex<data.length; friendIndex++)
									{
									var divContainer = document.createElement("div");
									divContainer.innerHTML="<hr><img src='http://graph.facebook.com/"+data[friendIndex].id+"/picture'></img>"+
									"<br>"+data[friendIndex].name + "<br><input type=checkbox class=friendselector id=select" + friendIndex + " name=selectfriends value=" + data[friendIndex].id + ">";
									divTarget.appendChild(divContainer);
									}
							}
	
						function showFriendsList()
						{
						FB.api('/me/friends', onFriendsListLoaded);  
						}
						
						showFriendsList();
	
						function showFriendsList()
						{
						FB.api('/me/friends', onFriendsListLoaded);  
						}
    	   		}	
   	   	 	else {
     		  			console.log('User cancelled login or did not fully authorize.');
   				}
 				}, {scope: 'publish_stream, user_birthday'});  
    		}
    		
    		else {
			// user isn't connect to FB at all    			
    			FB.login(function(response) {
   				if (response.authResponse) {
    					console.log('Welcome!  Fetching your information.... ');
    		 			// this is the access token that is used to later gather user info, post to walls, etc.
    		 			var uid = response.authResponse.userID;
	 	 	 			var accessToken = response.authResponse.accessToken;
    	 	 			
    	 	 			function onFriendsListLoaded(response)
							{
								var divTarget=document.getElementById("result_friends");
								var data=response.data;
								// alert("divTarget="+divTarget+"\ndata="+data);
								for (var friendIndex=0; friendIndex<data.length; friendIndex++)
									{
									var divContainer = document.createElement("div");
									divContainer.innerHTML="<hr><img src='http://graph.facebook.com/"+data[friendIndex].id+"/picture'></img>"+
									"<br>"+data[friendIndex].name + "<br><input type=checkbox class=friendselector id=select" + friendIndex + " name=selectfriends value=" + data[friendIndex].id + ">";
									divTarget.appendChild(divContainer);
									}
							}
	
						function showFriendsList()
						{
						FB.api('/me/friends', onFriendsListLoaded);  
						}
						
						showFriendsList();

						}
						
    	   			
   	   	 	else {
     		  			console.log('User cancelled login or did not fully authorize.');
   				}
 				}, {scope: 'publish_stream, user_birthday'});  
    			

    		}
    	
    	});
    }
    
    // SUBMITTING FRIEND REQUESTS
    // This includes some JQUERY script for the loop because I had to actually code and that's what I'm most comfortable with.
    submitfriends.onclick = function () {
    	
    	var request_counter = 0;
    	$(".friendselector:checked").each(function(){
    	var requesting_friend = $(this).val();
    
   	 if (response.status === 'connected') {
    		// Everything is good
    		// response.authResponse supplies user's ID, a valid access token,
    		// a signed request, and the time the access token and signed request each expire
    		var uid = response.authResponse.userID;
    		var accessToken = response.authResponse.accessToken;
				// this is the actual script/api interface for posting. We don't need user initiation to do this.
				FB.api('/' + requesting_friend + '/feed', 'post', { 
					message: 'Testing the Facebook API!',
					picture: 'http://www.climatepedia.org/css/images/einstein.png',
					name: 'Testing name',
					caption: 'Testing caption',
					description: 'Testing description',
				}, function(response) {
  					if (!response || response.error) {
  						// Oops! something went wrong. They probably weren't authenticated properly
						alert('error');
						// Unfortunately we can't initiate FB.login because this doesn't count as user-initated, so it will be blocked as a popup
						// The only way around I can think of is to display an error on the user's screen and ask them to click the log in/authorize button first.
						// This is a real issue when we've asked for basic permissions first but not extended permissions, as the authorized check returns
						// true but we don't have sufficient permissions. We may want to ask for all permissions at once to avoid this.
	
  					} else {
  						// You would return some type of confirmation here
    					alert('Post ID: ' + response.id);
  					}
				});
			}
		   else if (response.status === 'not_authorized') {
    		// user is connected to FB but our app isn't authorized
    			FB.login(function(response) {
   				if (response.authResponse) {
    					console.log('Welcome!  Fetching your information.... ');
    		 			// this is the access token that is used to later gather user info, post to walls, etc.
	 	 	 			var accessToken = response.authResponse.accessToken;
    	 	 				FB.api('/' + requesting_friend + '/feed', 'post', { 
								message: 'Testing the Facebook API!',
								picture: 'http://www.climatepedia.org/css/images/einstein.png',
								name: 'Testing name',
								caption: 'Testing caption',
								description: 'Testing description',
								}, function(response) {
  									if (!response || response.error) {
  										// Oops! something went wrong. They probably weren't authenticated properly
										alert('error');
										// Unfortunately we can't initiate FB.login because this doesn't count as user-initated, so it will be blocked as a popup
										// The only way around I can think of is to display an error on the user's screen and ask them to click the log in/authorize button first.
										// This is a real issue when we've asked for basic permissions first but not extended permissions, as the authorized check returns
										// true but we don't have sufficient permissions. We may want to ask for all permissions at once to avoid this.
	
  								} else {
  								// You would return some type of confirmation here
    								alert('Post ID: ' + response.id);
  								}
							});
    	   		}	
   	   	 	else {
     		  			console.log('User cancelled login or did not fully authorize.');
   				}
 				}, {scope: 'publish_stream'});  
    		}
    		
    		else {
			// user isn't connect to FB at all    			
    			FB.login(function(response) {
   				if (response.authResponse) {
    					console.log('Welcome!  Fetching your information.... ');
    		 			// this is the access token that is used to later gather user info, post to walls, etc.
	 	 	 			var accessToken = response.authResponse.accessToken;
						FB.api('/' + requesting_friend + '/feed', 'post', { 
							message: 'Testing the Facebook API!',
							picture: 'http://www.climatepedia.org/css/images/einstein.png',
							name: 'Testing name',
							caption: 'Testing caption',
							description: 'Testing description',
							}, function(response) {
  								if (!response || response.error) {
  								// Oops! something went wrong. They probably weren't authenticated properly
								alert('error');
								// Unfortunately we can't initiate FB.login because this doesn't count as user-initated, so it will be blocked as a popup
								// The only way around I can think of is to display an error on the user's screen and ask them to click the log in/authorize button first.
								// This is a real issue when we've asked for basic permissions first but not extended permissions, as the authorized check returns
								// true but we don't have sufficient permissions. We may want to ask for all permissions at once to avoid this.
	
  								} else {
  									// You would return some type of confirmation here
    								alert('Post ID: ' + response.id);
  								}
							});
    	   		}	
   	   	 	else {
     		  			console.log('User cancelled login or did not fully authorize.');
   				}
 				}, {scope: 'publish_stream'});  

    		}
   
   
   });
   
  }
    	
    	
    	
    	
    	
    	
    	
    	
    	


































//
// END OPTIONAL SCRIPTS
//


  }; // This closes the asynchronous FB.init function, no FB actions should go outside of this or else FB.xxx won't be defined.

// This is the end of the basic FB script and is required
  (function() {
    var e = document.createElement('script');
    e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
    e.async = true;
    document.getElementById('fb-root').appendChild(e);
  }());
</script>


<!-- END FB SCRIPT -->











</body>
</html>