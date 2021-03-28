<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RelationAllTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('outlet_id')->references('id')->on('outlets')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('pakets', function (Blueprint $table) {
            $table->foreign('outlet_id')->references('id')->on('outlets')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('transaksis', function (Blueprint $table) {
            $table->foreign('outlet_id')->references('id')->on('outlets')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('detail_transaksis', function (Blueprint $table) {
            $table->foreign('transaksi_id')->references('id')->on('transaksis')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('paket_id')->references('id')->on('pakets')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['outlet_id']);
        });

        Schema::table('pakets', function (Blueprint $table) {
            $table->dropForeign(['outlet_id']);
        });

        Schema::table('transaksis', function (Blueprint $table) {
            $table->dropForeign(['outlet_id']);
            $table->dropForeign(['user_id']);
        });

        Schema::table('detail_transaksis', function (Blueprint $table) {
            $table->dropForeign(['transaksi_id']);
            $table->dropForeign(['paket_id']);
        });
    }
}
