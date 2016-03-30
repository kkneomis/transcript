<?php
$link = mysqli_connect('kakpovicom.fatcowmysql.com', 'kkneomis', 'password', 'first'); 
if (!$link) { 
    die('Could not connect: ' . mysql_error()); 
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
        <li><a href="index.php">Student</a></li>
        <li><a href="courses.php">Courses</a></li>
        <li><a href="schools.php">Schools</a></li>
        <li><a href="terms.php">Terms</a></li>
        <li><a href="performance.php">Grades</a></li>
        <li><a href="transcripts.php">Transcript</a></li>
      </ul>

      <ul id="nav-mobile" class="side-nav">
        <li><a href="index.php">Student</a></li>
        <li><a href="courses.php">Courses</a></li>
        <li><a href="schools.php">Schools</a></li>
        <li><a href="terms.php">Terms</a></li>
        <li><a href="performance.php">Grades</a></li>
        <li><a href="transcripts.php">Transcript</a></li>
      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
  </nav>
    
 <div class="container"> 
     <h2>Transcripts</h2>
     <div class="row">
         <div class="col s12">
           <form class="col s12" method="post">
            <div class="row"> 
                <div class="input-field col m4">
                  <select class="browser-default"  name="stu_id" id ="stu_id">
                    <option value="" disabled selected>Select a Student</option>
                    <?php
                        if( $result= mysqli_query($link, "SELECT * FROM STUDENT")) {   
                              while ($row = mysqli_fetch_array($result)) {
                                    echo '<option value="'.$row[STU_ID].'">'.$row[STU_NAME].'</option>';
                               }
                             } 
                        ?>
                  </select>
                </div>
                <div class="input-field col m4">
                  <select class="browser-default"  name="trm_id" id ="trm_id">
                    <option value="" disabled selected>Select a Term</option>
                    <?php
                        if( $result= mysqli_query($link, "SELECT * FROM TERM")) {   
                              while ($row = mysqli_fetch_array($result)) {
                                    echo '<option value="'.$row[TRM_ID].'">'.$row[TRM_ID].'</option>';
                               }
                             } 
                        ?>
                  </select>
                </div>
                <div class="input-field col m4">
                  <select class="browser-default"  name="crs_id" id ="crs_id">
                    <option value="" disabled selected>Select a Course</option>
                    <?php
                        if( $result= mysqli_query($link, "SELECT * FROM COURSE")) {   
                              while ($row = mysqli_fetch_array($result)) {
                                    echo '<option value="'.$row[CRS_ID].'">'.$row[CRS_NAME].'</option>';
                               }
                             } 
                        ?>
                  </select>
                </div>
            </div>
               
               <input class="btn waves-effect waves-light light-blue" type="submit"   name="submit" value="submit">
                
             
            </form>
          </div>
        </div><!-----cols6---->
         
             <?php
                    if($_POST['submit'])  {
                       $student = $_POST['stu_id'];
                       $query = 'SELECT * FROM STUDENT WHERE STU_ID = "'.$student.'"';

                        if( $result= mysqli_query($link, $query)) {
                          while ($row = mysqli_fetch_array($result)) {  
                               echo '<b>Student Name:</b> '. $row[STU_NAME].'<br>';
                               echo '<b>School/College:</b> '. $row[SCHL_ID];
                          }
                        } else {

                            echo "it failed";

                            }
                        
                        }

              ?>
         
        <div class="col s6">
              <table class="highlight">
                <thead>
                  <tr>
                      <th data-field="stu_id">Course</th>
                      <th data-field="trm_id">Term</th>
                      <th data-field="pfm_grade">Grade</th>
                  </tr>
                </thead>

                <tbody>
                <?php
                    if($_POST['submit'])  {

                         $student = $_POST['stu_id'];
                         $term = $_POST['trm_id'];
                         $course = $_POST['crs_id'];
                        
                         $trm_query= ' PERFORMANCE.TRM_ID =  "'.$term.'" AND';
                         $crs_query= ' COURSE.CRS_ID =  "'.$course.'" AND';
                         $stu_query= ' STU_ID = "'.$student.'" AND';

                          $top_query = 'SELECT COURSE.CRS_ID, COURSE.CRS_NAME, PERFORMANCE.TRM_ID, PERFORMANCE.PFM_GRADE
                                    FROM PERFORMANCE, COURSE, TERM
                                    WHERE ';
                              
                           $bot_query=' PERFORMANCE.CRS_ID = COURSE.CRS_ID
                                    AND PERFORMANCE.TRM_ID = TERM.TRM_ID';
                        
                           $options = array($trm_query, $crs_query); 
                           $midquery = '';
                        
                            if(!empty($student)){
                               $midquery = $midquery.$stu_query;
                            }    
                        
                            if(!empty($term)){
                               $midquery = $midquery.$trm_query;
                            }
                        
                            if(!empty($course)){
                               $midquery = $midquery.$crs_query;
                            }
                           
                        
                            $midquery.'<br>';
                        
                            $query = $top_query.$midquery.$bot_query;
                        
                        if(empty($student.$term.$course)){
                            $query='';
                        }
                        
                        echo $query;
                    
                    if( $result= mysqli_query($link, $query)) {
                        while ($row = mysqli_fetch_array($result)) {
                          echo '<tr>';
                            echo '<td>' . $row[CRS_NAME] . '</td>';
                            echo '<td>' . $row[TRM_ID] . '</td>';
                            echo '<td>' . $row[PFM_GRADE] . '</td>';
                          echo '</tr>';
                       }

                    } else {

                        echo "it failed";

                        }
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
