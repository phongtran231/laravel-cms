<?php

namespace Modules\Admin\Entities;

use Illuminate\Foundation\Auth\User as Authenticate;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticate
{
  use Notifiable, HasRoles;

  protected $table = 'admins';

  protected $guarded = [
    'id'
  ];

  protected $hidden = [
    'password',
    'remember_token',
  ];
}
