<div id="new-quiz-container">
    <form id="quiz-detail">
        <input type="hidden" id="quiz-id" value="<?=$detail['id']?>">
        <input type="hidden" id="quiz-teacher" value="<?=$detail['teacher']?>">
        <input type="hidden" id="quiz-classID" value="<?=$detail['classID']?>">
        <input type="text" id="quiz-title" value="<?=$detail['title']?>">
        <input readonly="readonly" type="text" id="startDate" placeholder="Waktu Mulai" value="<?=$detail['date']?>">
        <input readonly="readonly" type="text" id="dueDate" placeholder="Waktu Selesai" value="<?=$detail['dueDate']?>">
        <input type="text" id="quiz-duration" placeholder="Durasi" value="<?=$detail['duration']?>"><br><br>
    </form>
    <button class="styled-btn" onClick="editQuiz()" class='styled-btn' data-icon='&#xf0c7'>Simpan perubahan</button><br><br>
    <div id="new-quiz-number">
        <ul style="display:none;">
            <li class="selected"><a href="#">1</a></li>
            <li id="add-quiz-id"><a id="add-quiz" href="">+</a></li>
        </ul>
        <div class="new-quiz-form">
            <div id="question-1">
                <div id="flowchart-container">
                    <textarea id="question-form" placeholder="Pertanyaan" cols="100" rows="10"><?=$quiz['question']?></textarea>
                    <div id="flowchart-edit" style="width: 100%; display: flex; justify-content: space-between">
                        <div id="myPaletteDiv" style="width: 100px; margin-right: 2px; background-color: #282c34;"></div>
                        <div id="myDiagramDiv" style="flex-grow: 1; height: 750px; background-color: #282c34;"></div>
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
    const baseUrl = "<?=base_url()?>";
    const savedDiagram = <?=$quiz['answer']?>;
</script>