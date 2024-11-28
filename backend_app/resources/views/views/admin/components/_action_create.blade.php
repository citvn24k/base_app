@can( \Str::singular($entity) . '_create')
    <a href="{{ route($entity.'.create') }}" class="btn btn-success">
        @lang('form.add')
    </a>
@endcan
