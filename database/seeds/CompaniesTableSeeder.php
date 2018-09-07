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
                'client' => true

            ],

            [
                'name' =>'GRG',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => '+86 20-62878005',
                'website' => 'www.grgbanking.com',
                'client' => true
            ],

            [
                'name' =>'Nick@58',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true
            ],

            [
                'name' =>'Sin Hong Hardware Pte Ltd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true
            ],

            [
                'name' =>'Den-Jet Industry Pte Ltd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true
            ],

            [
                'name' =>'AIA Singapore',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true
            ],

            [
                'name' =>'Fiat Chrysler Automobiles',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true
            ],

            [
                'name' =>'FCA Asia Pacific Investment Co. Ltd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true
            ],

            [
                'name' =>'Decora Art & Colour Pte Ltd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true
            ],

            [
                'name' =>'Lawson Conner',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true
            ],

            [
                'name' =>'Maximum',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'www.maximum.com',
                'client' => true
            ],

            [
                'name' =>'Academy of Medicine, Singapore',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true
            ],

            [
                'name' =>'TNO Singapore Branch',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true
            ],

            [
                'name' =>'Cine Equipment',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true
            ],

            [
                'name' =>'Garrets',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true
            ],

            [
                'name' =>'Stylecraft',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true
            ],

            [
                'name' =>'Exotissimo Travel',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true
            ],

            [
                'name' =>'EEW Asia Pacific Steel Pte Ltd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true
            ],

            [
                'name' =>'Hydropro',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => '67107829',
                'website' => 'www.hydropro.com.sg',
                'client' => true
            ],

            [
                'name' =>'Standard Consulting Pte Ltd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true
            ],

            [
                'name' =>'Powersoft',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true
            ],

            [
                'name' =>'Grezzy Pte ltd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true
            ],

            [
                'name' =>'Flint Group',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true
            ],

            [
                'name' =>'SZMK',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true
            ],

            [
                'name' =>'ICSC',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true
            ],

            [
                'name' =>'Ichiya Trading Pte Ltd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true
            ],

            [
                'name' =>'MagicTen',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true
            ],

            [
                'name' =>'EDB',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true
            ],

            [
                'name' =>'i-engine',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true
            ],

            [
                'name' =>'TSC Imp & Exp Pte. Ltd.',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true
            ],

            [
                'name' =>'EPSYS',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true
            ],

            [
                'name' =>'Fashion One',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true
            ],

            [
                'name' =>'Treverdo',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true
            ],
            
            [
                'name' =>'Amino Group',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true
            ],

            [
                'name' =>'Vertexle',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true
            ],

            [
                'name' =>'Pos Connect Pte Ltd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true
            ],

            [
                'name' =>'KX Technologies Pte Ltd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true
            ],

            [
                'name' =>'KX Technologies Pte Ltd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true
            ],

            [
                'name' =>'PDM - JLL',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true
            ],

            [
                'name' =>'Braindge Singapore Pte Ltd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'www.braindge.com',
                'client' => true
            ],

            [
                'name' =>'Biswell Capital',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => '625258731',
                'website' => 'nil',
                'client' => true
            ],

            [
                'name' =>'Biswell Capital',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => '625258731',
                'website' => 'nil',
                'client' => true
            ],

            [
                'name' =>'Garrets International',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true
            ],

            [
                'name' =>'Call City Pte Ltd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => '98515901',
                'website' => 'www.callcitygadget.com',
                'client' => true
            ],

            [
                'name' =>'PDP Couriers (S) Ptd Ltd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => '98515901',
                'website' => 'www.callcitygadget.com',
                'client' => true
            ],

            [
                'name' =>'Xsolla SIngapore Pte ltd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true
            ],

            [
                'name' =>'Call Levels Pte Ltd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'www.call-levels.com',
                'client' => true
            ],

            [
                'name' =>'Agensi Pekerjaan K2JB Sdn. Bhd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true
            ],

            [
                'name' =>'Assumption Pathway School - APS',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true
            ],

            [
                'name' =>'KX Technologies',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true
            ],

            [
                'name' =>'Seaboard Overseas Singapore Pte Ltd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true
            ],

            [
                'name' =>'BRB Singapore Pte Ltd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => '67426531',
                'website' => 'http://www.brb-international.com/',
                'client' => true
            ],

            [
                'name' =>'Hu An Cable Holdings Ltd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => '81002388',
                'website' => 'nil',
                'client' => true
            ],

            [
                'name' =>'Ekornes Singapore Pte Ltd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => '+66 (0) 2 024 9944',
                'website' => 'www.ekornes.com',
                'client' => true
            ]
        ];


        foreach ($companies as $company) {
            Company::create($company);
        }
    }
}
