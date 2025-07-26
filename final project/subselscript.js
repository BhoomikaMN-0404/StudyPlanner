function sanitizeInput(input) {
    // Sanitize input by removing potentially harmful characters
    return input.replace(/</g, "&lt;").replace(/>/g, "&gt;");
}

function nextForm() {
    var subjectsSelect = document.getElementById("subjects");
    var customSubjectsTextarea = document.getElementById("custom_subjects");

    var selectedSubjects = Array.from(subjectsSelect.selectedOptions).map(option => sanitizeInput(option.value));
    var customSubjects = customSubjectsTextarea.value.split('\n').map(subject => sanitizeInput(subject.trim()));
    var allSubjects = [];

  if (customSubjects.length !== 0) {
    allSubjects = selectedSubjects.concat(customSubjects.filter(subject => subject.length !== 0));
  } else {
    allSubjects = selectedSubjects;
  }
    if (allSubjects.length === 0) {
        alert("Please select or type at least one subject.");
        return;
    }

    var form = document.createElement("form");
    form.method = "post";
    form.action = "ass4.php";

    for (var i = 0; i < allSubjects.length; i++) {
        var subject = allSubjects[i];
        var subjectInput = document.createElement("input");
        subjectInput.type = "hidden";
        subjectInput.name = "subjects[]";
        subjectInput.value = sanitizeInput(subject);
        form.appendChild(subjectInput);
    }

    document.body.appendChild(form);
    form.submit();
}
