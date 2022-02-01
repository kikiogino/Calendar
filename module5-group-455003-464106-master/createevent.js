
function createEvent() {
    
    const title = document.getElementById("add_title").value; 
    const date = document.getElementById("add_date").value;
    const time = document.getElementById("add_time").value;
    const location = document.getElementById("add_location").value;
    const description = document.getElementById("add_description").value; 
    // Make a URL-encoded string for passing POST data:
    const data = {'title': title, 'date': date, 'time': time, 'location': location, 'description': description};
    fetch("create_event.php", {
            method: 'POST',
            body: JSON.stringify(data),
            headers: { 'content-type': 'application/json' }
        })
        .then(res => res.text())
        .then(text => console.log(text)).catch(error => console.error('Error:',error))
        // .then(res => res.json())
        // .then(response => console.log('Success:', JSON.stringify(response)))
        // .catch(error => console.error('Error:',error))
        // .then(function(response) {
        //     return response;
        // })
    //      .then(response => response.json())
    //     .then(function create(event){
            
    //         const jsonData = JSON.parse(JSON.stringify(event));
	//         if(jsonData.success==true){
    //             console.log("success");
    //         }
    //         else{
    //             alert("Failed. Try loggin in");
    //             console.log(jsonData.success);
    //         }
    // })
        
    }
 
document.getElementById("add_event_btn").addEventListener("click", createEvent, false); // Bind the AJAX call to button click