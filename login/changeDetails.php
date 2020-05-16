<?php

require_once '../classes/shopAPI.php';
try {
    $shopAPI = new ShopAPI();
    $shopAPI->changeDetails($_POST['customerId'], $_POST['email'], $_POST['first_name'], $_POST['last_name'], $_POST['address1'], $_POST['address2'], $_POST['postal_code'], $_POST['city'], $_POST['country'], $_POST['phone'], $_POST['company']);

    header('Location: ../my-account.php');
} catch (Exception $e) {
    $error = $e->getMessage();
    echo $error;
    
  header("Location: ../my-account.php?error2=$error");
}