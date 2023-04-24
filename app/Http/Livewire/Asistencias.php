<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Asistencia;
use App\Models\Empleado;

class Asistencias extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $barcode, $status, $asistencia_date, $asistencia_time, $empleado_id;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.asistencias.view', [
            'asistencias' => Asistencia::latest()
						->orWhere('barcode', 'LIKE', $keyWord)
						->orWhere('status', 'LIKE', $keyWord)
						->orWhere('asistencia_date', 'LIKE', $keyWord)
						->orWhere('asistencia_time', 'LIKE', $keyWord)
						->orWhere('empleado_id', 'LIKE', $keyWord)
						->paginate(10),
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }
	
    private function resetInput()
    {		
		$this->barcode = null;
		$this->status = null;
		$this->asistencia_date = null;
		$this->asistencia_time = null;
		$this->empleado_id = null;
    }

    public function store()
    {
        $this->validate([
		'barcode' => 'required',
		'status' => 'required',
		'asistencia_date' => 'required',
		'asistencia_time' => 'required',
		'empleado_id' => 'required',
        ]);

        Asistencia::create([ 
			'barcode' => $this-> barcode,
			'status' => $this-> status,
			'asistencia_date' => $this-> asistencia_date,
			'asistencia_time' => $this-> asistencia_time,
			'empleado_id' => $this-> empleado_id
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Asistencia Successfully created.');
    }

    public function edit($id)
    {
        $record = Asistencia::findOrFail($id);

        $this->selected_id = $id; 
		$this->barcode = $record-> barcode;
		$this->status = $record-> status;
		$this->asistencia_date = $record-> asistencia_date;
		$this->asistencia_time = $record-> asistencia_time;
		$this->empleado_id = $record-> empleado_id;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'barcode' => 'required',
		'status' => 'required',
		'asistencia_date' => 'required',
		'asistencia_time' => 'required',
		'empleado_id' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Asistencia::find($this->selected_id);
            $record->update([ 
			'barcode' => $this-> barcode,
			'status' => $this-> status,
			'asistencia_date' => $this-> asistencia_date,
			'asistencia_time' => $this-> asistencia_time,
			'empleado_id' => $this-> empleado_id
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Asistencia Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Asistencia::where('id', $id);
            $record->delete();
        }
    }
}
