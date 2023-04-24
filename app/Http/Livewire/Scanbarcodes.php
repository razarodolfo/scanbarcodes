<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Scanbarcode;
use App\Models\Empleado;
use App\Models\Asistencia;
use Illuminate\Support\Facades\Session;

class Scanbarcodes extends Component
{

	protected $paginationTheme = 'bootstrap';
    public $barcode;
    public $empleado;

    public function render()
    {
        return view('livewire.scanbarcodes.view');
    }
	
    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }
	
    private function resetInput()
    {		
		$this->barcode = null;
    }

    public function store()
    {
        $this->validate([
		'barcode' => 'required',
        ]);

        $barcode = $this->barcode;

        // Buscar al empleado en la base de datos
        $empleado = Empleado::where('barcode', $barcode)->first();

        if ($empleado) {

            $id = $empleado->id;
            //$mensaje = 'El empleado  no esta registrado';

            // Registrar la asistencia del empleado
            $asistencia = Asistencia::where('empleado_id', $id)
                                     ->whereDate('asistencia_time', today())
                                     ->first();
            if ($asistencia) {
                // Si ya existe un registro de asistencia para el empleado hoy, actualizar la hora de salida
                $asistencia = new Asistencia;
                $asistencia->empleado_id = $empleado->id;
                $asistencia->barcode = $empleado->barcode;
                $asistencia->status = $empleado->status;
                $asistencia->asistencia_date = now();
                $asistencia->asistencia_time = now();
                $asistencia->save();
                
                $mensaje = 'El empleado '. $empleado->name  . ' ya esta registrado';

                Session::flash('message', $mensaje); 
                Session::flash('alert-class', 'btn btn-sm btn-warning'); 


            } else {
                // Si no existe un registro de asistencia para el empleado hoy, crear uno nuevo con la hora de entrada
                $asistencia = new Asistencia;
                $asistencia->empleado_id = $empleado->id;
                $asistencia->barcode = $empleado->barcode;
                $asistencia->status = $empleado->status;
                $asistencia->asistencia_date = now();
                $asistencia->asistencia_time = now();
                $asistencia->save();

                Session::flash('message', 'Entrada registrada correctamente.'); 
                Session::flash('alert-class', 'btn btn-sm btn-primary'); 
            }
        } else {
            Session::flash('message', 'Empleado no encontrado.'); 
            Session::flash('alert-class', 'btn btn-sm btn-danger'); 
        }

        $this->resetInput();
    }
}
