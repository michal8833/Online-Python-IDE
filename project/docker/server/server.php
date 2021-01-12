<?php

require_once "interpreter.php";

function get_args($argc, $argv) {
    if ($argc != 3) {
        echo "[ERROR]: Incorrect number of parameters, must provide host and port\n";
        exit(1);
    }
    $args = [];

    for ($i = 1; $i < $argc; $i++) {
        $key = strtok($argv[$i], '=');
        $value = strtok('=');
        $args[$key] = $value;
    }
    return $args;
}

function get_content($connection) {

    # read all content
    $content = stream_get_contents($connection);
    $decodedContent = json_decode($content, true);
    if (!$decodedContent) {
        echo "[ERROR]: Could not decode packet contents, must be correct JSON format\n";
        echo "Content: $content\n";
        return false;
    }
    return $decodedContent;
}

function wait_for_stream($stream) {
    $result = null;
    do {
        $read = [$stream];
        $write = null;
        $except = null;
        $result = stream_select($read, $write, $except, 0);
    } while (0 === $result);
    return $result;
}

function main($argc, $argv, $reader) {
    $args = get_args($argc, $argv);

    $host = $args['host'];
    $port = $args['port'];

    $socket = stream_socket_server("tcp://$host:$port", $errno, $errstr);
    if (!$socket) {
        echo "$errstr ($errno)\n";
        exit (1);
    } else {
        while (true) {
            # wait for connection
            $conn = stream_socket_accept($socket, -1);
            stream_set_blocking($conn, false);
            if (!$conn || !is_resource($conn)) {
                echo "Connection broken\n";
                exit(1);
            }

            # get content
            $result = wait_for_stream($conn);
            $content = get_content($conn);
            if (!$content) {
                goto close_connection;
            }

            # process content
            $response = $reader($content);
            if (!$response) {
                echo "[WARNING]: Reader returned false, error has occurred\n";
                goto close_connection;
            }

            # return response
            fwrite($conn, $response);

            # close connection
            close_connection:
            fclose($conn);
        }
    }
}

main($argc, $argv, 'interpret_files');




