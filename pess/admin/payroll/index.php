<?php if($_settings->chk_flashdata('success')): ?>
<script>
alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
</script>
<?php endif;?>
<div class="card card-outline card-primary rounded-0 shadow">
    <div class="card-header">
        <h3 class="card-title">List of Payroll</h3>
        <div class="card-tools">
            <button type="button" id="create_new" class="btn btn-flat btn-primary btn-sm"><span
                    class="fas fa-plus"></span> Create New</button>
        </div>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <table class="table table-bordered table-stripped">
                <colgroup>
                    <col width="5%">
                    <col width="20%">
                    <col width="20%">
                    <col width="15%">
                    <col width="15%">
                    <col width="15%">
                    <col width="10%">
                </colgroup>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date Added</th>
                        <th>Code</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Type</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
					$i = 1;
						$qry = $conn->query("SELECT * from `payroll_list` where delete_flag = 0 order by unix_timestamp(`start_date`) desc, unix_timestamp(`end_date`) desc ");
						while($row = $qry->fetch_assoc()):
					?>
                    <tr>
                        <td class="text-center"><?php echo $i++; ?></td>
                        <td><?php echo date("Y-m-d H:i",strtotime($row['date_created'])) ?></td>
                        <td><?php echo $row['code'] ?></td>
                        <td><?php echo date("M d, Y", strtotime($row['start_date'])) ?></td>
                        <td><?php echo date("M d, Y", strtotime($row['end_date'])) ?></td>
                        <td class="text-center">
                            <?php 
                            switch($row['type']){
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
                        </td>
                        <td align="center">
                            <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon"
                                data-toggle="dropdown">
                                Action
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu">
                                <a class="dropdown-item" href="./?page=payroll/payslip_list&payroll_id=<?= $row['id'] ?>"
                                    data-id="<?php echo $row['id'] ?>"><span class="fa fa-eye text-dark"></span>
                                    View</a>
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
        uni_modal("Add New Payroll", "payroll/manage_payroll.php");
    })
    $('.edit_data').click(function() {
        uni_modal("Edit Payroll", "payroll/manage_payroll.php?id=" + $(this).attr('data-id'));
    })
    $('.view_data').click(function() {
        uni_modal("View Payroll", "payroll/view_payroll.php?id=" + $(this).attr('data-id'));
    })
    $('.delete_data').click(function() {
        _conf("Are you sure to delete this Payroll permanently?", "delete_payroll", [$(this).attr(
            'data-id')])
    })
    $('.table').dataTable({
		columnDefs: [{
			orderable: false,
			targets: [6]
		}],
		initComplete: function(settings, json) {
			$('.table').find('th, td').addClass('px-2 py-1 align-middle')
		},
		drawCallback: function(settings) {
			$('.table').find('th, td').addClass('px-2 py-1 align-middle')
		}
    });
})

function delete_payroll($id) {
    start_loader();
    $.ajax({
        url: _base_url_ + "classes/Master.php?f=delete_payroll",
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