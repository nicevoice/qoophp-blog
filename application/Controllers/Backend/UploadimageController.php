<?php
/**
 * @author: Rogee<rogeeyang@gmail.com>
 */

namespace Controllers;


use Common\BackendControllerBase;

class UploadimageController extends BackendControllerBase
{
    public function indexAction()
    {
        $this->view->disable();

        $up = new \Library\Upload\Uploader();
        $up->Upload_Init($_FILES['upload_file']);
        $up->Upload_File_Generate_Name();
        $up->Upload_Set_dir(UPLOAD_PATH);
        //$up->Upload_Set_Type(array('image/jpg','image/jpeg','image/png','image/gif'));
        $up->Upload_Set_Ext(array('jpg','jpeg','gif','png'));
        $up->Upload_Set_Max_Size(2);

        //Process uploading
        $upimg = $up->Upload();
        if($upimg === true)
        {
            $info = $up->Upload_Get_File_Info();
            $info = array('success' => true, 'attach'=>"123",'file_path' => IMAGE_BASE_URI.$info['fullname']);
        }else{
            $info = array('success'=>false, 'url'=>'');
        }
        header('Content-type:application/json;charset=utf-8');
        echo json_encode($info);exit;
    }

    public function listAction()
    {
        $this->oss->getBudgetList();
    }
}

