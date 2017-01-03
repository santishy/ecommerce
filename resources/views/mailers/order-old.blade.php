<!DOCTYPE html>
<html>
<head>
	<title>Curso codigo facilito</title>
	<meta charset="utf-8">
</head>
<body>
	<h1>Hola mundo</h1>
	<p>Te enviamos los datos de tu compra (codigoFacilito)</p>
	<table>
		<thead>
			<th>Nombre</th>
			<th>Costo</th>
		</thead>
		<tbody>
			@foreach($products as $product)
				<tr>
					<td>{{$product->nombre}}</td>
					<td>{{$product->princing}}</td>
				</tr>
			@endforeach
			<tr>
				<td>Total:</td>
				<td>{{$order->total}}</td>
			</tr>
		</tbody>
	</table>
</body>
</html>