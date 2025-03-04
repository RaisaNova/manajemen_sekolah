    @extends('backend.layouts.app')

    @section('content')
        <ul class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li class="active">Assign Class Teacher</li>
        </ul>

        <div class="page-title">
            <h2><span class="fa fa-arrow-circle-o-left"></span> Assign Class Teacher</h2>
        </div>

        <div class="page-content-wrap">
            <div class="row">
                <div class="col-md-12">
                    @include('_message')

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Assign Class Teacher Search</h3>
                        </div>
                        <div class="panel-body">
                            <form action="" method="get">
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>ID</label>
                                        <input type="text" class="form-control" name="id" value="{{ Request::get('id') }}" placeholder="ID">
                                    </div>
                                    <div class="col-md-2">
                                        <label>Class Name</label>
                                        <input type="text" class="form-control" name="class_name" value="{{ Request::get('class_name') }}" placeholder="Class Name">
                                    </div>

                                    <div class="col-md-2">
                                        <label>Teacher Name</label>
                                        <input type="text" class="form-control" name="teacher_name" value="{{ Request::get('subject_name') }}" placeholder="Teacher Name">
                                    </div>
                                    <div class="col-md-2">
                                        <label>Status</label>
                                        <select class="form-control" name="status">
                                            <option value="">Select</option>
                                            <option value="1" {{ Request::get('status') == '1' ? 'selected' : '' }}>Active</option>
                                            <option value="100" {{ Request::get('status') == '100' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                        <a href="{{ url('panel/assign-class-teacher') }}" class="btn btn-success">Reset</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Assign Subject Class List</h3>
                            <a class="btn btn-primary pull-right" href="{{ url('panel/assign-class-teacher/create') }}">Create Assign Class Teacher </a>
                        </div>
                        <div class="panel-body panel-body-table">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-actions">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Class Name</th>
                                            <th>Teacher Name</th>
                                            <th>Status</th>
                                            <th>Created Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($getRecord as $value)
                                            <tr>
                                                <td>{{ e($value->id) }}</td>
                                                <td>{{ e($value->class_name) }}</td>
                                                <td>{{ e($value->teacher_name) }} {{ e($value->teacher_last_name) }}</td>
                                                <td>
                                                    <span class="label {{ $value->status == 1 ? 'label-success' : 'label-danger' }}">
                                                        {{ $value->status == 1 ? 'Active' : 'Inactive' }}
                                                    </span>
                                                </td>
                                                <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                                                <td>
                                                    <a href="{{ url('panel/assign-class-teacher/edit/'.$value->id) }}" class="btn btn-default btn-rounded btn-sm">
                                                        <span class="fa fa-pencil"></span>
                                                    </a>
                                                    <a href="{{ url('panel/assign-class-teacher/edit-single/'.$value->id) }}" class="btn btn-primary btn-sm">
                                                        Edit Single
                                                    </a>
                                                    
                                                        <a href="{{ url('panel/assign-class-teacher/delete/'.$value->id) }}" 
                                                    onclick="return confirm('Are you sure you want to delete?');" 
                                                    class="btn btn-danger btn-rounded btn-sm">
                                                        <span class="fa fa-times"></span>
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">No data available</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="pull-right">
                        {{ $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() }}
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('script')
    @endsection