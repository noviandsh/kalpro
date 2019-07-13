<div id="side-menu">
    <ul>
        <li id="post" class="side-btn">Kiriman</li>
        <li id="quiz" class="side-btn">Kuis</li>
        <li id="member" class="side-btn">Member</li>
    </ul>
</div>
<div id="content">
    
</div>
<div>

</div>
<script>
$( document ).ready(function() {
    const link = '<?=base_url("class/".$link)?>';
    let menu = jQuery.makeArray($('.side-btn'));
    const uri = <?=$this->uri->segment(3)?>;

    menu.forEach(m => {
        if(m.id === uri.id){
            $('#'+m.id).toggleClass('selected');
            showPage(m.id);
        }else{
            $('#'+m.id).removeClass('selected');
        }
    })

    function selectMenu(id) {
        menu.forEach(m => {
            if(m.id === id){
                $('#'+m.id).toggleClass('selected');
                showPage(m.id);
            }else{
                $('#'+m.id).removeClass('selected');
            }
        })
    }

    function showPage(item){
        $.ajax({
            type  : 'POST',
            url   : '<?php echo base_url()?>dataproccess/coba/'+item,
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


    const feed = [<?php echo '"'.implode('","', $feedID).'"' ?>];
    feed.forEach(showComment);

    function showComment(item, index) {
        $.ajax({
            type  : 'POST',
            url   : '<?php echo base_url()?>dataproccess/getcomment/'+item,
            async : false,
            contentType: 'application/json',
            dataType: 'json',
            success : function(data){
                let html = '';
                let i;
                let arrId = [];
                for(i=0; i<data.length; i++){
                    html += '<div class="user-comment user-comment-'+data[i].id+'">'+
                                '<b>'+data[i].sender+'</b><br>'+
                                '<small>'+data[i].date+'</small><br>'+
                                data[i].comment+
                                '<div><i class="fas fa-ellipsis-v fa-xs"></i></div>'+
                            '</div>';
                }
                $('.comment-box-'+item).html(html);
            }
        });
    }
})
</script>
