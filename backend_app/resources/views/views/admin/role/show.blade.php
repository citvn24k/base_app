@extends('adminlte.layouts.app')
@section('title', 'Xem vai trò')
@section('content')
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title col-md-6">Xem vai trò</h3>
                <div class="col-md-6 pull-right text-right">
                    @can('role_edit')
                    <a href="{{ route('role.edit', $role->id) }}" class="btn btn-warning btn-sm">
                        <i class="fa fa-pencil"></i>
                        Sửa
                    </a>
                    @endcan
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="col-md-12">
                    <div class="row form-group">
                        <label class="col-md-2 col-lg-2 control-label" for="">Tên vai trò <span
                                    class="text-red">*</span></label>
                        <div class="col-md-4 col-lg-4">
                            <div class="clearfix">
                                <input type="text" class="form-control" value="{{ $role->name }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-header" role="tab"
                                 id="{{ isset($title) ? str_slug($title) :  'permissionHeading' }}">
                                <h4 class="mb-0">
                                    <a role="button" data-toggle="collapse"
                                       href="#dd-{{ isset($title) ? str_slug($title) :  'permissionHeading' }}"
                                       aria-expanded="{{ isset($closed) ? 'true' : 'false' }}"
                                       aria-controls="dd-{{ isset($title) ? str_slug($title) :  'permissionHeading' }}">
                                        {{ $title ?? 'Module' }} {!! isset($user) ? '<span class="text-danger">(' . $user->getDirectPermissions()->count() . ')</span>' : '' !!}
                                    </a>
                                </h4>
                            </div>
                            <div>
                                <div class="card-body">
                                    <?php
                                    $permActive = $permActive->toArray();
                                    ?>
                                    <div class="row">
                                        @foreach($permissions->chunk(4) as $perms)
                                            @foreach($perms as $perm)
                                                @if(in_array($perm->id, $permActive))
                                                    {{--                                            <div class="col-md-3">--}}
                                                    {{--                                                <a data-toggle="collapse" href="#collapse_{{ $perm->name }}"--}}
                                                    {{--                                                   aria-expanded="false" aria-controls="collapseExample">--}}
                                                    {{--                                                    <i class="fa fa-caret-right"></i>--}}
                                                    {{--                                                    <i class="fa fa-caret-down"></i>--}}
                                                    {{--                                                </a>--}}
                                                    {{--                                                {!! Form::checkbox("permissions[]", $perm->name, true, ['disabled']) !!}--}}
                                                    {{--                                                <label for="permissions[]">{{ $perm->title ? $perm->title : $perm->name }}</label>--}}
                                                    {{--                                                @if(!empty($perm->children))--}}
                                                    {{--                                                    <div class="collapse" id="collapse_{{ $perm->name }}">--}}
                                                    {{--                                                        @foreach($perm->children as $child)--}}
                                                    {{--                                                            @if(in_array($child->id, $permActive))--}}
                                                    {{--                                                            <div>--}}
                                                    {{--                                                            &nbsp;&nbsp;&nbsp; {!! Form::checkbox("permissions[]", $child->name, true, ['disabled']) !!}--}}
                                                    {{--                                                                {{ $child->title ? $child->title : $child->name }}--}}
                                                    {{--                                                            </div>--}}
                                                    {{--                                                            @endif--}}
                                                    {{--                                                        @endforeach--}}
                                                    {{--                                                    </div>--}}
                                                    {{--                                                @endif--}}
                                                    {{--                                                <hr>--}}
                                                    {{--                                            </div>--}}
                                                    <div class="col-md-3" >
                                                        <div class="box box-default box-solid collapsed-box">
                                                            <div class="box-header with-border">
                                                                {!! Form::checkbox("permissions[]", $perm->name, true, ['disabled']) !!}
                                                                <h3 class="box-title">{{ $perm->title ? $perm->title : $perm->name }} ({{ $perm->children_count }})</h3>
                                                                <div class="box-tools pull-right">
                                                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="box-body" style="display: none;" data-set="{{ $perm->name }}">
                                                                @foreach($perm->children as $child)
                                                                    @if(in_array($child->id, $permActive))
                                                                        <div>
                                                                            {!! Form::checkbox("permissions[]", $child->name, true, ['disabled']) !!}
                                                                            <span>{{ $child->title ? $child->title : $child->name }}</span>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach

                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css')
    <style>
        a[aria-expanded=true] .fa-caret-right {
            display: none;
        }

        a[aria-expanded=false] .fa-caret-down {
            display: none;
        }
    </style>
@endsection

@section('script')
@endsection
