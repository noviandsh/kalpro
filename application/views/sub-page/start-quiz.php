<div id="start-quiz-container">
    <div id="start-quiz-detail">
        <div id="quiz-teacher">
            Dosen : <?=$quizDetail[0]['teacher']?>
        </div>
        
        <div id="diagram-trash">
            <div id="trash-top"></div>
            <div id="trash-btm"></div>
        </div>
        <div class="menu-btn">
            <button class="diagram-btn"><i class="fas fa-shapes"></i> Diagram</button>
            <button class="answer-btn"><i class="fas fa-list-ol"></i> Jawaban</button>
        </div>
        <div id="diagram-container">
            <div class="diagram-wrap">
                <img class="diagram-shape" diagram="start-end" src="<?=base_url('assets/img/flowchart-shapes/rounded-rectangle.svg')?>" alt="">
            </div>
            <div class="diagram-wrap">
                <img class="diagram-shape" diagram="process" src="<?=base_url('assets/img/flowchart-shapes/rectangle.svg')?>" alt="">
            </div>
            <div class="diagram-wrap">
                <img class="diagram-shape" diagram="document" src="<?=base_url('assets/img/flowchart-shapes/wavy-rectangle.svg')?>" alt="">
            </div>
            <div class="diagram-wrap">
                <img class="diagram-shape" diagram="decision" src="<?=base_url('assets/img/flowchart-shapes/diamond.svg')?>" alt="">
            </div>
            <div class="diagram-wrap">
                <img class="diagram-shape" diagram="input-output" src="<?=base_url('assets/img/flowchart-shapes/parallelogram.svg')?>" alt="">
            </div>
        </div>
        <div class="answer-container">
            <?php
                $n = 0;
                foreach($answer as $val){
                    $n++;
                    echo "<div id='answer-".$n."' class='answer-number'>
                            ".$n."
                            <p>
                            ".$val."
                            </p>
                        </div>";
                }
            ?>
            
        </div>

    </div>
    <div id="start-quiz-content">
        <div id="quiz-title"><?=$quizDetail[0]['title']?> | <span id="timer"></span> <button class="styled-btn" onClick="submitAnswer()">Selesai</button></div>
        <?php
            // print_r($quizDetail);
            // echo '<hr>';
            // print_r($question['flowchart']);
        ?>
        <hr><br>
        <div id="quiz-question"><?=$soal[0]['question']?></div>
        <br>
        <div id="flowchart-container">
            <div id="target" class="target">
                <div class="empty"></div>
                <div class="empty"></div>
                <div class="first-diagram">
                    <img src="<?=base_url('assets/img/flowchart-shapes/rounded-rectangle.svg')?>" alt="" style="z-index: 1; position: relative;">
                    <span>Mulai</span>
                </div>
                <div class="empty"></div>
                <div class="empty"></div>
                <div class="empty"></div>
                <div class="empty"></div>
                <div class="first-arrow">
                    <img src="<?=base_url('assets/img/arrow3.svg')?>" alt="" style="transform: rotate(90deg);">
                </div>
                <div class="empty"></div>
                <div class="empty"></div>
            </div>
            <div id="add-line"><button class="styled-btn" onClick="makeTarget()">+</button></div>
        </div>
    </div>
    <div id="start-quiz-number">
        <ul>
            <li><a class="selected" href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
        </ul>
    </div>
</div>

<div id="arrow-container">
    <div>
        <div class="arrow-img">
            <img id="arrow1" src="<?=base_url('assets/img/arrow1.svg')?>" alt="">
        </div>
        <div class="arrow-img">
            <img id="arrow2" src="<?=base_url('assets/img/arrow1.svg')?>" alt="">
        </div>
        <div class="arrow-img">
            <img id="arrow3" src="<?=base_url('assets/img/arrow1.svg')?>" alt="">
        </div>
        <div class="arrow-img">
            <img id="arrow4" src="<?=base_url('assets/img/arrow1.svg')?>" alt="">
        </div>
        <div class="arrow-img">
            <img id="arrow5" src="<?=base_url('assets/img/arrow2.svg')?>" alt="">
        </div>
        <div class="arrow-img">
            <img id="arrow6" src="<?=base_url('assets/img/arrow2.svg')?>" alt="">
        </div>
        <div class="arrow-img">
            <img id="arrow7" src="<?=base_url('assets/img/arrow2.svg')?>" alt="">
        </div>
        <div class="arrow-img">
            <img id="arrow8" src="<?=base_url('assets/img/arrow2.svg')?>" alt="">
        </div>
        <div class="arrow-img">
            <img id="arrow9" src="<?=base_url('assets/img/arrow3.svg')?>" alt="">
        </div>
        <div class="arrow-img">
            <img id="arrow10" src="<?=base_url('assets/img/arrow3.svg')?>" alt="">
        </div>
        <div class="arrow-img">
            <img id="arrow11" src="<?=base_url('assets/img/arrow3.svg')?>" alt="">
        </div>
        <div class="arrow-img">
            <img id="arrow12" src="<?=base_url('assets/img/arrow3.svg')?>" alt="">
        </div>
    </div>
</div>

<script>
    let baseUrl = '<?=base_url()?>',
        quizID = '<?=$quizDetail[0]['id']?>';
    <?="let answer = ".json_encode($answer).";"?>
    let timeLimit = new Date('<?=date("r", $_SESSION["timer"])?>');
</script>
<script src="<?=base_url('assets/js/start-quiz.js')?>"></script>
<script>

</script>