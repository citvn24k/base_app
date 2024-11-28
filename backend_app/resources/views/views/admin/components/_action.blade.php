@can( \Str::singular($entity) . '_edit')
    <a class="btn btn-info" href="{{ route($entity.'.edit', [\Str::singular($entity) => $id])  }}">
        <i class="fa fa-edit"></i>
    </a>
@endcan

@can( \Str::singular($entity) . '_delete')
    {!! Form::open( ['method' => 'delete', 'url' => route($entity.'.destroy', $id), 'style' => 'display: inline', 'onSubmit' => 'return confirm("Are yous sure wanted to delete it?")']) !!}
    <button type="submit" class="btn btn-danger">
        <i class="fa fa-trash"></i>
    </button>
    {!! Form::close() !!}
@endcan
