<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" type="image/x-icon" href="{{asset('img/favi.png')}}">


    <!-- Custom fonts for this template-->
    <link href="{{asset('public/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('public/css/sb-admin-2.min.css')}}" rel="stylesheet">





</head>


<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">

            <div class="sidebar-brand-text">ADMIN PANEL</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">


        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Interface
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed " href="#" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-th-list"></i>
                <span>Quiz</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">

                    <a class="collapse-item {{ Request::is('add-new-quiz') ? 'active' : '' }}"
                        href="{{url('add-new-quiz')}}">Add new Quiz</a>

                    <a class="collapse-item {{ Request::is('quiz-list*') ? 'active' : '' }}"
                        href="{{url('quiz-list')}}">Quiz List</a>

                    <a class="collapse-item {{ Request::is('add-new-category*') ? 'active' : '' }}"
                        href="{{url('add-new-category')}}">Add New Category</a>

                    <a class="collapse-item {{ Request::is('category-list*') ? 'active' : '' }}"
                        href="{{url('category-list')}}">Category List</a>

                    <a class="collapse-item   {{ Request::is('app-list*') ? 'active' : '' }}"
                        href="{{url('app-list')}}">Apps List</a>
                    <a class="collapse-item {{ Request::is('add-new-app*') ? 'active' : '' }}"
                        href="{{url('add-new-app')}}">Add New App</a>


                </div>
            </div>
        </li>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){
  $(".collapsed").click();
});
</script>


        <!-- Nav Item - Charts -->
        <li class="nav-item">
            <a class="nav-link" href="{{route('logout')}}">
                <i class="fa fa-sign-out"></i>
                <span>logout</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">