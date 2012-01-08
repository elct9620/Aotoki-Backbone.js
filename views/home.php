<!DOCTYPE html>
<html lang="zh-tw">
<head>
	<meta charset="utf-8" />

	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Backbone - TODO List</title>
	<meta name="description" content="" />
	<meta name="author" content="Aotoki" />

	<meta name="viewport" content="width=device-width; initial-scale=1.0" />
	
	<link rel="stylesheet" href="style/bootstrap.min.css" />
	<style>
		.container{
			margin:15px auto;
		}
	</style>
	<script src="js/jquery-1.7.1.min.js"></script>
	<script src="js/backbone-min.js"></script>
	<script>
		$(function(){
			var Note = Backbone.Model.extend({
				defaults:{},
				initialize : function(){
					this.bind('change', function(){
						console.log('Note has be changed');
					});
				}
			});
			
			var TODOView = Backbone.View.extend({
				el : $('#todo-list'),
				render : function(event){
					
				},
				events : {
					'submit #todo-add' : 'add'
				},
				add : function(event){
					TODOList.add(new Note());
				}
			});
			
			var TODOCollection = Backbone.Collection.extend({
				model : Note
			});
			
			TODOList.bind('add', function(Note){
				console.log('New Model Add');	
			});
			
			var TODOList = new TODOCollection();
		});
	</script>
</head>

<body>
	<div class="container">
		<header>
			<h1>Backbone TODO List</h1>
		</header>
		<nav>
			<ul class="breadcrumb">
				<li><a href="<?php echo $app->request()->getRootUri(); ?>">Home</a></li>
			</ul>
		</nav>
		<div>
			<form action="" id="todo-add">
				<input type="text" name="todo" /> <button type="submit" class="btn primary">Add</button>
			</form>
		</div>
		<div id="todo-list">
			
		</div>

		<footer>
		 <p>&copy; Copyright by Aotoki</p>
		</footer>
	</div>
</body>
</html>
