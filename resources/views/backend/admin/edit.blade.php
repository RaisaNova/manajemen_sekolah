@extends('backend.layouts.app')

@section('content')
    <ul class="breadcrumb">
        <li>Home</li>
        <li>Admin</li>
        <li class="active">Edit Admin</li>
    </ul>
    <div class="page-title">
        <h2><span class="fa fa-arrow-circle-o-left"></span> Edit Admin</h2>
    </div>
    <div class="page-content-wrap">
        <div class="row">
            <div class="col-md-12">

                <form class="form-horizontal" action="{{ url('panel/admin/update/' . $getRecord->id) }}" method="post" enctype="multipart/form-data">
                @csrf

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Edit Admin</h3>
                        </div>

                        <div class="panel-body">

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Admin Name <span class="required">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" name="name" value="{{ old('name', $getRecord->name) }}" required class="form-control" />
                                    </div>
                                    <div class="required">{{ $errors->first('name') }}</div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Profile Pic</label>
                                <div class="col-md-6 col-xs-12">
                                    <input type="file" name="profile_pic" class="form-control" />
                                    @if (!empty($getRecord->getProfile()))
                                        <img style="width: 50px; height: 50px; border-radius: 50%;" src="{{ $getRecord->getProfile() }}">
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Email <span class="required">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" name="email" value="{{ old('email', $getRecord->email) }}" required class="form-control" />
                                    </div>
                                    <div class="required">{{ $errors->first('email') }}</div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Password</label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-unlock-alt"></span></span>
                                        <input type="password" name="password" class="form-control" />
                                    </div>
                                    (Kosongkan jika tidak ingin mengubah password) {{-- Pesan yang lebih jelas --}}
                                    <div class="required">{{ $errors->first('password') }}</div> {{-- Tampilkan error password jika ada --}}

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Address <span class="required">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <textarea class="form-control" required name="address">{{ old('address', $getRecord->address) }}</textarea>
                                    <div class="required">{{ $errors->first('address') }}</div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Status<span class="required">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <select class="form-control" required name="status">
                                        <option {{ ($getRecord->status == 1) ? 'selected' : '' }} value="1">Active</option>
                                        <option {{ ($getRecord->status == 0) ? 'selected' : '' }} value="0">Inactive</option>
                                    </select>
                                    <div class="required">{{ $errors->first('status') }}</div>

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Role <span class="required">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <select class="form-control" required name="is_admin">
                                        <option {{ ($getRecord->is_admin == 2) ? 'selected' : '' }} value="2">Super Admin</option>
                                        <option {{ ($getRecord->is_admin == 1) ? 'selected' : '' }} value="1">Admin</option>
                                    </select>
                                    <div class="required">{{ $errors->first('is_admin') }}</div>

                                </div>
                            </div>

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