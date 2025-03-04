@extends('backend.layouts.app')

@section('content')
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="active">Edit Assign Class Teacher</li>
    </ul>
    <!-- END BREADCRUMB -->

    <!-- PAGE TITLE -->
    <div class="page-title">                    
        <h2><span class="fa fa-arrow-circle-o-left"></span>Edit Assign Class Teacher</h2>
    </div>
    <!-- END PAGE TITLE -->  

    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">
        <div class="row">
            <div class="col-md-12">
                <form class="form-horizontal" action="{{ url('panel/assign-class-teacher/update/' .$getRecord->id) }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Edit Assign Class Teacher</h3>
                        </div>
                        
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Class <span class="required">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <select class="form-control" required name="class_id">
                                         <option value="">Select Class</option>
                                        @foreach ($getClass as $class )
                                         <option {{ ($getRecord->class_id == $class->id) ? 'selected' : ''}}  value="{{ $class->id }}"> {{ $class->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Teacher <span class="required">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                @foreach ($getTeacher as $teacher)
                                @php
                                    $checked = "";
                                @endphp
                                @foreach ($getSelectedTeacher as $tea)
                                  @if ($tea->teacher_id == $teacher->id)
                                    @php
                                        $checked = "checked";
                                    @endphp
                                @endif
                                @endforeach

                               
                                  <label style="display: block;margin-bottom: 7px;"> <input {{ $checked }} type="checkbox" value="{{ $teacher->id }}" name="teacher_id[]"> {{ $teacher->name }} {{ $teacher->last_name }}</label>
                                @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Status <span class="required">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <select class="form-control" required name="status">
                                    <option value="1" {{ ($getRecord->status == 1) ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ ($getRecord->status == 0) ? 'selected' : '' }}>Inactive</option>
                                    </select>
                            </div>

                        <div class="panel-footer">
                            <button class="btn btn-primary pull-right">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
