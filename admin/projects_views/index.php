<style>
    .img-thumb-path{
        width:100px;
        height:80px;
        object-fit:scale-down;
        object-position:center center;
    }
</style>
<div class="card card-outline card-primary rounded-0 shadow">
	<div class="card-header">
		<h3 class="card-title">List of Projects</h3>
		<div class="card-tools">
			<a href="javascript:void(0)" id="create_new" class="btn btn-flat btn-sm btn-primary"><span class="fas fa-plus"></span>  Add New Project</a>
		</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-bordered table-hover table-striped">
				<colgroup>
					<col width="5%">
					<col width="15%">
					<col width="25%">
					<col width="25%">
					<col width="15%">
					<col width="15%">
				</colgroup>
				<thead>
					<tr class="bg-gradient-primary text-light">
						<th>#</th>
						<th>Project Code</th>
						<th>Project Title</th>
						<th>Project Type</th>
						<th>Start Date</th>
						<th>End Date</th>
						<th>Sector</th>
						<th>Donor</th>
						<th>Total Budget in PKR</th>
						<th>Total Budget in Euro</th>
						<th>Status</th>
						<th>Action</th>
			
					</tr>
				</thead>
				<tbody>
					<?php 
						$i = 1;
						$qry = $conn->query("SELECT * from `project_list` where delete_flag = 0 order by `project_title` asc ");
						while($row = $qry->fetch_assoc()):
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td class=""><p class="m-0 truncate-1"><?php echo $row['project_code'] ?></p></td>
							<td class=""><p class="m-0 truncate-1"><?php echo $row['project_title'] ?></p></td>
							
							<td class="text-center">
								<?php 
									switch ($row['project_type']){
										case 0:
											echo '<span class="rounded-pill badge badge-success bg-gradient-teal px-3">Development</span>';
											break;
										case 1:
											echo '<span class="rounded-pill badge badge-primary bg-gradient-primary px-3">Emergency/Relief</span>';
											break;
										case 2:
											echo '<span class="rounded-pill badge badge-dark bg-gradient-dark px-3 text-light">Research</span>';
											break;
									}
								?>
							</td>
							<td class=""><p class="m-0 truncate-1"><?php echo $row['project_start'] ?></p></td>
							<td class=""><?php echo date("d-m-y",strtotime($row['projct_end'])) ?></td>
							
							<td class="text-center">
								<?php 
									switch ($row['project_sector']){
										case 0:
											echo '<span class="rounded-pill badge badge-success bg-gradient-teal px-3">Food & Nutrition Security</span>';
											break;
										case 1:
											echo '<span class="rounded-pill badge badge-primary bg-gradient-primary px-3">Education</span>';
											break;
										case 2:
											echo '<span class="rounded-pill badge badge-dark bg-gradient-dark px-3 text-light">Health</span>';
											break;
									}
								?>
							</td>
							<td class=""><p class="m-0 truncate-1"><?php echo $row['project_donor'] ?></p></td>
							<td class=""><p class="m-0 truncate-1"><?php echo $row['budget_pkr'] ?></p></td>
							<td class=""><p class="m-0 truncate-1"><?php echo $row['Budget_euro'] ?></p></td>
							<td class="text-center">
								<?php 
									switch ($row['status']){
										case 0:
											echo '<span class="rounded-pill badge badge-success bg-gradient-teal px-3">New</span>';
											break;
										case 1:
											echo '<span class="rounded-pill badge badge-primary bg-gradient-primary px-3">in-progress</span>';
											break;
										case 2:
											echo '<span class="rounded-pill badge badge-dark bg-gradient-dark px-3 text-light">completed</span>';
											break;
									}
								?>
							</td>
							<td align="center">
								 <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
				                  		Action
				                    <span class="sr-only">Toggle Dropdown</span>
				                  </button>
				                  <div class="dropdown-menu" role="menu">
								  	<a class="dropdown-item" href="./?page=projects/view_project&id=<?= $row['id'] ?>" data-id ="<?php echo $row['id'] ?>"><span class="fa fa-eye text-dark"></span> View</a>
									<?php if($row['status'] != 2): ?>
				                    <div class="dropdown-divider"></div>
				                    <a class="dropdown-item edit_data" href="javascript:void(0)" data-id ="<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
				                    <div class="dropdown-divider"></div>
				                    <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
									<?php endif; ?>
				                  </div>
							</td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
        $('#create_new').click(function(){
			uni_modal("Add New Project","projects/manage_project.php")
		})
		$('.view_data').click(function(){
			uni_modal("Project Details","projects/view_project.php?id="+$(this).attr('data-id'))
		})
        $('.edit_data').click(function(){
			uni_modal("Update Project Details","projects/manage_project.php?id="+$(this).attr('data-id'))
		})
		$('.delete_data').click(function(){
			_conf("Are you sure to delete this Project permanently?","delete_project",[$(this).attr('data-id')])
		})
		$('.table td, .table th').addClass('py-1 px-2 align-middle')
		$('.table').dataTable({
            columnDefs: [
                { orderable: false, targets: 5 }
            ],
        });
	})
	function delete_project($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_project",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.reload();
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>