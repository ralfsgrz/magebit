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
form.addEventListener("submit", (e) => 
{
    form.remove();                                      // if user agrees to t&c and e-mail is valid, form is removed and success message displayed
    heading.innerText = "Thanks for subscribing!";
    subheading.innerText = "You have successfully subscribed to our email listing. Check your email for the discount code.";
    success.style.display = "block";  
});





