
document.addEventListener("DOMContentLoaded", check_for_user, false);

function check_for_user(){
fetch("loggedIn.php", {
    method: 'POST',
    body: JSON.stringify(),
    headers: { 'content-type': 'application/json' }
})
.then(res => res.json())
.then(function show(event){
    const jsonData = JSON.parse(JSON.stringify(event));
    if(jsonData.success==true){
        document.getElementById("loginuser").style.display = "none";
                document.getElementById("signup").style.display = "none";
                document.getElementById("hi").style.display = "inline";
                document.getElementById("share_calendar").style.display = "inline";
                document.getElementById("logout_btn").style.display = "inline";
                document.getElementById("welcome").innerText = "Welcome," + jsonData.username;
                $("#message").hide();
                $("#keys_btn").show();
            }
    else{
        document.getElementById("loginuser").style.display = "inline";
                document.getElementById("signup").style.display = "inline";
                document.getElementById("hi").style.display = "none";
                $("#share_calendar").hide();
                $("#logout_btn").hide();
                $("#message").show();
                $("#keys_btn").hide();
    }

})
}
