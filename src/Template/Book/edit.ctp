<div class="panel panel-primary">
    <div class="panel-heading">
    Book Edit
    <?php 
    	echo $this->Html->link(
    		"<Back>",
    		"/book",
    		[
    			"class" => "btn btn-info pull-right",
    			"style" => "margin-top: -6px"
    		]
    	);
    ?>
	</div>
    <div class="panel-body">
    	<?php echo $this->Form->create(
    		null,
    		[
    			'type'=>'file',
    			"class" => "form-horizontal"
    		]
    		);
    	?>
		  <div class="form-group">
		    <label class="control-label col-sm-2" for="name">Name:</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" name="name" value="<?php echo $book->name ?>" id="name" placeholder="Enter name">
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="control-label col-sm-2" for="author">Author:</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" name="author" value="<?php echo $book->author ?>" id="author" placeholder="Enter Author">
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="control-label col-sm-2" for="email">Email ID:</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" name="email" value="<?php echo $book->email ?>"  id="email" placeholder="Enter Author">
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="control-label col-sm-2" for="description">Description:</label>
		    <div class="col-sm-10">
		      <textarea class="form-control" name="description" id="description"  placeholder="Enter Description">
		      	<?php echo $book->description ?>
		      </textarea>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="control-label col-sm-2" for="email">Upload:</label>
		    <div class="col-sm-10">
		      <input type="file" class="form-control" name="file"  id="file">
		    </div>
		  </div>
		 
		  <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		      <button type="submit" class="btn btn-success">Submit</button>
		    </div>
		  </div>
		<?php echo $this->Form->end() ?>
    </div>
</div>

