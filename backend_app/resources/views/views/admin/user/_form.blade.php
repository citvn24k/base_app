<div class="form-group row">
    <label for="name" class="col-sm-2 control-label col-form-label">Name</label>
    <div class="col-sm-8">
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group row">
    <label for="slug" class="col-sm-2 control-label col-form-label">Email</label>
    <div class="col-sm-8">
        {!! Form::text('email', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group row">
    <label for="slug" class="col-sm-2 control-label col-form-label">Password</label>
    <div class="col-sm-8">
        {!! Form::password('password', ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group row">
    <label for="description" class="col-sm-2 control-label col-form-label ">Role</label>
    <div class="col-sm-8">
        @php
            $arr_roles = [];
            if (isset($user->roles) && !empty($user->roles)) {
                foreach ($user->roles as $role) {
                    array_push($arr_roles, $role->id);
                }
            }
        @endphp
        {!! Form::select('role', $roles, !empty($arr_roles) ? $arr_roles : null, ['class' => 'form-control select2', 'style' => 'width:100%']) !!}
    </div>
</div>



