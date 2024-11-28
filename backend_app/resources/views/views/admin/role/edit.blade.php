@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-body">
                    <div class="d-flex no-block align-items-center">
                        <h4 class="card-title">Tạo trận đấu</h4>
                    </div>
                    {!! Form::model($role, ['method' => 'PUT', 'route' => ['roles.update', $role->id], 'class' => 'form-horizontal mt-4']) !!}
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="text-danger">{{ $error }}</li>
                        @endforeach
                    </ul>
                    @include('flash::message')
                    @include('admin.role._form')
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">@lang('form.edit')</button>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">@lang('form.back')</a>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
