{!! Form::open(['route' => [$entity.'.store'], 'class' => 'form-horizontal mt-4', 'autocomplete' => 'off']) !!}
<ul>
    @foreach ($errors->all() as $error)
        <li class="text-danger">{{ $error }}</li>
    @endforeach
</ul>
@include('flash::message')
@include('admin.'. \Str::singular($entity) .'._form')
<div class="form-group">
    @can( \Str::singular($entity) . '_create')
    <button type="submit" class="btn btn-primary">@lang('form.add')</button>
    @endcan
    <a href="{{ url()->previous() }}" class="btn btn-secondary">@lang('form.back')</a>
</div>
{!! Form::close() !!}
