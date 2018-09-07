<?php

use Illuminate\Database\Seeder;
use App\Models\Clients\Company;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //factory(App\Models\Clients\Company :: class, 20) -> create();

        DB::table('companies')->delete();

        $companies = [
            [
                'name' =>'ADC Power Concept Pte Ltd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => '66862906',
                'website' => 'www.adcpowerconcept.com',
                'transaction' => true

            ],

            [
                'name' =>'GRG',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => '+86 20-62878005',
                'website' => 'www.grgbanking.com',
                'transaction' => true
            ],

            [
                'name' =>'Nick@58',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'transaction' => true
            ],

            [
                'name' =>'Sin Hong Hardware Pte Ltd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'transaction' => true
            ],

            [
                'name' =>'Den-Jet Industry Pte Ltd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'transaction' => true
            ],

            [
                'name' =>'AIA Singapore',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'transaction' => true
            ],

            [
                'name' =>'Fiat Chrysler Automobiles',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'transaction' => true
            ],

            [
                'name' =>'FCA Asia Pacific Investment Co. Ltd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'transaction' => true
            ],

            [
                'name' =>'Decora Art & Colour Pte Ltd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'transaction' => true
            ],

            [
                'name' =>'Lawson Conner',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'transaction' => true
            ],

            [
                'name' =>'Maximum',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'www.maximum.com',
                'transaction' => true
            ],

            [
                'name' =>'Academy of Medicine, Singapore',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'transaction' => true
            ],

            [
                'name' =>'TNO Singapore Branch',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'transaction' => true
            ],

            [
                'name' =>'Cine Equipment',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'transaction' => true
            ],

            [
                'name' =>'Garrets',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'transaction' => true
            ],

            [
                'name' =>'Stylecraft',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'transaction' => true
            ],

            [
                'name' =>'Exotissimo Travel',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'transaction' => true
            ],

            [
                'name' =>'EEW Asia Pacific Steel Pte Ltd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'transaction' => true
            ],

            [
                'name' =>'Hydropro',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => '67107829',
                'website' => 'www.hydropro.com.sg',
                'transaction' => true
            ],

            [
                'name' =>'Standard Consulting Pte Ltd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'transaction' => true
            ],

            [
                'name' =>'Powersoft',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'transaction' => true
            ],

            [
                'name' =>'Grezzy Pte ltd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'transaction' => true
            ],

            [
                'name' =>'Flint Group',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'transaction' => true
            ],

            [
                'name' =>'SZMK',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'transaction' => true
            ],

            [
                'name' =>'ICSC',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'transaction' => true
            ],

            [
                'name' =>'Ichiya Trading Pte Ltd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'transaction' => true
            ],

            [
                'name' =>'MagicTen',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'transaction' => true
            ],

            [
                'name' =>'EDB',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'transaction' => true
            ],

            [
                'name' =>'i-engine',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'transaction' => true
            ],

            [
                'name' =>'TSC Imp & Exp Pte. Ltd.',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'transaction' => true
            ],

            [
                'name' =>'EPSYS',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'transaction' => true
            ],

            [
                'name' =>'Fashion One',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'transaction' => true
            ],

            [
                'name' =>'Treverdo',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'transaction' => true
            ],
            
            [
                'name' =>'Amino Group',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'transaction' => true
            ],

            [
                'name' =>'Vertexle',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'transaction' => true
            ],

            [
                'name' =>'Pos Connect Pte Ltd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'transaction' => true
            ],

            [
                'name' =>'KX Technologies Pte Ltd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'transaction' => true
            ],

            [
                'name' =>'KX Technologies Pte Ltd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'transaction' => true
            ],

            [
                'name' =>'PDM - JLL',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'transaction' => true
            ],

            [
                'name' =>'Braindge Singapore Pte Ltd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'www.braindge.com',
                'transaction' => true
            ],

            [
                'name' =>'Biswell Capital',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => '625258731',
                'website' => 'nil',
                'transaction' => true
            ],

            [
                'name' =>'Biswell Capital',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => '625258731',
                'website' => 'nil',
                'transaction' => true
            ],

            [
                'name' =>'Garrets International',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'transaction' => true
            ],

            [
                'name' =>'Call City Pte Ltd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => '98515901',
                'website' => 'www.callcitygadget.com',
                'transaction' => true
            ],

            [
                'name' =>'PDP Couriers (S) Ptd Ltd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => '98515901',
                'website' => 'www.callcitygadget.com',
                'transaction' => true
            ],

            [
                'name' =>'Xsolla SIngapore Pte ltd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'transaction' => true
            ],

            [
                'name' =>'Call Levels Pte Ltd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'www.call-levels.com',
                'transaction' => true
            ],

            [
                'name' =>'Agensi Pekerjaan K2JB Sdn. Bhd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'transaction' => true
            ],

            [
                'name' =>'Assumption Pathway School - APS',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'transaction' => true
            ],

            [
                'name' =>'KX Technologies',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'transaction' => true
            ],

            [
                'name' =>'Seaboard Overseas Singapore Pte Ltd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'transaction' => true
            ],

            [
                'name' =>'BRB Singapore Pte Ltd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => '67426531',
                'website' => 'http://www.brb-international.com/',
                'transaction' => true
            ],

            [
                'name' =>'Hu An Cable Holdings Ltd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => '81002388',
                'website' => 'nil',
                'transaction' => true
            ],

            [
                'name' =>'Ekornes Singapore Pte Ltd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => '+66 (0) 2 024 9944',
                'website' => 'www.ekornes.com',
                'transaction' => true
            ]
        ];


        foreach ($companies as $company) {
            Company::create($company);
        }
    }
}
