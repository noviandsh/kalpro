
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
                    <div style="width: 100%; display: flex; justify-content: space-between">
                        <div id="myPaletteDiv"></div>
                        <div id="myDiagramDiv"><div>    
                    </div>
                </div>
            </div>
        </div>
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
    let baseUrl = '<?=base_url()?>';
</script>