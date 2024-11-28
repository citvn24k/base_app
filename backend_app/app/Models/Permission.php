<?php

namespace App\Models;

class Permission extends \Spatie\Permission\Models\Permission
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     */
    public function parent()
    {
        return $this->belongsTo(Permission::class, 'parent_id')->withDefault();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     *
     */
    public function children()
    {
        return $this->hasMany(Permission::class, 'parent_id');
    }
}
