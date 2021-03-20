class MY_Input extends CI_Input {

public function __construct() {
    parent::__construct();
}

public function post($index = NULL, $xss_clean = NULL){
    if($xss_clean){
        $json = json_decode($this->security->xss_clean($this->raw_input_stream), true);
    } else {
        $json = json_decode($this->raw_input_stream, true);
    }
    if($json){
        if($index){
            return isset($json[$index]) ? $json[$index] : NULL;
        }
        return $json;
    } else {
        return parent::post($index, $xss_clean);
    }
}

}