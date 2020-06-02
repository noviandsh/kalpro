<div id="container" class="class-page">
    <div id="new-class-div">
        <?php if($this->session->type == 'd'){ ?>
        <span>Tambah kelas baru</span><br><br>
            <form action="<?=base_url('dataprocess/newClass')?>" method="post">
                <input type="text" name="className" placeholder="Nama Kelas" id="className"><br><br>
                <button class="styled-btn" data-icon='&#xf549'>buat kelas</button>
            </form><br>
        <?php }else{ ?>
            <form action="<?=base_url('dataprocess/joinClass')?>" method="post">
                <input type="hidden" name="url" value="<?=$this->uri->segment(1)?>">
                <input type="text" name="classID" placeholder="Masukkan Kode Kelas"><br><br>
                <button class="styled-btn" data-icon='&#xf549'>Gabung Kelas</button>
            </form>
        <?php } ?>
    </div>
    <div id="class-container">
        <?php 
            function clean($string) {
                $string = strtolower($string);
                $string = trim($string, " ");
                $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
                $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

                return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
            }
            if(isset($class)){
                foreach($class as $val){?>
                    <div class="class-div">
                        <div class="styled-card">
                            <div class="class-info">
                                <a href="<?=base_url('class/'.clean($val['name']).'-'.$val['classID'].'/post')?>">
                                        <?=$val['name']?>
                                </a>
                                <br>
                                <?php
                                    echo '<small>'.$this->crud->GetCountWhere('class_member', array('classID'=>$val['classID'])).' anggota</small><br><br>';
                                    echo $val['classID'];
                                ?>
                            </div>
                        </div>
                        <?php if($val['teacher'] == $this->session->name): ?>
                            <div class="trash" data-id="<?=$val['classID']?>" data-name="<?=$val['name']?>"><i class="fas fa-trash-alt fa-s"></i></div>
                        <?php endif;?>
                    </div>
                <?php
                }
            }
        ?>
    </div>
</div>
<div id="modal" class="modal">
    <p>Apakah anda ingin menghapus kelas <b></b>?</p><br><br>
    <button delete-id="" id="delete-btn" class="styled-btn" data-icon='&#xf2ed' style="margin-right: 10px;">Hapus</button>
    <a style="color: #6b6a6a;" href="#" rel="modal:close">Batal</a>
</div>
<script>
    $('.trash').click(function() {
        $("#modal").modal({
            fadeDuration: 100
        });
        $("#modal b").html($(this).attr('data-name'));
        $('#delete-btn').attr('delete-id', $(this).attr('data-id'));
    });
    $('#delete-btn').click(function(){
        let id = $(this).attr('delete-id');
        $.ajax({
            type  : 'POST',
            url   : '<?=base_url()?>dataprocess/deleteclass',
            // dataType: 'json',
            data : {id:id},
            error: function (jqXHR, textStatus, errorThrown){
                alert(errorThrown.status);
            },
            success : function(data){
                if(data == 1){
                    window.location = "<?=base_url('class')?>";
                }else{
                    alert('Gagal menghapus');
                }
            }
        });
    });
</script>