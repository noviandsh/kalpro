<div id="start-quiz-container">
    <div id="start-quiz-content">
        <div id="quiz-title"><?=$quizDetail[0]['title']?> | <span id="timer"></span> <button class="styled-btn" onClick="submitAnswer()" data-icon='&#xf1d8'>Selesai</button></div>
        <?php
            // print_r($quizDetail);
            // echo '<hr>';
            // print_r($question['flowchart']);
        ?>
        <hr><br>
        <div id="quiz-question"><?=$soal[0]['question']?></div>
        <br>
        <div id="flowchart-container">
            <div style="width: 100%; display: flex; justify-content: space-between">
                <div id="myPaletteDiv"></div>
                <div id="myDiagramDiv"></div>
            </div>
        </div>
    </div>
    <div id="start-quiz-number">
    </div>
</div>

<div id="tutorial-button">
    <i class="fas fa-question-circle"></i>
</div>
<div id="modal-tutorial" class="modal">
    <video loop controls>
        <source src="" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <ul>
        <li class="nav-btn"><i class="far fa-arrow-alt-circle-left"></i></li>
        <li title="tambah_node" id="nav-1" class="active"></li>
        <li title="delete_node" id="nav-2"></li>
        <li title="tambah_link" id="nav-3"></li>
        <li title="edit_teks_node" id="nav-4"></li>
        <li title="edit_teks_kondisi" id="nav-5"></li>
        <li title="delete_link" id="nav-6"></li>
        <li class="nav-btn"><i class="far fa-arrow-alt-circle-right"></i></li>
    </ul>
</div>

<script>
    let baseUrl = '<?=base_url()?>',
        quizID = '<?=$quizDetail[0]['id']?>';
    let timeLimit = new Date('<?=date("r", $_SESSION["timer"])?>');
</script>