<?php include '../TemplatePHP/verify.php';?>
<?php
    if(isset($_POST['formconnexion']))
    {
        require_once('../ManageClass/loginManager.class.php');
        require_once('../Class/user.class.php');
        $mdpCurrent = $_POST['mdpCurrent'];
        $mdpChange = $_POST['mdpChange'];
        $mdpConfirm = $_POST['mdpConfirm'];
        $loginconnect = $_SESSION['pseudo'];
        $loginManager = new LoginManager();
        $user = new User();
        $user = $loginManager->getUser($loginconnect);
        if(password_verify($mdpCurrent,$user->password()))
        {
            if($mdpChange == $mdpConfirm)
            {
                if($mdpConfirm != "" and $mdpChange != "")
                {
                    $user->setPassword(password_hash($mdpConfirm,PASSWORD_DEFAULT));
                    $loginManager->updateMembre($user);
                    echo "Mot de passe modifié ! ";
                    header('Location: ../Page/home.php');
                }
                else
                {
                    echo "Remplir les champs !";
                }
            }
            else
            {
                echo "New password et confirm password différents !";
            }
        }
        else
        {
            echo "Mauvais mot de passe";
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
                    <label for="username">Current password</label>
                    <input type="text" class="form-control" name="mdpCurrent" placeholder="Enter current password" />
                </div>
                <div class="form-group">
                    <label for="password">New password</label>
                    <input type="password" class="form-control"  name="mdpChange" placeholder="Enter new password" />
                </div>
                <div class="form-group">
                    <label for="password">Confirm password</label>
                    <input type="password" class="form-control"  name="mdpConfirm" placeholder="Confirm password" />
                </div>
                <div class="form-group">
                    <input type="submit" name="formconnexion" class="btn btn-primary"/>
                </div>
            </form>
        </div>
    </body>
</html>
