<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Chat</title>
  <!-- <Raleway font> -->
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
   <!-- Montserrat font -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{asset('dashboard/dist/css/adminlte.css')}}">
  <link rel="stylesheet" href="{{asset('dashboard/plugins/fontawesome-free/css/all.min.css')}}">
  <script>
        var base_url = '{{ url("/") }}';
    </script>
  <style>
      th{
          padding:12px;
          text-align:right;
          font-size:17px;
          text-align:right;
          width:150px;
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
                        <form action="{{route ('patch.user.update' , Auth::user()->id)}}" method="POST" id="myform">
                            {{method_field('PATCH')}}
                                @csrf
                           
                            <div class="form row">
                                <select name="status" class ="form-status" id="status" onchange='submitForm();' style = "border-radius:0px; border:0px;">
                                @foreach(\App\Status::all() as $status)
                                    <option value="{{$status->id}}" {{Auth::user()->status_id == $status->id ? 'selected' : ''}}>
                                        {{$status->status_body}}
                                    </option>
                                @endforeach
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
                <h4 style="font-weight:800;font-size:28px; margin-left:80px; margin-top:10px;font-family: montserrat;">
                <i class="far fa-calendar-check"></i>
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
                        @can('manage-users')
                            <a href="{{ route('home') }}"style="font-size:25px"><p style="color:#ebebeb"><i class="fas fa-columns"></i></p></a>
                        @endcan
                            <a href="#" style="font-size:25px"><p style="color:#ebebeb"><i class="fas fa-users"></i></p></a>

                            <a href="#" style="font-size:25px"><p style="color:#ebebeb;background-color:#171515;padding-top:5px;"><i class="fas fa-tasks"></i></p> </a>
 
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
                                <div class="card-body-chat" onclick="viewTask(this)" href="#" data-toggle="modal" data-target="#view-task" data-taskTitle="{{$task->task_title}}" data-taskBody="{{$task->task_body}}" data-dateCreated="{{$task->created_at}}" data-dueDate="{{$task->due_date}}">
                                    
                                    <h3  class="title">{{$task->task_title}}</h3>

                                    <p style="font-weight:400;font-size:15px; width:80%; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;"> {{$task->task_body}}</p>
                                </div>
                                <div class="card-footer-chat">
                                    <div style="column-width:50%">
                                    
                                        <div class="row mb-2">
                                                <div class="col-md-3">
                                                    <div class ="countdown"></div>
                                                    <!-- <b>{{\Carbon\Carbon::createFromTimeStamp(strtotime($task->due_date))->diffForHumans()}}</b> -->
                                                    <!-- <p><time class="timeago" datetime="{{$task->due_date}}"></time></p> -->
                                                </div>
                                            <div class="col-md-6">
                                                    <div class="progress progress-xs" style="margin-top: 9px">
                                                        <div class="progress-bar {{$task->progress_bar_color}} progress-bar-striped" role="progressbar"
                                                          id="aria"  aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: {{$task->time_percentage}}%" data-taskTitle="{{$task->task_title}}" data-taskBody="{{$task->task_body}}" data-dateUpdated="{{$task->updated_at}}" data-dueDate="{{$task->due_date}}">
                                                        
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="col-md-3">
                                                    
                                                    <a href="#" class="text-danger float-right" data-toggle="modal" data-target="#delete-modal-{{$task->id}}" style="margin-left:10px;color:white"><i class="fas fa-trash"></i></a> 
                                                    <a href="#" class="text-success float-right" data-toggle="modal" data-target="#editTask-{{$task->id}}" style="margin-left:10px"><i class="fas fa-edit"></i></a>
                                                    <a onclick="viewTask(this)" class="float-right text-info" data-toggle="modal" data-target="#view-task" data-taskTitle="{{$task->task_title}}" data-taskBody="{{$task->task_body}}" data-dateCreated="{{$task->created_at}}" data-dueDate="{{$task->due_date}}"><i class="fas fa-search-plus"></i></a>
                                            </div>
                                        </div>
                                        
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
                                                                <input type="datetime" id="due_date" value="{{$task->due_date}}" name="due_date" class="form-control task @error('task_title') is-invalid @enderror" style="border-radius:0px;" required>
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
                <div class="col-md-1" style="min-height:300px">
                    <button class="btn waves-effect float" data-toggle="modal" data-target="#AddTask">
                        <a href="#" class="" style="padding:40px 10px;font-weight:600;font-size:20px;">
                            <i class="fas fa-plus my-float"></i>
                        </a>
                    </button>
                       
                </div>
            </div>
            <div class="row chatbg">
                <div class="col-lg-3" style="margin-left:15px;margin-bottom:7px;margin-top:-2.5px">
                    <a href="{{ route('logout') }}" style="font-size:25px; color:#ebebeb;"><i class="fas fa-sign-out-alt" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"></i>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    <button class="btn" onclick="Chat()" style="margin-left:30px;margin-top:-1px">
                        <label class="btn btn-outline-secondary cad btn-block">
                            <i class="far fa-comments"></i> CHAT 
                        </label> 
                    </button>
                </div>
                <div class="col-lg-6">
                </div>
                <div class="col-lg-2 lock" style="margin-top:6px" id="clock">
                
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
                                            <input type="text" id="task_title" name="task_title" value="{{old('$task->title')}}" class="form-control task @error('task_title') is-invalid @enderror" style="border-radius:0px;" required>

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
                                            <textarea class="form-control z-depth-1 task" id="task_body" name="task_body" value="{{old('$task->body')}}" placeholder="" rows="7" required></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="due_date" class="col-sm-2 col-form-label">Due Date</label>
                                        <div class="col-sm-10">
                                            <input type="datetime-local" id="due_date" value="{{old('$task->due_date')}}" name="due_date" class="form-control task @error('task_title') is-invalid @enderror" style="border-radius:0px;" required>
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
                            <table width="100%">
                                <tr>
                                    <th>
                                        Task Description
                                    </th>
                                    <td id="taskBody">

                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Date Created
                                    </th>
                                    <td id="dateCreated">

                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Due Date
                                    </th>
                                    <td id="dueDate">

                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Shared With
                                    </th>
                                    <td>
                                        Ama Akosua | John James | Sarah Abraham
                                    </td>
                                </tr>

                            </table>
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
            <form action="" method="POST">
                @csrf
                <table style="width:100%">
                    <tr>
                        <td>
                            <div class="btn-group-toggle" data-toggle="buttons">
                                @foreach(\App\User::where('id', '!=', Auth::user()->id)->get() as $user)
                                <label class="btn btn-outline-secondary pad btn-block active">
                                    <img src="{{ asset('dashboard/Media/userAvatar.png') }}" class="img-size-32 rounded-circle">
                                    <input type="checkbox" unchecked autocomplete="off" name="users[]" value="{{$user->id}}">{{$user->name}}
                                </label> 
                                @endforeach 
                            </div>
                        </td>
                    </tr>
                </table>
                </div>
                <div class="mt-2">
                    <button type="cancel" onclick="toggle()" class="btn btn-sm btn-danger ml-2" style="border-radius:3px;">Cancel</button>
                    <button type="submit" onclick="toggle()" class="btn btn-sm btn-info float-right" style="border-radius:3px;">Share</button>              
                </div>
            </form>
            
        </div>

         <!-- Chat Modal -->
         <div id="Chat">
            <div>
                <h5 style="font-size:20px;font-weight:700">MESSAGE:
                    <a class="btn btn-sm float-right" onclick="Chat()" aria-label="Close">
                        <i class="fas fa-times float-right"></i>
                    </a>
                </h5>          
            </div>
            <div>
                <input id="searchbar" class="form-search" type="text" onkeyup="search_users()" placeholder="Search here..." name="search" aria-label="Search">
            </div>
            <div class="here">
                <table style="width:100%">
                    <tr>
                        <td>
                            <div class="btn">
                                @foreach($users as $user)
                                    <a href="javascript:void(0);" class="chat-toggle" data-id="{{ $user->id }}" data-user="{{ $user->name }}">
                                        <label class="btn btn-outline-secondary pad btn-block">
                                            <img src="{{ asset('dashboard/Media/userAvatar.png') }}" class="img-size-32 rounded-circle">
                                                {{$user->name}}
                                        </label> 
                                    </a>
                                @endforeach 
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>


      @extends('layouts.chat')


                
            @include('chat-box')

            <input type="hidden" id="current_user" value="{{ \Auth::user()->id }}" />
            <input type="hidden" id="pusher_app_key" value="{{ env('PUSHER_APP_KEY') }}" />
            <input type="hidden" id="pusher_cluster" value="{{ env('PUSHER_APP_CLUSTER') }}" />

            
            <div id="chat-overlay" class="row"></div>

            <audio id="chat-alert-sound" style="display: none">
                <source src="{{ asset('sound/facebook_chat.mp3') }}" />
            </audio>

            @section('script')
            <script src="https://js.pusher.com/4.1/pusher.min.js"></script>
            <script src="{{ asset('js/chat.js') }}"></script>

            @stop

                <div id="chat-overlay" class="row"></div>

        <audio id="chat-alert-sound" style="display: none">
            <source src="{{ asset('sound/facebook_chat.mp3') }}" />
        </audio>
    </div>

  </main>


  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="{{asset('js/moment.js')}}"></script>
  <!-- <script src="{{asset('dashboard/js.jquery.timeago.js')}}"></script>
  <script src="{{asset('dashboard/js.global.js')}}"></script> -->
  <script type="text/javascript">
    
    function removeElement(delAdd) {
    // Removes an element from the document
    var element = document.getElementById(delAdd);
    element.parentNode.removeChild(element);
    }

    // Fetch data from frontend to display in modal function
    function viewTask(element)
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

  function toggle()
  {
    var shareTask = document.getElementById('shareTask');
    shareTask.classList.toggle('active');
  }

  function Chat()
  {
    var Chat = document.getElementById('Chat');
    Chat.classList.toggle('active');
  }

  function convertToUnixTimeStamp(timestamp) {
    var unixtime =new Date(`${timestamp}`).getTime()/1000;
    return unixtime;
  }

  setInterval(function(){
    var progressbar = $(".progress-bar");
    var element;

     $.each( progressbar, function( key, value ) {

        //  console.log(value);
         
         var dueDate = value.getAttribute('data-dueDate');
         dueDate = convertToUnixTimeStamp(dueDate);

         var dateupdated = value.getAttribute('data-dateUpdated');
         dateupdated = convertToUnixTimeStamp(dateupdated);

         var now = new Date();
         now = convertToUnixTimeStamp(now);

         console.log("Due date: ", dueDate);
         console.log("Last updated: ", dateupdated);
         console.log("Current Time: ", now);

         var timeLeft = dueDate - now;

            if(timeLeft < 0){
                timeLeft = 0;
            }
           


         var timeTotal = dueDate - dateupdated ;
         console.log("Total Time", timeTotal);  


         var timePercent = (100-((timeLeft/timeTotal)*100));
         console.log('timeLeft:', timeLeft.toFixed(0) );
         console.log('timePercent:', timePercent.toFixed(0));

         var fixedPercentage = timePercent.toFixed(0);

         value.setAttribute('style', 'width: '+fixedPercentage+'%');

         value.setAttribute('aria-valuenow', fixedPercentage);
         
         if(fixedPercentage <= 20){
            value.setAttribute('class' , 'progress-bar bg-green progress-bar-striped');
         }
         else if(fixedPercentage >= 20 && fixedPercentage <= 70 ){
             value.setAttribute('class' , 'progress-bar bg-yellow progress-bar-striped');
         }
         else {
             value.setAttribute('class' , 'progress-bar bg-red progress-bar-striped');
         }    
        
    });
     }, 500);


    $(function()
    {

         var dueDate = value.getAttribute('data-dueDate');
         dueDate = convertToUnixTimeStamp(dueDate);

         var now = new Date();
         now = convertToUnixTimeStamp(now);


        var time = dueDate - now;
        // var duration = moment.duration(time*1000, 'milliseconds');
        // var interval = 1000;
        console.log("Time :",time);

        setInterval(function(){
        duration = moment.duration(duration.asMilliseconds() - interval, 'milliseconds');
        $('countdown').text(moment(duration.asMilliseconds()).format('H[h]:mm[m]:ss[s]'));
        }, interval);
    });

     
//   eye toggle function
  $(function() 
  {
    $("span").click(function() {
        $("#icon").toggleClass("fa-eye fa-eye-slash");
    });
    });

  function search_users() 
    { 
        let input = document.getElementByClassName('searchbar').value 
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
        let x = document.getElementsByClassName('chatbox'); 
        
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


    // Time Update function
  function currentTime() 
  {
    var date = new Date(); /* creating object of Date class */
    var hour = date.getHours();
    var min = date.getMinutes();
    var sec = date.getSeconds();
    hour = updateTime(hour);
    min = updateTime(min);
    sec = updateTime(sec);
    document.getElementById("clock").innerText = hour + " : " + min + " : " + sec; /* adding time to the div */
        var t = setTimeout(function(){ currentTime() }, 1000); /* setting timer */
  }

function updateTime(k)
{
  if (k < 10) {
    return "0" + k;
  }
  else {
    return k;
  }
}
currentTime();

    

  </script>

</body>
</html>
