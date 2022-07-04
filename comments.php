<?php
require 'template/header.php';
if (!isset($_SESSION['email'])) {
    redirect('login.php');
}
/*session_start();

if (isset($_SESSION['email'] ))  {
    header('Location: login.php');
    exit;
}**/

$first_name = $last_name = $comment = "";
$first_name_err = $last_name_err = $comment_err = "";
$success = $faild = "";

if (isset($_POST) && isset($_POST['send'])) {
    if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['comment']))
     {
        $first_name = trim($_POST['first_name']);
        if (empty($first_name)) {
            $first_name_err = "Please Enter First Name";
        } elseif (!preg_match("/^[a-zA-Z0-9_]+$/", $first_name)) {
            $first_name_err = "First name can only contain letters, numbers, and underscores.";
        }

        $last_name = trim($_POST['last_name']);
        if (empty($last_name)) {
            $last_name_err = "Please Enter Last Name";
        } elseif (!preg_match("/^[a-zA-Z0-9_]+$/", $last_name)) {
            $last_name_err = "Last name can only contain letters, numbers, and underscores.";
        }

        $comment = $_POST['comment'];
        if(empty($comment))
        {
            $comment_err = "Please enter your comments";
        }


        if (empty($first_name_err) && empty($last_name_err) && empty($comment_err)) {
            $sql = "INSERT INTO comment (FirstName, LastName, Comment) VALUES  ('$first_name', '$last_name', '$comment')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $success = "comments Added successfully";
                header("Location: index.php");
                exit;
            } else {
                print($sql);
                $faild = "Faild to insert" .  mysqli_connect_error();
            }
        }
    }
} else {
    /*$faild = "Failed To Insert";
    header("Location: register.php");
    exit;*/
}
?>

<main>
    <nav class="main-nav" id="navbar">
        <?php
        if (isset($_SESSION['email'])) {
        ?><a href="profile.php" class="nav">Profile</a><?php
                                                    }
                                                        ?>
        <a href="courses.php?Category=backend" class="nav">Back-End Course</a>
        <a href="courses.php?Category=frontend" class="nav">Front-End Course</a>
        <a href="" class="nav">About us</a>
        <?php
        if (isset($_SESSION['email'])) {
        ?><a href="logout.php" class="nav">Logout</a><?php
                                                    } else { ?>
            <a href="login.php" class="nav">Login</a><?php
                                                    }
                                                        ?>
        <a onclick="CloseMenu()" class="nav">Close</a>
    </nav>
    <section class="container">
        <h1 class="section-header">Leave a comment</h1>
        <span><?= $success; ?></span><span><?= $faild; ?></span>
        <div class="form-register">
            <form action="" method="POST">
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" name="first_name" id="first_name" value="<?= $first_name ?>" class="form-control" placeholder="Enter First Name" />
                </div>
                <span><?= $first_name_err; ?></span>
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" name="last_name" id="last_name" value="<?= $last_name ?>" class="form-control" placeholder="Enter Last Name" />
                </div>
                <span><?= $last_name_err; ?></span>
                <div class="form-group">
                    <label for="comment">comment</label>
                    <textarea id="comment" name="comment" cols="30" rows="100"></textarea>
                </div>
                <span><?= $comment_err; ?></span>
                <div class="form-group">
                    <button type="submit" name="send" id="send" class="send-btn">Save</button>
                    <button type="reset" name="Cancel" id="Cancel" class="send-btn cancel">Cancel</button>
                </div>
            </form>
        </div>
    </section>
</main>
<?php
require 'template/footer.php'
?>
