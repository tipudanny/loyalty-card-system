@extends('layouts.master')
@section('page-title', 'Loyalty Card')

@section('contetn-page-header')
    <!-- <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Vue Routing Page</li>
                    </ol>
                </div>
            </div>
        </div>
    </div> -->
@endsection

@section('main-content')
<router-view></router-view>
@endsection

@section('main-footer')
    <div class="float-right d-none d-sm-inline">
        Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  
@endsection