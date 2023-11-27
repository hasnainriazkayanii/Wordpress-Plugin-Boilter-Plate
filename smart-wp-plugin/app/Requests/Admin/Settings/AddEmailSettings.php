<?php
namespace SmartWpPlugin\Requests\Admin\Settings;
use Rakit\Validation\Validator;

/**
 * class AddEmailSettings
 * @package SmartWpPlugin\Requests\Admin\Settings
 * DESCRIPTION: AddEmailSettings Server Side Validation.
 */
class AddEmailSettings
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
    } 

    /**
     * validate_fields
     *
     * @param  mixed $params
     * @param  mixed $files
     * @return bool
     * Description:  Validate Fields
     */
    public function validate_fields($params, $files=array()):bool
    {
        $validation_a = $this->validator->make($params + $files, [
            'from_name' => 'required',
            'from_email' => 'required|email',
            'from_phone'=>'required|numeric',
        ]);
        $validation_a->setMessages([
            'from_name:required' => 'Contact Name can not be empty',
            'from_email:required' => 'Contact Email can not be empty',
            'from_email:email' => 'Contact Email is not a valid email',
            'from_phone:required'=>'Contact Phone is required',
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
     * Description:  Get All Errors
     */
    public function fields_errors()
    {
        return $this->errors;
    }
}
