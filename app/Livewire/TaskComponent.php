<?php

namespace App\Livewire;

use App\Jobs\RemoveAllTasks;
use App\Mail\SharedTask;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;


class TaskComponent extends Component
{
    public $tasks = [];
    public $title;
    public $description;
    public $id;
    public $miTarea = null;
    public $modal = false;
    public $isUpdating = false;
    public $users = [];
    public $user_id;
    public $permiso;
    public $modalShare = false;
    public function mount()
    
    {
        $this->tasks = $this->getTasks()->sortByDesc('id');
        $this->users = User::where('id', '!=', auth()->user()->id)->get();
    }
    public function renderAllTasks(){
        $this->tasks = $this->getTasks()->sortByDesc('id');
    }
    public function getTasks(){
        $user = auth()->user();## Usuario
        $misTareas = Task::where('user_id', auth()->user()->id)->get();## Cogo las tareas y las tareas compartidas y las uno en una sola colección
        $misSharedTasks = $user->SharedTasks()->get();
        return $misSharedTasks->merge($misTareas);
        // return Task::where('user_id', auth()->user()->id)->get();
    }

    
    private function clearFields(){
        $this->title = '';
        $this->description = '';
        $this->id = '';
        $this->miTarea = null;
        $this->isUpdating = false;
    }
    public function openCreateModal(Task $task = null){
        $this->isUpdating = false;

        if($task){
            // $this->isUpdating = true;
            $this->miTarea = $task;
            $this->title = $task->title;
            $this->description = $task->description;
            $this->id = $task->id;
        }else{
                $this->clearFields();
        }
        $this->modal = true;
    }
    public function closeCreateModal(){
        $this->modal = false;
    }
    public function createorUpdateTask(){

            if ($this->miTarea->id) {## Si encuentra la tarea la actualiza
                $task = Task::find($this->miTarea->id);
                $task->update([
                    'title' => $this->title,
                    'description' => $this->description,
                ]);
            }else{
                $task = Task::create([## Sino encuentra la tarea a traves del id la crea
                    'title' => $this->title,
                    'description' => $this->description,
                    'user_id' => auth()->user()->id,
                ]);
            }


        $this->clearFields();
        $this->modal = false;# Si el modal no se rellena y acepta limpia los campos y no los guarda en la base de datos
        $this->tasks = $this->getTasks()->sortByDesc('id');# Ordena las tareas por un id descendente
    }
    public function deleteTask(Task $task){ # Función de eliminar las tareas
        $task->delete();
        $this->tasks = $this->getTasks()->sortByDesc('id');
    }
    public function openShareModal(Task $task){

        $this->modalShare = true;
        $this->miTarea = $task;

    }
    public function closeShareModal(){
        $this->modalShare = false;
    }
    public function shareTask(){
        $task = Task::find($this->miTarea->id);
        $user = User::find($this->user_id);
        $user->sharedTasks()->attach($task->id, ['permission' => $this->permiso]);
        $this->closeShareModal();
        $this->tasks = $this->getTasks()->sortByDesc('id');
        $userOrigin = User::find(auth()->user()->id);
        Mail::to($user->email)->queue(new SharedTask($task, $userOrigin));

    }
    public function taskUnshared(Task $task){
        $user = User::find(auth()->user()->id);
        $user->sharedTasks()->detach($task->id);
        $this->tasks = $this->getTasks()->sortByDesc('id');
    }
    public function removeAllTasks(){
        $user = User::find(auth()->user()->id);
        RemoveAllTasks::dispatch($user);
        $this->tasks = $this->getTasks()->sortByDesc('id');
    }
    public function recoverAllTasks(){
        $user = User::find(auth()->user()->id);
        $user->tasks()->restore();
        $this->tasks = $this->getTasks()->sortByDesc('id');

    }


}