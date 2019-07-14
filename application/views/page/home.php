<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Beranda | Kalpro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="<?=base_url('assets/css/main-style.css')?>">
    <link href="<?php echo base_url('assets/css/all.min.css');?>" rel="stylesheet"/>
    <link href="<?php echo base_url('assets/css/jquery-ui.css');?>" rel="stylesheet"/>
    <link href="<?php echo base_url('assets/css/jquery-ui.theme.css');?>" rel="stylesheet"/>
    <link href="<?php echo base_url('assets/css/jquery-ui-timepicker-addon.css');?>" rel="stylesheet"/>
    <link href="<?php echo base_url('assets/css/all.min.css');?>" rel="stylesheet"/>

    <script src="<?=base_url('assets/js/jquery.min.js')?>"></script>
    <script src="<?=base_url('assets/js/jquery-ui.js')?>"></script>
    <script src="<?=base_url('assets/js/jquery-ui-timepicker-addon.js')?>"></script>
</head>
<body>
    <div id="navbar">
        <div id="logo"></div>
            <div id="menubar-atas">
                <a href="<?=base_url('dataprocess/logout')?>" style="right: 220px;position: absolute;color: white;">LOGOUT</a>
                <div id="search-box">
                    <input type="" id="search" name="search" placeholder="Search">
                    <i id="search-btn" class="fa fa-search" aria-hidden="true"></i>
                </div>
            </div>
            <div id="menubar-bawah">
                    <div class="menu"><a href="<?php echo base_url('message');?>"><p><i class="fas fa-comments fa-sm"></i> Pesan</p></a></div>
                    <div class="menu"><a href="<?php echo base_url('archive');?>"><p><i class="fas fa-file-archive fa-sm"></i> Arsip</p></a></div>
                    <div class="menu"><a href="<?php echo base_url('class');?>"><p><i class="fas fa-school fa-sm"></i> Kelas</p></a></div>
                    <div class="active menu"><a href="<?php echo base_url();?>"><p><i class="fas fa-home fa-sm"></i> Beranda</p></a></div>
                </div>
                <i id="menu-bar" class="fa fa-bars fa-2x" aria-hidden="true"></i>
                <div id="menu-dropdown-par">
                    <div id="logo2"></div>
                    <div id="menu-dropdown">
                    <div class="active menu"><a href="<?php echo base_url();?>"><p>Home</p></a></div>
                    <div class="menu"><a href="<?php echo base_url('article');?>"><p>Article</p></a></div>
                    <div class="menu"><a href="<?php echo base_url('tutorial');?>"><p>Tutorial</p></a></div>
                    <div class="menu"><a href="<?php echo base_url('tipsntrick');?>"><p>Tips & Trick</p></a></div>
                    <div class="menu"><a href="<?php echo base_url('about');?>"><p>About</p></a></div>
                </div>
            </div>
        </div>
    </div>
    <?=$page?>
</body>
</html>