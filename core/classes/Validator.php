<?php

class Validator
{
    protected $errors = [];

    public function validate($data = [], $rules = [])
    {
        print_arr($data);
        //     [title] => Vel maxime totam qui
        //     [excerpt] => In nisi tempor offic
        //     [content] => Sint sunt et rerum o

        print_arr($rules);

        foreach ($data as $field => $value) {
            # потрібно перевірити чи данних з форми поля ("title" та ін) є в правилах перевірики
            # тобто в масиві $rules. 
            if (in_array($field, array_keys($rules))) {
                # відповідно якщо поле наявне в правилах, отже, ми його маємо валідувати
                # таким чином ми контролюємо які поля валідувати                

                # передаємо в метод який буде перевіряти валідацію
                $this->check([
                    'field' => $field,
                    'value' => $value,
                    'rules' => $rules[$field]
                ]);
                # таким чином для кожного поля вийде ось такий масив
                // [field] => title
                // [value] => Vel maxime totam qui
                // [rules] => Array
                //     (
                //         [requred] => 1
                //         [min] => 3
                //         [max] => 250
                //     )
            }
        }
    }

    protected function check($field, )
    {
        print_arr($field);

    }
}