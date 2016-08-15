<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Builder;
use Auth;

class Role extends Model
{    



    // protected static function boot()
    // {
    //     parent::boot();

    //     static::addGlobalScope('id', function(Builder $builder) {
    //         $builder->where('id', '>', 2);
    //     });
    // }

/**
     * A role may be given various permissions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * Grant the given permission to a role.
     *
     * @param  Permission $permission
     * @return mixed
     */
    public function givePermissionTo(Permission $permission)
    {
        return $this->permissions()->save($permission);
    }

    /**
     * A user may have multiple roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    // protected static function filteredList()
    // {
    //     #list($values) = Role::where('id', '<', '2')->get();

    //     // list($values) = Role::whereHas('users', function($q){
    //     //      $q->where('user_id', Auth::user()->id);
    //     // })->get();

    //     #list($values) = Role::where('id', '=', '2')->get();
    //     list($values) = User::where('id', '=', '2')->get();
    //     #return dd($values);
    //     return $values;
    // }

}
