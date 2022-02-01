function editEvents() {

    
    const title = document.getElementById("edit_title").value; 

    
    const date = document.getElementById("edit_date").value;

    
    const time = document.getElementById("edit_time").value;

    
    const location = document.getElementById("edit_location").value;

   
    const description = document.getElementById("edit_description").value; 

    // Make a URL-encoded string for passing POST data:
    const event_id = document.getElementById("edit_btn").getAttribute("event_id");
    const data = {'event_id': event_id,'title': title, 'date': date, 'time': time, 'location': location, 'description': description};

    fetch("edit_event.php", {
            method: 'POST',
            body: JSON.stringify(data),
            headers: { 'content-type': 'application/json' }
        })
        .then(function(response) {
            return response;
            
        })
        .then(function load(event){
            const jsonData = JSON.parse(JSON.stringify(event));
	        if(jsonData.success==true){
                updateCalendar();
                loadEvent();
                loadSharedCalendar();
                loadSharedEvent();
            }
            else{
                 console.log("failed.  "+jsonData.message);
            }
        
    })
} 
 document.getElementById("change_event_btn").addEventListener("click", editEvents, false); // Bind the AJAX call to button click