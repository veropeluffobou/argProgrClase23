<?php
// Creación de una clase "Persona"
class Persona {
    private $nombre;
    private $edad;
    private $email;

    public function __construct($nombre, $edad, $email) {
        $this->nombre = $nombre;
        $this->edad = $edad;
        $this->email = $email;
    }

    public function imprimirDatos() {
        echo "Nombre: " . $this->nombre . ", Edad: " . $this->edad . ", Email: " . $this->email . "\n";
    }
}

// Herencia
class Empleado extends Persona {
    private $puesto;

    public function __construct($nombre, $edad, $email, $puesto) {
        parent::__construct($nombre, $edad, $email);
        $this->puesto = $puesto;
    }

    public function imprimirDatos() {
        parent::imprimirDatos();
        echo "Puesto: " . $this->puesto . "\n";
    }
}

// Polimorfismo e interfaces
interface iVehiculo {
    public function acelerar();
    public function frenar();
}

class Automovil implements iVehiculo {
    public function acelerar() {
        echo "El automóvil está acelerando.\n";
    }

    public function frenar() {
        echo "El automóvil está frenando.\n";
    }

    public function imprimirDatos() {
        echo "Automóvil\n";
    }
}

class Bicicleta implements iVehiculo {
    public function acelerar() {
        echo "La bicicleta está acelerando.\n";
    }

    public function frenar() {
        echo "La bicicleta está frenando.\n";
    }

    public function imprimirDatos() {
        echo "Bicicleta\n";
    }
}

// Abstracción y encapsulamiento
class CuentaBancaria {
    private $saldo;
    private $numeroCuenta;

    public function setSaldo($saldo) {
        $this->saldo = $saldo;
    }

    public function getSaldo() {
        return $this->saldo;
    }

    public function setNumeroCuenta($numeroCuenta) {
        $this->numeroCuenta = $numeroCuenta;
    }

    public function getNumeroCuenta() {
        return $this->numeroCuenta;
    }

    public function depositar($cantidad) {
        $this->saldo += $cantidad;
    }

    public function retirar($cantidad) {
        if ($this->saldo >= $cantidad) {
            $this->saldo -= $cantidad;
        } else {
            echo "Saldo insuficiente.\n";
        }
    }
}

// Creación de una clase abstracta
abstract class FiguraGeometrica {
    abstract public function calcularArea();
}

class Cuadrado extends FiguraGeometrica {
    private $lado;

    public function __construct($lado) {
        $this->lado = $lado;
    }

    public function calcularArea() {
        return $this->lado * $this->lado;
    }
}

class Triangulo extends FiguraGeometrica {
    private $base;
    private $altura;

    public function __construct($base, $altura) {
        $this->base = $base;
        $this->altura = $altura;
    }

    public function calcularArea() {
        return 0.5 * $this->base * $this->altura;
    }
}

// Creación de una clase Singleton
class ConexionDB {
    private static $instancia = null;
    private $conexion;

    private function __construct() {
        $this->conexion = new PDO("mysql:host=localhost;dbname=mi_base_de_datos", "usuario", "contraseña");
    }

    public static function getConexion() {
        if (self::$instancia == null) {
            self::$instancia = new ConexionDB();
        }
        return self::$instancia->conexion;
    }
}

// Creación de una clase Factory
class Mascota {
    private $nombre;
    private $edad;

    public function __construct($nombre, $edad) {
        $this->nombre = $nombre;
        $this->edad = $edad;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getEdad() {
        return $this->edad;
    }
}

class Perro extends Mascota {
    private $raza;

    public function __construct($nombre, $edad, $raza) {
        parent::__construct($nombre, $edad);
        $this->raza = $raza;
    }

    public function getRaza() {
        return $this->raza;
    }
}

class Gato extends Mascota {
    private $pelaje;

    public function __construct($nombre, $edad, $pelaje) {
        parent::__construct($nombre, $edad);
        $this->pelaje = $pelaje;
    }

    public function getPelaje() {
        return $this->pelaje;
    }
}

class MascotaFactory {
    public static function crearMascota($especie, $nombre, $edad, $propiedadEspecie) {
        if ($especie === 'perro') {
            return new Perro($nombre, $edad, $propiedadEspecie);
        } elseif ($especie === 'gato') {
            return new Gato($nombre, $edad, $propiedadEspecie);
        } else {
            return null;
        }
    }
}

// Creación de una clase Trait
trait Color {
    private $color;

    public function setColor($color) {
        $this->color = $color;
    }

    public function getColor() {
        return $this->color;
    }
}

class AutomovilConColor {
    use Color;

    public function imprimirDatos() {
        echo "Automóvil de color " . $this->getColor() . "\n";
    }
}

class BicicletaConColor {
    use Color;

    public function imprimirDatos() {
        echo "Bicicleta de color " . $this->getColor() . "\n";
    }
}

// Ejemplo de uso
$persona = new Persona("Juan", 30, "juan@example.com");
$persona->imprimirDatos();

$empleado = new Empleado("Ana", 25, "ana@example.com", "Gerente");
$empleado->imprimirDatos();

$automovil = new Automovil();
$automovil->acelerar();
$automovil->imprimirDatos();

$bicicleta = new Bicicleta();
$bicicleta->frenar();
$bicicleta->imprimirDatos();

$cuenta = new CuentaBancaria();
$cuenta->setSaldo(1000);
$cuenta->setNumeroCuenta("123456");
echo "Saldo: " . $cuenta->getSaldo() . ", Número de Cuenta: " . $cuenta->getNumeroCuenta() . "\n";

$cuenta->depositar(500);
echo "Saldo después del depósito: " . $cuenta->getSaldo() . "\n";
$cuenta->retirar(300);
echo "Saldo después del retiro: " . $cuenta->getSaldo() . "\n";

$cuadrado = new Cuadrado(5);
echo "Área del cuadrado: " . $cuadrado->calcularArea() . "\n";

$triangulo = new Triangulo(6, 4);
echo "Área del triángulo: " . $triangulo->calcularArea() . "\n";

$conexion = ConexionDB::getConexion();
// Utiliza la conexión a la base de datos aquí

$perro = MascotaFactory::crearMascota("perro", "Rex", 3, "Labrador");
echo "Mascota: " . $perro->getNombre() . ", Edad: " . $perro->getEdad() . ", Raza: " . $perro->getRaza() . "\n";

$gato = MascotaFactory::crearMascota("gato", "Mittens", 2, "Siamese");
echo "Mascota: " . $gato->getNombre() . ", Edad: " . $gato->getEdad() . ", Pelaje: " . $gato->getPelaje() . "\n";

$autoConColor = new AutomovilConColor();
$autoConColor->setColor("Rojo");
$autoConColor->imprimirDatos();

$biciConColor = new BicicletaConColor();
$biciConColor->setColor("Azul");
$biciConColor->imprimirDatos();
