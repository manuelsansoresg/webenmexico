@extends('adminlte::page')
@section('title', 'Nuevo comentario')

@section('content_header')
    <h1>Nuevo comentario</h1>
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
           <div class="card">
            <div class="card-body">
                <form id="frm-comment-admin">
                    @csrf
                    @php
                        $name       = isset($get_comment) ? $get_comment->name : null;
                        $comment    = isset($get_comment) ? $get_comment->comment : null;
                        $active     = isset($get_comment) ? $get_comment->active : null;
                        $comment_id = isset($get_comment) ? $get_comment->comment_id : null;
                    @endphp
                    <div class="form-group">
                        <label class="form-label" for="create-task-name">*Nombre completo</label>
                        <div class="form-control-wrap">
                           <input type="text" class="form-control" name="comment[name]" placeholder="Introduce el nombre completo" required value="{{ $name }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="create-task-name">*Comentario</label>
                        <div class="form-control-wrap">
                           <textarea name="comment[comment]" id="" cols="30" rows="5" class="form-control" required>{{ $comment }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="create-task-name">*Activo</label>
                        <div class="form-control-wrap">
                           <select name="comment[active]" id="" class="form-control" required>
                            <option value="0" {{ $active == 0 ? 'selected' : ''}}>Desactivado</option>
                            <option value="1" {{ $active == 1 ? 'selected' : ''}}>Activado</option>
                           </select>
                        </div>
                    </div>
                    <div class="form-group text-right">
                        <input type="hidden" name="comment_id" value="{{ $comment_id }}">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
               
            </div>
           </div>
        </div>
    </div>
</div>
@stop