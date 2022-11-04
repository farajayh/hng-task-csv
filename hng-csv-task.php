<?php
    if($argc < 2){
        echo "Please specify a file name";
        die();
    }

    $filename = $argv[1];
    $filename_array = explode("/", $filename);
    $real_filename = array_pop($filename_array);

    $handle = @fopen($filename, "r");

    $out_filename = str_replace('.csv', '', $real_filename).'.output'.'.csv';

    if(file_exists($out_filename)){
        unlink($out_filename);
    }

    $out_handle = @fopen($out_filename, 'a');

    if ($handle) {
        $header = fgets($handle);
        $header_arr = explode(',', $header);
        
        fwrite($out_handle, trim($header).",HASH\n");
        
        while (($line = fgets($handle)) !== false) {            
            try {
                $line_arr = explode(',', $line);
                $json_arr = array_combine($header_arr, $line_arr);
                $json_hash = hash('sha256', json_encode($json_arr));
                fwrite($out_handle, trim($line).",$json_hash\n");
            } catch (Error $e){
                echo "Unexpected Error";
                die();
            }            
        }
    
        fclose($handle);
        fclose($out_handle);
    } else {
        echo "Could not open file";
    }
    