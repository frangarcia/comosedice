<?php

header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");	
header('Cache-Control: no-store, no-cache, must-revalidate'); 
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Content-Type: text/html; charset=UTF-8');
header('Pragma: no-cache');

class Google_API_translator {
    public $opts = array("text" => "", "language_pair" => "en|it");
    public $out = "";

    function __construct() {
    }

    function setOpts($opts) {
        if($opts["text"] != "") $this->opts["text"] = $opts["text"];
        if($opts["language_pair"] != "") $this->opts["language_pair"] = $opts["language_pair"];
    }

    function translate() {
        $this->out = "";
        $google_translator_url = "http://translate.google.com/translate_t?langpair=".urlencode($this->opts["language_pair"])."&amp;";
        $google_translator_data .= "text=".urlencode($this->opts["text"]);
        $gphtml = $this->postPage(array("url" => $google_translator_url, "data" => $google_translator_data));
        $out = substr($gphtml, strpos($gphtml, "id=result_box dir=\"ltr\">"));
        $out = substr($out, 24);
        $out = substr($out, 0, strpos($out, "</div>"));
        $this->out = $out;
        return $this->out;
    }

    // post form data to a given url using curl libs
    function postPage($opts) {
        $html = "";
        if($opts["url"] != "" && $opts["data"] != "") {
            $ch = curl_init($opts["url"]);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HEADER, 1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 15);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $opts["data"]);
            $html = curl_exec($ch);
            if(curl_errno($ch)) $html = "";
            curl_close ($ch);
        }
        return $html;
    }
}
?>
