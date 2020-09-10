@extends('admin.partials.layout')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 style="font-weight: 800;">MODIFY USER</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Modify User</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-2"></div>
          <div class="col-md-8">
            <!-- general form elements -->
            <!-- Add User Form -->
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title"style="color:white;">Horizontal Form</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="{{ route('users.update', $user) }}" method="POST">
                    @csrf
                        {{ method_field('PUT') }}
                    <div class="card-body">
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">User Name</label>
                        
                        <div class="col-sm-10">
                        <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autofocus style="border-radius:0px;">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>

                        <div class="col-sm-10">
                        <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" style="border-radius:0px;" name="email" value="{{ $user->email }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row">
                      <label for="mobilenumber" class="col-sm-2 col-form-label">Number</label>
                        <div class="col-sm-10">
                          <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"  value= "{{ $user->phone }}"id="phone" style="border-radius:0px;" placeholder="Enter mobile number">
                             @error('phone')
                               <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                               </span>
                              @enderror
                          </div>
                      </div>

                    <div class="form-group row">
                        <label for="UserTypes" class="col-sm-2 col-form-label">User Type</label>
                        <div class="col-sm-10">
                          <select name="type_id" class ="form-control" id="userType" style = "border-radius:0px;">
                           
                            @foreach(\App\UserType::all() as $type)
                              <option value="{{$type->id}}">{{$type->name}}</option>
                            @endforeach
                            
                          </select>
    
                            @error('type_id')
                              <span class="invalid-feedback" role="alert">
                               <strong>{{ $message }}</strong>
                              </span>
                            @enderror

                        </div>
                    </div>


                    <br>
                    <div class ="row">
                        <div class="col-md-2">
                            <h5 style="font-weight: 600;font-size:15px">
                                Permissions
                            </h5>
                        </div>
                        <div class="col-md-10">
                            @foreach($roles as  $key => $role)
                            <ul style="padding-left:0px;">
                                <div class="custom-control custom-switch form-check" style="font-size:13px;">
                                    <input type="checkbox" class="custom-control-input" id="customSwitch{{1+$key}}" type="checkbox" name = "roles[]" value="{{ $role->id}}"
                                        @if($user->roles->pluck('id')->contains($role->id)) checked @endif>
                                        <label class="custom-control-label" for="customSwitch{{1+$key}}" style="font-weight:600;">{{$role->name}}</label>
                                </div>
                            </ul>
                            @endforeach
                        </div>
                    </div>

                    <div class="row">
                        
                        <div class="col-sm-2">
                            
                        </div>
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-warning mr-3" style="border-radius:3px; padding-right: 45px;padding-left: 45px; padding-top:2px; padding-bottom: 2px;">Undo</button>
                            <button type="submit" class="btn btn-primary float-right" style="border-radius:3px;padding-right: 45px;padding-left: 45px; padding-top:2px; padding-bottom: 2px;">Apply Changes</button>              
                        </div>

                    </div>  
                        
                    
                    
                    

                </div>
              </form>
            </div>
            <!-- /.card -->

          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection