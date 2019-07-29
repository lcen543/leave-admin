<?php

namespace Leave\Admin\Grid\Filter;

class EndsWith extends Like
{
    protected $exprFormat = '%{value}';
}
