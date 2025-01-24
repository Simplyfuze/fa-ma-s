<?php

namespace App\Http\Controllers;

use App\Models\Consumable;
use App\Models\Equipment;
use App\Models\Field;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return Inertia::render('Tasks/Index', ['tasks' => $tasks]);
    }

    public function create(Request $request)
    {
        $users = User::where(function ($query) {
            $query->where('role', 'farmer')->orWhere('role', 'worker');
        });
        return Inertia::render('Tasks/create', [
            'consumables' => Consumable::all(),
            'equipments' => Equipment::all(),
            'fields' => Field::all(),
            'users' => $users->get(),
            'group' => $request->get('group'),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'task_name' => 'required|string|max:255',
            'task_type' => 'required|string|max:255| in:sowing,fertilizing,harvesting,spraying,plowing,cultivation,maintenance,other',
            'task_description' => 'nullable|string',
            'task_status' => 'required',
            'consumables' => 'nullable|array',
            'equipments' => 'nullable|array',
            'users' => 'required|array',
            'field_id' => 'nullable|string|',
            'group_id' => 'required|string|',
        ]);

        $validated['task_status'] = filter_var($validated['task_status'], FILTER_VALIDATE_BOOLEAN);

        $task = Task::create(['task_name' => $validated['task_name'],
            'task_type' => $validated['task_type'],
            'task_description' => $validated['task_description'],
            'task_status' => $validated['task_status'],
            'group_id' => $validated['group_id'],
            'field_id' => $validated['field_id'],
        ]);

        $task->users()->attach($validated['users']);
        $task->consumables()->attach($validated['consumables']);
        $task->equipments()->attach($validated['equipments']);

        return redirect()->route('groups.show', ['id' => $validated['group_id']])->with('success', 'Task created successfully.');
    }

    public function show(string $id)
    {
        $task = Task::findOrFail($id);

        $users = $task->users()->get();
        $consumables = $task->consumables()->get();
        $equipments = $task->equipments()->get();
        $field = $task->field()->get();

        return Inertia::render('Tasks/show', [
            'task' => $task,
            'users' => $users,
            'consumables' => $consumables,
            'equipments' => $equipments,
            'field' => $field,
        ]);
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'task_status' => 'required',
        ]);

        $validated['task_status'] = filter_var($validated['task_status'], FILTER_VALIDATE_BOOLEAN);

        $task = Task::findOrFail($id);

        $task->update($validated);

        $group = $task->group()->first();

        return redirect()->route('groups.show', ['id' => $group->id])->with('success', 'Task updated successfully.');
    }

    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);
        $group = $task->group()->first();

        $task->users()->detach();
        $task->consumables()->detach();
        $task->equipments()->detach();

        $task->delete();
        return redirect()->route('groups.show', ['id' => $group->id ])->with('success', 'Task deleted successfully.');
    }


}
