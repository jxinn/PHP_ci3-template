<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Extends CI_Controller.
 */
class MY_Controller extends CI_Controller 
{
// ------------------------------------------------------------------------
    /**
     * Response message. 
     * 
     * @var array
     */
    protected $response_message = [
        'TP_0000' => 'Success Message', // Success. ()
        'TP_0001' => '',                // Success. (No message)
        'TP_9999' => 'Try it later',    // Fail. (If the error code does not exist)
        'TP_1000' => '',                // Validation failed. (message = /config/form_validation.php)
    ];
// ------------------------------------------------------------------------
    public function __construct()
    {
        parent::__construct();
    }
// ------------------------------------------------------------------------
    /**
     * Get response data.
     * 
     * @param string $code     Response code. 
     * @param string $message  Response Message.
     * @param array  $add_data Response add data.
     * 
     * @return string
     */
    protected function getResData(string $code, string $message = '', array $add_data = []): string {
        if (!array_key_exists($code, $this->response_message)) {
            $code = 'TP_9999';
        }

        $result = [
            'code'    => $code,
            'result'  => ($code == 'TP_0000' || $code == 'TP_0001') ? 'success' : 'fail',
            'message' => $this->code_message[$code],
        ];

        if (count($add_data) > 0) {
            $result = array_merge($result, $add_data); 
        }

        return json_encode($result, JSON_UNESCAPED_UNICODE);
    } 
// ------------------------------------------------------------------------
}