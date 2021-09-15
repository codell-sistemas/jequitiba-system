<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon icon -->
    <link rel="icon" href="http://abcpaint.com.br/wp-content/uploads/2020/08/cropped-Logotipo_ABCPaint_300x300-1-2-32x32.jpg" sizes="32x32" />
    <title>ABCPaint | Inscrições</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body style="background:none !Important;">
@yield('content')
</body>
<script src="/dist/js/jquery.mask.js"></script>
<script src="/dist/js/cidades-estados.js"></script>
<script src="/dist/js/geral.js"></script>
<script>
    $(function () {
        $('body').on('change', '.cep', function () {
            $.get('{{route('cep')}}', {'term': $(this).val()}, function (data) {
                $('#endereco').val(data.logradouro);
                $('#bairro').val(data.bairro);
                $('#uf').val(data.uf);
                $('#uf').trigger('change');

                $('#cidade').val(data.localidade);
                $('#cidade').trigger('change');


            }, 'json');
        });
    });
</script>
</html>
