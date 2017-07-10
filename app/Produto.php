<?php

namespace estoque;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    //campos que serão preenchidos em massa
    protected $fillable = array("nome", "descricao", "valor", "quantidade");

    //campo q não pode ser alterado via formulário
    protected $guarded = ["id"];
}
