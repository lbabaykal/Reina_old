<?php

namespace App\Policies;

use App\Models\FolderAnime;
use App\Models\User;
use App\Reina;
use Illuminate\Auth\Access\Response;

class FolderAnimePolicy
{
    public function viewAny(User $user): Response
    {
        return Response::denyWithStatus(403);
    }

    public function view(User $user, FolderAnime $folderAnime): Response
    {
        return ($folderAnime->user_id == 0 || $folderAnime->user_id === $user->id)
            ? Response::allow()
            : Response::denyWithStatus(403);
    }

    public function create(User $user): Response
    {
        $countFolders = $user->foldersAnimes()->count();

        return ($countFolders < Reina::COUNT_FOLDERS)
            ? Response::allow()
            : Response::deny('Нельзя создавать больше ' . Reina::COUNT_FOLDERS . ' папок.');
    }

    public function update(User $user, FolderAnime $folderAnime): Response
    {
        return ($folderAnime->user_id === $user->id)
            ? Response::allow()
            : Response::denyWithStatus(403);
    }

    public function delete(User $user, FolderAnime $folderAnime): Response
    {
        return ($folderAnime->user_id === $user->id)
            ? Response::allow()
            : Response::denyWithStatus(403);
    }

}
