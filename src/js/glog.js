gapi.load("auth2",function(){

})

function onSignIn(googleUser) {
  var profile = googleUser.getBasicProfile();
  console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
  console.log('Name: ' + profile.getName());
  console.log('Image URL: ' + profile.getImageUrl());
  console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.

  document.getElementById("signin").style.display = "none" ;
  document.getElementById("signout").style.display = "" ;
  document.getElementById("signout").innerHTML = "<span style='font-size: 13px; line-height: 34px;color: #757575;'' class='abcRioButtonContents'>Sign out</span><img src='" + profile.getImageUrl() + "'>"
}

function signOut() {
  console.log("signout");
  var auth2 = gapi.auth2.getAuthInstance();
  auth2.signOut().then(function () {
    console.log('User signed out.');
    document.getElementById("signin").style.display = "" ;
    document.getElementById("signout").style.display = "none" ;
  });
}
