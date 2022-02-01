function loadEvent() {
    
    const title = document.getElementById("add_title").value; 
    const date = document.getElementById("add_date").value;
    const time = document.getElementById("add_time").value;
    const location = document.getElementById("add_location").value;
    const description = document.getElementById("add_description").value; 

    // Make a URL-encoded string for passing POST data:
    const load_data = {'title': title, 'date': date, 'time': time, 'location': location, 'description': description,};

    fetch("load_event.php", {
            method: 'POST',
            body: JSON.stringify(load_data),
            headers: { 'content-type': 'application/json' }
        })
        .then(function(response) {
            return response;
        })
        .then(response => response.json())
        .then(function load(event){
            const jsonData = JSON.parse(JSON.stringify(event));
	        if(jsonData.success==true){
                const events = jsonData.events;
                if (events.length !== 0) {
                    //https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/forEach
                 
                    events.forEach(function(response){
                    
                    const event_id = response.event_id;
                    const title = response.title;
                    const time = response.time;
                    const date = response.date;
                    const location = response.location;
                    const description = response.description;


                    let new_modal = document.getElementById(date);

                    let add_events_modal = document.createElement("button");
                    add_events_modal.setAttribute("data-target", "#editEventModal");
                    add_events_modal.setAttribute("data-toggle", "modal");
                    add_events_modal.setAttribute("type", "button");
                    add_events_modal.setAttribute("class", "btn btn-primary");

                    add_events_modal.setAttribute("id", event_id);
                    add_events_modal.setAttribute("onClick", "viewEvent(this.id);");
                    // add_events_modal.setAttribute("event_id", event_id);
                    add_events_modal.setAttribute("title", title);
                    add_events_modal.setAttribute("time", time);
                    add_events_modal.setAttribute("date", date);
                    add_events_modal.setAttribute("location", location);
                    add_events_modal.setAttribute("description", description);

                    // add_events_modal.textContent = date;
                 
                    // let add_break = document.createElement("br");
                    // new_modal.appendChild(add_break);
                    
                    let modal = title;
                    if (document.getElementById(date)){
                        new_modal.appendChild(document.createElement("div"));
                        new_modal.appendChild(add_events_modal);
                        add_events_modal.innerText += modal;
                
                      }

                    


                  }
                  
                  )}
                  
                
        }
            
            else{
                
            }
        })

    }
    document.addEventListener("DOMContentLoaded", loadEvent, false);

    function loadSharedEvent() {
    
       const data = {};
        fetch("load_shared.php", {
                method: 'POST',
                body: JSON.stringify(data),
                headers: { 'content-type': 'application/json' }
            })
            .then(function(response) {
                return response;
            })
            .then(res => res.json())          // convert to plain text
            .then(function load(event){
                const jsonData = JSON.parse(JSON.stringify(event));
                if(jsonData.success == true){
                    const events = jsonData.events;

                    if (events.length !== 0) {
                        //https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/forEach
                      events.forEach(function(response){
                       
                        const event_id = response.event_id;
                        const title = response.title;
                        const time = response.time;
                        const date = response.date;
                        const location = response.location;
                        const description = response.description;
                        

                        let new_modal = document.getElementById(date);
                        let add_events_modal = document.createElement("button");
                        add_events_modal.setAttribute("data-target", "#editEventModal");
                        add_events_modal.setAttribute("data-toggle", "modal");
                        add_events_modal.setAttribute("type", "button");
                        add_events_modal.setAttribute("class", "btn btn-success");
    
                        add_events_modal.setAttribute("id", event_id);
                        add_events_modal.setAttribute("onClick", "viewSharedEvent(this.id);");
                        // add_events_modal.setAttribute("event_id", event_id);
                        add_events_modal.setAttribute("title", title);
                        add_events_modal.setAttribute("time", time);
                        add_events_modal.setAttribute("date", date);
                        add_events_modal.setAttribute("location", location);
                        add_events_modal.setAttribute("description", description);
    
                        // add_events_modal.textContent = date;
                     
                        // let add_break = document.createElement("br");
                        // new_modal.appendChild(add_break);
                        
                        let modal = title;
                        if (document.getElementById(date)){
                            new_modal.appendChild(document.createElement("div"));
                            new_modal.appendChild(add_events_modal);
                            add_events_modal.innerText += modal;
                          }
    
    
                      }
                      )}
                      
            
            }
                
                else{
                   
                }
            })
    
        }
        document.addEventListener("DOMContentLoaded", loadSharedEvent, false);
       
        function loadSharedCalendar() {
    
            const data = {};
             fetch("load_shared_calendar.php", {
                     method: 'POST',
                     body: JSON.stringify(data),
                     headers: { 'content-type': 'application/json' }
                 })
                 .then(function(response) {
                     return response;
                 })
                 .then(res => res.json())          // convert to plain text
                 .then(function load(event){
                     const jsonData = JSON.parse(JSON.stringify(event));
                     if(jsonData.success == true){
                         const events = jsonData.events;
                         if (events.length !== 0) {
                             //https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/forEach
                           events.forEach(function(response){
                            
                             const event_id = response.event_id;
                             const title = response.title;
                             const time = response.time;
                             const date = response.date;
                             const location = response.location;
                             const description = response.description;
                             

                             
                             let new_modal = document.getElementById(date);
                             let add_events_modal = document.createElement("button");
                             add_events_modal.setAttribute("data-target", "#editEventModal");
                             add_events_modal.setAttribute("data-toggle", "modal");
                             add_events_modal.setAttribute("type", "button");
                             add_events_modal.setAttribute("class", "btn btn-danger");
         
                             add_events_modal.setAttribute("id", event_id);
                             add_events_modal.setAttribute("onClick", "viewSharedEvent(this.id);");
                             // add_events_modal.setAttribute("event_id", event_id);
                             add_events_modal.setAttribute("title", title);
                             add_events_modal.setAttribute("time", time);
                             add_events_modal.setAttribute("date", date);
                             add_events_modal.setAttribute("location", location);
                             add_events_modal.setAttribute("description", description);
         
                             
                             // add_events_modal.textContent = date;
                          
                             // let add_break = document.createElement("br");
                             // new_modal.appendChild(add_break);
                             
                             let modal = title;
                             if (document.getElementById(date)){
                                 new_modal.appendChild(document.createElement("div"));
                                 new_modal.appendChild(add_events_modal);
                                 add_events_modal.innerText += modal;
                               }
         
         
                           }
                           )}
                           
                 
                 }
                     
                     else{
                        
                     }
                 })
         
             }
             document.addEventListener("DOMContentLoaded", loadSharedCalendar, false);
         
        
    
    
     
    

 
