<?php


namespace App\Http\Controllers\Interpreter;

class PythonInterpreter {

    public function __construct() {
    }

    public function interpret(array $files) {
        $this->deserializeFiles($files);
        $srcPath = base_path().'/docker/python';

        $dockerRun = "docker run \
            --mount type=bind,source=$srcPath,target=/usr/src/app \
            --rm \
            --name ".env('DOCKER_CONTAINER_NAME')." ".env('DOCKER_CONTAINER_NAME')." 2>&1";

        foreach ($files as $file) {
            $dockerRun .= ' '.$file->name;
        }

        return shell_exec($dockerRun);
    }

    private function deserializeFiles(array $files) {
        $srcPath = base_path().'/docker/python';
        if (!file_exists($srcPath)) {
            mkdir($srcPath);
        }
        shell_exec("rm -rf $srcPath/*");
        foreach ($files as $file) {
            file_put_contents($srcPath.'/'.$file->name, $file->content);
        }
    }
}
