<?php
require 'template/header.php';
if (!isset($_SESSION['email'])) {
    redirect('login.php');
}
?>
<main>
    <article>
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
        <section class="course-container">
            <img src="html.png" alt="cource image" height="150" class="lec-img">
            <h1>HTML</h1>
            <aside class="lectures">
                <nav>

                    <?php
                    $sql = "SELECT * FROM lecture ";
                    //$sql = "SELECT * FROM lecture courseID = '$_GET['ID']'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) { ?>
                            <!--<a href="course.php?id=<?= $_GET['ID'] ?>&url=<?= $row['URL'] ?>&name=<?= $row['name'] ?>"><?= $row['CourseName'] ?></a>-->
                            <a href="course.php?ID=1&url=<?= $row['URL'] ?>&name=<?= $row['name'] ?>"><?= $row['Name'] ?></a>
                    <?php }
                    } else {
                        echo "0 result";
                    }
                    ?>
                </nav>
            </aside>
            <section class="lecture">
                <!--<iframe id="" src="https://youtube.com/embded/<?= $_GET['URL'] ?>" width="100%" height="300" title="<?= $_GET['name'] ?>" style="border:1px solid black;">
        </iframe>-->
                <?php if (!empty($_GET['desc'])) { ?>
                    <p><?= $_GET['desc'] ?></p>
                <?php } else { ?>
                    <iframe src="https://youtube.com/embded/<?= $_GET['url'] ?>" title="<?= $_GET['name'] ?>" width="100%" height="315" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></ifram>
                    <?php } ?>
            </section>
        </section>
    </article>
</main>
<?php require 'footer.php';
