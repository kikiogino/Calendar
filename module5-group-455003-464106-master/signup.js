function signupAjax(event) {
    const firstname = document.getElementById("create_first_name").value;
    const lastname = document.getElementById("create_last_name").value;
    const username = document.getElementById("createusername").value; // Get the username from the form
    const password = document.getElementById("createpassword").value; // Get the password from the form

    // Make a URL-encoded string for passing POST data:
    const data = { 'firstname': firstname, 'lastname': lastname, 'username': username, 'password': password };

    fetch("signup.php", {
            method: 'POST',
            body: JSON.stringify(data),
            headers: { 'content-type': 'application/json' }
        })
        .then(function (response){return response.json()})
        .then(function loggedIn(event){
            const jsonData = JSON.parse(JSON.stringify(event));
	        if(jsonData.success==true){
                alert("Account successfully created. Please login.");
                document.getElementById("message").innerText = "Account successfully created. Please login.";
                document.getElementById("create_first_name").value = "";
                document.getElementById("create_last_name").value = "";
                document.getElementById("createusername").value = "";
                document.getElementById("createpassword").value = "";
            }
            else{
                document.getElementById("message").innerText = "Failure, try again. Username may exist."
            }
        })
}

document.getElementById("signup_btn").addEventListener("click", signupAjax, false); // Bind the AJAX call to button click