const validation = new JustValidate("#payments-html");


validation


    .addField("#referenceNo", [
        {
            rule: "required"
        }
    ])

    validation.addField('#proofOfPayment', [
        {
            rule: 'minFilesCount',
            value: 1,
            errorMessage: "Must submit 1 file",
          },
          {
            rule: 'maxFilesCount',
            value: 1,
            errorMessage: "Must submit 1 file",
          },
          {
            rule: "files",
            value: {
              files: {
                extensions: ["jpeg", "jpg", "png"],
                maxSize:950000, 
                types: ["image/jpeg", "image/jpg", "image/png"],
              },
            },
            errorMessage: "Only accepts file types of .jpeg, .jpg, .png that are under 950KB",
          },
        ])

    .onSuccess((event) => {
        document.getElementById("payments-html").submit();
    });