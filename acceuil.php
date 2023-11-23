
<?php
      include "connexion.php";
      //début session
      session_start();
      $stmt = $db->prepare("SELECT * FROM users");
      $stmt->execute();
      $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
      //vérification si le formulaire de déconnexion a été soumis
      if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST["logout"])){
            //détruire la session
            session_destroy();
            //rediriger vers la page de connexion
            header("Location:index.php");
            exit;
      }
?>


<html>
    <head>
        <title>dashboard</title>
        <style>
        /* Your existing styles for index.php */
        body {
            font-family: Arial, sans-serif;
            background-color: #F8F8F8;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #0774C8;
            color: #FFF;
            padding: 10px;
            text-align: center;
        }

        nav {
            background-color: #0774C8;
            padding: 10px;
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
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            margin-top: 50px;
        }

        footer {
            background-color: #0774C8;
            color: #FFF;
            padding: 10px;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        footer p {
            margin: 0;
        }

        /* Added style to center-align the table */
        section {
            text-align: center;
        }

        table {
            margin: 0 auto; /* Center-align the table */
        }
    </style>
    </head>
    <body>
    <header>
        <h2>Welcome to the Dashboard, <?php echo $_SESSION["login"]; ?>!</h2>
        <?php
            if(isset($erreur)){
                echo "<font color='red'>".$erreur."</font>";
            }
        ?>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="hidden" name="logout" value="true">
            <input type="submit" class="btn" value="Déconnexion">
        </form>
    </header>

    <nav>
        <ul>
            <li><a href="#">Accueil</a></li>
            <li><a href="#">parametre</a></li>
        </ul>
    </nav>
      
      <div class="container">

        
        <br><br><br>
        <section>
            <h2>Users List</h2>
            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>Nom Complet</th>
                    <th>Username</th>
                    <th>Password</th>
                    <!-- Add more columns if needed -->
                </tr>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo $user['id']; ?></td>
                        <td><?php echo $user['nom_complet']; ?></td>
                        <td><?php echo $user['username']; ?></td>
                        <td><?php echo $user['password']; ?></td>
                        <!-- Add more columns if needed -->
                    </tr>
                <?php endforeach; ?>
            </table>
        </section>
        </div>
        <footer>
            <p>&copy; 2023 All rights reserved.</p>
            <p>&copy; Jaouadi Mohamed Jihed.</p>
    </footer>  
    </body>
</html>
