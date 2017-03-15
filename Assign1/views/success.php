<head>
    <link rel="stylesheet" type="text/css" href="./views/style.css">
</head>
    
    <?php

        $success = $data["success"];

     ?>

        <h1 class="title">Welcome <?php echo $success["name"]; ?></h1><hr>
        <table class="table">
                <td>Name</td>
                <td> <?php echo $success["name"];?> </td>
            </tr>

            <tr>
                <td>Email</td>
                <td><?php echo $success["email"];?></td>
            </tr>

            <tr>
                <td>City</td>
                <td><?php echo $success["city"];?></td>
            </tr>

            <tr>
                <td>Gender</td>
                <td><?php echo $success["gender"];?></td>
            </tr>

            <tr>
                <td>Hobbies</td>
                <td><?php echo implode(", ",$success["hobbies"]); ?></td>
            </tr>

            <tr>
                <td>Updated</td>
                <td><?php echo $success["updated"]; ?></td>
            </tr>

        </table>