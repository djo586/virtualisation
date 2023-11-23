<?php
    include "connexion.php";
    //début session
    session_start();

    //vérification si l'utilisateur est déjà connecté
    if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
        header("Location: acceuil.php");
        exit;
    }

    //vérification si le formulaire de connexion a été soumis
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        //vérifier les informations saisies

        //vérifie les informations de connexion
        $stmt = $db->prepare("SELECT * FROM users WHERE username = :username and password = :password");
        $stmt->execute(array(':username' => $_POST["login"], ':password' => $_POST["pass"]));
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user){
            echo "Bienvenue " . $user["nom_complet"];
            echo "<br>";
            echo "Vous allez être redirigé vers votre dashboard";
            //Information de connexion
            $_SESSION["logged_in"] = true;
            $_SESSION["login"] = $user["username"];

            //Redirige vers la page appropriée
            header("Refresh:2; Url=acceuil.php");
            exit;
        }
        else {
            // Si les informations sont incorrectes, affichez un message d'erreur
            $erreur = "Nom d'utilisateur ou mot de passe invalide!";
        }
    }

?>

<html>
    <head>
        <title>Authentification</title>
        <meta charset="UTF-8">
        <style>
            * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
            }

            body {
            margin: 0;
            padding: 0;
            background-color: #F8F8F8;
            }

            header {
                    background-color: #0774C8;
                    color: #FFF;
                    padding: 10px;
                    text-align: center;
                }

            .img-circle {
                    border-radius: 50%;
                }

                h1 {
                    margin: 0;
                    font-size: 36px;
                    font-weight: normal;
                }

            nav {
                    background-color: #0774C8;
                    padding: 30px;
                    text-align: center;
                }

                nav ul {
                    list-style-type: none;
                    margin: 0;
                    padding: 0;
                }

                nav li {
                    display: inline-block;
                    margin: 0 10px;
                }

                nav a {
                    color: #FFF;
                    text-decoration: none;
                    padding: 5px;
                    border-radius: 5px;
                    transition: all 0.2s ease;
                }
            
            nav a:hover {
                    background-color: #333;
                    color: #FFF;
                }

            .container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.3);
            }

            form {
            display: flex;
            flex-direction: column;
            }

            h2 {
            margin-bottom: 20px;
            text-align: center;
            }

            .input-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 10px;
            }

            label {
            margin-bottom: 5px;
            font-weight: bold;
            }

            input[type="text"],
            input[type="password"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            }

            .btn {
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            }

            .btn:hover {
            background-color: #3e8e41;
            }
            footer {
                background-color: #0774C8;
                color: #FFF;
                padding: 10px;
                text-align: center;
            }

            footer p {
                margin: 0;
            } 
        </style> 
    </head>
    <body>
        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="login.php">Se connecter</a></li>
            </ul>
        </nav>
        <br><br><br><br><br><br>
        <div class="container">
        <h1>Connexion</h1><br><br>
        <?php
            if(isset($erreur)){
                echo "<font color='red'>".$erreur."</font>";
            }
        ?>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="input-group">
            <label>Utilisateur:</label>
            <input type="text" name="login" required><br>
            </div>
            <div class="input-group">
            <label>Mot de passe:</label>
            <input type="password" name="pass" required><br>
            </div>
            <input type="submit" class="btn" value="Connexion">
        </form>  
        </div>
    <br><br><br><br><br><br><br>
    <footer>
		<p>&copy; 2023 tous les droits sont réservés.</p>
        <p>&copy; Jaouadi Mohamed Jihed.</p>
	</footer>    
    </body>
</html>
