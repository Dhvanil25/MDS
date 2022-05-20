@extends('admin.layout')
@section('content')
<!-- Content Header (Page header) -->
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Department</h1>
            
          </div><!-- /.col -->
          
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Department</li>
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
                      <h3 class="card-title">Add Department</h3>
          
                      <div class="card-tools">
                        
                      </div>
                      
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        {!! Form::open(['url'=>'admin/add_department','method'=>'POST','files' => true,'class'=>"swalDefaultSuccess",'id'=>"quickForm","novalidate"=>"novalidate"]) !!}
                            <div class="form-group">
                                
                                {!! Form::label('Department', 'Department') !!}
                                {!!Form::text('department_name',null,array_merge(['class' => 'form-control'],['placeholder'=>'Enter Department'],['required'=>true]))!!}
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
                          <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 1;
                        @endphp
                        
                        @foreach($department_detail as $dept)
                        <tr>
                          <td>{{ $i++}}</td>
                          <td>{{$dept->department_name}}</td>
                          <td>
                            <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteModel{{$dept->id}}">
                              <i class="fas fa-trash"></i> Deletes
                              </button>
                              <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#editModel{{$dept->id}}">
                                <i class="fas fa-edit"></i> Edit
                              </button>
                          </td>
                          
                        </tr>
                        <!--Delete Model Start-->
                          <!-- Modal -->
                            <div class="modal fade" id="deleteModel{{$dept->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        {!! Form::model($dept, ['method'=>'DELETE','files' => true,'route' => ['add_department.destroy', $dept->id]]) !!}
                                            Are You Sure You Want to Delete <b>{{$dept->department_name}}</b> Department
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
                          <div class="modal fade" id="editModel{{$dept->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                  {!! Form::model($dept, ['method'=>'PATCH','files' => true,'route' => ['add_department.update', $dept->id]]) !!}
                                  <div class="form-group">
                                    {!! Form::label('Department Name', 'Department Name') !!}
                                    {!!Form::text('department_name',null,array_merge(['class' => 'form-control'],['placeholder'=>'Enter Department Name'],['required'=>true]))!!}
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
    <!-- /.content -->
    <!-- jquery-validation -->
    <script src="{{asset('admin_public/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('admin_public/plugins/jquery-validation/additional-methods.min.js')}}"></script>
    
    <script>
      $(function () {
        $.validator.setDefaults({
         
        });
        $('#quickForm').validate({
          rules: {       
            email: {
            required: true,
            email: true,
            },
            department_name: {
              required:true,
            },
          },
          messages: {
            department_name: {
              required: "Please Enter Departent Name",
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
    @endsection
    