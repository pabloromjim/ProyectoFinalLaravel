@extends('backLayout.app')
@section('title')
User
@stop

@section('content')

<h1>Tabla usuarios <a href="{{ url('panel/create') }}" class="btn btn-primary pull-right btn-sm">Añadir nuevo usuario</a></h1>
<div class="table table-responsive">
    <table class="table table-bordered table-striped table-hover" id="tbladmin/user">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Puntuacion</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($user as $item)
            <tr>
                <td><a href="{{ url('panel', $item->id) }}">{{ $item->id }}</a></td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->score }}</td>
                <td>{{ $item->role }}</td>
                <td>
                    <a href="{{ url('panel/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs">Editar</a>
                    {!! Form::open([
                    'method'=>'DELETE',
                    'url' => ['panel', $item->id],
                    'style' => 'display:inline'
                    ]) !!}
                    {!! Form::submit('Eliminar', ['class' => 'btn btn-danger btn-xs']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('#tbladmin/user').DataTable({
            columnDefs: [{
                targets: [0],
                visible: false,
                searchable: false
            }, ],
            order: [
                [0, "asc"]
            ],
        });
    });
</script>
@endsection