@extends('admin.layout')
@section('content')
<!-- Content Header (Page header) -->
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Batch</h1>
            
          </div><!-- /.col -->
          
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Batch</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <div class="d-flex justify-content-center">
            <center>
                <div id="hideDiv" class="">
                    @if(Session::get('update'))
                    <div class="alert alert-info">
                        {{ Session::get('update')}}
                    </div>
                    @endif
                    @if(Session::get('insert'))
                    <div class="alert alert-success">
                        {{ Session::get('insert')}}
                    </div>
                    @endif
                    @if(Session::get('delete'))
                    <div class="alert alert-danger">
                        {{ Session::get('delete')}}
                    </div>
                    @endif
                    </div>
            </center>
          </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
                <!-- SELECT2 EXAMPLE -->
                <div class="card card-default">
                    <div class="card-header">
                      <h3 class="card-title">Add batch</h3>
          
                      <div class="card-tools">
                        
                      </div>
                      
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        {!! Form::open(['url'=>'admin/add_batch','method'=>'POST','files' => true,'class'=>"swalDefaultSuccess",'id'=>"quickForm"]) !!}
                        <div class="form-group">
                            {!!Form::label('Department','Department') !!}
                            {!! Form::select('department_id',array_merge(["" => 'Please Select',$department],), null,array_merge(['class'=>'form-control'],['required'=>true])) !!}
                        </div>    
                        <div class="form-group">
                                
                                {!! Form::label('Batch Name', 'Batch Name') !!}
                                {!!Form::text('batch_name',null,array_merge(['class' => 'form-control'],['placeholder'=>'Enter Batch Name'],['required'=>true]))!!}
                                @error('fullname')
                                    <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                
                                {!! Form::label('Batch Year', 'Batch Year') !!}
                                {!!Form::text('batch_year',null,array_merge(['class' => 'form-control'],['placeholder'=>'Enter Batch Year'],['required'=>true]))!!}
                                @error('fullname')
                                    <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        <!-- /.col -->
                      <!-- /.row -->
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        {!!Form::submit('Submit',['class'=>'btn btn-info']);!!}
                        {!! Form::close() !!}
                    </div>
                  </div>
                  <!-- /.card -->
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">View Department</h3>  
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>No</th>
                          <th>Department</th>
                          <th>Batch Name</th>
                          <th>Batch Year</th>
                          <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 1;
                        @endphp
                        
                        @foreach($batch_detail as $batch)
                        <tr>
                          <td>{{ $i++}}</td>
                          <td>{{DB::table('departments')->where('id', $batch->department_id)->value('department_name')}}</td>
                          <td>{{$batch->batch_name}}</td>
                          <td>{{$batch->batch_year}}</td>
                          <td>
                            <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteModel{{$batch->id}}">
                              <i class="fas fa-trash"></i> Deletes
                              </button>
                              <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#editModel{{$batch->id}}">
                                <i class="fas fa-edit"></i> Edit
                              </button>
                          </td>
                          
                        </tr>
                        <!--Delete Model Start-->
                          <!-- Modal -->
                            <div class="modal fade" id="deleteModel{{$batch->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        {!! Form::model($batch, ['method'=>'DELETE','files' => true,'route' => ['add_batch.destroy', $batch->id]]) !!}
                                            Are You Sure You Want to Delete <b>{{$batch->batch_name}}</b> Department
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    {!!Form::submit('Yes',['class'=>'btn btn-info']);!!}
								        {!! Form::close() !!}
                                    </div>
                                </div>
                                </div>
                            </div>

                          <!--Delete Model End-->
                          <!--Edit Model Start-->
                          <div class="modal fade" id="editModel{{$batch->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                  {!! Form::model($batch, ['method'=>'PATCH','files' => true,'route' => ['add_batch.update', $batch->id]]) !!}
                                  <div class="form-group">
                                    {!!Form::label('Department','Department') !!}
                                    {!! Form::select('department_id',$department, null,array_merge(['class'=>'form-control'])) !!}
                                </div>    
                                <div class="form-group">
                                        
                                        {!! Form::label('Batch Name', 'Batch Name') !!}
                                        {!!Form::text('batch_name',null,array_merge(['class' => 'form-control'],['placeholder'=>'Enter Batch Name'],['required'=>true]))!!}
                                        @error('fullname')
                                            <div class="text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        
                                        {!! Form::label('Batch Year', 'Batch Year') !!}
                                        {!!Form::text('batch_year',null,array_merge(['class' => 'form-control'],['placeholder'=>'Enter Batch Year'],['required'=>true]))!!}
                                        @error('fullname')
                                            <div class="text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                {!!Form::submit('Yes',['class'=>'btn btn-info']);!!}
                                {!! Form::close() !!}
                                </div>
                            </div>
                            </div>
                        </div>

                          <!--Edit Model End-->
                        @endforeach
                      </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Department</th>
                                <th>Batch Name</th>
                                <th>Batch Year</th>
                                <th>Action</th>
                              </tr>
                        </tfoot>
                      </table>
                    </div>
                    <!-- /.card-body -->
                  </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <script src="{{asset('admin_public/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('admin_public/plugins/jquery-validation/additional-methods.min.js')}}"></script>
    
    <script>
      $(function () {
        $.validator.setDefaults({
         
        });
        $('#quickForm').validate({
          rules: {  
                
            
            department_id:{
              required:true
            },
           
            batch_name:{
              required:true,
            },
           
            semester_id:{
              required:true,
            },
            batch_year:{
              required:true
            },
            
          },
          messages: {
            
            department_id:{
              required:"Please Select Department"
            },
            batch_name:{
              required:"Please Enter  Batch Name"
            },
           batch_year:{
             required:"Please Enter Batch Year"
           },
            semester_id:{
              required:"Please Select Semester"
            },
          },
          errorElement: 'span',
          errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
          },
          highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
          },
          unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
          }
        });
      });
      </script>
    <!-- /.content -->
    @endsection