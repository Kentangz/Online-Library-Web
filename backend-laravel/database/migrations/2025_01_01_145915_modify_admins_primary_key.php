<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyAdminsPrimaryKey extends Migration
{
    public function up()
    {
        Schema::table('admins', function (Blueprint $table) {
            // Jika ada primary key sebelumnya, hapus
            $table->dropPrimary();

            // Ubah nama kolom dari 'id_admin' ke 'id'
            $table->renameColumn('id_admin', 'id');

            // Ubah tipe kolom id menjadi unsignedBigInteger
            $table->unsignedBigInteger('id')->autoIncrement()->change();

            // Tentukan primary key baru untuk kolom 'id'
            $table->primary('id');
        });
    }

    public function down()
    {
        Schema::table('admins', function (Blueprint $table) {
            // Hapus primary key yang baru
            $table->dropPrimary();

            // Ubah nama kolom kembali menjadi 'id_admin'
            $table->renameColumn('id', 'id_admin');

            // Tentukan primary key baru untuk kolom 'id_admin'
            $table->primary('id_admin');
        });
    }
}
