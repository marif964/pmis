<?php
require_once('../../config.php');
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
?>
<style>
	img#cimg{
		height: 17vh;
		width: 25vw;
		object-fit: scale-down;
	}
</style>
<div class="container-fluid">
    <form action="" id="project-form">
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
        <div class="form-group">
            <label for="name" class="control-label">Project Code</label>
            <input type="text" name="code" id="code" class="form-control form-control-border" placeholder="Enter Project Code" value ="<?php echo isset($name) ? $project_code : '' ?>" required>
        </div>
        <div class="form-group">
            <label for="name" class="control-label">Project Title</label>
            <input type="text" name="title" id="title" class="form-control form-control-border" placeholder="Enter Project Title" value ="<?php echo isset($name) ? $project_title : '' ?>" required>
        </div>
        
                            <div class="form-group">
								<label for="tid" class="control-label">Project Type</label>
                                <select name="tid" id="tid" class="form-control form-control-sm select2">
                                    <?php 
                                    $type = $conn->query("SELECT id,name FROM `project_type_list` WHERE 1");
                                    while($row= $type->fetch_assoc()):
                                        if(!isset($tid)){
                                            $tid = $row['id'];
                                        }
                                        if($tid == $row['id'])
                                            $emp = $row['name'];
                                    ?>
                                    <option value="<?= $row['id'] ?>" <?= isset($tid) && $tid == $row['id'] ? "selected" : "" ?>><?= $row['name'] ?></option>
                                    <?php endwhile; ?>
                                </select>
							</div>

        <div class="form-group">
            <label for="start_date" class="control-label">Project Start Date</label>
            <input type="date" name="start_date" id="start_date" class="form-control form-control-border" placeholder="Enter Project start date" value ="<?php echo isset($name) ? $name : '' ?>" required>
        </div>
        <div class="form-group">
            <label for="end_date" class="control-label">Project End Date</label>
            <input type="date" name="end_date" id="name" class="form-control form-control-border" placeholder="Enter Project Name" value ="<?php echo isset($name) ? $name : '' ?>" required>
        </div>
        <div class="form-group">
								<label for="sid" class="control-label">Project Sector</label>
                                <select name="sid" id="sid" class="form-control form-control-sm select2">
                                    <?php 
                                    $type = $conn->query("SELECT id,name FROM `project_sectors` WHERE 1");
                                    while($row= $type->fetch_assoc()):
                                        if(!isset($sid)){
                                            $sid = $row['id'];
                                        }
                                        if($sid == $row['id'])
                                            $emp = $row['name'];
                                    ?>
                                    <option value="<?= $row['id'] ?>" <?= isset($sid) && $sid == $row['id'] ? "selected" : "" ?>><?= $row['name'] ?></option>
                                    <?php endwhile; ?>
                                </select>
		</div>
        <div class="form-group">
								<label for="donor_name" class="control-label">Project Donor</label>
                                <select name="donor_name" id="donor_name" class="form-control form-control-sm select2">
                                    <?php 
                                    $type = $conn->query("SELECT id,name FROM `donor_table` WHERE 1");
                                    while($row= $type->fetch_assoc()):
                                        if(!isset($sid)){
                                            $sid = $row['id'];
                                        }
                                        if($sid == $row['id'])
                                            $emp = $row['name'];
                                    ?>
                                    <option value="<?= $row['id'] ?>" <?= isset($sid) && $sid == $row['id'] ? "selected" : "" ?>><?= $row['name'] ?></option>
                                    <?php endwhile; ?>
                                </select>
		</div>

            

        <!-- <div class="form-group">
            <label for="name" class="control-label">Project Name</label>
            <input type="text" name="name" id="name" class="form-control form-control-border" placeholder="Enter Project Name" value ="<?php echo isset($name) ? $name : '' ?>" required>
        </div>
        <div class="form-group">
            <label for="name" class="control-label">Project Name</label>
            <input type="text" name="name" id="name" class="form-control form-control-border" placeholder="Enter Project Name" value ="<?php echo isset($name) ? $name : '' ?>" required>
        </div>
        <div class="form-group">
            <label for="name" class="control-label">Project Name</label>
            <input type="text" name="name" id="name" class="form-control form-control-border" placeholder="Enter Project Name" value ="<?php echo isset($name) ? $name : '' ?>" required>
        </div>
        <div class="form-group">
            <label for="name" class="control-label">Project Name</label>
            <input type="text" name="name" id="name" class="form-control form-control-border" placeholder="Enter Project Name" value ="<?php echo isset($name) ? $name : '' ?>" required>
        </div>
        <div class="form-group">
            <label for="description" class="control-label">Description</label>
            <textarea rows="3" name="description" id="description" class="form-control form-control-sm rounded-0" required><?php echo isset($description) ? ($description) : '' ?></textarea>
        </div> -->
    </form>
</div>
<script>
    $(function(){
        $('#uni_modal #project-form').submit(function(e){
            e.preventDefault();
            var _this = $(this)
            $('.pop-msg').remove()
            var el = $('<div>')
                el.addClass("pop-msg alert")
                el.hide()
            start_loader();
            $.ajax({
                url:_base_url_+"classes/Master.php?f=save_project",
				data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
				error:err=>{
					console.log(err)
					alert_toast("An error occured",'error');
					end_loader();
				},
                success:function(resp){
                    if(resp.status == 'success'){
                        location.reload();
                    }else if(!!resp.msg){
                        el.addClass("alert-danger")
                        el.text(resp.msg)
                        _this.prepend(el)
                    }else{
                        el.addClass("alert-danger")
                        el.text("An error occurred due to unknown reason.")
                        _this.prepend(el)
                    }
                    el.show('slow')
                    $('html,body,.modal').animate({scrollTop:0},'fast')
                    end_loader();
                }
            })
        })
    })
</script>