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
    <title>Category - Edit</title>


    <!-- CSS Files -->
    <link rel="stylesheet" href="{{asset('public/css/bootstrap.min.css')}}" />

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
                <a href="#">Category Edit</a>
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


                            <form  id="categoryUpdate" method="post">
                                <div class="form-group form-inline" id="div_language_name">
                                    <label for="language_name"
                                        class="col-md-2 col-xs-3 col-sm-3 col-form-label">Language Name<span
                                            style="color:red;">&nbsp;*</span></label>
                                    <div class="col-md-6 p-0">
                                        <select class="form-control required input-full language_name"
                                            name="language_id" id="language_name" style="width:100%" >
                                           
                                           @foreach($selects as $select)
                                           <option @if($category->language_id == $select->id) selected @endif value="{{$select->id}}">{{$select->name}}</option>
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
                                        <input type="text" name="category_name" value="{{$category->category_name}}"
                                            id="category_name" placeholder="Category Name"
                                            class="form-control input-full required" style="width:100%"  />
                                            <span class="text-danger" id="error_category_name"></span>                                    </div>
                                    </div>
                                </div>

                                <div class="form-group form-inline">
                                    <label for="inlineinput" class="col-md-2 col-xs-3 col-sm-3 col-form-label "></label>
                                    <div class="col-md-6 p-0">
                                        <button name="catbtn" type="submit" value="true" id="catbtn"
                                            class="btn btn-success">Submit</button>
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


$('#categoryUpdate').on('submit', function(event) {
    event.preventDefault();
    $('#error_language_name').text('');
    $('#error_category_name').text('');


    $.ajax({
        url: "{{route('add-category.update',$category->id )}}",
        type: "POST",
        data: {
            'language_id': $('#language_name').val(),
            'category_name' : $('#category_name').val(),
            "_token": "{{ csrf_token() }}",
        },
        success: function(response) {
            if (response) {
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

    $("#language_name").select2();

    $(document).ready(function() {
        if ($('.cat_audio_upload').is(":not(:checked)")) {
            $('.toggle_audio_field').hide();
        } else if ($('.cat_audio_upload').is(":checked")) {
            $('.toggle_audio_field').show();
        }
    });

    $('.cat_audio_upload').on('change', function() {

        if ($(this).is(":not(:checked)")) {
            $('.toggle_audio_field').hide();
        } else if ($(this).is(":checked")) {
            $('.toggle_audio_field').show();
            $('.toggle_audio_field').load(document.URL + ' .toggle_audio_field');
        }

    });
    </script>
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