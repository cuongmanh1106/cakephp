  <div class="panel panel-primary">
    <div class="panel-heading">
    	Book List
    	<?php 
    		echo $this->Html->link(
    			"Create",
    			"/book/create",
    			[
    				"class" => "btn btn-success"
    			]
    		)
    	?>
	</div>
    <div class="panel-body">
		<div class="input-group">
			<input type="hidden" value="<?php echo $url?>book/search" name="search_url" id="search_url">
		  <input type="text" class="form-control" placeholder="Search" name="search" id="search">
		  <div class="input-group-btn">
		    <button class="btn btn-default" type="button" id="search-button"><i class="glyphicon glyphicon-search"></i></button>
		  </div>
		</div>
    	<table class="table">
		    <thead>
		      <tr>
		        <th>Sr No</th>
		        <th>Book Name</th>
		        <th>Author</th>
		        <th>Email Address</th>
		        <th>Book Image</th>
		        <th>Action</th>
		      </tr>
		    </thead>
		    <tbody>
		    	<?php
		    		$count = 1 ;
		    		foreach($books as $key=>$book){
		    	?>
		      <tr>
		        <td><?php echo $count++ ?></td>
		        <td><?php echo $book->name ?></td>
		        <td><?php echo $book->author ?></td>
		        <td><?php echo $book->email ?></td>
		        <td><img src="<?php echo $this->Url->image($book->img); ?>" width="100px"  /></td>
		        <td>
		        	<?php
		        		echo $this->Html->link(
		        			"Edit",
		        			"/book/edit/".$book->id,
		        			[
		        				"class" => "btn btn-info"
		        			]
		        		); 

		        		echo $this->Html->link(
		        			"Delete",
		        			"/book/delete/".$book->id,
		        			[
		        				"class" => "btn btn-danger"
		        			]
		        		); 
		        	?>
		        	
		        </td>
		      </tr>
		      <?php }?>      
		    </tbody>
		  </table>
    </div>
  </div>