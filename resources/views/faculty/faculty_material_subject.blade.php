@extends('faculty.layout')
@section('content')
<!-- Content Header (Page header) -->
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Subject</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/faculty/material_upload">Faculty Batches</a>/<a href="/faculty/faculty_materil_semester/{{$faculty_subject[0]->batch_id}}">Faculty Semester</a></li>
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
            @foreach ($faculty_subject as $fs)
            @php
              $k = array_rand($array);
              $v = $array[$k];
            @endphp   
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-{{$v}}">
                <div class="inner">
                    @php
                        $subject_detail=DB::table('subjects')->where('id', $fs->subject_id)->get();
                    @endphp
                  <h4>
                      {{
                          $subject_detail[0]->subject_code;
                      }} --
                      {{
                      $subject_detail[0]->subject_name;
                  }}</h4>
                <p>
                    <b>Department: </b>{{
                        DB::table('departments')->where('id', $fs->department_id)->value('department_name')
                      }}<br>
                      <b>Batch: </b>
                       {{
                        DB::table('batches')->where('id', $fs->batch_id)->value('batch_name')
                      }}<br>
                    <b>Semester:</b> SEM-{{
                        DB::table('semesters')->where('id', $fs->semester_id)->value('semester')
                      }}
                     
                      
                </p>
                <p>
                    
                </p>
                  <p>
                    
                    
                  </p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag">

                  </i>
                </div>
                <a href="/faculty/faculty_material/{{$fs->semester_id}}/{{$fs->department_id}}/{{$fs->batch_id}}/{{$fs->subject_id}}" class="small-box-footer">Add Material <i class="fas fa-arrow-circle-right"></i></a>
                <a href="/faculty/faculty_assignment/{{$fs->semester_id}}/{{$fs->department_id}}/{{$fs->batch_id}}/{{$fs->subject_id}}" class="small-box-footer">Add Assignment <i class="fas fa-arrow-circle-right"></i></a>
                @php
            $subject_detail=DB::table('subjects')->where('id', $fs->subject_id)->where('subject_pratical','1')->get();
             @endphp
             @if(count($subject_detail)>0)
                <a href="/faculty/faculty_program/{{$fs->semester_id}}/{{$fs->department_id}}/{{$fs->batch_id}}/{{$fs->subject_id}}" class="small-box-footer">Add Program <i class="fas fa-arrow-circle-right"></i></a>
             @endif
              </div>

            </div>           
            @endforeach
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    <!-- /.content -->
    @endsection