<?php
require 'template/header.php';
if (!isset($_SESSION['email'])) {
    redirect('login.php');
}
if(isset($_POST['AddButton'])){
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $sql="INSERT INTO course   (CourseName, Description, Category) VALUES ('$_POST[CourseName]','$_POST[Description]','$_POST[Category]')";
        if(mysqli_query($conn,$sql)){
            $message=" $_POST[CourseName] Course Has Been Added Successfully";
        }
        else{
            $message="$_POST[CourseName] Course Has not Added Successfully";
        }
        
    }
}
if(isset($_POST['UpdateButton'])){
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $sql="UPDATE course SET CourseName = '$_POST[CourseName]' , Description='$_POST[Description]' , Category='$_POST[Category]' WHERE ID ='$_POST[ID]' ";
        if(mysqli_query($conn,$sql)){
            $message=" $_POST[CourseName] Course has been updated successfully";
        }
        else{
            print ($sql);
            $message="$_POST[CourseName] Course has not updated successfully";
        }
        
    }  
}
if(isset($_POST['RemoveButton'])){
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $sql="DELETE FROM course WHERE ID = '$_POST[ID]'";
        if(mysqli_query($conn,$sql)){
            $message=" $_POST[CourseName] Course Has Been Removed Successfully";
        }
        else{
            print ($sql);
            $message="$_POST[CourseName] Course Has not Removed Successfully";
        }
        
    }  
}
?>
<main id="TeacherPage">
<nav class="main-nav" id="navbar">
                    
                    <a href="courses.php?Category=backend" class="nav">Back-End Course</a>
                    <a href="courses.php?Category=frontend" class="nav">Front-End Course</a>
                    <a href="" class="nav">About us</a>
                    <?php
                    if (isset($_SESSION['email'])) {
                                    ?><a href="logout.php" class="nav">Logout</a><?php
                                } else {?>
                                    <a href="login.php" class="nav">Login</a><?php
                                }
                    ?>
                    <a onclick="CloseMenu()" class="nav">Close</a>
                </nav>
    <a href="editprofile.php"><img class="cover" src="html.png" alt="Profile cover" width="100%" height="120px"/></a>
    <a href="editprofile.php"><img class="profile" src="47.jpg" alt="Profile Image" width="40%" height="120px"/></a>
    <a href="editprofile.php" class="UserName"><h2 class="UserName">Suha Kamal</h2></a>
  
    <section class="CoursesTableSection">
    <h4 class="message"><?=$message?></h4>
    <h2 class="CourseTableHeading">Courses List</h2>
        <?php
        $sql = "SELECT * FROM course";
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) > 0 ){?>
            <table>
                    <tr>
                        <th>ID</th>
                        <th>Course Name</th>
                        <th>Description</th>
                        <th>Category</th>
                    </tr>
            <?php while($row = mysqli_fetch_assoc($result)){ ?>
                    <tr>
                        <td><?=$row['ID']?></td>
                        <td><?=$row['CourseName']?></td>
                        <td><?=$row['Description']?></td>
                        <td><?=$row['Category']?></td>
                    </tr>
           
            <?php }
            }else{
                echo "Please Add Courses to view";
            }?>
             </table>
    </section>

    <section class="UpdateSection">
    <h2 class="CourseTableHeading">Update Section</h2>
    <form action="" method="POST">
                        <div class="form-group">
                            <label for="ID">ID</label>
                            <input type="text" name="ID" id="ID" class="form-control" placeholder="Only Require On Update and Remove"  />
                        </div>
                        <div class="form-group">
                            <label for="CourseName">Course Name</label>
                            <input type="text" name="CourseName" id="CourseName"  class="form-control" placeholder="Enter Course Name" required />
                        </div>
                        <div class="form-group">
                            <label for="Description">Description</label>
                            <input type="text" name="Description" id="Description"   class="form-control" placeholder="Description" required  />
                        </div>
                        <div class="form-group">
                            <label for="Category">Category</label>
                            <input type="text" name="Category" id="Category"   class="form-control" placeholder="Category"  required />
                        </div>
                        <div class="form-group">
                            <button type="submit" name="AddButton" id="send" value="Add" class="send-btn">Add</button>
                            <button type="submit" name="UpdateButton" id="send" value="Update" class="send-btn">Update</button>
                            <button type="submit" name="RemoveButton" id="send" value="Remove" class="send-btn">Remove</button>
                            <button type="reset" name="Cancel" id="Cancel" class="send-btn cancel">Cancel</button>
                        </div>
                        
                    </form>
    <section>
</main>
<?php require 'template/footer.php' ?>