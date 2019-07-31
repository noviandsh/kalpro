<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Masuk | Kalpro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="<?=base_url('assets/css/login-style.css')?>">
    <script src="<?=base_url('assets/js/jquery.min.js')?>"></script>
    <script src="<?=base_url('assets/js/particles.js')?>"></script>
</head>
<body id="particles-js">
    <div id="container">
        <div id="login-container">
            <form id="logForm">
                <span>Login</span>
                <div>
                    <input type="text" name="user" id="user" placeholder="Username">
                </div>
                <div>
                   <input type="password" name="pass" id="pass" placeholder="Password">
                </div>
                <div>
                    <button id="login-btn">Masuk</button>
                </div>
            </form>
        </div>
        <div id="register-container">
            <form id="regForm" action="<?=base_url('dataprocess/register')?>" method="post">
                <span>Register</span>
                <div>
                    <label for="">Tipe</label>
                    <input type="radio" name="type" value="d">Dosen
                    <input type="radio" name="type" value="m">Mahasiswa
                </div>
                <div>
                    <input type="text" name="user" id="userRegist" placeholder="Username" onChange="userCheck()"><span id="user-availability-status"></span> 
                </div>
                <div>
                    <input type="password" name="pass" id="passRegist" placeholder="Password">
                </div>
                <div>
                    <button id="reg-btn">Masuk</button>
                </div>
            </form>
        </div>
        <div id="front-mask">
            <div>
                <span id="logo">Kalpro</span>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque rerum magni corrupti odio, voluptatem maiores porro aspernatur eaque eum possimus doloremque vel!</p>
                <button id="mask-btn">Daftar</button>
            </div>
        </div>
    </div>
    <script src="<?=base_url('assets/js/TweenMax.js')?>"></script>
    <script src="<?=base_url('assets/js/TimelineMax.js')?>"></script>
    <script>
        /* particlesJS.load(@dom-id, @path-json, @callback (optional)); */
        // particlesJS.load('particles-js', 'assets/js/particlesjs-config-black.json', function() {
        // console.log('callback - particles.js config loaded');
        // });
        let mask = true;
        $('#mask-btn').click(function(){
            console.log(mask);  
            if(mask){
                console.log('wkwk');
                $('#front-mask').css('transform', 'translateX(-520px)');
                $('#register-container').css('width', '520px');
                $('#login-container').css('width', '280px');
                $('#logForm').css('transform', 'translateX(550px)');
                $('#regForm').css('transform', 'translateX(0px)');
                $(this).html('Masuk');
            }else{
                console.log('haha');
                $('#front-mask').css('transform', 'translateX(0px)');
                $('#register-container').css('width', '280px');
                $('#login-container').css('width', '520px');
                $('#logForm').css('transform', 'translateX(0px)');
                $('#regForm').css('transform', 'translateX(-550px)');
                $(this).html('Daftar');
            }
            mask = !mask;
        })

        $('#logForm').submit(function(e){
			e.preventDefault();
            var user = $("#user").val();
            var pass = $("#pass").val();
            $.ajax({
                type  : 'POST',
                url   : '<?=base_url()?>dataprocess/login',
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
                url: "<?=base_url()?>dataprocess/userCheck",
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