<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Chat</title>
  <!-- <Raleway font> -->
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
   <!-- Montserrat font -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{asset('dashboard/dist/css/adminlte.css')}}">
  <link rel="stylesheet" href="{{asset('dashboard/plugins/fontawesome-free/css/all.min.css')}}">
  <style>
      th{
          padding:12px;
          text-align:right;
          font-size:17px;
          text-align:right;
      }
      td{
          padding-left:8px;
          font-size:15px;
          text-align:left;
      }
  </style>
</head>
<body class="bgrad">
  <main class="d-flex align-items-center min-vh-100 py-3 py-md-0 ">
   
    <div class="container" >
      <div class="col-lg-12">
        <div class="row">
            <div class="col-md-4 p-2" id="userbox">
                <div class="row">
                  <div class="col-md-3 pr-2">
                      <img src="{{ asset('dashboard/Media/UserAvatar.png') }}" class="img-thumbnail border border-0"alt="user avatar">
                    </div>
                    <div class="col-md-6" id="userStat">
                        <p style="padding-top:5%; margin-bottom:3%; font-weight: 600;">
                        {{Auth::user()->name}}
                        </p>
                        <form action="#" method="GET" id="myform">
                            <div class="form row">
                                <select name="Status" class ="form-status" id="status" onchange='submitForm();' style = "border-radius:0px; border:0px;">
                                    <option>
                                        Available
                                      </option>
                                      <option>
                                        Out of Office
                                      </option>
                                      <option>
                                        Off-desk
                                      </option>
                                </select>
                              </div>
                        </form>
                    </div>
                    <div class="col-md-3" id="userIcons">
                        <a href="javascript:history.go(0)"  style="color:black"><i class="fas fa-sync-alt"></i></a>
                        <span>
                            <a href="#"  class="float-right" style="color:black"><i id="icon" class="fas fa-eye"></i></a>
                        </span>
                       
                    </div>
                </div>
            </div>
            <div class="col-md-8 pt-4" id="userbox">
                <h4 style="font-weight:700;font-size:22px; margin-left:80px; margin-top:10px;font-family: montserrat;">
                    <i class="fas fa-tasks"></i> 
                    <span style="margin-left:20px">
                        TASK SCHEDULER
                    </span>
                </h4>

                  <!-- SEARCH FORM -->
                  <form class="form-inline" style="padding-left:700px;padding-bottom:4px">
                    <div class="input-group input-group-sm" style="background-color:#ccc6c6;border-radius:25px">
                        <input class="form-control form-control-navbar" id="searchtitlebar" onkeyup="search_titles()" name="search" type="search" placeholder="Search Titles" aria-label="Search" style="background-color:#ccc6c6;border-radius:25px" >
                            <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
        </div>
        <section style="min-height: 600px;">
            <div class="row">
                <div style="background-color: #535353; column-width: 65px; min-height: 600px; text-align:center">
                    <div class="iconscenter">

                            <a href="{{ route('home') }}"style="font-size:25px"><p style="color:#ebebeb"><i class="fas fa-columns"></i></p></a>

                            <a href="#" style="font-size:25px"><p style="color:#ebebeb"><i class="fas fa-users"></i></p></a>

                            <a href="#" style="font-size:25px"><p style="color:#ebebeb;background-color:#171515;padding-top:5px;"><i class="fas fa-tasks"></i></p> </a>

                            <a href="{{ route('logout') }}" style="font-size:25px"><p style="margin-top:200px;color:#ebebeb;"><i class="fas fa-sign-out-alt"></p></i></a>
 
                    </div>
                   
                </div>
                <div class="col-md-1">
                </div>
                <div class="col-md-9 scroll mt-4">
                
               @if(count(\App\Task::where('created_by_id', Auth::id())->get()) == 0)

                        <div id ="Add_task">
                            <h2 style="font-weight:800">ADD NEW TASK</h2>
                        </div>
                    
                @else

                    @foreach($tasks as $task)
                        @if(Auth::id() == $task->created_by_id)
                        
                    <div class="card chatbox">
                            <div class="card-header">
                                <!-- <a href="#" class="float-right" data-toggle="modal" data-target="#shareTask"><p><i class="fas fa-share"></i>  Share task</p></a> -->
                                <a href="#" onclick="toggle()" class="float-right" data-dismiss="modal"><p><i class="fas fa-share"></i>  Share task</p></a>
                            </div>
                            <div class="card-body-chat" onclick="charle(this)" href="#" data-toggle="modal" data-target="#view-task" data-taskTitle="{{$task->task_title}}" data-taskBody="{{$task->task_body}}" data-dateCreated="{{$task->created_at}}" data-dueDate="{{$task->due_date}}">
                                <h3 class="title">{{$task->task_title}}</h3>
                                <p style="font-weight:400;font-size:15px; width:80%; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;"> {{$task->task_body}}</p>
                            </div>
                            <div class="card-footer-chat">
                            <div style="column-width:50%">
                                <p>
                                    {{\Carbon\Carbon::createFromTimeStamp(strtotime($task->due_date))->diffForHumans()}}
                                    <a href="#" class="text-danger float-right" data-toggle="modal" data-target="#delete-modal-{{$task->id}}" style="margin-left:10px;color:white"><i class="fas fa-trash"></i></a> 
                                    <a href="#" class="text-success float-right" data-toggle="modal" data-target="#editTask-{{$task->id}}" style="margin-left:10px"><i class="fas fa-edit"></i></a>
                                    <a onclick="charle(this)" class="float-right text-info" data-toggle="modal" data-target="#view-task" data-taskTitle="{{$task->task_title}}" data-taskBody="{{$task->task_body}}" data-dateCreated="{{$task->created_at}}" data-dueDate="{{$task->due_date}}"><i class="fas fa-search-plus"></i></a>
                                </p>
                            </div>
                            </div>
                        
                            <!-- Edit Task Modal -->
                            <div class="modal fade" id="editTask-{{$task->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" >
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-size:35px;font-weight:700">Edit Task</h5>
                                                <a class="btn btn-sm" data-dismiss="modal" aria-label="Close">
                                                    <i class="fas fa-times float-right"></i>
                                                </a>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <form class="form-horizontal" action="{{ route('task.update', $task) }}" method="POST">
                                                        @csrf
                                                            {{ method_field('PUT') }}   

                                                        <div class="form-group row">
                                                            <label for="task_title" class="col-sm-2 col-form-label">Task Title</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" id="task_title" name="task_title" value="{{$task->task_title}}" class="form-control task @error('task_title') is-invalid @enderror" style="border-radius:0px;">

                                                                    @error('task_title')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group row shadow-textarea">
                                                            <label for="task_body" class="col-sm-2 col-form-label">Task Details</label>
                                                            <div class="col-sm-10">
                                                                <textarea class="form-control z-depth-1 task" id="task_body" name="task_body" value="" placeholder="" rows="7">{{$task->task_body}}</textarea>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group row">
                                                            <label for="due_date" class="col-sm-2 col-form-label">Due Date</label>
                                                            <div class="col-sm-10">
                                                                <input type="date" id="due_date" value="{{$task->due_date}}" name="due_date" class="form-control task @error('task_title') is-invalid @enderror" style="border-radius:0px;" required>
                                                                    @error('task_body')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="row">
                                                            <div class="col-sm-2">
                                                            
                                                            </div>
                                                            <div class="col-sm-10">
                                                            <button type="reset" class="btn btn-warning mr-3" style="border-radius:3px; padding-right: 45px;padding-left: 45px; padding-top:2px; padding-bottom: 2px;">Undo</button>
                                                            <button type="submit" class="btn btn-primary float-right" style="border-radius:3px;padding-right: 45px;padding-left: 45px; padding-top:2px; padding-bottom: 2px;">Apply Changes</button>              
                                                        </div>
                                    
                                                        </div>

                                                    </form> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>  
                                </div>
                            </div>

                            <!-- Delete Task Modal -->
                            <div class="modal fade" id="delete-modal-{{$task->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">\
                                
                                <div id="delete" class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <a class="btn btn-sm" data-dismiss="modal" aria-label="Close">
                                            <i class="fas fa-times float-right"></i>
                                        </a>
                                        <div class="modal-body">
                                            <h5 style="font-size:16px; font-weight:600; text-align:center">
                                                    Delete this Task?
                                            </h5>
                                        </div>
                                        <br>
                                        <div class="col-md-12">
                                            <a href="#"  data-dismiss="modal" class="btn-sm warning" >
                                                    <i class="fas fa-times"></i> Cancel
                                            </a>
                                            <a href="{{ route('task.destroy', $task->id ) }}" onclick="event.preventDefault(); document.getElementById('delete-task-form-{{$task->id}}').submit()"; class="float-right btn-sm danger">
                                                    <i class="fas fa-trash"></i> Delete
                                            </a>
                                            <form id="delete-task-form-{{$task->id}}" action="{{ route('task.destroy', $task->id ) }}" method="POST" style="display: none;">
                                                @csrf
                                                {{ method_field('DELETE') }}
                                            </form>
                                    
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>  

                        @else

                        @endif

                    @endforeach 

                @endif
           

                </div>
                <div class="col-md-1">
                    <button class="btn waves-effect float" data-toggle="modal" data-target="#AddTask">
                        <a href="#" class="" style="padding:40px 10px;font-weight:600;font-size:20px;">
                            <i class="fas fa-plus my-float"></i>
                        </a>
                    </button>
                       
                </div>
            </div>
        </section>
     </div> 

        <!-- Add Task Modal -->
        <div class="modal fade" id="AddTask" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="font-size:35px;font-weight:700">Add New Task</h5>
                            <a class="btn btn-sm" data-dismiss="modal" aria-label="Close">
                                <i class="fas fa-times float-right"></i>
                            </a>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form class="form-horizontal" action="{{ route('task.store') }}" method="POST">
                                    @csrf  

                                    <div class="form-group row">
                                        <label for="task_title" class="col-sm-2 col-form-label">Task Title</label>
                                        <div class="col-sm-10">
                                            <input type="text" id="task_title" name="task_title" value="{{old('$task->title')}}" class="form-control task @error('task_title') is-invalid @enderror" style="border-radius:0px;">

                                                @error('task_title')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row shadow-textarea">
                                        <label for="task_body" class="col-sm-2 col-form-label">Task Details</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control z-depth-1 task" id="task_body" name="task_body" value="{{old('$task->body')}}" placeholder="" rows="7"></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="due_date" class="col-sm-2 col-form-label">Due Date</label>
                                        <div class="col-sm-10">
                                            <input type="date" id="due_date" value="{{old('$task->due_date')}}" name="due_date" class="form-control task @error('task_title') is-invalid @enderror" style="border-radius:0px;" required>
                                                @error('task_body')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-sm-2">
                                        
                                        </div>
                                        <div class="col-sm-10">
                                        <button type="reset" class="btn btn-warning mr-3" style="border-radius:3px; padding-right: 45px;padding-left: 45px; padding-top:2px; padding-bottom: 2px;">Undo</button>
                                        <button type="submit" onclick="removeElement()" class="btn btn-primary float-right" style="border-radius:3px;padding-right: 45px;padding-left: 45px; padding-top:2px; padding-bottom: 2px;">Add Task</button>              
                                    </div>
                
                                    </div>

                                </form> 
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </div>

        <!-- View Task Modal -->
        <div class="modal fade" id="view-task" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="font-size:35px;font-weight:700" id="taskTitle"></h5>
                            <a class="btn btn-sm" data-dismiss="modal" aria-label="Close">
                                <i class="fas fa-times float-right"></i>
                            </a>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-lg-4">
                                <h3 style="font-size:18px;font-weight:700;text-align:right;padding:10px">
                                Task Description
                                </h3>
                                <h3 style="font-size:18px;font-weight:700;text-align:right;padding:10px">
                                Date Created
                                </h3>
                                <h3 style="font-size:18px;font-weight:700;text-align:right;padding:10px">
                                Due Date
                                </h3>
                                <h3 style="font-size:18px;font-weight:700;text-align:right;padding:10px">
                                Shared with
                                </h3>
                                </div>

                                <div class="col-lg-8">
                                <p style="font-size:18px;font-weight:400;text-align:left;padding:10px" id="taskBody">
                                </p>
                                <p style="font-size:18px;font-weight:400;text-align:left;padding:10px" id="dateCreated">
                                </p>
                                <p style="font-size:18px;font-weight:400;text-align:left;padding:10px" id="dueDate">
                                </p>
                                <p style="font-size:18px;font-weight:400;text-align:left;padding:10px">
                                </p>
                                </div>
                            
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </div>


        <!-- Share Task Modal -->
        <div id="shareTask">
            <div>
                <h5 style="font-size:20px;font-weight:700">Share With:
                    <a class="btn btn-sm float-right" onclick="toggle()" aria-label="Close">
                        <i class="fas fa-times float-right"></i>
                    </a>
                </h5>          
            </div>
            <div>
                <input id="searchbar" class="form-search" type="text" onkeyup="search_users()" placeholder="Search here..." name="search" aria-label="Search">
            </div>
            <div class="share">
                <table style="width:100%">
                    <tr>
                        <td>
                            <div class="btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-outline-secondary pad btn-block active">
                                    <img src="{{ asset('dashboard/Media/userAvatar.png') }}" class="img-size-50 rounded-circle">
                                    <input type="checkbox" unchecked autocomplete="off">James John
                                </label>
                                <label class="btn btn-outline-secondary pad btn-block active">
                                    <img src="{{ asset('dashboard/Media/userAvatar.png') }}" alt="" class="img-size-50 rounded-circle">
                                    <input type="checkbox" unchecked autocomplete="off">Sarah Abraham
                                  </label>
                                  <label class="btn btn-outline-secondary pad btn-block active">
                                    <img src="{{ asset('dashboard/Media/userAvatar.png') }}" alt="" class="img-size-50 rounded-circle">
                                    <input type="checkbox" unchecked autocomplete="off">Adom Arakwa
                                  </label>
                                  <label class="btn btn-outline-secondary pad btn-block active">
                                    <img src="{{ asset('dashboard/Media/userAvatar.png') }}" alt="" class="img-size-50 rounded-circle">
                                    <input type="checkbox" unchecked autocomplete="off">Free Shs
                                  </label>
                                  <label class="btn btn-outline-secondary pad btn-block active">
                                    <img src="{{ asset('dashboard/Media/userAvatar.png') }}" alt="" class="img-size-50 rounded-circle">
                                    <input type="checkbox" unchecked autocomplete="off">Tasker Bruhm
                                  </label>
                                  <label class="btn btn-outline-secondary pad btn-block active">
                                    <img src="{{ asset('dashboard/Media/userAvatar.png') }}" alt="" class="img-size-50 rounded-circle">
                                    <input type="checkbox" unchecked autocomplete="off">Fredrick Boakye
                                  </label>
                                  
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="mt-2">
                <button type="cancel" onclick="toggle()" class="btn btn-sm btn-danger ml-2" style="border-radius:3px;">Cancel</button>
                <button type="submit" onclick="toggle()" class="btn btn-sm btn-info float-right" style="border-radius:3px;">Share</button>              
            </div>
        </div>

        <!-- Lockscreen/Logout Modal -->
        <div id="logout">
            <div>
                
            </div>
        </div>
  </main>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script type="text/javascript">
    
    function removeElement(delAdd) {
    // Removes an element from the document
    var element = document.getElementById(delAdd);
    element.parentNode.removeChild(element);
    }

    function charle(element)
    {
        var taskBody = element.getAttribute("data-taskBody");
        document.getElementById("taskBody").innerHTML = taskBody;

        var taskTitle = element.getAttribute("data-taskTitle");
        document.getElementById("taskTitle").innerHTML = taskTitle;

        var dateCreated = element.getAttribute("data-dateCreated");
        document.getElementById("dateCreated").innerHTML = dateCreated;

        var dueDate =  element.getAttribute("data-dueDate");
        document.getElementById("dueDate").innerHTML = dueDate;
    }

  function toggle(){
    var shareTask = document.getElementById('shareTask');
    shareTask.classList.toggle('active');
  }

    //   function lg(){
    //     var logout = document.getElementById('logout');
    //     logout.classList.toggle('active');
    //   }

  $(function() 
  {
    $("span").click(function() {
        $("#icon").toggleClass("fa-eye fa-eye-slash");
    });
    });

  function search_users() 
    { 
        let input = document.getElementById('searchbar').value 
        input=input.toLowerCase(); 
        let x = document.getElementsByClassName('pad'); 
        
        for (i = 0; i < x.length; i++) {  
            if (!x[i].innerHTML.toLowerCase().includes(input)) { 
                x[i].style.display="none"; 
            } 
            else { 
                x[i].style.display="list-item";                  
            } 
        } 
    } 
    function search_titles() 
    { 
        let input = document.getElementById('searchtitlebar').value 
        input=input.toLowerCase(); 
        let x = document.getElementsByClassName('title'); 
        
        for (i = 0; i < x.length; i++) {  
            if (!x[i].innerHTML.toLowerCase().includes(input)) { 
                x[i].style.display="none"; 
            } 
            else { 
                x[i].style.display="";                  
            } 
        } 
    }
    function submitForm()
    { 
        // Call submit() method on <form id='myform'>
        document.getElementById('myform').submit();
    }  
    

  </script>

</body>
</html>
