#  u10-test-task
###### Laravel v8.83.27 (PHP v7.3.0)
<br>
Архитектура проекта построена с учетом возможности расширения и поддержки функционала путем разделения реализации бизнес-логики (App\Http\Services\Delivery) от контроллера. Для этого создан абстрактный класс доставки и классы, относящиеся к конкретным видам доставки. Если в будущем возникнет необходимость добавить новые сервисы доставки, будет достаточно создать новый класс и расширить статический метод App\Http\Services\DeliveryService::checkDelivery()
<hr>

#### App\Http\Controllers\DeliveryController
Класс контроллера, отвечающий за управление заказами доставки. Он содержит метод order, который обрабатывает параметры запроса, выполняет их валидацию и обрабатывает заказ доставки

##### public function order(Request $request)
Выполняется валидация данных формы с использованием правил валидации Laravel framework<br>
Проверяется указанный сервис доставки с использованием статического метода DeliveryService::checkDelivery(), основываясь на параметре delivery из запроса<br>
Выполняется валидация данных $data в зависимости от требуемых полей тела доставки<br>
Запрос отправляется с использованием метода sendRequest() экземпляра DeliveryService<br>
Код статуса ответа получается с помощью метода getStatus() экземпляра DeliveryService<br>
Ответ возвращается в формате JSON с соответствующим кодом статуса

#### App\Http\Services\Delivery\DeliveryService

Класс DeliveryService является абстрактным классом, определяющим логику для всех видов доставки. Он предоставляет методы для валидации данных доставки, отправки запросов и управления URL и данными доставки

##### Свойства

	$url (string)
	$data (array)

##### abstract function validate(array)
Абстрактный метод для формирования данных для запроса к сервису в зависимости от его тела
##### protected function send()
Отправляет POST-запрос на указанный URL с предоставленными данными
##### static function checkDelivery(string)
Создает и возвращает экземпляр указанного сервиса доставки на основе выбранного варианта доставки

#### Роуты

##### Route::get('/delivery', [DeliveryController::class, 'order']);
Роут для отправки данных на сервис доставки

##### Пример запроса
    DOMAIN/delivery?delivery=novaposhta&customer_name=FIO here&phone=+380950000000&delivery_address=delivery address here, apt. 17&email=some@email.com&height=123&length=321&&weight=789&width=987
<br>
<br>
<hr>
<br>
<br>
The project architecture is designed with the ability to expand and support functionality by separating the implementation of business logic (App\Http\Services\Delivery) from the controller. To achieve this, an abstract delivery class and classes related to specific types of delivery have been created. If there is a need to add new delivery services in the future, it will be sufficient to create a new class and extend the static method App\Http\Services\DeliveryService::checkDelivery()
<hr>

#### App\Http\Controllers\DeliveryController
The controller class responsible for managing delivery orders. It contains an "order" method that handles request parameters, validates them, and processes the delivery order

##### public function order(Request $request)
The data form validation is performed using the validation rules provided by the Laravel framework<br>
The specified delivery service is checked using the static method<br> DeliveryService::checkDelivery(), based on the "delivery" parameter from the request<br>
The data $data is validated based on the required fields of the delivery body<br>
The request is sent using the sendRequest() method of the DeliveryService instance<br>
The response status code is obtained using the getStatus() method of the DeliveryService instance<br>
The response is returned in JSON format with the corresponding status code

#### App\Http\Services\Delivery\DeliveryService
The DeliveryService class is an abstract class that defines the logic for all types of deliveries. It provides methods for validating delivery data, sending requests, and managing the URL and delivery data

#### properties
	$url (string)
	$data (array)

##### abstract function validate(array)
Abstract method for generating request data to a service depending on its body
##### protected function send()
Sends a POST request to the specified URL with the provided data
##### static function checkDelivery(string)
Creates and returns an instance of the specified delivery service based on the selected delivery option

#### Routes

##### Route::get('/delivery', [DeliveryController::class, 'order']);
Route for sending data to the delivery service
##### Example request
    DOMAIN/delivery?delivery=novaposhta&customer_name=FIO here&phone=+380950000000&delivery_address=delivery address here, apt. 17&email=some@email.com&height=123&length=321&&weight=789&width=987