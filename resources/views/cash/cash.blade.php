@extends('layouts.app-a')
	@section('scripts')
	    <script type="text/javascript" src="{{asset('js/js/ajax.js')}}"></script>
	@endsection
@section('content')

 <table class="table table-responsive table-hover table-sm">
	  <thead class="thead-light">
	        <tr>
		        <th scope="col">Nombre</th>
		        <th scope="col">Slogan</th>
		        <th scope="col"> Cant. Reserva</td>
		        <th scope="col" >Comision</th>
		        <th>Dar Baja</th>
	        </tr>
	   </thead>
	   <tbody>
	   		<?php $sumTatal=0?>
	   		@foreach($restaurants as $item)
	   		<tr>
	   			<td>{{$item->name}}</td>
	   			<td>{{$item->slogan}}</td>
	   			<td>{{sprintf('%03d',$item->cant)}}</td>
	   			<td>{{"S/.".number_format($item->cant,2)}}</td>
	   			<?php $sumTatal+=$item->cant?>
	   			<th><input class="btn btn-outline-primary" type="button" id="{{$item->id}}" value="Pagar" onclick="pagarComision(this.id)"></th>
	   		</tr>
	   		@endforeach
	   		<tr>
	   			<td colspan="2">MONTO  A COBRAR POR COMISIONES :</td>
	   			{{-- <td colspan="1">{{sprintf('%03d',$sumTatal)}}</td> --}}
	   			<td>{{"S/.".number_format($sumTatal,2)}}</td>
	   		</tr>
	   		<tr>
	   			<td colspan="2">MONTO TOTAL DE COMISIONES: </td>
	   			<td>{{"S/.".number_format($totalComision[0]->totalComision,2)}}</td>
	   		</tr>
	   </tbody>
 </table>
 <div id="ajaxResultadosMonto">
 	
 </div>
 @endsection

