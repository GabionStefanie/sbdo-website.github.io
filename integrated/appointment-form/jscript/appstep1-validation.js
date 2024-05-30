const validation = new JustValidate("#appstep1");


validation

    .addField("#apptype", [
        {
            rule: "required"
        }
    ])

    .addField("#date", [
        {
            rule: "required"
        }
    ])
    .addField("#time", [
        {
            rule: "required"
        }
    ])
   
    .onSuccess((event) => {
        document.getElementById("appstep1").submit();
    });
