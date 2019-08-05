function makeTarget(targetID){
    let n = 0;
    let change = true;
    targetRow++;
    for ( let i=0; i<=9; i++ ) {
        n++;
        if(!change){
            if(n%2 === 0){
                $(targetID).append($('<div class="drop" id="drop-'+drop+'"></div>').droppable({
                    accept: '.diagram-wrap',
                    hoverClass: 'hovered',
                    drop: diagramDrop
                }));
                drop++;
            }else{
                $(targetID).append($('<div class="arrow" id="arrow-'+arrow+'"></div>').click(function(){
                    viewArrow($(this));
                }));
                arrow++;
            }
        }else{
            if(n%2 === 1){
                $(targetID).append($('<div class="arrow" id="arrow-'+arrow+'"></div>').click(function(){
                    viewArrow($(this));
                }));
                arrow++;
            }else{
                $(targetID).append('<div class="empty"></div>');
            }
        }
        if(n%5 === 0){
            change = !change;
        }
    }
}

function firstTarget(targetID){
    let n = 0;
    let drop = 1;
    let arrow = 1;
    let change = true;
    for ( let i=0; i<=14; i++ ) {
        n++;
        if(change){
            if(n%2 === 1){
                $(targetID).append($('<div class="drop" id="drop-'+drop+'"></div>').droppable({
                    accept: '.diagram-wrap',
                    hoverClass: 'hovered',
                    drop: diagramDrop
                }));
                drop++;
            }else{
                $(targetID).append('<div class="arrow" id="arrow-'+arrow+'"></div>');
                arrow++;
            }
        }else{
            if(n%2 === 0){
                $(targetID).append('<div class="arrow" id="arrow-'+arrow+'"></div>');
                arrow++;
            }else{
                $(targetID).append('<div class="empty"></div>');
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
    for(let i=0; i<collision.length; i++){
        let o = $(collision[i]).data("odata");
        let c = $(collision[i]).data("cdata");
        let d = $(collision[i]).data("ddata");
        let siblingID = $(o).get(0).id;
        if(d === direction){
            return siblingID;
        }else if(direction === null){
            return d;
        }
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
    $.each((arrowList[(containerID-3)%5]), function(_, val){
        $('#arrow'+val).parent().show();
    });
}