<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Masuk | Kalpro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="<?=base_url('assets/css/all.min.css')?>">
    <link rel="stylesheet" type="text/css" media="screen" href="<?=base_url('assets/css/login-style.css')?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <link href="<?=base_url('assets/img/circ-favicon-v2.png');?>" rel="shortcut icon" type="text/css">
    <script src="<?=base_url('assets/js/jquery.min.js')?>"></script>
    <script src="<?=base_url('assets/js/particles.js')?>"></script><!-- jQuery Modal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <meta name="google-signin-client_id" content="629518986414-8j66q6m7h3mf08kh51n18cpsrkigl1kk.apps.googleusercontent.com">
</head>
<body id="particles-js">
    <div id="navbar">
        <span id="logo">K</span>
    </div>
    <div id="container">
        <div id="form-container">
            <div id="desc"><span>Kalpro</span> merupakan sebuah platform untuk sarana pembelajaran kuis algoritma pemrograman yang dikembangkan untuk Dosen dan Mahasiswa. Mempermudah dosen untuk memanajemen kuis algoritma pemrograman dan mempermudah mahasiswa untuk mempelajari dan berdiskusi tentang algoritma pemrograman.</div>
            <!-- <span id="login-tab" class="tab-btn active" tab="login">Masuk</span> &nbsp;&nbsp;|&nbsp;&nbsp; <span id="register-tab" class="tab-btn" tab="register">Daftar</span> -->
            <div id="login-container">
                <span>Masuk dengan:</span><br><br>
                <div class="g-signin2" data-onsuccess="onSignIn"></div><br>
                <span style="color:rgba(255, 255, 255, 0.3);font-size: 12px;">- ATAU -</span>
                <form id="logForm">
                    <div class="input-group email">
                        <input class="fancy-input" type="email" name="email" id="email" placeholder=" ">
                        <span class="floating-label">Email</span>
                    </div>
                    <div class="input-group pass">
                        <input class="fancy-input" type="password" name="pass" id="pass" placeholder=" ">
                        <span class="floating-label">Password</span>
                    </div>
                    <div>
                        <button class="styled-btn" id="login-btn" data-icon='&#xf2f6'>Masuk</button>
                    </div>
                    <br><br><br>
                    <div>
                        <?=$this->session->regist?>
                    </div>
                </form>
            </div>
            <!-- <div id="front-mask">
                <div>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloremque rerum magni corrupti odio, voluptatem maiores porro aspernatur eaque eum possimus doloremque vel!</p>
                    <button id="mask-btn">Daftar</button>
                </div>
            </div> -->
            <!-- Modal HTML embedded directly into document -->
            <div id="register-modal" class="modal">
                <div id="register-container">
                    <br><br>
                    <form id="regForm" action="<?=base_url('dataprocess/register')?>" method="post">
                        <input type="text" name="google-acc" id="google-acc">
                        <input type="text" name="photo" id="photo">
                        <textarea name="idtoken" id="idtoken" cols="30" rows="10"></textarea>
                        <div>
                            <label for="">Daftar sebagai :</label><br><br>
                            <input type="radio" name="type" value="d" required> Dosen
                            <input type="radio" name="type" value="m" required> Mahasiswa
                        </div>
                        <div class="input-group email-reg">
                            <input class="fancy-input" type="text" name="reg-email" id="reg-email" placeholder=" " onChange="userCheck()" required>
                            <span class="floating-label">Email</span>
                        </div>
                        <div class="input-group name-reg">
                            <input class="fancy-input" type="text" name="reg-name" id="reg-name" placeholder=" " onChange="userCheck()" required>
                            <span class="floating-label">Nama</span>
                        </div>
                        <div><span id="user-availability-status"></span> </div>
                        <div class="input-group pass-reg">
                            <input class="fancy-input" type="password" name="pass" id="passRegist" placeholder=" ">
                            <span class="floating-label">Password</span>
                        </div>
                        <div class="input-group pass-reg">
                            <input class="fancy-input" type="password" name="pass" id="passRegist" placeholder=" ">
                            <span class="floating-label">Password</span>
                        </div>
                        <div>
                            <button class="modal-btn" data-icon='&#xf46d' id="reg-btn">Daftar</button>
                            <a style="color: #6b6a6a;" href="#" rel="modal:close" onclick="signOut();">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
            <div id="modal" class="modal">
                <p>Email anda belum terdaftar. Apakah anda ingin mendaftar?</p>
                <button id="reg-modal-btn" class="modal-btn" data-icon='&#xf46d'>Daftar</button>
                <a style="color: #6b6a6a;" href="#" rel="modal:close" onclick="signOut();">Batal</a>
            </div>

        </div>
        <div id="vector-img">
            <img src="<?=base_url()?>assets/img/front-vector.svg" alt="">
        </div>
    </div>
    <script src="<?=base_url('assets/js/TweenMax.js')?>"></script>
    <script src="<?=base_url('assets/js/TimelineMax.js')?>"></script>
    <script>
        /* particlesJS.load(@dom-id, @path-json, @callback (optional)); */
        // particlesJS.load('particles-js', 'assets/js/particlesjs-config-black.json', function() {
        // console.log('callback - particles.js config loaded');
        // });
        
        function signOut() {
            var auth2 = gapi.auth2.getAuthInstance();
            auth2.signOut().then(function () {
            console.log('User signed out.');
            });
        }
        function onSignIn(googleUser) {
            let profile = googleUser.getBasicProfile();
            // console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
            // console.log('Name: ' + profile.getName());
            // console.log('Image URL: ' + profile.getImageUrl());
            // console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
            let name =  profile.getName();
            let photo = profile.getImageUrl();
            let email = profile.getEmail(); // This is null if the 'email' scope is not present.
            let id_token = googleUser.getAuthResponse().id_token;

            // AJAX
            $.ajax({
                type  : 'POST',
                url   : '<?=base_url()?>dataprocess/googlelogin',
                // dataType: 'json',
                data : {
                    name: name,
                    photo: photo,
                    email:email, 
                    token:id_token
                },
                error: function (jqXHR, textStatus, errorThrown){
                    alert(errorThrown.status);
                },
                success : function(data){
                    // console.log(data);
                    if(data.status == 1){
                        window.location = "<?=base_url()?>";
                    }else{
                        $("#modal").modal({
                            escapeClose: false,
                            clickClose: false,
                            showClose: false,
                            fadeDuration: 100
                        });
                        $('.pass-reg').hide();
                        $('.pass-reg').children('input').prop('required', false);
                        $('#reg-email').val(email).prop('readonly', true);
                        $('#reg-name').val(name).css('color', 'black');
                        $('#google-acc').val('1');
                        $('#idtoken').val(id_token);
                        $('#photo').val(photo);
                    }
                }
            });

            // XHR
            // let xhr = new XMLHttpRequest();
            // xhr.open('POST', '<?=base_url('dataprocess/googlelogin')?>');
            // xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            // xhr.onload = function() {
            // console.log('Signed in as: ' + xhr.responseText);
            // };
            // xhr.send('idtoken=' + id_token);
        }

        $('#reg-modal-btn').click(function(){
            $("#register-modal").modal({
                escapeClose: false,
                clickClose: false,
                showClose: false,
                fadeDuration: 100
            });
        });

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

        let tab;
        $('.tab-btn').click(function(){
            tab = $(this).attr('tab');
            if(tab=='login'){
                $('#register-container').hide();
                $('#register-tab').removeClass('active');
            }else if(tab=='register'){
                $('#login-container').hide();
                $('#login-tab').removeClass('active');
            }
            $('#'+tab+'-container').show();
            $(this).addClass('active');
        });

        $('#logForm').submit(function(e){
			e.preventDefault();
            var email = $("#email").val();
            var pass = $("#pass").val();
            $.ajax({
                type  : 'POST',
                url   : '<?=base_url()?>dataprocess/login',
                // dataType: 'json',
                data : {email:email, password:pass},
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
                    if(data.status == 1){
                        window.location = "<?=base_url()?>";
                    }else{
                        console.log(data.msg);
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
                    $("#user-availability-status").html("<span style='color:yellow;font-size: 16px;'> Memeriksa Ketersediaan Username.</span>");
                },
                success:function(data){
                    $("#user-availability-status").html(data);
                },
                error:function (){}
            });
        }
    </script>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
</body>
</html>