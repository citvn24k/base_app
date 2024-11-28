@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex no-block align-items-center mb-2">
                            <h4 class="card-title">Danh sách link</h4>
                            <div class="ml-auto">
                                <a href="{{ route('links.create') }}" class="btn btn-success">
                                    Action
                                </a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Status</th>
                                    <th>Title</th>
                                    <th>ID</th>
                                    <th>Product</th>
                                    <th>Created by</th>
                                    <th>Date</th>
                                    <th>Agent</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @for($i = 0; $i < 10; $i++)
                                    <tr>
                                        <td><span class="label label-warning">In Progress</span></td>
                                        <td><a href="ticket-detail.html" class="font-medium link">Elegant Theme Side Menu Open OnClick</a></td>
                                        <td><a href="ticket-detail.html" class="font-bold link">276377</a></td>
                                        <td>Elegant Admin</td>
                                        <td>Eric Pratt</td>
                                        <td>2018/05/01</td>
                                        <td>Fazz</td>
                                        <td>
                                            @include('admin.components._action',[
                                                'entity' => 'links',
                                                'id' => $i
                                            ])
                                        </td>
                                    </tr>
                                @endfor
                                </tfoot>
                            </table>
                            @include('admin.components._pagination')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
