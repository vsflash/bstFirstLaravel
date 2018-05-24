@extends('layouts.app')
@section('content')
<!-- Bootstrap шаблон... -->
<div class="panel-body">
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    <!-- Форма новой задачи -->
    <form action="{{ url('task/'.$news->id) }}" method="POST" class="form-horizontal">
	{{ csrf_field() }}
	{{ method_field('PUT') }}
	<!-- Имя задачи -->
	<div class="form-group">
	    <label for="task" class="col-sm-3 control-label">Новость</label>
	    <div class="col-sm-6">
		<input type="text" name="name" id="task-name" class="form-control" value="{{$news->name}}">
	    </div>
	</div>
	<!-- Кнопка добавления задачи -->
	<div class="form-group">
	    <div class="col-sm-offset-3 col-sm-6">
		<button type="submit" class="btn btn-default">
		    <i class="fa fa-save"></i> Сохранить новость
		</button>
	    </div>
	</div>
    </form>
</div>
@endsection