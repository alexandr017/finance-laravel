<?php

namespace App\Repositories\Site\Bank;

use App\Models\Banks\BankInfoPage;

class BankInfoPageRepository
{
    public function getBankByAlias(int $bankID, int $typeID) : ?BankInfoPage
    {
        return BankInfoPage::where(['bank_id' => $bankID, 'type_id' => $typeID, 'status' => 1])->first();
    }
}