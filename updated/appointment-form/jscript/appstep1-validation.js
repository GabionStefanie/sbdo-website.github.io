const validation = new JustValidate("#appstep1");


validation
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
  
    .addField("#pnum", [
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
    ])
    .addField("#gender", [
        {
            rule: "required"
        }
    ])
 
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
   
    .onSuccess((event) => {
        document.getElementById("appstep1").submit();
    });