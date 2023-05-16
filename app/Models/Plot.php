<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plot extends BaseModel
{
    use HasFactory;

    #todo при необходимости вынести в отдельный класс
    /**
     * Здесь описываются название колонок этой модели
     * Кадастральный номер
     */
    const CADASTRAL_NUMBER_COLUMN = 'cadastral_number';
    /**
     * Id участка
     */
    const ID = 'id';

    /**
     * Здесь хранится json всего ответа
     */
    const DATA_COLUMN = 'data';
    /**
     * Время истечения валидности
     */
    const EXPIRES_AT_COLUMN = 'expires_at';
    /**
     * Адрес
     */
    const ADDRESS_COLUMN = 'address';
    /**
     * Площадь участка
     */
    const AREA_COLUMN = 'area';
    /**
     * Цена участка
     */
    const PRICE_COLUMN = 'price';

//    /**
//     * Здесь описывается свойствав Модели. Описывем их, чтобы избавиться от контейнера свойств.
//     *
//     * @var int
//     */
//    public int $id;
//    /**
//     * @var string
//     */
//    public string $cadastral_number;
//    /**
//     * @var string|array
//     */
//    public string|array $data;
//    /**
//     * @var string
//     */
//    public string $expires_at;
//    /**
//     * @var string
//     */
//    public string $address;
//    /**
//     * @var float
//     */
//    public float $price;
//    /**
//     * @var float
//     */
//    public float $area;
//

    /**
     * @var string[]
     */
    protected $fillable = [
        self::CADASTRAL_NUMBER_COLUMN,
        self::DATA_COLUMN,
        self::EXPIRES_AT_COLUMN,
        self::ADDRESS_COLUMN,
        self::AREA_COLUMN,
        self::PRICE_COLUMN
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        self::DATA_COLUMN => 'array',
        self::EXPIRES_AT_COLUMN => 'datetime'
    ];
}
