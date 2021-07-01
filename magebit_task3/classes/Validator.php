<?php

class Validator{
    
    private $data;
    private $errors = [];

    public function __construct($post_data)
    {
        $this->data = $post_data; //get POST array and store in private property
    }

    public function validateForm()
    {                           //call validation methods for email validation and t&c confirmation checkbox
        $this->validateEmail();
        $this->checkedTerms();
        return $this->errors;
    }

    public function validateEmail()
    {
        $email = $this->data["email"];
        
        if(empty($email)){                                      // check if email field not empty
            $this->addError("email", "Email address is required");
        }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){    // check if valid email
            $this->addError("email", "Please provide a valid e-mail address");
        }elseif(preg_match('/^[^\s@]+@[^\s@]+\.co$/',$email)){  // check if email ends with ".co"
            $this->addError("email", "We are not accepting subscriptions from Colombia emails");
        }
    }

    public function checkedTerms()
    {
        if(!isset($this->data["terms"])){                      // check if checkbox value is set (is checked)
            $this->addError("terms", "You must accept the terms and conditions");
        }
    }

    public function addError($key, $error)
    {
        $this->errors[$key] = $error;                         // add error to array with corresponding key (email or terms)
    }
}


?>