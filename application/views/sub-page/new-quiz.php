<div id="new-quiz-container">
    <form id="quiz-detail">
        <input type="hidden" id="quiz-id" placeholder="Nama Kuis" value="<?=$draft['id']?>">
        <input type="hidden" id="quiz-teacher" placeholder="Nama Kuis" value="<?=$draft['teacher']?>">
        <input type="hidden" id="quiz-classID" placeholder="Nama Kuis" value="<?=$draft['classID']?>">
        <input type="text" id="quiz-title" placeholder="Nama Kuis" value="<?=$draft['title']?>">
        <input readonly="readonly" type="text" id="startDate" placeholder="Waktu Mulai">
        <input readonly="readonly" type="text" id="dueDate" placeholder="Waktu Selesai">
        <input type="text" id="quiz-duration" placeholder="Durasi"><br><br>
    </form>
    <button onClick="submitQuiz()">Simpan</button><br><br>
    <div id="new-quiz-number">
        <ul>
            <li class="selected"><a href="#">1</a></li>
            <li id="add-quiz-id"><a id="add-quiz" href="">+</a></li>
        </ul>
        <div class="new-quiz-form">
            <div id="question-1">
                <div id="flowchart-container">
                    <div id="diagram-trash">
                        <div id="trash-top"></div>
                        <div id="trash-btm"></div>
                    </div>
                    <div class="menu-btn">
                        <button class="diagram-btn"><i class="fas fa-project-diagram"></i></button>
                        <button class="answer-btn"><i class="fas fa-list-ol"></i></button>
                    </div>
                    <div id="diagram-container">
                        <button onClick="coba()">coba</button>
                        <button onClick="makeTarget()">target</button>
                        <button id="addLine">Garis</button>
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
                    <div id="target" class="target">
                        <div class="empty"></div>
                        <div class="empty"></div>
                        <div class="first-diagram">
                            <img src="<?=base_url('assets/img/flowchart-shapes/rounded-rectangle.svg')?>" alt="" style="z-index: 1; position: relative;">
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
                    <div class="answer-container">
                        <ul>
                            <li id="answer-list-1"><div id="answer-1" class="answer-number">1</div><textarea name="" id="" cols="30" rows="10"></textarea></li>
                            <li id="answer-list-2"><div id="answer-2" class="answer-number">2</div><textarea name="" id="" cols="30" rows="10"></textarea></li>
                            <li id="answer-list-3"><div id="answer-3" class="answer-number">3</div><textarea name="" id="" cols="30" rows="10"></textarea></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
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
    let baseUrl = '<?=base_url()?>';
</script>
<script src="<?=base_url('assets/js/quiz.js')?>"></script>