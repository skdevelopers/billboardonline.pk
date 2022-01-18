@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/back/vendor/dropzone/dist/min/dropzone.min.css')}}">

    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <link type="text/css" rel="stylesheet" href="{{asset('assets/back/jquery-plugin/image-uploader/src/image-uploader.css')}}">
@endsection

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Profile</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
                    <li class="breadcrumb-item active">User Profile</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            @if (Auth::user()->logo == null)
                                <img  class="profile-user-img img-fluid img-circle logo" src="{{ asset('assets/images') . '/' . 'logo.png' }}" alt="No photo">
                            @else
                                <img class="profile-user-img img-fluid img-circle admin_picture" src="{{ asset('logos') . '/' . Auth::user()->logo }}" alt="Logo">
                            @endif
                        </div>

                        <h3 class="profile-username text-center admin_name">{{Auth::user()->name}}</h3>

                        <p class="text-muted text-center">{{Auth::user()->mobile_num}}</p>

                        <form action="{{ route('admin.profile.upload') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="col-md-6">
                                    <input type="file" name="logo" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-success">Upload</button>
                                </div>

                            </div>
                        </form>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            @if(Session::has('success'))
                <div class="alert alert-info alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    {{Session::get('success')}}
                </div>
            @endif
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#personal_info" data-toggle="tab">Personal Information</a></li>
                            <li class="nav-item"><a class="nav-link" href="#change_password" data-toggle="tab">Change Password</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="personal_info">
                                <form class="form-horizontal" method="POST" action="{{ url('admin/profile/update/') }}" id="AdminInfoForm">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputName" placeholder="Name" value="{{ Auth::user()->name }}" name="name">

                                            <span class="text-danger error-text name_error"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputEmail" placeholder="Email" value="{{ Auth::user()->email }}" name="email">
                                            <span class="text-danger error-text email_error"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName2" class="col-sm-2 col-form-label">Company Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputName2" placeholder="company name" value="{{ Auth::user()->company_name }}" name="company_name">
                                            <span class="text-danger error-text company_name_error"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="owner_name" class="col-sm-2 col-form-label">Owner Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="owner_name" placeholder="owner name" value="{{ Auth::user()->owner_name }}" name="owner_name">
                                            <span class="text-danger error-text owner_name_error"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="mobile_num" class="col-sm-2 col-form-label">Mobile Number</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="mobile_num" placeholder="mobile name" value="{{ Auth::user()->mobile_num }}" name="mobile_num">
                                            <span class="text-danger error-text mobile_num_error"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="whatsapp_num" class="col-sm-2 col-form-label">Whatsapp Number</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="whatsapp_num" placeholder="whatsapp number" value="{{ Auth::user()->whatsapp_num }}" name="whatsapp_num">
                                            <span class="text-danger error-text whatsapp_num_error"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" class="btn btn-danger">Save Changes</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="change_password">
                                <form class="form-horizontal" action="{{ route('admin.profile.change.password') }}" method="POST" id="changePasswordAdminForm">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="oldpassword" class="col-sm-2 col-form-label">Old Passord</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="oldpassword" placeholder="Enter current password" name="oldpassword">
                                            <span class="text-danger error-text oldpassword_error"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName2" class="col-sm-2 col-form-label">New Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="newpassword" placeholder="Enter new password" name="newpassword">
                                            <span class="text-danger error-text newpassword_error"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName2" class="col-sm-2 col-form-label">Confirm New Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="cnewpassword" placeholder="ReEnter new password" name="cnewpassword">
                                            <span class="text-danger error-text cnewpassword_error"></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" class="btn btn-danger">Update Password</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
@section('scripts')

@endsection
