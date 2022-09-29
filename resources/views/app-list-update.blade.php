@include('sidebar')

@include('header')

<head>
    <title>Add New - App</title>

    <link rel="icon" type="image/x-icon" href="{{asset('public/img/favi.png')}}">

    <!--   Core JS Files   -->
    <script src="{{asset('public/js/jquery.3.2.1.min.js')}}"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('public/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('public/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('public/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('public/js/sb-admin-2.min.js')}}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">




</head>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center mb-4 ">
        <h1 class="h3 mb-0 text-gray-800">Apps</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
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
                <a href="{{url('app-list')}}">Apps List</a>
            </li>
            <li class="separator">
                <i class="fas fa-greater-than"></i>
            </li>
            <li class="nav-item">
                <a href="#">Add Apps</a>
            </li>
        </ul>





        @if(Session::has('message'))
        <span class="d-none d-sm-inline-block">
            <p class="alert alertinfo text-white" style="background-color:#308930">{{ Session::get('message') }}
                </script>
            </p>
        </span>@endif

    </div>

</div>
<!-- End of Main Content-->


<script>
//success popup
$(document).ready(function() {
    $(".alertinfo").fadeOut(10000);
});
</script>




<section id="profile_update">
    <h3 class="h5 mb-4 text-gray-800 ml-4">Add Apps</h3>
    <hr />
    <div class="row">
        <div class="col-md-12">
            <div class="card-body">

                <form action="{{route('app-list.update',$apps->id)}}" name="accAdminFrm" id="accAdminFrm"
                    onSubmit="return validateAccountForm()" enctype="multipart/form-data" method="post"
                    accept-charset="utf-8">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-group form-inline" id="div_app_name">
                        <label for="app_name" class="col-md-2 col-form-label font-weight-medium">App Name<span
                                style="color:red;">&nbsp;*</span></label>
                        <div class="col-md-6 p-0">
                            <input type="text" name="app_name" value="{{$apps->app_name}}" id="app_name" placeholder="App Name"
                                class="form-control input-full required" />
                                @error('app_name')
                                    <div class="form-text text-danger err_msg">{{ $message }}</div>
                                @enderror
                            <small class="form-text text-danger err_msg" id="err_app_name"></small>
                        </div>
                    </div>


                    <div class="form-group form-inline" id="div_category_id">
                        <label for="package_name" class="col-md-2 col-form-label">Category Name <br> List <span
                                style="color:red;">&nbsp;*</span></label>
                        <div class="col-md-6 p-0">
                            <label class="control-label" for="description" style="display:flow-root;"><a href='#'
                                    id='dev_select-all'>Select All</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='#'
                                    id='dev_deselect-all'>Deselect All</a></label>
                                    <select name="category_id[]" class="form-control dev_mysel" id="category_id" multiple>
                                        @foreach($categories as $row)
                                        <option @foreach($newArr as $result) @if($result==$row->category_name) {{$row->category_name}} selected
                                        @endif @endforeach value="{{$row->id}}">{{$row->category_name}}</option>
                                        @endforeach
                                   </select>
                            <small class="form-text text-danger err_msg" id="err_category_id"></small>
                        </div>
                    </div>


                    <br>

                    <div class="form-group form-inline">
                        <label for="inlineinput" class="col-md-2 col-form-label "></label>
                        <div class="col-md-6 p-0">
                            <button name="appBtn" type="submit" value="true" id="appBtn"
                                class="btn btn-success">Submit</button>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button name="resetBtn" type="reset" value="true"
                                id="resetBtn" class="btn btn-warning" onclick="window.location.href='{{url("app-list")}}'">Cancel</button>
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
</section>




</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper-->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>



<!--custom style-->
<style>
.table-hover tbody tr:hover {
    background-color: #dde1e5;
}

.main-panel-custom {
    background-color: #DEE2E6;
    height: auto;
}
.text-danger{
    font-size:12.5px;
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
<script src="https://generateappicon.com/kids_education/assets/ap_assets/multi-select/jquery.quicksearch.js"></script>

<style type="text/css">
.ms-container {
    width: 100%;
}

.ms-container .ms-list {
    height: 130px;
}
</style>

<script type="text/javascript">
function validateAccountForm() {
    clrErr();
    $errStaus = false;
    var action = 'add';

    if (validateFormFields('app_name', 'Please enter the App Name.', '')) $errStaus = true;
    // if(validateFormFields('app_name_ref_id','Please enter the App name ref id.',''))$errStaus=true;

    if (validateFormFields('category_id', 'Please Select the Category name .', '')) $errStaus = true;


    if ($errStaus) {
        return false;
    } else {
        return true;
    }
}
</script>

</head>





</body>

<script>
$(document).ready(function() {

    $('.dev_mysel').multiSelect({

        selectableHeader: "<input type='text' class='search-input  form-control w-100' autocomplete='off' placeholder='Search...'>",
        selectionHeader: "<input type='text' class='search-input  form-control w-100' autocomplete='off' placeholder='Search...'>",

        afterInit: function(ms) {
            var that = this,
                $selectableSearch = that.$selectableUl.prev(),
                $selectionSearch = that.$selectionUl.prev(),
                selectableSearchString = '#' + that.$container.attr('id') +
                ' .ms-elem-selectable:not(.ms-selected)',
                selectionSearchString = '#' + that.$container.attr('id') +
                ' .ms-elem-selection.ms-selected';


            that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                .on('keydown', function(e) {
                    if (e.which === 40) {
                        that.$selectableUl.focus();
                        return false;
                    }
                });

            that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                .on('keydown', function(e) {
                    if (e.which == 40) {
                        that.$selectionUl.focus();
                        return false;
                    }
                });
        },
        afterSelect: function() {
            this.qs1.cache();
            this.qs2.cache();
        },
        afterDeselect: function() {
            this.qs1.cache();
            this.qs2.cache();
        }
    });

    //  $('.mysel2').multiSelect('select_all');


    $('#dev_select-all').click(function() {
        $('.dev_mysel').multiSelect('select_all');
        return false;
    });
    $('#dev_deselect-all').click(function() {
        $('.dev_mysel').multiSelect('deselect_all');
        return false;
    });


});


$(document).ready(function() {

    $('.tester_mysel').multiSelect({

        selectableHeader: "<input type='text' class='search-input  form-control w-100' autocomplete='off' placeholder='Search...'>",
        selectionHeader: "<input type='text' class='search-input  form-control w-100' autocomplete='off' placeholder='Search...'>",

        afterInit: function(ms) {
            var that = this,
                $selectableSearch = that.$selectableUl.prev(),
                $selectionSearch = that.$selectionUl.prev(),
                selectableSearchString = '#' + that.$container.attr('id') +
                ' .ms-elem-selectable:not(.ms-selected)',
                selectionSearchString = '#' + that.$container.attr('id') +
                ' .ms-elem-selection.ms-selected';


            that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                .on('keydown', function(e) {
                    if (e.which === 40) {
                        that.$selectableUl.focus();
                        return false;
                    }
                });

            that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                .on('keydown', function(e) {
                    if (e.which == 40) {
                        that.$selectionUl.focus();
                        return false;
                    }
                });
        },
        afterSelect: function() {
            this.qs1.cache();
            this.qs2.cache();
        },
        afterDeselect: function() {
            this.qs1.cache();
            this.qs2.cache();
        }
    });

    //  $('.mysel2').multiSelect('select_all');


    $('#tester_select-all').click(function() {
        $('.tester_mysel').multiSelect('select_all');
        return false;
    });
    $('#tester_deselect-all').click(function() {
        $('.tester_mysel').multiSelect('deselect_all');
        return false;
    });


});

function show_field(value = null) {
    if (value == 'android') {
        $("#show_a_field").show();
        $("#show_ios_field").hide();
        $("#ios_bundle_id").val('');
    } else if (value == 'ios') {
        $("#show_a_field").hide();
        $("#show_ios_field").show();
        $("#package_name").val('');
    } else {
        $("#show_a_field").hide();
        $("#show_ios_field").hide();
        $("#package_name").val('');
        $("#ios_bundle_id").val('');
    }
}
</script>

</html>