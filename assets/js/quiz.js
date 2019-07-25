let droppedShape = 1;
let droppedArrow = 1;
let arrowContainer;
let drop = 7;
let arrow = 8;
let state = true;
let targetRow = 1;

$('#addLine').click(function(){
    let a = '';
    let b = '';
    if(state){
        $(this).html('batal');
        $('.dropped').click(function(){
            let shapeId = $(this).attr('id');
            if (a === ""){
                a = shapeId;
            }else if(b === ""){
                b = shapeId;
            }
            console.log(a);
            console.log(b);
            if(a !== "" && b !== ""){
                connectLine('svg1', 'myNewPath', a, b);
                a = "";
                b = "";
            }
        })
    }else{
        $(this).html('garis');
        $('.dropped').click();
    }
    state = !state;
    // console.log(state);
});

function addLine(a, b){
    $().connections({ from: '#'+a, to: '#'+b });
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
                    accept: '.diagram-shape',
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
                    accept: '.diagram-shape',
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
    let scheme = [];
    let a = {};
    let n = $('.target>.drop').length;
    for(i=0;i<n;i++){
        a['target-' + (i+1)] = ({'shape' : $('#drop-'+(i+1)+'>img').attr('diagram')});
    }
    scheme.push(a);
    console.log(scheme[0]);
}

function diagramDrop(event, ui) {
    let count = $(this)[0].children.length;

    if($(this).children().hasClass('turn-arrow')){
        let arrowGroup = $(this).children().attr('class').split(' ')[1];
        $('.'+arrowGroup).remove();
    }

    if(ui.draggable.hasClass('dropped')){
        if(count>0){
            $($(this)[0].children).remove();
        }
        $(this).append($(ui.draggable).draggable({
            stack: '.diagram-shape',
            cursor: 'move',
            revert: 'invalid'
        }));
        $(ui.draggable).position({
            of: $(this), my: 'center center', at: 'center center'
        });
    }else{
        if(count>0){ 
            $($(this)[0].children).remove();
        }
        $(this).append($(ui.draggable).clone().addClass('dropped').attr('id', 'shape-'+droppedShape).draggable({
            stack: '.diagram-shape',
            cursor: 'move',
            revert: 'invalid'
        }));
        $(ui.draggable[1]).position({
            of: $(this), my: 'center center', at: 'center center'
        });
        droppedShape++;
    }
    
}
function arrowDrop(val){
    let arrowList = {
        'arrow1' : {
            'file' : 'arrow1',
            'rotate' : 0,
            'direction' : ['S','E'],
            'turn' : 'right'
        },
        'arrow2' : {
            'file' : 'arrow1',
            'rotate' : 90,
            'direction' : ['W','S'],
            'turn' : 'right'
        },
        'arrow3' : {
            'file' : 'arrow1',
            'rotate' : 180,
            'direction' : ['N','W'],
            'turn' : 'right'
        },
        'arrow4' : {
            'file' : 'arrow1',
            'rotate' : 270,
            'direction' : ['E','N'],
            'turn' : 'right'
        },
        'arrow5' : {
            'file' : 'arrow2',
            'rotate' : 0,
            'direction' : ['S','W'],
            'turn' : 'left'
        },
        'arrow6' : {
            'file' : 'arrow2',
            'rotate' : 90,
            'direction' : ['W','N'],
            'turn' : 'left'
        },
        'arrow7' : {
            'file' : 'arrow2',
            'rotate' : 180,
            'direction' : ['N','E'],
            'turn' : 'left'
        },
        'arrow8' : {
            'file' : 'arrow2',
            'rotate' : 270,
            'direction' : ['E','S'],
            'turn' : 'left'
        },
        'arrow9' : {
            'file' : 'arrow3',
            'rotate' : 0,
            'direction' : null,
            'turn' : null
        },
        'arrow10' : {
            'file' : 'arrow3',
            'rotate' : 90,
            'direction' : null,
            'turn' : null
        },
        'arrow11' : {
            'file' : 'arrow3',
            'rotate' : 180,
            'direction' : null,
            'turn' : null
        },
        'arrow12' : {
            'file' : 'arrow3',
            'rotate' : 270,
            'direction' : null,
            'turn' : null
        }
    }
    // console.log(arrowList[val].direction);
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
    // console.log(arrowList[(containerID-3)%5]);
    // console.log((containerID-3)%5);
    $.each((arrowList[(containerID-3)%5]), function(i, val){
        $('#arrow'+val).parent().show();
    });
    // getSibling('.drop', container);
}

$(document).ready(function(){
    firstTarget();

    $('.arrow').click(function(){
        viewArrow($(this));
    });

    $('#arrow-container').click(function(){
        $(this).hide();
    });

    $('.arrow-img').click(function(){
        let arrowImage = $(arrowContainer).children('img');
        if(arrowImage.hasClass('empty-arrow')){
            let arrowGroup = arrowImage.attr('class').split(' ')[1];
            $('.'+arrowGroup).remove();
        }
        // else if(arrowImage.length !== 0){
        //     arrowImage.remove();
        // }
        let arrowData = arrowDrop($(this).children().attr('id'));
        let arrowType = arrowData['file'].substring(5);
        console.log(arrowType);
        if(arrowType < 3){
            let firstSibling = getSibling('.drop', arrowContainer, arrowData.direction[0]);
            // $('#'+firstSibling).children('img').remove();
            let secondSibling = getSibling('.arrow', $('#'+firstSibling), arrowData.direction[1]);
            
            $(arrowContainer).html($("<img class='empty-arrow arrow-group-"+droppedArrow+"' src='"+baseUrl+"assets/img/empty-arrow.svg' alt=''>"));
            $('#'+firstSibling).html($("<img id='dropped-arrow-"+droppedArrow+"' class='turn-arrow arrow-group-"+droppedArrow+"' src='"+baseUrl+"assets/img/turn-"+arrowData['turn']+"-arrow.svg'>").css('transform', 'translate(-50%, -50%) rotate('+arrowData['rotate']+'deg)'));
            $('#'+secondSibling).html($("<img class='empty-arrow arrow-group-"+droppedArrow+"' src='"+baseUrl+"assets/img/empty-arrow.svg'>"));

            console.log(firstSibling+'-'+secondSibling);
        }else{
            $(arrowContainer).html($("<img id='dropped-arrow-"+droppedArrow+"' src='"+baseUrl+"assets/img/"+ arrowData['file'] +".svg' alt=''>").css('transform', 'rotate('+arrowData['rotate']+'deg)'));
        }
        droppedArrow++;
    });

    $('#diagram-trash').droppable({
        accept: '.dropped',
        hoverClass: 'hovered',
        drop: function(event, ui){
            $('#diagram-trash>#trash-top').css('transform', 'rotate(0deg)');
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

    function deleteDiagram(event, ui){
        $(ui.draggable).remove();
        // $(ui.draggable).position({
        // 	of: $(this), my: 'center center', at: 'center center'
        // });
    }


    $('.diagram-shape').draggable({
        stack: '.diagram-shape',
        containtment: '#flowchart-container',
        helper: 'clone',
        cursor: 'move',
        cursorAt: { top: 56, left: 56 },
        revert: 'invalid'
    });

    // function diagramOver(event, ui){
    // 	if($(this).hasClass('contained')){
    // 		console.log('full');
    // 		// $(this).droppable('option', 'accept', null);
    // 	}
    // }
    // function diagramOut(event, ui) {
    // 	$(this).removeClass('contained');
    // 		$(this).data('count', 0);
    // 		// console.log('anu');
    // }
    

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