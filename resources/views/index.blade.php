<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Form CEP</title>
</head>
<body>
	<form method="POST">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="text" name="cep" required="true">
		<input type="submit" value="Pesquisar">
	</form>
	@if (count($errors) > 0)
    	<div>
    	@foreach ($errors->all() as $error)
        	<p>{{ $error }}</p>
    	@endforeach
    	</div>
    @endif	

    @if (!empty($mensagem))
		{{$mensagem}}
    @endif
</body>
</html>