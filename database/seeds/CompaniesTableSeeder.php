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
                'client' => true,
                'user_id' => 1

            ],

            [
                'name' =>'GRG',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => '+86 20-62878005',
                'website' => 'www.grgbanking.com',
                'client' => true,
                'user_id' => 1
            ],

            [
                'name' =>'Nick@58',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true,
                'user_id' => 1
            ],

            [
                'name' =>'Sin Hong Hardware Pte Ltd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true,
                'user_id' => 6
            ],

            [
                'name' =>'Den-Jet Industry Pte Ltd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true,
                'user_id' => 6
            ],

            [
                'name' =>'AIA Singapore',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true,
                'user_id' => 6
            ],

            [
                'name' =>'Fiat Chrysler Automobiles',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true,
                'user_id' => 6
            ],

            [
                'name' =>'FCA Asia Pacific Investment Co. Ltd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true,
                'user_id' => 6
            ],

            [
                'name' =>'Decora Art & Colour Pte Ltd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true,
                'user_id' => 1
            ],

            [
                'name' =>'Lawson Conner',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true,
                'user_id' => 1
            ],

            [
                'name' =>'Maximum',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'www.maximum.com',
                'client' => true,
                'user_id' => 1
            ],

            [
                'name' =>'Academy of Medicine, Singapore',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true,
                'user_id' => 6
            ],

            [
                'name' =>'TNO Singapore Branch',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true,
                'user_id' => 6
            ],

            [
                'name' =>'Cine Equipment',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true,
                'user_id' => 1
            ],

            [
                'name' =>'Garrets',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true,
                'user_id' => 1
            ],

            [
                'name' =>'Stylecraft',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true,
                'user_id' => 1
            ],

            [
                'name' =>'Exotissimo Travel',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true,
                'user_id' => 1
            ],

            [
                'name' =>'EEW Asia Pacific Steel Pte Ltd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true,
                'user_id' => 1
            ],

            [
                'name' =>'Hydropro',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => '67107829',
                'website' => 'www.hydropro.com.sg',
                'client' => true,
                'user_id' => 1
            ],

            [
                'name' =>'Standard Consulting Pte Ltd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true,
                'user_id' => 1
            ],

            [
                'name' =>'Powersoft',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true,
                'user_id' => 1
            ],

            [
                'name' =>'Grezzy Pte ltd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true,
                'user_id' => 1
            ],

            [
                'name' =>'Flint Group',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true,
                'user_id' => 1
            ],

            [
                'name' =>'SZMK',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true,
                'user_id' => 1
            ],

            [
                'name' =>'ICSC',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true,
                'user_id' => 1
            ],

            [
                'name' =>'Ichiya Trading Pte Ltd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true,
                'user_id' => 1
            ],

            [
                'name' =>'MagicTen',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true,
                'user_id' => 1
            ],

            [
                'name' =>'EDB',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true,
                'user_id' => 1
            ],

            [
                'name' =>'i-engine',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true,
                'user_id' => 1
            ],

            [
                'name' =>'TSC Imp & Exp Pte. Ltd.',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true,
                'user_id' => 1
            ],

            [
                'name' =>'EPSYS',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true,
                'user_id' => 1
            ],

            [
                'name' =>'Fashion One',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true,
                'user_id' => 1
            ],

            [
                'name' =>'Treverdo',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true,
                'user_id' => 1
            ],

            [
                'name' =>'Amino Group',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true,
                'user_id' => 1
            ],

            [
                'name' =>'Vertexle',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true,
                'user_id' => 1
            ],

            [
                'name' =>'Pos Connect Pte Ltd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true,
                'user_id' => 1
            ],

            [
                'name' =>'KX Technologies Pte Ltd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true,
                'user_id' => 8
            ],

            [
                'name' =>'KX Technologies Pte Ltd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true,
                'user_id' => 8
            ],

            [
                'name' =>'PDM - JLL',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true,
                'user_id' => 1
            ],

            [
                'name' =>'Braindge Singapore Pte Ltd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'www.braindge.com',
                'client' => true,
                'user_id' => 1
            ],

            [
                'name' =>'Biswell Capital',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => '625258731',
                'website' => 'nil',
                'client' => true,
                'user_id' => 1
            ],

            [
                'name' =>'Biswell Capital',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => '625258731',
                'website' => 'nil',
                'client' => true,
                'user_id' => 1
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
                'client' => true,
                'user_id' => 1
            ],

            [
                'name' =>'PDP Couriers (S) Ptd Ltd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => '98515901',
                'website' => 'www.callcitygadget.com',
                'client' => true,
                'user_id' => 1
            ],

            [
                'name' =>'Xsolla SIngapore Pte ltd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true,
                'user_id' => 1
            ],

            [
                'name' =>'Call Levels Pte Ltd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'www.call-levels.com',
                'client' => true,
                'user_id' => 1
            ],

            [
                'name' =>'Agensi Pekerjaan K2JB Sdn. Bhd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true,
                'user_id' => 6
            ],

            [
                'name' =>'Assumption Pathway School - APS',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true,
                'user_id' => 6
            ],

            [
                'name' =>'KX Technologies',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true,
                'user_id' => 6
            ],

            [
                'name' =>'Seaboard Overseas Singapore Pte Ltd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => 'nil',
                'website' => 'nil',
                'client' => true,
                'user_id' => 1
            ],

            [
                'name' =>'BRB Singapore Pte Ltd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => '67426531',
                'website' => 'http://www.brb-international.com/',
                'client' => true,
                'user_id' => 1
            ],

            [
                'name' =>'Hu An Cable Holdings Ltd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => '81002388',
                'website' => 'nil',
                'client' => true,
                'user_id' => 1
            ],

            [
                'name' =>'Ekornes Singapore Pte Ltd',
                'address' => 'nil',
                'email' => 'nil',
                'telephone_no' => '+66 (0) 2 024 9944',
                'website' => 'www.ekornes.com',
                'client' => true,
                'user_id' => 1
            ]
        ];


        foreach ($companies as $company) {
            Company::create($company);
        }
    }
}
