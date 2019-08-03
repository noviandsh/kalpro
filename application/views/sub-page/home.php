<div id="container">
    <div id="profile">
        <div class="photo">
            <img src="<?=base_url('assets/img/images.png')?>" alt="">
        </div>
        login as <b><?=$this->session->username;?></b><br>
        <?php if($this->session->type == 'm'){ ?>
        <form action="<?=base_url('dataprocess/joinClass')?>" method="post">
            <input type="text" name="classID" placeholder="Masukkan Kode Kelas">
            <button class="styled-btn">Gabung Kelas</button>
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
                <textarea name="content" id="blas" cols="30" rows="10"></textarea>
                <select name="classID">
                    <?php
                        $className = array();
                        foreach($class as $val){
                            echo "<option value=".$val['classID'].">".$val['name']."</option>";
                            $className[$val['classID']] = $val['name'];
                        }
                    ?>
                </select>
                <button class="styled-btn" onClick="test()">Kirim</button>
            </form>
        </div>
            <?php
                foreach($feed as $val){
                    ?>
                    <div class="feed-container">
                        <b><?=$val['sender']?></b> mengirim ke <b><?=$className[$val['classID']]?></b><br>
                        <small><?=$val['date']?></small><br>
                        <?=$val['content']?>
                        <div class="comment-container">
                            <div class="comment-box-<?=$val['id']?>">
                                <div class="user-comment-1">

                                </div>
                            </div>
                            <div class="comment-form">
                                <form action="<?=base_url('dataprocess/comment')?>" method="post">
                                    <input type="hidden" name="feedID" value="<?=$val['id']?>">
                                    <input type="hidden" name="prevLink" value="home">
                                    <textarea name="comment" placeholder="Tulis Komentar..."></textarea><button class="styled-btn">Kirim</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php
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
                            <a href='".base_url('start-quiz/').$val['id']."'>Ambil</a>
                        </div>";
                }
            }
        ?>
    </div>
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
                console.log(data.length);
                let html = '';
                let i;
                let arrId = [];
                for(i=0; i<data.length; i++){
                    html += '<div class="user-comment user-comment-'+data[i].id+'">'+
                                '<b>'+data[i].sender+'</b><br>'+
                                '<small>'+data[i].date+'</small><br>'+
                                data[i].comment+
                                '<div><i class="fas fa-ellipsis-v fa-xs"></i></div>'+
                            '</div><hr>';
                            // '<td><input id="tipe-'+data[i].id+'" name="tipe-'+data[i].id+'" value="'+data[i].tipe+'"></td>'+
                            // '<td><input id="harga-'+data[i].id+'" name="harga-'+data[i].id+'" value="'+data[i].harga+'"></td>'+
                            // '<td><button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal2" data-nama="'+data[i].tipe+'" data-id="'+data[i].id+'" data-delete="one">'+
                            //     '<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>'+
                            // '</button></td>'+
                            // '</tr>';
                            // '<tr ><td><input name="id-'+data[i].id+'" value="'+data[i].id+'"></td></tr>';
                    // arrId.push(data[i].id);
                }
                // html += '<tr><td>Data Baru<input name="id" hidden value="'+arrId+'"></td></tr>';
                $('.comment-box-'+item).html(html);
                // $('#hapus-semua').attr('data-id', id);
            }

        });
    }
    
    function test() {
        console.log($('#blas').val());
    }
</script>