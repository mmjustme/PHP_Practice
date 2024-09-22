<?php
use classes\A;
use classes\test\B;

// require_once 'app/A.php';
// require_once 'classes/A.php';

#фн для автозавантаження класів
spl_autoload_register(function ($class) {
    var_dump($class);
    # в перемінну class попадає назва класу
    # відповідно можемо ств шлях до файлу з класом і підключити його
    # якщо класи в різних папках і з однаковим імям допоможе пропросторові імена класів (namespace)

    # замінемо слеші \ на / щоб і на лінукс системах працював шлях до файлу

    # \\ - двічі прописуємо оск \ не спрацює з екрануючим слешем тому \\
    $filename = str_replace("\\", DIRECTORY_SEPARATOR, $class) . ".php";
    # DIRECTORY_SEPARATOR - зберігає роздільник шляху в залежності від операційної сисстеми
    var_dump($filename);
    require_once $filename;

});

# після ств просторового імені створення класу А запропонує обрати який саме з app чи classes
# можна підключати по різному
new app\A();
new A();
new B();