<?php
namespace Core;

class Validator
{
	protected $fields;
	protected $rules;
	protected $errors = [];

	/**
		 * Create a new validator instance
		 *
		 * @param array $fields The data to validate
		 * @param array $rules The validation rules
		 * @return self
		 */
	public static function make(array $fields, array $rules): Validator
	{
		$validator = new static();
		$validator->fields = $fields;
		$validator->rules = $rules;

		$validator->validate();

		return $validator;
	}

	/**
		 * Run validation on the data
		 *
		 * @return void
		 */
	protected function validate(): void
	{
		foreach ($this->rules as $field => $fieldRules) {
			if (!array_key_exists($field, $this->fields) && !$this->isRequired($fieldRules)) {
				continue;
			}

			$this->validateField($field, $fieldRules);
		}
	}

	/**
		 * Validate a specific field against its rules
		 *
		 * @param string $field The field name
		 * @param string|array $fieldRules The rules for this field
		 * @return void
		 */
	protected function validateField($field, $fieldRules): void
	{
		if (is_string($fieldRules)) {
			$fieldRules = explode('|', $fieldRules);
		}

		$value = $this->fields[$field] ?? null;

		foreach ($fieldRules as $rule) {
			$parameters = [];
			if (strpos($rule, ':') !== false) {
				list($rule, $paramStr) = explode(':', $rule, 2);
				$parameters = explode(',', $paramStr);
			}

			$method = 'validate' . ucfirst($rule);

			if (method_exists($this, $method)) {
				$valid = $this->$method($field, $value, $parameters);

				if (!$valid) {
					$this->addError($field, $rule, $parameters);
				}
			}
		}
	}

	/**
		 * Check if a field is required by its rules
		 *
		 * @param string|array $rules The rules to check
		 * @return bool
		 */
	protected function isRequired($rules)
	{
		if (is_string($rules)) {
			return strpos($rules, 'required') !== false;
		}

		return in_array('required', $rules);
	}

	/**
 * Get all validated data
 *
 * @return array
 */
	public function validated()
	{
		if ($this->fails()) {
			return [];
		}

		$validatedData = [];
		foreach (array_keys($this->rules) as $field) {
			if (array_key_exists($field, $this->fields)) {
				$validatedData[$field] = $this->fields[$field];
			}
		}

		return $validatedData;
	}

	/**
		 * Add an error message for a field
		 *
		 * @param string $field The field name
		 * @param string $rule The rule that failed
		 * @param array $parameters Any parameters for the rule
		 * @return void
		 */
	protected function addError($field, $rule, array $parameters = []): void
	{
		$message = $this->getErrorMessage($field, $rule, $parameters);
		$this->errors[$field][] = $message;
	}

	/**
		 * Get the error message for a validation failure
		 *
		 * @param string $field The field name
		 * @param string $rule The rule that failed
		 * @param array $parameters Any parameters for the rule
		 * @return string
		 */
	protected function getErrorMessage($field, $rule, array $parameters)
	{
		$messages = [
			'required' => 'The :field field is required',
			'email' => 'The :field must be a valid email address',
			'min' => 'The :field must be at least :min characters',
			'max' => 'The :field may not be greater than :max characters',
			'numeric' => 'The :field must be a number',
			'string' => 'The :field must be a string',
			'in' => 'The selected :field is invalid'
		];

		$message = $messages[$rule] ?? "The :field field is invalid for rule: $rule";

		$message = str_replace(':field', $field, $message);

		if ($rule === 'min' && isset($parameters[0])) {
			$message = str_replace(':min', $parameters[0], $message);
		}

		if ($rule === 'max' && isset($parameters[0])) {
			$message = str_replace(':max', $parameters[0], $message);
		}

		return $message;
	}

	/**
		 * Check if validation fails
		 *
		 * @return bool
		 */
	public function fails(): bool
	{
		return !empty($this->errors);
	}

	/**
		 * Check if validation passes
		 *
		 * @return bool
		 */
	public function passes()
	{
		return empty($this->errors);
	}

	/**
		 * Get all validation errors
		 *
		 * @return array
		 */
	public function errors()
	{
		return $this->errors;
	}

	// Validation methods

	protected function validateRequired($field, $value, $parameters)
	{
		if (is_null($value)) {
			return false;
		} elseif (is_string($value) && trim($value) === '') {
			return false;
		} elseif (is_array($value) && count($value) < 1) {
			return false;
		}

		return true;
	}
	/**
		 * @return bool|<missing>
		 * @param mixed $field
		 * @param mixed $value
		 * @param mixed $parameters
		 */
	protected function validateEmail($field, $value, $parameters)
	{
		if (empty($value)) {
			return true;
		}

		return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
	}
	/**
		 * @return bool|<missing>
		 * @param mixed $field
		 * @param mixed $value
		 * @param mixed $parameters
		 */
	protected function validateMin($field, $value, $parameters)
	{
		if (empty($value)) {
			return true;
		}

		$min = $parameters[0] ?? 0;

		if (is_numeric($value)) {
			return $value >= $min;
		}

		return mb_strlen($value) >= $min;
	}
	/**
		 * @return bool|<missing>
		 * @param mixed $field
		 * @param mixed $value
		 * @param mixed $parameters
		 */
	protected function validateMax($field, $value, $parameters)
    {
        if (empty($value)) {
            return true;

            $max = $parameters[0] ?? 0;

            if (is_numeric($value)) {
                return $value <= $max;
            }

            return mb_strlen($value) <= $max;
        }
    }
    /**
     * @return bool
     * @param mixed $field
     * @param mixed $value
     * @param mixed $parameters
     */
    protected function validateNumeric($field, $value, $parameters)
    {
        if (empty($value)) {
            return true;
        }

        return is_numeric($value);
    }
    /**
     * @return bool
     * @param mixed $field
     * @param mixed $value
     * @param mixed $parameters
     */
    protected function validateString($field, $value, $parameters)
    {
        if (empty($value)) {
            return true;
        }

        return is_string($value);
    }
    /**
     * @return bool|array
     * @param mixed $field
     * @param mixed $value
     * @param mixed $parameters
     */
    protected function validateIn($field, $value, $parameters)
    {
        if (empty($value)) {
            return true;
        }

        return in_array($value, $parameters);
    }
}
