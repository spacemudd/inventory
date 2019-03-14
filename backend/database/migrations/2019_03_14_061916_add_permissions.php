<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;

class AddPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * @throws \Exception
     */
    public function up()
    {
        Permission::create([
            'name' => 'create-proposal',
            'guard_name' => 'web',
            'type' => 'system',
        ]);

        cache()->clear();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     * @throws \Exception
     */
    public function down()
    {
        $perm = Permission::findByName('create-proposal');

        if ($perm) {
            $perm->delete();
        }

        cache()->clear();
    }
}
