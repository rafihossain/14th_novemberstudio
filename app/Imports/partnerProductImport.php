<?php

namespace App\Imports;

use App\Models\ImportPartnerProduct;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class partnerProductImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function  __construct($import_id)
    {
        $this->import_id = $import_id;
    }

    public function model(array $row)
    {
        $excelPartner = new ImportPartnerProduct();
        $excelPartner->partner_product_id = $this->import_id;
        $excelPartner->partner_name = $row['partner_name'];
        $excelPartner->partner_email = $row['partner_email'];
        $excelPartner->registration_number = $row['registration_number'];
        $excelPartner->currency_code = $row['currency_code'];
        $excelPartner->street = $row['street'];
        $excelPartner->city = $row['city'];
        $excelPartner->state = $row['state'];
        $excelPartner->zip_code = $row['zip_code'];
        $excelPartner->country = $row['country'];
        $excelPartner->phone_number = $row['phone_number'];
        $excelPartner->country_code = $row['country_code'];
        $excelPartner->website = $row['website'];
        $excelPartner->save();

        return $excelPartner;

        // dd($excelPartner);
    }
}
