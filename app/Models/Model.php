<?php

namespace App\Models;

use Validator;
use Illuminate\Database\Eloquent\Model as BaseModel;

class Model extends BaseModel
{
	protected $rules = [];

	protected $messages = [];

	protected $errors = [];

	protected $validator;
    
    /**
     * Checks if data passed to the model is valid and then updates existing record
     *
     * @params array $input
     * @return boolean
     */
    public function update(array $attributes = [], array $options = [])
    {   
        $this->validate($attributes, "update");

        if ($this->is_valid())
        {
        	$this->update($attributes);
        }
    }

    public function save(array $options = [])
    {
    	$this->validate($this->attributes);

    	if ($this->is_valid())
    	{
    		$this->fill($this->attributes)->save($options);
    	}
    }

     /**
     * Checks if data passed to the model is valid and creates new record
     *
     * @params array $input
     * @return boolean
     */
    protected function is_valid()
    {
        if (!$this->validator->passes()) {
        	$this->errors = array('errors'=>($this->validator->messages()));
            return false;
        }

        return true;
    }
    
    
    protected function validate(array $input, $action = null)
    {
        switch($action) {
            case "update":
                $this->validator = Validator::make($input, $this->getUpdateRules($this->getKey()), $this->messages);
                break;
            default:
                $this->validator = Validator::make($input, $this->rules, $this->messages);
                break;
        }
    }
    
    /**
     * Returns validation errors
     *
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

	protected function getRulesForUpdating($id = null)
	{
		$_rules = $this->rules;

		if ($id === null) {
			return $_rules;
		}

		array_walk($_rules, function(&$_rules, $field) use ($id)
		{
			if(!is_array($_rules)) {
				$_rules = explode("|", $_rules);
            }
 
            foreach($_rules as $ruleIdx => $rule)
            {
                // get name and parameters
                @list($name, $params) = explode(":", $rule);
 
                // only do someting for the unique rule
                if(strtolower($name) != "unique") {
                    continue; // continue in foreach loop, nothing left to do here
                }
 
                $p = array_map("trim", explode(",", $params));
 
                // set field name to rules key ($field) (laravel convention)
                if(!isset($p[1])) {
                    $p[1] = $field;
                }
 
                // set 3rd parameter to id given to getValidationRules()
                $p[2] = $id;
 
                $params = implode(",", $p);
                $_rules[$ruleIdx] = $name.":".$params;
            }
        });
 
        return $_rules;
	}
}