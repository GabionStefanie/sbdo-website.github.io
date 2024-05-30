const validation = new JustValidate("#appstep1");

validation
    .addField("#fname", [{ rule: "required" }])
    .addField("#lname", [{ rule: "required" }])
    .addField("#pnum", [{ rule: "required" }])
    .addField("#email", [{ rule: "required" }, { rule: "email" }])
    .addField("#gender", [{ rule: "required" }])
    .addField("#apptype", [{ rule: "required" }])
    .addField("#date", [{ rule: "required" }])
    .addField("input[type='checkbox']", {  // Add validation rule for checkboxes
        rule: function (input) {
            return input.checked;  // Check if the checkbox is checked
        },
        errorMessage: "Please select at least one checkbox"  // Error message if no checkbox is checked
    })
    .onSuccess((event) => {
        document.getElementById("appstep1").submit();
    });
