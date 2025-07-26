
function addAssignment(subject,assignmentsDiv,deadlinesDiv) {
    var div = document.getElementById(assignmentsDiv);


    
    var input = document.createElement("input");
    input.type = "text";
    input.name =  "subject_assignments";
    input.placeholder = "Enter assignment";
    div.appendChild(document.createElement("br"));
    div.appendChild(input);
    div.appendChild(document.createElement("br"));
    var div1 = document.getElementById(deadlinesDiv);
    var deadlineLabel = document.createElement("label");
    deadlineLabel.innerHTML = "Enter Deadline: ";
    div1.appendChild(deadlineLabel);
    
    var deadline = document.createElement("input");
    deadline.type = "date";
    deadline.name = "deadlines";
    
    div1.appendChild(document.createElement("br"));
    div1.appendChild(deadline);

}
