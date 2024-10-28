<?php

namespace App\Console\Commands;

use App\Models\Task;
use App\Models\User;
use Illuminate\Console\Command;
use function Laravel\Prompts\form;
use function Laravel\Prompts\table;
use function Laravel\Prompts\text;

class DeleteTaskPending extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:deletetask';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Borra todas las tareas que estan en softdelete';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        // $responses = form()
        // ->text('What is your name?', required: true)
        // ->password('What is your password?', validate: ['password' => 'min:8'])
        // ->confirm('Do you accept the terms?')
        // ->submit();
        // dd($responses);
        

    // table(
    //     headers: ['Name', 'Email'],
    //     rows: User::all(['name', 'email'])->toArray()
    // );
    //Eliminar todas las tareas que no son nulas en la fecha de eliminación
    // Task::where('deleted_at','!=', null)->forceDelete();
    // text('Todas las tareas han sido borradas');
    // info('Todas las tareas han sido borradas');
    //borrar tareas que el deleted_at es mayor a 5 dias
    Task::where('deleted_at', '!=', null)
    ->where('deleted_at', '<', now()->subDays(5))
    ->forceDelete();
    }
}
