<?php

# json template
#
# [
#    {"name":string, "content":string(binary)},
#    ...
# ]

const SRC_DIR = '/python-interpreter/src';

function decode_and_create_files($buffer) {

    if (!file_exists(SRC_DIR)) {
        echo "[ERROR]: Python source directory doesn't exist, rebuild the docker image\n";
        exit(1);
    }
    $names = [];
    foreach($buffer as $file) {
        $names[] = SRC_DIR.'/'.$file['name'];
        if (!file_put_contents(SRC_DIR.'/'.$file['name'], $file['content'])) {
            echo "[ERROR]: Saving file contents to file failed\n";
            return false;
        }
    }
    return $names;
}

function interpret_files($buffer) {
    $filenames = decode_and_create_files($buffer);
    if (!$filenames) {
        return false;
    }

    $arguments = join(' ', $filenames);

    $output = shell_exec("python3 -B $arguments 2>&1");
    echo $output;
    return $output;
}

