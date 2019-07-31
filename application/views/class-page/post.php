<div id="post-form">    
    <form action="<?=base_url('dataprocess/post')?>" method="post">
        <input type="hidden" value="class/<?=$link?>" name="prevLink">
        <input type="hidden" value="<?=$class[0]['classID']?>" name="classID">
        <textarea name="content" id="blas" cols="30" rows="10"></textarea>
        <button>Kirim</button>
    </form>
</div>
<?php
    foreach($feed as $val){
        ?>
        <div class="feed-container">
            <b><?=$val['sender']?></b> mengirim ke <b><?=$class[0]['name']?></b><br>
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
                        <textarea name="comment" placeholder="Tulis Komentar..."></textarea><button>Kirim</button>
                    </form>
                </div>
            </div>
        </div>
        <?php
    }
?>
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
                    for(i=0; i<data.length; i++){
                        html += '<div class="user-comment user-comment-'+data[i].id+'">'+
                                    '<b>'+data[i].sender+'</b><br>'+
                                    '<small>'+data[i].date+'</small><br>'+
                                    data[i].comment+
                                    '<div><i class="fas fa-ellipsis-v fa-xs"></i></div>'+
                                '</div><hr>';
                    }
                    $('.comment-box-'+item).html(html);
                }
            });
        }
    })
</script>