<div class="container"> 
   <div class="wrapper">
        <div class="row">
            <div class="col-md-6">
            <canvas id="my_canvas"  width="520" height="510"  ></canvas>
        </div>
    </div>
    <div class="row" style="margin-top:-40%">
        <div class="col-md-6 ">
        </div>
        <div class="col-md-6">
            <h3 class="text-warning">GESTIÓN DE ASISTENCIA ZONA ELITE</h3>

            <form wire:submit.prevent="store()" class="form-horizontal" style="border-radius: 5px;padding:10px;background:#fff;">
                <div class="form-group">
                    <i class="fa-sharp fa-solid fa-barcode"></i> <label>ESCANEAR CÓDIGO DE BARRAS AQUÍ</label>
                    <label for="barcode"></label>
                    <input wire:model="barcode" type="text" class="form-control" id="barcode" placeholder="Barcode" autofocus>
                    @error('barcode') <span class="error text-danger">{{ $message }}</span> @enderror
                </div>
            </form>
            <div class="row mt-1">
                <div class="col-md-12">
                    <button type="button" class="btn btn-primary" style="font-size: 10px;">Empleado registrado</button>
                    <button type="button" class="btn btn-warning" style="font-size: 10px;">Empleado ya registrado</button>
                    <button type="button" class="btn btn-danger" style="font-size: 10px;">Empleado no encontrado</button>
                    <span class="text-warning">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;V.1.0 </span>
                </div>    
            </div>
            <br>
            @if(Session::has('message'))
                <div wire:poll.4s class="{{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</div>
            @endif
        </div>          
    </div> 
    @include('livewire.scanbarcodes.scripts')
</div>

