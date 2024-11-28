@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-body">
                    <div class="d-flex no-block align-items-center">
                        <h4 class="card-title">Cài đặt chức năng</h4>
                    </div>
                    <form action="{{ route('permissions.update_batch') }}" method="POST">
                        @csrf
                        @can('permission_edit')
                            <button type="submit" class="btn btn-success btn-sm">Lưu</button>
                            <a id="sync-btn" href="{{ route('permissions.sync') }}" class="btn btn-info btn-sm">Đồng bộ</a>
                        @endcan
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="text-danger">{{ $error }}</li>
                            @endforeach
                        </ul>
                        @include('flash::message')
                        <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                            <th width="30%">Chức năng</th>
                            <th width="30%">Tên hiển thị <i class="fa fa-info-circle" data-toggle="tooltip" title="Click vào tên để sửa" data-original-title="Click vào tên để sửa"></i></th>
                            <th width="15%">
                                Trạng thái hiển thị <i class="fa fa-info-circle" data-toggle="tooltip" title="Trạng thái hiển thị / không hiển thị trong Bảng phân quyền đối với tất cả các vai trò" data-original-title="Trạng thái hiển thị / không hiển thị trong Bảng phân quyền đối với tất cả các vai trò"></i>
                            </th>
                            <th width="15%">
                                Trạng thái mặc định <i class="fa fa-info-circle" data-toggle="tooltip" title="Trạng thái mặc định cho phép / không cho phép truy cập chức năng tương ứng đối với các vai trò được tạo mới sau này" data-original-title="Trạng thái mặc định cho phép / không cho phép truy cập chức năng tương ứng đối với các vai trò được tạo mới sau này"></i>
                            </th>
                            </thead>
                            @foreach($data as $key => $value)
                                <tr>
                                    <td>
                                        <span class="fa fa-caret-right" data-check="{{ $value->name }}"></span>
                                        <a data-toggle="collapse" href=".collapse_{{ $value->name }}"
                                           aria-expanded="false" aria-controls="collapseExample">
                                        </a>
                                        <span class="perm-master permission-name-show cursor-pointer" data-toggle="collapse" href=".collapse_{{ $value->name }}"><strong>{{ $value->name }}</strong></span>
                                    </td>
                                    <td>
                                        <a href="#" class="username permission-name-show" data-type="text" data-placement="right" data-id="{{ $value->id }}" data-title="Tên hiển thị"><strong>{{ $value->title }}</strong></a><br>
                                    </td>
                                    <td>
                                        <input class="bootrap-toggle parent-{{ $value->name }}" data-parent="true" name="status[]" data-set="{{ $value->name }}" data-all="{{ $value->name }}" type="checkbox" @if($value->status) checked @endif value="{{ $value->id }}" data-size="mini"><br>
                                    </td>
                                    <td>
                                        <input class="bootrap-toggle parent-default-{{ $value->name }}" data-parent="true" id="s-{{ $value->name }}" name="show[]" data-set="default-{{ $value->name }}" data-all="{{ $value->name }}" type="checkbox"  @if($value->is_show) checked @endif value="{{ $value->id }}" data-size="mini"><br>
                                    </td>
                                </tr>
                                @foreach($value->children as $child)
                                    <tr class="collapse collapse_{{ $value->name }}">
                                        <td>
                                            {{ $child->name }}
                                        </td>
                                        <td>
                                            <a href="#" class="username" data-type="text" data-placement="right" data-id="{{ $child->id }}" data-title="Tên hiển thị">{{ $child->title }}</a><br>
                                        </td>
                                        <td>
                                            <input class="bootrap-toggle child-{{ $value->name }}" data-set="{{ $value->name }}" name="status[]" type="checkbox" @if($child->status) checked @endif value="{{ $child->id }}" data-size="mini"><br>
                                        </td>
                                        <td>
                                            <input class="bootrap-toggle child-default-{{ $value->name }}" data-set="default-{{ $value->name }}" name="show[]" type="checkbox" @if($child->is_show) checked @endif value="{{ $child->id }}" data-size="mini"><br>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </table>

                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/x-editable/bootstrap-editable.css') }}">
    <link rel="stylesheet" href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css">
    <style>
        tr[aria-expanded=true] .fa-caret-right {
            display: none;
        }
        tr[aria-expanded=false] .fa-caret-down {
            display: none;
        }

        .cursor-pointer {
            cursor: pointer !important;
        }
    </style>
@endsection

@section('script')
    <script src="{{ asset('plugins/x-editable/bootstrap-editable.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-toggle/bootstrap-toggle.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/admin/permission/index.js') }}"></script>
@endsection
