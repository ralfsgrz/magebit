<?php

class Subcription{

    //database connection and table name
    private $conn;
    private $table = "subscriptions";
    
    //email property
    private $email;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function setEmail($useremail)
    {
        $this->email = $useremail;
    }

    public function create()
    {
        $sql = "INSERT INTO $this->table (email) VALUES (:email)";
        $stmt = $this->conn->prepare($sql);

        if($stmt->execute(['email' => $this->email])){
            return true;
        }else{
            return false;
        }
    }

    public function getSubscriptions($data)
    {
        $sql = "SELECT * FROM $this->table";
        // get subscriptions in order
        $orderBy = array('date', 'email');
        $order = 'date';
        if(isset($data['order']) && in_array($data['order'], $orderBy))
        {                                                                   // table ordering using URL variables
            $order = $_GET['order'];
        }

        $providers = $this->getEmailProviders();

        // get subscriptions filtered by email and with search term
        if(isset($data['provider']) && in_array($data['provider'], $providers) && isset($data['search']) && !empty($data['search']))
        {
            $searchterm = $data['search'];
            $provider = $data['provider'];
            $sql .= " WHERE email LIKE '%@$provider.%' AND 
                            email LIKE '%$searchterm%'";
        }elseif(isset($data['search']) && !empty($data['search']))                      // get subscriptions by search term
        {
            $searchterm = $data['search'];
            $sql .= " WHERE email LIKE '%$searchterm%'";
        }elseif(isset($data['provider']) && in_array($data['provider'], $providers))        // get subscriptions filtered by email provider
        {
            $provider = $data['provider'];
            $sql .= " WHERE email LIKE '%@$provider.%'";
        }

        $sql .= " ORDER BY $order";                 // append order to sql query
        $stmt = $this->conn->query($sql);
        return $stmt;
    }

    public function getEmailProviders()
    {
        $providers = [];
        $sql = "SELECT email FROM $this->table";
        $emails = $this->conn->query($sql)->fetchAll(PDO::FETCH_COLUMN);        // get all emails from database   
        foreach($emails as $email){                                         
            $provider = explode('@', $email);                          // split each email to get provider ("x@gmail.com" => "gmail")
            $provider = explode('.', $provider[1]);
            if(!in_array($provider[0], $providers)){                    // check if provider not already in the array
                array_push($providers, $provider[0]);                   // add provider to "providers" array
            }
        }
        
        return $providers;
        
    }

    public function deleteSubscription($id)
    {
        $sql = "DELETE FROM subscriptions WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        
        if($stmt->execute(['id' => $id]))
        {
            header("location:subscriptions.php");
        }
    }
}


?>