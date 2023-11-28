<?php
//============================================================+
// File name   : example_006.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 006 for TCPDF class
//               WriteHTML and RTL support
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: WriteHTML and RTL support
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once(base_app.'plugins/TCPDF/tcpdf.php');
if(!defined('PDF_HEADER_LOGO2'))
define ('PDF_HEADER_LOGO2', validate_image(explode('?',$this->settings->info('logo'))[0]));
if(!defined('COMPANY_NAME'))
define ('COMPANY_NAME',$this->settings->info('name'));
$logo_ext = pathinfo(PDF_HEADER_LOGO2, PATHINFO_EXTENSION);
if(!defined('LOGO_EXT'))
define ('LOGO_EXT',$logo_ext);

require_once('./custom_pdf_header.php');

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetProtection(array('print', 'copy', 'read'), $company_id, null, 0, null);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('oretnom23');
$pdf->SetTitle('Payslip');
$pdf->SetSubject('Generated Payslip');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO2, 50, $this->settings->info('name'), 'Generated Payslip');

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('dejavusans', '', 10);

// add a page
$pdf->AddPage();

// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

// create some HTML content
switch($_payroll['type']){
    case 1:
        $_payroll['type'] =  'Monthly';
        break;
    case 2:
        $_payroll['type'] =  'Semi-Monthly';
        break;
    case 3:
        $_payroll['type'] =  'Daily';
        break;
    default:
        $_payroll['type'] =  'N/A';
        break;
}
$start = isset($_payroll['start_date']) ? date("M d, Y", strtotime($_payroll['start_date'])) : '';
$end = isset($_payroll['end_date']) ? date("M d, Y", strtotime($_payroll['end_date'])) : '';
$html = '<hr/><br/>';
$html .= <<<EOD
<table cellspacing="0" cellpadding="1" border="1">
    <tr>
        <td colspan="4" align="centet">Payroll Details</td>
    </tr>
    <tr>
        <td width="15%">Code</td>
        <td width="35%">{$_payroll['code']}</td>
        <td width="15%">Full Name</td>
        <td width="35%">{$_payroll['type']}</td>
    </tr>
    <tr>
        <td width="15%">Cut-off Start</td>
        <td width="35%">{$start}</td>
        <td width="15%">Cut-off End</td>
        <td width="35%">{$end}</td>
    </tr>
</table>
EOD;
$html .= '<br>';
$html .= '<br>';
$html .= <<<EOD
<table cellspacing="0" cellpadding="1" border="1">
    <tr>
        <td colspan="4" align="centet">Payroll Details</td>
    </tr>
    <tr>
        <td width="15%">Company ID</td>
        <td width="35%">{$company_id}</td>
        <td width="15%">Full Name</td>
        <td width="35%">{$fullname}</td>
    </tr>
    <tr>
        <td width="15%">Department</td>
        <td width="35%">{$department}</td>
        <td width="15%">Position</td>
        <td width="35%">{$position}</td>
    </tr>
</table>
EOD;
$html .= '<br>';
$html .= '<br>';
$html .= '
<table cellspacing="0" cellpadding="1" border="1">
    <tr>
        <td align="centet">Details</td>
        <td align="centet">Allowances</td>
        <td align="centet">Deductions</td>
    </tr>
    <tr>
        <td width="33.33%">
            <table cellspacing="0" cellpadding="1" border="0">
                <tr>
                    <td width="70%">Basic Salary</td>
                    <td align="right" width="30%">'.((isset($base_salary) ? number_format($base_salary,2) : 0.00)).'</td>
                </tr>
                <tr>
                    <td width="70%">Attendance (days)</td>
                    <td align="right" width="30%">'.(isset($days_present) ? number_format($days_present + $days_absent) : 0).'</td>
                </tr>
                <tr>
                    <td width="70%">Absences</td>
                    <td align="right" width="30%">'.(isset($days_absent) ? number_format($days_absent) : 0).'</td>
                </tr>
                <tr>
                    <td width="70%">Late/Undertime</td>
                    <td align="right" width="30%">'.(isset($tardy_undertime) ? number_format($tardy_undertime) : 0).'</td>
                </tr>
            </table>
        </td>
        <td width="33.33%">
            <table cellspacing="0" cellpadding="1" border="0">
            ';
            $allowances = $this->conn->query("SELECT * FROM `allowance_list` where payslip_id = '{$id}'");
            while($row = $allowances->fetch_assoc()):
$html .= '
                <tr>
                    <td width="70%">'.$row['name'].'</td>
                    <td align="right" width="30%">'.(number_format($row['amount'],2)).'</td>
                </tr>
            '; 
            endwhile;
$html .= '
                <tr>
                    <td colspan="2">  </td>
                </tr>
                <tr>
                    <td width="70%">Total</td>
                    <td align="right" width="30%">'.(number_format($total_allowance,2)).'</td>
                </tr>
';

$html .='
            </table>
        </td>
        <td width="33.33%">
            <table cellspacing="0" cellpadding="1" border="0">
        ';
        $deductions = $this->conn->query("SELECT * FROM `deduction_list` where payslip_id = '{$id}'");
        while($row = $deductions->fetch_assoc()):
$html .= '
            <tr>
                <td width="70%">'.$row['name'].'</td>
                <td align="right" width="30%">'.(number_format($row['amount'],2)).'</td>
            </tr>
        '; 
        endwhile;
$html .= '
            <tr>
                <td colspan="2">  </td>
            </tr>
            <tr>
                <td width="70%">Total</td>
                <td align="right" width="30%">'.(number_format($total_deduction,2)).'</td>
            </tr>
';

$html .='
            </table>
        </td>
    </tr>
</table>
';
$html .='<h2 align="right"><b>NET INCOME: '.(number_format($net,2)).'</b></h2>';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
if(!$save_file){
$pdf->Output('payslip_'.$company_id.'_'.$_payroll['code'].'.pdf', 'I');
}else{
    if(!is_dir(base_app.'uploads/payslips/'))
        mkdir(base_app.'uploads/payslips/');
    $fname = "uploads/payslips/".'payslip_'.$company_id.'_'.$_payroll['code'].'.pdf';
    if(is_file(base_app.$fname))
        unlink((base_app.$fname));
        $pdf->Output(base_app.$fname, 'F');
    $this->conn->query("UPDATE `payslip_list` set file_path = '{$fname}' where id = '{$payslip_id}' ");
    unset($pdf);
}

//============================================================+
// END OF FILE
//============================================================+