<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Masuk | Kalpro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="<?=base_url('assets/css/login-style.css')?>">
    <script src="<?=base_url('assets/js/jquery.min.js')?>"></script>
</head>
<body>
    <form id="logForm">
        <label for="">Username</label>
        <input type="text" name="user" id="user" placeholder="Username">
        <label for="">Password</label>
        <input type="password" name="pass" id="pass" placeholder="Password">
        <button id="login-btn">Masuk</button>
    </form>
    <hr>
    <form id="regForm" action="<?=base_url('dataproccess/register')?>" method="post">
        <label for="">Tipe</label>
        <input type="radio" name="type" value="d">Dosen
        <input type="radio" name="type" value="m">Mahasiswa
        <label for="">Username</label>
        <input type="text" name="user" id="userRegist" placeholder="Username" onChange="userCheck()"><span id="user-availability-status"></span> 
        <label for="">Password</label>
        <input type="password" name="pass" id="passRegist" placeholder="Password">
        <button id="reg-btn">Masuk</button>
    </form>
    <script>
        $('#logForm').submit(function(e){
			e.preventDefault();
            var user = $("#user").val();
            var pass = $("#pass").val();
            $.ajax({
                type  : 'POST',
                url   : '<?=base_url()?>dataproccess/login',
                // dataType: 'json',
                data : {username:user, password:pass},
                beforeSend: function () {
                    // ... your initialization code here (so show loader) ...
                },
                complete: function () {
                    // ... your finalization code here (hide loader) ...
                },
                error: function (jqXHR, textStatus, errorThrown){
                    alert(errorThrown.status);
                },
                success : function(data){
                    if(data == 1){
                        window.location = "<?=base_url()?>";
                    }else{
                        alert(data);
                    }
                }
            });
        });

        function userCheck() {
            $.ajax({
                url: "<?=base_url()?>dataproccess/userCheck",
                data:'username='+$("#userRegist").val(),
                type: "POST",
                beforeSend: function () {
                    $("#user-availability-status").html("<span style='color:yellow'> Memeriksa Ketersediaan Username.</span>");
                },
                success:function(data){
                    $("#user-availability-status").html(data);
                },
                error:function (){}
            });
        }
    </script>
</body>
</html>