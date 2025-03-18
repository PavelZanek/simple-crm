<?php

declare(strict_types=1);

namespace App\Enums;

final class CastTypeEnum
{
    public const string STRING = 'string';
    public const string BOOL = 'bool';
    public const string INT = 'int';
    public const string DECIMAL = 'decimal';
    public const string DATE = 'date';
    public const string DATETIME = 'datetime';
    public const string ARRAY = 'array';
    public const string FLOAT = 'float';
    public const string HASHED = 'hashed';
}
