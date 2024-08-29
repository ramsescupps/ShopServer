<?php

declare(strict_types=1);

namespace App\Models;



/**
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $dtCreate
 * @property \Illuminate\Support\Carbon $dtUpdate
 * @property \Illuminate\Support\Carbon|null $dtDelete
 * @property string $name
 * @property string $text
 * @property int $adminId
 *
 * @property Admin $admin
 */
class OperationBase extends AbstractModel
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Operation';

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [

        'dtCreate' => 'datetime',
        'dtUpdate' => 'datetime',
        'dtDelete' => 'datetime',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [

    ];

    static function keyzz(): array
    {
        return [

            'id',
            'dtCreate',
            'dtUpdate',
            'dtDelete',
            'name',
            'text',
            'adminId',
        ];
    }



    public function admin()
    {
        return $this->belongsTo(Admin::class, 'adminId');
    }

}