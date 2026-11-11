<?php

namespace App\Policies;

use App\Models\Activity;
use App\Models\User;

/**
 * Dokumentasi harian:
 * - Kontributor: membuat catatan & mengubah catatannya sendiri selama masih draf.
 * - Editor / Super Admin: semua, termasuk menerbitkan.
 */
class ActivityPolicy
{
    public function viewAny(User $user): bool { return true; }

    public function view(User $user, Activity $a): bool
    {
        return $user->canPublish() || $a->author_id === $user->id;
    }

    public function create(User $user): bool { return true; }

    public function update(User $user, Activity $a): bool
    {
        return $user->canPublish() || ($a->author_id === $user->id && $a->status === 'draft');
    }

    public function delete(User $user, Activity $a): bool
    {
        return $this->update($user, $a);
    }

    public function deleteAny(User $user): bool { return $user->canPublish(); }
}
