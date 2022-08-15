<?php

namespace inc\artemy\v1\request_body_parser;

use Riverline\MultiPartParser\StreamedPart;

class RequestBodyParser
{
    private static RequestBodyParser $singleton;
    private array $files = [];
    private array $request = [];

    private function __construct()
    {
        if (in_array($_SERVER['REQUEST_METHOD'], ["GET", "HEAD"])) return false;
        if (!isset($_SERVER["CONTENT_TYPE"])) return false;


        $input = file_get_contents('php://input');


        // if user sent input as "multipart/form-data"
        if (str_starts_with($_SERVER["CONTENT_TYPE"], "multipart/form-data; boundary=--------------------------")) {
            $headers = (function () {
                $arr = [];
                foreach (getallheaders() as $name => $header) {
                    $arr[] .= "$name: $header";
                }

                return implode("\n", array_reverse($arr));
            })();

            $input_file = fopen('php://temp', 'rw');
            fwrite($input_file, $headers . "\n\n" . $input);
            $document = new StreamedPart($input_file);
            fclose($input_file);

            foreach ($document->getParts() as $part) {
                if ($part->isFile()) {
                    $temp_filename = tempnam("/tmp", "");
                    $handle = fopen($temp_filename, "w");
                    fwrite($handle, $part->getBody());
                    $this->files[$part->getName()] = [
                        "name" => $part->getFileName(),
                        "type" => $part->getMimeType(),
                        "server_computed_type" => mime_content_type($temp_filename),
                        "size" => mb_strlen($part->getBody(), 'binary'),
                        "tmp_name" => $temp_filename
                    ];
                } else {
                    $this->request[$part->getName()] = $part->getBody();
                }
            }
        } elseif ($_SERVER["CONTENT_TYPE"] === "application/x-www-form-urlencoded") {
            // if user sent input as "multipart/form-data"
            foreach (explode('&', $input) as $chunk) {
                $param = explode("=", $chunk);

                if ($param) {
                    $this->request[urldecode($param[0])] = urldecode($param[1]);
                }
            }
        } elseif ($_SERVER["CONTENT_TYPE"] === "application/json") {
            // if user sent input as "application/json"
            $this->request = json_decode($input, true);
        }

        return true;
    }

    static function singleton(): RequestBodyParser
    {
        if (!isset(self::$singleton)) {
            self::$singleton = new RequestBodyParser();
        }

        return self::$singleton;
    }

    public function getRequest(): array
    {
        return $this->request;
    }

    public function getFiles(): array
    {
        return $this->files;
    }
}