function shareEvent() {

    const title = document.getElementById("view_title").innerHTML;

    const date =  document.getElementById("view_date").innerHTML;
    
    const time = document.getElementById("view_time").innerHTML;
    
    const location =  document.getElementById("view_location").innerHTML;
    
    const description =  document.getElementById("view_description").innerHTML;

    const share_username = document.getElementById("share_username").value; 
    const event_id = document.getElementById("share_btn").getAttribute("event_id");
    const data = {'title':title, 'date':date, 'time':time, 'location': location,'description': description,'share_username': share_username, 'event_id': event_id};
    fetch("share_event.php", {
            method: 'POST',
            body: JSON.stringify(data),
            headers: { 'content-type': 'application/json' }
        })

         .then(response => response.json())
        .then(function share(event){
            const jsonData = JSON.parse(JSON.stringify(event));
	        if(jsonData.success==true){
                alert("Share Success");
            }
            else{
                alert("Share Failed");
            }
        })
        
    }
 
document.getElementById("submit_share_btn").addEventListener("click", shareEvent, false); // Bind the AJAX call to button click