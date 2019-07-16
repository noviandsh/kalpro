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
		<div id="diagram-container">
			<div id="start-end-shape-wrap">
				<img id="start-end-shape" class="diagram-shape" src="<?=base_url('assets/img/flowchart-shapes/rounded-rectangle.svg')?>" alt="">
			</div>
			<div id="process-shape-wrap">
				<img id="process-shape" class="diagram-shape" src="<?=base_url('assets/img/flowchart-shapes/rectangle.svg')?>" alt="">
			</div>
			<div id="document-shape-wrap">
				<img id="document-shape" class="diagram-shape" src="<?=base_url('assets/img/flowchart-shapes/wavy-rectangle.svg')?>" alt="">
			</div>
			<div id="decision-shape-wrap">
				<img id="decision-shape" class="diagram-shape" src="<?=base_url('assets/img/flowchart-shapes/diamond.svg')?>" alt="">
			</div>
			<div id="input-output-shape-wrap">
				<img id="input-output-shape" class="diagram-shape" src="<?=base_url('assets/img/flowchart-shapes/parallelogram.svg')?>" alt="">
			</div>
		</div>
		<div class="target">
		</div>
	</div>
	<script>
		$(document).ready(function(){
			$('.diagram-shape').draggable({
				stack: '.diagram-shape',
				helper: 'clone',
				cursor: 'move',
				revert: 'invalid'
			});

			for ( var i=1; i<=15; i++ ) {
				// $('<div>' + i + '- <span class=count"'+i+'"></span' + '</div>').data( 'number', i ).appendTo( '.target' ).droppable({
				$('<div></div>').data( 'number', i ).appendTo( '.target' ).droppable({
					accept: '.diagram-shape',
					hoverClass: 'hovered',
					drop: diagramDrop
					// over: diagramOver,
					// out: diagramOut
				});
			}
			function diagramOver(event, ui){
				// console.log(ui.draggable);
				if($(this).hasClass('contained')){
					console.log('full');
					// $(this).droppable('option', 'accept', null);
				}
			}
			function diagramOut(event, ui) {
				$(this).removeClass('contained');
					$(this).data('count', 0);
					// console.log('anu');
			}
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
					console.log($(ui.draggable).attr('id'));
					// $(this).data('shape', )
				}
				// ui.draggable.droppable('disable');
				// if ($(this).data('count')) {
				// 	// $(this).droppable('disable');
				// }else{
				// 	ui.draggable.position({
				// 		of: $(this), my: 'center center', at: 'center center'
				// 	});
				// 	let shape = ui.draggable.attr('id');
				// 	let dropped = ui.draggable.attr('class').split(' ')[4];
				// 	if(!ui.draggable.hasClass('dropped')){
				// 		$('<div class="'+shape+'"><div>'+shape+'</div></div>').prependTo('#'+shape+'-wrap').draggable({
				// 			stack: shapes,
				// 			cursor: 'move',
				// 			revert: 'invalid'
				// 		});
				// 	}
				// 	ui.draggable.addClass('dropped');
				// 	$(this).addClass('contained');
				// 	$(this).data('count', 1);
				// }
			}
		})
	</script>
</body>
</html>