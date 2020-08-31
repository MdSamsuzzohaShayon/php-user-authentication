<?php
// IMPORT USER OBJECT
require_once('core/classes/class.User.php');

$user = new User();

// GETTING THE ACTION
$a = isset($_GET['a']) ? $_GET['a'] : '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
</head>

<body>
    <div class="ui container">
        <?php
        switch ($a) {
            case 'login':
                echo $user->loginForm();
                break;
            case "register":
                echo $user->registerForm();
            break;
            case "dashboard":{
                echo $user->dashboard();
            break;
            }

            default:
                echo $user->loginForm();
                break;
        }
        ?>
    </div>
</body>

</html>