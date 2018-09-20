<?php
/************************************************************************
  			aptient.php - Copyright duhlman

/usr/share/apps/umbrello/headings/heading.php

This file was generated on %date% at %time%
The original location of this file is /home/duhlman/uml-generated-code/prescription.php
**************************************************************************/

/**
 * class Patient
 *
 */

class Patient extends ORDataObject
{
    var $id;
    var $pubpid;
    var $lname;
    var $mname;
    var $fname;
    var $date_of_birth;
    var $provider;

    /**
     * Constructor sets all Prescription attributes to their default value
     */
    function __construct($id = "")
    {
        $this->id = $id;
        $this->_table = "patient_data";
        $this->pubpid = "";
        $this->lname = "";
        $this->mname = "";
        $this->fname = "";
        $this->dob   = "";
        $this->provider = new Provider();
        $this->populate();
    }
    function populate()
    {
        if (!empty($this->id)) {
            $res = sqlQuery("SELECT providerID,fname,lname,mname ".
                                        ", DATE_FORMAT(DOB,'%m/%d/%Y') as date_of_birth ".
                                        ", pubpid ".
                                        " from " . $this->_table ." where pid =". add_escape_custom($this->id));
            if (is_array($res)) {
                $this->pubpid = $res['pubpid'];
                $this->lname = $res['lname'];
                $this->mname = $res['mname'];
                $this->fname = $res['fname'];
                $this->provider = new Provider($res['providerID']);
                $this->date_of_birth = $res['date_of_birth'];
            }
        }
    }
    function get_id()
    {
        return $this->id;
    }
    function get_pubpid()
    {
        return $this->pubpid;
    }
    function get_lname()
    {
        return $this->lname;
    }
    function get_name_display()
    {
        return $this->fname . " " . $this->lname;
    }
    function get_provider_id()
    {
        return $this->provider->id;
    }
    function get_provider()
    {
        return $this->provider;
    }
    function get_dob()
    {
        return $this->date_of_birth;
    }
    function sharePatientData($requestData = []){
//        var_dump($requestData);die;
        if (!empty(getArrayValue($_POST))) {
            $res = sqlQuery("SELECT providerID,fname,lname,mname " .
                ", DATE_FORMAT(DOB,'%m/%d/%Y') as date_of_birth " .
                ", pubpid " .
                " from " . $this->_table . " where pid =" . add_escape_custom($this->id));

        }
        $objWriter = new XMLWriter(XMLWriter::STORAGE_MEMORY);
        // XML header
        $objWriter->startDocument('1.0', 'UTF-8', 'yes');

        // Relationships
        $objWriter->startElement('Relationships');
        $objWriter->writeAttribute('xmlns', 'http://schemas.openxmlformats.org/package/2006/relationships');
        // Relationship styles.xml
//        (new \PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels())->writeRelationship(
//            $objWriter,
//            1,
//            'http://schemas.openxmlformats.org/officeDocument/2006/relationships/styles',
//            'styles.xml'
//        );

        $objWriter->endElement();

        return $objWriter->getData();
        switch ($case){
            case "dowlnoad":
                break;
            case "save_docs":
                break;
            case "send_email":
                break;
        }

    }

} // end of Patient
