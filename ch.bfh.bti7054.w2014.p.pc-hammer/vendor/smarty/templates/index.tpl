<div class='row'>
	<h1>{$name}</h1>
	<div class='col-xs-3 col-sm-3'>
		<img src='{$imgpath}{$image}' width=100px height=100px />;	
	</div>
	<div class='col-xs-6 col-sm-6'>
		<table class='table'>
			<tr><td>{$langprice}</td><td>{$price}</td><tr>
			<tr><td>{$langtype}</td><td>{$type}</td><td></tr>
			<tr><td>{$langquantAvailable}</td><td>{$quantAvailable}</td></tr>
			<tr><td><input type="text" style="float: right; width: 40px; height: 35px;" disabled name="quantity" id="{$prodid}" value='1'/>
			<div class='btn-group' role='group' aria-label='...'>
				<button class="btn btn-default" onClick="increase({$prodid}, {$quantAvailable})">+</button>
				<button class="btn btn-default" onClick="decrease('{$prodid}')">-</button>
			</div>
			</td><td>
			<button class="btn btn-default" onclick={$jsfunction}>{$langtocart}</button></td></tr>
		</table>
	</div>
</div>