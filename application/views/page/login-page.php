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
            <div id="hide-form"><i class="fas fa-arrow-left"></i></div>
            <div id="desc"><span>Kalpro</span> merupakan sebuah platform untuk sarana pembelajaran kuis algoritma pemrograman yang dikembangkan untuk Dosen dan Mahasiswa. Mempermudah dosen untuk memanajemen kuis algoritma pemrograman dan mempermudah mahasiswa untuk mempelajari dan berdiskusi tentang algoritma pemrograman.</div>
            <?php
                function repol($key){
                    if(isset($_SESSION['data'][$key])){
                        return $_SESSION['data'][$key];
                    }
                }
                function grepol($key){
                    if(isset($_SESSION['data'][$key])){
                        if($_SESSION['data']['google'] == 1){
                            return $_SESSION['data'][$key];
                        }
                    }
                }
            ?>
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
                    <div id="register-status">
                        <div><?=(isset($_SESSION['regist']))?$_SESSION['regist']:'';?></div>
                    </div>
                    <div>
                        <button class="styled-btn" id="login-btn" data-icon='&#xf2f6'>Masuk</button> <a href="#" id="regist-trigger">Daftar</a>
                    </div>
                    <br><br><br>
                </form>
            </div>
            <!-- Modal HTML embedded directly into document -->
            <div id="register-modal" class="modal">
                <div id="register-container">
                    <ul id="validation-error">
                        <?php if(isset($_SESSION['data'])): 
                                foreach($_SESSION['data']['validation_error'] as $error): ?>
                            <li><?=$error?></li>
                        <?php endforeach; 
                            endif; ?>
                    </ul>
                    <br><br>
                    <form id="regForm" action="<?=base_url('dataprocess/register')?>" method="post">
                        <input type="hidden" name="google-acc" id="google-acc" value="<?=grepol('google')?>">
                        <input type="hidden" name="photo" id="photo" value="<?=grepol('photo')?>">
                        <textarea style="display:none;" name="idtoken" id="idtoken" cols="30" rows="10"><?=grepol('token')?></textarea>
                        <input type="hidden" name="id" id="id">
                        <div>
                            <label for="">Daftar sebagai :</label><br><br>
                            <input type="radio" name="type" value="d"> Dosen
                            <input type="radio" name="type" value="m"> Mahasiswa
                        </div>
                        <div class="input-group email-reg">
                            <input class="fancy-input check" type="text" name="reg-email" id="reg-email" value="<?=repol('email')?>" placeholder=" " data-col="email" >
                            <div class="floating-label">Email</div>
                            <div class="avail-stats email-stats"></div>
                        </div>
                        <div class="input-group name-reg">
                            <input class="fancy-input check" type="text" name="reg-name" id="reg-name" value="<?=repol('name')?>" placeholder=" " data-col="name" >
                            <div class="floating-label">Nama</div>
                            <div class="avail-stats name-stats"></div>
                        </div>
                        <div class="input-group pass-reg">
                            <input class="fancy-input" type="password" name="pass" id="passRegist" placeholder=" ">
                            <div class="floating-label">Password</div>
                        </div>
                        <div class="input-group pass-reg">
                            <input class="fancy-input" type="password" name="passconf" id="passConfRegist" placeholder=" ">
                            <div class="floating-label">Konfirmasi password</div>
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
            <div id="login-stat" class="modal">
                <span></span>
            </div>
        </div>
        <div id="vector-img">
            <img src="<?=base_url()?>assets/img/front-vector.svg" alt="">
        </div>
        <div id="sm-scr-div">
            <p>Selamat datang di <span>Kalpro</span></p>
            <button class="modal-btn" id="form-login-btn" data-icon='&#xf2f6'>Masuk</button>
        </div>
        <div id="loading">
            <svg height="500" width="500">
                <circle class="c1" cx="250" cy="250" r="40" stroke="#a463d8" stroke-width="5" fill="transparent" />
                <circle class="c2" cx="250" cy="250" r="47" stroke="#3fa4d8" stroke-width="5" fill="transparent" />
                <circle class="c3" cx="250" cy="250" r="54" stroke="#b2c224" stroke-width="5" fill="transparent" />
                <circle class="c4" cx="250" cy="250" r="61" stroke="#fecc30" stroke-width="5" fill="transparent" />
                <circle class="c5" cx="250" cy="250" r="68" stroke="#f7631e" stroke-width="5" fill="transparent" />
                <circle class="c6" cx="250" cy="250" r="75" stroke="#dc3838" stroke-width="5" fill="transparent" />
            </svg><br>
            <span>Mohon tunggu..</span>
            <i class="fas fa-times-circle"></i>
            <!--
            merah #dc3838
            jingga #f7631e
            kuning #fecc30
            hijau #b2c224
            biru #3fa4d8
            ungu #a463d8
            -->
        </div>
    </div>
    <script src="<?=base_url('assets/js/TweenMax.js')?>"></script>
    <script src="<?=base_url('assets/js/TimelineMax.js')?>"></script>
    <script>
        // var auth2 = gapi.auth2.getAuthInstance();
        // auth2.signOut().then(function () {
        //     console.log('User signed out.');
        // });
        $('#form-login-btn').click(function(){
            $('#form-container').css('left', '0');
        });
        $('#hide-form').click(function(){
            $('#form-container').css('left', '-730px');
        });

        let width = $(window).width();
        $(window).resize(function() {
            if ($(this).width() !== width) {
                if($(window).width() > 1023){
                    $('#form-container').css('left', '0');
                }else{
                    $('#form-container').css('left', '-730px');
                }
                width = $(this).width();
            }
        });
        let userStat = <?=json_encode($this->session->data)?>;
        if(userStat){
            console.log(userStat);
            $("#id").val(userStat.id);
            $("#register-modal").modal({
                escapeClose: false,
                clickClose: false,
                showClose: false,
                fadeDuration: 100
            });
            if(userStat.google == 1){
                // Google account
                $('.pass-reg').hide();
                $('#reg-email').prop('readonly', true);
                console.log(userStat.id);
            }else{
                // Local account
            }
        }
        function getGoogle(data){
            // AJAX
            let userCheck = $.ajax({
                type  : 'POST',
                url   : '<?=base_url()?>dataprocess/googlelogin',
                // dataType: 'json',
                data : data,
                beforeSend: function () {
                    // ... your initialization code here (so show loader) ...
                    $('#loading').show();
                },
                complete: function () {
                    // ... your finalization code here (hide loader) ...
                    $('#loading').hide();
                },
                error: function (jqXHR, textStatus, errorThrown){
                    alert('Gagal mencoba masuk, silahkan coba lagi');
                    var auth2 = gapi.auth2.getAuthInstance();
                    auth2.signOut().then(function () {
                        console.log('User signed out.');
                    });
                },
                success : function(res){
                    console.log('get google');
                    if(res.status == 1){
                        window.location = "<?=base_url()?>";
                    }else{
                        $("#modal").modal({
                            escapeClose: false,
                            clickClose: false,
                            showClose: false,
                            fadeDuration: 100
                        });
                        $('.pass-reg').hide();
                        $('#reg-email').val(data.email).prop('readonly', true);
                        $('#reg-name').val(data.name);
                        $('#google-acc').val('1');
                        $('#idtoken').val(data.token);
                        $('#photo').val(data.photo);
                    }
                }
            });
        }
        function signOut() {
            var auth2 = gapi.auth2.getAuthInstance();
            auth2.signOut().then(function () {
            console.log('User signed out.');
            });
            $('#regForm').find('input, textarea').val('');
            $('#validation-error').html('');
        }
        function onSignIn(googleUser) {
            let profile = googleUser.getBasicProfile();
            let name =  profile.getName();
            let photo = profile.getImageUrl();
            let email = profile.getEmail(); // This is null if the 'email' scope is not present.
            let id_token = googleUser.getAuthResponse().id_token;
            let data = {
                    name: name,
                    photo: photo,
                    email:email, 
                    token:id_token
                };
            getGoogle(data);
        }

        $('#reg-modal-btn, #regist-trigger').click(function(){
            $("#register-modal").modal({
                escapeClose: false,
                clickClose: false,
                showClose: false,
                fadeDuration: 100
            });
        });

        let mask = true;
        $('#mask-btn').click(function(){
            if(mask){
                $('#front-mask').css('transform', 'translateX(-520px)');
                $('#register-container').css('width', '520px');
                $('#login-container').css('width', '280px');
                $('#logForm').css('transform', 'translateX(550px)');
                $('#regForm').css('transform', 'translateX(0px)');
                $(this).html('Masuk');
            }else{
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
                    $('#loading').show();
                },
                complete: function () {
                    // ... your finalization code here (hide loader) ...
                    $('#loading').hide();
                },
                error: function (jqXHR, textStatus, errorThrown){
                    alert(errorThrown.status);
                },
                success : function(data){
                    if(data.status == 1){
                        window.location = "<?=base_url()?>";
                    }else{
                        $("#login-stat>span").html(data.msg);
                        $("#login-stat").modal({
                            fadeDuration: 100
                        });
                    }
                }
            });
        });

        $('.check').change(function(){
            let col = $(this).attr('data-col');
            let val = $(this).val();
            $.ajax({
                url: "<?=base_url()?>dataprocess/userCheck",
                data: {val:val, col:col},
                type: "POST",
                beforeSend: function () {
                    $('.'+col+'-stats').html("Memeriksa Ketersediaan Username");
                },
                success:function(data){
                    $('.'+col+'-stats').html(data.msg);
                    $('.'+col+'-stats').css('background', data.color);
                    if(val==''){
                        $('.'+col+'-stats').html('');
                    }
                },
                error:function (){}
            });
        });
    </script>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
</body>
</html>