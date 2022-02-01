let shared_with;
function shareCalendar() {


    const share_username = document.getElementById("share_calendar_username").value; 

    const data = {'share_username': share_username};
    fetch("share_calendar.php", {
            method: 'POST',
            body: JSON.stringify(data),
            headers: { 'content-type': 'application/json' }
        })
        .then(function(response) {
            return response;
        })
         .then(response => response.json())
        .then(function share(event){
            const jsonData = JSON.parse(JSON.stringify(event));
            console.log(jsonData);
	        if(jsonData.success==true){
                alert("Share Success");
                shared_with = jsonData.shared_with;
            }
            else{
                alert("Share Failed");
            }
        })
        
    }
 
document.getElementById("submit_share_calendar_btn").addEventListener("click", shareCalendar, false); // Bind the AJAX call to button click