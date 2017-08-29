<?php
	if(isset($_GET["year"])){
		$y=$_GET["year"];
		$m=$_GET["month"];
	}else{
		$y=date("Y");
		$m=date("m");
	}
	
	$d=date("d");
	$week=array("日","一","二","三","四","五","六");
	$days=date("t");
	$first=date("w",mktime(0,0,0,$m,1,$y));
	$prev=ceil(date("t",mktime(0,0,0,$m-1,1,$y)));
	$rows=ceil(($days+$first)/7);
	echo $first;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>日历</title>
</head>      
	<style>
		*{margin:0;padding: 0}
		.box{width: 500px;margin: 0 auto}
		h1{text-align: center;background: orange}
		.box table{width: 100%}
		.box th{background: red;height: 30px}
		.box .over{color: red}
		.box .today{color: red}
		.box td{height: 30px;background: orange;text-align: center;}
	</style>                  
<body>
	<div class="box">
		<h1>
			<select name="year" id="year">
			<?php for($ye=1970;$ye<=2038;$ye++){
				if($y==$ye){
					$s="selected";
				}else{
					$s="";
				}
			?>
				<option value="<?php echo $ye;?>"<?php echo $s?>><?php echo $ye;?></option>
			<?php }?>
			</select>
			<select name="month" id="month">
			<?php for($ms=1;$ms<=12;$ms++){
				if($m==$ms){
					$s="selected";
				}else{
					$s="";
				}
			?>
				<option value="<?php echo $ms;?>" <?php echo $s?> ><?php echo $ms;?></option>
			<?php }?>
			</select>
		</h1>
		<table>
			<thead>
				<?php foreach($week as $val){?>
				<th><?php echo $val?></th>
				<?php }?>
			</thead>
		<tbody>
			<?php for($i=0;$i<=$rows;$i++){?>
				<tr>
					<?php for($ds=1;$ds<=7;$ds++){?>
						<td>
							<?php
								$txt=$ds+$i*7-$first;
								echo $txt;
								if($txt<1){
									echo "<span class='over'>".($prev+$txt)."</span>";
								}
								else if($txt>$days){
									echo "<span class='over'>".($txt-$days)."</span>";
								}else{
									if($txt==$d){
										echo "<span class='today'>".$txt."</span>";
									}else{
										echo "<span>".$txt."</span>";
									}
									
								}
							?>
						</td>
					<?php }?>
				</tr>
			<?php }?>
		</tbody>
		</table>
	</div>
	<script>
		var year=document.getElementById('year'),
			month=document.getElementById('month');
			year.onchange=function(){
				location.href="calendar.php?year="+this.value+"&month="+month.value;
			};
			month.onchange=function(){
				location.href="calendar.php?year="+year.value+"&month="+this.value;
			}
	</script>
</body>
</html>