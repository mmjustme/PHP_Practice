<?php

class Validator
{
    protected $errors = [];
    protected $allowed_validation_methods = ['required', 'min', 'max', 'email'];
    protected $errorMessages = [
        "required" => "The ':fieldname:' field is required",
        "min" => "The ':fieldname:' field must be a minimun ':rulevalue:' characters",
        "max" => "The ':fieldname:' field must be a maximum ':rulevalue:' characters",
        "email" => "Not valid email",
    ];

    public function validate($data = [], $rules = [])
    {
        // print_arr($data);
        // print_arr($rules);

        //     [title] => Vel maxime totam qui
        //     [excerpt] => In nisi tempor offic
        //     [content] => Sint sunt et rerum o

        // print_arr($rules);

        foreach ($data as $fieldname => $value) {
            #fieldname = title, content, excerpt
            # потрібно перевірити чи данних з форми поля ("title" та ін) є в правилах перевірики
            # тобто в масиві $rules. 
            if (in_array($fieldname, array_keys($rules))) {
                # відповідно якщо поле наявне в правилах, отже, ми його маємо валідувати
                # таким чином ми контролюємо які поля валідувати                

                # передаємо в метод який буде перевіряти валідацію
                $this->check([
                    'fieldname' => $fieldname,
                    'value' => $value,
                    'rules' => $rules[$fieldname]
                ]);
                # таким чином для кожного поля вийде ось такий масив
                // [fieldname] => title
                // [value] => Vel maxime totam qui
                // [rules] => Array
                //     (
                //         [required] => 1
                //         [min] => 3
                //         [max] => 250
                //     )
            }
        }
        return $this;
    }

    protected function check($field)
    {
        // print_arr($field);
        // [fieldname] => title
        // [value] => Vel maxime totam qui
        // [rules] => Array
        //     (
        //         [required] => 1
        //         [min] => 3
        //         [max] => 250
        //     )
        # пробігаємося по масиву з правилами і перевіряємо чи  
        # такі валідатори є в нашому списку дозволених валідаторів
        foreach ($field['rules'] as $rule => $rule_value) {

            # $rule = 'required', 'min', 'max'
            // var_dump(in_array($rule, $this->allowed_validation_methods));//return true/false
            if (in_array($rule, $this->allowed_validation_methods)) {
                # якщо ми тут отже в нас наявні методи для перевірки
                # викличимо їх. 

                # щоб викоикати і застосувати метод потрібно call_user_func_array
                # фн приймає функцію яку потрібно викликати і значення які в неї покласти
                # якщо це в класі буде $this - наш склас, а метод буде в - $rule 
                // var_dump(call_user_func_array([$this, $rule], [$field['value'], $rule_value]), 'lol');
                if (!call_user_func_array([$this, $rule], [$field['value'], $rule_value])) {
                    // echo "{$field['field']} : {$rule} - failed <br>";
                    $this->addError(
                        $field['fieldname'],
                        #str_replace допоможе використати заготовані повідомлення і замінити в них слова відповідно до кожного поля
                        str_replace(
                            [":fieldname:", ":rulevalue:"],
                            [$field['fieldname'], $rule_value],
                            $this->errorMessages[$rule]
                        )
                    );
                }
            }
        }

    }

    protected function addError($fieldname, $error)
    {
        # errors[$field][] пустий масив в кінці озн що можуть бути декілька помилок для одного поля
        # відповідно вони будуть в масиві
        $this->errors[$fieldname][] = $error;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function hasErrors()
    {
        return !empty($this->errors);
    }


    # Методи які будуть перевіряти наші поля і повертати true/false відповідно до валідації
    protected function required($value, $rule_value)
    {
        # суть методу повернути true якщо пусто і requred відсутній
        # і false якщо requred є
        return !empty(trim($value));
    }

    protected function min($value, $rule_value)
    {
        return mb_strlen($value) >= $rule_value;
    }

    protected function max($value, $rule_value)
    {
        return mb_strlen($value) <= $rule_value;
    }

    protected function email($value, $rule_value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }
}