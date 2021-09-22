
 <?php 
 date_default_timezone_set('Asia/Manila');
 $todays_date = date("y-m-d h:i:sa");
 $today = strtotime($todays_date);
 
 
 $current_date = date("Y-m-d h:i:sa", $today);
 
    $id = (isset($_GET['id'])) ? $_GET['id'] : 0 ;
    $editedby = (isset($_GET['editby'])) ? $_GET['editby'] : 0;
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
    
  ?>
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
                          <textarea name="achievements" id="" class="form-control" cols="30" rows="4" placeholder="Achievements"><?=$achvments = ($row) ? $row['achievements'] : '';?></textarea>
                      </div>
                      <div class="awards left-title" id="awards"> 
                        <h1>Awards</h1>
                        <textarea name="awards" id="" class="form-control" cols="30" rows="4" placeholder="Awards"><?=$awards = ($row) ? $row['awards'] : '';?></textarea>
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
                          <?php 
                            if(isset($row['education'])): $edu_course = json_decode($row['education']); ?>
                              <div class="col-sm">
                              <?php foreach($edu_course as $jsn_cours):?>
                                <input type="text" name="educational_att[course][]" class="form-input form-control" value="<?=$jsn_cours?>" placeholder="Course"/>
                              <?php endforeach;?>
                              </div>
                              <?php else:?>
                                <div class="col-sm">
                                <input type="text" name="educational_att[course][]" class="form-input form-control" value="" placeholder="Course"/>
                                </div>
                            <?php endif; ?>
                            <!-- end of first col-->

                            <?php 
                            if(isset($row['name_of_school'])): $edu_n_of_schl = json_decode($row['name_of_school']);?>
                            <div class="col-sm">
                            <?php foreach($edu_n_of_schl as $schol):?>
                              <input type="text" name="educational_att[school_name][]" class="form-input form-control" value="<?=$schol;?>" placeholder="Name of school"/>
                            <?php endforeach;?>
                            </div>
                            <?php else:?>
                              <div class="col-sm">
                              <input type="text" name="educational_att[school_name][]" class="form-input form-control" value="" placeholder="Name of school"/>
                              </div>
                            <?php endif; ?>
                            <!-- end of 2nd col-->
                            <?php 
                            if(isset($row['year_gradute'])): $edu_year_grad = json_decode($row['year_gradute']);  ?>
                            <div class="col-sm">
                            <?php foreach($edu_year_grad as $grad):?>
                              <input type="text" name="educational_att[year_graduate][]" class="form-input form-control" value="<?=$grad;?>" placeholder="Year Graduate"/>
                            <?php endforeach;?>
                            </div>
                            <?php else:?>
                              <div class="col-sm">
                              <input type="text" name="educational_att[year_graduate][]" class="form-input form-control" value="" placeholder="Year Graduate"/>
                              </div>
                            <?php endif; ?>
                            <!-- end of 3rd col-->
                          
                          <a href="javascript:void(0);" class="add_edu_btn" title="Add Educational Attinment"><i class="fas fa-plus"></i>   </a>
                        </div>
                    </div>
                    <!-- end educational attinment -->

                    <div class="work_experience">
                <h1>Work Experience </h1>
                <?php 
                  if($id){
                    $dura_work = json_decode($row['duration_of_work'], true);
                    $comp_name = json_decode($row['company_name'], true);
                    $comp_pos  = json_decode($row['company_position'], true);            
                    $duties_res = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $row['duties_responsibilites']), true);
                    $projects = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $row['projects']), true);
                    
                  }
                ?>
                  <?php if($id):?>  
                    <div class="row row1">
                      <?php for($i = 0; $i<count($dura_work); $i++):?>
                          <div class="col-sm col-lg-4">
                              <input type="text" name="work_experience[start_date][]" class="form-input form-control" value="<?=$dura_work[$i];?>" placeholder="Duration of work"/>
                          </div>
                      <?php endfor;?>
                        <!-- end for loop duration of work-->
                        <?php for($i = 0; $i<count($comp_name); $i++):?>
                          <div class="col-sm col-lg-4">
                              <input type="text" name="work_experience[company_name][]" class="form-input form-control" value="<?=$comp_name[$i];?>" placeholder="Company Name"/>
                          </div>
                      <?php endfor;?>

                      <!-- end for loop company name-->
                      <?php for($i = 0; $i<count($comp_pos); $i++):?>
                          <div class="col-sm col-lg-4">
                              <input type="text" name="work_experience[company_position][]" class="form-input form-control" value="<?=$comp_pos[$i];?>" placeholder="Company Position"/>
                          </div>
                      <?php endfor;?>
                      <!-- end for loop company position-->
                    </div>
                      <!-- end row1 -->
                    
                    <div class="row row2">
                    <?php for($i = 0; $i<count($duties_res); $i++):?>
                          <div class="col-sm col-lg-6">
                          <textarea name="work_experience[duties_res][]" id="" class="form-control work-exp" cols="3" rows="1" placeholder="Duties Responsibilites"><?=$duties_res[$i];?></textarea>
                          </div>
                    <?php endfor;?>
                    
                    <?php for($i = 0; $i<count($projects); $i++):?>
                        <div class="col-sm col-lg-6">
                        <textarea name="work_experience[projects][]" id="" class="form-control work-exp" cols="3" rows="1" placeholder="projects"><?=$projects[$i];?></textarea>
                        </div>
                    <?php endfor;?>
                    <a href="javascript:;" class="add_exp" title="Add field"><i class="fas fa-plus"></i></a>
                    </div>
                    <?php else:?>
                      <div class="row row1">
                          <div class="col-sm">
                                <input type="text" name="work_experience[start_date][]" class="form-input form-control" value="<?php  ?>" placeholder="Duration of work"/>
                            </div>
                          <!-- end of duration columns-->
                            <div class="col-sm">
                                <input type="text" name="work_experience[company_name][]" class="form-input form-control" value="<?php echo (!empty($comp_name[0])) ? $comp_name[0] : '';?>" placeholder="Company Name"/>
                              </div>   
                          <!-- end of company name-->

                          <!-- end of company position-->
                          
                          <div class="col-sm">
                            <input type="text" name="work_experience[company_position][]" class="form-input form-control" value="<?php echo (!empty($comp_pos[0])) ? $comp_pos[0] : '';?>" placeholder="Company Position"/>
                          </div>
                          
                      </div>
                      <div class="row row2">
                    <div class="col-sm">
                      <textarea name="work_experience[duties_res][]" id="" class="form-control work-exp" cols="3" rows="1" placeholder="Duties Responsibilites"><?=empty($duties_res[0]) ? '' : $duties_res[0] ;?></textarea>
                    </div>
                    <div class="col-sm">
                      <textarea name="work_experience[projects][]" id="" class="form-control work-exp" cols="3" rows="1" placeholder="Projects"><?=empty($projects[0]) ? '' : $row['projects'] ;?></textarea>
                    </div>
                    <a href="javascript:;" class="add_exp" title="Add field"><i class="fas fa-plus"></i></a>
                  </div>
                  <?php endif;?>
                <!--
                  <div class="row row2">
                    <div class="col-sm">
                      <textarea name="work_experience[duties_res][]" id="" class="form-control work-exp" cols="3" rows="1" placeholder="Duties Responsibilites"><?=empty($duties_res[0]) ? '' : $duties_res[0] ;?></textarea>
                    </div>
                    <div class="col-sm">
                      <textarea name="work_experience[projects][]" id="" class="form-control work-exp" cols="3" rows="1" placeholder="Projects"><?=empty($projects[0]) ? '' : $row['projects'] ;?></textarea>
                    </div>
                    <a href="javascript:;" class="add_exp" title="Add field"><i class="fas fa-plus"></i></a>
                  </div>
                  --?
                  <!-- end if row2-->
              </div>
                    <!-- end work experience div -->
                      <div class="personal-freelance" id="personal-freelance">
                          <div class="row">
                            <h1>Personal Project / Freelance Projects</h1>
                          </div>
                          <div class="row">
                            <?php if(isset($row['personpan_project_name']) && isset($row['personal_project_year'])  && isset($row['personal_project_description']) ):
                               $json_per_name = json_decode($row['personpan_project_name']); 
                               $json_proj_yr = json_decode($row['personal_project_year']);
                               $json_proj_desc = json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/', '',  $row['personal_project_description']), true);
                               
                            ?>
                              <?php foreach($json_per_name as $per_name):?>
                                <div class="col-lg-6 col-sm">
                                  <input type="text" name="personal[project_name][]" class="form-input form-control" value="<?=$per_name?>" placeholder="Project Name"/>
                                </div>        
                              <?php endforeach;?>
                              <?php foreach($json_proj_yr as $proj_yr):?>
                                    <div class="col-lg-6 col-sm">
                                      <input type="text" name="personal[project_year][]" class="form-input form-control" value="<?=$proj_yr?>" placeholder="Project Year"/>
                                    </div>          
                                  <?php endforeach;?>
                              <?php foreach($json_proj_desc as $proj_desc):?>
                                <div class="col-lg-6 col-sm">
                                  <textarea name="personal[description][]" id="proj-dec" class="form-control work-exp" cols="3" rows="1" placeholder="Project Description"><?=$proj_desc;?></textarea>
                                </div>          
                              <?php endforeach;?>
                              <?php else:?>
                                <div class="col-lg-6 col-sm">
                                    <input type="text" name="personal[project_name][]" class="form-input form-control" value="" placeholder="Project Name"/>
                                </div>
                                <div class="col-lg-6 col-sm">
                                    <input type="text" name="personal[project_year][]" class="form-input form-control" value="" placeholder="Project Year"/>
                                  </div>
                                <div class="col-sm col-lg-8 text-center">
                                  <textarea name="personal[description][]" id="proj-dec" class="form-control work-exp" cols="3" rows="1" placeholder="Project Description"></textarea>
                                </div>
                            <?php endif;?>
                            <a href="javascript:;" class="add_person_prj_btn" title="Add Personal Projects"><i class="fas fa-plus"></i></a>
                          </div>
                      </div>
                      <!-- end personal-freelance -->
                      <div class="seminarstraining" id="seminarstraining">
                          <div class="row">
                            <h1>Seminars & Trainings </h1>
                          </div>
                          <div class="row">
                            <?php if(!empty($row['seminar_name']) && !empty($row['seminar_year'])):
                                $json_seminar_name = json_decode($row['seminar_name']);
                            ?>
                            <?php foreach($json_seminar_name as $seminar_name):?>
                              <div class="col-lg-6 col-sm">
                                <input type="text" name="seminars[seminar_name][]" class="form-input form-control" value="<?=$seminar_name?>" placeholder="Seminar Name"/>
                              </div>  
                            <?php endforeach;?>

                            <?php else:?>
                              <div class="col-lg-8 col-sm">
                                <input type="text" name="seminars[seminar_name][]" class="form-input form-control" value="" placeholder="Seminar Name"/>
                              </div>
                            
                            <?php endif;?>
                            
                            <a href="javascript:;" class="add_seminar_btn" title="Add Seminars"><i class="fas fa-plus"></i></a>
                          </div>
                      </div>
                      <!-- end of seminars & training div-->

                      <div class="certification" id="certification">
                          <div class="row">
                            <h1>Certifications </h1>
                          </div>
                          <div class="row">
                              <?php if(isset($row['certification_name']) && isset($row['certification_year'])): 
                                    $json_cert_name = json_decode($row['certification_name']);
                                ?>
                                  <?php foreach($json_cert_name as $cert_name):?>
                                    <div class="col-lg-6 col-sm">
                                      <input type="text" name="certification[cert_name][]" class="form-input form-control" value="<?=$cert_name ?>" placeholder="Certifications Name"/>
                                    </div>  
                                  <?php endforeach;?>
                              <?php else:?>
                                <div class="col-lg-8 col-sm">
                                      <input type="text" name="certification[cert_name][]" class="form-input form-control" value="" placeholder="Certifications Name"/>
                                </div>  
                                <a href="javascript:;" class="add_cert_btn" title="Add Certifications Name"><i class="fas fa-plus"></i></a>
                              <?php endif;?>
                          </div>
                      </div>
                      <!-- end certifications div-->
                    <div class="row mt-2 p-2">
                      <input type="hidden" name='id' value="<?=$id;?>">
                      <input type="hidden" name='editedby' value="<?=$editedby;?>">
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

