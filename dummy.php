
<?php


if(isset($_POST['addpickup']))
{
    $usn=$_POST['usn'];
    $name=$_POST['name'];
    $class=$_POST['class'];
    $pick=$_POST['pick'];
    addpickup($usn,$name,$class,$pick);
}
if(isset($_POST['logout']))
{
  session_destroy();
  header("location:index.php");
}
if(isset($_GET['errorStatus']))
{
  $error=$_GET['error'];
  $errorStatus = $_GET['errorStatus'];
  $errorMessage = $_GET['errorMessage'];
}
if(isset($_GET['deleteuser']))
{
    $id=$_GET['deleteuser'];
    deleteuser($id);
}


















//add student
function addpickup($usn,$name,$class,$pick)
{
  include "db.php";

$result=mysqli_query($conn,"insert into user (usn,name,class,pick_up) values ('$usn','$name','$class','$pick')");
if($result)
	{
  header("location:home.php?errorMessage=Registration_success&errorStatus=_New_Student_Added&error=success");
	}
else
	{
   header("location:home.php?errorMessage=Registration_Failed&errorStatus=_Please_Try_Again&error=danger");
	}
}



// view student
function viewuser()
{
  include "db.php";
$result=mysqli_query($conn,"select * from user order by f_id desc");
while($row= mysqli_fetch_array($result))
{
  ?>
     <tr>
      <th scope="row"><?php echo $row["0"]; ?></th>
      <th><?php echo $row["1"]; ?></th>
      <td><?php echo $row["2"]; ?></td>
      <td><?php echo $row["3"]; ?></td>
      <td><?php echo $row["4"]; ?></td>
      <td><?php echo $row["5"]; ?></td>
      <td width="10%">
      	<a href="?deleteuser=<?php echo $row['1']; ?>" name="deleteuser" class="btn btn-danger">Delete</a>
    </tr>
<?php
}}


//delete User
function deleteuser($id)
{
    include "db.php";

$result=mysqli_query($conn,"delete from user where usn='$id'");

if($result)
	{
        echo "<script>alert('Deleted successful');</script>";
    }
    else
    {
        echo "<script>alert('Try again');</script>";
    }
}