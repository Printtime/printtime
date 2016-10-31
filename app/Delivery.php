<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Model\Order;
use GuzzleHttp\Client;

class Delivery extends Model
{
  protected $table = 'deliveries';
  
    protected $fillable = ['order_id', 'name', 'phone', 'city', 'warehouses'];
    public $timestamps = false;
    
    protected function novaposhta($name, $properties = null)
    {	


    	if($name == 'getcity' and !empty($properties)) {
	    	$this->novaposhta = [
		    	'modelName' => 'Address',
		    	'calledMethod' => 'getCities',
		    	'methodProperties' => ["FindByString" => $properties],
	    	];
    	}

    	if($name == 'city' and !empty($properties)) {
	    	$this->novaposhta = [
		    	'modelName' => 'AddressGeneral',
		    	'calledMethod' => 'getWarehouses',
		    	'methodProperties' => ["CityRef" => $properties],
	    	];
    	}

    	return $this->ApiNovaposhta();
    }

public function ApiNovaposhta()
	{	
		$data = $this->novaposhta;
		$data["apiKey"] = "5d71a3074ad7a62c7cd52dbd9403bb12";

		$data = json_encode($data);


		 $options = [
		            'headers' => [
		                'content-type' => 'application/json',
		            ],
		            'verify' => false,
		            'body' => $data
		        ];

				$client = new Client();
		        $response = $client->post('https://api.novaposhta.ua/v2.0/json/', $options);
		        return json_decode($response->getBody())->data;

    }

}
