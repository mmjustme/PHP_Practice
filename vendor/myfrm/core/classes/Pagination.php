<?php

namespace myfrm;

class Pagination
{
  public int $count_pages = 1;
  public int $current_page = 1;
  public string $uri = '';
  # властивості для гнучкої пагінації, к-ть сторінок по бокам від основної
  public int $mid_size = 3;
  # властивость для відображання усіх сторінок якщо їх не багато
  public int $all_pages = 7;

  public function __construct(
    # мінімальні значення для старту
    public int $page = 1,
    public int $per_page = 1,
    public int $total = 1,
  )
  {
    $this->count_pages = $this->getCountPages();
    $this->current_page = $this->getCurrentPage();
    $this->uri = $this->getParams();
    $this->mid_size = $this->getMidSize();
  }

  private function getCountPages(): int
  {
    # ceil заокруглює в більшу сторону значення 0.2 = 1, тощо
    # ?: - озн. якщо "ceil($this->total / $this->per_page)" = true беремо, якщо ж ні тоді 1.
    return ceil($this->total / $this->per_page) ?: 1;
  }

  private function getCurrentPage(): int
  {
    # якзо юзер вручну впише в адрессну строку ?page=0, ?page=10000
    # потрібно первірити і вписати правильні дані, якщо сторінка менше 1 ставимо мінімальну тобто 1
    if ($this->page < 1) $this->page = 1;
    # якщо сторінка більша за максимально можливу ставимо максимально можливу
    if ($this->page > $this->count_pages) $this->page = $this->count_pages;
    return $this->page;
  }

  public function getStart(): int
  {
    return ($this->current_page - 1) * $this->per_page;
  }

  private function getParams(): string
  {
    # /?page=33&foo=bar - приклад строки $uri
    $url = $_SERVER['REQUEST_URI'];
    # { [0]=> string(1) "/" [1]=> string(15) "page=33&foo=bar" }
    $url = explode('?', $url);
    $uri = $url[0];

    if (isset($url[1]) && $url[1] != '') {
      $uri .= '?';
      # параметри можна виділити через explode і отримати масив з нич
      # при цьому параметр page потріно викинути
      $params = explode('&', $url[1]);
      foreach ($params as $param) {
        #str_contains перевірить чи в масиві $param є значення 'page='
        if (!str_contains($param, 'page=')) {
          $uri .= "{$param}&";
        }
      }
    }
    return $uri;
  }

  public function getHtml(): string
  {
    $back = '';
    $forward = '';
    $start_page = '';
    $end_page = '';
    $pages_left = '';
    $pages_right = '';

    # посилання на сторінку назад
    if ($this->current_page > 1) {
      $back = "<li class='page-item'><a class='page-link' 
        href='" . $this->getLink($this->current_page - 1) . "'>&lt;</a></li>";
    }

    # посилання на сторінку вперед
    if ($this->current_page < $this->count_pages) {
      $forward = "<li class='page-item'><a class='page-link' 
        href='" . $this->getLink($this->current_page + 1) . "'>&gt;</a></li>";
    }

    # посилання на початкову сторінку
    if ($this->current_page < $this->mid_size + 1) {
      $start_page = "<li class='page-item'><a class='page-link' 
        href=''" . $this->getLink(1) . "''>&laquo;</a></li>";
    }

    # посидання на останню сторінку
    if ($this->current_page < ($this->count_pages - $this->mid_size)) {
      $end_page = "<li class='page-item'><a class='page-link' 
        href='" . $this->getLink($this->count_pages) . "'>&raquo;</a></li>";
    }

    # формуємо динамучно кількість сторінок зліва від поточної
    for ($i = $this->mid_size; $i > 0; $i--) {
      if ($this->current_page - $i > 0) {
        $pages_left .= "<li class='page-item'><a class='page-link' 
           href='" . $this->getLink($this->current_page - $i) . "'>
        " . ($this->current_page - $i) . "</a></li>";
      }
    }

    # формуємо динамучно кількість сторінок праворуч від поточної
    for ($i = 1; $i <= $this->mid_size; $i++) {
      if ($this->current_page + $i <= $this->count_pages) {
        $pages_right .= "<li class='page-item'><a class='page-link' 
           href=" . $this->getLink($this->current_page + $i) . ">
        " . ($this->current_page + $i) . "</a></li>";
      }
    }

    return '<nav arial-label="Page navigation example"><ul class="pagination">' . $start_page . $back . $pages_left
      . '<li class="page-item active"><a class="page-link">' . $this->current_page . '</a></li>' . $pages_right .
      $forward . $end_page . '</ul></nav>';
  }

  private function getLink($page): string
  {
    if ($page == 1) {
      # вирізаємо символи ? & якщо ми на сторінці 1
      return rtrim($this->uri, "?&");
    }

    if (str_contains($this->uri, '&') || str_contains($this->uri, '?')) {
      # якщо є параметри ми їх добавимо до строки
      return "{$this->uri}page={$page}";
    } else {
      # якщо нема параметрів добавляємо номер сторінки
      return "{$this->uri}?page={$page}";
    }
  }

  # додаємо функціонал відбраження усіх сторінок якщо їх не багато
  private function getMidSize(): int
  {
    return $this->count_pages <= $this->all_pages ? $this->count_pages : $this->mid_size;
  }

  public function __toString(): string
  {
    return $this->getHtml();
  }
}
