$(document).ready(function(){
    var maxField = 50; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var addExpButton = $('.add_exp');
    var addAwardButton = $('.add_btn_awards');
    var addAchievementsButton = $('.add_btn_achievements');
    var add_per_prj_btn = $('.add_person_prj_btn'); // Add Button selector
    var add_seminar_btn = $('.add_seminar_btn');
    var add_certification_btn = $('.add_cert_btn'); // Add Button selector certifications
    var addPortfolioButton = $('.add_btn_portfolio');

    var wrapper = $('.field_wrapper'); //Input field wrapper
    var div_work_exp = $('.work_experience');
    var field_skills = $('.field_skills');
    var achievements_field = $('.achievements');
    var addButtonEdu = $('.add_edu_btn');
    var edu_att_fields = $('.educational_att');
    var awards_fields = $('.awards');
    var div_per_proj =  $('.personal-freelance');
    var div_seminar = $('.seminarstraining');
    var div_certifications = $('.certification');
    var div_portfolio = $('.portfolio');

    var fieldHTML = '<div class=""><input type="text" name="field_skills[]" class="form-input form-control" value="" placeholder="Skills" /><a href="javascript:;" class="remove_button"> <i class="fas fa-minus-circle text-danger"></i> </a></div>'; //New input field html 
    var achievements_html = '<div><input type="text" name="achievements[]" class="form-input form-control" value="" placeholder="Achievements" /><a href="javascript:;" class="remove_button_achievements"> <i class="fas fa-minus-circle text-danger"></i> </a></div>'; //New input field html 
    var awards_html = '<div><input type="text" name="awards[]" class="form-input form-control" value="" placeholder="Awards" /><a href="javascript:;" class="remove_button_awards"> <i class="fas fa-minus-circle text-danger"></i> </a></div>'; //New input field html 
    var portfolio_html = '<div><input type="text" name="portfolio[]" class="form-input form-control" value="" placeholder="Portfolio" /><a href="javascript:;" class="remove_button_portfolio"> <i class="fas fa-minus-circle text-danger"></i> </a></div>'; //New input field html 
    /* experience */
    let work_experience = ''
    work_experience += '<hr>';
    work_experience += '<div class="row row1">';
    work_experience += '<div class="col-sm">';
    work_experience += '<input type="text" name="work_experience[start_date][]" class="form-input form-control" value="" placeholder="Duration of work" />'; //New input field html 
    work_experience += '</div>';
    work_experience += '<div class="col-sm">';
    work_experience += '<input type="text" name="work_experience[company_name][]" class="form-input form-control" value="" placeholder="Company Name"/>';
    work_experience += '</div>';
    work_experience += '<div class="col-sm">';
    work_experience += '<input type="text" name="work_experience[company_position][]" class="form-input form-control" value="" placeholder="Company Position"/>';
    work_experience += '</div>';
    work_experience += '</div>';
    work_experience += '<div class="row row2">';
    work_experience += '<div class="col-sm">';
    work_experience += '<textarea name="work_experience[duties_res][]" id="" class="form-control work-exp" cols="3" rows="1" placeholder="Duties Responsibilites"></textarea>';
    work_experience += '</div>';
    work_experience += '<div class="col-sm">';
    work_experience += '<textarea name="work_experience[projects][]" id="" class="form-control work-exp" cols="3" rows="1" placeholder="Projects"></textarea>';
    work_experience += '</div>';
    work_experience += ' <a href="javascript:;" class="remove_button_exp"> <i class="fas fa-minus-circle text-danger"></i> </a>';
    work_experience += '</div>';
    work_experience += '</div>';
    
    let eduHtml = ''; 
    eduHtml += '<div class="row">';
    eduHtml += '<div class="col-sm">';
    eduHtml += '<input type="text" name="educational_att[course][]" class="form-input form-control" value="" placeholder="Course" />'; //New input field html 
    eduHtml += '</div>';
    eduHtml += '<div class="col-sm">';
    eduHtml += '<input type="text" name="educational_att[school_name][]" class="form-input form-control" value="" placeholder="Name of School" />'; //New input field html 
    eduHtml += '</div>';
    eduHtml += '<div class="col-sm">';
    eduHtml += '<input type="text" name="educational_att[year_graduate][]" class="form-input form-control" value="" placeholder="Year Graduate" />'; //New input field html 
    eduHtml += '</div>';
    eduHtml += ' <a href="javascript:;" class="remove_button_edu"> <i class="fas fa-minus-circle text-danger"></i> </a>';
    eduHtml += '</div>';

    /*end of educational attainment fields*/

    let personal_pro = '';
    personal_pro += '<div class="row">';
    personal_pro += '<div class="col-sm">';
    personal_pro += '<input type="text" name="personal[project_name][]" class="form-input form-control" value="" placeholder="Project Name" />'; //New input field html 
    personal_pro += '</div>';
    personal_pro += '<div class="col-sm">'; 
    personal_pro += '<input type="text" name="personal[project_year][]" class="form-input form-control" value="" placeholder="Project Year" />'; //New input field html 
    personal_pro += '</div>';
    personal_pro += ' <a href="javascript:;" class="remove_button_per_proj"> <i class="fas fa-minus-circle text-danger"></i> </a>';
    personal_pro += '</div>';

    /*end of personal projects & freelance*/

    let seminars = '';
    seminars += '<div class="row">';
    seminars += '<div class="col-sm">';
    seminars += '<input type="text" name="seminars[seminar_name][]" class="form-input form-control" value="" placeholder="Seminar Name" />'; //New input field html 
    seminars += '</div>';
    seminars += '<div class="col-sm">'; 
    seminars += '<input type="text" name="seminars[seminar_year][]" class="form-input form-control" value="" placeholder="Seminar Year" />'; //New input field html 
    seminars += '</div>';
    seminars += ' <a href="javascript:;" class="remove_btn_seminar"> <i class="fas fa-minus-circle text-danger"></i> </a>';
    seminars += '</div>';

    /*end of seminars & training*/

    let certification = '';
    certification += '<div class="row">';
    certification += '<div class="col-sm">';
    certification += '<input type="text" name="certification[cert_name][]" class="form-input form-control" value="" placeholder="Certifications Name" />'; //New input field html 
    certification += '</div>';
    certification += '<div class="col-sm">'; 
    certification += '<input type="text" name="certification[cert_year][]" class="form-input form-control" value="" placeholder="Certifications Year" />'; //New input field html 
    certification += '</div>';
    certification += ' <a href="javascript:;" class="remove_btn_seminar"> <i class="fas fa-minus-circle text-danger"></i> </a>';
    certification += '</div>';

    /*end of certifications div*/
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(field_skills).append(fieldHTML); //Add field html
        }
    });
    $(addExpButton).click(function(){
        if(x < maxField){
          x++;
          $(div_work_exp).append(work_experience);
        }
    });

    $(addButtonEdu).click(function(){
        if(x < maxField){
            x++;
            $(edu_att_fields).append(eduHtml);
        }
    });
    /*achievements button*/
    $(addAchievementsButton).click(function(){
        if(x < maxField){
            x++;
            $(achievements_field).append(achievements_html);
        }
        
    });
    /*Awards Button*/
    $(addAwardButton).click(function(){
        if(x < maxField){
            x++;
            $(awards_fields).append(awards_html);
        }
        
    });

    /*Portfolio Button*/
    $(addPortfolioButton).click(function(){
        if(x < maxField){
            x++;
            $(div_portfolio).append(portfolio_html);
        }
    });


    /* Add button personal project*/
    $(add_per_prj_btn).click(function(){
        if(x < maxField){
            x++;
            $(div_per_proj).append(personal_pro);
        }
        
    });
    /*Add button seminars & training*/
    $(add_seminar_btn).click(function(){
        if(x < maxField){
            x++;
            $(div_seminar).append(seminars);
        }        
    });

    /* Add button certifcations */
    $(add_certification_btn).click(function(){
        if(x < maxField){
            x++;
            $(div_certifications).append(certification);
        }        
    });

    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });

    $(div_work_exp).on('click', '.remove_button_exp', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
    /* once remove button educational attainment is clicked*/
    $(edu_att_fields).on ('click', '.remove_button_edu', function(e){
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    });

    $(achievements_field).on('click', '.remove_button_achievements', function(e){
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    });
    /* once remove button awards  is clicked*/

    $(awards_fields).on('click', '.remove_button_awards', function(e){
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    });
    $(div_per_proj).on('click', '.remove_button_per_proj', function(e){
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    });
    /*seminars & training remove button*/
    $(div_seminar).on('click', '.remove_btn_seminar', function(e){
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    });
    /*certifications remove button*/
    $(div_certifications).on('click', '.remove_btn_seminar', function(e){
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    });

    /*portfolio remove button*/
    $(div_portfolio).on('click', '.remove_button_portfolio', function(e){
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    });
});
