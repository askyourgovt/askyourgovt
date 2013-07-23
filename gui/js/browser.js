

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

 
function checkUserNameAvailability(){
   $.ajax({
          type: 'GET',
          url: '/auth/checkUserNameAvailability', 
          data:{user_name:$('#user_name').val()}
        }).done(function ( data ) {
          if( console && console.log ) {
            console.log("Sample of data:", data);
          }

          if(data == "okay"){
              $('#check_user_name').hide();
              $('#check_user_name_msg_label').show();
              $('#submit_user_name').show();
              $('#user_name_hid').val($('#user_name').val());              
              $('#check_user_name_msg').text("Availabe. Go ahead and save.");
              $('#user_name').attr('disabled', 'disabled');
          }else{
              $('#check_user_name_msg_label').show();
              $('#check_user_name_msg').text("Not Available. Please try another user name.");
          }
      });
   return false;
}
