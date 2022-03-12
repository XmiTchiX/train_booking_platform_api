<?php
namespace App\Http\Repositories;

use App\Models\User;
Class UserRepository 
{
    public function all()
    {
        $query = User::all()->reject(function($user) {
            return ($user->deleted_at != NULL || $user->id == auth()->user()->id);
        });

        return $query;
    }

    public function deleteById($id)
    {
        $query = User::find($id);
        if($query) {
            $query->delete();
        }
        return $query;
    }

    public function restoreById($id)
    {
        $query = User::onlyTrashed()->where('id', $id)->first();
        if($query) {
            $query->restore();
        }
        return $query;
    }

    public function destoryById($id)
    {
        $query = User::onlyTrashed()->where('id',$id)->first();
        if($query) {
            $query->forceDelete();
        }
        return $query;
    }
}

