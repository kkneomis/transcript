<?php
$link = mysqli_connect('kakpovicom.fatcowmysql.com', 'kkneomis', 'password', 'first'); 
if (!$link) { 
    die('Could not connect: ' . mysql_error()); 
} 

  if($_POST['submit'])  {

     
     $year = $_POST['trm_yr'];
     $season = $_POST['trm_season'];
     $university = $_POST['uni_id'];
     $id = substr($season, 0, 3).substr($year, 2, 4);   
        
    $query = "INSERT INTO TERM VALUES ('$id', '$year', '$season', '$university')";
    mysqli_query($link, $query);
   }

if(isset($_POST['deleteItem']))
{
  // here comes your delete query: use $_POST['deleteItem'] as your id
    $delete = $_POST['deleteItem'];
    $query = "DELETE FROM TERM where TRM_ID = '$delete'"; 
    mysqli_query($link, $query);

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Transcript</title>

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
     <h2>Terms</h2>
     <div class="row">
         <div class="col s6">
          <div class="row">
            <form class="col s12" method="post">
                
            <div class="row"> 
                <div class="input-field col s8">
                    <select  class="browser-default" id="trm_yr" name="trm_yr">
                      <option value="" disabled selected>Choose a year</option>  
                      <option value="2015">2015</option>
                      <option value="2016">2016</option>
                      <option value="2017">2017</option>
                      <option value="2018">2018</option>
                      <option value="2019">2019</option>
                      <option value="2020">2020</option>
                      <option value="2021">2021</option>
                      <option value="2022">2022</option>
                      <option value="2023">2023</option>
                    </select>
                </div>
            </div>
                
            <div class="row"> 
                <div class="input-field col s8">
                    <select  class="browser-default" id="trm_season" name="trm_season">
                      <option value="" disabled selected>Choose a term</option>  
                      <option value="SPRING">Spring</option>
                      <option value="FALL">Fall</option>
                      <option value="WINTER">Winter</option>
                    </select>
                </div>
            </div>
            
            <div class="row"> 
                <div class="input-field col s8">
                  <select class="browser-default"  name="uni_id" id ="uni_id">
                    <option value="" disabled selected>Choose your University</option>
                    <?php
                        if( $result= mysqli_query($link, "SELECT * FROM UNIVERSITY")) {   
                              while ($row = mysqli_fetch_array($result)) {
                                    echo '<option value="'.$row[UNI_ID].'">'. $row[UNI_ID] .'</option>';
                               }
                             } 
                        ?>
                  </select>
                </div>
            </div> 

             <input class="btn waves-effect waves-light light-blue" type="submit" name="submit" value="submit">

            </form>
          </div>
        </div><!-----cols6---->
         

         
        <div class="col s6">
            <form  method="post">
              <table class="highlight">
                <thead>
                  <tr>
                      <th data-field="trm_id">ID</th>
                      <th data-field="trm_yr">Year</th>
                      <th data-field="trm_season">Season</th>
                      <th data-field="trm_season">University</th>
                  </tr>
                </thead>

                <tbody>
                <?php    
                    if( $result= mysqli_query($link, "SELECT * FROM TERM")) {

                        while ($row = mysqli_fetch_array($result)) {
                         echo '<tr>';
                            echo '<td>' . $row[TRM_ID] .  '</td>';
                            echo '<td>' . $row[TRM_YR] . '</td>';
                            echo '<td>' . $row[TRM_SEASON] . '</td>';
                            echo '<td>' . $row[UNI_ID] . '</td>';
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
            </form>
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
