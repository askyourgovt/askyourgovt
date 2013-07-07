navigator.id.watch({
  loggedInUser: 'bob@example.org',
  onlogin: function(assertion) {
    // A user has logged in! Here you need to:
    // 1. Send the assertion to your backend for verification and to create a session.
    // 2. Update your UI.
  },
  onlogout: function() {
    // A user has logged out! Here you need to:
    // Tear down the user's session by redirecting the user or making a call to your backend.
  }
});

var signinLink = document.getElementById('signin');
if (signinLink) {
  signinLink.onclick = function() { navigator.id.request(); };
}