<?php

declare(strict_types=1);

namespace App\Enums;

enum Status: string
{
    case draft = 'Entwurf';
    case published = 'Veröffentlicht';
    case archived = 'Archiviert';
}
