<div id="quiz-list-container">
    <?php
        foreach($quiz as $val): ?>
            <div class="quiz-list-div">
                <div class="styled-card">
                    <span class="quiz-title"><?=$val['title']?></span><br>
                    <span class="quiz-date"><?=$val['date']?></span> | <span class="quiz-due-date"><?=$val['dueDate']?></span><br>
                    <div class="quiz-option-btn">
                        <div></div>
                    </div>
                    <span class="quiz-duration"><?=$val['duration']?> Menit</span><br>
                </div>
                <div class="corner-menu view" data-id="<?=$val["id"]?>" data-title="<?=$val["title"]?>">
                    <span><i class="fas fa-eye fa-s"></i> Lihat</span>
                </div>
                <div class="corner-menu edit" data-id="<?=$val["id"]?>" data-title="<?=$val["title"]?>">
                    <span><i class="fas fa-pen fa-s"></i> Ubah</span>
                </div>
                <div class="corner-menu delete" data-id="<?=$val["id"]?>" data-title="<?=$val["title"]?>">
                    <span><i class="fas fa-trash-alt fa-s"></i> Hapus</span>
                </div>
                <a href="#" data-title="<?=$val['title']?>" data-id="<?=$val['id']?>" class="styled-btn show-result" data-icon="&#xf0ae">Lihat Hasil</a>
            </div>
    <?php endforeach;
    ?>
    <a href="<?=base_url('class/'.$link).'/new-quiz'?>">
    <div class="quiz-list-box" id="new-quiz">
        <div><i class="fas fa-plus-circle"></i></div>
    </div>
    </a>
</div>
<div id="modal-view" class="modal">

</div>
<div id="modal" class="modal">
    <p>Apakah anda ingin menghapus kuis <b></b>?</p><br><br>
    <button delete-id="" id="delete-btn" class="styled-btn" data-icon='&#xf2ed' style="margin-right: 10px;">Hapus</button>
    <a style="color: #6b6a6a;" href="#" rel="modal:close">Batal</a>
</div>
<div id="modal-result" class="modal">
    <h3>Hasil kuis - <span></span></h3>
    <div></div>
</div>
<script>
    $('.show-result').click(function(){
        // alert('asdas');
        let id = $(this).attr('data-id');
        let title = $(this).attr('data-title');
        console.log(title);
        $("#modal-result span").html(title);
        $("#modal-result").modal({
            fadeDuration: 100
        });
        $.ajax({
            type  : 'POST',
            url   : '<?= base_url()?>dataprocess/quizResultList/'+id,
            error: function (jqXHR, textStatus, errorThrown){
                alert(jqXHR.status);
            },
            success : function(data){
                $('#modal-result>div').html(data);
            }
        });
    });
    $('.corner-menu.delete').click(function() {
        $("#modal").modal({
            fadeDuration: 100
        });
        $("#modal b").html($(this).attr('data-title'));
        $('#delete-btn').attr('delete-id', $(this).attr('data-id'));
    });
    $('.corner-menu.view').click(function() {
        $("#modal-view").modal({
            fadeDuration: 100
        });
        let id = $(this).attr('data-id');
        $.ajax({
            type  : 'POST',
            url   : '<?php echo base_url()?>dataprocess/viewquiz/'+id,
            error: function (jqXHR, textStatus, errorThrown){
                alert(jqXHR.status);
            },
            success : function(data){
                quiz = JSON.parse(data);
                $('#modal-view').html(
                    `<div id="view-question">${quiz.question}</div>
                    ${decodeURIComponent(quiz.svg)}`);
            }
        });
    });
    $('.corner-menu.edit').click(function() {
        window.location = "<?=base_url('class/edit-quiz?id=')?>" + $(this).attr('data-id');
    });
    $('#delete-btn').click(function(){
        let id = $(this).attr('delete-id');
        $.ajax({
            type  : 'POST',
            url   : '<?=base_url()?>dataprocess/deletequiz',
            // dataType: 'json',
            data : {id:id},
            error: function (jqXHR, textStatus, errorThrown){
                alert(errorThrown.status);
            },
            success : function(data){
                if(data == 1){
                    location.reload();
                }else{
                    alert('Gagal menghapus');
                }
            }
        });
    });
</script>