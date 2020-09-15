@extends('admin.partials.layout')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark" style="font-weight:800">DASHBOARD</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-5">
            <!-- small box -->
            <div class="small-box bg-info" id="t_users">

              <div class="inner">
                <p style ="font-weight:500">Total Users</p>

                <h3>{{count(\App\User::where('type_id', '<>', 1)->get()) }}</h3>
              </div>
              <div class="icon" >
                <i class="fa fa-users" style="font-size: 135px;"></i>
              </div>
              <!-- <a href="#" class="small-box-footer">More  <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Server Storage Usage chart</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus" style="color:grey;"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times" style="color:grey;"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chartjs-size-monitor">
                  <div class="chartjs-size-monitor-expand">
                    <div class="">

                    </div>
                  </div>
                  <div class="chartjs-size-monitor-shrink">
                    <div class="">

                    </div>
                  </div>
                </div>
                <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
          </div>


          <div class="col-lg-7">
            <div class="row">
              <div class="col-lg-7">

                <!-- <div class="col-lg-3"> -->
                <!-- small box -->
                <div class="small-box bg-success" id="e_Card">
                  <div class="inner">
                    <p style="margin-bottom: 0px; font-weight:500;">Total Employees</p>
    
                  <p style ="font-weight:500;font-size: 50px; margin-bottom: 0px;">{{count(\App\User::where('type_id', '=', 4)->get()) }}</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                  </div>
                  <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                </div>
              <!-- </div> -->
              <!-- ./col -->
              <!-- <div class="col-lg-3"> -->
              <!-- small box -->
                <div class="small-box bg-warning" id="e_Card">
                  <div class="inner">
                    <p style="margin-bottom: 0px;font-weight:500">Total Managers</p>
    
                    <p style ="font-weight:500;font-size: 50px; margin-bottom: 0px;">{{count(\App\User::where('type_id', '=', 3)->get()) }}</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person-add"></i>
                  </div>
                  <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                </div>
              <!-- </div> -->
              <!-- ./col -->
              <!-- <div class="col-lg-3"> -->
              <!-- small box -->
                <div class="small-box bg-danger"id="e_Card">
                  <div class="inner">
                    <p style="margin-bottom: 0px; font-weight:500; margin-bottom: 0px;">Total Executives</p>
    
                    <p style ="font-weight:500; font-size: 50px; margin-bottom: 0px; ">{{count(\App\User::where('type_id', '=', 2)->get()) }}</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                  </div>
                  <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                </div>
              </div>

             <div class="col-lg-5">

              <!-- </div>  -->
              <!-- ./col -->

              <div class="card">
                <div class="card-header">
                  <h4 class="card-title text-center; font-weight:500;">Active Users</h4>
  
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <ul class="products-list product-list-in-card pl-2 pr-2">
                    <li class="item">
                      <div class="product-img">
                        <img src="{{ asset('dashboard/media/grp.png') }}" alt="Product Image" class="img-size-50 rounded-circle">
                      </div>
                      <div class="product-info">
                        <p style="margin-top:12px; font-size:14px">Addo Hayford Edward</p>
                      </div>
                    </li>

                    <!-- /.item -->
                    <li class="item">
                      <div class="product-img">
                        <img src="{{ asset('dashboard/media/grp.png') }}" alt="Product Image" class="img-size-50 rounded-circle">
                      </div>
                      <div class="product-info">
                        <p style="margin-top:12px; font-size:14px">Addo Hayford Edward</p>
                      </div>
                    </li>

                    <li class="item">
                      <div class="product-img">
                        <img src="{{ asset('dashboard/media/grp.png') }}" alt="Product Image" class="img-size-50 rounded-circle">
                      </div>
                      <div class="product-info">
                        <p style="margin-top:12px; font-size:14px">Addo Hayford Edward</p>
                      </div>
                    </li>

                    <li class="item">
                      <div class="product-img">
                        <img src="{{ asset('dashboard/media/grp.png') }}" alt="Product Image" class="img-size-50 rounded-circle">
                      </div>
                      <div class="product-info">
                        <p style="margin-top:12px; font-size:14px">Addo Hayford Edward</p>
                      </div>
                    </li>

                    <li class="item">
                      <div class="product-img">
                        <img src="{{ asset('dashboard/media/grp.png') }}" alt="Product Image" class="img-size-50 rounded-circle">
                      </div>
                      <div class="product-info">
                        <p style="margin-top:12px; font-size:14px">Addo Hayford Edward</p>
                      </div>
                    </li>

                    <li class="item">
                      <div class="product-img">
                        <img src="{{ asset('dashboard/media/grp.png') }}" alt="Product Image" class="img-size-50 rounded-circle">
                      </div>
                      <div class="product-info">
                        <p style="margin-top:12px; font-size:14px">Addo Hayford Edward</p>
                      </div>
                    </li>

                    <!-- /.item -->
                  </ul>
                </div>
                <!-- /.card-body -->
                <div class="card-footer text-center">
                  <a href="javascript:void(0)" class="uppercase"><i class="fas fa-chevron-down"></i></a>
                </div>
                <!-- /.card-footer -->
              </div>
             </div>
             
             <div class="col-lg-12">

              <div class="card bg-gradient-success">
                <div class="card-header border-0">
  
                  <h3 class="card-title">
                    <i class="far fa-calendar-alt"></i>
                    Calendar
                  </h3>
                  <!-- tools card -->
                  <div class="card-tools">
                    <!-- button with a dropdown -->
                    <div class="btn-group">
                      <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
                        <i class="fas fa-bars"></i></button>
                      <div class="dropdown-menu" role="menu">
                        <a href="#" class="dropdown-item">Add new event</a>
                        <a href="#" class="dropdown-item">Clear events</a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">View calendar</a>
                      </div>
                    </div>
                    <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                  <!-- /. tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body pt-0">
                  <!--The calendar -->
                  <div id="calendar" style="width: 100%"></div>
                </div>
                <!-- /.card-body -->
              </div>
              <div class="card invisible">
                <!-- <div class="card-header border-0"> -->
                 
                  <!-- card tools -->
                  <!-- <div class="card-tools"> -->
                  
                    
                  </div>
                  <!-- /.card-tools -->
                </div>
               
                <!-- /.card-body-->
                
                  <div class="row invisible" style="box-sizing:border-box;">
                    <div class="col-4 text-center">
                      <div id="sparkline-1"></div>
                      <!-- <div class="text-white">Visitors</div> -->
                    </div>
                    <!-- ./col -->
                    <div class="col-4 text-center">
                      <div id="sparkline-2"></div>
                      <!-- <div class="text-white">Online</div> -->
                    </div>
                    <!-- ./col -->
                    <div class="col-4 text-center">
                      <div id="sparkline-3"></div>
                      <!-- <div class="text-white">Sales</div> -->
                    </div>
                    <!-- ./col -->
                  </div>
                  <!-- /.row -->
                </div>
              </div>
  
   

             </div>
            
          </div>
        </div>
       
        
    
    <!-- /.content -->
  </div>
  <!-- Control Sidebar -->
 
@endsection

 
