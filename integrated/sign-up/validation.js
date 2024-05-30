const validation = new JustValidate("#signup");

validation
    .addField("#username", [
        {
            rule: "required"
        }
    ])

    .addField("#fname", [
        {
            rule: "required"
        }
    ])

    .addField("#lname", [
        {
            rule: "required"
        }
    ])


    .addField("#email", [
        {
            rule: "required"
        },
        {
            rule: "email"
        },
		{
            validator: (value) => () => {
                return fetch("validate-email.php?email=" + encodeURIComponent(value))
                       .then(function(response) {
                           return response.json();
                       })
                       .then(function(json) {
                           return json.available;
                       });
            },
            errorMessage: "Email already taken"
        }
    ])

    .addField("#pnum", [
        {
            rule: "required"
        }
    ])

    .addField("#gender", [{ rule: "required" }])

    .addField("#password", [
        {
            rule: "required"
        },
        {
            rule: "password"
        }
    ])
    .addField("#password_confirmation", [
        {
            validator: (value, fields) => {
                return value === fields["#password"].elem.value;
            },
            errorMessage: "Passwords should match"
        }
    ])
    .onSuccess((event) => {
        document.getElementById("signup").submit();
    });