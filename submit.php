<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <?php 
    /*
        *Author: Daryl Bargamento
        *Description: CV Automation Convert PDF
    */
  
  ?>
  <meta name="viewport"
    content="user-scalable=no, width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="js/html2pdf.bundle.min.js"></script>
    <script src="js/html2pdf.bundle.min.js.map"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">  
</head>
<body>
<?php if(isset($_POST['submit'])  ) :
        
        $id = ($_POST['id'] ) ? $_POST['id'] : 0 ;
        $editedby = ($_POST['editedby']) ? $_POST['editedby'] : 0; 
        
        $name = $_POST['name'];  
        $position =  $_POST['position'] ;
        $applicant_info = $_POST['applicant_info'];
        $field_skills = $_POST['field_skills'];
        $achievements =  $_POST['achievements'];
        $awards = $_POST['awards'];
        $portfolio = $_POST['portfolio'];

         /*educational attinment array*/
        $educArray = $_POST['educational_att'];
        /*working experience array*/
        $work_experience = $_POST['work_experience']; 

        $personal_data = $_POST['personal'];
        $seminars = $_POST['seminars'];
        
        /* return to json encode educational attainment array */    
        $edu_course = $_POST['educational_att']['course'];
        $edu_sch_name = $_POST['educational_att']['school_name'];
        $edu_yr_grad = $_POST['educational_att']['year_graduate'];

        $json_edu_course = json_encode($edu_course);
        $json_edu_sch_name = json_encode($edu_sch_name);
        $json_edu_yr_grad = json_encode($edu_yr_grad);
        /*end of json encode education attainment array*/

        /* return to json encode work experience attainment*/
        $work_exp_start_date = $_POST['work_experience']['start_date'];
        $work_exp_comp_name = $_POST['work_experience']['company_name'];
        $work_exp_comp_position = $_POST['work_experience']['company_position'];
        $work_exp_duties_res = $_POST['work_experience']['duties_res'];
        $work_exp_duties_res_str_rplce = str_replace('&quot;', '"', $work_exp_duties_res);
        $work_exp_projects = $_POST['work_experience']['projects'];
        $work_exp_project_str_rplce = str_replace('&quot;', '"', $work_exp_projects);


        $json_work_exp_start_date = json_encode($work_exp_start_date);
        $json_work_exp_comp_name = json_encode($work_exp_comp_name);
        $json_work_exp_comp_position = json_encode($work_exp_comp_position);
        $json_work_exp_duties_res = json_encode($work_exp_duties_res_str_rplce);
        $json_work_exp_projects = json_encode($work_exp_project_str_rplce);
        /*end of json encode work experience attainment*/
        
        /*return to json encode personal project array*/
        $personal_proj_name = $_POST['personal']['project_name'];
        $personal_proj_year = $_POST['personal']['project_year'];
        $personal_proj_desc = $_POST['personal']['description'];

        $json_per_proj_name = json_encode($personal_proj_name);
        $json_per_proj_year = json_encode($personal_proj_year);
        $json_per_proj_desc = json_encode($personal_proj_desc);
        /* end of json personal project array*/

        /*return to json encode seminar & training array*/
        $seminar_name = $_POST['seminars']['seminar_name'];
        
        $json_seminar_name  = json_encode($seminar_name);
        
        /* end of json seminar & training to array*/

        /*return to json encode certification to array*/
        $certi_cert_name = $_POST['certification']['cert_name'];

        $json_cert_name = json_encode($certi_cert_name);
        
        /*end of json encode certification to array*/

        if(empty($name) || empty($position)  ){
            echo "<script>
                alert('Please fill all the fields.');
                window.location.href='index.php';
                </script>";
        }
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
            
            $sql_insert = "INSERT INTO cvautomation (`id`,
            `name`,`position`,`applicant-information`, `skills`,`achievements`, `awards`, `portfolio`, `education`,
            `name_of_school`, `year_gradute`, `duration_of_work`, `company_name`, `company_position`, `duties_responsibilites`,
            `projects`, `personpan_project_name`, `personal_project_year`, `personal_project_description`, `seminar_name`,  `certification_name`
            ) VALUES (
                '', 
                '".$name."',
                '".$position."',
                '".$applicant_info."',
                '".$field_skills."',
                '".$achievements."',
                '".$awards."',
                '".$portfolio."',
                '".$json_edu_course."',
                '".$json_edu_sch_name."',
                '".$json_edu_yr_grad."',
                '".$json_work_exp_start_date."',
                '".$json_work_exp_comp_name."',
                '".$json_work_exp_comp_position."',
                '".$json_work_exp_duties_res."',
                '".$json_work_exp_projects."',
                '".$json_per_proj_name."',
                '".$json_per_proj_year."',
                '".$json_per_proj_desc."',
                '".$json_seminar_name."',
                '".$json_cert_name."'
                
            )";

            

            if($id){
                $sql_update = "
            UPDATE
                 `cvautomation`
            SET 
                `name`='".$name."',
                `position`='".$position."',
                `applicant-information`='".$applicant_info."',
                `skills`='".$field_skills."',
                `achievements`='".$achievements."',
                `awards`='".$awards."',
                `portfolio`='".$portfolio."',
                `education`='".$json_edu_course."',
                `name_of_school`='".$json_edu_sch_name."',
                `year_gradute`='".$json_edu_yr_grad."',
                `duration_of_work`='".$json_work_exp_start_date."',
                `company_name`='".$json_work_exp_comp_name."',
                `company_position`='".$json_work_exp_comp_position."',
                `duties_responsibilites`='".$json_work_exp_duties_res."',
                `projects`='".$json_work_exp_projects."',
                `personpan_project_name`='".$json_per_proj_name."',
                `personal_project_year`='".$json_per_proj_year."',
                `personal_project_description`='".$json_per_proj_desc."',
                `seminar_name`='".$json_seminar_name."',
                `certification_name`='".$json_cert_name."',
                `edited_by` = '".$editedby."'
             WHERE 
                id='".$id."'
            ";

                if ($conn->query($sql_update) === TRUE) {
                    echo "Record updated successfully";
                } else {
                    echo "Error updating record:  " . $conn->error;
                }
            }
            else{
                if ($conn->query($sql_insert) === TRUE) {
                    echo "New record created successfully";
                  } else {
                    echo "Error: " . $sql_insert . "<br>" . $conn->error;
                  }
            }
  
            $conn->close();
      ?>
        
    <div class="wrapper" id="wrapper">
            <div class="name-container">
                <div class="n-inner">
                    <h1><?=$name = (!empty($name)) ? $name : 'John Doe' ;?></h1>
                    <h2><?=$position = (!empty($position) ) ? $position  : 'Web Developer' ;?></h2>
                </div>
            </div>
            <div class="rd-logo-container">
                <img src="img/mask_group_1.png"/>
            </div>
            <div class="details-container">
                <!--eg achievements, objective, awards, etc.-->
                <div class="sidebar-container">
                    <!--OPTIONAL, HIDE IF NOT SPECIFIED-->
                    <div class="objective-container">
                        <p>
                            <?=$applicant_info = (!empty($applicant_info)) ?  $applicant_info  : '' ; ?>
                        </p>
                    </div>
                    <?php if(!empty($field_skills) ):?>
                        <div class="sidebar-child">
                            <h3 class="s-title">Skills</h3>
                            <ul class="s-items">
                                <?php 
                                $field_skills = explode('|', $field_skills);
                                foreach($field_skills as $skill):?>
                                    <li><?=$skill?></li>
                                <?php endforeach;?>
                            </ul>
                        </div>
                    <?php endif;?>
                    <!-- end skills -->
                    <?php if(!empty($achievements)):?>
                        <div class="sidebar-child">
                            <h3 class="s-title">Achievements</h3>
                            <ul class="s-items ach-items">
                            <?php 
                            $achievements = explode('|', $achievements);
                            foreach($achievements as $achvment):?>
                                <li><?=$achvment?></li>
                            <?php endforeach;?>
                            </ul>
                        </div>
                    <?php endif;?>
                    <!-- end side achievements-->
                    <?php if(!empty($awards)): ?>
                    <div class="sidebar-child">
                            <h3 class="s-title">Awards</h3>
                            <ul class="s-items">
                            <?php 
                             $awards = explode('|', $awards);
                            foreach($awards as $award):?>
                                <li><?=$award;?></li>
                            <?php endforeach;?>
                        </ul>
                    </div>
                    <?php endif;?>
                    <!-- end portfolio -->

                    <?php if(!empty($portfolio)): ?>
                    <div class="sidebar-child">
                            <h3 class="s-title">Portfolio</h3>
                            <ul class="s-items">
                            <?php 
                             $portfolio = explode('|', $portfolio);
                            foreach($portfolio as $portf):?>
                                <li><?=$portf;?></li>
                            <?php endforeach;?>
                        </ul>
                    </div>
                    <?php endif;?>
                    <!-- end awards -->
                </div>
                <!--loop ends here-->
                <div class="experiences-container">
                    <div class="exp-child educational_att">
                        <h3 class="exp-title">Educational Attainment</h3>
                        
                            <?php
                            $count_sch_name = count($educArray['school_name']);
                            $letEduData = []; 
                                for($i = 0;$i < $count_sch_name;$i++){
                                    $eduData = [];
                                    foreach($educArray as $ke => $wrk){
                                        $eduData[$ke] = $educArray[$ke][$i];
                                    }
                                    $letEduData[$i] = $eduData;
                                }
                                for($i = 0;$i<count($letEduData);$i++){  
                                    echo '<div class="exp-item">';
                                    foreach($letEduData[$i] as $key =>$value){
                                        echo '<p class="fontbold">'.$value.'</p>';
                                    }
                                    echo '</div>';
                                }
                            ?>
                        
                    </div>
                   <?php if(!empty($work_experience['company_name'][0]) || 
                            !empty($work_experience['start_date'][0]) || 
                            !empty($work_experience['company_position'][0]) || 
                            !empty($work_experience['duties_res'][0]) || 
                            !empty($work_experience['projects'][0])
                    ): ?>
                    <div class="exp-child work_experience">
                        <h3 class="exp-title">Work Experiences</h3>
                        
                            <!--LOOPED if dghan ang gi input-->
                            <?php 
                            $count = count($work_experience['company_name']);
                            $letSerializedData = [];
                                for($i = 0;$i < $count;$i++){
                                    $workexp = [];
                                    foreach($work_experience as $kw => $wrk){
                                        $workexp[$kw] = $work_experience[$kw][$i];
                                    }
                                    $letSerializedData[$i] = $workexp;
                                }
                                for($i = 0;$i<count($letSerializedData);$i++){
                                    echo '<div class="exp-item">';
                                    foreach($letSerializedData[$i] as $key =>$value){ 
                                        if($key != 'duties_res' &&  $key != 'projects'){
                                            echo '<p class="fontbold">'.$value.'</p>';
                                        }
                                        else  {
                                            $dut_res = explode('|',$value);
                                            if(!empty($dut_res[0])){
                                                echo '<ul>';
                                                foreach($dut_res as $duties){
                                                    echo '<li class="fontbold decorated"> '.$duties.'</li>';
                                                }
                                                echo '</ul';
                                            }
                                           
                                        }
                                    }
                                    echo '</div>';
                                }
                            ?>
                        
                    </div>
                    <?php endif;?>
                    <!--  projects-->
                    <?php if(!empty($_POST['personal']['project_name'][0]) || !empty($_POST['personal']['project_year'][0]) || !empty($_POST['personal']['project_year'][0]) ):?>
                        <div class="exp-child educational_att">
                            <h3 class="exp-title">Personal Project</h3>
                            
                            <?php 
                               $count_personal = count($_POST['personal']['project_name']);
                               $personalData = [];
                                    
                                    for($i = 0; $i < $count_personal; $i++){
                                        $person = [];
                                        foreach($personal_data as $pd => $person_data){
                                            $person[$pd] = $personal_data[$pd][$i];
                                        }
                                        $personalData[$i] = $person;
                                    }
                                    for($i = 0; $i< count($personalData); $i++){
                                        echo '<div class="exp-item">';
                                        foreach($personalData[$i] as $key => $valData){
                                            echo '<p class="fontbold">' .$valData. '</p>';
                                        }    
                                        echo '</div>';
                                    }
                                   
                            ?>
                            
                        </div>
                    <?php endif;?>
                    <!--end per project -->
                       <!-- Seminars-->
                    <?php if(!empty($_POST['seminars']['seminar_name'][0]) || !empty($_POST['seminars']['seminar_year'][0]) ):?>
                        <div class="exp-child educational_att">
                            <h3 class="exp-title">Seminars & Training</h3> 
                            <?php 
                                $count_seminar = count($_POST['seminars']['seminar_name']);
                                $seminarData = [];
                                for($i = 0; $i<$count_seminar; $i++){
                                    $seminar = [];
                                    foreach($seminars as $se => $seminar_data){
                                        $seminar[$se] = $seminars[$se][$i];
                                    }
                                    $seminarData[$i] = $seminar;
                                }

                                for($i = 0; $i< count($seminarData); $i++){
                                    echo '<div class="exp-item">';
                                    foreach($seminarData[$i] as $key => $valSeminar){
                                        echo '<p class="fontbold">' .$valSeminar.'</p>';
                                    }
                                    echo '</div>';
                                }
                            ?>
                        </div>
                    <?php endif;?>
                    <!--end end seminars & training -->
                    <?php if(!empty($_POST['certification']['cert_name'][0]) || !empty($_POST['certification']['cert_year'][0])  ):?>
                        <div class="exp-child educational_att">
                            <h3 class="exp-title">Certifications</h3>
                            
                                <?php 
                                    $count_certi = count($_POST['certification']['cert_name']);
                                    $certi_data = [];
                                    for($i = 0; $i < $count_certi; $i++){
                                        $certifcations = [];
                                        foreach($_POST['certification'] as $keycert => $certiva){
                                            $certifcations[$keycert] = $_POST['certification'][$keycert][$i];
                                        }
                                        $certi_data[$i] = $certifcations;
                                    }
                                    for($i = 0; $i<count($certi_data); $i++){
                                        echo '<div class="exp-item">';
                                        foreach($certi_data[$i] as $key => $valCertification){
                                            echo '<p class="fontbold">'. $valCertification. '</p>';
                                        }
                                        echo '</div>';
                                    }
                                ?>
                            
                        </div>
                    <?php endif;?>
                </div>
            </div>
    </div>
      <!-- end if  -->
      <?php endif;?>
         <div class="btn" id="btn">
            <a href="javascript:;" onclick="generatePDF()">Convert
            Pdf
            </a> 
            
            <button  onclick="history.go(-1);"
             style="margin-right: 10px;
            text-decoration: none;
            padding: 10px 20px;
            border: 2px solid #000A25;
            border-radius: 25px;
            color: #000A25 !important;
            font-weight: 900;
            background-color: #ffffff00;
            "
            >Back </button>
        </div>
</body>
    
    <script>

      function generatePDF() {        
        const element = document.getElementById('wrapper');
        let width = element.offsetWidth;
        let height = element.offsetHeight;
        // html2pdf()
        // .from(element)
        // .save();
        html2pdf(element, {
            margin:     0,
            filename:   'cvremotodojo.pdf',
            image:       { type: 'jpeg', quality: 0.98},
            html2canvas: { scale: 2, logging: true, dpi: 192, letterRendering: true},
            jsPDF:       { unit: 'px', format: [width, height], orientation: 'portrait'}
            
        }); 
      }

      
    </script>   
</html>


