<?php if($_settings->chk_flashdata('success')): ?>
<script>
alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
</script>
<?php endif;?>

<?php 
if(isset($_GET['payroll_id'])){
    $qry = $conn->query("SELECT * FROM `payroll_list` where id = '{$_GET['payroll_id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_array() as $k=> $v){
            if(!is_numeric($k))
            $$k = $v;
        }
    }
}
?>
<div class="card card-outline card-primary rounded-0 shadow">
    <div class="card-header">
        <h3 class="card-title">Payslip List</h3>
        <div class="card-tools">
            <button type="button" id="create_new" class="btn btn-flat btn-primary btn-sm"><span class="fas fa-plus"></span> Create New</button>
            <button type="button" id="generate_payslips" class="btn btn-default border btn-default border btn-sm"><span class="fas fa-money-check-alt"></span> Generate Payslips PDF</button>
            <button type="button" id="send_payslips" class="btn btn-default border btn-default border btn-sm"><span class="fas fa-mail-bulk"></span> Send Payslips</button>
        </div>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <fieldset class='border py-2 px-1 mb-3'>
                <legend class="w-auto">Payroll Details</legend>
                <div class="row">
                    <div class="col-md-6">
                        <dl class="d-flex">
                            <dt>Code: </dt>
                            <dd class="px-3"><?= $code ?></dd>
                        </dl>
                        <dl class="d-flex">
                            <dt>Type: </dt>
                            <dd class="px-3">
                            <?php 
                                switch($type){
                                    case 1:
                                        echo '<span class="badge badge-primary bg-gradient px-3 rounded-pill">Monthly</span>';
                                        break;
                                    case 2:
                                        echo '<span class="badge badge-warning bg-gradient px-3 rounded-pill">Semi-Monthly</span>';
                                        break;
                                    case 3:
                                        echo '<span class="badge badge-default border bg-gradient px-3 rounded-pill">Daily</span>';
                                        break;
                                }
                            ?>
                            </dd>
                        </dl>
                    </div>
                    <div class="col-md-6">
                        <dl class="d-flex">
                            <dt>Start Date: </dt>
                            <dd class="px-3"><?= date("M d, Y", strtotime($start_date)) ?></dd>
                        </dl>
                        <dl class="d-flex">
                            <dt>End Date: </dt>
                            <dd class="px-3"><?= date("M d, Y", strtotime($end_date)) ?></dd>
                        </dl>
                    </div>
                </div>
            </fieldset>
            <table class="table table-bordered table-stripped">
                <colgroup>
                    <col width="5%">
                    <col width="20%">
                    <col width="30%">
                    <col width="15%">
                    <col width="20%">
                    <col width="10%">
                </colgroup>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date Added</th>
                        <th>Employee</th>
                        <th>Net</th>
                        <th>File</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
					$i = 1;
						$qry = $conn->query("SELECT p.*, CONCAT(e.last_name, ', ' , e.first_name,' ', COALESCE(e.middle_name,'')) as fullname, e.company_id from `payslip_list` p inner join employee_list e on p.employee_id = e.id where p.payroll_id = '{$id}'");
						while($row = $qry->fetch_assoc()):
					?>
                    <tr>
                        <td class="text-center"><?php echo $i++; ?></td>
                        <td><?php echo date("Y-m-d H:i",strtotime($row['date_created'])) ?></td>
                        <td><?php echo $row['company_id'].' - '.$row['fullname'] ?></td>
                        <td><?php echo number_format($row['net'],2) ?></td>
                        <td>
                            <?php if(!empty($row['file_path'])): ?>
                                <a href="<?= base_url.($row['file_path']) ?>" target="_blank"><?= str_replace('uploads/payslips/','',$row['file_path']) ?></a>
                            <?php else: ?>
                                    <center>Not Generated Yet</center>
                            <?php endif; ?>
                        </td>
                        <td align="center">
                            <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon"
                                data-toggle="dropdown">
                                Action
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu">
                                <a class="dropdown-item view_data" href="javascript:void(0)"
                                    data-id="<?php echo $row['id'] ?>"><span class="fa fa-eye text-dark"></span>
                                    View</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item generate_payslip" href="javascript:void(0)"
                                    data-id="<?php echo $row['id'] ?>"><span class="fa fa-money-check-alt"></span>
                                    Generate Payslip PDF</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item send_payslip" href="javascript:void(0)"
                                    data-id="<?php echo $row['id'] ?>"><span class="fa fa-envelope-open-text"></span>
                                    Send Payslip</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item edit_data" href="javascript:void(0)"
                                    data-id="<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span>
                                    Edit</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item delete_data" href="javascript:void(0)"
                                    data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span>
                                    Delete</a>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $('#create_new').click(function() {
        uni_modal("Add New Payslip", "payroll/manage_payslip.php?payroll_id=<?= isset($id) ? $id: '' ?>", 'large');
    })
    $('.edit_data').click(function() {
        uni_modal("Edit Payslip", "payroll/manage_payslip.php?payroll_id=<?= isset($id) ? $id: '' ?>&id=" + $(this).attr('data-id'), 'large');
    })
    $('.view_data').click(function() {
        uni_modal("View Payslip", "payroll/view_payslip.php?id=" + $(this).attr('data-id'), 'large');
    })
    $('.delete_data').click(function() {
        _conf("Are you sure to delete this payslip permanently?", "delete_payslip", [$(this).attr(
            'data-id')])
    })
    $('.table').dataTable({
		columnDefs: [{
			orderable: false,
			targets: [5]
		}],
		initComplete: function(settings, json) {
			$('.table').find('th, td').addClass('px-2 py-1 align-middle')
		},
		drawCallback: function(settings) {
			$('.table').find('th, td').addClass('px-2 py-1 align-middle')
		}
    });
    $('#generate_payslips').click(function(){
        _conf("Are you sure to generate the PDF payslips for this payroll?",'generate_payslips',[])
    })
    $('.generate_payslip').click(function(){
        _conf("Are you sure to generate a PDF for this payslip?",'generate_payslip',[$(this).attr('data-id')])
    })
    $('#send_payslips').click(function(){
        _conf("Are you sure to send the generated PDF's payslips of employees for this payroll?",'send_payslips',[])
    })
    $('.send_payslip').click(function(){
        _conf("Are you sure to send the generated PDF payslip of this employee for this payroll?",'send_payslip',[$(this).attr('data-id')])
    })
})
function generate_payslips(){
    start_loader();
    $.ajax({
        url: _base_url_ + "classes/Master.php?f=payroll_generate_payslips",
        method: "POST",
        data: {
            id: '<?= isset($id) ? $id : '' ?>'
        },
        dataType: "json",
        error: err => {
            console.log(err)
            alert_toast("An error occured.", 'error');
            end_loader();
        },
        success: function(resp) {
            if (typeof resp == 'object' && resp.status == 'success') {
                location.reload();
            } else {
                alert_toast("An error occured.", 'error');
                end_loader();
            }
        }
    })
}

function generate_payslip($id){
    start_loader();
    $.ajax({
        url: _base_url_ + "classes/Master.php?f=payroll_generate_payslips_single",
        method: "POST",
        data: {
            id: $id
        },
        dataType: "json",
        error: err => {
            console.log(err)
            alert_toast("An error occured.", 'error');
            end_loader();
        },
        success: function(resp) {
            if (typeof resp == 'object' && resp.status == 'success') {
                location.reload();
            } else {
                alert_toast("An error occured.", 'error');
                end_loader();
            }
        }
    })
}
function send_payslips(){
    start_loader();
    $.ajax({
        url: _base_url_ + "classes/Master.php?f=send_payslip",
        method: "POST",
        data: {
            id: '<?= isset($id) ? $id : '' ?>'
        },
        dataType: "json",
        error: err => {
            console.log(err)
            alert_toast("An error occured.", 'error');
            end_loader();
        },
        success: function(resp) {
            if (typeof resp == 'object' && resp.status == 'success') {
                location.reload();
            } else {
                alert_toast("An error occured.", 'error');
                end_loader();
            }
        }
    })
}

function send_payslip($id){
    start_loader();
    $.ajax({
        url: _base_url_ + "classes/Master.php?f=send_payslip_single",
        method: "POST",
        data: {
            id: $id
        },
        dataType: "json",
        error: err => {
            console.log(err)
            alert_toast("An error occured.", 'error');
            end_loader();
        },
        success: function(resp) {
            if (typeof resp == 'object' && resp.status == 'success') {
                location.reload();
            } else {
                alert_toast("An error occured.", 'error');
                end_loader();
            }
        }
    })
}
function delete_payslip($id) {
    start_loader();
    $.ajax({
        url: _base_url_ + "classes/Master.php?f=delete_payslip",
        method: "POST",
        data: {
            id: $id
        },
        dataType: "json",
        error: err => {
            console.log(err)
            alert_toast("An error occured.", 'error');
            end_loader();
        },
        success: function(resp) {
            if (typeof resp == 'object' && resp.status == 'success') {
                location.reload();
            } else {
                alert_toast("An error occured.", 'error');
                end_loader();
            }
        }
    })
}
</script>