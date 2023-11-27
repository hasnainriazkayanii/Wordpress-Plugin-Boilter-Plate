<?php
namespace SmartWpPlugin\Requests\Emails;

use Rakit\Validation\Validator;
use SmartWpPlugin\Requests\Emails\UniqueRule;

/**
 * class UpdateValidateEmailRequest
 * @package SmartWpPlugin\Requests\Emails
 * DESCRIPTION: UpdateValidateEmailRequest Server Side Validation.
 */
class UpdateValidateEmailRequest
{
    private $erros = [];

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {

        $this->validator = new Validator;
        $this->validator->addValidator('unique', new UniqueRule());
    }    
 
    /**
     * validate_fields
     *
     * @param  mixed $params
     * @param  mixed $files
     * @return bool
     *  Description:  Validate Fields
     */
    public function validate_fields($table,$field,$params, $files=array()):bool
    {
        $validation_a = $this->validator->make($params + $files, [
            'email' => 'email|unique:'.$table.','.$field.','.$params['except'].'|unique:users,user_'.$field.','.$params['except'],
        ]);
        $validation_a->setMessages([
            'email:email'=>'Email format is inavalid',
            'email:unique'=>'Account is already associated with this email',
        ]);

        $validation_a->validate();
        if ($validation_a->fails()) {
            $this->errors = $validation_a->errors();
            return true;
        }
        return false;
    }  
      
    /**
     * fields_errors
     *
     * @return void
     * Description: Get All Errors
     */
    public function fields_errors()
    {
        return $this->errors;
    }
}
