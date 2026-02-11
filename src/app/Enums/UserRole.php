<?php


Namespace App\Enums;

enum UserRole: string{
    case ADMIN = 'Admin';
    case LEARNER = 'Learner';
    case TRAINER = 'Trainer';
}
