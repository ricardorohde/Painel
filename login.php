<?php
    if(isset($_COOKIE['lembrar'])){
        $user = $_COOKIE['user'];
        $password = $_COOKIE['password'];
        $sql = MySql::conectar()->prepare("SELECT * FROM `admin.users` WHERE user = ? AND password = ?");
        $sql->execute(array($user,$password));
        if($sql->rowCount() == 1){
            $info = $sql->fetch();
            $_SESSION['login'] = true;
            $_SESSION['user'] = $user;
            $_SESSION['password'] = $password;
            $_SESSION['id_user'] = $info['id'];
            $_SESSION['cargo'] = $info['cargo'];
            $_SESSION['nome'] = $info['nome'];
            $_SESSION['img'] = $info['img'];
            Painel::redirect(INCLUDE_PATH_PAINEL);

        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH_PAINEL; ?>css/style.css">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH_PAINEL ?>css/all.min.css">
    <title>Painel de controle</title>
</head>

<body>
    <div class="box-login">
    <?php
        if(isset($_POST['acao'])){
            $user = $_POST['user'];
            $password = $_POST['password'];
            $sql = MySql::conectar()->prepare("SELECT * FROM `admin_users` WHERE user = ? AND password = ?");
            $sql->execute(array($user,$password));
            if($sql->rowCount() == 1){
                $info = $sql->fetch();
                //login com sucesso.
                $_SESSION['login'] = true;
				$_SESSION['user'] = $user;
                $_SESSION['password'] = $password;
                $_SESSION['id_user'] = $info['id'];
				$_SESSION['cargo'] = $info['cargo'];
				$_SESSION['nome'] = $info['nome']; 
                $_SESSION['img'] = $info['img'];
                if(isset($_POST['lembrar'])){
                    setcookie('lembrar', true, time()+(60*60*24),'/');
                    setcookie('user',$user, time()+(60*60*24),'/');
                    setcookie('password',$password, time()+(60*60*24),'/');
                }
                Painel::redirect(INCLUDE_PATH_PAINEL);   
            }else{
                //Erro no login
                echo '<div class="error-box"><i class="fas fa-exclamation-circle"></i> Usuário ou senha incorretos!</div>';
            }
        }
    ?>

    <h2>Fazer login:</h2>
    <form method="post">
        <input type="text" name="user" placeholder="Login" required>
        <input type="password" name="password" placeholder="Senha" required>
        <div class="posit-l"><input type="submit" name="acao" value="Entrar"></div>
        <div class="posit-r">
            <label >Lembrar-me</label>
            <input type="checkbox" name="lembrar">
        </div><!--posit-r-->
    </form>
    </div><!--box-login-->
</body>
</html>