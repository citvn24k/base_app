<div class="row form-group">
    {!! Form::label('name', 'Tên vai trò <span class="text-red">*</span>', ['required' => true, 'class' => 'col-md-2 col-lg-2 control-label'], false) !!}
    <div class="col-md-4 col-lg-4">
        <div class="clearfix">
            {!! Form::text('name', null, ['class' => 'form-control', 'autofocus' => true]) !!}
        </div>
    </div>
</div>
<div class="col-md-12">
    <div id="dd-{{ isset($title) ? str_slug($title) :  'permissionHeading' }}"
         class="card-collapse collapse {{ $closed ?? 'in' }}" role="tabcard"
         aria-labelledby="dd-{{ isset($title) ? str_slug($title) :  'permissionHeading' }}">
        <div class="card-body" id="mainNode">
            @foreach($permissions->chunk(4) as $perms)
                <div class="row">
                    @foreach($perms as $perm)
                        <?php
                        $per_found = null;
                        if (isset($perm->is_show)) {
                            $per_found = $perm->is_show;
                        }

                        if (isset($role)) {
                            $per_found = $role->hasPermissionTo($perm->name);
                        }

                        if (isset($user)) {
                            $per_found = $user->hasDirectPermission($perm->name);
                        }
                        ?>
                            @if($perm->status)
                                <div class="col-md-3" >
                                    <div class="card border-secondary">
                                        <div class="card-header bg-secondary">
                                            <h4 class="m-b-0 text-white">{!! Form::checkbox("permissions[]", $perm->name, $per_found, ['id' => $perm->name, 'class' => 'ckbox', 'data-set' => $perm->name]) !!} {{ $perm->title ? $perm->title : $perm->name }} ({{ $perm->children_count }})</h4></div>
                                        <div class="card-body" data-set="{{ $perm->name }}">
                                            @foreach($perm->children as $child)
                                                <?php
                                                $per_found_child = null;
                                                if (isset($child->is_show)) {
                                                    $per_found_child = $child->is_show;
                                                }

                                                if (isset($role)) {
                                                    $per_found_child = $role->hasPermissionTo($child->name);
                                                }

                                                if (isset($user)) {
                                                    $per_found_child = $user->hasDirectPermission($child->name);
                                                }

                                                ?>
                                                @if($child->status)
                                                    <div>
                                                        {!! Form::checkbox("permissions[]", $child->name, $per_found_child, ['class' => [$perm->name, 'ckbox']]) !!}
                                                        <span>{{ $child->title ? $child->title : $child->name }}</span>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</div>
@section('script')
    <script src="{{ asset('js/admin/role/index.js') }}"></script>
@endsection
