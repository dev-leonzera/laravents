<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToInscritosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inscritos', function (Blueprint $table) {
            $table->unsignedBigInteger('tipos_inscricao_id')->nullable();
            $table->foreign('tipos_inscricao_id')->references('id')->on('tipos_inscricao')->onDelete('set null');
            $table->string('congregacao')->nullable();
            $table->enum('status', ['pendente', 'aprovado', 'rejeitado'])->default('pendente');
            $table->enum('camisa_tipo', ['masculino', 'baby-look']);
            $table->enum('camisa_tamanho', ['PP', 'P', 'M', 'G', 'GG', 'XG']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inscritos', function (Blueprint $table) {
            $table->dropForeign(['tipos_inscricao_id']);
            $table->dropColumn('tipos_inscricao_id');
            $table->dropColumn('congregacao');
            $table->dropColumn('status');
        });
    }
}
