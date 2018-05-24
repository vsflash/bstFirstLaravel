@extends('layouts.app')
@section('content')
<!-- Bootstrap шаблон... -->
<div class="panel-body">
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    <!-- Форма новой задачи -->
    <form action="{{ url('news') }}/create" method="POST" class="form-horizontal">
        {{ csrf_field() }}
        <!-- Имя задачи -->
        <div class="form-group">
            <label for="task" class="col-sm-3 control-label">Новость</label>

            <div class="col-sm-6">
                <input type="text" name="name" id="task-name" class="form-control">
            </div>
        </div>
        <!-- Кнопка добавления задачи -->
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-default">
                    <i class="fa fa-plus"></i> Добавить новость
                </button>
            </div>
        </div>
    </form>
</div>
@if (count($news) > 0)
<div class="panel panel-default">
    <div class="panel-heading">
        Список news
    </div>
    <div class="panel-body">
        <table class="table table-striped task-table">
            <!-- Заголовок таблицы -->
            <thead>
            <th>News</th>
            <th>Create/Update</th>
            <th colspan="2">action</th>
            </thead>
            <!-- Тело таблицы -->
            <tbody>
                @foreach ($news as $news_item)
                <tr>
                    <!-- Имя задачи -->
                    <td class="table-text">
                        <div>{{ $news_item->name }}</div>
                    </td>
                    <td class="table-text">
                        <div>{{ $news_item->created_at }}/{{ $news_item->updated_at }}</div>
                    </td>
                    <td>
                        <form method="post" action="/news/{{$news_item->id}}">
                            {{ csrf_field() }}
                            {{method_field('DELETE')}}
                            <button type="submit">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </td>
                    <td>
                        <a href="/news/{{$news_item->id}}/edit">
                            <button type="submit">
                                <i class="fa fa-pencil-square-o"></i>
                            </button>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
@endsection