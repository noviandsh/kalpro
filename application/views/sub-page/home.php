<div id="profile">
    <div class="photo">
        <img src="<?=base_url('assets/img/poto.jpg')?>" alt="">
    </div>
    login as <b><?=$this->session->username;?></b><br>
    <form action="<?=base_url('dataproccess/joinClass')?>" method="post">
        <input type="text" name="classID" placeholder="Masukkan Kode Kelas">
        <button>Gabung Kelas</button>
    </form>
</div>
<div id="content">
    <div id="post-form">
        <form action="<?=base_url('dataproccess/post')?>" method="post">
            <select name="classID">
                <?php
                    foreach($class as $val){
                        echo "<option value=".$val['classID'].">".$val['name']."</option>";
                    }
                ?>
            </select>
            <input type="hidden" value="home" name="prevLink">
            <textarea name="content" id="blas" cols="30" rows="10"></textarea>
            <button onClick="test()">Kirim</button>
        </form>
    </div>
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores aspernatur facere dolore aperiam, voluptatem ullam consequuntur assumenda at? Sapiente expedita vero cumque quaerat corporis explicabo laudantium deserunt! Sit, non rem.
        <?php
            foreach($feed as $val){
                ?>
                <div class="feed-container">
                    <b><?=$val['sender']?></b> => <?=$val['classID']?><br>
                    <small><?=$val['date']?></small><br>
                    <?=$val['content']?>
                    <div class="comment-container">
                        <div class="comment-box-<?=$val['id']?>">
                            <div class="user-comment-1">

                            </div>
                        </div>
                        <div class="comment-form">
                            <form action="<?=base_url('dataproccess/comment')?>" method="post">
                                <input type="hidden" name="feedID" value="<?=$val['id']?>">
                                <input type="hidden" name="prevLink" value="home">
                                <textarea name="comment" placeholder="Tulis Komentar..."></textarea><button>Kirim</button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
            }
        ?>
</div>
<div id="sidebar">

</div>
<script>
    var feed = [<?php echo '"'.implode('","', $feedID).'"' ?>];
    feed.forEach(showComment);
    function showComment(item, index) {
        $.ajax({
            type  : 'POST',
            url   : '<?php echo base_url()?>dataproccess/getcomment/'+item,
            async : false,
            contentType: 'application/json',
            dataType: 'json',
            success : function(data){
                console.log(data.length);
                var html = '';
                var i;
                var arrId = [];
                for(i=0; i<data.length; i++){
                    html += '<div class="user-comment user-comment-'+data[i].id+'">'+
                                '<b>'+data[i].sender+'</b><br>'+
                                '<small>'+data[i].date+'</small><br>'+
                                data[i].comment+
                                '<div><i class="fas fa-ellipsis-v fa-xs"></i></div>'+
                            '</div>';
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