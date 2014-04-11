<?php

/*
 * Uploader
 * Manage file uplading
 */

/**
 * @author : Ahmed Syam
 * @copyright www.softmasr.com
 * @version 1.0
 * Contact Me : engsyam at gmail dot com
 */
namespace Library\Upload;


class Uploader{
    
    /*Inintialization*/
    private $up_dir;        //Directory to upload file
    private $up_file_name;  //Uploaded file name
    private $up_tmp;        //temporary directory
    private $up_ext;        //Extension of uploaded file
    private $up_file_size;  //Uploaded file size
    private $up_mime_type;  //uploaded file mime-type
    private $up_error;      //Uploaded file errors
    private $_up_into_path;



    /*File specifications*/
    private $up_file_new_name;      //New generated name
    private $allowed_size=1048576;  //1MB
    private $allowed_ext;           //array of allowed extension
    private $allowed_types;         //array of allowed mime-types

    

    /**
     *Constructor 
     */
    public function __construct() {
        $this->allowed_ext = array();
        $this->allowed_types= array();
    }
    
    
    
    /**
     * Upload Init | initialize file before uploading
     * @param array $FilesArray
     * @param string $directory
     * @param array $ext
     * @param array $type 
     */
    public function Upload_Init($FilesArray)
    {
        $this->up_dir       = $directory;
        $this->up_file_name = $FilesArray['name'];
        $this->up_error     = $FilesArray['error'];
        $this->up_file_size = $FilesArray['size'];
        $this->up_tmp       = $FilesArray['tmp_name'];
        $this->up_mime_type = $FilesArray['type'];
        $file_name_info = explode('.',$FilesArray['name']);
        $this->up_ext       = strtolower(end($file_name_info)); //Extension of uploaded file
    }
    
    /**
     * Process-> File Uploading 
     */
    public function Upload()
    {
        //Check if directory is founded or not
        $this->Upload_Check_Up_Dir();

        //Check extension or type
        if(!empty($this->allowed_ext) && !in_array($this->up_ext, $this->allowed_ext))
        {
            print('File Type Not Allowed');
            return FALSE;
        }
        if(!empty($this->allowed_types) && !in_array($this->up_mime_type, $this->allowed_types)){
            print('File Mime Not Allowed');
            return FALSE;
        }
        
        //Check File Size
        if($this->up_file_size > $this->allowed_size)
        {
            print('File Size Bigger than allowed');
            return FALSE;
        }
        
        $this->Upload_File_Generate_Name();
        
        //print $this->up_dir.'/'.$this->up_file_new_name.'.'.$this->up_ext;
        
        //move file
        $move = move_uploaded_file($this->up_tmp, $this->up_dir.'/'.$this->up_file_new_name.'.'.$this->up_ext);
        if($move)
            return TRUE;
        
        return FALSE;
    }
    
    
    /*=================================================================================================*/
   
    /**
     * Generate New Name for Uploaded file 
     */
    public function Upload_File_Generate_Name()
    {
        $new_name = date(H_i_s_) . md5($this->up_file_name . uniqid());
        $this->up_file_new_name = $new_name;
    }
    
    
    
    /**
     * Set allowed Extensions
     * @param array $extensions 
     */
    public function Upload_Set_Ext($extensions)
    {
        if(is_array($extensions))
        {
            $this->allowed_ext = $extensions;
        }else{
            $this->allowed_ext[] = $extensions; 
        }
    }
    
    
    
    /**
     * Set Allowed Types
     * @param array $types 
     */
    public function Upload_Set_Type($types)
    {
        if(is_array($types))
        {
            $this->allowed_types = $types;
        }else{
            $this->allowed_types[] = $types;
        }
    }
    
    
    
    /**
     * Set Uploaded File Directory
     * @param string $directory 
     */
    public function Upload_Set_dir($directory)
    {
        $this->_up_into_path = date('/Y/md');
        $this->up_dir = $directory.$this->_up_into_path;
    }
    
    
    
    /**
     * Set Allowed Files with MB
     * @param int $size  with MB
     */
    public function Upload_Set_Max_Size($size)
    {
        $Max_size = ((int)$size)*1048576;
        $this->allowed_size = $Max_size;
    }
    
    
    /*=================================================================================================*/
    
    
    /**
     * Check upload directory
     * if not found : Create it 
     * copy .htaccess file for protection
     */
    public function Upload_Check_Up_Dir()
    {
        if(!is_dir($this->up_dir))
            mkdir ($this->up_dir, 0777, true);
        
        //Put htaccess file
        
    }
    
    
    /**
     * Get Information of uploaded file as array to be used later
     */
    public function Upload_Get_File_Info()
    {
        $info = array();
        $info['old']    = $this->up_file_name;
        $info['name']   = $this->up_file_new_name;
        $info['size']   = $this->up_file_size;
        $info['ext']    = $this->up_ext;
        $info['type']   = $this->up_mime_type;
        $info['dir']    = $this->up_dir;
        $info['fullname']   = $this->_up_into_path .'/'.$this->up_file_new_name.'.'.$this->up_ext;
        
        return $info;
    }
    
    
}

?>
