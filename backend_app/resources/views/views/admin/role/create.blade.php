@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-body">
                    <div class="d-flex no-block align-items-center">
                        <h4 class="card-title">Tạo vai trò mới</h4>
                    </div>
                    {!! Form::open(['route' => ['roles.store'], 'class' => 'form-horizontal mt-4', 'autocomplete' => 'off']) !!}
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="text-danger">{{ $error }}</li>
                        @endforeach
                    </ul>
                    @include('flash::message')
                    @include('admin.role._form')
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">@lang('form.add')</button>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">@lang('form.back')</a>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
