<?php
// login
function login($email,$password)
{

$password=$_POST['password'];
$email=$_POST['email'];

include "db.php";

$student=mysqli_query($conn,"select * from user where email='$email' and password='$password'");

if(mysqli_num_rows($student)==1)
  {
    while ($row= mysqli_fetch_array($student)) 
      {
      $_SESSION["usn"]=$row[1]; 
      }
    header("Location:home.php");
  }
else 
  {        	
    $staff=mysqli_query($conn,"select * from staff where email='$email' and password='$password'");

      if(mysqli_num_rows($staff)==1)
        {
          while ($row= mysqli_fetch_array($staff)) 
            {
              $_SESSION["t_usn"]=$row[1];
              $_SESSION["dept"]=$row[3];
              $_SESSION["role"]=$row[6];
              // echo $_SESSION["role"];
              // echo $_SESSION["dept"];
              // echo $_SESSION["t_usn"];
            }
          if($_SESSION["role"]=="Teacher")
            {
              header("Location:teacher.php");
            }
          if($_SESSION["role"]=="Admin")
            {
              header("location:admin.php");
            }
        }
      else
        {
          header("location:index.php?errorMessage=Login_Failed&errorStatus=_Please_Try_Again");
        }
  }
}

// My attenance
function viewattend()
{

  include "db.php";
  $usn=$_SESSION["usn"];
$result=mysqli_query($conn,"SELECT `user`.name,`user`.usn, SUM(HOUR(`attenance`.hours)) AS attended, `class`.course,HOUR(`class`.total_hours) AS total,`class`.total_class, `staff`.name,`staff`.dept FROM `user` LEFT JOIN `attenance` ON `attenance`.`s_id` = `user`.`usn` LEFT JOIN `class` ON `attenance`.`course` = `class`.`c_id` LEFT JOIN `staff` ON `class`.`f_id` = `staff`.`t_usn` where usn='$usn' group by course");
while($row= mysqli_fetch_array($result))
{
  ?>
     <tr>
      <th scope="row"><?php echo $row["1"]; ?></th>
      <th><?php echo $row["0"]; ?></th>
      <td><?php echo $row["3"]; ?></td>
      <td><?php echo $row["2"]; ?></td>
      <td><?php echo $row["4"]; ?></td>
      <td><?php echo $row["5"]; ?></td>
      <td><?php echo $row["6"]; ?></td>
      <td><?php echo $row["7"]; ?></td>
    </tr>
<?php
}}

// view Profile
function viewprofile()
{
  include "db.php";
  $usn=$_SESSION["usn"];
$result=mysqli_query($conn,"Select * from user where usn='$usn'");
while($row= mysqli_fetch_array($result))
{
  ?>
  <h3><p>Name: <?php echo $row["2"]; ?></p>
  <p class="text-muted">
  USN: <?php echo $row["1"]; ?>
  </p>
   <p>
  Email: <?php echo $row["3"]; ?>
  </p>
  <p>Department: <?php echo $row["4"]; ?></p>
  </h3>
<?php
}}


// view student
function viewstudent()
{
  include "db.php";
  $dpt=$_SESSION["dept"];
$result=mysqli_query($conn,"Select * from user where dept='$dpt'");
while($row= mysqli_fetch_array($result))
{
  ?>
     <tr>
      <th scope="row"><?php echo $row["2"]; ?></th>
      <th><?php echo $row["1"]; ?></th>
      <td><?php echo $row["3"]; ?></td>
      <td><?php echo $row["5"]; ?></td>
      <td><?php echo $row["4"]; ?></td>
    </tr>
<?php
}}



//add student
function addstudent($usn,$name,$email,$sem)
{
  include "db.php";
  $dpt=$_SESSION["dept"];
  $pass="$usn$dpt";
  $role="Student";
$result=mysqli_query($conn,"insert into user (usn,name,email,dept,sem,role,password) values ('$usn','$name','$email','$dpt','$sem','$role','$pass')");
if($result)
  {
  header("location:teacher.php?errorMessage=Registration_success&errorStatus=_New_Student_Added&error=success");
  }
else
  {
   header("location:teacher.php?errorMessage=Registration_Failed&errorStatus=_Please_Try_Again&error=danger");
  }
}


// view student attendance
function viewstdattend()
{
  include "db.php";
  $tusn=$_SESSION["t_usn"];
$result=mysqli_query($conn,"SELECT `user`.name,`user`.usn,`user`.dept,`user`.sem,`attenance`.id,`attenance`.hours AS attended,`class`.course,HOUR(`class`.total_hours) AS total,`staff`.name , `attenance`.created_at AS date
FROM `user` 
  LEFT JOIN `attenance` ON `attenance`.`s_id` = `user`.`usn` 
  LEFT JOIN `class` ON `attenance`.`course` = `class`.`c_id` 
  LEFT JOIN `staff` ON `class`.`f_id` = `staff`.`t_usn` where t_usn='$tusn';");
while($row= mysqli_fetch_array($result))
{
  ?>
     <tr>
      <th scope="row"><?php echo $row["0"]; ?></th>
      <th><?php echo $row["1"]; ?></th>
      <td><?php echo $row["2"]; ?></td>
      <td><?php echo $row["3"]; ?></td>
      <td><?php echo $row["6"]; ?></td>
      <td><?php echo $row["5"]; ?></td>
      <th><?php echo $row["9"]; ?></th>
      <th><a href="?editattend=<?php echo $row[4]; ?>" name="editattend" class="btn btn-success">Edit</a></th>
    </tr>
<?php
}}



//edit attendance
function editattend($id){
    include "db.php";
$result=mysqli_query($conn,"SELECT `class`.course,`attenance`.id, `attenance`.hourss,`attenance`.created_at, `user`.name FROM `class` LEFT JOIN `attenance` ON `attenance`.`course` = `class`.`c_id` LEFT JOIN `user` ON `attenance`.`s_id` = `user`.`usn` where `attenance`.id='$id'");
while($row= mysqli_fetch_array($result))
{
  ?>
  <div class="modal show" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: block;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
      </div>
      <div class="modal-body">
          <form method="post" enctype="multipart/form-data" >
            <input type="text" value="<?php echo $row["1"]; ?>" name="id" hidden>
            <div class="form-group">
               <label for="exampleInputEmail1">Student Name</label>
               <input type="text" name="name" class="form-control" value="<?php echo $row["4"]; ?>" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Item name" disabled>
            </div>
            <div class="form-group">
               <label for="exampleInputqty">Course</label>
               <input type="text" name="course" value="<?php echo $row["0"]; ?>" class="form-control" id="exampleInputqty" placeholder="Quantity" disabled>
            </div>
            <div class="form-group">
               <label for="exampleInputPassword1">Hours Attended</label>
               <input type="datetime" name="hours" value="<?php echo $row["2"]; ?>" class="form-control" id="exampleInputPassword1" placeholder="Price">
            </div>
            <div class="form-group">
               <label for="exampleInputqty">Class Date</label>
               <input type="datetime" name="created_at" value="<?php echo $row["3"]; ?>" class="form-control" id="exampleInputqty" placeholder="Quantity" disabled>
            </div>
            <button  type="Submit" name="updateattend" class="btn btn-primary mt-2">Submit</button>
          </form>
      </div>
      <div class="modal-footer">
        <a href="attenance.php" type="button" class="btn btn-secondary">Close</a>
      </div>
    </div>
  </div>
</div>
<?php
}}



//update attendance
function updateattend($id,$hours)
{

  include "db.php";
$result=mysqli_query($conn,"UPDATE attenance SET hours='$hours' WHERE id='$id'");
if($result)
  {
  echo "<script>alert('Updated successful');</script>";
  }
else
  {
   echo "<script>alert('Try again');</script>";
  }
}



// view staff course
function viewmycourse()
{
  include "db.php";
  $tusn=$_SESSION["t_usn"];
$result=mysqli_query($conn,"SELECT * FROM `class` WHERE f_id='$tusn'");
while($row= mysqli_fetch_array($result))
{
  ?>
     <tr>
      <th scope="row"><?php echo $row["3"]; ?></th>
      <th><?php echo $row["4"]; ?></th>
      <td><?php echo $row["5"]; ?></td>
      <th><a href="?editcourse=<?php echo $row[0]; ?>" name="editcourse" class="btn btn-success">Edit</a></th>
    </tr>
<?php
}}


//edit course
function editcourse($id){
    include "db.php";
$result=mysqli_query($conn,"SELECT * FROM `class` WHERE id='$id'");
while($row= mysqli_fetch_array($result))
{
  ?>
  <div class="modal show" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: block;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
      </div>
      <div class="modal-body">
          <form method="post" enctype="multipart/form-data" >
            <input type="text" value="<?php echo $row["0"]; ?>" name="id" hidden>
            <div class="form-group">
               <label for="exampleInputqty">Course</label>
               <input type="text" name="course" value="<?php echo $row["3"]; ?>" class="form-control" id="exampleInputqty" placeholder="Quantity" disabled>
            </div>
            <div class="form-group">
               <label for="exampleInputPassword1">Total Hours taken</label>
               <input type="datetime" name="hours" value="<?php echo $row["4"]; ?>" class="form-control" id="exampleInputPassword1" placeholder="Price">
            </div>
            <div class="form-group">
               <label for="exampleInputqty">Total Class</label>
               <input type="number" name="class" value="<?php echo $row["5"]; ?>" class="form-control" id="exampleInputqty" placeholder="Quantity">
            </div>
            <button  type="Submit" name="updateclass" class="btn btn-primary mt-2">Submit</button>
          </form>
      </div>
      <div class="modal-footer">
        <a href="attenance.php" type="button" class="btn btn-secondary">Close</a>
      </div>
    </div>
  </div>
</div>
<?php
}}



//update course
function updateclass($id,$hours,$class)
{

  include "db.php";
$result=mysqli_query($conn,"UPDATE class SET total_hours='$hours', total_class='$class' WHERE id='$id'");
if($result)
  {
  echo "<script>alert('Updated successful');</script>";
  }
else
  {
   echo "<script>alert('Try again');</script>";
  }
}



// view staff
function viewstaff()
{
  include "db.php";
$result=mysqli_query($conn,"Select * from staff");
while($row= mysqli_fetch_array($result))
{
  ?>
     <tr>
      <th scope="row"><?php echo $row["1"]; ?></th>
      <th><?php echo $row["2"]; ?></th>
      <td><?php echo $row["4"]; ?></td>
      <th><?php echo $row["5"]; ?></th>
      <td><?php echo $row["3"]; ?></td>
      <td><?php echo $row["6"]; ?></td>
    </tr>
<?php
}}



//add staff
function addstaff($tusn,$name,$email,$role,$dept,$phone)
{
  include "db.php";
  $pass="$tusn$phone";
$result=mysqli_query($conn,"insert into staff (t_usn,name,email,dept,role,phone,password) values ('$tusn','$name','$email','$dept','$role','$phone','$pass')");
if($result)
  {
  header("location:admin.php?errorMessage=Registration_success&errorStatus=_New_Student_Added&error=success");
  }
else
  {
   header("location:admin.php?errorMessage=Registration_Failed&errorStatus=_Please_Try_Again&error=danger");
  }
}





// view course
function viewcourse()
{
  include "db.php";
$result=mysqli_query($conn,"Select * from class");
while($row= mysqli_fetch_array($result))
{
  ?>
     <tr>
      <th scope="row"><?php echo $row["1"]; ?></th>
      <th><?php echo $row["3"]; ?></th>
      <td><?php echo $row["2"]; ?></td>
      <th><?php echo $row["5"]; ?></th>
    </tr>
<?php
}}



// view faculty
function viewfaculty()
{
  include "db.php";
$result=mysqli_query($conn,"Select * from staff where role='Teacher'");
while($row= mysqli_fetch_array($result))
{
  ?>
                <option value="<?php echo $row["1"]; ?>"><?php echo $row["2"]; ?></option>
<?php
}}


//add course
function  addcourse($c_id,$course,$f_id)
{
  include "db.php";

$result=mysqli_query($conn,"INSERT INTO class (c_id,f_id,course) VALUES ('$c_id','$f_id','$course')");
if($result)
  {
  header("location:course.php?errorMessage=Course_Added_success&errorStatus=_New_Student_Added&error=success");
  }
else
  {
   header("location:course.php?errorMessage=Failed&errorStatus=_Please_Try_Again&error=danger");
  }
}





?>