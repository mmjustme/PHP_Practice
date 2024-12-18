<?php

namespace myfrm;
class Validator
{
  protected $errors = [];
  protected $allowed_validation_methods = ['required', 'min', 'max', 'email', 'unique', 'ext', 'size'];
  protected $errorMessages = [
    "required" => "The ':fieldname:' field is required",
    "min" => "The ':fieldname:' field must be a minimun ':rulevalue:' characters",
    "max" => "The ':fieldname:' field must be a maximum ':rulevalue:' characters",
    "email" => "Not valid email",
    "ext" => "Not valid extension. Use :rulevalue:",
    "unique" => "The :fieldname: have been already taken",
    "size" => "File :fieldname: is too big. Allowed max size 1M ",
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
      if (isset($rules[$fieldname])) {
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

  public function listErrors($fieldname)
  {
    $output = '';
    if (isset($this->errors[$fieldname])) {
      $output .= "<div class='invalid-feedback d-block'><ul class='list-unstyled'>";
      foreach ($this->errors[$fieldname] as $error) {
        $output .= "<li>{$error}</li>";
      }
      $output .= '</ul></div>';
    }
    return $output;
  }


  # Методи які будуть перевіряти наші поля і повертати true/false відповідно до валідації
  protected function required($value, $rule_value)
  {
    # суть методу повернути true якщо пусто і requred відсутній
    # і false якщо requred є
    return !empty($value);
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

  protected function unique($value, $rule_value): bool
  {
    // dump($value); //string(23) "butesolo@mailinator.com"
    // dd($rule_value); //string(11) "users:email"

    $data = explode(':', $rule_value);
    // dump($data); // array(2) {[0]=>string(5) "users"[1]=>string(5) "email"}

    # шукаємо в БД імейл і через getColumn отримаємо сам імейл або false
    # оск метод повертає ""(пуста строка) а це false якщо не знайде і імейл якщо знайде його в БД а це true

    # інвертуємо значення через !, щоб якщо знайшли такий імел в базі вертаємо false
    return (!db()->query("SELECT $data[1] FROM $data[0] WHERE $data[1] = ?", [$value])->getColumn());
  }

  protected function ext($value, $rule_value)
  {
    # перша перевірка чи взагалі є файл. Через поле name перевіримо
    # повертаючи true ми робимо поле опційним
    $fileName = $value['name'] ?? '';
    if (empty($fileName)) return true;

    $allowedExtensions = explode('|', $rule_value);
    $fileExtension = getFileExt($fileName);

    return in_array($fileExtension, $allowedExtensions);
  }

  protected function size($value, $rule_value)
  {
    # в масиві вже є розмір файлу в байтах
    $fileSize = $value['size'] ?? '';
    if (empty($fileSize)) return true;

    return $value['size'] <= $rule_value;
  }
}