@extends('admin.partials.layout')


@section('content')

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 style="font-weight: 800;">ALL USERS</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">All Users</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card card-solid">
        <div class="card-body pb-0">
          <div class="row d-flex align-items-stretch" >
          @foreach($users as $user)
            <div class="col-sm-4" >
              <div class="small-box bg-info" >
                <div class="card-header text-muted border-bottom-0">
                  {{$user->type? $user->type->name : '' }}
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-8">
                      <h2 class="lead"><b>{{$user->name}}</b></h2>
                      <ul class="ml-2 mb-0 fa-ul text-muted">
                        <li class = "small">
                          <p style="font-weight: 500;font-size:11px">
                            <i class="fas fa-lg fa-envelope"></i> {{$user->email}}
                          </p>
                        </li>

                        <li class = "small">
                          <p style="font-weight: 500;font-size:11px">
                            <i class="fas fa-lg fa-phone"></i> {{$user->phone}}               
                          </p>
                        </li>
                      
                      </ul>
                    </div>
                    <div class="col-4 text-center">
                      <img src="{{asset('dashboard/dist/img/user1-128x128.jpg')}}" alt="" class="img-circle img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                  @can('manage-users')
                    <a onclick="toggle(this)" class="btn btn-sm" data-toggle="modal" data-target="#user-modal" data-userName="{{$user->name}}" data-userEmail= "{{$user->email}}" data-userPermissions="{{ implode(' | ', $user->roles()->get()->pluck('name')->toArray())}}" data-userCreated_at="{{$user->created_at}}" data-userUpdated_at="{{$user->updated_at}}" data-userPhone="{{$user -> phone}}">
                      <i class="fas fa-search-plus"></i>
                    </a>
                    @endcan
                     @can('edit-users')
                    <a href="{{ route('users.edit', $user->id)}}" class="btn btn-sm bg-teal">
                      <i class="fas fa-edit"></i>
                    </a>
                    @endcan 
                    @can('delete-users')
                    <a onclick="del(this)" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete-modal-{{$user->id}}" style="color:white">
                      <i class="fas fa-trash"></i> Delete
                    </a>
                    @endcan
                  </div>
                </div>
              </div>
            </div> 
                <!--Delete User Modal -->
            <div class="modal fade" id="delete-modal-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" data-backdrop="false" aria-hidden="true">

              <!-- Add .modal-dialog-centered to .modal-dialog to vertically center the modal -->
              <div id="delete" class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  
                  <a onclick="del(this)" class="btn btn-sm" data-dismiss="modal" aria-label="Close" style="float-right;">
                    <i class="fas fa-times float-right"></i>
                    </a>
                  
                  <div class="modal-body">
                    <h5 style="font-size:16px; font-weight:600; text-align:center">
                    Delete this Account {{$user-> name}}?
                    </h5>
                  </div>
                  <br>
                <div class="col-md-12">
                  <a href="#" onclick="del(this)" data-dismiss="modal" class="btn-sm warning" >
                    <i class="fas fa-times"></i> Cancel
                  </a>
                  <a href="{{ route('users.destroy', $user->id ) }}" onclick="event.preventDefault(); document.getElementById('delete-user-form-{{$user->id}}').submit()"; class="float-right btn-sm danger">
                    <i class="fas fa-trash"></i> Delete
                  </a>
                    <form id="delete-user-form-{{$user->id}}" action="{{ route('users.destroy', $user->id ) }}" method="POST" style="display: none;">
                        @csrf
                        {{ method_field('DELETE') }}
                    </form>

                </div>
                </div>
              </div>
            </div>

            @endforeach   
           </div>

        <!-- /.card-footer -->
      </div>
      <div class="card-footer">
          <nav aria-label="Contacts Page Navigation">
            <ul class="pagination justify-content-center m-0">
              <li class="page-item active"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item"><a class="page-link" href="#">4</a></li>
              <li class="page-item"><a class="page-link" href="#">5</a></li>
              <li class="page-item"><a class="page-link" href="#">6</a></li>
              <li class="page-item"><a class="page-link" href="#">7</a></li>
              <li class="page-item"><a class="page-link" href="#">8</a></li>
            </ul>
          </nav>
        </div>

        
    </section>

    <!-- View User Modal -->
    <div class="modal fade" id="user-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="false" data-keyboard="false">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5>VIEW USER</h5>
                      <a onclick="del(this)" class="btn btn-sm" data-dismiss="modal" aria-label="Close" style="float-right;">
                        <i class="fas fa-times float-right"></i>
                      </a>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-lg-9">
                          <table style ="width:100%; padding:12px; font-size:14px;">
                          <tr>
                            <th>
                              Name
                            </th>
                            <td id="userName">
                              
                            </td>
                          </tr>
                          <tr>
                            <th>
                              Email
                            </th>
                            <td id ="userEmail">
                              
                            </td>
                          </tr>
                          <tr>
                            <th>
                              Mobile Number
                            </th>
                            <td id="userPhone">
                              
                            </td>
                            <tr>
                              <th>
                                Date Added
                              </th>
                              <td id="userCreated_at">
                                
                              </td>
                            </tr>
                            <tr>
                              <th>
                                Date Modified
                              </th>
                              <td id="userUpdated_at">
                               
                              </td>
                              <tr>
                                <th>
                                  Permissions
                                </th>
                                <td id="userPermissions">
                                  
                                </td>
                              </tr>
                            </tr>
                          </tr>
                          </table>
                        </div>
                        <div class="col-lg-3">
                        <!-- Default switch -->
                          <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitches">
                            <label class="custom-control-label" for="customSwitches"style="font-size:10px;">Disable Account</label>
                          </div>
                        </div>
                      </div>
                      </div>
                      <br>
                      <div class="col-lg-12">
                        <h6 style="text-align:center;font-weight: 600;border-bottom:solid grey 1px;">
                          ACTIVITY LOGS
                        </h6>
                      </div>
                      <div class="col-lg-12">
                        <table class="table table-striped" style ="width:100%; padding:0px; font-size:12px;">
                          <tr>
                            <th>
                              Scheduled a task for 2020-14-09 16:00:00
                            </th>
                            <td>
                              2020-01-09 08:00:00
                            </td>
                          </tr>
                          <tr>
                            <th>
                              Created a chatroom at 2020-12-08 18:00:20
                            </th>
                            <td>
                              2020-01-09 08:00:00
                            </td>
                          </tr>
                          <tr>
                            <th>
                              Joined a chatroom at 2020-12-08 13:00:20
                            </th>
                            <td>
                              2020-01-09 09:00:00
                            </td>
                          </tr>
                          <tr>
                            <th>
                              Joined a chatroom at 2020-12-08 18:00:20
                            </th>
                            <td>
                              2020-01-09 08:00:00
                            </td>
                          </tr>
                          <tr >
                            <th>
                              Created a chatroom at 2020-12-08 18:00:20
                            </th>
                            <td>
                              2020-01-09 08:00:00
                            </td>
                          </tr>
                        </table>
                      </div>
                      <div class="text-center col-lg-12">
                        <a href="#">
                          <i class="center fas fa-chevron-down"></i>
                        </a>
                      </div>
                    </div>
                  </div>


    </div>

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- jQuery -->
<script> "{{ asset('dashboard/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script> "{{ asset('dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script> "{{ asset('dashboard/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script> "{{ asset('dashboard/dist/js/demo.js') }}"></script>


<script type ="text/javascript">
  function toggle(element){
    var userName = element.getAttribute("data-userName");
    document.getElementById("userName").innerHTML = userName;
    // console.log(userName);

    var userEmail = element.getAttribute("data-userEmail");
    document.getElementById("userEmail").innerHTML = userEmail;

    var userPermissions = element.getAttribute("data-userPermissions");
    document.getElementById("userPermissions").innerHTML = userPermissions;

    var userCreated_at =  element.getAttribute("data-userCreated_at");
    document.getElementById("userCreated_at").innerHTML = userCreated_at;

    var userUpdated_at = element.getAttribute("data-userUpdated_at");
    document.getElementById("userUpdated_at").innerHTML = userUpdated_at;

    var userPhone = element.getAttribute("data-userPhone");
    document.getElementById("userPhone").innerHTML = userPhone;



    var blur = document.getElementById('blur');
    blur.classList.toggle('active')
    // var popup = document.getElementByClassName('popup')
    // popup.classList.toggle('active')
  }


  function del(){
    // var blur = document.getElementById('blur');
    // blur.classList.toggle('active')
    var delpop = document.getElementById('delpop');
    delpop.classList.toggle('active')
  }
</script>

@endsection

