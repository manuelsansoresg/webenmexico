@extends('adminlte::page')
@section('title', 'Comentarios')

@section('content_header')
    <h1>Comentarios</h1>
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
           <div class="card">
            <div class="card-body">
                <div class="col-12 text-right py-3">
                    <a href="/admincomment/create" class="btn btn-primary">Nuevo comentario</a>
                </div>

                <table id="example" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Comentario</th>
                            <th>Fecha</th>
                            <th>Estatus</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($comments as $comment)
                            <tr>
                                <td>{{ $comment->name }}</td>
                                <td>{{ $comment->comment }}</td>
                                <td>{{ $comment->created_at->diffForHumans() }}</td>
                                <td>
                                    {!! $comment->active == 1 ? '<span class="right badge badge-primary">Activado</span>' : '<span class="right badge badge-danger">Desactivado</span>' !!}
                                </td>
                                <td>
                                    <a href="/admincomment/{{ $comment->id }}/edit" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                    <a onclick="deleteComment({{$comment->id}})" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
           </div>
        </div>
    </div>
</div>
@stop