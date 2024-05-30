const validation = new JustValidate("#appstep2");


validation
    .addField("#complaint", [
        {
            rule: "required"
        },
        {
            rule: 'maxLength',
            value: 200,
        }
    ])
    .addField("#details", [
        {
            rule: "required"
        },
        {
            rule: 'maxLength',
            value: 200,
        }
    ])
  
    
    .addRequiredGroup('#dentalpain')

    .addField("#painlevel", [
        {
            rule: "required"

        }
        
    ])

    .addRequiredGroup('#dentaltrauma')

    .addRequiredGroup('#bleedingtissues')

    .onSuccess((event) => {
        document.getElementById("appstep2").submit();
    });