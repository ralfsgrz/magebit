<?php

include "./classes/Subcription.php";
include "./db/database.php";

$db = new Database();                       //get database connection
$conn = $db->getConnection();

$subscription = new Subcription($conn);     // intialize subscription object

$subscriptions = $subscription->getSubscriptions($_GET);       // get all subscriptions from database and pass in filter data

if(isset($_GET['deleteId']))                                   // if deleteId is set, call deleteSusbscription method
{
    $subscription->deleteSubscription($_GET['deleteId']);       
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mid/Junior - Web Developer Test | Task 3</title>
</head>
<body>
    <form action="" method="GET">
        <label for="sort" style="display:inline-block">Sort by:</label>
        <select style="display:inline-block" name="order" id="sort">
            <option value="date" <?php if(isset($_GET['order']) && $_GET['order'] == "date") echo "selected"?>>Date</option>
            <option value="email" <?php if(isset($_GET['order']) && $_GET['order'] == "email") echo "selected"?>>Email</option>
        </select>
        <label for="provider" style="display:inline-block">Filter email provider:</label>
        <select style="display:inline-block" name="provider" id="provider">
            <option value="">All</option>
            <?php
                $providers = $subscription->getEmailProviders();
                foreach($providers as $provider){?>
                    <option value="<?php echo $provider;?>" <?php if(isset($_GET['provider']) && $_GET['provider'] == $provider) echo "selected";?>>
                        <?php echo ucfirst($provider);?>
                    </option>
                <?php
                }
            ?>
        </select>
        <input type="text" name="search" placeholder="Search e-mail" value="<?php if(isset($_GET['search'])){echo $_GET['search'];}?>">
        <button>Apply</button>
    </form>
    <?php 
    if($subscriptions->rowCount() <= 0){
        echo "No subscriptions found!";
    }else{
    ?>
        <table style="width: 40%; text-align: center; font-size: 1.3rem">
            <tr style="background-color:cadetblue">
                <th>ID</th>
                <th>Email</th>
                <th>Subscription date</th>
                <th>Action</th>
            </tr>
            <?php
                while($row = $subscriptions->fetch()){
                    echo "<tr><td>" . $row['id'] . "</td><td>" . $row['email'] . "</td><td>" . $row['date'] . "</td><td><a href='?deleteId=". $row['id'] ."'>Delete</a></td></tr>";
                }
            ?>
        </table>  
    <?php
    }
    ?>
    
</body>
</html>