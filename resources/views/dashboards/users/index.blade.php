@extends('dashboards.admins.layouts.admin-dash-layout')
@section('title','Profile')

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
                <li class="breadcrumb-item"><a href="#">Home</a></li>
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
                    <img class="profile-user-img img-fluid img-circle admin_picture" src="{{ Auth::user()->picture }}" alt="User profile picture" >
                  </div>
  
                  <h3 class="profile-username text-center admin_name">{{Auth::user()->name}}</h3>
  
                  <p class="text-muted text-center">User</p>

                  <input type="file" name="admin_image" id="admin_image" style="opacity: 0;height:1px;display:none">
                  <a href="javascript:void(0)" class="btn btn-primary btn-block" id="change_picture_btn"><b>Change picture</b></a>
                  
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
  
          
            </div>
            
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
                      <form class="form-horizontal" method="POST" action="{{ route('adminUpdateInfo') }}" id="AdminInfoForm">
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
                            <input type="text" class="form-control" id="inputEmail" placeholder="Email" value="{{ Auth::user()->email }}" name="email" readonly>
                            <span class="text-danger error-text email_error"></span>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputEmail" class="col-sm-2 col-form-label">Phone</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputEmail" placeholder="+91 7305946336" value="{{ Auth::user()->phone }}" name="phone" >
                            <span class="text-danger error-text phone_error"></span>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputEmail" class="col-sm-2 col-form-label">Experience (Years)</label>
                          <div class="col-sm-10">
                            <input type="number" class="form-control" min="0" max="60" value="{{ Auth::user()->experience }}" name="experience" >
                            <span class="text-danger error-text experience_error"></span>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputEmail" class="col-sm-2 col-form-label">Notice (In days)</label>
                          <div class="col-sm-10">
                            <input type="number" class="form-control" min="0" max="120" value="{{ Auth::user()->notice }}" name="notice" >
                            <span class="text-danger error-text notice_error"></span>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputName2" class="col-sm-2 col-form-label">Skills</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control"  placeholder="Php, java" value="{{ Auth::user()->skill }}" name="skill">
                            <span class="text-danger error-text skill_error"></span>
                          </div>
                        </div>

                        <div class="form-group row">
                        <label class="col-sm-2 col-form-labe">Select Location</label>
                        <div class="col-lg-4">
                            <select class="form-control" name="location_id">
                                    @foreach($locationArr as $key=>$value)
                                        @if(\Auth::user()->location_id == $value['id'])
                                            <option value="{{$value['id']}}" selected="selected">{{$value['location']}}</option>
                                        @else
                                            <option value="{{$value['id']}}">{{$value['location']}}</option>
                                        @endif
                                    @endforeach
                               
                            </select>
                        </div>
                    </div>
                       <div class="form-group row">
                          <label for="inputName2" class="col-sm-2 col-form-label">Upload Resume</label>
                          <div class="col-lg-4">
                            <input type="file" class="form-control"  name="file" accept=".pdf">
                            <span class="text-danger error-text favoritecolor_error"></span>
                            </br>
                            <embed src="users/resumes/{{ Auth::user()->resume }}" type="application/pdf"   height="700px" width="500">

                         
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
                        <form class="form-horizontal" action="{{ route('adminChangePassword') }}" method="POST" id="changePasswordAdminForm">
                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Old Passord</label>
                            <div class="col-sm-10">
                              <input type="password" class="form-control" id="inputName" placeholder="Enter current password" name="oldpassword">
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
