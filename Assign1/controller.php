<?php

include_once("./functions.php");

$name_pattern    = "/^([a-z '])+/i";
// $email_pattern   = '/[([a-z0-9._]+)@([a-z0-9.]+)\.(a-z+){2,3}]/i';
$email_pattern   = "/./i";
$city_pattern    = "/[(Sharkia|Alex|Cairo|Mans)]/";
$gender_pattern  = "/[(male|female)]/";
$hobbies_pattern = "/[(Sports|Games|Reading|swimming)]/";
$update_pattern  = "/[(updated)]/";

$success         = [];
$errors          = [];


if(isset($_POST['send'])){
    // echo "Hello";
    //assign
    $name    = isset($_POST['name'])    ? $_POST['name']    : '';
    $email   = isset($_POST['email'])   ? $_POST['email']   : '';
    $city    = isset($_POST['city'])    ? $_POST['city']    : '';
    $gender  = isset($_POST['gender'])  ? $_POST['gender']  : '';
    $hobbies = isset($_POST['hobbies']) ? $_POST['hobbies'] : [];
    $updated = isset($_POST['updated']) ? $_POST['updated'] : '';
    
    $validate_name = validate_input($name_pattern, $name,"name");
    $validate_email = validate_email($email);
    $validate_city = validate_input($city_pattern, $city, "city");
    $validate_gender = validate_input($gender_pattern, $gender, "gender");
    $validate_hobbies = validate_arrary_input($hobbies_pattern, $hobbies, "hobbies");
    $validate_update = validate_input($update_pattern, $updated, "updated");

    if($validate_name){
        $errors[] = $validate_name;
    }else{
        $success["name"] = $name;
    }
    
    if($validate_email){
        $errors[] = $validate_email;
    }else{
        $success["email"] = $email;
    }
    
    if($validate_city){
        $errors[] = $validate_city;
    }else{
        $success["city"] = $city;
    }
    
    if($validate_gender){
        $errors[] = $validate_gender;
    }else{
        $success["gender"] = $gender;
    }
    
    if($validate_hobbies){
        $errors[] = $validate_hobbies;
    }else{
        $success["hobbies"] = $hobbies;
    }
    
    if($validate_update){
        $errors[] = $validate_update;
    }else{
        $success["updated"] = $updated;
    }
}


if(isset($_POST["send"])){
    
    if(count($errors) < 1){
        
        echo load_view("./views/success.php", ["success" => $success]);
    
    }else{

        foreach ($_POST as $key => $value) {
            $inputs[$key] = $value;
        }
        echo load_view("./views/form.php", ["errors" => $errors, "inputs" => $inputs]);
    }
}else{
    echo load_view("./views/form.php");
}



function validate_arrary_input($pattern, $array, $name){
    foreach ($array as $string) {
        if(!preg_match($pattern, $string)){
            return $name." is not valid";
            break;
        }
        return false;
    }
}


function validate_input($pattern, $string, $name){
    if(!preg_match($pattern, $string)){    
        return $name. " is not valid";
    }
    return false;
}

function validate_email($email){
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
      return false;
    } 
    return "Email is not a valid email address";
}