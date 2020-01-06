<?php require_once 'includes/class-autoload.inc.php'; ?>
<?php require_once 'includes/check_unlogin.inc.php'; ?>
<?php $uri_name = substr(stristr(strrchr($_SERVER['REQUEST_URI'] ,'/') ,'_', true), 1); ?>
<?php

$ingtDB = array('1' => 'oils', '2' => 'eggs', '3' => 'seas', '4' => 'meats', '5' => 'vegetables', '6' => 'ran', '7' => 'nas', '8' => 'milks', '9' => 'fruits', '10' => 'garnishs');
$ingt = array('1' => 'น้ำมัน', '2' => 'ไข่', '3' => 'สัตว์น้ำ', '4' => 'สัตว์บก', '5' => 'ผัก', '6' => 'ข้าวและเส้น', '7' => 'ถั่วและงา', '8' => 'นม', '9' => 'ผลไม้', '10' => 'เครื่องปรุง');

$ings = new ingredientsview();
$type[1] = $ings->getType(2, 1);
$type[2] = $ings->getType(2, 2);
$type[3] = $ings->getType(2, 3);
$type[4] = $ings->getType(2, 4);
$type[5] = $ings->getType(2, 5);
$type[6] = $ings->getType(2, 6);
$type[7] = $ings->getType(2, 7);
$type[8] = $ings->getType(2, 8);
$type[9] = $ings->getType(2, 9);
$type[10] = $ings->getType(2, 10);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php require_once 'includes/head.inc.php'; ?>
</head>
<body data-name="<?php echo $uri_name;?>">
	<?php require_once 'includes/nav_defalut.inc.php'; ?>
	<div class="container">
		<div class="text-center">
			<div class="h1">สร้างเมนูอาหาร</div>
			<div class="h2 mb-5">New Food</div>
		</div>
		<ul class="nav nav-tabs" id="myTab" role="tablist">
			<?php for ($i = 1; $i <= sizeof($ingt); $i++) { ?>
				<li class="nav-item ">
					<a class="nav-link text-dark <?php if($i==1)echo 'active';?>" id="nav-<?=$i;?>-tab" data-toggle="tab" href="#nav-<?=$i;?>" role="tab" aria-controls="nav-<?=$i;?>" aria-selected="false" name="<?=$i;?>" onclick="return search_product(null, this.name);"><?=$ingt[$i];?></a>
				</li>
			<?php } ?>
			<li class="nav-item">
				<a class="nav-link text-light bg-info" data-toggle="" href="foods_add.php">เมนูของฉัน</a>
			</li>
			<li class="nav-item">
				<a class="nav-link text-light bg-warning" data-toggle="" href="add_ingredients.php">เพิ่มวัตถุดิบ</a>
			</li>
		</ul>
		<div class="tab-content" id="myTabContent">
			<?php for ($i = 1; $i <= sizeof($ingt); $i++) { ?>
				<div class="tab-pane fade <?php if($i==1)echo 'show active';?>" id="nav-<?=$i;?>" role="tabpanel" aria-labelledby="nav-<?=$i;?>-tab">
					<div class="form-group row justify-content-sm-center">
						<div class="col-10">
							<input type="text" id="s_data" name="<?=$i;?>" class="form-control data" placeholder="ชื่อวัตถุดิบ" onkeyup="return search_product(this.value, this.name);" data-type="<?=$i;?>">
						</div>
					</div>
					<div class="text-center this" id="ingtr<?=$i;?>">
						<?php for ($j = 0; $j < sizeof($type[$i]); $j++) { ?>
							<div class="card">
								<img src="dist/img/ingredients/<?php echo $type[$i][$j]['ing_img'];?>" class="card-img-top mx-auto" alt="...">
								<div class="card-body text-center">
									<h5 class="card-title"><?php echo $type[$i][$j]['ing_name'];?></h5>
									<p class="card-text"><?php echo $type[$i][$j]['ing_unit']." กรัม ";?>: <?php echo $type[$i][$j]['ing_kcal']." แคลอรี่ ";?></p>
									<button type="button" name="<?php echo $type[$i][$j]['ing_id']?>" id="add" class="btn btn-outline-success" onclick="return send_data(this.name);"><i class="fal fa-cart-plus"></i></button>
								</div>
							</div>
						<?php } ?>
					</div>
					<br>
					<div class="text-center">
						<div class="btn-group" role="group">
							<?php if($i != 1){ ?>
								<a class="btn btn-secondary btnPrevious">ย้อนกลับ</a>
							<?php } ?>
							<?php if($i != 10){ ?>
								<a class="btn btn-info btnNext">ถัดไป</a>
							<?php }else{ ?>
								<a class="btn btn-info btnNext" href="show.php">ถัดไป</a>
							<?php } ?>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>
<?php
unset($ings);
unset($type);
?>
<script src="dist/js/myjs.js"></script>
</body>
</html>