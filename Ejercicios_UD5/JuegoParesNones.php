<?php
class JuegoParesNones
{
    // Atributo que indica el número máximo
    private $numero_maximo;

    // Constructor
    public function __construct($_numero)
    {
        if (($_numero > 10) || ($_numero < 1)) {
            throw new OutOfRangeException("El número debe estar entre 1 y 10");
        } else {
            $this->numero_maximo = $_numero;
        }
    }

    // Función para saber el número máximo del juego
    public function getNumeroMaximo()
    {
        return $this->numero_maximo;
    }

    // Método para jugar, se le pasa un número y si quieres pares (P) o nones (N)
    public function jugar($_numero, $_eleccion)
    {
        if (($_numero > $this->numero_maximo) || ($_numero < 0)) {
            throw new OutOfRangeException("El número no está en el rango permitido");
        } else {
            $numero_aleatorio = rand(0, $this->numero_maximo);
            if ((($numero_aleatorio + $_numero) % 2) == 0) {
                if ($_eleccion == 'P') {
                    return true;
                } else {
                    return false;
                }
            } else {
                if ($_eleccion == 'P') {
                    return false;
                } else {
                    return true;
                }
            }
        }
    }
}
?>