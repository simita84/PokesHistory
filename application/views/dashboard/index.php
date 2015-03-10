
<h1 class="page-header">Profile</h1>
<!--<?php //var_dump($current_user);?>-->
<h4>Welcome !! <?php echo $current_user['first_name']." ".$current_user['last_name'];?>
</h4>
<h3><?php //var_dump($current_poke_history);
	    echo "U have been poked ". $total_pokes_for_current_user['total_poked']." times <br>";?>
	</h3>
<div class="row">
	
	<div class="col-md-8">
		<ul class="nav"> 
		<?php foreach ($current_poke_history as $poke_history) 
		{?>
			<li>
				<?php echo "<b>".$poke_history['poker_username'] ."</b>".
				          " poked "."<b>".$poke_history['poked_person_username']."</b> ". 
			                 $poke_history['times_poked']." times "; ?>
			</li>
<?php	}?>
		</ul>
	</div>
</div>
<div class="row">
	<div class="col-md-8">
		<table class="table table-striped">
			<thead>
				<th>Name</th>
				<th>Email</th>
				<th>Poke history</th>
				<th>Action</th>
			</thead>
			<tbody>
				<?php foreach ($all_users_pokes as $user) 
				{?>
					 <tr>
					 	<td><?php echo $user['name'] ;?></td>
					    <td><?php echo $user['username']; ?></td>
					    <td><?php echo $user['poke_count']; ?></td>
					    <td>
					    	<a href="/dashboard/create_poke/<?=$current_user['user_id']?>/<?=$user['id']?>" 
					    		class="btn btn-default">Poke</a>
					    </td>
					 </tr>
		<?php 	}?>
			</tbody>
		</table>
	</div>
</div>
<!--<?php //var_dump($all_users_pokes);?>-->
 