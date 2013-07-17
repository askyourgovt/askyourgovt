

navigator.id.watch({
  loggedInUser: currentUser,
  onlogin: function(assertion) {
    // A user has logged in! Here you need to:
    // 1. Send the assertion to your backend for verification and to create a session.
    // 2. Update your UI.

    $.ajax({ 
      type: 'POST',
      url: '/auth/login', 
      data: {assertion: assertion},
      success: function(res, status, xhr) { 
        window.location.reload(); 
      },
      error: function(xhr, status, err) {
        navigator.id.logout();
        alert("Login failure: " + err);
      }
    });



  },
  onlogout: function() {
     $.ajax({
          type: 'POST',
          url: '/auth/logout', 
          success: function(res, status, xhr) {  
            navigator.id.logout();     
            window.location.reload(); 
          },
          error: function(xhr, status, err) { alert("Logout failure: " + err); }
        });
  }

});

var signinLink = document.getElementById('signin');
if (signinLink) {
  signinLink.onclick = function() { navigator.id.request(); };
}

var signoutLink = document.getElementById('signout');
if (signoutLink) {
  signoutLink.onclick = function() { navigator.id.logout(); };
}

 
