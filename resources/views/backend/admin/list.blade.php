@extends('backend.layouts.app')
@section('content')

<ul class="breadcrumb">
    <li><a href="#">Home</a></li>
    <li class="active">Admin</li>
</ul>

<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left"></span> Admin</h2>
</div>

<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
            @include('_message')
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Admin Search</h3>
                </div>
                <div class="panel-body">
                    <form action="" method="get">
                        <div class="col-md-2">
                            <label>ID</label>
                            <input type="text" class="form-control" value="{{ Request::get('id') }}" placeholder="ID" name="id">
                        </div>
                        <div class="col-md-2">
                            <label>Name</label>
                            <input type="text" class="form-control" value="{{ Request::get('name') }}" placeholder="Name" name="name">
                        </div>
                        <div class="col-md-2">
                            <label>Email</label>
                            <input type="text" class="form-control" value="{{ Request::get('Email') }}" placeholder="Email" name="email">
                        </div>
                        <div class="col-md-2">
                            <label>Address</label>
                            <input type="text" class="form-control" value="{{ Request::get('address') }}" placeholder="Address" name="address">
                        </div>
                        <div class="col-md-2">
                            <label>Role</label>
                            <select class="form-control" name="is_admin">
                                <option value="">Select</option>
                                <option {{ (Request::get('is_admin') == '1') ? 'selected' : '' }} value="1">Super Admin</option>
                                <option {{ (Request::get('is_admin') == '2') ? 'selected' : '' }} value="2">Admin</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label>Status</label>
                            <select class="form-control" name="status">
                                <option value="">Select</option>
                                <option {{ (Request::get('status') == '1') ? 'selected' : '' }} value="1">Active</option>
                                <option {{ (Request::get('status') == '100') ? 'selected' : '' }} value="100">inactive</option>
                            </select>
                        </div>

                        <div style="clear: both;"></div>
                        <br>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Search</button>
                            <a href="{{ url('panel/admin') }}" class="btn btn-success">Reset</a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Admin List</h3>
                    <a class="btn btn-primary pull-right" href="{{ url('panel/admin/create') }}">Create Admin</a>
                </div>
                <div class="panel-body panel-body-table">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-actions">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Profile</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Created Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($getRecord->isEmpty())
                                    <tr>
                                        <td colspan="8" class="text-center">No data available</td> 
                                    </tr>
                                @else
                                    @forelse($getRecord as $value)
                                        <tr>
                                            <td>{{ $value->id }}</td>
                                            <td>
                                                @if (!empty ($value->getProfile()))
                                                    <img style="width: 50px;height: 50px;border-radius: 50%;" src="{{ $value->getProfile() }}" alt="School Profile">
                                                @else
                                                     <img style="width: 50px;height: 50px;border-radius: 50%;" src="{{ asset('images/default_profile.jpg') }}" alt="Default Profile">
                                                @endif
                                            </td>
                                            <td>{{ e($value->id) }}</td>
                                            <td>{{ e($value->name) }}</td>
                                            <td>{{ e($value->email) }}</td>
                                            <td>{{ e($value->address) }}</td>
                                            <td>{{ e($value->address) }}</td>
                                            <td>
                                                @if($value->is_admin == 1)
                                                    <span class="label label-success">Super Admin</span>
                                                @else
                                                    <span class="label label-warning">Admin</span>
                                                @endif
                                            <td>
                                                @if($value->status == 1)
                                                    <span class="label label-success">Active</span>
                                                @else
                                                    <span class="label label-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                                            <td>
                                                <a href="{{ url('panel/admin/edit/'.$value->id) }}" class="btn btn-default btn-rounded btn-sm">
                                                    <span class="fa fa-pencil"></span>
                                                </a>
                                               <a  href="{{ url('panel/admin/delete/'.$value->id) }}" onclick="return confirm('Are you sure you want to delete?');" class="btn btn-danger btn-rounded btn-sm">
                                                    <span class="fa fa-times"></span>
                                                </a>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="100%">Record not found.</td>
                                        </tr>
                                    @endforelse
                                @endif
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