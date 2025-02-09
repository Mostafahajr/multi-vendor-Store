<?php

namespace App\Models\Scopes;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class StoreScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        //

            $user = Auth::user();

            if ($user->store_id) {
                # code...
                 $builder->where("store_id","=",$user->store_id);
            }


    }
}
