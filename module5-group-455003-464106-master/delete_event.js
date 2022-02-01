function deleteEvent() {
    const event_id = document.getElementById("delete_event_btn").getAttribute("event_id");

    const delete_data = { 'event_id': event_id};

    fetch("delete_event.php", {
            method: 'POST',
            body: JSON.stringify(delete_data),
            headers: { 'content-type': 'application/json' }
        })
        .then(response => response.json())
        .then(function deletes(event){
            const jsonData = JSON.parse(JSON.stringify(event));

	        if(jsonData.success==true){
                remove_month();
                updateCalendar();
               loadSharedEvent();
               loadEvent();
               loadSharedCalendar();
            }
            else{
                 console.log("failed.  "+jsonData.message);
            }
    })
} 
  document.getElementById("delete_event_btn").addEventListener("click", deleteEvent, false); // Bind the AJAX call to button click