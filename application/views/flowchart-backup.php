<style>
	/* Add some margin to the page and set a default font and colour */

body {
    font-family: "Georgia", serif;
    line-height: 1.8em;
    color: #333;
}

/* Give headings their own font */

h1, h2, h3, h4 {
    font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
}

/* Main content area */

#content {
    text-align: center;
    -moz-user-select: none;
    -webkit-user-select: none;
    user-select: none;
    display: grid;
    grid-template-columns: 32% 68%;
}
#content>div:first-child{
    display: grid;
    grid-template-rows: 117px 115px 134px 198px;
}

/* Header/footer boxes */

.wideBox {
    clear: both;
    text-align: center;
    margin: 70px;
    padding: 10px;
    background: #ebedf2;
    border: 1px solid #333;
}

.wideBox h1 {
    font-weight: bold;
    margin: 20px;
    color: #666;
    font-size: 1.5em;
}

/* Slots for final card positions */

#cardSlots {
    margin: 50px auto 0 auto;
    background: #ddf;
}

/* The initial pile of unsorted cards */

#cardPile {
    margin: 0 auto;
    background: #ffd;
}

#cardSlots, #cardPile {
    width: 910px;
    height: 120px;
    padding: 20px;
    border: 2px solid #333;
    -moz-border-radius: 10px;
    -webkit-border-radius: 10px;
    border-radius: 10px;
    -moz-box-shadow: 0 0 .3em rgba(0, 0, 0, .8);
    -webkit-box-shadow: 0 0 .3em rgba(0, 0, 0, .8);
    box-shadow: 0 0 .3em rgba(0, 0, 0, .8);
}

/* Individual cards and slots */

#cardSlots div, #cardPile div {
    float: left;
    width: 58px;
    height: 78px;
    padding: 10px;
    padding-top: 40px;
    padding-bottom: 0;
    border: 2px solid #333;
    -moz-border-radius: 10px;
    -webkit-border-radius: 10px;
    border-radius: 10px;
    margin: 0 0 0 10px;
    background: #fff;
}

#cardSlots div:first-child, #cardPile div:first-child {
    margin-left: 0;
}

#cardSlots div.hovered {
    background: #aaa;
}

#cardSlots div {
    border-style: dashed;
}

#cardPile div {
    background: #666;
    color: #fff;
    font-size: 50px;
    text-shadow: 0 0 3px #000;
}

#cardPile div.ui-draggable-dragging {
    -moz-box-shadow: 0 0 .5em rgba(0, 0, 0, .8);
    -webkit-box-shadow: 0 0 .5em rgba(0, 0, 0, .8);
    box-shadow: 0 0 .5em rgba(0, 0, 0, .8);
}

/* Individually coloured cards */

#card1.correct { background: red; }
#card2.correct { background: brown; }
#card3.correct { background: orange; }
#card4.correct { background: yellow; }
#card5.correct { background: green; }
#card6.correct { background: cyan; }
#card7.correct { background: blue; }
#card8.correct { background: indigo; }
#card9.correct { background: purple; }
#card10.correct { background: violet; }


/* "You did it!" message */
#successMessage {
    position: absolute;
    left: 580px;
    top: 250px;
    width: 0;
    height: 0;
    z-index: 100;
    background: #dfd;
    border: 2px solid #333;
    -moz-border-radius: 10px;
    -webkit-border-radius: 10px;
    border-radius: 10px;
    -moz-box-shadow: .3em .3em .5em rgba(0, 0, 0, .8);
    -webkit-box-shadow: .3em .3em .5em rgba(0, 0, 0, .8);
    box-shadow: .3em .3em .5em rgba(0, 0, 0, .8);
    padding: 20px;

}
.start-end-shape{
    margin: 10px;
    width: 200px;
    height: 100px;
    border-radius: 50px;
    background: red;
    position: absolute !important;
}
.process-shape{
    margin: 10px;
    width: 200px;
    height: 100px;
    background: red;
    position: absolute;
}
.document-shape{
    margin: 50px 10px;
    width: 200px;
    height: 100px;
    background: red;
    position: absolute;
    /* background-image: url(../img/wavy-btm.svg);
    background-position: center bottom;
    background-size: 1440px 126px;
    background-repeat: repeat-x; */
}
.document-shape::after{
    display: block;
    content: ' ';
    background-image: url(../img/wavy-btm.svg);
    background-size: 200px 30px;
    height: 30px;
    width: 200px;
    position: absolute;
    bottom: -29px;
}
.decision-shape{
    margin: 10px;
    width: 200px;
    height: 200px;
    position: absolute;
    line-height: 200px;
}
.decision-shape::before{
    content: '';
    width: 0;
    height: 0;
    border: 100px solid transparent;
    border-bottom-color: red;
    position: absolute;
    top: -100px;
    left: 0;
    z-index: -1;
}
.decision-shape::after{
    content: '';
    position: absolute;
    left: 0;
    top: 100px;
    width: 0;
    height: 0;
    border: 100px solid transparent;
    border-top-color: red;
    z-index: -1;
}
.input-output-shape{
    margin: 10px;
    width: 200px;
    height: 100px;
    transform: skew(-20deg);
    background: red;
    position: absolute;
}
.input-output-shape>div{
    transform: skew(20deg);
}
.target{
    display: grid;
    grid-template-columns: auto auto auto;
    width: 600px;
    height: 1000px;
}
.target>div{
    width: 200px;
    height: 200px;
    border: 1px solid black;
}

</style>


<div id="content">
	<div>
		<div id="start-end-shape-wrap">
			<div class="start-end-shape">start end</div>
		</div>
		<div id="process-shape-wrap">
			<div class="process-shape">process</div>
		</div>
		<div id="document-shape-wrap">
			<div class="document-shape">document</div>
		</div>
		<div id="decision-shape-wrap">
			<div class="decision-shape"><div>decision</div></div>
		</div>
		<div id="input-output-shape-wrap">
			<div class="input-output-shape"><div>input output</div></div>
		</div>
	</div>
	<div class="target">
	</div>
	<hr>
	<!-- <div id="cardPile"></div>
	<div id="cardSlots"></div>
	
	<div id="successMessage">
		<h2>You did it!</h2>
		<button onclick="init()">Play Again!</button>
	</div> -->
</div>
<script>
	const shapes = ".start-end-shape, .process-shape, .document-shape, .decision-shape, .input-output-shape"
	$(shapes).draggable({
			stack: shapes,
			cursor: 'move',
			revert: 'invalid'
		});
	
	// Create the card slots
	// var words = [ 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten' ];
	for ( var i=1; i<=5; i++ ) {
		$('<div>' + i + '- <span class=count"'+i+'"></span' + '</div>').data( 'number', i ).appendTo( '.target' ).droppable( {
			accept: shapes,
			hoverClass: 'hovered',
			over: cobaOver,
			drop: coba,
			out: cobaOut
		} );
	}
	function cobaOver(event, ui){
		// console.log(ui.draggable);
		if($(this).hasClass('contained')){
			console.log('full');
			// $(this).droppable('option', 'accept', null);
		}
	}
	function cobaOut(event, ui) {
		$(this).removeClass('contained');
			$(this).data('count', 0);
			// console.log('anu');
	}
	function coba(event, ui) {
		if ($(this).data('count')) {
			// $(this).droppable('disable');
		}else{
			ui.draggable.position({
				of: $(this), my: 'center center', at: 'center center'
			});
			let shape = ui.draggable.attr('class').split(' ')[0];
			let dropped = ui.draggable.attr('class').split(' ')[4];
			if(!ui.draggable.hasClass('dropped')){
				$('<div class="'+shape+'"><div>'+shape+'</div></div>').prependTo('#'+shape+'-wrap').draggable({
					stack: shapes,
					cursor: 'move',
					revert: 'invalid'
				});
			}
			ui.draggable.addClass('dropped');
			$(this).addClass('contained');
			$(this).data('count', 1);
		}
		// $($(this).data('count')).prependTo($(this));
		console.log($(this).data('count'));
		// ui.draggable.clone().prependTo('#content');
		// ui.draggable.append()
		// $(this).droppable('disable');
	}
	// var correctCards = 0;
	// $( init );

	// function init() {

	// 	// Hide the success message
	// 	$('#successMessage').hide();
	// 	$('#successMessage').css( {
	// 		left: '580px',
	// 		top: '250px',
	// 		width: 0,
	// 		height: 0
	// 	} );

	// 	// Reset the game
	// 	correctCards = 0;
	// 	$('#cardPile').html( '' );
	// 	$('#cardSlots').html( '' );

	// 	// Create the pile of shuffled cards
	// 	var numbers = [ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ];
	// 	numbers.sort( function() { return Math.random() - .5 } );

	// 	for ( var i=0; i<10; i++ ) {
	// 		$('<div>' + numbers[i] + '</div>').data( 'number', numbers[i] ).attr( 'id', 'card'+numbers[i] ).appendTo( '#cardPile' ).draggable( {
	// 		containment: '#content',
	// 		stack: '#cardPile div',
	// 		cursor: 'move',
	// 		revert: true
	// 		} );
	// 	}

	// 	// Create the card slots
	// 	var words = [ 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten' ];
	// 	for ( var i=1; i<=10; i++ ) {
	// 		$('<div>' + words[i-1] + '</div>').data( 'number', i ).appendTo( '#cardSlots' ).droppable( {
	// 		accept: '#cardPile div',
	// 		hoverClass: 'hovered',
	// 		drop: handleCardDrop
	// 		} );
	// 	}

	// }

	// function handleCardDrop(event, ui) {
	// 	//Grab the slot number and card number
	// 	var slotNumber = $(this).data('number');
	// 	var cardNumber = ui.draggable.data('number');
		
	// 	//If the cards was dropped to the correct slot,
	// 	//change the card colour, position it directly
	// 	//on top of the slot and prevent it being dragged again
	// 	if (slotNumber === cardNumber) {
	// 		ui.draggable.addClass('correct');
	// 		ui.draggable.draggable('disable');
	// 		$(this).droppable('disable');
	// 		ui.draggable.position({
	// 		of: $(this), my: 'left top', at: 'left top'
	// 		});
	// 		//This prevents the card from being
	// 		//pulled back to its initial position
	// 		//once it has been dropped
	// 		ui.draggable.draggable('option', 'revert', false);
	// 		correctCards++; //increment keep track correct cards
	// 	}
		
	// 	//If all the cards have been placed correctly then
	// 	//display a message and reset the cards for
	// 	//another go
	// 	if (correctCards === 10) {
	// 		$('#successMessage').show();
	// 		$('#successMessage').animate({
	// 		left: '380px',
	// 		top: '200px',
	// 		width: '400px',
	// 		height: '100px',
	// 		opacity: 1
	// 		});
	// 	}
	
	
	
	// }
	
</script>