@extends('faculty.layout')
@section('content')
<!-- Content Header (Page header) -->
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Batches</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        @php
            $array=array('primary','success','pink','red','purple');
        @endphp
        <!-- Small boxes (Stat box) -->
        <div class="row">
            @foreach ($faculty_batch as $fb)
            @php
              $k = array_rand($array);
              $v = $array[$k];
            @endphp   
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-{{$v}}">
                <div class="inner">
                  <h3>{{
                      DB::table('batches')->where('id', $fb->batch_id)->value('batch_name')
                    }}</h3>
  
                  <p>
                    {{
                      DB::table('departments')->where('id', $fb->department_id)->value('department_name')
                    }}
                  </p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="faculty_program_semester/{{$fb->batch_id}}" class="small-box-footer">See Semester <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>           
            @endforeach
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    @endsection