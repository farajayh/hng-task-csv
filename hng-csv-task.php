<?php
    //$filename = "./NFT Naming csv - Team Clutch.csv";
    if($argc < 2){
        echo "Please specify a file name";
        die();
    }
    $filename = $argv[1];
    $filename_array = explode("/", $filename);
    $real_filename = array_pop($filename_array);
    $handle = @fopen($filename, "r");
    $out_filename = "output-$real_filename";
    if(file_exists($out_filename)){
        unlink($out_filename);
    }
    $out_handle = fopen($out_filename, 'a');
    if ($handle) {
        $header = fgets($handle);
        $header_arr = explode(',', $header);
        fwrite($out_handle, $header);
        array_pop($header_arr);
        //print_r($header_arr);
        while (($line = fgets($handle)) !== false) {
            // process the line read.
            //echo $line."\n";
            $line_arr = explode(',', $line);
            array_pop($line_arr);
            //print_r($line_arr);
            $json_arr = array_combine($header_arr, $line_arr);
            $json_hash = hash('sha256', json_encode($json_arr));
            fwrite($out_handle, $line.",$json_hash");
            break;
            
        }
    
        fclose($handle);
    } else {
        echo "Could not open file";
    }
    