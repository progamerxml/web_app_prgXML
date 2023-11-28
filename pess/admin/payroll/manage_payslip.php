<?php
require_once('./../../config.php');
$payroll_id = isset($_GET['payroll_id']) ? $_GET['payroll_id'] : '';
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `payslip_list` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }
}
?>
<div class="container-fluid">
    <form action="" id="payslip-form">
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
        <input type="hidden" name="payroll_id" value="<?php echo isset($payroll_id) ? $payroll_id : '' ?>">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="employee_id" class="control-label">Employee</label>
                    <select name="employee_id" id="employee_id" class="form-control rounded-0 select2">
                        <option disabled <?= !isset($employee_id) ? "selected" : "" ?>></option>
                        <?php
                        $employees = $conn->query("SELECT *, CONCAT(last_name, ', ' , first_name,' ', COALESCE(middle_name,'')) as fullname FROM `employee_list` where `status` = 1 and delete_flag = 0 order by fullname asc");
                        while($row = $employees->fetch_assoc()):
                        ?>
                        <option value="<?= $row['id'] ?>" <?= isset($employee_id) && $employee_id == $row['id'] ? 'selected' : ''  ?>><?= $row['company_id'] .' - '.(ucwords($row['fullname'])) ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="base_salary" class="control-label">Basic Salary</label>
                    <input type="number" step="any" name="base_salary" id="base_salary" value="<?= isset($base_salary) ? $base_salary : '' ?>" class="form-control rounded-0 text-right" required>
                </div>
                <div class="form-group mb-3">
                    <label for="days_present" class="control-label">Days Present</label>
                    <input type="number" step="any" name="days_present" id="days_present" value="<?= isset($days_present) ? $days_present : '' ?>" class="form-control rounded-0 text-right" required>
                </div>
                <div class="form-group mb-3">
                    <label for="days_absent" class="control-label">Days Absent</label>
                    <input type="number" step="any" name="days_absent" id="days_absent" value="<?= isset($days_absent) ? $days_absent : '' ?>" class="form-control rounded-0 text-right" required>
                </div>
                <div class="form-group mb-3">
                    <label for="tardy_undertime" class="control-label">Late and Undertime (mins)</label>
                    <input type="number" step="any" name="tardy_undertime" id="tardy_undertime" value="<?= isset($tardy_undertime) ? $tardy_undertime : '' ?>" class="form-control rounded-0 text-right" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="total_allowance" class="control-label">Total Allowances</label>
                    <input type="number" step="any" name="total_allowance" id="total_allowance" value="<?= isset($total_allowance) ? $total_allowance : 0 ?>" class="form-control rounded-0 text-right" required readonly>
                </div>
                <div class="form-group mb-3">
                    <label for="total_deduction" class="control-label">Total Deduction</label>
                    <input type="number" step="any" name="total_deduction" id="total_deduction" value="<?= isset($total_deduction) ? $total_deduction : 0 ?>" class="form-control rounded-0 text-right" required readonly>
                </div>
                <div class="form-group mb-3">
                    <label for="withholding_tax" class="control-label">Withholding Tax</label>
                    <input type="number" step="any" name="withholding_tax" id="withholding_tax" value="<?= isset($withholding_tax) ? $withholding_tax : 0 ?>" class="form-control rounded-0 text-right" required>
                </div>
                <div class="form-group mb-3">
                    <label for="net" class="control-label">Net Income</label>
                    <input type="number" step="any" name="net" id="net" value="<?= isset($net) ? $net : 0 ?>" class="form-control rounded-0 text-right" required>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <div class="d-flex mb-3 w-100">
                    <div class="col-6">
                        <input type="text" id='allowance' placeholder="Allowance" class="form-control form-control-sm rounded-0">
                    </div>
                    <div class="col-5">
                        <input type="number" step="any" id='allowance_amount' placeholder="Amount" class="form-control form-control-sm rounded-0 text-right">
                    </div>
                    <div class="col-1">
                        <button class="btn-primary btn-sm rounded-0" type="button" id="add_allowance"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <table class="table table-bordered" id="allowance_list">
                    <colgroup>
                        <col width="10%">
                        <col width="45%">
                        <col width="45%">
                    </colgroup>
                    <thead>
                        <tr class="bg-gradient-primary">
                            <th class="px-1 py-1 text-center"></th>
                            <th class="px-1 py-1 text-center">Allowance</th>
                            <th class="px-1 py-1 text-center">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($id)): ?>
                        <?php 
                            $allowances = $conn->query("SELECT * FROM allowance_list where payslip_id = '{$id}'");
                            while($row = $allowances->fetch_array()):
                        ?>
                        <tr>
                            <td class="p-1 align-middle text-center">
                                <input type="hidden" name="allowance[]" value="<?= $row['name'] ?>">
                                <input type="hidden" name="allowance_amount[]" value="<?= $row['amount'] ?>">
                                <button class="btn btn-outline-danger btn-sm rounded-0 rem-item" type="button"><i class="fa fa-times"></i></button>
                            </td>
                            <td class="p-1 align-middle allowance"><?= $row['name'] ?></td>
                            <td class="p-1 align-middle allowance_amount text-right"><?= number_format($row['amount'],2) ?></td>
                        </tr>
                        <?php endwhile; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <div class="d-flex mb-3 w-100">
                    <div class="col-6">
                        <input type="text" id='deduction' placeholder="Deduction" class="form-control form-control-sm rounded-0">
                    </div>
                    <div class="col-5">
                        <input type="number" step="any" id='deduction_amount' placeholder="Amount" class="form-control form-control-sm rounded-0 text-right">
                    </div>
                    <div class="col-1">
                        <button class="btn-primary btn-sm rounded-0" type="button" id="add_deduction"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <table class="table table-bordered" id="deduction_list">
                    <colgroup>
                        <col width="10%">
                        <col width="45%">
                        <col width="45%">
                    </colgroup>
                    <thead>
                        <tr class="bg-gradient-primary">
                            <th class="px-1 py-1 text-center"></th>
                            <th class="px-1 py-1 text-center">Deduction</th>
                            <th class="px-1 py-1 text-center">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($id)): ?>
                        <?php 
                            $deductions = $conn->query("SELECT * FROM deduction_list where payslip_id = '{$id}'");
                            while($row = $deductions->fetch_array()):
                        ?>
                        <tr>
                            <td class="p-1 align-middle text-center">
                                <input type="hidden" name="deduction[]" value="<?= $row['name'] ?>">
                                <input type="hidden" name="deduction_amount[]" value="<?= $row['amount'] ?>">
                                <button class="btn btn-outline-danger btn-sm rounded-0 rem-item" type="button"><i class="fa fa-times"></i></button>
                            </td>
                            <td class="p-1 align-middle deduction"><?= $row['name'] ?></td>
                            <td class="p-1 align-middle deduction_amount text-right"><?= number_format($row['amount'],2) ?></td>
                        </tr>
                        <?php endwhile; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </form>
</div>
<noscript id="allowance-clone">
    <tr>
        <td class="p-1 align-middle text-center">
            <input type="hidden" name="allowance[]">
            <input type="hidden" name="allowance_amount[]">
            <button class="btn btn-outline-danger btn-sm rounded-0 rem-item" type="button"><i class="fa fa-times"></i></button>
        </td>
        <td class="p-1 align-middle allowance"></td>
        <td class="p-1 align-middle allowance_amount text-right"></td>
    </tr>
</noscript>
<noscript id="deduction-clone">
    <tr>
        <td class="p-1 align-middle text-center">
            <input type="hidden" name="deduction[]">
            <input type="hidden" name="deduction_amount[]">
            <button class="btn btn-outline-danger btn-sm rounded-0 rem-item" type="button"><i class="fa fa-times"></i></button>
        </td>
        <td class="p-1 align-middle deduction"></td>
        <td class="p-1 align-middle deduction_amount text-right"></td>
    </tr>
</noscript>
<script>
    function calc(){
        var total_allowance = 0 
        $('#allowance_list tbody tr').each(function(){
            total_allowance += parseFloat($(this).find('input[name="allowance_amount[]"]').val())
        })
        $('#total_allowance').val(total_allowance)
        var total_deduction = 0 
        $('#deduction_list tbody tr').each(function(){
            total_deduction += parseFloat($(this).find('input[name="deduction_amount[]"]').val())
        })
        $('#total_deduction').val(total_deduction)
    }
$(document).ready(function() {
    $('#allowance_list tbody tr, #deduction_list tbody tr').find('.rem-item').click(function(){
            $(this).closest('tr').remove()
            calc()
        })
    $('#add_allowance').click(function(){
        var allowance = $('#allowance').val()
        var allowance_amount = $('#allowance_amount').val()
        if(allowance == '' || allowance_amount == '')
            return false;
        var tr = $($('noscript#allowance-clone').html()).clone()
        tr.find('input[name="allowance[]"]').val(allowance)
        tr.find('input[name="allowance_amount[]"]').val(allowance_amount)
        tr.find('.allowance').text(allowance)
        tr.find('.allowance_amount').text(parseFloat(allowance_amount).toLocaleString('en-US'))
        $('#allowance_list').append(tr)
        calc()
        tr.find('.rem-item').click(function(){
            tr.remove()
            calc()
        })
        $('#allowance').val('')
        $('#allowance_amount').val('')
    })
    $('#add_deduction').click(function(){
        var deduction = $('#deduction').val()
        var deduction_amount = $('#deduction_amount').val()
        if(deduction == '' || deduction_amount == '')
            return false;
        var tr = $($('noscript#deduction-clone').html()).clone()
        tr.find('input[name="deduction[]"]').val(deduction)
        tr.find('input[name="deduction_amount[]"]').val(deduction_amount)
        tr.find('.deduction').text(deduction)
        tr.find('.deduction_amount').text(parseFloat(deduction_amount).toLocaleString('en-US'))
        $('#deduction_list').append(tr)
        calc()
        tr.find('.rem-item').click(function(){
            tr.remove()
            calc()
        })
        $('#deduction').val('')
        $('#deduction_amount').val('')
    })
    $('#uni_modal').on('shown.bs.modal',function(){
        $('#employee_id').select2({
            placeholder:'Please Select Employee',
            width:'100%',
            dropdownParent:$('#uni_modal')
        })
    })

    $('#payslip-form').submit(function(e) {
        e.preventDefault();
        var _this = $(this)
        $('.err-msg').remove();
        start_loader();
        $.ajax({
            url: _base_url_ + "classes/Master.php?f=save_payslip",
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