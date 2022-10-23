@extends('layouts.app')


@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
        </div>
    </div>
</div>

<div class="container-fluid mt--7">
 <div class="row">
   <div class="col">
     <div class="card">
        <div class="card-header border-6">
           <h3 class="mb-0">Detalles de Venta</h3>
        </div>
      
        <detalles-component />
            
        
    </div>
</div>
</div>

@endsection