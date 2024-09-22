<?php
use classes\A;
use classes\test\B;

// require_once 'app/A.php';
// require_once 'classes/A.php';

#фн для автозавантаження класів
spl_autoload_register(function ($class) {
    # в перемінну class попадає назва класу
    # відповідно можемо ств шлях до файлу з класом і підключити його
    # якщо класи в різних папках і з однаковим імям допоможе пропросторові імена класів (namespace)
    $filename = "{$class}.php"; //в імя класу вже включений шлях до нього
    require_once $filename;

});

# після ств просторового імені створення класу А запропонує обрати який саме з app чи classes
# можна підключати по різному
new app\A();
new A();
new B();