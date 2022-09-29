@include('sidebar')

@include('header')
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Quiz - ACP - Quiz</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">



    <!-- CSS Files -->
    <link rel="stylesheet" href="{{url('public/css/bootstrap.min.css')}}" />

    <!--   Core JS Files   -->
    <script src="{{url('public/js/jquery.3.2.1.min.js')}}"></script>
    <script src="{{url('public/editor_ckediter/ckeditor.js')}}"></script>

    <!--custom style-->
    <style>
    label.col-md-2.col-form-label {
        font-weight: 600;
        font-size: 14px;
    }

    .table-hover tbody tr:hover {
        background-color: #dde1e5;
    }

    .main-panel-custom {
        background-color: #DEE2E6;
        height: auto;
    }

    textarea#quiz_question_html {

        width: 100% !important;
    }

    .card {
        width: 90%;
        margin: 0 auto;
    }

    .page-inner textarea {
        width: 100% !important;
    }
    .text-danger{
        font-size:12.5px !important;
    }
    </style>


   
<link rel="stylesheet" href="{{url('public/css/multi-select.css')}}" type="text/css" />
    <script src="{{url('public/js/jquery.multi-select.js')}}"></script>
    <script src="{{url('public/js/jquery.quicksearch.js')}}"></script>
    <script src="//cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
    <script src="//cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>


    <style type="text/css">
    .ms-container {
        width: 100%;
    }

    .ms-container .ms-list {
        height: 130px;
    }
    </style>





</head>



<body>


    <div class="d-sm-flex align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800 ml-4 font-weight-bold">Quiz</h1>
        <ul class="breadcrumbs">
            <li class="content">
                <a href="{{url('app-list')}}">
                    <i class="fa fa-home" style="cursor:pointer;font-size:20px;">
                </a></i>
            </li>
            <li class="separator">
                <i class="fas fa-greater-than"></i>
            </li>
            <li class="nav-item">
                <a href="{{url('quiz-list')}}">Quiz List</a>
            </li>
            <li class="separator">
                <i class="fas fa-greater-than"></i>
            </li>
            <li class="nav-item">
                <a href="#">Add Quiz</a>
            </li>

        </ul>
        @if(Session::has('message'))
        <span class="d-none d-sm-inline-block">
            <p class="alert alertinfo text-white" style="background-color:#308930">{{ Session::get('message') }}
                </script>
            </p>
        </span>@endif
    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <div class="content">
        <div class="page-inner">

            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-header">
                            <h4 class="card-title font-weight-normal">Add Quiz</h4>
                        </div>

                        <!--notifiactions-->
                        <div class="container" id="">
                        </div>
                    <div id="success"></div>
                        <div class="card-body">
                            <form id="quiz_insert"  method="post">
                               


                                <div class="form-group form-inline" id="div_quiz_category">
                                    <label for="div_quiz_category" class="col-md-2 col-form-label">Category<span
                                            style="color:red;">&nbsp;*</span></label>
                                    <div class="col-md-6 p-0">
                                        <select name="category_id" class="form-control input-full" id="quiz_category"
                                            style="width:100%">
                                            <option value="Select Category" selected="true" disabled>Select Category
                                            </option>

                                            @foreach($category_list as $row)
                                            <option value="{{$row->id}}">{{$row->category_name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger" id="category-error"></span>
                                    </div>
                                </div>


                                <div class="form-group form-inline" id="div_quiz_question">
                                    <label class="col-md-2 col-form-label" for="quiz_question">Question Format type :
                                    </label>

                                    <div style="display: contents;" class=" col-md-6 align-items-center d-inline-flex">
                                        <input type="radio" name="question_format_type" class="quest_text_type"
                                            value="0" id="ques_default_text" onchange="quesishtml()" checked>
                                        <label class="pr-3 pl-1" for="ques_default_text">Normal text</label>

                                        <input type="radio" name="question_format_type" class="quest_text_type"
                                            value="1" id="ques_html_text" onchange="quesishtml()">
                                        <label class="pr-3 pl-1" for="ques_html_text">Html text</label>
                                        <span class="text-danger"  id="question_format_type_error"></span>
                                    </div>
                                </div>


                                <!--show for question html-->

                                <div class="form-group form-inline" id="showforqueshtml" style="display: none;">
                                    <label for="showforqueshtml" class="col-md-2 col-form-label">Question<span
                                            style="color:red;">&nbsp;*</span></label>
                                    <div class="col-md-8 p-0">
                                        <textarea name="question_name_html" class="form-control" rows="5"
                                            id="quiz_question_html" style="height:100px;"></textarea>
                                        <span class="text-danger"  id="error_quiz_question_html"></span>

                                    </div>
                                </div>

                                <!--show for question default-->

                                <div class="form-group form-inline" id="showforquesdefault">
                                    <label for="showforquesdefault" class="col-md-2 col-form-label">Question<span
                                            style="color:red;">&nbsp;*</span></label>
                                    <div class="col-md-8 p-0">
                                        <textarea name="question_name" class="form-control input-full" rows="5"
                                            id="quiz_question_default" style="height:100px;"></textarea>

                                    
                                            <span class="text-danger" id="error_quiz_question_default"></span>

                                    </div>
                                </div>




                                <div class="form-group form-inline">
                                    <label for="showforqueshtml" class="col-md-2 col-form-label">No of Options<span
                                            style="color:red;">&nbsp;*</span></label>
                                    <div class="col-md-8 p-0">
                                        <SELECT name="option_count" id="ppl" class="form-control" style="width:100%;"
                                            onchange="optionlist()">
                                            <option disabled="true" selected>Select Option</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>

                                        </select>
                                        <span class="text-danger" id="error_option_count"></span>

                                    </div>
                                </div>






                                <div class="form-group form-inline" id="change_option">
                                    <label class="col-md-2 col-form-label" for="">Option Format type : </label>

                                    <div style="display: contents;" class=" col-md-6 align-items-center d-inline-flex">
                                        <input type="radio" name="option_format_type" class="opt_text_type" value="0"
                                            id="opt_default_text" onchange="optionishtml()" checked>
                                        <label class="pr-3 pl-1" for="opt_default_text">Normal text</label>

                                        <input type="radio" name="option_format_type" class="opt_text_type" value="1"
                                            id="opt_html_text" onchange="optionishtml()">
                                        <label class="control-label" for="opt_html_text">Html text</label>

                                        <p class="text-danger err_msg" id="err_quiz_question"></p>
                                    </div>
                                </div>



                                <!--show for opt html-->
                                <div id="showforopthtml" style="display: none;">


                                    <div class="form-group form-inline" id="text_html_1">
                                        <label for="" class="col-md-2 col-form-label">Option 1<span
                                                style="color:red;">&nbsp;*</span></label>
                                        <div class="col-md-8 p-0">
                                            <textarea name="option_1_html" class="form-control input-full" rows="5"
                                                id="quiz_option1_html" style="height:100px;"></textarea>

                                                <span class="text-danger" id="error_option_1_html"></span>
                                        </div>
                                    </div>


                                    <div class="form-group form-inline" id="text_html_2">
                                        <label for="" class="col-md-2 col-form-label">Option 2<span
                                                style="color:red;">&nbsp;*</span></label>
                                        <div class="col-md-8 p-0">
                                            <textarea name="option_2_html" class="form-control input-full" rows="5"
                                                id="quiz_option2_html" style="height:100px;"></textarea>

                                                <span class="text-danger" id="error_option_2_html"></span>

                                        </div>
                                    </div>


                                    <div class="form-group form-inline" id="text_html_3">
                                        <label for="" class="col-md-2 col-form-label">Option 3<span
                                                style="color:red;">&nbsp;*</span></label>
                                        <div class="col-md-8 p-0">
                                            <textarea name="option_3_html" class="form-control input-full" rows="5"
                                                id="quiz_option3_html" style="height:100px;"></textarea>

                                                <span class="text-danger" id="error_option_3_html"></span>

                                        </div>
                                    </div>

                                    <div class="form-group form-inline" id="text_html_4">
                                        <label for="" class="col-md-2 col-form-label">Option 4<span
                                                style="color:red;">&nbsp;*</span></label>
                                        <div class="col-md-8 p-0">
                                            <textarea name="option_4_html" class="form-control input-full" rows="5"
                                                id="quiz_option4_html" style="height:100px;"></textarea>

                                                <span class="text-danger" id="error_option_4_html"></span>

                                        </div>
                                    </div>

                                    <div class="form-group form-inline" id="text_html_5">
                                        <label for="" class="col-md-2 col-form-label">Option 5<span
                                                style="color:red;">&nbsp;*</span></label>
                                        <div class="col-md-8 p-0">
                                            <textarea name="option_5_html" class="form-control input-full" rows="5"
                                                id="quiz_option5_html" style="height:100px;"></textarea>

                                                <span class="text-danger" id="error_option_5_html"></span>

                                        </div>
                                    </div>

                                    <div class="form-group form-inline" id="text_html_6">
                                        <label for="" class="col-md-2 col-form-label">Option 6<span
                                                style="color:red;">&nbsp;*</span></label>
                                        <div class="col-md-8 p-0">
                                            <textarea name="option_6_html" class="form-control input-full" rows="5"
                                                id="quiz_option6_html" style="height:100px;"></textarea>

                                                <span class="text-danger" id="error_option_6_html"></span>

                                        </div>
                                    </div>


                                </div>


                                <!--show for opt default-->
                                <div id="showforoptdefault">

                                    <div class="form-group form-inline" id="default_1">
                                        <label for="" class="col-md-2 col-form-label">Option 1<span
                                                style="color:red;">&nbsp;*</span></label>
                                        <div class="col-md-8 p-0">
                                            <textarea name="option_1" class="form-control input-full" rows="5"
                                                id="quiz_option1_default" style="height:100px;"></textarea>

                                                <span class="text-danger" id="error_quiz_option1_default"></span>

                                        </div>
                                    </div>


                                    <div class="form-group form-inline" id="default_2">
                                        <label for="" class="col-md-2 col-form-label">Option 2<span
                                                style="color:red;">&nbsp;*</span></label>
                                        <div class="col-md-8 p-0">
                                            <textarea name="option_2" class="form-control input-full" rows="5"
                                                id="quiz_option2_default" style="height:100px;"></textarea>

                                                <span class="text-danger" id="error_quiz_option2_default"></span>

                                        </div>
                                    </div>


                                    <div class="form-group form-inline" id="default_3">
                                        <label for="" class="col-md-2 col-form-label">Option 3<span
                                                style="color:red;">&nbsp;*</span></label>
                                        <div class="col-md-8 p-0">
                                            <textarea name="option_3" class="form-control input-full" rows="5"
                                                id="quiz_option3_default" style="height:100px;"></textarea>

                                                <span class="text-danger" id="error_quiz_option3_default"></span>

                                        </div>
                                    </div>


                                    <div class="form-group form-inline" id="default_4">
                                        <label for="" class="col-md-2 col-form-label">Option 4<span
                                                style="color:red;">&nbsp;*</span></label>
                                        <div class="col-md-8 p-0">
                                            <textarea name="option_4" class="form-control input-full" rows="5"
                                                id="quiz_option4_default" style="height:100px;"></textarea>

                                                <span class="text-danger" id="error_quiz_option4_default"></span>

                                        </div>
                                    </div>

                                    <div class="form-group form-inline" id="default_5">
                                        <label for="" class="col-md-2 col-form-label">Option 5<span
                                                style="color:red;">&nbsp;*</span></label>
                                        <div class="col-md-8 p-0">
                                            <textarea name="option_5" class="form-control input-full" rows="5"
                                                id="quiz_option5_default" style="height:100px;"></textarea>

                                                <span class="text-danger" id="error_quiz_option5_default"></span>

                                        </div>
                                    </div>

                                    <div class="form-group form-inline" id="default_6">
                                        <label for="" class="col-md-2 col-form-label">Option 6<span
                                                style="color:red;">&nbsp;*</span></label>
                                        <div class="col-md-8 p-0">
                                            <textarea name="option_6" class="form-control input-full" rows="5"
                                                id="quiz_option6_default" style="height:100px;"></textarea>

                                                <span class="text-danger" id="error_quiz_option6_default"></span>

                                        </div>
                                    </div>
                                </div>




                                <div class="form-group form-inline" id="div_quiz_answer">
                                    <label for="div_quiz_answer" class="col-md-2 col-form-label">Answer<span
                                            style="color:red;">&nbsp;*</span></label>
                                    <div class="col-md-8 p-0">
                                        <select name="quiz_answer" class="form-control input-full" id="quiz_answer"
                                            style="width:100%" >

                                        </select>
                                        <span class="text-danger" id="error_quiz_answer"></span>

                                    </div>
                                </div>

                                <div class="form-group form-inline" id="div_quiz_hint">
                                    <label for="div_quiz_hint" class="col-md-2 col-form-label">Hint</label>
                                    <div class="col-md-8 p-0">
                                        <textarea name="quiz_hint" class="form-control input-full" rows="8"
                                            id="quiz_hint" style="height:100px;width:100%;"
                                           ></textarea>

                                        <small class="form-text text-muted text-danger err_msg"
                                            id="error_quiz_hint"></small>
                                    </div>
                                </div>


                                <div class="form-group form-inline" id="explanation">
                                    <label for="div_quiz_exp" class="col-md-2 col-form-label">Explanation</label>
                                    <div class="col-md-8 p-0">
                                        <textarea name="quiz_exp" class="form-control input-full" rows="8"  id="quiz_exp" style="height:100px;width:100%;"> </textarea>
                                        <small class="form-text text-muted text-danger err_msg"
                                            id="err_quiz_exp"></small>
                                    </div>
                                </div>


                                <div class="form-group form-inline">
                                    <label for="inlineinput" class="col-md-2  col-form-label "></label>
                                    <div class="col-md-6 p-0">
                                        <button name="questionBtn" type="submit" value="true" id="questionBtn" class="btn btn-success">Submit</button>
                                        &nbsp;<button name="resetBtn" type="reset" value="true" id="resetBtn"
                                            class="btn btn-warning"
                                            onclick="window.location.href='{{url("quiz-list")}}'">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    </div>

    </div>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
$(document).ready(function() {
    {{-- $(".alert-dismissible").hide(); --}}
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


$('#quiz_insert').on('submit', function(event) {
    event.preventDefault();
    $('#category-error').text('');
    $('#error_quiz_question_default').text('');
    $('#error_quiz_question_html').text('');
    $('#error_option_count').text('');
    $('#error_quiz_option1_default').text('');
    $('#error_quiz_option2_default').text('');
    $('#error_quiz_option3_default').text('');
    $('#error_quiz_option4_default').text('');
    $('#error_quiz_option5_default').text('');
    $('#error_quiz_option6_default').text('');
    $('#error_option_1_html').text('');
    $('#error_option_2_html').text('');
    $('#error_option_3_html').text('');
    $('#error_option_4_html').text('');
    $('#error_option_5_html').text('');
    $('#error_option_6_html').text('');
    $('#error_quiz_answer').text('');
    
   
  

    $.ajax({
        url: "{{route('quiz.insert')}}",
        type: "POST",
        data: {

            'category_id': $('#quiz_category').val(),
            'question_format_type' : $('input[name="question_format_type"]:checked').val(),
            'option_format_type' : $('input[name="option_format_type"]:checked').val(),
            'question_format_type1': $('#ques_default_text').val(),
            'question_format_type2': $('#ques_html_text').val(),
            'question_name':$('#quiz_question_default').val(),
            'question_name_html':$('#quiz_question_html').val(),
            'option_count':$('#ppl').val(),
            'option_1':$('#quiz_option1_default').val(),  
            'option_2':$('#quiz_option2_default').val(),
            'option_3':$('#quiz_option3_default').val(), 
            'option_4':$('#quiz_option4_default').val(),  
            'option_5':$('#quiz_option5_default').val(),  
            'option_6':$('#quiz_option6_default').val(),  
            'option_1_html':$('#quiz_option1_html').val(),  
            'option_2_html':$('#quiz_option2_html').val(),  
            'option_3_html':$('#quiz_option3_html').val(),  
            'option_4_html':$('#quiz_option4_html').val(),  
            'option_5_html':$('#quiz_option5_html').val(),  
            'option_6_html':$('#quiz_option6_html').val(),  
            'quiz_hint':$('#quiz_hint').val(), 
            'quiz_exp':$('#quiz_exp').val(), 
            'quiz_answer':$('#quiz_answer').val(),  
            "_token": "{{ csrf_token() }}",
        },
        success: function(response) {
            if (response) {
                // $('.alert-dismissible').addClass('alert alert-success alert-dismissible fade show');
                // $(".alert-dismissible").show();
                // $('#success').html('<div class="alert alert-success alert-dismissible fade show" role="alert">'
                //                 +'<span id="success-message">Send Message Successfully.!</span>'
                //                 +'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'
                //             +'</div>');
                location.href= "{{url('quiz-list')}}";

                $("#success").animate({scrollTop: $(window).scrollTop(0)},"slow");
            }
        },

        error: function(response) {
            $('#category-error').text(response.responseJSON.errors.category_id);
            $('#error_quiz_question_default').text(response.responseJSON.errors.question_name);
            $('#error_quiz_question_html').text(response.responseJSON.errors.question_name_html);
            $('#error_option_count').text(response.responseJSON.errors.option_count);
            $('#error_quiz_option1_default').text(response.responseJSON.errors.option_1);
            $('#error_quiz_option2_default').text(response.responseJSON.errors.option_2);
            $('#error_quiz_option3_default').text(response.responseJSON.errors.option_3);
            $('#error_quiz_option4_default').text(response.responseJSON.errors.option_4);
            $('#error_quiz_option5_default').text(response.responseJSON.errors.option_5);
            $('#error_quiz_option6_default').text(response.responseJSON.errors.option_6);
            $('#error_option_1_html').text(response.responseJSON.errors.option_1_html);
            $('#error_option_2_html').text(response.responseJSON.errors.option_2_html);
            $('#error_option_3_html').text(response.responseJSON.errors.option_3_html);
            $('#error_option_4_html').text(response.responseJSON.errors.option_4_html);
            $('#error_option_5_html').text(response.responseJSON.errors.option_5_html);
            $('#error_option_6_html').text(response.responseJSON.errors.option_6_html);
            $('#error_quiz_answer').text(response.responseJSON.errors.quiz_answer);
        }
        
    });
});

</script>




<script>
$("#showforopthtml").hide();
$("#change_option").hide();
$("#showforoptdefault").hide();
$("#div_quiz_answer").hide();
$("#div_quiz_hint").hide();
$("#explanation").hide();
</script>


<script>
document.getElementById('showforoptdefault').style.display = 'none';

function optionlist() {
    //Getting Value

    // METHOD 1
    var selValue = document.getElementById("ppl").value;
    var quiz_answer = document.getElementById("quiz_answer");


    //METHOD 2
    var selObj = document.getElementById("ppl");
    var selValue = selObj.options[selObj.selectedIndex].value;

    //default text checking
    if (selValue >= 1) {
        document.getElementById('change_option').style.display = 'flex';
        $("#showforoptdefault").show();
        $("#div_quiz_answer").show();
        $("#div_quiz_hint").show();
        $("#explanation").show();

    } else {
        document.getElementById('default_1').style.display = 'none';

    }

    if (selValue >= "2") {


        document.getElementById('default_2').style.display = 'flex';
    } else {
        document.getElementById('default_2').style.display = 'none';

    }

    if (selValue >= "3") {
        document.getElementById('default_3').style.display = 'flex';
    } else {
        document.getElementById('default_3').style.display = 'none';

    }

    if (selValue >= "4") {
        document.getElementById('default_4').style.display = 'flex';
    } else {
        document.getElementById('default_4').style.display = 'none';

    }
    if (selValue >= "5") {
        document.getElementById('default_5').style.display = 'flex';
    } else {
        document.getElementById('default_5').style.display = 'none';

    }
    if (selValue >= "6") {
        document.getElementById('default_6').style.display = 'flex';
    } else {
        document.getElementById('default_6').style.display = 'none';

    }

    //html text checking

    if (selValue >= "1") {

        document.getElementById('text_html_1').style.display = 'flex';
    } else {
        document.getElementById('text_html_1').style.display = 'none';

    }

    if (selValue >= "2") {

        $("#text_html_2").show();

    } else {
        $("#text_html_2").hide();


    }

    if (selValue >= "3") {
        document.getElementById('text_html_3').style.display = 'flex';
    } else {
        document.getElementById('text_html_3').style.display = 'none';

    }

    if (selValue >= "4") {
        document.getElementById('text_html_4').style.display = 'flex';
    } else {
        document.getElementById('text_html_4').style.display = 'none';

    }
    if (selValue >= "5") {
        document.getElementById('text_html_5').style.display = 'flex';
    } else {
        document.getElementById('text_html_5').style.display = 'none';

    }
    if (selValue >= "6") {
        document.getElementById('text_html_6').style.display = 'flex';
    } else {
        document.getElementById('text_html_6').style.display = 'none';

    }





    if ($("input[id='opt_default_text']:checked").val()) {
        if (selValue >= "1") {

            document.getElementById('default_1').style.display = 'flex';
        } else {
            document.getElementById('default_1').style.display = 'none';

        }

        if (selValue >= "2") {
            document.getElementById('default_2').style.display = 'flex';
        } else {
            document.getElementById('default_2').style.display = 'none';

        }

        if (selValue >= "3") {
            document.getElementById('default_3').style.display = 'flex';
        } else {
            document.getElementById('default_3').style.display = 'none';

        }

        if (selValue >= "4") {
            document.getElementById('default_4').style.display = 'flex';
        } else {
            document.getElementById('default_4').style.display = 'none';

        }
        if (selValue >= "5") {
            document.getElementById('default_5').style.display = 'flex';
        } else {
            document.getElementById('default_5').style.display = 'none';

        }
        if (selValue >= "6") {
            document.getElementById('default_6').style.display = 'flex';
        } else {
            document.getElementById('default_6').style.display = 'none';

        }




    } else if ($("input[id='opt_html_text']:checked").val()) {
        if (selValue >= "1") {
            $("#showforoptdefault").hide();
            document.getElementById('text_html_1').style.display = 'flex';
        } else {
            document.getElementById('text_html_1').style.display = 'none';

        }

        if (selValue >= "2") {
            // document.getElementById( 'text_html_2' ).style.display = 'flex';
            $("#text_html_2").show();

        } else {
            $("#text_html_2").hide();
            // document.getElementById( 'default_2' ).style.display = 'none';

        }

        if (selValue >= "3") {
            document.getElementById('text_html_3').style.display = 'flex';
        } else {
            document.getElementById('text_html_3').style.display = 'none';

        }

        if (selValue >= "4") {
            document.getElementById('text_html_4').style.display = 'flex';
        } else {
            document.getElementById('text_html_4').style.display = 'none';

        }
        if (selValue >= "5") {
            document.getElementById('text_html_5').style.display = 'flex';
        } else {
            document.getElementById('text_html_5').style.display = 'none';

        }
        if (selValue >= "6") {
            document.getElementById('text_html_6').style.display = 'flex';
        } else {
            document.getElementById('text_html_6').style.display = 'none';

        }

    }

    var set = "";
    set += '<option disabled selected="true">Select Option</option>';
    for (var i = 1; i <= selValue; i++) {
        set += '<option value="' + i + '">Option ' + i + ' </option>';
    }

    quiz_answer.innerHTML = set;

}
</script>
















<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>



<!-- Bootstrap core JavaScript-->
<script src="{{asset('public/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('public/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{asset('public/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{asset('public/js/sb-admin-2.min.js')}}"></script>

<!-- Select2  -->
<!-- <script src="{{asset('public/select2/select2.min.js')}}" ></script>
<link rel="stylesheet" href="{{asset('public/select2/select2.min.css')}}" /> -->


</html>





<script>
$(document).ready(function() {
 

    $("#categoryLang").select2();
    var check_type_on_load_html = $('input[name="question_format_type"]:checked').val();
    // alert(check_type_on_load);
    if (check_type_on_load_html == 1) {

        $("#showforqueshtml").show();
        $("#showforquesdefault").hide();

        quesishtml();

    } else {
        $("#showforqueshtml").hide();
        $("#showforquesdefault").show();
    }

    var check_type_on_load_default = $('input[name="option_format_type"]:checked').val(); //alert(check_type_on_load_default)

    if (check_type_on_load_default == 0) {

        $("#showforoptdefault").show();
        $("#showforopthtml").hide();

    } else {
        $("#showforoptdefault").hide();
        $("#showforopthtml").show();
        optionishtml();
    }

});


var editor = CKEDITOR.replace('quiz_question_html', {
    extraPlugins: 'image2,uploadimage',
    filebrowserUploadUrl: "{{route('upload.image', ['_token' => csrf_token() ])}}",
    filebrowserUploadMethod: 'form',
    height: 200,
});

function quesishtml() {
    var check_type = $('input[name="question_format_type"]:checked').val();
    //   alert(check_type);
    if (check_type == 1) {

        $("#showforqueshtml").show();
        $("#showforquesdefault").hide();


    } else {
        $("#showforqueshtml").hide();
        $("#showforquesdefault").show();

    }

}


var editor = CKEDITOR.replace('quiz_option1_html', {
    extraPlugins: 'image2,uploadimage',
    filebrowserUploadUrl: "{{route('upload.image', ['_token' => csrf_token() ])}}",
    filebrowserUploadMethod: 'form',
    height: 200,

});

var editor = CKEDITOR.replace('quiz_option2_html', {
    extraPlugins: 'image2,uploadimage',
    filebrowserUploadUrl: "{{route('upload.image', ['_token' => csrf_token() ])}}",
    filebrowserUploadMethod: 'form',
    height: 200,

});

var editor = CKEDITOR.replace('quiz_option3_html', {
    extraPlugins: 'image2,uploadimage',
    filebrowserUploadUrl: "{{route('upload.image', ['_token' => csrf_token() ])}}",
    filebrowserUploadMethod: 'form',
    height: 200,

});

var editor = CKEDITOR.replace('quiz_option4_html', {
    extraPlugins: 'image2,uploadimage',
    filebrowserUploadUrl: "{{route('upload.image', ['_token' => csrf_token() ])}}",
    filebrowserUploadMethod: 'form',
    height: 200,

});
var editor = CKEDITOR.replace('quiz_option5_html', {
    extraPlugins: 'image2,uploadimage',
    filebrowserUploadUrl: "{{route('upload.image', ['_token' => csrf_token() ])}}",
    filebrowserUploadMethod: 'form',
    height: 200,

});

var editor = CKEDITOR.replace('quiz_option6_html', {
    extraPlugins: 'image2,uploadimage',
    filebrowserUploadUrl: "{{route('upload.image', ['_token' => csrf_token() ])}}",
    filebrowserUploadMethod: 'form',
    height: 200,

});



CKEDITOR.config.toolbarGroups = [{
        name: 'document',
        groups: ['mode', 'document', 'doctools']
    },
    {
        name: 'clipboard',
        groups: ['clipboard', 'undo']
    },
    {
        name: 'editing',
        groups: ['find', 'selection', 'spellchecker', 'editing']
    },
    {
        name: 'forms',
        groups: ['forms']
    },
    {
        name: 'basicstyles',
        groups: ['basicstyles', 'cleanup']
    },
    {
        name: 'paragraph',
        groups: ['list', 'indent', 'blocks', 'align', 'bidi', 'paragraph']
    },
    {
        name: 'links',
        groups: ['links']
    },
    {
        name: 'insert',
        groups: ['insert']
    },
    {
        name: 'styles',
        groups: ['styles']
    },
    {
        name: 'colors',
        groups: ['colors']
    },
    {
        name: 'tools',
        groups: ['tools']
    },
    {
        name: 'others',
        groups: ['others']
    },
    {
        name: 'about',
        groups: ['about']
    }
];


CKEDITOR.config.removeButtons =
    'Anchor,HorizontalRule,CopyFormatting,RemoveFormat,Cut,Copy,Paste,PasteText,PasteFromWord,Undo,Redo,Find,Replace,SelectAll,Scayt,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Templates,Save,NewPage,ExportPdf,Preview,Print,Strike,Language,Flash,Smiley,PageBreak,Iframe,TextColor,BGColor,Maximize,About,ShowBlocks,CreateDiv,Blockquote,Styles';


function optionishtml() {
    var check_type_option = $('input[name="option_format_type"]:checked').val();
    //   alert(check_type_option);
    if (check_type_option == 0) {

        $("#showforoptdefault").show();
        $("#showforopthtml").hide();

        // quesishtml();

    } else {
        $("#showforoptdefault").hide();
        $("#showforopthtml").show();
        // optionishtml();
    }

}
</script>