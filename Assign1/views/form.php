<html>
<head>
    <title>Assignment 1</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <ul> 
    
    <?php
      //echo "<pre>";
      if(isset($data["errors"])){
            
        $errors = $data["errors"];
        $inputs = $data["inputs"];

        //print_r($errors);
        //print_r($inputs);

        foreach ($errors as $error) {
    
    ?>
    
        <li class="list">
            
            <?php echo $error; ?>
            
        </li>   
    

    <?php
        }
    }
    ?>
    </ul>

<form method="post">
    
    <input type="text" name="name" placeholder="Enter name" 
    value="<?php if(isset($inputs['name'])) echo $inputs['name']?>"><br>

    <input type="text" name="email" placeholder="Enter email" 
    value="<?php if(isset($inputs['email'])) echo $inputs['email'];?>"><br>
    
    <select name="city">
        <option value="Sharkia" 
        <?php if(isset($inputs["city"]) && $inputs["city"] == 'Sharkia') echo 'selected';?>>Sharkia</option>
        <option value="Alex" <?php if(isset($inputs["city"]) && $inputs["city"] == 'Alex') echo 'selected';?>>Alex</option>
        <option value="Cairo" <?php if(isset($inputs["city"]) && $inputs["city"] == 'Cairo') echo 'selected';?>>Cairo</option>
        <option value="Mans" <?php if(isset($inputs["city"]) && $inputs["city"] == 'Mans') echo 'selected';?>>Mans</option>
    </select><br>

    
    <input type="radio" name="gender" value="male" 
    <?php if(isset($inputs["gender"]) && $inputs["gender"] == 'male') echo 'checked';?>> Male
    <input type="radio" name="gender" value="female" 
    <?php if(isset($inputs["gender"]) && $inputs["gender"] == 'femal') echo 'checked';?>> Female<br>

    <select multiple="multiple" name="hobbies[]">
        <option value="Sports" 
        <?php if(isset($inputs["hobbies"]) && in_array("Sports", $inputs["hobbies"])) 
        echo 'selected';?>>Sports</option>
        <option value="Reading" 
        <?php if(isset($inputs["hobbies"]) && in_array("Reading", $inputs["hobbies"])) echo 'selected';?>>Reading</option>
        <option value="Swimming" 
        <?php if(isset($inputs["hobbies"]) && in_array("Swimming", $inputs["hobbies"])) echo 'selected';?>>Swimming</option>
        <option value="Games"
        <?php if(isset($inputs["hobbies"]) && in_array("Games", $inputs["hobbies"])) echo 'selected';?>>Play Games</option>
    </select><br>
    <input type="checkbox" name="updated" value="updated" <?php if(isset($inputs["updated"]) && $inputs["updated"] == 'updated') echo 'checked';?>>Send me updates by mail<br>
    <button name="send" type="submit">Submit</button>
</form>

</body>
</html>