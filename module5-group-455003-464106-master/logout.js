function logoutAjax(event) {

    fetch("logout.php", {
            method: 'POST',
            body: JSON.stringify(),
            headers: { 'content-type': 'application/json' }
        })
        .then(function (response){return response.json()})
        .then(function logout(event){
            const jsonData = JSON.parse(JSON.stringify(event));
	        if(jsonData.success==true){
                location.reload();
                document.getElementById("welcome").innerText = "";
                document.getElementById("username").value = "";
                document.getElementById("password").value = "";
                loggedIn = 0;
                // hideforms();
            }
            else{
                document.getElementById("message").innerText = "Logout failed."
            }
        })

    }
 
document.getElementById("logout_btn").addEventListener("click", logoutAjax, false); // Bind the AJAX call to button click