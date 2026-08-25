<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('artigos', function (Blueprint $table) {

            if (!Schema::hasColumn('artigos', 'titulo')) {
                $table->string('titulo');
            }

            if (!Schema::hasColumn('artigos', 'imagem')) {
                $table->string('imagem')->nullable();
            }

            if (!Schema::hasColumn('artigos', 'conteudo')) {
                $table->longText('conteudo');
            }

            if (!Schema::hasColumn('artigos', 'status')) {
                $table->boolean('status')->default(true);
            }

        });
    }

    public function down(): void
    {
        Schema::table('artigos', function (Blueprint $table) {

            if (Schema::hasColumn('artigos', 'imagem')) {
                $table->dropColumn('imagem');
            }

            if (Schema::hasColumn('artigos', 'conteudo')) {
                $table->dropColumn('conteudo');
            }

            if (Schema::hasColumn('artigos', 'status')) {
                $table->dropColumn('status');
            }

        });
    }
};