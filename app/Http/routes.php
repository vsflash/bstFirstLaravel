<?php

use App\Task;
use App\News;
use Illuminate\Http\Request;

/**
 * Вывести панель с задачами
 */
Route::get('/tasks', function () {
    //получить все задачи
    $tasks = Task::all();
    return view('tasks', [
        'tasks' => $tasks,
    ]);
})->name('show_all_tasks');

/**
 * Добавить новую задачу
 */
Route::post('/task', function (Request $request) {
    //проверка данных
    $validator = Validator::make($request->all(), [
                'name' => 'required|min:5|max:255',
    ]);

    if ($validator->fails()) {
        return redirect(route('show_all_tasks'))
                        ->withInput()
                        ->withErrors($validator);
    }
    $task = new Task();
    $task->name = $request->name;
    $task->save();
    return redirect('/');
});

/**
 * Удалить задачу
 */
Route::delete('/task/{task}', function (Task $task) {
    $task->delete();
    return redirect(route('show_all_tasks'));
});
/**
 * форма редактирования
 */
Route::get('/task/{task}/edit', function (Task $task) {
    return view('taskedit', [
        'task' => $task,
    ]);
});

/**
 * update задачу
 */
Route::put('/task/{task}', function (Request $request) {
    $task = Task::find($request->id);
    $task->name = $request->name;
    //$task->save();
    $task->update();
    return redirect(route('show_all_tasks'));
});
/* * ------------------------* */
/* * ---------NEWS---------------* */
/* * ------------------------* */
/**
 * Вывести таблицу с новостями
 */
Route::get('/news', function () {
//получить все news
    $news = News::all();
    return view('news/news', [
        'news' => $news,
    ]);
})->name('show_all_news');

/**
 * Добавить новую новость
 */
Route::post('/news/create', function (Request $request) {
//проверка данных
    $validator = Validator::make($request->all(), [
                'name' => 'required|min:5|max:255',
    ]);

    if ($validator->fails()) {
        return redirect(route('show_all_tasks'))
                        ->withInput()
                        ->withErrors($validator);
    }
    $news_item = new News();
    $news_item->name = $request->name;
    $news_item->save();
    return redirect(route('show_all_news'));
});

/**
 * Удалить новость
 */
Route::delete('/news/{news}', function (News $news) {
    $news->delete();
    return redirect(route('show_all_news'));
});

/**
 * форма редактирования
 */
Route::get('/news/{news}/edit', function(News $news) {
    return view('news/newsedit', [
	'news' => $news,
    ]);
});
/**
 * сохранение изменений редактирования
 */
Route::put('/news/{news}',function(News $news, Request $request){
     $validator = Validator::make($request->all(), [
		'name' => 'required|min:5|max:255',
    ]);

    if ($validator->fails()) {
	return redirect('/news/'.$news->id.'/edit')
			->withInput()
			->withErrors($validator);
    }
    $news->name=$request->name;
    $news->save();
    return redirect(route('show_all_news'));
});
