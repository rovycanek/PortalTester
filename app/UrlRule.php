<?php

namespace App;

use Illuminate\Contracts\Validation\Rule;

class UrlRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {

        if (filter_var($value, FILTER_VALIDATE_IP,FILTER_FLAG_IPV4)) {
            return TRUE;
        }



        $validation = FALSE;
        /*Parse URL*/    $urlparts = parse_url(filter_var($value, FILTER_SANITIZE_URL));
        /*Check host exist else path assign to host*/    if(!isset($urlparts['host'])){
            $urlparts['host'] = $urlparts['path'];
        }
    
        if($urlparts['host']!=''){
           /*Add scheme if not found*/        if (!isset($urlparts['scheme'])){
                $urlparts['scheme'] = 'https';
            }
            /*Validation*/        if(checkdnsrr($urlparts['host'], 'A') && in_array($urlparts['scheme'],array('https')) && ip2long($urlparts['host']) === FALSE){ 
                $urlparts['host'] = preg_replace('/^www\./', '', $urlparts['host']);
                $url = $urlparts['scheme'].'://'.$urlparts['host']. "/";            
                
                if (filter_var($url, FILTER_VALIDATE_URL) !== false && @get_headers($value)) {
                    $validation = TRUE;
                }
            }
        }
        return $validation;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Invalid form, use adress in IPv4 (127.0.0.1) or DNS name in full form (https://domainmame.com)';
    }
}