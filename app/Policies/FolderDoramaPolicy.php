<?php

namespace App\Policies;

use App\Models\FolderDorama;
use App\Models\User;
use App\Reina;
use Illuminate\Auth\Access\Response;

class FolderDoramaPolicy
{
    public function viewAny(User $user): Response
    {
        return Response::denyWithStatus(403);
    }

    public function view(User $user, FolderDorama $folderDorama): Response
    {
        return ($folderDorama->user_id == 0 || $folderDorama->user_id === $user->id)
            ? Response::allow()
            : Response::denyWithStatus(403);
    }

    public function create(User $user): Response
    {
        $countFolders = $user->foldersDoramas()->count();

        return ($countFolders < Reina::COUNT_FOLDERS)
            ? Response::allow()
            : Response::deny('Нельзя создавать больше ' . Reina::COUNT_FOLDERS . ' папок.');
    }

    public function update(User $user, FolderDorama $folderDorama): Response
    {
        return ($folderDorama->user_id === $user->id)
            ? Response::allow()
            : Response::denyWithStatus(403);
    }

    public function delete(User $user, FolderDorama $folderDorama): Response
    {
        return ($folderDorama->user_id === $user->id)
            ? Response::allow()
            : Response::denyWithStatus(403);
    }

}
