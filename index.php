<!DOCTYPE html>
<html>
<head>  
<?php 
    /*
        *Author: Daryl Bargamento
        *Description: CV Automation Convert PDF
    */
  
  ?>
  <meta name="viewport"
    content="user-scalable=no, width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
  <title>
    CV Automation
  </title>
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
  <link rel="stylesheet" href="css/style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/bootstrap.css">
  <script src="js/jquery-3.6.0.min.js"></script>
</head>
<body class="body">
    <div class="row bg-black">
        <div class="container">
            <h1 class="text-center pt-4">RemotoDojo CV Generator</h1>
        </div>
    </div>
    
  <?php 
    $id = (isset($_GET['id'])) ? $_GET['id'] : 0 ;
    $servername  = 'localhost';
    $username    = 'root';
    $password    =  '';
    $dbname      = 'cvautomation';
    
    $conn = new mysqli($servername, $username, $password ,$dbname);
    // Check connection
    if ($conn -> connect_errno) {
            echo "Failed to connect to MySQL: " . $conn -> connect_error;
            exit();
    }
    $sql_fetch = "SELECT * FROM cvautomation WHERE id = '".$id."' ";
    $result = mysqli_query($conn, $sql_fetch);
    $row = $result->fetch_assoc();
    echo '<pre>';
      print_r($row);
    echo '</pre>';
    
      
  ?>
    <form action="submit.php" method="post">
        <div class="p-5">
          <div class="row mt-4">
            <div class="col col-lg-4 w-100 p-3">
              <div class="field_wrapper">
                  <div class="field">
                      <div class="form-group">
                        <input type="text" name='name' class="form-control" value="<?= $name = ($row) ? $row['name'] : '';?>" placeholder="Name">
                        <input type="text" name='position' class="form-control" value="<?= $position = ($row) ? $row['position'] : '';?>" placeholder="Position">
                        <textarea name="applicant_info" id="" class="form-control" cols="30" rows="4" placeholder="Object/Applicant Information..."><?=$applicant = ($row) ? $row['applicant-information'] : '';?></textarea>
                      </div>
                        
                      <!-- div for skills fields -->
                      <div class="field_skills left-title" id="field_skills"> 
                        <h1>Skills</h1>
                          <textarea name="field_skills" id="" class="form-control" cols="30" rows="4" placeholder="Skills"><?= $skills = ($row) ? $row['skills'] : '';?></textarea>
                      </div>
                      <div class="achievements left-title" id="achievements"> 
                        <h1>Achievements</h1>
                          <textarea name="achievements" id="" class="form-control" cols="30" rows="4" placeholder="Achievements"><?= $achvments = ($row) ? $row['achievements'] : '';?></textarea>
                      </div>
                      <div class="awards left-title" id="awards"> 
                        <h1>Awards</h1>
                        <textarea name="awards" id="" class="form-control" cols="30" rows="4" placeholder="Awards"><?= $awards = ($row) ? $row['awards'] : '';?></textarea>
                      </div>
                      <div class="portfolio left-title" id="awards"> 
                        <h1>Portfolio</h1>
                        <textarea name="portfolio" id="" class="form-control" cols="30" rows="4" placeholder="Portfolio"><?= $portfolio = ($row) ? $row['portfolio'] : '';?></textarea>
                      </div>
                  <!-- div for work experience fields -->
                  </div>
              </div> 
            </div>
            <!-- end col-->
            <div class="col col-lg-8 w-100 p-3">
                    <div class="educational_att" id="educational_att">
                      <h1>Educational Attainment</h1>
                        <div class="row">  
                          <div class="col-sm">
                          <input type="text" name="educational_att[course][]" class="form-input form-control" value="" placeholder="Course"/>
                          </div>
                          <div class="col-sm">
                          <input type="text" name="educational_att[school_name][]" class="form-input form-control" value="" placeholder="Name of school"/>
                          </div>
                          <div class="col-sm">
                          <input type="text" name="educational_att[year_graduate][]" class="form-input form-control" value="" placeholder="Year Graduate"/>
                          </div>
                          <a href="javascript:void(0);" class="add_edu_btn" title="Add Educational Attinment"><i class="fas fa-plus"></i>   </a>
                        </div>
                    </div>
                    <!-- end educational attinment -->

                    <div class="work_experience">
                <h1>Work Experience</h1>
                  <div class="row row1">
                    <div class="col-sm">
                      <input type="text" name="work_experience[start_date][]" class="form-input form-control" value="" placeholder="Duration of work"/>
                    </div>
                    <div class="col-sm">
                      <input type="text" name="work_experience[company_name][]" class="form-input form-control" value="" placeholder="Company Name"/>
                    </div>
                    <div class="col-sm">
                      <input type="text" name="work_experience[company_position][]" class="form-input form-control" value="" placeholder="Company Position"/>
                    </div>
                  </div>
                  <div class="row row2">
                    <div class="col-sm">
                      <textarea name="work_experience[duties_res][]" id="" class="form-control work-exp" cols="3" rows="1" placeholder="Duties Responsibilites"></textarea>
                    </div>
                    <div class="col-sm">
                      <textarea name="work_experience[projects][]" id="" class="form-control work-exp" cols="3" rows="1" placeholder="Projects"></textarea>
                    </div>
                    <a href="javascript:;" class="add_exp" title="Add field"><i class="fas fa-plus"></i></a>
                  </div>
              </div>
                    <!-- end work experience div -->
                      <div class="personal-freelance" id="personal-freelance">
                          <div class="row">
                            <h1>Personal Project / Freelance Projects</h1>
                          </div>
                          <div class="row">
                            <div class="col-sm">
                            <input type="text" name="personal[project_name][]" class="form-input form-control" value="" placeholder="Project Name"/>
                            </div>
                            <div class="col-sm">
                            <input type="text" name="personal[project_year][]" class="form-input form-control" value="" placeholder="Project Year"/>
                            </div>
                            <a href="javascript:;" class="add_person_prj_btn" title="Add Personal Projects"><i class="fas fa-plus"></i></a>
                          </div>
                      </div>
                      <!-- end personal-freelance -->
                      <div class="seminarstraining" id="seminarstraining">
                          <div class="row">
                            <h1>Seminars & Trainings </h1>
                          </div>
                          <div class="row">
                            <div class="col-sm">
                            <input type="text" name="seminars[seminar_name][]" class="form-input form-control" value="" placeholder="Seminar Name"/>
                            </div>
                            <div class="col-sm">
                            <input type="text" name="seminars[seminar_year][]" class="form-input form-control" value="" placeholder="Seminar Year"/>
                            </div>
                            <a href="javascript:;" class="add_seminar_btn" title="Add Seminars"><i class="fas fa-plus"></i></a>
                          </div>
                      </div>
                      <!-- end of seminars & training div-->

                      <div class="certification" id="certification">
                          <div class="row">
                            <h1>Certifications </h1>
                          </div>
                          <div class="row">
                            <div class="col-sm">
                            <input type="text" name="certification[cert_name][]" class="form-input form-control" value="" placeholder="Certifications Name"/>
                            </div>
                            <div class="col-sm">
                            <input type="text" name="certification[cert_year][]" class="form-input form-control" value="" placeholder="Certifications Year"/>
                            </div>
                            <a href="javascript:;" class="add_cert_btn" title="Add Seminars"><i class="fas fa-plus"></i></a>
                          </div>
                      </div>
                      <!-- end certifications div-->
                    <div class="row mt-2 p-2">
                      <input type="hidden" name='id' value="<?=$id;?>">
                      <input type="submit" name="submit" class="btn btn-primary" value="<?=($id) ? 'Update' : 'Add / Submit';?>">
                    </div>
                    <!-- end work experience -->
            </div>
          </div>            
            <!-- end first col -->               
        </div>
        
        <!-- end whole container-->
      
    </form>
    
  <script src="js/default.js"> </script>
</body>
</html>
