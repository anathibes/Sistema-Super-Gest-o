<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AjusteProdutosFiliais extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //criando a tabela filiais 
        Schema::create('filiais', function (Blueprint $table) {
            $table->id();
            $table->string('filial', 30);
            $table->timestamps();
        });

        //criando a tabela produtos_filiais
        Schema::create('produtos_filiais', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produto_id');
            $table->unsignedBigInteger('filial_id');
            $table->decimal('preco_venda', 8, 2);
            $table->integer('estoque_minimo');
            $table->integer('estoque_maximo');
            $table->timestamps();   

            //foreign key (constraints)
            $table->foreign('produto_id')->references('id')->on('produtos');
            $table->foreign('filial_id')->references('id')->on('filiais');
        });

        //removendo colunas da tabela produtos
        Schema::table('produtos', function(Blueprint $table) {
            $table->dropColumn('preco_venda');
            $table->dropColumn('estoque_minimo');
            $table->dropColumn('estoque_maximo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //adicionar colunas da tabela produtos
        Schema::table('produtos', function(Blueprint $table) {
            $table->decimal('preco_venda', 8, 2);
            $table->integer('estoque_minimo');
            $table->integer('estoque_maximo');
        });

        Schema::dropIfExists('produtos_filiais');
        Schema::dropIfExists('filiais');
    }
}

