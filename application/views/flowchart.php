<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<title>Flowchart</title>
	<link href="<?php echo base_url('assets/css/jquery-ui.css');?>" rel="stylesheet"/>
	<link href="<?php echo base_url('assets/css/flowchart.css');?>" rel="stylesheet"/>
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<script src="<?=base_url('assets/js/jquery.min.js')?>"></script>
	<script src="<?=base_url('assets/js/jquery-ui.js')?>"></script>
</head>
<body>
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
</body>
</html>