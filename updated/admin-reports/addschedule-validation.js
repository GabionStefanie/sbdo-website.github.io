const validation = new JustValidate("#addschedule");

validation
    .addField("#appointment_date", [
        {
            rule: "required"
        }
    ])

    .onSuccess((event) => {
        document.getElementById("addschedule").submit();
    });