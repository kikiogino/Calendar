let token = null;
let loggedIn;

function loginAjax(event) {
    const username = document.getElementById("username").value; // Get the username from the form
    const password = document.getElementById("password").value; // Get the password from the form

    // Make a URL-encoded string for passing POST data:
    const data = { 'username': username, 'password': password };

    fetch("login.php", {
            method: 'POST',
            body: JSON.stringify(data),
            headers: { 'content-type': 'application/json' }
        })
        .then(function (response){return response.json()})
        .then(function loggedIn(event){
            const jsonData = JSON.parse(JSON.stringify(event));
	        if(jsonData.success==true){
                
                loadEvent();
                loadSharedEvent();
                loadSharedCalendar();
                document.getElementById("welcome").innerText = "Welcome, "+ jsonData.username;
                document.getElementById("username").value = "";
                document.getElementById("password").value = "";
                token = jsonData.token;
                loggedIn = 1;
                check_for_user();
                
            }
            else{
                document.getElementById("username").value = "";
                document.getElementById("password").value = "";
                // document.getElementById("logout_btn").style.visibility = "none";
                document.getElementById("message").innerText = "Login failed. Check spelling, log out of current account, or please create an account."
            }
        })

    }
 
document.getElementById("login_btn").addEventListener("click", loginAjax, false); // Bind the AJAX call to button click

