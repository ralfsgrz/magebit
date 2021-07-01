//get elements from HTML
const form = document.getElementById("form");
const email = document.getElementById("email");
const terms = document.getElementById("terms");
const emailError = document.querySelector(".e-error");
const termsError = document.querySelector(".t-error");
const heading = document.getElementById("heading");
const subheading = document.getElementById("subheading");
const success = document.getElementById("success");

// email validation using regex (valid ex: _@_._)
const validateEmail = (email) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);

// check if email ends with ".co" using regex
const checkEnding = (email) => /^[^\s@]+@[^\s@]+\.co$/.test(email);

//form submit event
form.addEventListener("submit", (e) => {
    e.preventDefault();
    
    let isValid = true;                                 // variable to check if form is valid

    if(!terms.checked){                                 // check if user checked terms and conditions checkbox
        termsError.innerHTML = "You must accept the terms and conditions";
        isValid = false;
    }else{
        termsError.innerHTML = "";
    }

    if(email.value === '' || email.value === null){         // check if e-mail field is empty    
        emailError.innerHTML = "Email address is required";
        isValid = false;
    }else if(!validateEmail(email.value)){                  // check if input e-mail is a valid e-mail
        emailError.innerHTML = "Please provide a valid e-mail address";
        isValid = false;
    }else if(checkEnding(email.value)){                     // check if input e-mail ends with ".co"
        emailError.innerHTML = "We are not accepting subscriptions from Colombia emails";
        isValid = false;
    }else{
        emailError.innerHTML = "";
    }
    
    if(isValid){
        form.remove();                                      // if user agrees to t&c and e-mail is valid, form is removed and success message displayed
        heading.innerText = "Thanks for subscribing!";
        subheading.innerText = "You have successfully subscribed to our email listing. Check your email for the discount code.";
        success.style.display = "block";
    } 
        
});





