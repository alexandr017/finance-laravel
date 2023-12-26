<?php

namespace App\Models\AffiliateProgram;

use App\Models\BaseModel;

class AffiliateProgramAnalysis extends BaseModel
{
    protected $table = 'affiliate_program_analysis';

    protected $fillable = [
        'card_id',
        'affiliate_program_id_1',
        'affiliate_program_id_2',
        'affiliate_program_id_3',
        'affiliate_program_id_4',
        'affiliate_program_id_5',
        'affiliate_program_id_6',
        'affiliate_program_id_7',
        'affiliate_program_id_8',
        'current_affiliate_program_id',
        'comment'
    ];
}
