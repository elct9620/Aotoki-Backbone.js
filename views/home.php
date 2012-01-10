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
	<script src="js/underscore-min.js"></script>
	<script src="js/backbone-min.js"></script>
	<script src="js/bootstrap-twipsy.js"></script>
	<script>
		$(function(){
			var Note = Backbone.Model.extend({
				defaults:{},
				initialize : function(){
					this.bind('change', function(){
						console.log('Note has be changed');
					});
				},
				urlRoot : 'api/note',
				idAttribute : 'ID',
			});
			
			var TODOView = Backbone.View.extend({
				tagName : 'div',
				className : 'block-message alert-message info',
				initialize : function(){
					this.model.bind('destroy', this.destroy, this);
				},
				render : function(event){
					$(this.el).html('<a href="#" class="close">×</a><p>' + this.model.get('data') + '</p><div class="alert-actions"><a href="#" class="btn small edit">Edit</a></div>').fadeIn(1000);
					$(this.el).children('.alert-actions').hide();
					return this;
				},
				events : {
					'click .close' : 'clear',
					'click .edit' : 'edit',
					'mouseover' : 'showEdit',
					'mouseleave' : 'hiddenEdit'
				},
				destroy : function(){
					$(this.el).remove();
				},
				clear : function(event){
					this.model.destroy();
				},
				edit : function(e){
					console.log('Edit:', e);
					var note = $(this.el).children('p');
					if(!this.edited){
						note.html('<input type="text" value="'+ note.text() +'" />');
						this.edited = true;
					}else{
						var data = note.children('input').val();
						this.model.set({'data' : data});
						note.html(data);
						this.edited = false;
						this.model.save();
					}			
				},
				showEdit : function(e){
					$(this.el).children('.alert-actions').show();
				},
				hiddenEdit : function(e)
				{
					$(this.el).children('.alert-actions').fadeOut();
				}
			});
			
			var AppView = Backbone.View.extend({
				el : $('#app'),
				render : function(event){
					
				},
				events : {
					'click #add-note' : 'add'
				},
				add : function(event){
					var input = $('input[name=todo]');
					var model = new Note({'data' : input.val()});
					TODOList.create(model);
					input.val('');
				}
			});
			
			var TODOCollection = Backbone.Collection.extend({
				model : Note,
				url : 'api/note'
			});
			
			var TODOList = new TODOCollection();
			
			TODOList.bind('add', function(Note){
				var view = new TODOView({model : Note});
				$('#todo-list').append(view.render().el);
			});
			
			TODOList.bind('reset', function(eventName){
				_.each(TODOList.models, function(Note){
					var view = new TODOView({model : Note});
					$('#todo-list').append(view.render().el);
				});
			});
			
			TODOList.fetch();
			console.log(TODOList);
			
			var App = new AppView();
			
			$('input[name=todo]').twipsy();
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
		<div id="app">
			<div>
				<form action="" id="todo-add" onsubmit="return false;">
					Something TODO : <input type="text" name="todo" title="Type somethings you want to add into list." /> <button id="add-note" type="submit" class="btn primary">Add</button>
				</form>
			</div>
			<div id="todo-list">
				
			</div>
		</div>
		<footer>
		 <p>&copy; Copyright by Aotoki</p>
		</footer>
	</div>
</body>
</html>
