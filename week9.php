<?php

//todo __clone __sleep __wakeup __setstate

// o Declareer een PHP class met de methode ‘helloWorld’ die de string "Hello World" toont op het scherm met een enter er achter (<br>). Maak een object van de class en voer de methode uit.

// o Pas de PHP class aan en voeg zowel een constructor en destructor toe welke ook dezelfde methode aanroepen mbv $this. Uiteindelijk krijg je dus 3 keer de tekst op het scherm krijgen.

// o Pas de helloWorld-methode aan en geef de mogelijkheid om argumenten mee te geven. Wanneer er geen argument is, wordt er “Hello World” getoond, en anders “Hello” met het argument er achter.

class Hello
{
	function __construct()
	{
		$this->helloWorld();
	}

	function helloWorld($arg = false)
	{
		if($arg)
			echo "Hello $arg <br>";
		else
			echo "Hello World <br>";
	}

	function __destruct()
	{
		$this->helloWorld();;
	}
}
$hello = new Hello;
$hello->helloWorld("Peter");

// o Maak een PHP calculator class waarbij je 2 waarden als argument kan meegeven, en vervolgens methodes kan aanroepen om de de uitkomst te laten zien van het optellen, aftrekken, vermenigvuldigen en delen van de waarden.
/**
* 
* Add, subtract, multiply, and divide two given arguments
* @param integer
* @return integer
*/
class Calculator
{
	function add(int $arg1, $arg2)
	{
		echo $arg1 + $arg2 . "<br>";
	}

	function subtract(int $arg1, $arg2)
	{
		echo $arg1 - $arg2 . "<br>";
	}

	function multiply(int $arg1, $arg2)
	{
		echo $arg1 * $arg2 . "<br>";
	}

	function divide(int $arg1, $arg2)
	{
		echo $arg1 / $arg2 . "<br>";
	}
}
$calc = new Calculator;
$calc->add(1, 3);
$calc->subtract(4, 3);
$calc->multiply(4, 3);
$calc->divide(4, 3);

// o Declareer een subclass van de PHP calculator class genaamd DefectiveCalculator waarbij de methode van optellen wordt overgeschreven door de parent-methode van aftrekken; en vice-versa.

// o Voeg ook een methode toe aan deze subclass om de naam van de class en method op het scherm te tonen via de PHP-keywords hiervoor.

class DefectiveCalculator extends Calculator
{
	static	$var = 'blah';

	function add(int $arg1, $arg2)
	{
		echo parent::subtract($arg1, $arg2);
	}
	function subtract(int $arg1, $arg2)
	{
		echo parent::add($arg1, $arg2);
	}

	function getClassAndMethod()
	{
		echo get_class($this) . "<br>";
		print_r(get_class_methods($this)) . "<br>";
	}

}
$defCalc = new DefectiveCalculator;
$defCalc->add(4, 5);
$defCalc->subtract(8, 5);
$defCalc->getClassAndMethod();

// o Roep de methodes van de subclass via een andere methode dynamisch aan via de $obj->$var en $obj->{expression}() syntax. Daarnaast maak een object van de class dynamisch aan ala (new myClass)->callMyFunction(123).


$dCalc = new DefectiveCalculator();
$dyn = "subtract";
$dCalc->{$dyn}(4, 5);
$dynDefCalc = (new DefectiveCalculator)->add(24, 5);


// o Maak een class aan waarbij je alle 4 de visibility-opties toepast bij properties of methods: public, protected, private en final.

class Father
{
	private $weight;
	protected $height = 170;

	final function getLastName()
	{
		return  "Buttocks";
	}

	public function setWeight(int $arg)
	{
		if($arg > 40)
		{
			$this->weight = $arg;
		}
		else
		{
			$this->weight = 40;
		}
	}

	public function getWeight()
	{
		return $this->weight;
	}
}
$father = new Father;
$father->setWeight(3);
echo $father->getWeight();

class Son extends Father
{
	function getHeight()
	{
		return $this->height - 25;
	}
}
$son = new Son;
echo $son->getHeight();
echo $son->getLastName();
// o Pas een Constant toe in een class en echo de constante zowel binnen als buiten de class

class Cnst
{
	const CON = "constant";

	public function const()
	{
		echo self::CON;
	}
}
$con = new Cnst;
$con->const();
echo Cnst::CON;

// o Neem de code over & de uitleg door over static op de volgende websites: 
// o http://chipersoft.com/p/PHP-many-meanings-of-static/ 
// o https://www.leaseweb.com/labs/2014/04/static-versus-self-php/
class Foo
{
	public $memberProperty;

	static $staticProperty = array(10, 23, 104);

	function memberFunction()
	{
		$localVariable = 1;
	}

	static function staticFunction()
	{
		self::$staticProperty = 2;
	}

	function exampleA()
	{
		$this->memberProperty = 3;
	}

	function exampleB ()
	{
		static $staticVariable = 4;
	}
}

$blah = new Foo();
$blah->memberProperty = 7;

// $this->exampleD();

// parent::memberFunction();


class BadExample
{
	static function Singleton()
	{
		static $o;

		if (!$o) 
			$o = new static();

		return $o;
	}
}

// o Declareer een StaticCalculator class aan met static methods voor het optellen en aftrekken. Voer de methods ook uit zonder een object aan te maken.

class StaticCalculator
{
	static function add($arg1, $arg2)
	{
		echo $arg1 + $arg2;
	}

	static function subtract($arg1, $arg2)
	{
		echo $arg1 - $arg2;
	}
}
StaticCalculator::add(4, 2);
StaticCalculator::subtract(4, 2);

// o Declareer een abstracte class aan waarin je de abstracte methods voor een Calculator class definieert. Maak in dezelfde abstracte class ook een public method aan die de abstracte methods uitvoert.

// o Declareer een class die de bovenstaande abstracte class overerft en invult.

// o Declareer een Interface voor de Calculator waarin je specificeert welke methods geïmplementeerd moeten worden

// o Declareer een tweede Interface en laat 1 class beide interfaces implementeren

// o Controleer in een method met de instanceof keyword of een class beide interfaces heeft geimplementeerd.

interface ICalc
{
	public function executeCalc($arg1, $arg2);
}

interface ICalc2
{
	public function executeCalc($arg1, $arg2);
}

abstract class AbstractCalculator implements ICalc, ICalc2
{
	abstract function add($arg1, $arg2);

	public function executeCalc($arg1, $arg2)
	{
		$this->add($arg1, $arg2);
	}
}

class Exec extends AbstractCalculator
{
	public function add($arg1, $arg2)
	{
		echo $arg1 + $arg2;
	}

	public function checkInstanceOf($arg)
	{
		if($arg instanceof ICalc && $arg instanceof ICalc2)
		{
			echo 'Implemented both interfaces';
		}

	}
}
$exec = new Exec;
$exec->executeCalc(432, 5);
$exec->checkInstanceOf($exec);


// o De magic methods __construct & __destruct zijn eerder toegepast bij 1 van de opdrachten; pas ook de volgende magic methods toe in 1 van je classes: __get(), __set(), /_isset(), __empty(), __call(), __callStatic(), __clone(), __sleep(), __wakeup(), __set_start(), __toString(), __debugInfo()

//WiP __empty() bestaat niet?
class Blah
{
	private $names;
	private $emptyProp;
	public $cloneMe;
	public $thing;

	public function __construct($thing)
	{
		$this->thing = "What's a $thing?";
	}

	public function __set($setName, $nameValue)
	{
		$this->names[$setName] = $nameValue;
	}

	public function __get($getName)
	{
		if(array_key_exists($getName, $names))
		{
			return $this->names[$getName];
		}
	}
	public function __isset($property)
	{
		echo "no $property property set";
	}

	public function __empty($property)
	{
		echo "$property is empty";
	}

	public function __call($name, $arguments)
	{
		echo "Calling object method '$name' " . implode(', ', $arguments). "\n";
	}

	public static function __callStatic($name, $arguments)
	{
		echo "Calling static method '$name' " . implode(', ', $arguments). "\n";
	}

		// public function __clone()
		// {
		// 	$this->cloneMe = clone $this->cloneMe;
		// }
		// public function __sleep()
		// {
		//     return  array("I am", "Asleep");
		// }
		
		// public function __wakeup()
		// {
		// 	$this->connect();
		// }

	public function __toString()
	{
		return $this->thing;
	}

	public function __debugInfo()
	{
		return ['DebugInfo' => $this->thing];
	}
}
$b = new Blah;
$b->firstname = 'Blaha';
$b->lastname = "dahw";
echo "<br>";
isset($b->ages);
echo "<br>";
empty($b->emptyProp);
echo "<br>";
$b->doSomething("ARgh");
echo "<br>";
Blah::cmooon("do something");
echo "<br>";
// $c = clone $b;
// var_dump($b);
// var_dump($c);
echo "<br>";
$dwd = new Blah("wdaidw");
echo $dwd;
echo "<br>";
var_dump(new Blah(42));

// o Maak een anonieme class met minimaal 1 methode; toon aan dat deze werkt
$anon = new class( 'Anonymous' ) extends Father
{
	protected $weight = 77;

	public function talk()
	{
		echo "hello";
	}
};

$anon->setWeight(80);
echo $anon->getWeight();
echo $anon->talk();

// o Pas Lazy Loading toe om automatisch classes in te laden
function __autoload($class)
{
	require_once('extra.php');
}
$abc = new Abc;
$abc->xyz();

// o Pas de ReflectionClass toe op 1 van je classes (waarbij je commentaar gebruikt) en beschrijf hiermee automatisch je class en methods.
$class = new ReflectionClass("Calculator");
var_dump($class->getDocComment());
var_dump($class->getProperties());
var_dump($class->getMethods());

// · Closures & Calbacks
// o Doorloop de stappen voor anonieme functies, closures & callbacks op deze website: http://www.elated.com/articles/php-anonymous-functions/

// o Doorloopt de stappen voor closures op deze website: https://www.phphulp.nl/php/tutorial/php-functies/php-53-closures/631/

// o Experimenteer met closures waarbij je variabelen toe past, variabelen via een reference en ook $this keyword.

class InsultGenerator
{
	private $exclamation = "!";

	public function insult()
	{
		$start = "You are a ";
		$combine = function($word1, $word2) use ($start)
		{
			return("$start $word1 $word2$this->exclamation");
		};
		$words1 = array("Stupid", "Dumb", "Ugly", "Retarded", "Shitty", "Crappy");
		$words2 = array("Cunt", "Asshole", "Bastard", "Douche", "Fuck", "Bitch");

		$word1 = $words1[rand(0, count($words1) - 1)];
		$word2 = $words2[rand(0, count($words2) - 1)];

		echo $combine($word1, $word2);
	}
}
$insult = new InsultGenerator;
$insult->insult();

// o Maak 1 class waarbij je via het $this keyword verwijst naar een niet-bestaande method & niet-bestaande property in die class. Maak vervolgens een nieuwe class aan met de method & property die nog niet bestaan. Koppel deze classes via een closure en de bindTo-methode.

// o Doe bovenstaande, alleen dan met de statische bind-methode

// o In PHP7 is Closure:call() toegevoegd als vervanging van bindTo. Laat zien hoe deze werkt

class Someone
{
	function getFortune()
	{
		return function()
		{
			$this->getFuture();
			echo $this->lastDayOnEarth;
		};
	}
}

class Future
{
	public $lastDayOnEarth = "15-aug-2070";

	function getFuture()
	{
		$future = array('Bright', 'Foggy', 'Dark');
		echo $future[count($future) - 1];
	}
}

$som1 = new Someone;
$closure = $som1->getFortune();
$future = new Future;

//dynamic
// $newClosure = $closure->bindTo($future, 'Future');

//static
// $newClosure = Closure::bind($closure, $future, 'Future');
// $newClosure();

//PHP 7 
$closure->call($future);

// o Pas je eigen callback functie toe in 1 van de array-functies, bijv usort

$food = array( 
	array("food" => "Bacon", "rating" => 9),
	array("food" => "Broccoli", "rating" => 7),
	array("food" => "Vinnegar", "rating" => 3)
);

usort($food, function($food1, $food2)
{
	return($food1["rating"] < $food2["rating"] ) ? 1 : -1;
});
print_r($food);

// o Declareer een class met een __invoke() methode en gebruik deze ook in de array-functie hierboven

// WiP

// · Traits
// o Definieer een Trait en pas deze toe in een class

trait BRGenerator
{
	public function br($arg)
	{
		while($arg > 0)
		{
			echo "<br>";
			$arg--;
		}
	}
}

class RandText
{
	use BRGenerator;
	
	public function genText()
	{
		$characters = str_split('abcdefghijklmnopqrstuvwxyz,.');

		for($i = 0; $i < 1000; $i++)
		{
			$r = $characters[rand(0, count($characters) - 1)];
			echo $r;
			if($r == '.')
			{
				self::br(1);
			}
		}
	}
}
$rt = new RandText;
$rt->genText();

// o Definieer 2 Trait’s en gebruik deze in een andere Trait
// o Defineer 2 Traits met dezelfde methode; probeer deze toe te passen. Los de fatal error op met insteadof

trait Apple
{
	public function apple()
	{
		echo "<br> A is for Apple.";
	}

	public function eat()
	{
		echo "Ate the apple";
	}
}

trait Banana
{
	public function banana()
	{
		echo "<br> B is for Banana.";
	}

	public function peel()
	{
		echo "Peeled the banana";
	}
}

trait AppleSauce
{
	public function apple()
	{
		echo "<br> A is for Apple sauce;.";
	}
}

trait Fruit
{
	use Apple, Banana, AppleSauce
	{
		AppleSauce::apple insteadof Apple;
	}

	public function abc()
	{
		self::apple();
		self::eat();
		self::banana();
		self::peel();
		self::cherry();
	}
}

// o Defineer 2 Traits met diverse methodes; defineer een class met dezelfde methodes en pas de Trait ook toe. Beschrijf welke methode voorrang heeft

class BanApple
{
	use Apple, Banana, AppleSauce 
	{
		Apple::apple as computer;
		Banana::peel as bpeel;
	}

	public function apple()
	{
		echo "<br> A is for Apple Pie.";
	}

	public function eat()
	{
		echo "Ate the apple Pie";
	}

	public function banana()
	{
		echo "<br> B is for Banana Boat.";
	}

	public function peel()
	{
		echo "Peed the Banana Boat";
	}
}
$banApple = new BanApple;
$banApple->apple(); //A is for Apple Pie class method heeft voorrang

// o Maak 2 aliassen van diverse methodes uit 1 van de eerdere Traits

$banApple->computer();
$banApple->bpeel();

// · Implementeer de Iterator interface

class Checklist implements Iterator
{
	protected $checklist = array('cooking', 'homework', 'cleaning', 'homework', 'laundry', 'homework', 'garbage');
	protected $current = 0;

	function current()
	{
		return $this->checklist[$this->current];
	}
	function next()
	{
		$this->current += 2;
	}
	function rewind()
	{
		$this->current = 0;
	}
	function key()
	{
		return $this->current;
	}
	function valid()
	{
		return isset($this->checklist[$this->current]);
	}
}

$list = new Checklist;

foreach($list as $Key => $value)
{
	echo "$key $value<br>";
}
// · Experimenteer met 2 andere Iterators (SeekableIterator, RecursiveIteratorIterator, FilterInterator, CallbackFilterInterator, LimitIterator, CachingIterator, MultipleIterator, of RecursiveTreeIterator )
class Checklist2 extends Checklist implements SeekableIterator
{
	public function seek($index)
	{
		$this->current = $index;
	}
} 
$list2 = new Checklist2;

$list2->seek(3);
echo $list2->current();
echo "<br>";

class HomeWorkFilter extends FilterIterator
{
	private $taskFilter;	

	public function __construct(Iterator $iterator , $filter)
	{
		parent::__construct($iterator);
		$this->taskFilter = $filter;
	}
   
	public function accept()
	{
		$task = $this->getInnerIterator()->current();
		if($task !== $this->taskFilter)
		{
			return true;
		}
		return false;
	}
}

$checklist = array('cooking', 'homework', 'cleaning', 'homework', 'laundry', 'homework', 'garbage');
$object = new ArrayObject($checklist);

// Note it is case insensitive check in our example due the usage of strcasecmp function
$iterator = new HomeWorkFilter($object->getIterator(),'homework');

foreach ($iterator as $result) {
    echo $result;
}

// · Maak een functie met een for-loop waarbij je de yield-keyword toe pas 
echo "<br>";
function yieldLoop()
{
	for($i = 0; $i < 10; $i++)
	{
		yield $i;
	}
}

$getYield = yieldLoop();

foreach($getYield as $y)
{
	echo $y;
}
?>