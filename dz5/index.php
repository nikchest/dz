class Car 
{
	public $speed; //скорость
	public $direction; //направлени вперед или назад
	public $distance; //расстояние

	public function Move($distance, $speed, $direction)
	{
		$this->distance = $distance;
		$this->speed = $speed;
		$this->direction = $direction;
		echo 'Автомобиль едет '.$this->distance.' со скоростью '.$this->speed.' по направлению '.$this->direction;
	}
	

}

//$auto = new Car;
//$auto->Move('200 метров', '10 м\с', 'вперед');



class Engine extends Car
{
	public $condition;
	public $power = 2; //1 лошадиная сила = 2м\с
	public $temperature;

	public function СonditionEngine($condition)
	{
		$this->condition = $condition;

		if ($this->condition == 1) {
			echo '<br>Двигатель включен!<br>';
		} else {
			echo '<br>Двигатель выключен!<br>';
		}
	}

	public function EngineCooling()
	{
		
		$this->temperature = $temperature;
		$this->temperature = $this->distance / 10 * 5;
		
		if ($this->temperature = 90) {
			echo '<br>Температура двигателя: '.$this->temperature.' градусов<br>';
			//public function EngineCoolingOn()
			//{
				$this->temperature = $this->temperature - 10;
				echo '<br>Температура после включения вентилятора: '.$this->temperature.' градусов<br>';
			//}
		}
		
	}

}


$engine = new Engine;
$engine->СonditionEngine(1);
$engine->Move('200 метров', '10 м\с', 'вперед');
$engine->EngineCooling();



/*
echo "<pre>";
var_dump($auto);*/
