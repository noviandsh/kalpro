<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link href="<?php echo base_url('assets/css/jquery-ui.css');?>" rel="stylesheet"/>
	<link href="<?php echo base_url('assets/css/flowchart.css');?>" rel="stylesheet"/>
	<script src="<?=base_url('assets/js/jquery.min.js')?>"></script>
	<script src="<?=base_url('assets/js/jquery-ui.js')?>"></script>
	<script src="<?=base_url('assets/js/jquery-collision.js')?>"></script>
</head>
<body>
	<div id="col-container">
		<div id="bigbox-1" class="bigbox">1</div>
		<div id="smallbox-1" class="smallbox">1</div>
		<div id="bigbox-2" class="bigbox">2</div>
		<div id="smallbox-2" class="smallbox">2</div>
		<div id="bigbox-3" class="bigbox">3</div>

		<div id="smallbox-3" class="smallbox">3</div>
		<div></div>
		<div id="smallbox-4" class="smallbox">4</div>
		<div></div>
		<div id="smallbox-5" class="smallbox">5</div>

		<div id="bigbox-4" class="bigbox">4</div>
		<div id="smallbox-6" class="smallbox">6</div>
		<div id="bigbox-5" class="bigbox">5</div>
		<div id="smallbox-7" class="smallbox">7</div>
		<div id="bigbox-6" class="bigbox">6</div>

<div id="smallbox-3" class="smallbox">3</div>
<div></div>
<div id="smallbox-4" class="smallbox">4</div>
<div></div>
<div id="smallbox-5" class="smallbox">5</div>

<div id="bigbox-4" class="bigbox">4</div>
<div id="smallbox-6" class="smallbox">6</div>
<div id="bigbox-5" class="bigbox">5</div>
<div id="smallbox-7" class="smallbox">7</div>
<div id="bigbox-6" class="bigbox">6</div>

<div id="smallbox-3" class="smallbox">3</div>
<div></div>
<div id="smallbox-4" class="smallbox">4</div>
<div></div>
<div id="smallbox-5" class="smallbox">5</div>

<div id="bigbox-4" class="bigbox">4</div>
<div id="smallbox-6" class="smallbox">6</div>
<div id="bigbox-5" class="bigbox">5</div>
<div id="smallbox-7" class="smallbox">7</div>
<div id="bigbox-6" class="bigbox">6</div>
		
	</div>
	<script>
		$('.smallbox').click(function(){
			let collision = $(this).collision('.bigbox', {
				relative: 'obstacle',
				as: '<div/>',
				colliderData: 'cdata',
				obstacleData: 'odata',
				directionData: 'ddata'
			});
			// console.log($(collision));
			for(let i=0; i<collision.length; i++){
				let o = $(collision[i]).data("odata");
				let c = $(collision[i]).data("cdata");
				let d = $(collision[i]).data("ddata");

				let coba = $(o).get(0).id;
				console.log(coba);
				console.log(d);
				// console.log(dir);
			}
		})
	</script>
</body>
</html>
