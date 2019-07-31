let droppedShape = 1,
    droppedArrow = 1,
    arrowContainer,
    drop = 7,
    arrow = 8,
    targetRow = 1,
    diagramContainer = true,
    answerContainer = true,
    questionDataVariable;

window.onbeforeunload = function() {
    // return 'You have unsaved changes!';
}

function countDown() {
    let date = Math.round((timeLimit-new Date())/1000);
    let hours = Math.floor(date/3600);
    date = date - (hours*3600);
    let mins = Math.floor(date/60);
    date = date - (mins*60);
    let secs = date;
    if (hours<10) hours = '0'+hours;
    if (mins<10) mins = '0'+mins;
    if (secs<10) secs = '0'+secs;
    $('#timer').html(hours+':'+mins+':'+secs);
    // if(secs == 0){
        // }
    let coba = setTimeout("countDown()",1000);
    if(hours == 0 && mins == 0 && secs == 0){
        clearTimeout(coba);
        submitAnswer();
        // $.post("<?=base_url('dataprocess/endtime')?>",function(data){
        //     // if you want you can show some message to user here
        // });
    }
}
function submitAnswer() {
    // console.log(answer[$('#drop-2>div>div').attr('id').substring(7)-1]);
    let scheme = [];
    let a = {};
    let drop = $('.target>.drop').length;
    let arrow = $('.target>.arrow').length;
    for(i=0;i<drop;i++){
        a['target-' + (i+1)] = ({
            'shape' : $('#drop-'+(i+1)+'>div>img').attr('diagram'),
            'answer' : $('#drop-'+(i+1)+'>div>div').attr('id') ? answer[$('#drop-'+(i+1)+'>div>div').attr('id').substring(7)-1] : undefined
        });
    }
    for(i=0;i<arrow;i++){
        a['arrow-'+ (i+1)] = ({'arrow' : $('#arrow-'+(i+1)+'>img').attr('arrow-id')});
    }
    scheme.push(a);
    $.ajax({
        type  : 'POST',
        url   : baseUrl+'dataprocess/submitAnswer/'+quizID,
        // dataType: 'json',
        data : scheme[0],
        beforeSend: function () {
            // ... your initialization code here (so show loader) ...
        },
        complete: function () {
            // ... your finalization code here (hide loader) ...
        },
        error: function (jqXHR, textStatus, errorThrown){
            alert(errorThrown.status);
        },
        success : function(data){
            // console.log(data);
            window.location.replace(baseUrl+'start-quiz/'+quizID+'/result');
        }
    });
}

function makeTarget(){
    let n = 0;
    let change = true;
    targetRow++;
    // $('.target').css('grid-template-rows', 'repeat('+targetRow+', 200px 50px)');
    for ( let i=0; i<=9; i++ ) {
        n++;
        if(!change){
            if(n%2 === 0){
                // console.log('a - ' + n);
                $('.target').append($('<div class="drop" id="drop-'+drop+'"></div>').droppable({
                    accept: '.diagram-wrap',
                    hoverClass: 'hovered',
                    drop: diagramDrop
                }));
                drop++;
            }else{
                // console.log('b - ' + n);
                $('.target').append($('<div class="arrow" id="arrow-'+arrow+'"></div>').click(function(){
                    viewArrow($(this));
                }));
                arrow++;
            }
        }else{
            if(n%2 === 1){
                // console.log('b - ' + n);
                $('.target').append($('<div class="arrow" id="arrow-'+arrow+'"></div>').click(function(){
                    viewArrow($(this));
                }));
                arrow++;
            }else{
                // console.log('c - ' + n);
                $('.target').append('<div class="empty"></div>');
            }
        }
        if(n%5 === 0){
            change = !change;
        }
    }
    console.log(n);
}
function firstTarget(){
    let n = 0;
    let drop = 1;
    let arrow = 1;
    let change = true;
    for ( let i=0; i<=14; i++ ) {
        n++;
        if(change){
            if(n%2 === 1){
                // console.log('a - ' + n);
                $('.target').append($('<div class="drop" id="drop-'+drop+'"></div>').droppable({
                    accept: '.diagram-wrap',
                    hoverClass: 'hovered',
                    drop: diagramDrop
                }));
                drop++;
            }else{
                // console.log('b - ' + n);
                $('.target').append('<div class="arrow" id="arrow-'+arrow+'"></div>');
                arrow++;
            }
        }else{
            if(n%2 === 0){
                // console.log('b - ' + n);
                $('.target').append('<div class="arrow" id="arrow-'+arrow+'"></div>');
                arrow++;
            }else{
                // console.log('c - ' + n);
                $('.target').append('<div class="empty"></div>');
            }
        }
        if(n%5 === 0){
            change = !change;
        }
    }
}

function getSibling(obstacle, colls, direction){
    let collision = colls.collision(obstacle, {
        relative: 'obstacle',
        as: '<div/>',
        colliderData: 'cdata',
        obstacleData: 'odata',
        directionData: 'ddata'
    });
    // console.log($(collision[1]).data());
    for(let i=0; i<collision.length; i++){
        let o = $(collision[i]).data("odata");
        let c = $(collision[i]).data("cdata");
        let d = $(collision[i]).data("ddata");
        let coba = $(o).get(0).id;
        if(d === direction){
            return coba;
        }else if(direction === null){
            return d;
        }
    }
}

function coba() {
    console.log(droppedShape);
    console.log(droppedArrow);
    console.log(drop);
    console.log(arrow);
    console.log(arrowContainer);
}

function diagramDrop(event, ui) {
    let count = $(this)[0].children.length;
    if($(this).children().hasClass('turn-arrow')){
        
        let arrowGroup = $(this).children().attr('class').split(' ')[1];
        $('.'+arrowGroup).remove();
    }
    answerBack($(this).children());
    if(ui.draggable.hasClass('dropped')){
        // console.log($(ui.draggable).attr('id'));
        // console.log($(this).children().attr('id'));
        if(!$(this).children().attr('id') || $(this).children().attr('id') !== $(ui.draggable).attr('id')){
            console.log('ada');
            $(this).html($(ui.draggable).draggable({
                // stack: '.diagram-wrap',
                zIndex: 2,
                revert: 'invalid'
            }));
        }
        $(ui.draggable).position({
            of: $(this), my: 'center center', at: 'center center'
        });
    }else{
        if(ui.draggable.children().attr('diagram') == 'start-end'){
            $(this).html($(ui.draggable).clone().addClass('dropped').attr('id', 'shape-'+droppedShape).draggable({
                    // stack: '.diagram-wrap',
                    zIndex: 2,
                    revert: 'invalid'
                })
            );
            $(this).children().append('<span>Selesai</span>')
        }else{
            $(this).html($(ui.draggable).clone().addClass('dropped').attr('id', 'shape-'+droppedShape).draggable({
                    // stack: '.diagram-wrap',
                    zIndex: 2,
                    revert: 'invalid'
                })
                .droppable({
                    accept: '.answer-number',
                    drop: answerDrop
                })
            );
        }
        $(ui.draggable[1]).position({
            of: $(this), my: 'center center', at: 'center center'
        });
        droppedShape++;
    }
}

function answerDrop(event, ui){
    if($(this).children().hasClass('answer-number')){
        let lastAnswer = $(this).children('.answer-number');
        $('.answer-container').append(lastAnswer.draggable({
            zIndex: 999,
            revert: 'invalid'
        }).css({
            'position': 'relative',
            'top': '0',
            'left': '0'
        }));
    }
    $(this).append($(ui.draggable).draggable({
        zIndex : 999,
        revert : 'invalid'
    }).css('position', 'absolute')
    .hover(
        function() {
            $(this).parent().parent().css('z-index', '99');
        }, function() {
            $(this).parent().parent().css('z-index', 'auto');
        }
    ));
    $(ui.draggable).position({
        of: $(this), my: 'center center', at: 'center center'
    });
}

function answerBack(drop){
    if(drop.children().hasClass('answer-number')){
        $('.answer-container').append(drop.children('.answer-number').draggable({
            zIndex: 999,
            revert: 'invalid'
        }).css({
            'position': 'relative',
            'top': '0',
            'left': '0'
        }));
        drop.parent().css('z-index', 'auto');
    }
}
function arrowDrop(val){
    let arrowList = {
        'arrow1' : {
            'id' : 'arrow1',
            'file' : 'arrow1',
            'rotate' : 0,
            'direction' : ['S','E'],
            'turn' : 'right'
        },
        'arrow2' : {
            'id' : 'arrow2',
            'file' : 'arrow1',
            'rotate' : 90,
            'direction' : ['W','S'],
            'turn' : 'right'
        },
        'arrow3' : {
            'id' : 'arrow3',
            'file' : 'arrow1',
            'rotate' : 180,
            'direction' : ['N','W'],
            'turn' : 'right'
        },
        'arrow4' : {
            'id' : 'arrow4',
            'file' : 'arrow1',
            'rotate' : 270,
            'direction' : ['E','N'],
            'turn' : 'right'
        },
        'arrow5' : {
            'id' : 'arrow5',
            'file' : 'arrow2',
            'rotate' : 0,
            'direction' : ['S','W'],
            'turn' : 'left'
        },
        'arrow6' : {
            'id' : 'arrow6',
            'file' : 'arrow2',
            'rotate' : 90,
            'direction' : ['W','N'],
            'turn' : 'left'
        },
        'arrow7' : {
            'id' : 'arrow7',
            'file' : 'arrow2',
            'rotate' : 180,
            'direction' : ['N','E'],
            'turn' : 'left'
        },
        'arrow8' : {
            'id' : 'arrow8',
            'file' : 'arrow2',
            'rotate' : 270,
            'direction' : ['E','S'],
            'turn' : 'left'
        },
        'arrow9' : {
            'id' : 'arrow9',
            'file' : 'arrow3',
            'rotate' : 0,
            'direction' : null,
            'turn' : null
        },
        'arrow10' : {
            'id' : 'arrow10',
            'file' : 'arrow3',
            'rotate' : 90,
            'direction' : null,
            'turn' : null
        },
        'arrow11' : {
            'id' : 'arrow11',
            'file' : 'arrow3',
            'rotate' : 180,
            'direction' : null,
            'turn' : null
        },
        'arrow12' : {
            'id' : 'arrow12',
            'file' : 'arrow3',
            'rotate' : 270,
            'direction' : null,
            'turn' : null
        }
    }
    console.log(val);
    return arrowList[val];
}

function viewArrow(container) {
    let arrowList = {
        '-2' : [
            '2', '9', '11'
        ],
        '-1' : [
            '8','9','11'
        ],
        '0' : [
            '1','7','10','12'
        ],
        '1' : [
            '1','5','10','12'
        ],
        '2' : [
            '3','5','10','12'
        ],
        '3' : [
            '2','4','6','8','9','11'
        ],
        '4' : [
            '2','4','6','8','9','11'
        ]
    }
    for(i=0;i<12;i++){
        $('#arrow'+(i+1)).parent().hide();
    }
    $('#arrow-container').show();
    arrowContainer = container;
    containerID = $(container).attr('id').substring(6);
    $.each((arrowList[(containerID-3)%5]), function(i, val){
        $('#arrow'+val).parent().show();
    });
}

$(document).ready(function(){
    firstTarget();
    countDown();
    $('.diagram-btn').click(function(){
        $('.answer-container').hide();
        $('#diagram-container').toggle();
    });
    
    $('.answer-btn').click(function(){
        $('#diagram-container').hide();
        $('.answer-container').toggle();
        $('.answer-container').css('display', 'grid');
    });

    $('.arrow').click(function(){
        viewArrow($(this));
    });

    $('#arrow-container').click(function(){
        $(this).hide();
    });

    $('.answer-number').draggable({
        zIndex : 999,
        revert : 'invalid',
        start : function(){
            // console.log('object');
            // $('.answer-container').css('overflow-y', 'hidden');
        },
        stop : function(){
            // $('.answer-container').css('overflow-y', 'scroll');
        }
    });

    $(".answer-number").hover(
        function() {
            $(this).find('p').show();
        }, function() {
            $(this).find('p').hide();
        }
    );
    

    $('.arrow-img').click(function(){
        let arrowImage = $(arrowContainer).children('img');
        if(arrowImage.hasClass('empty-arrow')){
            let arrowGroup = arrowImage.attr('class').split(' ')[1];
            $('.'+arrowGroup).remove();
        }
        let arrowData = arrowDrop($(this).children().attr('id'));
        let arrowType = arrowData['file'].substring(5);
        if(arrowType < 3){
            let firstSibling = getSibling('.drop', arrowContainer, arrowData.direction[0]);
            let secondSibling = getSibling('.arrow', $('#'+firstSibling), arrowData.direction[1]);
            if(!secondSibling){
                makeTarget();
                secondSibling = getSibling('.arrow', $('#'+firstSibling), arrowData.direction[1]);
            }
            $(arrowContainer).html($("<img arrow-id='tail-"+arrowData['id']+"' class='arrow-tail arrow-group-"+droppedArrow+"' src='"+baseUrl+"assets/img/empty-arrow.svg' alt=''>"));
            $('#'+firstSibling).html($("<img arrow-id='"+arrowData['id']+"' id='dropped-arrow-"+droppedArrow+"' class='turn-arrow arrow-group-"+droppedArrow+"' src='"+baseUrl+"assets/img/turn-"+arrowData['turn']+"-arrow.svg'>").css('transform', 'translate(-50%, -50%) rotate('+arrowData['rotate']+'deg)'));
            $('#'+secondSibling).html($("<img arrow-id='head-"+arrowData['id']+"' class='arrow-head arrow-group-"+droppedArrow+"' src='"+baseUrl+"assets/img/empty-arrow.svg'>"));

            console.log(firstSibling+'-'+secondSibling);
        }else{
            $(arrowContainer).html($("<img arrow-id="+arrowData['id']+" id='dropped-arrow-"+droppedArrow+"' src='"+baseUrl+"assets/img/"+ arrowData['file'] +".svg' alt=''>").css('transform', 'rotate('+arrowData['rotate']+'deg)'));
        }
        droppedArrow++;
    });

    $('#diagram-trash').droppable({
        accept: '.dropped',
        hoverClass: 'hovered',
        drop: function(event, ui){
            $('#diagram-trash>#trash-top').css('transform', 'rotate(0deg)');
            answerBack(ui.draggable);
            $(ui.draggable).remove();
        },
        over: function(event, ui){
            $(ui.draggable).css('opacity', '.5');
            $('#diagram-trash>#trash-top').css('transform', 'rotate(-19deg)');
        },
        out: function(event, ui){
            $(ui.draggable).css('opacity', '1');
            $('#diagram-trash>#trash-top').css('transform', 'rotate(0deg)');
        }
    })


    $('.diagram-wrap').draggable({
        zIndex: 2,
        containtment: '#flowchart-container',
        helper: 'clone',
        revert: 'invalid',
        cursorAt: { left: 45 }
    });

    // ADD QUIZ NUMBER FUNCTION
    let n = 1;
    $("#add-quiz").click(function(e){
        e.preventDefault();
        n++;
        $("#add-quiz-id").before('<li><a href="#">'+n+'</a></li>');
    })

    // DATE PICKER FUNCTION
    $("#startDate").datetimepicker({ 
        minDate: 1,
        changeMonth: true,
        dateFormat: "yy-mm-dd",
        onSelect: function(date){
            let selectedDate = new Date(date);
            let msecsInADay = 86400000;
            let endDate = new Date(selectedDate.getTime() + msecsInADay);

            //Set Minimum Date of EndDatePicker After Selected Date of StartDatePicker
            $("#dueDate").datepicker( "option", "minDate", endDate );
        }
    });
    $("#dueDate").datetimepicker({ 
        dateFormat: 'yy-mm-dd',
        changeMonth: true
    });

})