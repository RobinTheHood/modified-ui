<?php

namespace RobinTheHood\ModifiedUi\Classes\Admin;

class TablePanel extends Table
{
    private $pageination = null;

    public function addPagination($pagination)
    {
        $this->pagination = $pagination;
    }

    public function render()
    {
        $html = parent::render();
        //$html .= $this->renderPagination();
        return $html;
    }

    public function renderPagination()
    {
        if ($this->pagination) {
            return $this->pagination->render();
        }
    }
}
