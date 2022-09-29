@include('sidebar')

@include('header')

<head>
    <title>App List</title>
    <link rel="icon" type="image/x-icon" href="{{asset('public/img/favi.png')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <meta name="csrf-token" content="{{csrf_token()}}">
</head>


<!-- Begin Page Content -->
<!-- <div class="container-fluid">
                     Page Heading -->
<div class="d-sm-flex align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800 ml-4 font-weight-bold">Apps</h1>


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
            <a href="#">Apps List</a>
        </li>

    </ul>

</div>
<section id="profile_update" style="padding-top:0px !important;">





    <div class="card">

        <div class="card-header">
            <div class="card-head-row">
                <h4 class="card-title mt-3">Apps List</h4>

                <div class="card-tools">
                    <ul class="nav nav-pills nav-secondary nav-pills-no-bd " role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active"
                                style="background: #28a745;!important;border-radius: 50px !important;;"
                                href="{{url('add-new-app')}}"> <i class="fa fa-plus"></i>&nbsp; Add New App</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>


        <!--notifiactions-->
        <div class="container text-center" id="">
            @if(Session::has('message'))
            <span class="d-none d-sm-inline-block">
                <p class="alert alertinfo text-white" style="background-color:#308930; margin-right:30px;margin-bottom: 0px;
                                    margin-top: 0px;">
                    {{ Session::get('message') }}</script>
                </p>
            </span>
            @endif

        </div>

        <div class="container" id="showActionErr"></div>
        <!--notifiactions-->

        <div class="card-body">
        
            <div class="row">
                <div class="col-md-12 " style="padding: 0rem 1.25rem;">
                    <!--<div class="text-left">-->
                    <!--<h3>Search</h3>-->
                    <!--</div>-->
                    <form action="{{route('applist.paginate')}}" method="get" >
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="searchKey">Search Key</label>
                                <input type="text" name="search"
                                    value="<?php if(isset($_GET['search'])) { echo $_GET['search']; } ?>"
                                    class="form-control required" autocomplete="off">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="searchBy">Search By</label>
                                <select name="select" class="form-control">
                                    <option value="" selected="true" disabled>Select</option>
                                    <option name="id" value="id" <?php if(isset($_GET["select"])){ if($_GET["select"]=="id"){ echo 'selected';} }?>>App ID</option>
                                    <option name="app_name" value="app_name" <?php if(isset($_GET["select"])){ if($_GET["select"]=="app_name"){ echo 'selected';} }?>>App Name</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="searchStatus">Status</label>
                                <select name="status" class="form-control"
                                    value="<?php if(isset($_GET['status'])) { echo $_GET['status']; } ?>" selected>
                                    <option value="all" <?php if(isset($_GET["select"])){ if($_GET["status"]=="all"){ echo 'selected';}} ?>>All</option>
                                    <option value="disabled" <?php if(isset($_GET["select"])){ if($_GET["status"]=="disabled"){ echo 'selected';} }?>>Disabled</option>
                                    <option value="enabled" <?php if(isset($_GET["select"])){ if($_GET["status"]=="enabled"){ echo 'selected';}} ?>>Enabled</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <button name="myAccountBtn" type="submit" value="true" id="myAccountBtn"
                                    class="btn btn-success btn-sm">Search</button>
                                &nbsp;<button name="resetAgrmtBtn" type="reset" value="true" id="myButton"
                                    class="btn btn-warning btn-sm" onclick="">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>






            <div class="btn-wrapper text-center d-flex justify-content-between">
                <div class="d-flex align-items-center">
                    <h4 class="card-title"> Apps List</h4>
                </div>
                <div class="d-flex align-items-center">
                    <form action="{{route('applist.paginate')}}" method="get">
                        <input type="hidden" name="listUrl" value="admin/app">

                        <select name="perPage" value="{{old('perPage')}}" class="form-control" id="perPage"
                            style="width:auto;" onchange="this.form.submit()">
                            <option value="5"
                                <?php if(isset($_GET['perPage']) && ($_GET['perPage'])=="5"){ echo "selected"; } ?>>5
                            </option>
                            <option value="10"
                                <?php if(isset($_GET['perPage'])  && ($_GET['perPage']) =="10"){ echo "selected"; } ?>>
                                10</option>
                            <option value="25"
                                <?php if(isset($_GET['perPage'])  && ($_GET['perPage']) =="25"){ echo "selected"; } ?>>
                                25</option>
                            <option value="50"
                                <?php if(isset($_GET['perPage'])  && ($_GET['perPage']) =="50"){ echo "selected"; } ?>>
                                50</option>
                            <option value="75"
                                <?php if(isset($_GET['perPage']) && ($_GET['perPage']) =="75"){ echo "selected"; } ?>>75
                            </option>
                            <option value="100"
                                <?php if(isset($_GET['perPage']) && ($_GET['perPage']) =="100"){ echo "selected"; } ?>>
                                100</option>
                            <option value="150"
                                <?php if(isset($_GET['perPage']) && ($_GET['perPage']) =="150"){ echo "selected"; } ?>>
                                150</option>
                        </select>
                    </form>
                </div>
            </div>

            <div class="btn-wrapper text-center d-flex justify-content-between">
                <div class="d-flex align-items-center">

                    <h4 class="card-title"> Total App : <?php $count = DB::table('apps')->count(); echo $count; ?> </h4>

                </div>
                <div class="d-flex align-items-center">
                    <div class="form-group col-md-4">
                        <div class="">
                        </div>
                    </div>
                </div>
            </div>

            <form action="" name="listFrm" id="listFrm" method="post" accept-charset="utf-8">
                <input type="hidden" name="doAction" value="" id="doAction">
                <div class="table-responsive">
                    <table id="feedback_list_table" class="display table table-striped table-hover table-bordered ">

                        <thead>
                            <input type="hidden" name="listUrl" value="">
                            <tr>
                                <!-- <th><input type="checkbox" name="checkedAll" value="" id="checkedAll">
                                                    </th> -->
                                <th><input type="checkbox" id="master"></th>


                                <th>#</th>




                                @if(url('app-list/app/id/asc') == url()->current())
                                <th id="sort_desc_id">App ID<i class="fas fa-sort " name="sort_desc_id"></i></th>
                                @else
                                <th id="sort_asc_id">App ID<i class="fas fa-sort " name="sort_asc_id"></i></th>
                                @endif

                                @if(url('app-list/app/app_name/asc') == url()->current())
                                <th id="desc_app_name">App Name <i class="fas fa-sort "></i></th>
                                @else
                                <th id="asc_app_name">App Name <i class="fas fa-sort "></i></th>
                                @endif

                                @if(url('app-list/app/category_id/asc') == url()->current())
                                <th id="desc_category_id">Mapping Category <i class="fas fa-sort "></i></th>
                                @else
                                <th id="asc_category_id">Mapping Category <i class="fas fa-sort "></i></th>
                                @endif

                                <th class="text-center">Action</th>

                                @if(url('app-list/app/created_at/asc') == url()->current())
                                <th id="desc_created_at">Created<i class="fas  fa-sort "></i></th>
                                @else
                                <th id="asc_created_at">Created<i class="fas  fa-sort " id="sort_created_at"></i></th>
                                @endif
                                <th onclick="">Status</th>




                            </tr>
                        </thead>

                        <tbody>

                            @if(!empty($data) && $data->count())

                            @php $i = (($data->currentPage() - 1)*$data->perPage()) + 1; @endphp
                            @foreach($data as $key => $selects)

                            <tr>
                                <td>
                                    <input type="checkbox" class="sub_chk" data-id="{{$selects->id}}">
                                </td>

                                <!-- <input type="checkbox" name="appIds[]" value="3" id="checked_3" class="checkedAll"> -->
                                </td>

                                <td>{{$i++ }} 
                                </td>
                                <td>{{$selects->id}}</td>

                                <td>{{$selects->app_name}}</td>
                                <td style="white-space: normal;" class="cat_list_box">{{$selects->category_id_as_name}}
                                </td>
                                <td class="text-center">
                                    <div class="form-button-action">


                                        <a href="{{url('app-list/edit', $selects->id )}}" data-toggle="tooltip" title=""
                                            class="btn btn-white text-primary" data-original-title="Edit">
                                            <i class="fas fa-pencil-alt "></i></a>

                                        <a href="{{ url('app-list/delete',$selects->id) }}" data-toggle="tooltip"
                                            title="" class="btn btn-white text-danger delbtn"
                                            data-original-title="Delete" data-tr="tr_{{$selects->id}}"
                                            data-toggle="confirmation" data-btn-ok-label="Delete"
                                            data-btn-ok-icon="fa fa-remove" data-btn-ok-class="btn btn-sm btn-danger"
                                            data-btn-cancel-label="Cancel"
                                            data-btn-cancel-icon="fa fa-chevron-circle-left"
                                            data-btn-cancel-class="btn btn-sm btn-default"
                                            data-title="Are you sure you want to delete ?" data-placement="top"
                                            data-singleton="true">
                                            <i class="fas fa-trash "></i>

                                        </a>

                                        <!-- <a type="button" href="{{url('app-list/delete/'.$selects->id)}}"  data-toggle="tooltip" title="" class="btn btn-white text-danger delbtn" data-original-title="Delete">
                                            						<i class="fas fa-trash "></i>
																	</a> -->

                                    </div>
                                </td>
                                <td> @php
                                        $date = $selects->created_at;
                                        $dt = new DateTime($date);
                                        echo $dt->format('d-m-Y');
                                        $interval = $dt->diff(new DateTime());
                                    @endphp</td>
            </form>
            <form action="{{url('app-list/update-status/'.$selects->id)}}" method="post">
                @csrf
                @if($selects->status == '1')
                <td>

                    <button type="submit" data-toggle="tooltip" data-original-title="Enable" id="enable" name="enable"
                        title="" class="btn btn-xs btn-icon btn-round btn-success">
                        <i class="fa fa-check"></i>
                    </button>

                </td>
                @endif


                @if($selects->status == '2')
                <td>

                    <button type="submit" data-toggle="tooltip" data-original-title="Disable" id="disable" title=""
                        name="disable" class="btn btn-xs btn-icon btn-round btn-success"
                        style="background: #ffad46!important;border-color: #ffad46!important;color: #fff!important;">
                        <i class="fa fa-ban"></i>
                    </button>

                </td>
                @endif
                </td>
                <!-- </form> -->
                </tr>

                @endforeach

                @else
                <tr>
                    <td colspan="8" class="text-center">Result not found.</td>
                </tr>
                @endif
                </tbody>
                </table>
        </div>



        </form>
    </div>



    <div class="card-footer ">
        <div class="btn-wrapper text-center d-flex justify-content-between">
            <div class="d-flex align-items-center">
                <h4 class="card-title"></h4>
            </div>
            <div class="d-flex align-items-center">
                <div class="form-group col-md-4">
                    <div class="">
                    </div>
                </div>
            </div>
        </div>
        <div class="btn-wrapper text-center d-flex justify-content-between">
            <div class="d-flex align-items-center">
                <label for="inlineinput" class="col-form-label "> With Selected &nbsp;&nbsp;&nbsp;&nbsp; </label>
                <div class="p-0">
                    <button type="button" class="btn btn-success btn-sm btn-enable delete_all" title="Enable"
                        data-action="enable"> <i class="far fa-check-circle"></i> Enable </button>
                    <button type="button" class="btn btn-warning btn-sm btn-disable delete_all" title="Disable"
                        data-action="disable"> <i class="fas fa-ban"></i> Disable</button>
                    <button type="button" class="btn btn-danger btn-sm  btn-delete delete_all" title="Delete"
                        data-action="delete"> <i class="fas fa-trash"></i> Delete</button>
                </div>
            </div>
            <div class="d-flex align-items-center">
            {{ $data->appends(request()->input())->links()}}


            </div>
        </div>
    </div>
    </div>
</section>




<!-- page js functions -->
<script type="text/javascript">
var url = "{{ url(''); }}";



//id
$(document).ready(function() {


    <?php
    
    if(isset($_GET['perPage'])){
    $page=$_GET['perPage'];
    
 } ?>

    var page = '<?php if(isset($_GET['perPage'])){ echo $page; }?>';



    //app_id
    $("#sort_asc_id").click(function() {
        window.location.href = url + "/app-list/app/id/asc?perPage=" + page;

    });

    $("#sort_desc_id").click(function() {
        window.location.href = url + "/app-list/app/id/desc?perPage=" + page;

    });


    //app_name
    $("#asc_app_name").click(function() {
        window.location.href = url + "/app-list/app/app_name/asc?perPage=" + page;

    });


    $("#desc_app_name").click(function() {
        window.location.href = url + "/app-list/app/app_name/desc?perPage=" + page;

    });

    $("#asc_created_at").click(function() {
        window.location.href = url + "/app-list/app/created_at/asc?perPage=" + page;


    });

    $("#desc_created_at").click(function() {
        window.location.href = url + "/app-list/app/created_at/desc?perPage=" + page;

    });

    $("#desc_category_id").click(function() {
        window.location.href = url + "/app-list/app/category_id/desc?perPage=" + page;


    });

    $("#asc_category_id").click(function() {
        window.location.href = url + "/app-list/app/category_id/asc?perPage=" + page;


    });




});










//reset button redirect
document.getElementById("myButton").onclick = function() {
    location.href = "{{url('app-list')}}";
};


//success popup
$(document).ready(function() {
    $(".alert.alertinfo").fadeOut(15000);
});



    

$(document).ready(function() {
    $('.delbtn').click(function() {
        alert('are you sure?');

    });
});



$(function() {
    $('[data-toggle="tooltip"]').tooltip()
})
</script>

<style>
.cat_list_box {
    height: auto !important;
    white-space: normal !important;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
}

.table-responsive td {
    display: revert;
}
</style>

<script type="text/javascript">
$(document).ready(function() {


    $('#master').on('click', function(e) {
        if ($(this).is(':checked', true)) {
            $(".sub_chk").prop('checked', true);
        } else {
            $(".sub_chk").prop('checked', false);
        }
    });



    $('.delete_all').on('click', function(e) {


        var allVals = [];
        $(".sub_chk:checked").each(function() {
            allVals.push($(this).attr('data-id'));
        });


        if (allVals.length <= 0) {
            alert("Please select row.");
        } else {


            // var check = confirm("Are you sure you want to delete this row?");  
            // if(check == true){  


            var join_selected_values = allVals.join(",");
            action = $(this).data('action');

            $.ajax({
                url: '{{ url('ApplistAction ')}}',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: 'ids=' + join_selected_values + '&action=' + action,
                success: function(data) {
                    if (data['success']) {
                        // $(".sub_chk:checked").each(function() {  
                        //     $(this).parents("tr").remove();
                        // });
                        location.reload('');
                        alert(data['success']);
                    } else if (data['error']) {
                        alert(data['error']);
                    } else {
                        alert('Whoops Something went wrong!!');
                    }
                },
                error: function(data) {
                    alert(data.responseText);
                }
            });


            $.each(allVals, function(index, value) {
                $('table tr').filter("[data-row-id='" + value + "']").remove();
            });
            // }  
        }
    });



    // $('[data-toggle=confirmation]').confirmation({
    //     rootSelector: '[data-toggle=confirmation]',
    //     onConfirm: function (event, element) {
    //         element.trigger('confirm');
    //     }
    // });


    $(document).on('confirm', function(e) {
        var ele = e.target;
        e.preventDefault();


        $.ajax({
            url: ele.href,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                if (data['success']) {
                    $("#" + data['tr']).slideUp("slow");
                    alert(data['success']);
                } else if (data['error']) {
                    alert(data['error']);
                } else {
                    alert('Whoops Something went wrong!!');
                }
            },
            error: function(data) {
                alert(data.responseText);
            }
        });


        return false;
    });
});
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