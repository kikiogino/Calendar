
document.addEventListener("DOMContentLoaded", updateCalendar, false);



let today = new Date();
let year = today.getFullYear();
// console.log(year);
let month = today.getMonth();
// For our purposes, we can keep the current month in a variable in the global scope
let currentMonth = new Month(year, month); // October 2017


// Change the month when the "next" button is pressed
document.getElementById("next_month_btn").addEventListener("click", function(event){
// let old = document.getElementById("table_body");
// this.removeChild(old);
remove_month();
currentMonth = currentMonth.nextMonth(); // Previous month would be currentMonth.prevMonth()
updateCalendar();
loadEvent();
loadSharedEvent();
loadSharedCalendar();
}, false);

function remove_month() {
let node = document.getElementById('table_body');
while (node.hasChildNodes()){
node.removeChild(node.lastChild);
}

}
// Change the month when the "next" button is pressed
document.getElementById("previous_month_btn").addEventListener("click", function(event){
// let old = document.getElementById("table_body");
// this.removeChild(old);
remove_month();
currentMonth = currentMonth.prevMonth(); // Previous month would be currentMonth.prevMonth()
updateCalendar();
loadSharedEvent();
loadSharedCalendar();
loadEvent(); // Whenever the month is updated, we'll need to re-render the calendar in HTML
}, false);

function remove_month() {
let node = document.getElementById('table_body');
while (node.hasChildNodes()){
node.removeChild(node.lastChild);
}

}



// This updateCalendar() function only alerts the dates in the currently specified month.  You need to write
// it to modify the DOM (optionally using jQuery) to display the days and weeks in the current month.
function updateCalendar(){

let print_area = document.getElementById("print_here");
let print_month = currentMonth.month;
let mlist = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ];
print_area.innerHTML = mlist[print_month] + " " + currentMonth.year;
let weeks = currentMonth.getWeeks();

for(let w in weeks){
let days = weeks[w].getDates();
// days contains normal JavaScript Date objects.

let start = document.getElementById("table_body");
let create_row = document.createElement("tr");
create_row.setAttribute("id", "row"+w);
start.appendChild(create_row);

for(let d in days){
// You can see console.log() output in your JavaScript debugging tool, like Firebug,
// WebWit Inspector, or Dragonfly.
let row = document.getElementById("row"+w);
let create_day = document.createElement("td");
create_day.setAttribute("id", days[d].toISOString().substring(0,10));
start.appendChild(create_day);
let day = days[d];



create_day.textContent = day.toISOString().substring(8,10);
}
}
}

function setColor(){ 
   let themes = document.getElementsByName("select_theme");
  let selectedtheme = null;
      for(var i=0; i<themes.length; i++){
          if(themes[i].checked){
              selectedtheme = themes[i].value;
          }
      }
  let bootstrap = "dark";
  if (selectedtheme == "blue"){
    bootstrap = "primary";
  }
  else if (selectedtheme == "green"){
    bootstrap = "success";
  }
  else if (selectedtheme == "red"){
    bootstrap = "danger";
  }
  else if (selectedtheme == "purple"){
    bootstrap = "dark";
  }
  else if (selectedtheme == "orange"){
      bootstrap = "info";
  }

  document.body.style.background = selectedtheme;

  document.getElementById("display_days_of_week").setAttribute("class", "table-secondary");
  document.getElementById("maintable").setAttribute("class", "table table-bordered bg-white text-"+bootstrap);
}


  document.getElementById("none").addEventListener("click", function (){
    setColor();

    document.getElementById("display_days_of_week").setAttribute("class", "table-primary");
  }, false);

  document.getElementById("red").addEventListener("click", setColor, false);
  document.getElementById("orange").addEventListener("click", setColor, false);
  document.getElementById("green").addEventListener("click", setColor, false);
  document.getElementById("blue").addEventListener("click", setColor, false);
  document.getElementById("purple").addEventListener("click", setColor, false);




