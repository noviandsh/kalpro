<div id="quiz-list-container">
    <?php
        foreach($quiz as $val){
            echo "<div class='quiz-list-div'>
                    <div class='styled-card'>
                        <span class='quiz-title'>".$val['title']."</span><br>
                        <span class='quiz-date'>".$val['date']."</span> | <span class='quiz-due-date'>".$val['dueDate']."</span><br>
                        <div class='quiz-option-btn'>
                            <div></div>
                        </div>
                        <span class='quiz-total'>1 Pertanyaan</span> - <span class='quiz-duration'>".$val['duration']." Menit</span>
                    </div>";
            if($val['teacher'] == $this->session->name){
                echo "<div class='trash' data-id='".$val['id']."' data-title='".$val['title']."'><i class='fas fa-trash-alt fa-s'></i></div>";
            }
            echo "</div>";
        }
    ?>
    <a href="<?=base_url('class/'.$link).'/new-quiz'?>">
    <div class="quiz-list-box" id="new-quiz">
        <div><i class="fas fa-plus-circle"></i></div>
    </div>
    </a>
</div>
<div id="modal" class="modal">
    <p>Apakah anda ingin menghapus kuis <b></b>?</p><br><br>
    <button delete-id="" id="delete-btn" class="styled-btn" data-icon='&#xf2ed' style="margin-right: 10px;">Hapus</button>
    <a style="color: #6b6a6a;" href="#" rel="modal:close">Batal</a>
</div>
<script>
    $('.trash').click(function() {
        $("#modal").modal({
            fadeDuration: 100
        });
        $("#modal b").html($(this).attr('data-title'));
        $('#delete-btn').attr('delete-id', $(this).attr('data-id'));
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