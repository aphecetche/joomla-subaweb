<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
jimport('joomla.application.component.modellist');
 
/**
 * Jobs Model
 */
class OSDownloadsModelEmails extends JModelList
 {
    public function getListQuery()
    {
        $query = parent::getListQuery();

        $query->select("email.*, document.name AS doc_name, cate.title AS cate_name");
        $query->from("#__osdownloads_emails email");
        $query->join("LEFT", "#__osdownloads_documents document ON (email.document_id = document.id)");
        $query->join("LEFT", "#__categories cate ON (cate.id = document.cate_id)");
        
        if (JRequest::getVar("id"))
        {
            $id = JRequest::getVar("id");
           $query->where("cate.id=".$id);
        }
        
        return $query;
    }
    
}