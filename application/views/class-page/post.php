<div id="post-form">    
    <form action="<?=base_url('dataproccess/post')?>" method="post">
        <input type="hidden" value="class/<?=$this->uri->segment(2)?>" name="prevLink">
        <input type="hidden" value="<?=substr($this->uri->segment(2), -6)?>" name="classID">
        <textarea name="content" id="blas" cols="30" rows="10"></textarea>
        <button>Kirim</button>
    </form>
</div>
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