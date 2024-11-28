@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex no-block align-items-center mb-2">
                            <h4 class="card-title">Danh sách người dùng</h4>
                            <div class="ml-auto">
                                <a href="{{ route('users.create') }}" class="btn btn-success">
                                    @lang('form.add')
                                </a>
                            </div>
                        </div>
                        @include('flash::message')
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if(!empty($user->roles))
                                                @foreach($user->roles as $role)
                                                    {{ $role->name }}
                                                    @if(!$loop->last)
                                                        ,
                                                    @endif
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            @include('admin.components._action',[
                                            'entity' => 'users',
                                            'id' => $user->id
                                        ])
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {!! $users->appends(Request::except('page'))->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
