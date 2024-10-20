<?php

namespace myfrm;

class Pagination
{
  public int $count_pages = 1;
  public int $current_page = 1;
  public string $uri = '';
  # властивості для гнучкої пагінації, к-ть сторінок по бокам від основної
  public int $mid_size = 2;
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
}