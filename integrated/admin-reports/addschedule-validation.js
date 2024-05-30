const validation = new JustValidate("#addschedule");

validation
  .addField("#appointment_date", [
        {
            rule: "required"
        }
    ])

.addRequiredGroup('#appointment_time')

  .onSuccess((event) => {
        document.getElementById("addschedule").submit();
    });