<?php
require_once('./../../config.php');
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `payroll_list` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }
}
?>
<div class="container-fluid">
    <form action="" id="payroll-form">
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
        <div class="form-group mb-3">
            <label for="code" class="control-label">Payroll Code</label>
            <input name="code" id="code" class="form-control rounded-0 form no-resize"
                value="<?php echo isset($code) ? $code : ''; ?>" required>
        </div>
        <div class="form-group mb-3">
            <label for="start_date" class="control-label">Cut-off Start Date</label>
            <input name="start_date" id="start_date" type="date" class="form-control rounded-0 form no-resize"
                value="<?php echo isset($start_date) ? $start_date : ''; ?>" required>
        </div>
        <div class="form-group mb-3">
            <label for="end_date" class="control-label">Cut-off Start Date</label>
            <input name="end_date" id="end_date" type="date" class="form-control rounded-0 form no-resize"
                value="<?php echo isset($end_date) ? $end_date : ''; ?>" required>
        </div>
        <div class="form-group mb-3">
            <label for="type" class="control-label">Payroll Type</label>
            <select name="type" id="type" class="custom-select rounded-0">
                <option value="1" <?php echo isset($type) && $type == 1 ? 'selected' : '' ?>>Monthly</option>
                <option value="2" <?php echo isset($type) && $type == 2 ? 'selected' : '' ?>>Semi-Monthly</option>
                <option value="3" <?php echo isset($type) && $type == 3 ? 'selected' : '' ?>>Daily</option>
            </select>
        </div>
    </form>
</div>
<script>
$(document).ready(function() {
    $('#payroll-form').submit(function(e) {
        e.preventDefault();
        var _this = $(this)
        $('.err-msg').remove();
        start_loader();
        $.ajax({
            url: _base_url_ + "classes/Master.php?f=save_payroll",
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