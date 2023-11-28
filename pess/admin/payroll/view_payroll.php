<?php
require_once('./../../config.php');
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT e.*, CONCAT(e.last_name, ', ' , e.first_name,' ', COALESCE(e.middle_name,'')) as fullname, d.name as department, p.name as position from `employee_list` e inner join department_list d on e.department_id = d.id inner join position_list p on e.position_id = p.id  where e.id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }
}
?>
<style>
    #uni_modal .modal-footer{
        display:none;
    }
</style>
<div class="container-fluid">
    <dl>
        <dt class="text-muted"><b>Company ID</b></dt>
        <dd class="pl-4"><?= isset($company_id) ? $company_id : "" ?></dd>
        <dt class="text-muted"><b>Name</b></dt>
        <dd class="pl-4"><?= isset($fullname) ? $fullname : "" ?></dd>
        <dt class="text-muted"><b>Gender</b></dt>
        <dd class="pl-4"><?= isset($gender) ? $gender : "" ?></dd>
        <dt class="text-muted"><b>Email</b></dt>
        <dd class="pl-4"><?= isset($email) ? $email : "" ?></dd>
        <dt class="text-muted"><b>Department</b></dt>
        <dd class="pl-4"><?= isset($department) ? $department : "" ?></dd>
        <dt class="text-muted"><b>Position</b></dt>
        <dd class="pl-4"><?= isset($position) ? $position : "" ?></dd>
        <dt class="text-muted"><b>Status</b></dt>
        <dd class="pl-4">
            <?php if($status == 1): ?>
                <span class="badge badge-success px-3 rounded-pill">Active</span>
            <?php else: ?>
                <span class="badge badge-danger px-3 rounded-pill">Inactive</span>
            <?php endif; ?>
        </dd>
    </dl>
    <div class="clear-fix mb-3"></div>
    <div class="text-right">
        <button class="btn btn-dark bg-gradient-dark btn-flat" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
    </div>
</div>