<div id="new-quiz-container">
    <input type="text" placeholder="Nama Kuis">
    <input readonly="readonly" type="text" id="startDate" placeholder="Waktu Mulai">
    <input readonly="readonly" type="text" id="dueDate" placeholder="Waktu Selesai">
    <input type="text" placeholder="Durasi"><br><br>
    <div id="new-quiz-number">
        <ul>
            <li class="selected"><a href="#">1</a></li>
            <li id="add-quiz-id"><a id="add-quiz" href="">+</a></li>
        </ul>
    <div class="new-quiz-form">
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
                <div id="start-end-wrap">
                    <img id="s1" diagram="start-end" class="diagram-shape" src="<?=base_url('assets/img/flowchart-shapes/rounded-rectangle.svg')?>" alt="">
                </div>
                <div id="process-wrap">
                    <img id="s2" diagram="process" class="diagram-shape" src="<?=base_url('assets/img/flowchart-shapes/rectangle.svg')?>" alt="">
                </div>
                <div id="document-wrap">
                    <img diagram="document" class="diagram-shape" src="<?=base_url('assets/img/flowchart-shapes/wavy-rectangle.svg')?>" alt="">
                </div>
                <div id="decision-wrap">
                    <img diagram="decision" class="diagram-shape" src="<?=base_url('assets/img/flowchart-shapes/diamond.svg')?>" alt="">
                </div>
                <div id="input-output-wrap">
                    <img diagram="input-output" class="diagram-shape" src="<?=base_url('assets/img/flowchart-shapes/parallelogram.svg')?>" alt="">
                </div>
            </div>
            <div class="answer-container">
                <ul>
                    <li><div class="answer-number">1</div><textarea name="" id="" cols="30" rows="10"></textarea></li>
                    <li><div class="answer-number">2</div><textarea name="" id="" cols="30" rows="10"></textarea></li>
                    <li><div class="answer-number">3</div><textarea name="" id="" cols="30" rows="10"></textarea></li>
                </ul>
            </div>
            <div id="target" class="target">
                <div class="empty"></div><div class="empty"></div>
                <div class="first-diagram">
                    <img src="<?=base_url('assets/img/flowchart-shapes/rounded-rectangle.svg')?>" alt="" style="z-index: 6; position: relative;">
                </div>
                <div class="empty"></div><div class="empty"></div><div class="empty"></div><div class="empty"></div>
                <div class="first-arrow">
                    <img src="<?=base_url('assets/img/arrow3.svg')?>" alt="" style="transform: rotate(90deg);">
                </div>
                <div class="empty"></div><div class="empty"></div>
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