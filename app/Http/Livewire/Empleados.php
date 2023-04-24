<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Empleado;

class Empleados extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $barcode, $name, $status, $depto;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.empleados.view', [
            'empleados' => Empleado::latest()
						->orWhere('barcode', 'LIKE', $keyWord)
						->orWhere('name', 'LIKE', $keyWord)
						->orWhere('status', 'LIKE', $keyWord)
						->orWhere('depto', 'LIKE', $keyWord)
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
		$this->name = null;
		$this->status = null;
		$this->depto = null;
    }

    public function store()
    {
        $this->validate([
		'barcode' => 'required',
		'name' => 'required',
		'status' => 'required',
		'depto' => 'required',
        ]);

        Empleado::create([ 
			'barcode' => $this-> barcode,
			'name' => $this-> name,
			'status' => $this-> status,
			'depto' => $this-> depto
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Empleado Successfully created.');
    }

    public function edit($id)
    {
        $record = Empleado::findOrFail($id);

        $this->selected_id = $id; 
		$this->barcode = $record-> barcode;
		$this->name = $record-> name;
		$this->status = $record-> status;
		$this->depto = $record-> depto;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'barcode' => 'required',
		'name' => 'required',
		'status' => 'required',
		'depto' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Empleado::find($this->selected_id);
            $record->update([ 
			'barcode' => $this-> barcode,
			'name' => $this-> name,
			'status' => $this-> status,
			'depto' => $this-> depto
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Empleado Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Empleado::where('id', $id);
            $record->delete();
        }
    }
}
