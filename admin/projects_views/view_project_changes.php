<?php
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM `project_list` where id = '{$_GET['id']}'");
    if($qry->num_rows > 0){
        $res = $qry->fetch_array();
        foreach($res as $k => $v){
            if(!is_numeric($k))
            $$k = $v;
        }
    }
}
function duration($dur = 0){
    $hours = floor($dur / (60 * 60));
    $min = floor($dur / (60)) - ($hours*60);
    $dur = sprintf("%'.02d",$hours).":".sprintf("%'.02d",$min);
    return $dur;
}
?>
<div class="content py-4">
    <div class="card card-outline card-navy shadow rounded-0">
        <div class="card-header">
            <h5 class="card-title">Project Details</h5>
            <div class="card-tools">
                <?php if(isset($status) && $status == 1): ?>
                <button class="btn btn-sm btn-default bg-gradient-navy btn-flat" id="close_project">Close Project</button>
                <?php endif; ?>
                <?php if(isset($status) && $status != 2): ?>
                <button class="btn btn-sm btn-primary btn-flat" id="edit_project"><i class="fa fa-edit"></i> Edit Details</button>
                <button class="btn btn-sm btn-danger btn-flat" id="delete_project"><i class="fa fa-trash"></i> Delete Details</button>
                <?php endif; ?>
                <a href="./?page=projects" class="btn btn-default border btn-sm btn-flat"><i class="fa fa-angle-left"></i> Back to List</a>
            </div>
        </div>
        <div class="card-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label text-muted">Project</label>
                            <div class="pl-4"><?= isset($project_title) ? $project_title : 'N/A' ?></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label text-muted">Status</label>
                            <div class="pl-4">
                                <?php 
                                    switch ($status){
                                        case 0:
                                            echo '<span class="rounded-pill badge badge-success bg-gradient-teal px-3">New</span>';
                                            break;
                                        case 1:
                                            echo '<span class="rounded-pill badge badge-primary bg-gradient-primary px-3">In-Progress</span>';
                                            break;
                                        case 2:
                                            echo '<span class="rounded-pill badge badge-dark bg-gradient-dark px-3 text-light">Closed</span>';
                                            break;
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label class="control-label text-muted">Description</label>
                        <div>
                            <?= html_entity_decode($description) ?>
                        </div>
                    </div>
                </div>
                <div class="clear-fix my-3"></div>
                <!-- <h3 class="border-bottom"><b>Reports</b></h3>
                <table class="table table-bordered table-striped">
                    <colgroup>
                        <col width="5%">
                        <col width="15%">
                        <col width="20%">
                        <col width="15%">
                        <col width="10%">
                        <col width="20%">
                        <col width="15%">
                    </colgroup>
                    <thead>
                        <tr class="bg-gradient-primary text-light">
                            <th class="text-center">#</th>
                            <th class="text-center">Date Created</th>
                            <th class="text-center">Employee</th>
                            <th class="text-center">Work Type</th>
                            <th class="text-center">Duration (HH:mm)</th>
                            <th class="text-center">Report</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $i = 1;
                            $qry = $conn->query("SELECT r.*, w.name as work_type, e.code as ecode, CONCAT(e.firstname,' ',e.middlename,' ', e.lastname) as fullname FROM `report_list` r inner join `work_type_list` w on r.work_type_id = w.id inner join employee_list e on r.employee_id = e.id where r.project_id = '{$id}' order by unix_timestamp(r.date_created) desc ");
                            while($row = $qry->fetch_assoc()):
                        ?>
                            <tr>
                                <td class="px-2 py-1 text-center"><?= $i++; ?></td>
                                <td class="px-2 py-1"><?= date("Y-m-d H:i",strtotime($row['date_created'])) ?></td>
                                <td class="px-2 py-1"><?= $row['fullname'] ?></td>
                                <td class="px-2 py-1"><?= $row['work_type'] ?></td>
                                <td class="px-2 py-1 text-right"><?= duration($row['duration']) ?></td>
                                <td class="px-2 py-1"><p class="m-0 truncate-1"><?= strip_tags(html_entity_decode($row['description'])) ?></p></td>
                                <td class="px-2 py-1 text-center">
                                    <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                            Action
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <a class="dropdown-item view_data" href="javascript:void(0)" data-id ="<?php echo $row['id'] ?>"><span class="fa fa-eye text-dark"></span> View</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                            </table>
 -->


    <div>
        
    </div>

    <div>
        
        <div class="bd-example bd-example-flex " style="border: .5px solid black;">
            <div class="d-flex flex-wrap">
                <div class="p-2"><a class="nav-link fontSizeInNav" href="#">OVERVIEW</a></div>
                <div class="p-2"><a class="nav-link fontSizeInNav" href="#">DOCUMENT</a></div>
                <div class="p-2"><a class="nav-link fontSizeInNav" href="#">FINANCE</a></div>
                <div class="p-2"><a class="nav-link fontSizeInNav" href="#">TASKS/MILSTONES</a></div>
                <div class="p-2"> <a class="nav-link fontSizeInNav" href="#">PROJECT SUMMERY</a></div>
                <div class="p-2"> <a class="nav-link fontSizeInNav" href="#">LOGFRAME</a></div>
                <div class="p-2"> <a class="nav-link fontSizeInNav" href="#">PARTICIPANTS</a></div>
                <div class="p-2"> <a class="nav-link fontSizeInNav" href="#">AGREEMENTS</a></div>
                <div class="p-2"> <a class="nav-link fontSizeInNav" href="#">MEMEBERS</a></div>
                <div class="p-2"> <a class="nav-link fontSizeInNav" href="#">PROJECT CHANGES</a></div>
            </div>
        </div>

        <div>

            <div>
                <!-- <div class="row flex-wrap" style="list-style: none;">
                    <li class="" style="width: fit-content;">Project narrative</li>
                    <li class="" style="width: fit-content;">Project information for marketing & communication</li>
                </div> -->
                <!-- <div>

                    <button class="mt-3" type="button" style="border: .5px solid black; border-radius: 5px;">Edit
                        project narrative</button>

                </div> -->
            </div>
            

 <h3 class="border-bottom"><b></b></h3>
 <button class="btn btn-sm btn-success btn-flat" id="edit_project"><i class="fa fa-edit"></i> Add Project Change</button>

                <table class="table table-bordered table-striped">
                    <colgroup>
                        <col width="5%">
                        <col width="15%">
                        <col width="20%">
                        <col width="15%">
                        <col width="10%">
                        <col width="10%">
                    </colgroup>

                    <thead>
                        <tr class="bg-gradient-primary text-light">
                            <th class="text-center">#</th>
                            <th class="text-center">Change Date</th>
                            <th class="text-center">Responsible Officer</th>
                            <th class="text-center">Change type </th>
                            <th class="text-center">Workflow status</th>
                            <th class="text-center">Comments</th>
                        

                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                            $i = 1;
                            $qry = $conn->query("SELECT r.*, w.name as work_type, e.code as ecode, CONCAT(e.firstname,' ',e.middlename,' ', e.lastname) as fullname FROM `report_list` r inner join `work_type_list` w on r.work_type_id = w.id inner join employee_list e on r.employee_id = e.id where r.project_id = '{$id}' order by unix_timestamp(r.date_created) desc ");
                            while($row = $qry->fetch_assoc()):
                        ?>
                            <tr>
                                <td class="px-2 py-1 text-center"><?= $i++; ?></td>
                                <td class="px-2 py-1"><?= date("Y-m-d H:i",strtotime($row['date_created'])) ?></td>
                              
                                <td class="px-2 py-1"><?= $row['fullname'] ?></td>
                                <td class="px-2 py-1 text-right"><?= duration($row['duration']) ?></td>
                                
                                <td class="px-2 py-1"><p class="m-0 truncate-1"><?= strip_tags(html_entity_decode($row['description'])) ?></p></td>
                                <td class="px-2 py-1 text-center">
                                    <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                            Action
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <a class="dropdown-item view_data" href="javascript:void(0)" data-id ="<?php echo $row['id'] ?>"><span class="fa fa-eye text-dark"></span> View</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                            </table>






            
           


        <!-- <nav class="navbar navbar-expand-lg ">
            <div class="container-fluid">
                 <a class="navbar-brand" href="#">Hidden brand</a> 
                 <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button> 
                <div class="flex flex-wrap" id="navbarTogglerDemo01">
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item ">
                            <a class="nav-link fontSizeInNav" href="#">OVERVIEW</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fontSizeInNav" href="#">DOCUMENT</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fontSizeInNav" href="#">FINANCE</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fontSizeInNav" href="#">TASKS/MILSTONES</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fontSizeInNav" href="#">PROJECT SUMMERY</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fontSizeInNav" href="#">LOGFRAME</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fontSizeInNav" href="#">PARTICIPANTS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fontSizeInNav" href="#">AGREEMENTS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fontSizeInNav" href="#">MEMEBERS</a>
                        </li>
    
                        <li class="nav-item">
                            <a class="nav-link fontSizeInNav" href="#">PROJECT CHANGES</a>
                        </li>
                    </ul>
    
                </div>
            </div>
        </nav> -->
    </div>







            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        $('#edit_project').click(function(){
			uni_modal("Update Project Details","projects/manage_project.php?id=<?= isset($id) ? $id : '' ?>")
		})
        $('#edit_project').click(function(){
			uni_modal("Update Project Details","projects/manage_project.php?id=<?= isset($id) ? $id : '' ?>")
		})
        $('#delete_project').click(function(){
			_conf("Are you sure to delete this project?","delete_project",["<?= isset($id) ? $id : '' ?>"])
		})
        $('#close_project').click(function(){
			_conf("Are you sure to close this project?","close_project",["<?= isset($id) ? $id : '' ?>"])
		})
        $('.view_data').click(function(){
			uni_modal("Report Details","projects/view_report.php?id="+$(this).attr('data-id'),"mid-large")
		})
        $('.table td, .table th').addClass('py-1 px-2 align-middle')
		$('.table').dataTable({
            columnDefs: [
                { orderable: false, targets: 5 }
            ],
        });
    })
    function close_project($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=close_project",
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
					location.href="./?page=projects";
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>
