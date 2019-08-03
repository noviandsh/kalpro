<div id="container">
    <div id="side-menu">
        <ul>
            <li id="post" class="side-btn">Kiriman</li>
            <?php if($this->session->type == 'd'){
                    echo "<li id='quiz' class='side-btn'>Kuis</li>";
                }
            ?>
            <li id="member" class="side-btn">Member</li>
        </ul>
    </div>
    <div id="content">
        
    </div>
    <div>
        <?php
            foreach($quiz as $val){
                echo "<div class='quiz-list-box'>
                        <span class='quiz-title'>".$val['title']."</span><br>
                        <span class='quiz-date'>".$val['date']."</span> | <span class='quiz-due-date'>".$val['dueDate']."</span><br>
                        <div class='quiz-option-btn'>
                            <div></div>
                        </div>
                        <span class='quiz-total'>1 Pertanyaan</span> - <span class='quiz-duration'>".$val['duration']." Menit</span><br/>
                        <a href='".base_url('start-quiz/').$val['id']."'>Ambil</a>
                    </div>";
            }
        ?>
    </div>
</div>

<script language="JavaScript" type="text/javascript">
$( document ).ready(function() {
    const link = '<?=base_url("class/".$link)?>';
    let menu = jQuery.makeArray($('.side-btn'));
    const uri = <?=$this->uri->segment(3)?>;
    const currentClass = '<?=$class['classID']?>';
    menu.forEach(m => {
        if(m.id === uri.id){
            $('#'+m.id).toggleClass('selected');
            showPage(m.id, currentClass);
        }else{
            $('#'+m.id).removeClass('selected');
        }
    })

    function selectMenu(id) {
        menu.forEach(m => {
            if(m.id === id){
                $('#'+m.id).toggleClass('selected');
                showPage(m.id, currentClass);
            }else{
                $('#'+m.id).removeClass('selected');
            }
        })
    }

    function showPage(item,kelas){
        $.ajax({
            type  : 'POST',
            url   : '<?php echo base_url()?>dataprocess/showcontent/'+item+'/'+kelas,
            error: function (jqXHR, textStatus, errorThrown){
                alert(jqXHR.status);
            },
            success : function(data){
                let html = data;
                $('#content').html(html);
            }
        });
    }

    $('.side-btn').click(function(){
        let id = $(this).attr('id');
        selectMenu(id);
        window.history.pushState(id, null, link + '/' + id);
    })
    window.addEventListener('popstate', e => {
        if(e.state !== null){
            selectMenu(e.state);
        }
        else{
            let url = window.location.pathname.split('/');
            selectMenu(url[4]);
        }
    })


    
})
</script>
