<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoursePolicy {
    use HandlesAuthorization;

    public function __construct() {}

    // Vérifie si un cours appartient à un utilisateur lors de la modification directe de l'URL.
    // Si c'est le cas, l'édition de ce cours lui sera accordée.
    public function edit(User $user, Course $course) {
        return $user->id === $course->user->id || $user->role === 'admin';
    }
}
