<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hallo</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Aref+Ruqaa+Ink&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #242422;
            color: white;
            font-family: 'Aref Ruqaa Ink', serif;
            margin: 0px;
        }

        .main {
            background-color: #343434;
            display: flex;
        }

        .menu {
            width: auto;
            background-color: #542422;
            margin-right: 20px;
            padding-right: 20px;
            height: 100vh;
        }

        .menu a {
            display: block;
            text-decoration: none;
            /* Removes the href lines*/
            color: white;
            padding: 8px;
            align-items: center;
            display: flex;
        }

        .menu a:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .menu img {
            margin-right: 5px;
        }

        .accountInfo {
            background-color: #444444;
            padding: 5px;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .infoItem {
            display: flex;
        }

        .setting {
            float: right;
            border: 0;
            margin-left: -50px;
            background: transparent;
            cursor: pointer;
            filter: invert(1);
            opacity: 0.5;
        }

        .setting:hover {
            opacity: 0.3;
            filter: invert(1);
        }
    </style>
</head>

<body>
    <div class="main">
        <div class="menu">
            <a href="index.php?page=home"><img src="img/home_FILL0_wght400_GRAD0_opsz24.svg"> Home</a>
            <a href="index.php?page=search"><img src="img/search_FILL0_wght400_GRAD0_opsz24.svg"> Search</a>
            <a href="index.php?page=account"><img src="img/person_FILL0_wght400_GRAD0_opsz24.svg"> Account</a>
        </div>
        <div class="content">
            <?php
            // http://localhost/project1/index.php?page=home (xampp starten)

            $exercises = [];

            if (file_exists('exercises.txt')) {
                $text = file_get_contents('exercises.txt', true);
                $exercises = json_decode($text, true);
            }
            if (isset($_POST['exercise']) && isset($_POST['medRep'])) {
                echo "Exercise " . $_POST['exercise'] . " got added";
                $newExercise = [
                    'exercise' => $_POST['exercise'],
                    'medRep' => $_POST['medRep']
                ];
                array_push($exercises, $newExercise);
                file_put_contents('exercises.txt', json_encode($exercises, JSON_PRETTY_PRINT));
            }

            if ($_GET['page'] == 'home') {
                echo '<h1>Home page</h1>';
                foreach ($exercises as $row) {
                    echo "<div>" . $row['exercise'] . "</div>";
                }
            } elseif ($_GET['page'] == 'search') {
                echo '<h1>Search</h1>';
                echo '2';
            } elseif ($_GET['page'] == 'account') {
                echo '<h1>Your account</h1>';
                echo "
                <div class='accountInfo'>
                    <button class='setting' type='submit'>
                        <img src='img/settings_FILL0_wght400_GRAD0_opsz24.svg' width='20' height='20' alt='submit' />
                    </button>     
                    <div class='infoItem'>
                        <div style='width: 30%;'>Name:</div>
                        <div>Max Mustermann</div>
                    </div>
                    <div class='infoItem'>
                        <div style='width: 30%;'>Rank:</div>
                        <div>☆</div><div style='opacity: 0.2;'>☆☆☆☆</div>
                    </div>
                    <div class='infoItem'>
                        <div style='width: 30%;'>Situation:</div>
                        <div>Active</div>
                    </div>
                </div>
                <form action='?page=home' method='POST'>
                    <input placeholder='Set exercise' name='exercise'>
                    <input placeholder='Set med rep' name='medRep'>
                    <button type='submit'>Speichern</button>
                </form>
                ";
            } else {
                echo '<h2>This page cannot be found.</h2>';
            }
            ?>
        </div>
    </div>
</body>

</html>