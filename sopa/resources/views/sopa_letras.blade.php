<!DOCTYPE html>
<html>
<html lang="es">
<head>
	<title>Sopa de Letras</title>
	<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
	<script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<link rel="stylesheet" href="{{asset('css/SopaStyle.css')}}">

<body>

<div class="jumbotron text-center">
		<h1>Sopa de Letras</h1>
		<h5>Busca palabras en una sopa de letras personalizada</h5>
</div>

	<div class="alert alert-warning alert-dismissable errormsg" style="display:none">
		<ul></ul>
    </div>

	<div class="container-fluid">
		<form class="col-md-4 mx-auto text-center">
			{{ csrf_field() }}
			<div class="form-group">
			<br>
				<strong>Filas:</strong>
				<input type="number" min="1" max="100" maxlength="3" name="filas" class="form-control" placeholder="0-100">
			</div>
			<div class="form-group">
				<strong>Columnas:</strong>
				<input type="number" min="1" max="100" name="columnas" class="form-control" placeholder="0-100">
			</div>
			<div class="form-group">
				<strong>Datos:</strong>
				<textarea class="form-control" name="datos" class="form-control" placeholder="ABCD..."></textarea>
				<div class="alert alert-warning alert-dismissable data-err" style="display:none">
				</div>
			</div>

			<div class="form-group">
				<strong>Palabra a buscar:</strong>
				<input type="text"  maxlength="40" class="form-control" name="palabra" placeholder="OIE">
			</div>
			<div class="form-group">
				<button class="btn btn-success btn-block btn-submit">Buscar</button>
			</div>
			<br>
		</form>
	</div>
	
	
	<div class="col-md-6 mx-auto text-center" name="table" style="display:none">
		<p><strong></strong></p>
		<div class="table-responsive">
			<div class="panel-body" style="overflow:auto;">
			<table class="table table-fit table-bordered table-hover text-center">
			<thead>
				<tr>
					<th>
					</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
			</table>
			</div>
		</div>
	</div>
	
<script type="text/javascript" src="{{asset('js/SopaQuery.js')}}"></script>
</body>
</html>





