<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        if ($_GET["prenom"] === "" && $_GET['nom'] === "") {
            echo "Ta rien mis ";
        }
        else if (isset($_GET['nom']) && isset($_GET['prenom'])) {
            echo "Bonjour ".$_GET['nom']." ".$_GET['prenom'];
        }
           
        
        
    ?>
</body>
</html>