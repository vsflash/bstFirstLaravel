<?php

use App\Task;
use Illuminate\Http\Request;

/**
 * Вывести панель с задачами
 */
Route::get('/', function () {
    //получить все задачи
    $tasks = Task::all();
    return view('tasks', [
        'tasks' => $tasks,
    ]);
});

/**
 * Добавить новую задачу
 */
Route::post('/task', function (Request $request) {
    //проверка данных
    $validator = Validator::make($request->all(), [
                'name' => 'required|min:5|max:255',
    ]);

    if ($validator->fails()) {
        return redirect('/')
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
    return redirect('/');
});

Route::post('/task/{task}', function (Task $task) {
    return view('task', [
        'task' => $task,
    ]);
});

/**
 * update задачу
 */
Route::post('/task/{task}/update', function (Request $request) {
    //$name = $request->id;
    $task = Task::find($request->id);
    $task->name = $request->name;
    $task->save();
    //$res->update(['name' => $name);
    return redirect('/');
    //$task->name = $request->name;
});
