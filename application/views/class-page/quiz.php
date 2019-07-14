<div id="quiz-list-container">
    <?php
        foreach($quiz as $val){
            echo "<div class='quiz-list-box'>
                    <span class='quiz-title'>".$val['title']."</span><br>
                    <span class='quiz-date'>".$val['date']."</span> | <span class='quiz-due-date'>".$val['dueDate']."</span><br>
                    <div class='quiz-option-btn'>
                        <div></div>
                    </div>
                    <span class='quiz-total'>2 Pertanyaan</span> - <span class='quiz-duration'>".$val['duration']."</span>
                </div>";
        }
    ?>
    <a href="<?=base_url('class/'.$link).'/new-quiz'?>">
    <div class="quiz-list-box" id="new-quiz">
        <div><i class="fas fa-plus-circle"></i></div>
    </div>
    </a>
</div>