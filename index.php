<?php 

include('config\db_connect.php');

$sql = 'SELECT title, ingredients, id FROM pizzas ORDER BY created_at';
$result = mysqli_query($mysqli, $sql);
$pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_free_result($result);
mysqli_close($mysqli);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include('templates/header.php'); ?>
    
    <h4 class="center grey-text">Messages!</h4>
    <div class="container">
        <div class="row">
            <?php foreach($pizzas as $pizza){ ?>
                <div class="col s6 md3">
                    <div class="card">
                        <div class="card-content center">
                            <h6><?php echo htmlspecialchars($pizza['title']); ?></h6>
                            <p><?php echo $pizza['ingredients']?></p>
                        </div>
                        <div class="card-action right-align">
                            <a href="details.php?id=<?php echo htmlspecialchars($pizza['id']); ?>" class="brand-text">more info</a>
                        </div>
                    </div>
                </div>
                
            <?php } ?>
            <?php if (count($pizzas) == 0):?>
                <br />
                <h4 class="center grey-text">Be the fist to write a public message!</h4>
            <?php endif;?>
        </div>
    </div>

    

    

    <?php include('templates/footer.php'); ?>
</body>
</html>