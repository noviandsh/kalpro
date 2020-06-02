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
    <button class="styled-btn" onClick="submitQuiz()" class='styled-btn' data-icon='&#xf0c7'>Simpan</button><br><br>
    <div id="new-quiz-number">
        <ul style="display:none;">
            <li class="selected"><a href="#">1</a></li>
            <li id="add-quiz-id"><a id="add-quiz" href="">+</a></li>
        </ul>
        <div class="new-quiz-form">
            <div id="question-1">
                <div id="flowchart-container">
                    <textarea id="question-form" placeholder="Pertanyaan" cols="100" rows="10"></textarea>
                    <div id="diagram-trash" style="top:240px;">
                        <div id="trash-top"></div>
                        <div id="trash-btm"></div>
                    </div>
                    <div id="diagram-container" style="top:320px;">
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
                    <div id="add-line"><button class="styled-btn" data-icon='&#xf067' onClick="makeTarget()">Tambah baris</button></div>
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