<?php

    include('config\db_connect.php');

    $errors = ['email' => '', 'title' => '', 'ingredients' => ''];

    $email = '';
    $title = '';
    $ingredients = '';

    if (isset($_POST['submit'])) {
        if (empty($_POST['email'])) {
            $errors['email'] = "Email required. <br />";
        } else {
            $email = htmlspecialchars($_POST['email']);
        }

        if (empty($_POST['title'])) {
            $errors['title'] = "Title required. <br />";
        } else {
            $title = htmlspecialchars($_POST['title']);
            if (!preg_match('/^[a-zA-Z\s]+$/', $title)) {
                $errors['title'] = "Only letters are required for title. <br />";
            }
        }

        if (empty($_POST['ingredients'])) {
            $errors['ingredients'] = "Ingredients required. <br />";
        } else {
            $ingredients = htmlspecialchars($_POST['ingredients']);
        }

        if (array_filter($errors)) {
            
        } else {

            $email = mysqli_real_escape_string($mysqli, $_POST['email']);
            $title = mysqli_real_escape_string($mysqli, $_POST['title']);
            $ingredients = mysqli_real_escape_string($mysqli , $_POST['ingredients']);

            $sql = "INSERT INTO pizzas(title, email, ingredients) VALUES ('$title','$email','$ingredients')";

            if (mysqli_query($mysqli, $sql)) {
                // success
                header('Location: index.php');
            } else {
                echo 'query error ' . mysqli_error($mysqli);
            }
        }
    } // ennd of POST check

?>
<!DOCTYPE html>
<html lang="en">
    <?php include('templates/header.php') ?>
    <section class="container grey-text">
        <h4 class="center">Write a Message</h4>
        <form class="white" action="add.php" method="POST">
            <label>Your Nickname:</label>
            <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>">
            <div class="red-text"><?php echo $errors['email']; ?></div>

            <label>Message Title:</label>
            <input type="text" name="title" value="<?php echo htmlspecialchars($title); ?>">
            <div class="red-text"><?php echo $errors['title']; ?></div>

            <label>Message:</label>
            <input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients); ?>">
            <div class="red-text"><?php echo $errors['ingredients']; ?></div>

            <div class="center">
                <input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
            </div>
        </form>
    </section>
    <?php include('templates/footer.php') ?>
</html>