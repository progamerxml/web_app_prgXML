<?php
require_once('./../../config.php');
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `employee_list` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }
}
?>
<div class="container-fluid">
    <form action="" id="employee-form">
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="company_id" class="control-label">Company ID</label>
                    <input name="company_id" id="company_id" class="form-control rounded-0 form no-resize"
                        value="<?php echo isset($company_id) ? $company_id : ''; ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="first_name" class="control-label">First Name</label>
                    <input name="first_name" id="first_name" class="form-control rounded-0 form no-resize"
                        value="<?php echo isset($first_name) ? $first_name : ''; ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="middle_name" class="control-label">Middle Name</label>
                    <input name="middle_name" id="middle_name" class="form-control rounded-0 form no-resize"
                        value="<?php echo isset($middle_name) ? $middle_name : ''; ?>" placeholder="optional">
                </div>
                <div class="form-group mb-3">
                    <label for="last_name" class="control-label">Last Name</label>
                    <input name="last_name" id="last_name" class="form-control rounded-0 form no-resize"
                        value="<?php echo isset($last_name) ? $last_name : ''; ?>" required>
                </div>
                <div class="form-group mb-3">
                    <label for="email" class="control-label">Email</label>
                    <input name="email" id="email" class="form-control rounded-0 form no-resize"
                        value="<?php echo isset($email) ? $email : ''; ?>" required>
                </div>
            </div>
            <div class="col-md-6">
				<div class="form-group mb-3">
                    <label for="department_id" class="control-label">Department</label>
                    <select name="department_id" id="department_id" class="custom-select rounded-0 select2">
                        <option disabled <?php echo !isset($department_id) ? 'selected' : '' ?>></option>
						<?php 
						$departments = $conn->query("SELECT * FROM `department_list` where status = 1 and delete_flag = 0 ".(isset($department_id) ? " or id = '{$department_id}' " : "" )." order by `name` asc");
						while($row = $departments->fetch_assoc()):
						?>
							<option value="<?= $row['id'] ?>" <?= isset($department_id) && $department_id == $row['id'] ? "selected" : ""  ?>><?= $row['name'] ?></option>
						<?php endwhile; ?>
                    </select>
                </div>
				<div class="form-group mb-3">
                    <label for="position_id" class="control-label">Position</label>
                    <select name="position_id" id="position_id" class="custom-select rounded-0 select2">
                        <option disabled <?php echo !isset($position_id) ? 'selected' : '' ?>></option>
						<?php 
						$positions = $conn->query("SELECT * FROM `position_list` where status = 1 and delete_flag = 0 ".(isset($position_id) ? " or id = '{$position_id}' " : "" )." order by `name` asc");
						while($row = $positions->fetch_assoc()):
						?>
							<option value="<?= $row['id'] ?>" <?= isset($position_id) && $position_id == $row['id'] ? "selected" : ""  ?>><?= $row['name'] ?></option>
						<?php endwhile; ?>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="gender" class="control-label">Gender</label>
                    <select name="gender" id="gender" class="custom-select rounded-0">
                        <option <?php echo isset($gender) && $gender == 'Male' ? 'selected' : '' ?>>Male</option>
                        <option <?php echo isset($gender) && $gender == '0' ? 'selected' : '' ?>>Female
                        </option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="status" class="control-label">Status</label>
                    <select name="status" id="status" class="custom-select rounded-0">
                        <option value="1" <?php echo isset($status) && $status == 1 ? 'selected' : '' ?>>Active</option>
                        <option value="0" <?php echo isset($status) && $status == 0 ? 'selected' : '' ?>>Inactive
                        </option>
                    </select>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
$(document).ready(function() {
	$('#uni_modal').on('shown.bs.modal',function(){
		$('.select2').select2({
			placeholder:"Please Select Here.",
			width:'100%',
			dropdownParent:$('#uni_modal')
		})
	})
    $('#employee-form').submit(function(e) {
        e.preventDefault();
        var _this = $(this)
        $('.err-msg').remove();
        start_loader();
        $.ajax({
            url: _base_url_ + "classes/Master.php?f=save_employee",
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            dataType: 'json',
            error: err => {
                console.log(err)
                alert_toast("An error occured", 'error');
                end_loader();
            },
            success: function(resp) {
                if (typeof resp == 'object' && resp.status == 'success') {
                    location.reload();
                } else if (resp.status == 'failed' && !!resp.msg) {
                    var el = $('<div>')
                    el.addClass("alert alert-danger err-msg").text(resp.msg)
                    _this.prepend(el)
                    el.show('slow')
                    $("html, body").animate({
                        scrollTop: _this.closest('.card').offset().top
                    }, "fast");
                    end_loader()
                } else {
                    alert_toast("An error occured", 'error');
                    end_loader();
                    console.log(resp)
                }
            }
        })
    })
})
</script>