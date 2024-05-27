const validation = new JustValidate("#appstep3");


validation
    .addRequiredGroup('#diabetes')
    .addRequiredGroup('#heartconditions')
    .addRequiredGroup('#hypertension')
    .addRequiredGroup('#medallergen')
    .addRequiredGroup('#maintenance')

    .addField("#systolicpressure", [
        {
            rule: "required"
        }
    ])

    .addField("#diastolicpressure", [
        {
            rule: "required"
        }
    ])

    .addField("#medicalconditions", [
        {
            rule: "required"
        },
        {
            rule: 'maxLength',
            value: 50,
        }
    ])
  

    .onSuccess((event) => {
        document.getElementById("appstep3").submit();
    });