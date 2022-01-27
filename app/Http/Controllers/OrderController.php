<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use RetailCrm\Api\Enum\ByIdentifier;
use RetailCrm\Api\Factory\SimpleClientFactory;
use RetailCrm\Api\Model\Filter\Orders\OrderFilter;
use RetailCrm\Api\Model\Request\BySiteRequest;
use RetailCrm\Api\Model\Request\Orders\OrdersRequest;

use App\Http\Requests\OrderRequest;

class OrderController extends Controller
{


    public function finder(OrderRequest $request)
    {
      $this->apiKey = 'QlnRWTTWw9lv3kjxy1A8byjUmBQedYqb';
      $this->domain = 'https://superposuda.retailcrm.ru';



        try {
            $name = $request->input('name');
            $article = $request->input('art');
            $brand = $request->input('brand');
            $comment = $request->input()['text'];


            //Если артикул и бренд должны быть обязательно AZ105W и Azalita, то код ниже раскомментить
            //$article = 'AZ105W';
            //$brand = 'Azalita';






            $response = Http::get("{$this->domain}/api/v5/store/products?apiKey={$this->apiKey}&filter[name]={$article}&filter[manufacturer]={$brand}");


            $this->productId = $response['products'][0]['offers'][0]['id'];


        } catch (\Exception $e) {
            throw new \DomainException('Товар отсутствует');
        }

        $name = explode(' ', $name);

        $firstName = $name[1]??'Так';

        $patronymic = $name[2]??'Нельзя';
        $surname = $name[0]??'Делать';


        $order = [
          'lastName' => $surname,
          'firstName' => $firstName,
          'patronymic' => $patronymic,
          'customerComment' => $comment,
          'items' => [
            [
              'offer' => [
                'id' => $this->productId
              ]
            ]
          ],
          'status' => 'trouble',
          'orderType' => 'fizik',
          'site' => 'test',
          'orderMethod' => 'test',
          'number' => '13062000'
        ];


        $response = Http::post("{$this->domain}/api/v5/orders/create?apiKey={$this->apiKey}", ['order' => $this->json_encode()]);

        return redirect()->route('home')->with('success', 'Заказ отправлен');
    }







}
