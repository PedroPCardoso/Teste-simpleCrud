<?php
namespace App\Helper;

use App\Models\Emprestimo;
use Carbon\Carbon;

class EmprestimosHelper{


    public static function AtualizarStatusParaPendente($emprestimos){
        $emprestimos->each(function($emprestimo){
            if((new self)->foraDoPrazo($emprestimo)){
                $emprestimo->update(['status'=>Emprestimo::STATUS_ATRASADO]);
                $emprestimo->save();
            }
        });
    }

    private static function foraDoPrazo($emprestimo){
        if(Carbon::createFromDate($emprestimo->data_fim)->diffInDays(Carbon::now()) > Emprestimo::PRAZO_LIMITE_EM_DIAS
        && $emprestimo->status == Emprestimo::STATUS_EMPRESTADO
        ){
            return true;
        }
    }

}