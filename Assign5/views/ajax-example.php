<html>
	<body>
	
	<form method="post">
		<?php if(isset($data["columns"])){ 
			$columns = $data["columns"];
			foreach ($columns as $key => $column) {
			?>
				<div class="share">
					<div class="symbol"><?php echo $column ?></div>
					<div id="<?php echo $column; ?>" class="price"></div>
					<button type="submit" name="delete" id="<?php echo $key; ?>" class="delete">Delete</button>
				</div>
		<?php }}?>
	</form>
		<a href=":javascript" id="add">Add</a>
		
		<form action="Controller.php" method="post">
			<button type="submit" name="logout">Logout</button>
		</form>
		<form method="post" class="add">
			<input type="text" name="column" id="column" placeholder="Enter name">
			<button name="save" id="save" type="submit">Save</button>
		</form>

		<script src="js/jquery.min.js"></script>
		
		<script>
			$(function(){
				var symbols; // comma-separated symbols string

				var populate_symbols = function(){
					symbols = '';
					$('div.price').each(function(){
						var id = $(this).attr('id');
						symbols += id + ',';
					});
				};


				var populate_prices = function(resp){
					//var jresp = JSON.parse(resp);
					//console.log(jresp);
					for(var s in resp){
						//console.log(s);
						var price = parseFloat(resp[s]);
						var old_price = parseFloat($('#' + s).text());
						$('#' + s).html(price);

						if(old_price > price){
							$('#' + s).removeClass('up');
							$('#' + s).addClass('down');
						}else{
							$('#' + s).addClass('up');
							$('#' + s).removeClass('down');
						}
					}
				};
				
				var update = function(){
					$.ajax({
						url: 'ticker.php',
						data: {'symbols': symbols},
						success: populate_prices,
						error: function(){
						}
					});
				};



				$(".share").on("click", "button", function(event){
					var $this = $(this);
					$.ajax({
						// url: "database.php",
						data: {"id": $this.attr("id")},
						success: function(data){	
							// console.log(data);
							$this.parent().slideUp(500, function(){
								$this.parent().remove();
							});
						},
						error : function(data){
							console.log(JSON.parse(data));
						}
					});

					event.preventDefault();

				});

				$("#add").on("click", function(event){
					event.preventDefault();
					$(".add").slideDown(500);
				});


				$("#save").on("click", function(event){
					
					$column = $("#input").val();
					$.ajax({
						data: {"column": $column},
						
						success: function(data){	

							$(this).parent().slideUp(500);


						},
						
						error : function(data){
							console.log(JSON.parse(data));
						}
					});
				});

				populate_symbols();
				setInterval(update, 2000);
			});
			
		</script>
		
		<style>
			.share{
				border: solid 1px black;
				padding: 10px;
				width: 25%;
				float: left;
			}

			.symbol{ font-weight: bold; }
			.price.down{ color: red;}
			.price.up{ color: green; }

			
			.delete{
				float: right;
				font-weight: bold;
			}

			.delete:hover{
				cursor: pointer;
			}

			.add{
				display: none;
			}
		</style>
	</body>
</html>