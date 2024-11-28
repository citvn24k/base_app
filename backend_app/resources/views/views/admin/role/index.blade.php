@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex no-block align-items-center mb-2">
                            <h4 class="card-title">Danh sách vai trò</h4>
                            <div class="ml-auto">
                                <a href="{{ route('roles.create') }}" class="btn btn-success">
                                    @lang('form.add')
                                </a>
                            </div>
                        </div>
                        @include('flash::message')
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th width="30%">Tên vai trò</th>
                                    <th width="30%">Số lượng người dùng</th>
                                    <th width="15%">Thao tác</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $key => $role)
                                    <tr>
                                        <td>{{ $role->name }}</td>
                                        <td>{{ $role->users_count }}</td>
                                        <td>
                                            @include('admin.components._action',[
                                                'entity' => 'roles',
                                                'id' => $role->id
                                            ])
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {!! $data->appends(Request::except('page'))->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
