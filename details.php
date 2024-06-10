<?php 
    include('config\db_connect.php');

    if (isset($_POST['delete'])) {
        $id_to_delete = mysqli_real_escape_string($mysqli, $_POST['id_to_delete']);
        $sql = "DELETE FROM pizzas WHERE id = $id_to_delete";

        if (mysqli_query($mysqli, $sql)) {
            header('Location: index.php');
        } else {
            echo 'Query error occured: ' . mysqli_error($mysqli);
        }
    }

    if (isset($_GET['id'])) {
        $id = mysqli_real_escape_string($mysqli, $_GET['id']);
        $sql = "SELECT * FROM pizzas WHERE id = $id";
        $result = mysqli_query($mysqli, $sql);
        $pizza = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        mysqli_close($mysqli);
    }
?>

<!DOCTYPE html>
<html lang="en">
    <?php include('templates\header.php') ?>
    <div class="container center">
        <?php if($pizza): ?>
            <h4><?php echo htmlspecialchars($pizza['title']); ?></h4>
            <p>Written by: <?php echo htmlspecialchars($pizza['email']) ?></p>
            <p><?php echo date($pizza['created_at']); ?></p>
            <br />
            <h6>Message</h6>
            <p><?php echo $pizza['ingredients'] ?></p>

            <form action="details.php" method="POST">
                <input type="hidden" name="id_to_delete" value="<?php echo $pizza['id'] ?>">
                <input type="submit" name="delete" value="Delete" class="btn">
            </form>

        <?php else:?>
            <h5>Message doesn't exist. :-[</h5>
        <?php endif; ?>
        
    </div>
    <?php include('templates\footer.php') ?>
</html>