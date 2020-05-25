<div id="post-form">    
    <form action="<?=base_url('dataprocess/post')?>" method="post">
        <input type="hidden" value="class/<?=$link?>" name="prevLink">
        <input type="hidden" value="<?=$class[0]['classID']?>" name="classID">
        <textarea placeholder="Ketik di sini..." name="content" id="blas" cols="30" rows="10"></textarea>
        <button class="styled-btn" data-icon="&#xf1d8">Kirim</button>
    </form>
</div>
<?php
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
                    <b><?=$val['sender']?></b> mengirim ke <b><?=$class[0]['name']?></b><br>
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
?>
<div id="modal" class="modal">
    <p>Apakah anda ingin menghapus <span></span> ini?</p><br><br>
    <button delete-type="" delete-id="" id="delete-btn" class="styled-btn" data-icon='&#xf2ed' style="margin-right: 10px;">Hapus</button>
    <a style="color: #6b6a6a;" href="#" rel="modal:close">Batal</a>
</div>
<script language="JavaScript" type="text/javascript">
    $(document).ready(function() {
        const feed = [<?php echo '"'.implode('","', $feedID).'"' ?>];
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
    });
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