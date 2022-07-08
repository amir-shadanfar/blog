<?php

namespace App\Enum;

enum DisplayMode: string
{
    use EnumToArray;
    
    case LIST = 'List';
    case PAGINATE = 'Paginate';
}
