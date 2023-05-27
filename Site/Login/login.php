<?php
session_start();
if(isset($_POST['formconnexion']))
{
    $loginconnect = $_POST['userconnect'];
    $mdpconnect = $_POST['mdpconnect'];
    
    if(!empty($loginconnect) AND !empty($mdpconnect)) 
    {
        require_once('../ManageClass/loginManager.class.php');
        require_once('../Class/user.class.php');
        $loginManager = new LoginManager();
        $user = new User();
        $user = $loginManager->getUser($loginconnect);
        if(password_verify($mdpconnect,$user->password()))
        {
            $_SESSION['pseudo'] = $user->pseudo();
            $_SESSION['mail'] = $user->email();
            header("Location: ../Page/client.php?pseudo=".$_SESSION['pseudo']);
        }
    }
    else
    {
        echo "Aucun champ complété !";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../Css/login.css" />
    </head>
    <body>
        <div class="divCentre">
            <form action="" method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="userconnect" placeholder="Enter username" />
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control"  name="mdpconnect" placeholder="Password" />
                </div>
                <div class="form-group">
                    <input type="submit" name="formconnexion" class="btn btn-primary"/>
                </div>
            </form>
        </div>
    </body>
</html>
