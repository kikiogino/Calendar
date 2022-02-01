function viewEvent(id) {

    console.log(id);

        const info = document.getElementById(id);

        const event_id = id;
        document.getElementById("view_title").innerText = info.getAttribute("title");
        const title = document.getElementById("view_title").innerText; 
    
        document.getElementById("view_date").innerText = info.getAttribute("date");
        const date = document.getElementById("view_date").innerText;
    
        document.getElementById("view_time").innerText = info.getAttribute("time");
        const time = document.getElementById("view_time").innerText;
    
        document.getElementById("view_location").innerText = info.getAttribute("location");
        const location = document.getElementById("view_location").innerText;
    
        document.getElementById("view_description").innerText = info.getAttribute("description");
        const description = document.getElementById("view_description").innerText; 
    
        document.getElementById("edit_btn").setAttribute("event_id", id);
        document.getElementById("share_btn").setAttribute("event_id", id);
        document.getElementById("delete_event_btn").setAttribute("event_id", id);
        // Make a URL-encoded string for passing POST data:
        

        const data = { 'title': title, 'date': date, 'time': time, 'location': location, 'description': description, 'event_id': event_id};

    } 

    function viewSharedEvent(id) {

  
            const info = document.getElementById(id);
    
            const event_id = id;
            document.getElementById("view_title").innerText = info.getAttribute("title");
            const title = document.getElementById("view_title").innerText; 
        
            document.getElementById("view_date").innerText = info.getAttribute("date");
            const date = document.getElementById("view_date").innerText;
        
            document.getElementById("view_time").innerText = info.getAttribute("time");
            const time = document.getElementById("view_time").innerText;
        
            document.getElementById("view_location").innerText = info.getAttribute("location");
            const location = document.getElementById("view_location").innerText;
        
            document.getElementById("view_description").innerText = info.getAttribute("description");
            const description = document.getElementById("view_description").innerText; 
        
            document.getElementById("edit_btn").style.display = "none";
            document.getElementById("share_btn").style.display = "none";
            document.getElementById("delete_event_btn").style.display = "none";
            // Make a URL-encoded string for passing POST data:
            
    
            const data = { 'title': title, 'date': date, 'time': time, 'location': location, 'description': description, 'event_id': event_id};
    
        } 
    
function populateInputs(){
        document.getElementById("edit_title").value = document.getElementById("view_title").innerText;

    document.getElementById("edit_date").value = document.getElementById("view_date").innerText;
    
    document.getElementById("edit_time").value = document.getElementById("view_time").innerText;
    
    document.getElementById("edit_location").value = document.getElementById("view_location").innerText;
    
    document.getElementById("edit_description").value = document.getElementById("view_description").innerText;
    
    
}
document.getElementById("edit_btn").addEventListener("click", populateInputs, false); // Bind the AJAX call to button click
