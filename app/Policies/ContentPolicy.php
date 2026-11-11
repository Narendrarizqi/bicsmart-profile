<?php

namespace App\Policies;

use App\Models\User;

/**
 * Konten umum (Berita, FAQ, Tim, Desa): hanya Editor & Super Admin.
 */
abstract class ContentPolicy
{
    public function viewAny(User $user): bool { return $user->canPublish(); }
    public function view(User $user, $model): bool { return $user->canPublish(); }
    public function create(User $user): bool { return $user->canPublish(); }
    public function update(User $user, $model): bool { return $user->canPublish(); }
    public function delete(User $user, $model): bool { return $user->canPublish(); }
    public function deleteAny(User $user): bool { return $user->canPublish(); }
}
