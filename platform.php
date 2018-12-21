<h2>My Platform</h2>
<script>
window.fbAsyncInit = function() {
    FB.init({
      appId      : '274845703177593',      
      xfbml      : true,  // parse social plugins on this page
      version    : 'v2.8' // use graph api version 2.8
    });
  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  function subscribeApp(page_id, page_access_token) {
    FB.api(
      '/'+ page_id + '/subscribed_apps',
      'post',
      {access_token: page_access_token, subscribed_fields: 'leadgen'},
      (response) => {
      console.log('Successfully subscribed page ', response);      
    });
    
  }

  // Only works after 'FB.init' is called
  function myFacebookLogin() {
    FB.login(function(response) {
      console.log('Successfully logged in', response);    
      FB.api('/me/accounts/', function(response) {
        console.log('Successfully retrieved pages: ', response);
        const pages = response.data;
        const ul = document.getElementById('list');
        for(let i = 0; i < pages.length; i ++) {
          let page = pages[i];          
          let li = document.createElement('li');
          let a = document.createElement('a');
          a.href = "#";
          a.onclick = subscribeApp.bind(this, page.id, page.access_token);
          a.innerHTML = page.name;
          li.appendChild(a);
          ul.appendChild(li);
        }
      })
    }, {scope: 'manage_pages, publish_pages, leads_retrieval'});
  }

</script>

<button onclick="myFacebookLogin()">Login with Facebook</button>

<ul id="list"></ul>