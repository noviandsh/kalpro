<div id="container">
    <div id="profile">
        <div class="photo">
            <img src="<?=$acc['photo'];?>" alt="">
        </div><br>
        <b><?=$acc['name'];?></b><br>
        <?php if($this->session->type == 'm'){ ?>
            <br><hr><br>
            <form action="<?=base_url('dataprocess/joinClass')?>" method="post">
                <input type="text" name="classID" placeholder="Masukkan Kode Kelas"><br><br>
                <button class="styled-btn" data-icon='&#xf549'>Gabung Kelas</button>
            </form>
        <?php } 
        if(!empty($this->session->joinStat)){
            echo $this->session->joinStat;
        }
        ?>
    </div>
    <div id="content">
        <div id="post-form">
            <form action="<?=base_url('dataprocess/post')?>" method="post">
                <input type="hidden" value="home" name="prevLink">
                <textarea placeholder="Ketik di sini..." name="content" id="blas" cols="30" rows="10"></textarea>
                <select name="classID">
                    <?php
                        $className = array();
                        if(!empty($class)){
                            foreach($class as $val){
                                echo "<option value=".$val['classID'].">".$val['name']."</option>";
                                $className[$val['classID']] = $val['name'];
                            }
                        }else{
                            echo "<option disabled selected>- Kosong -</option>";
                        }
                    ?>
                </select>
                <button class="styled-btn" onClick="test()" data-icon='&#xf1d8'>Kirim</button>
            </form>
        </div>
            <?php
            
                if(!empty($class)){
                    if(!empty($feed)){
                        foreach($feed as $val){
                            ?>
                            <div class="feed-container">
                                <div class="feed-photo">
                                    <div>
                                        <?php
                                            foreach($allAcc as $a){
                                                if($val['sender'] == $a['name']){
                                                    echo "<img src='".$a['photo']."'>";
                                                }
                                            }
                                        ?>
                                    </div>
                                    <div>
                                        <b><?=$val['sender']?></b> mengirim ke <b><?=$className[$val['classID']]?></b><br>
                                        <small><?=$val['date']?></small><br>
                                    </div>
                                </div>
                                <div class="feed-content">
                                    <?=$val['content']?>
                                </div>
                                <div class="comment-container">
                                    <div class="comment-box-<?=$val['id']?>">
                                        <div class="user-comment-1">

                                        </div>
                                    </div>
                                    <div class="comment-form">
                                        <form action="<?=base_url('dataprocess/comment')?>" method="post">
                                            <input type="hidden" name="feedID" value="<?=$val['id']?>">
                                            <input type="hidden" name="prevLink" value="home">
                                            <textarea name="comment" placeholder="Tulis Komentar..."></textarea><button class="styled-btn" data-icon="&#xf1d8">Kirim</button>
                                        </form>
                                    </div>
                                </div>
                                <?php if($val['sender'] == $this->session->name || $this->session->type == 'd'): ?>
                                    <div class="dots" data-delete="kiriman" data-id="<?=$val['id']?>"><i class="fas fa-trash-alt fa-xs"></i></div>
                                <?php endif; ?>
                            </div>
                            <?php
                        }
                    }
                }
            ?>
    </div>
    <div id="sidebar">
        <?php
            if(isset($quiz)){
                foreach($quiz as $val){
                    echo "<div class='quiz-list-box'>
                            <span class='quiz-title'>".$val['title']."</span><br>
                            <span class='quiz-date'>".$val['date']."</span> | <span class='quiz-due-date'>".$val['dueDate']."</span><br>
                            <div class='quiz-option-btn'>
                                <div></div>
                            </div>
                            <span class='quiz-total'>1 Pertanyaan</span> - <span class='quiz-duration'>".$val['duration']." Menit</span><br/>
                            <a href='".base_url('start-quiz/').$val['id']."' class='styled-btn' data-icon='&#xf0ae'>Ambil</a>
                        </div>";
                }
            }
        ?>
    </div>
</div>

<div id="modal" class="modal">
    <p>Apakah anda ingin menghapus <span></span> ini?</p><br><br>
    <button delete-type="" delete-id="" id="delete-btn" class="styled-btn" data-icon='&#xf2ed' style="margin-right: 10px;">Hapus</button>
    <a style="color: #6b6a6a;" href="#" rel="modal:close">Batal</a>
</div>
<script>
    let feed = [<?php echo '"'.implode('","', $feedID).'"' ?>];
    feed.forEach(showComment);
    function showComment(item, index) {
        $.ajax({
            type  : 'POST',
            url   : '<?php echo base_url()?>dataprocess/getcomment/'+item,
            async : false,
            contentType: 'application/json',
            dataType: 'json',
            success : function(data){
                let html = '';
                let i;
                let arrId = [];
                let dots;
                let photo;
                for(i=0; i<data.length; i++){
                    if(data[i].sender == '<?=$this->session->name?>' || '<?=$this->session->type?>' == 'd'){
                        dots = '<div class="dots" data-delete="komentar" data-id="'+data[i].id+'"><i class="fas fa-trash-alt fa-xs"></i></div>';
                    }else{
                        dots = '';
                    }
                    <?php foreach ($allAcc as $val): ?>
                        if(data[i].sender == '<?=$val['name']?>'){
                            photo = '<?=$val['photo']?>';
                        }
                    <?php endforeach; ?>
                    html += '<div class="user-comment user-comment-'+data[i].id+'">'+
                                '<div class="feed-photo">'+
                                    '<div>'+
                                        '<img src="'+photo+'" alt="">'+
                                    '</div>'+
                                    '<div>'+
                                        '<b>'+data[i].sender+'</b><br>'+
                                        '<small>'+data[i].date+'</small><br>'+
                                    '</div>'+
                                '</div>'+
                                data[i].comment+
                                dots+
                            '</div><hr>';
                }
                $('.comment-box-'+item).html(html);
            }

        });
    }
    
    function test() {
        console.log($('#blas').val());
    }
    $('.dots').click(function() {
        $("#modal").modal({
            fadeDuration: 100
        });
        $("#modal span").html($(this).attr('data-delete'));
        $("#delete-btn").attr('delete-type', $(this).attr('data-delete'));
        $('#delete-btn').attr('delete-id', $(this).attr('data-id'));
    });
    $('#delete-btn').click(function(){
        let id = $(this).attr('delete-id');
        let table = $(this).attr('delete-type');
        $.ajax({
            type  : 'POST',
            url   : '<?=base_url()?>dataprocess/deletepost',
            // dataType: 'json',
            data : {table:table, id:id},
            error: function (jqXHR, textStatus, errorThrown){
                alert(errorThrown.status);
            },
            success : function(data){
                if(data == 1){
                    window.location = "<?=base_url()?>";
                }else{
                    alert('Gagal menghapus');
                }
            }
        });
    });
</script>