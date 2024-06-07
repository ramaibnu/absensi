<?php
defined('BASEPATH') or exit('No direct script access allowed');

class FTP_File
{
    private $ftpServer;
    private $ftpPort;
    private $ftpUsername;
    private $ftpPassword;
    private $ci;

    public function __construct()
    {
        $this->ftpServer = '192.168.150.192';
        $this->ftpPort = 22;
        $this->ftpUsername = 'hrunggulftp';
        $this->ftpPassword = 'UDU#xorang123';
        $this->ci =& get_instance();
    }

    public function makeFolder($directoryName)
    {
        // Authentication
        $ftp = $this->authentication();
        if (is_int($ftp)) {
            return $ftp;
        }
        
        // Change directory
        ftp_chdir($ftp, '/home/hrunggulftp/karyawan');
        
        // Target directory for upload file
        $targetDirectory = '/home/hrunggulftp/karyawan/' . $directoryName;

        // Get the list of files and directories in the current directory
        $directoryList = ftp_nlist($ftp, '.');

        // Check if the target directory exists
        if (!in_array($directoryName, $directoryList)) {
            if (!ftp_mkdir($ftp, $targetDirectory)) {
                ftp_close($ftp);
                return 403;
            }
        }
        return 200;
    }

    public function uploadFile($directoryName, $extension, $inputName, $fileSize, $fileName)
    {
        // Authentication
        $ftp = $this->authentication();
        if (is_int($ftp)) {
            return $ftp;
        }
        
        // Change directory
        ftp_chdir($ftp, '/home/hrunggulftp/karyawan');
        
        // Target directory for upload file
        $targetDirectory = '/home/hrunggulftp/karyawan/' . $directoryName;

        // Get the list of files and directories in the current directory
        $directoryList = ftp_nlist($ftp, '.');

        // Check if the target directory exists
        if (!in_array($directoryName, $directoryList)) {
            if (!ftp_mkdir($ftp, $targetDirectory)) {
                ftp_close($ftp);
                return 403;
            }
        }

        // File upload using CodeIgniter's upload library
        $tempDirectory = sys_get_temp_dir();
        $config_upload['upload_path'] = $tempDirectory;
        $config_upload['allowed_types'] = $extension;
        $config_upload['max_size'] = $fileSize;
        $config_upload['file_name'] = $fileName;
        $config_upload['overwrite'] = true;
        $config_upload['remove_spaces'] = false;

        $this->ci->load->library('upload', $config_upload);

        if ($this->ci->upload->do_upload($inputName)) {
            $uploadData = $this->ci->upload->data();
            $uploadedFile = $uploadData['full_path'];

            if (ftp_put($ftp, $targetDirectory . '/' . $fileName, $uploadedFile, FTP_BINARY)) {
                ftp_close($ftp);
                return 200;
            } else {
                ftp_close($ftp);
                return 400;
            }
        } else {
            ftp_close($ftp);
            return 406;
        }
    }

    public function uploadFilePerusahaan($directoryName, $extension, $inputName, $fileSize, $fileName)
    {
        // Authentication
        $ftp = $this->authentication();
        if (is_int($ftp)) {
            return $ftp;
        }
        
        // Change directory
        ftp_chdir($ftp, '/home/hrunggulftp/perusahaan');
        
        // Target directory for upload file
        $targetDirectory = '/home/hrunggulftp/perusahaan/' . $directoryName;

        // Get the list of files and directories in the current directory
        $directoryList = ftp_nlist($ftp, '.');

        // Check if the target directory exists
        if (!in_array($directoryName, $directoryList)) {
            if (!ftp_mkdir($ftp, $targetDirectory)) {
                ftp_close($ftp);
                return 403;
            }
        }

        // File upload using CodeIgniter's upload library
        $tempDirectory = sys_get_temp_dir();
        $config_upload['upload_path'] = $tempDirectory;
        $config_upload['allowed_types'] = $extension;
        $config_upload['max_size'] = $fileSize;
        $config_upload['file_name'] = $fileName;
        $config_upload['overwrite'] = true;
        $config_upload['remove_spaces'] = false;

        $this->ci->load->library('upload', $config_upload);

        if ($this->ci->upload->do_upload($inputName)) {
            $uploadData = $this->ci->upload->data();
            $uploadedFile = $uploadData['full_path'];

            if (ftp_put($ftp, $targetDirectory . '/' . $fileName, $uploadedFile, FTP_BINARY)) {
                ftp_close($ftp);
                return 200;
            } else {
                ftp_close($ftp);
                return 400;
            }
        } else {
            ftp_close($ftp);
            return 406;
        }
    }

    public function deleteFile($directoryName, $fileName)
    {
        // Authentication
        $ftp = $this->authentication();
        if (is_int($ftp)) {
            return $ftp;
        }
        
        // Target directory for upload file
        $targetDirectory = '/home/hrunggulftp/karyawan/' . $directoryName . '/' . $fileName;
        if ($this->fileExists($ftp, $targetDirectory)) {
            if (ftp_delete($ftp, $targetDirectory)) {
                return 200;
            } else {
                return 400;
            }
        } else {
            return 200;
        }

        // Close FTP connection
        ftp_close($ftp);
    }

    public function readFilePDF(array $ftpFilePaths, $fileName)
    {
        // Set existingFile variable
        $existingFile = null;

        // Connect to FTP server
        $ftp = ftp_connect($this->ftpServer, $this->ftpPort);
        if (!$ftp) {
            return $existingFile;
        }
        
        // Login to FTP server
        if (!ftp_login($ftp, $this->ftpUsername, $this->ftpPassword)) {
            return $existingFile;
        }

        // Find the first existing file
        foreach ($ftpFilePaths as $filePath) {
            if ($this->fileExists($ftp, $filePath)) {
                $existingFile = $filePath;
                break;
            }
        }

        // Serve the first existing file
        if ($existingFile !== null) {
            // Set appropriate headers for the file type
            header('Content-Type: ' . 'application/pdf');
            header('Content-Disposition: inline; filename="' . urldecode($fileName) . '"');
            header('Content-Length: ' . ftp_size($ftp, $existingFile));

            // Output the file content
            ftp_pasv($ftp, true); // Enable passive mode
            ftp_fget($ftp, fopen('php://output', 'w'), $existingFile, FTP_BINARY);
        } else {
            return $existingFile;
        }

        // Close FTP connection
        ftp_close($ftp);
    }

    public function showImage(array $ftpFilePaths)
    {
        // Connect to FTP server
        $ftp = ftp_connect($this->ftpServer, $this->ftpPort);
        if (!$ftp) {
            $imageContent = null;

            ftp_close($ftp);

            return $imageContent;
        }
        
        // Login to FTP server
        if (!ftp_login($ftp, $this->ftpUsername, $this->ftpPassword)) {
            $imageContent = null;

            ftp_close($ftp);

            return $imageContent;
        }

        // Find the first existing file
        $existingFile = null;
        foreach ($ftpFilePaths as $filePath) {
            if ($this->fileExists($ftp, $filePath)) {
                $existingFile = $filePath;
                break;
            }
        }

        // Serve the first existing file
        if ($existingFile !== null) {
            $imageContent = ftp_get($ftp, 'php://output', $existingFile, FTP_BINARY);

            ftp_close($ftp);

            return $imageContent;
        } else {
            $imageContent = null;

            ftp_close($ftp);

            return $imageContent;
        }
    }

    private function authentication()
    {
        // Connect to FTP server
        $ftp = ftp_connect($this->ftpServer, $this->ftpPort);
        if (!$ftp) {
            return 404;
        }

        // Login to FTP server
        if (!ftp_login($ftp, $this->ftpUsername, $this->ftpPassword)) {
            return 401;
        }
        return $ftp;
    }

    private function fileExists($ftp, $filePath)
    {
        return (ftp_size($ftp, $filePath) != -1);
    }
}
