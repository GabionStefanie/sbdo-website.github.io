const validation = new JustValidate("#appstep4");


validation
    .addRequiredGroup('#covid')
    .addRequiredGroup('#symptoms')
    .addRequiredGroup('#agree')

    .onSuccess((event) => {
        document.getElementById("appstep4").submit();
    });