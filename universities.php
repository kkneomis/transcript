<?php
$link = mysqli_connect('kakpovicom.fatcowmysql.com', 'kkneomis', 'password', 'first'); 
if (!$link) { 
    die('Could not connect: ' . mysql_error()); 
} 

  if($_POST['submit'])  {

     $id = $_POST['uni_id'];
     $name = $_POST['uni_name'];
     $location = $_POST['uni_location'];
   
        
    $query = "INSERT INTO UNIVERSITY VALUES ('$id', '$name', '$location')";
    mysqli_query($link, $query);


   }

if(isset($_POST['deleteItem']))
{
  // here comes your delete query: use $_POST['deleteItem'] as your id
    $delete = $_POST['deleteItem'];
    $query = "DELETE FROM TERM where UNI_ID = '$delete'"; 
    mysqli_query($link, $query);

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Transcript System</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
<nav class="light-blue lighten-1" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo">Transcript System</a>
      <ul class="right hide-on-med-and-down">
        <li><a class="dropdown-button" href="#!" data-activates="dropdown1">Administrator<i class="material-icons right">arrow_drop_down</i></a></li>
        <li><a href="transcripts.php">Transcript</a></li>
      </ul>

    <ul id="dropdown1" class="dropdown-content">
        <li><a href="index.php">Student</a></li>
        <li><a href="courses.php">Courses</a></li>
        <li><a href="schools.php">Schools</a></li>
        <li><a href="terms.php">Terms</a></li>
        <li><a href="performance.php">Grades</a></li>
        <li><a href="universities.php">Universities</a></li>
    </ul>
        
      <ul id="nav-mobile" class="side-nav">
        <li><a href="index.php">Student</a></li>
        <li><a href="courses.php">Courses</a></li>
        <li><a href="schools.php">Schools</a></li>
        <li><a href="terms.php">Terms</a></li>
        <li><a href="performance.php">Grades</a></li>
        <li><a href="universities.php">Transcript</a></li>
      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
  </nav>
    
 <div class="container"> 
     <h2>Universities</h2>
     <div class="row">
         <div class="col s6">
          <div class="row">
            <form class="col s12" method="post">
              <div class="row">
                <div class="input-field col s10">
                  <input value="" id="uni_id" name="uni_id" type="text" class="validate">
                  <label for="uni_id">University ID</label>
                </div>
            </div>

            <div class="row"> 
                <div class="input-field col s10">
                  <input id="uni_name" name="uni_name" type="text" class="validate">
                  <label for="uni_name">University Name</label>
                </div>
            </div>

            <div class="row"> 
                <div class="input-field col s10">
                  <input id="uni_location" name="uni_location" type="text" class="validate">
                  <label for="uni_location">University Location</label>
                </div>
            </div>
             <input class="btn waves-effect waves-light light-blue" type="submit"   name="submit" value="submit">

            </form>
          </div>
        </div><!-----cols6---->
         
         
        <div class="col s6">
              <table class="highlight">
                <thead>
                  <tr>
                      <th data-field="uni_id">University ID</th>
                      <th data-field="uni_name">Name</th>
                      <th data-field="uni_location">Location</th>
                  </tr>
                </thead>

                <tbody>
                <?php    
                 $query = "SELECT * FROM UNIVERSITY";

                    if( $result= mysqli_query($link, $query)) {

                        while ($row = mysqli_fetch_array($result)) {
                         echo '<tr>';
                            echo '<td>' . $row[UNI_ID] .  '</td>';
                            echo '<td>' . $row[UNI_NAME] . '</td>';
                            echo '<td>' . $row[UNI_LOCATION] . '</td>';
                            echo '<td><button class="waves-effect waves-light-blue btn-flat" type="submit" name="deleteItem" value="'.$row[TRM_ID].'" >
                                    <i class="material-icons">delete</i>
                                  </button></td>';
                          echo '</tr>';
                       }


                    } else {

                        echo "it failed";

                    }
                ?>
                      
                </tbody>
              </table>
            
        </div><!-----cols6---->
    </div><!----row--->
 </div>         
<br><br><br>

  <footer class="page-footer light-blue lighten-1">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text">Transcript System</h5>
          <p class="grey-text text-lighten-4">We are a team of college students working on this project like it's our full time job. Any amount would help support and continue development on this project and is greatly appreciated.</p>
        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
      Made by Team HU
      </div>
    </div>
  </footer>


  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

  </body>
</html>
