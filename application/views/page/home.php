<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Beranda | Kalpro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="<?=base_url('assets/css/main-style.css')?>">
    <link href="<?=base_url('assets/css/all.min.css');?>" rel="stylesheet"/>
    <link href="<?=base_url('assets/css/jquery-ui.css');?>" rel="stylesheet"/>
    <link href="<?=base_url('assets/css/jquery-ui.theme.css');?>" rel="stylesheet"/>
    <link href="<?=base_url('assets/css/jquery-ui-timepicker-addon.css');?>" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" rel="stylesheet"/>
    <link href="<?=base_url('assets/img/circ-favicon-v2.png');?>" rel="shortcut icon" type="text/css">

    <script src="<?=base_url('assets/js/jquery.min.js')?>"></script>
    <script src="<?=base_url('assets/js/jquery-ui.js')?>"></script>
    <script src="<?=base_url('assets/js/jquery-ui-timepicker-addon.js')?>"></script>
    <script src="<?=base_url('assets/js/jquery-collision.js')?>"></script>
    <script src="<?=base_url('assets/js/jquery.connections.js')?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>

</head>
<body>
    <div id="navbar">
        <div id="logo"></div>
            <div id="menubar-atas">
                <div id="search-box">
                    <input type="" id="search" name="search" placeholder="Search">
                    <i id="search-btn" class="fa fa-search" aria-hidden="true"></i>
                </div>
            </div>
            <div id="menubar-bawah">
                <div id="menu-div">
                    <div class="menu"><a href="<?=base_url('dataprocess/logout')?>"><p><i class="fas fa-sign-out-alt fa-sm"></i> Logout</p></a></div>
                    <!-- <div class="menu message-menu"><a href="<?=base_url('message');?>"><p><i class="fas fa-comments fa-sm"></i> Pesan</p></a></div>
                    <div class="menu archive-menu"><a href="<?=base_url('archive');?>"><p><i class="fas fa-file-archive fa-sm"></i> Arsip</p></a></div> -->
                    <div class="menu class-menu"><a href="<?=base_url('class');?>"><p><i class="fas fa-school fa-sm"></i> Kelas</p></a></div>
                    <div class="menu home-menu"><a href="<?=base_url();?>"><p><i class="fas fa-home fa-sm"></i> Beranda</p></a></div>
                </div>
                <i id="menu-bar" class="fa fa-bars fa-2x" aria-hidden="true"></i>
                <div id="menu-dropdown-par">
                    <div id="logo2"></div>
                    <div id="menu-dropdown"> 
                    <div class="menu home-menu"><a href="<?=base_url();?>"><p>Beranda</p></a></div>
                    <div class="menu class-menu"><a href="<?=base_url('class');?>"><p>Kelas</p></a></div>
                    <!-- <div class="menu archive-menu"><a href="<?=base_url('archive');?>"><p>Arsip</p></a></div>
                    <div class="menu message-menu"><a href="<?=base_url('message');?>"><p>Pesan</p></a></div> -->
                    <div class="menu"><a href="<?=base_url('dataprocess/logout');?>"><p>Logout</p></a></div>
                </div>
            </div>
        </div>
    </div>
    <?=$page?>
    <script>
        let menu = '<?=$this->uri->segment(1)?>';
        if(menu==''){
            menu = 'home';
        }
        $('.'+menu+'-menu').addClass('active');
    </script>
</body>
</html>