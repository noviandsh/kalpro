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
	<button onClick="coba()">coba</button>
	<button onClick="makeTarget()">target</button>
	<div id="content">
		<div id="diagram-container">
			<div id="diagram-trash">
			TRASH
			</div>
			<div id="start-end-wrap">
				<img id="start-end" class="diagram-shape" src="<?=base_url('assets/img/flowchart-shapes/rounded-rectangle.svg')?>" alt="">
			</div>
			<div id="process-wrap">
				<img id="process" class="diagram-shape" src="<?=base_url('assets/img/flowchart-shapes/rectangle.svg')?>" alt="">
			</div>
			<div id="document-wrap">
				<img id="document" class="diagram-shape" src="<?=base_url('assets/img/flowchart-shapes/wavy-rectangle.svg')?>" alt="">
			</div>
			<div id="decision-wrap">
				<img id="decision" class="diagram-shape" src="<?=base_url('assets/img/flowchart-shapes/diamond.svg')?>" alt="">
			</div>
			<div id="input-output-wrap">
				<img id="input-output" class="diagram-shape" src="<?=base_url('assets/img/flowchart-shapes/parallelogram.svg')?>" alt="">
			</div>
		</div>
		<div class="target">
		</div>
	</div>
	<script>
		function coba() {
			let scheme = [];
			let a = {};
			let n = $('.target>div').length;
			for(i=0;i<n;i++){
				a['target' + (i+1)] = ({'shape' : $('#target-'+(i+1)+'>img').attr('id')});
			}
			scheme.push(a);
			console.log(scheme[0]);
		}
		let drop = 7;
		let arrow = 8;
		function makeTarget(){
			let n = 0;
			let change = true;
			for ( let i=0; i<=9; i++ ) {
				n++;
				if(!change){
					if(n%2 === 0){
						console.log('a - ' + n);
						$('.target').append('<div>droppable - '+drop+'</div>');
						drop++;
					}else{
						console.log('b - ' + n);
						$('.target').append('<div class="arrow">'+arrow+'</div>');
						arrow++;
					}
				}else{
					if(n%2 === 1){
						console.log('b - ' + n);
						$('.target').append('<div class="arrow">'+arrow+'</div>');
						arrow++;
					}else{
						console.log('c - ' + n);
						$('.target').append('<div class="kosong"></div>');
					}
				}
				if(n%5 === 0){
					change = !change;
				}
				// $('<div id="target-'+i+'"></div>').data( 'number', i ).appendTo( '.target' ).droppable({
				// 	accept: '.diagram-shape',
				// 	hoverClass: 'hovered',
				// 	drop: diagramDrop
				// 	// over: diagramOver,
				// 	// out: diagramOut
				// });
			}
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
						console.log('a - ' + n);
						$('.target').append('<div>droppable - '+drop+'</div>');
						drop++;
					}else{
						console.log('b - ' + n);
						$('.target').append('<div class="arrow">'+arrow+'</div>');
						arrow++;
					}
				}else{
					if(n%2 === 0){
						console.log('b - ' + n);
						$('.target').append('<div class="arrow">'+arrow+'</div>');
						arrow++;
					}else{
						console.log('c - ' + n);
						$('.target').append('<div class="kosong"></div>');
					}
				}
				if(n%5 === 0){
					change = !change;
				}
				// $('<div id="target-'+i+'"></div>').data( 'number', i ).appendTo( '.target' ).droppable({
				// 	accept: '.diagram-shape',
				// 	hoverClass: 'hovered',
				// 	drop: diagramDrop
				// 	// over: diagramOver,
				// 	// out: diagramOut
				// });
			}
		}
		$(document).ready(function(){
			firstTarget();

			$('#diagram-trash').droppable({
				accept: '.dropped',
				hoverClass: 'hovered',
				drop: deleteDiagram
			})

			function deleteDiagram(event, ui){
				$(ui.draggable).remove();
				// $(ui.draggable).position({
				// 	of: $(this), my: 'center center', at: 'center center'
				// });
			}

			$('.diagram-shape').draggable({
				stack: '.diagram-shape',
				helper: 'clone',
				cursor: 'move',
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
			function diagramDrop(event, ui) {
				if(ui.draggable.hasClass('dropped')){
					$(this).append($(ui.draggable)).draggable({
							stack: '.diagram-shape',
							cursor: 'move',
							revert: 'invalid'
					});
					$(ui.draggable).position({
						of: $(this), my: 'center center', at: 'center center'
					});
					
				}else{
					let count = $(this)[0].children.length;
					if(count>0){
						
						$($(this)[0].children).remove();
						$(this).append($(ui.draggable).clone().addClass('dropped').draggable({
							stack: '.diagram-shape',
							cursor: 'move',
							revert: 'invalid'
						}));
						$(ui.draggable[1]).position({
							of: $(this), my: 'center center', at: 'center center'
						});
					}else{
						$(this).append($(ui.draggable).clone().addClass('dropped').draggable({
							stack: '.diagram-shape',
							cursor: 'move',
							revert: 'invalid'
						}));
						$(ui.draggable[1]).position({
							of: $(this), my: 'center center', at: 'center center'
						});
					}
				}
				
			}
		})
	</script>
</body>
</html>