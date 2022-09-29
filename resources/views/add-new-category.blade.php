@include('sidebar')

@include('header')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/x-icon" href="{{asset('public/img/favi.png')}}">
    <title>Category - Add - New</title>


    <!--   Core JS Files   -->

    <script src="{{asset('public/js/jquery.3.2.1.min.js')}}"></script>

    <!-- Select2  -->
    <script src="https://generateappicon.com/kids_education/assets/ap_assets/select2/select2.min.js"></script>


    <!--custom style-->
    <style>
    .table-hover tbody tr:hover {
        background-color: #dde1e5;
    }

    .main-panel-custom {
        background-color: #DEE2E6;
        height: auto;
    }

    span#select2-language_name-container {
        display: none;
    }
    </style>



    <!-- page js functions -->
    <script type="text/javascript">
    $(document).on('keypress change', ".required", function() {
        var ck_email = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
        var passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,20}$/;
        var fieldId = $(this).attr('id');
        var fieldVal = $(this).val();
        if (fieldId.indexOf('email') === -1) {
            var checkEmail = false;
        } else {
            var checkEmail = true;
        }
        if (fieldId.indexOf('userPassword') === -1) {
            var checkPassword = false;
        } else {
            var checkPassword = true;
        }
        if (checkEmail === true) {
            if (!ck_email.test(fieldVal)) {
                setMsg(fieldId, 'Please enter a valid email id.');
            } else {
                $('#div_' + fieldId).removeClass('has-error').addClass('has-success');
                $('#err_' + fieldId).html('');
            }
        } else if (checkPassword === true) {
            if (!passwordRegex.test(fieldVal)) {
                setMsg(fieldId, 'Minimum 8  characters, upper and lowercase letters and numeric digit.');
            } else {
                $('#div_' + fieldId).removeClass('has-error').addClass('has-success');
                $('#err_' + fieldId).html('');
            }
        } else {
            if (fieldVal == 0) {
                setMsg(fieldId, '');
            } else {
                $('#div_' + fieldId).removeClass('has-error').addClass('has-success');
                $('#err_' + fieldId).html('');
            }
        }
    });

    var ck_email = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    var ck_username = /^[A-Za-z0-9_]{1,20}$/;

    function clrErr() {
        $(".form-group, .checkbox,.col-xs-8").removeClass("has-error");
        $(".err_msg").hide();
    }

    function validateFormFields(fieldName, errMsg, fieldType, fieldValue = null) {
        // 		alert(fieldType)
        if (fieldType == 'radioClass') {
            console.log($('.' + fieldName).is(':checked').length);
            if ($('.' + fieldName).is(':checked').length == 0) {
                console.log('checked' + fieldType);
                setMsg(fieldName, errMsg);
                return true;
            } else {
                return false
            }
        } else if (fieldType == 'radio') {
            if ($("input[name=" + fieldName + "]:checked").length == 0) {
                setMsg(fieldName, errMsg);
                return true;
            } else {
                return false
            }
        } else if (fieldType == 'checkbox') {
            if ($("input[name='" + fieldName + "[]']:checked").length == 0) {
                setMsg(fieldName, errMsg);
                return true;
            } else {
                return false
            }
        } else {

            if (($.trim($('#' + fieldName).val()) == '' || $('#' + fieldName).val() == 0)) {
                setMsg(fieldName, errMsg);
                return true;
            } else if (fieldType == 'validEmail' && !ck_email.test($('#' + fieldName).val())) {
                setMsg(fieldName, 'Please enter a valid email id.');
                return true;
            } else if (fieldType == 'validUsername' && !ck_username.test($('#' + fieldName).val())) {
                setMsg(fieldName, 'Please enter a valid username .');
                return true;
            } else if (fieldType == 'validPass' && !passwordRegex.test($('#' + fieldName).val()) && ($('#' + fieldName)
                    .val())) {
                setMsg(fieldName, 'Minimum 8  characters, upper and lowercase letters and numeric digit!');
                return true;
            } else {
                return false;
            }
        }
    }

    function setMsg(fieldId, errMsg) {
        $('#div_' + fieldId).removeClass('has-success').addClass('has-error');
        $('#err_' + fieldId).fadeIn();
        $('#err_' + fieldId).html(errMsg);
        $('#' + fieldId).focus();
    }


    $(function() {
        hideErrorMessages();
        // 		$('input[type=checkbox], input[type=radio]').checkator();
    });

    function hideErrorMessages() {
        $('.alert-hide').delay(6000).fadeOut("slow");
    }


    function doSort(id, url) {
        url = url + '&sortBy=' + id;
        if ($("#sort_" + id).hasClass("fa-sort-down")) url = url + '&sortOrder=desc';
        else url = url + '&sortOrder=asc';
        // 	  console.log(url);console.log(id);
        window.location = url;
    }

    $(document).ready(function() {
        $('input:checkbox').click(function() {
            //  $(this).screwDefaultButtons("enable"); 	
        });

        $('#checkedAll').change(function() {
            if ($(this).is(':checked')) {
                $('.checkedAll').prop('checked', true);
                //$('.checkedAll').screwDefaultButtons("enable");
            } else {
                $('.checkedAll').prop('checked', false);
                //$('.checkedAll').screwDefaultButtons("disable"); 	
            }
        });

    });
    </script>

    <link rel="stylesheet" href="{{asset('public/css/multi-select.css')}}" type="text/css" />
    <script src="{{asset('public/js/jquery.multi-select.js')}}"></script>
    <script src="https://generateappicon.com/kids_education/assets/ap_assets/multi-select/jquery.quicksearch.js">
    </script>



    <style type="text/css">
    .ms-container {
        width: 100%;
    }

    .ms-container .ms-list {
        height: 130px;
    }

    .form-inline label {
        display: inline-table;
    }
    .text-danger{
        font-size:12.5px !important;
    }
    </style>

    <script type="text/javascript">
    function doActionFn(action, id) {
        if (action == 'edit' || action == 'view') {
            window.location = "{url('category/delete/')}}" + action + '/' + id;
        } else {
            $('#doAction').val(action);
            if (action == 'delete') {
                if (confirm("Are you sure you want to delete?")) {
                    $('#listFrm').submit();
                }
            } else {
                $('#listFrm').submit();
            }
        }
    }

    function validateAccountForm() {
        clrErr();
        $errStaus = false;
        var action = 'add';
        var lang_val = $('.language_name option:selected').val();
        if (lang_val == "") {
            // alert(lang_val);
            if (validateFormFields('language_name', 'Please enter the Language name.', '')) $errStaus = true;

        }

        if ($('.cat_audio_upload').is(':checked')) {
            // 		if(validateFormFields('category_audio','Please enter the password.',''))$errStaus=true;
            if (validateFormFields('categoryaudioUploadType', 'Please select the upload type.', '')) $errStaus = true;
            if ($('#categoryaudioUploadType').val() == 2) {
                if (validateFormFields('category_audio1', 'Please enter  URL.', '')) $errStaus = true;
            }

            // if(validateFormFields('category_audio','Please select file.',''))$errStaus=true;	
            if ($('#categoryaudioUploadType').val() == 1) {
                // 			if(action != 'edit'){
                if (validateFormFields('category_audio', 'Please select file.', '')) $errStaus = true;
                // 			}
                if ($('#category_audio').val() != '') {
                    var ext = $('#category_audio').val().split('.').pop().toLowerCase();
                    // var allow = new Array('mp4');
                    var allow = new Array('mp3');

                    if (jQuery.inArray(ext, allow) == -1) {
                        setMsg('category_audio', 'Please select valid file!');
                        $errStaus = true;
                    }
                }
            }
        }
        //   	if(validateFormFields('language_name','Please enter the Language Name.',''))$errStaus=true;
        if (validateFormFields('category_name', 'Please enter the Category Name.', '')) $errStaus = true;



        if (validateFormFields('categoryImageUploadType', 'Please enter upload type.', '')) $errStaus = true;
        if ($('#categoryImageUploadType').val() == 2) {
            if (validateFormFields('category_img1', 'Please enter  URL.', '')) $errStaus = true;
        }


        if ($('#categoryImageUploadType').val() == 1) {
            if (action != 'edit') {
                if (validateFormFields('category_img', 'Please select file.', '')) $errStaus = true;
            }
            if ($('#category_img').val() != '') {
                var ext = $('#category_img').val().split('.').pop().toLowerCase();
                // var allow = new Array('mp4');
                var allow = new Array('gif', 'png', 'jpg', 'jpeg', 'webp');

                if (jQuery.inArray(ext, allow) == -1) {
                    setMsg('category_img', 'Please select valid file!');
                    $errStaus = true;
                }
            }
        }



        if ($errStaus) {
            return false;
        } else {
            return true;
        }
    }

    function showPImgBox(value) {

        // 	$('#category_img1').hide();
        $('#div_category_img').hide();
        if (value == 2) {
            $('#div_category_img1').show();
            $('#div_category_img').hide();
        } else if (value == 1) {
            $('#div_category_img1').hide();
            $('#div_category_img').show();
        }

    }

    function showaudioBox(value) {

        // 	$('#category_img1').hide();
        $('#div_category_img').hide();
        if (value == 2) {
            $('#div_category_audio1').show();
            $('#div_category_audio').hide();
        } else if (value == 1) {
            $('#div_category_audio1').hide();
            $('#div_category_audio').show();
        }

    }
    </script>

</head>

<body>



    <div class="d-sm-flex align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800 ml-4 font-weight-bold">Category</h1>

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
                <a href="{{url('category-list')}}">Category List</a>
            </li>
            <li class="separator">
                <i class="fas fa-greater-than"></i>
            </li>
            <li class="nav-item">
                <a href="#">Add Category</a>
            </li>

        </ul>


        @if(Session::has('message'))
        <span class="d-none d-sm-inline-block">
            <p class="alert alertinfo text-white" style="background-color:#308930">{{ Session::get('message') }}
                </script>
            </p>
        </span>@endif
    </div>



    <section style="padding-top:0px !important;width:90%;margin:0 auto;">
        <div class="card">

            <div class="card-header">
                <div class="card-head-row">
                    <h4 class="card-title mt-3">Add Category</h4>

                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-body">

                            <form id="categoryData">

                                <div class="form-group form-inline" id="div_language_name">
                                    <label for="language_name"
                                        class="col-md-2 col-xs-3 col-sm-3 col-form-label">Language Name<span
                                            style="color:red;">&nbsp;*</span></label>
                                    <div class="col-md-6 p-0">
                                        <select class="form-control required input-full language_name"
                                            name="language_id" id="language_name" style="width:100%">
                                            <option selected="true" disabled="disabled">Select Language</option>
                                           
                                            @foreach($selects as $select)
                                           
                                            <option value="{{$select->id}}">{{$select->name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger" id="error_language_name"></span>
                                    </div>
                                </div>

                                <div class="form-group form-inline" id="div_category_name">
                                    <label for="category_name"
                                        class="col-md-2 col-xs-3 col-sm-3 col-form-label">Category Name<span
                                            style="color:red;">&nbsp;*</span></label>
                                    <div class="col-md-6 p-0">
                                        <input type="text" name="category_name" value="" id="category_name"
                                            placeholder="Category Name" class="form-control input-full required"
                                            style="width:100%" autocomplete="off" />
                                            <span class="text-danger" id="error_category_name"></span>                                    </div>
                                </div>



                                <div class="form-group form-inline">
                                    <label for="inlineinput" class="col-md-2 col-xs-3 col-sm-3 col-form-label "></label>
                                    <div class="col-md-6 p-0">
                                        <button name="catbtn" type="submit" class="btn btn-success">Submit</button>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button name="resetBtn" type="reset" value="true"
                                            id="resetBtn" class="btn btn-warning"
                                            onclick="window.location.href='{{url("category-list")}}'">Cancel</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        </div>
        <!--<footer class="footer">-->
        <!--</footer>-->
        </div>

        </div>
    </section>

    <script>
$(document).ready(function() {
    {{-- $(".alert-dismissible").hide(); --}}
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


$('#categoryData').on('submit', function(event) {
    event.preventDefault();
    $('#error_language_name').text('');
    $('#error_category_name').text('');


    $.ajax({
        url: "{{route('add-category.insert')}}",
        type: "POST",
        data: {
            'language_id': $('#language_name').val(),
            'category_name' : $('#category_name').val(),
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
                location.href= "{{url('category-list')}}";

                $("#success").animate({scrollTop: $(window).scrollTop(0)},"slow");
            }
        },

        error: function(response) {
            $('#error_language_name').text(response.responseJSON.errors.language_id);

            $('#error_category_name').text(response.responseJSON.errors.category_name);
  
        }
        
    });
});

</script>



    <script>
    //success popup
    $(document).ready(function() {
        $(".alertinfo").fadeOut(10000);
    });

    
    </script>
</body>

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



</body>

</html>