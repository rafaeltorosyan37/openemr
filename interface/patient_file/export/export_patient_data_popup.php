<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 9/14/2018
 * Time: 5:05 PM
 */

require_once('../../globals.php');
require_once($GLOBALS['srcdir'].'/patient.inc');
require_once($GLOBALS['srcdir'].'/csv_like_join.php');
require_once($GLOBALS['fileroot'].'/custom/code_types.inc.php');

$pid = getArrayValue($_GET, 'pid');
if(isset($_POST["pid"])){
//    require_once()
    $patientObj = new Patient();
    $patientObj->sharePatientData($_POST);
//    var_dump($_POST);die;
}
?>
<html>
<head>
<?php html_header_show(); ?>
<title><?php echo xlt('Export Patient Info'); ?></title>
<link rel="stylesheet" href='<?php echo attr($css_header) ?>' type='text/css'>

<style>
    td { font-size:10pt; }
    .left_col{
        float: left;
        width: 150px;
    }
    .row{
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        margin-bottom: 7px;
        /*margin-right: -15px;*/
        /*margin-left: -15px;*/
    }

</style>
<script type="text/javascript" src="<?php echo $webroot ?>/interface/main/tabs/js/include_opener.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['assets_static_relative']; ?>/jquery/dist/jquery.min.js"></script>
<script language="JavaScript">

 // Standard function
 function selcode(codetype, code, selector, codedesc) {
  if (opener.closed || ! opener.set_related) {
   alert('<?php echo xls('The destination form was closed; I cannot act on your selection.'); ?>');
  }
  else {
   var msg = opener.set_related(codetype, code, selector, codedesc);
   if (msg) alert(msg);
      dlgclose();
   return false;
  }
 }

 // TBD: The following function is not necessary. See
 // interface/forms/LBF/new.php for an alternative method that does not require it.
 // Rod 2014-04-15

 // Standard function with additional parameter to select which
 // element on the target page to place the selected code into.
 function selcode_target(codetype, code, selector, codedesc, target_element) {
  if (opener.closed || ! opener.set_related_target)
   alert('<?php echo xls('The destination form was closed; I cannot act on your selection.'); ?>');
  else
   opener.set_related_target(codetype, code, selector, codedesc, target_element);
     dlgclose();
  return false;
 }

</script>

<script language="JavaScript">
    function sharePatientData(target){
        top.restoreSession();

        let post_url = $("#export_patient_data").attr("action");
        let request_method = $("#export_patient_data").attr("method");
        let form_data = $("#export_patient_data").serialize();
        let case_ = $(target).attr("name");

        $.ajax({
            url: post_url,
            type: request_method,
            data: form_data + '&case=' + case_,
        }).done(function (r) { //
            console.log("done...")
            // dlgclose();
        });
        return false;

        // $(target).closest("form").submit();

        // console.log("NAME:", )
    }
</script>

</head>
<?php
    $focus = "document.theform.search_term.select();";
?>
<body class="body_top" OnLoad="<?php //echo $focus; ?>">

    <form name='export_patient_data' id="export_patient_data" method='post' action="export_patient_data_popup.php">
        <input type='hidden' name='pid' value='<?php echo $pid ?>'>

        <fieldset>
            <legend>Encryption</legend>
            <div class="row">
                <div class="left_col">
                    <span class="text"><?php echo xlt('Enable encryption'); ?></span>
                    <input type='checkbox' name='enable_encryption' id='enable_encryption' value="0" class="form-control">
                </div>
                <div class="left_col" style="float: left">
                    <span class="text"><?php echo xlt('Generate Hash File'); ?></span>
                    <input type='checkbox' name='generate_hash_file' value="0" class="form-control">
                </div>
            </div>
            <div class="row">
                <span class="text"><?php echo xlt('Encryption password'); ?></span>
                <input type=entry name='encryption_password' id='enable_encryption' class="form-control">
            </div>
        </fieldset>
        <fieldset>
            <legend>Data elements to include</legend>
            <div class="row">
                <div class="left_col">
                    <input type='checkbox' name='medication' id='medication' value="1" checked class="form-control">
                    <span class="text"><?php echo xlt('Medication'); ?></span>
                </div>
                <div class="left_col">
                    <input type='checkbox' name='social_history' id="social_history" checked value="1" class="form-control">
                    <span class="text"><?php echo xlt('Social History'); ?></span>
                </div>
            </div>
            <div class="row">
                <div class="left_col">
                    <input type='checkbox' name='medication_allergies' id="medication_allergies" checked value="1" class="form-control">
                    <span class="text"><?php echo xlt('Medication Allergies'); ?></span>
                </div>
                <div class="left_col">
                    <input type='checkbox' name='problems' id="problems" checked value="1" class="form-control">
                    <span class="text"><?php echo xlt('Problems'); ?></span>
                </div>
            </div>
            <div class="row">
                <div class="left_col">
                    <input type='checkbox' name='immunization' id="immunization" checked value="1" class="form-control">
                    <span class="text"><?php echo xlt('Immunization'); ?></span>
                </div>
                <div class="left_col">
                    <input type='checkbox' name='vital_signs' id="vital_signs" checked value="1" class="form-control">
                    <span class="text"><?php echo xlt('Vital signs'); ?></span>
                </div>
            </div>
            <div class="row"
                <div class="left_col">
                    <input type='checkbox' name='laboratory_test_results' id="laboratory_test_results" checked value="1" class="form-control">
                    <span class="text"><?php echo xlt('Laboratory Tests & Results'); ?></span>
                </div>
                <div class="left_col">
                    <input type='checkbox' name='procedures' id="procedures" checked value="1" class="form-control">
                    <span class="text"><?php echo xlt('Procedures'); ?></span>
                </div>
            </div>
            <div class="row">
                <div class="left_col">
                    <input type='checkbox' name='care_plan' id="care_plan" checked value="1" class="form-control">
                    <span class="text"><?php echo xlt('Care Plan'); ?></span>
                </div>
                <div class="left_col">
                    <input type='checkbox' name='chief_compliant' id="chief_compliant" checked value="1" class="form-control">
                    <span class="text"><?php echo xlt('Chief compliant'); ?></span>
                </div>
            </div>
            <div class="row">
                <div class="left_col">
                    <input type='checkbox' name='clinical_instructions' id="clinical_instructions" checked value="1" class="form-control">
                    <span class="text"><?php echo xlt('Clinical Instructions'); ?></span>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>Email</legend>
            <div class="row">
                    <span class="text"><?php echo xlt('Email'); ?></span>
                    <input type='email' name='email' id="email" value="" class="form-control">
            </div>
            <div class="row">
                    <span class="text"><?php echo xlt('Subject'); ?></span>
                    <input type='email' name='subject' id="subject" value="" class="form-control">
            </div>
            <div class="row">
                    <span class="text"><?php echo xlt('Messages'); ?></span>
                <textarea name="message" id="message" rows="7"></textarea>
            </div>
        </fieldset>
        <div class="row">
            <input type="button" name="download" onclick="sharePatientData(this)" value="Download"/>
            <input type="button" name="save_docs" onclick="sharePatientData(this)" value="Save Documents"/>
            <input type="button" name="send_email" onclick="sharePatientData(this)" value="Send Email"/>
            <input type="button" name="close" value="Close" onclick="dlgclose()"/>
        </div>
    </form>
</body>
</html>


