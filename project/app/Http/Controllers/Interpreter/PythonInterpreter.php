<?php


namespace App\Http\Controllers\Interpreter;

class PythonInterpreter {

    public function __construct() {
    }

    public function interpret(array $files, string $input, string $args) : InterpreterResponse {
        $this->deserializeFiles($files);
        $filenames = array_map(function($file) { return $file['name']; }, $files);
        $dockerRun = $this->buildDockerRunCommand($filenames, $args);

        $descriptors = [
            0 => ['pipe', 'r'],
            1 => ['pipe', 'w'],
            2 => ['pipe', 'w']
        ];

        $dockerProc = proc_open($dockerRun, $descriptors, $pipes);
        if (!is_resource($dockerProc)) {
            return InterpreterResponse::fail("Error opening docker process!!!");
        }
        if (is_resource($pipes[0])) {
            if (false === fwrite($pipes[0], $input)) {
                return InterpreterResponse::fail("Error writing input to stdin!!!");
            }
            fclose($pipes[0]);
        }
        $stdout = '';
        $stderr = '';
        if (is_resource($pipes[1])) {
            $stdout = stream_get_contents($pipes[1]);
            fclose($pipes[1]);
        }
        if (is_resource($pipes[2])) {
            $stderr = stream_get_contents($pipes[2]);
            fclose($pipes[2]);
        }

        $result = proc_close($dockerProc);
        return InterpreterResponse::ok($result, $stdout, $stderr);
    }

    private function buildDockerRunCommand(array $filenames, string $args) {
        $srcPath = base_path().'/docker/python';

        $dockerRun = "docker run \
            --mount type=bind,source=$srcPath,target=/usr/src/app \
            --rm \
            -i \
            --name ".env('DOCKER_CONTAINER_NAME')." ".env('DOCKER_CONTAINER_NAME').' -B';

        foreach ($filenames as $name) {
            $dockerRun .= ' '.$name;
        }

        return $dockerRun.$args;
    }

    private function deserializeFiles(array $files) {
        $srcPath = base_path().'/docker/python';
        if (!file_exists($srcPath)) {
            mkdir($srcPath);
        }
        shell_exec("rm -rf $srcPath/*");
        foreach ($files as $file) {
            file_put_contents($srcPath.'/'.$file['name'], base64_decode($file['content']));
        }
    }
}
