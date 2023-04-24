@extends('layouts.app')
@section('title', __('Dashboard'))
@section('content')
<div class="container-fluid">
<div class="row justify-content-center">

</div>
</div>
<div class="container"> 
   <div class="wrapper">
    <div class="row">
        <div class="col-md-6">
        <canvas id="my_canvas"  width="520" height="510"  ></canvas>
        </div>
  </div>
    <div class="row" style="margin-top:-30%">
        <div class="col-md-6 ">
        </div>
        <div class="col-md-6">
                            <h3 style="color:#fff">GESTIÓN DE ASISTENCIA DE EMPLEADOS V1.0</h3>

        <form wire:submit.prevent="scanBarcodes" class="form-horizontal" style="border-radius: 5px;padding:10px;background:#fff;">
            <i class="fa-sharp fa-solid fa-barcode"></i> <label>ESCANEAR CÓDIGO DE BARRAS AQUÍ</label><p></p>
            <input wire:model="barcode" type="text" id="barcode" class="form-control" autofocus>
            <button type="submit"></button>
        </form>
        @if (session()->has('message'))
            <div>{{ session('message') }}</div>
        @endif
         <div class="row">
                <div class="col-md-6">
                 <label style="color:#fff">Legend: </label>
                    <label class="label label-primary">Tiempo en</label>
                    <label class="label label-Success">Se acabó el tiempo</label>
                    <label class="label label-danger">Número de identificación no encontrado</label>
                </div>
                </div>
                <br>
        <div class="row">   
            <div class="col-md-12">
          </div>
          </div>
        </div>
    </div>          
    </div> 
        @include('livewire.scripts')
</div>

@endsection