<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <form action="" method="">
        <input type="text" name="nik" id="nik">
        <input type="text" name="dokter" id="dokter">
        <button type="button" onclick="testIcare()">KIRIM</button>
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <script>
        function testIcare() {
            $.ajax({
                url: '/erm/test/icare',
                data: {
                    _token: "{{ csrf_token() }}",
                    param: $('#nik').val(),
                    kodedokter: $('#dokter').val(),
                },
                method: 'POST',
                dataType: 'JSON',
            }).done(function(response) {
                window.open(response.response.url)
            })
        }
    </script>
</body>

</html>
