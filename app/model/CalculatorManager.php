<?php

//MODEL of calculator with four main operations (Addition, Subtraction, Multiplication, Division)
    //class CalculatorManager
        //1. uses php trait Nette/SmartObject ()
            //TRAITS: mechanism for code reuse in single inheritance (similar to a class,but only intended to group functionality in a fine-grained and consistent way)
                //e.g: 
                    //trait ezcReflectionReturnInfo {
                    //function getReturnType() { }
                    //function getReturnDescription() { }
                    //}
                    //class ezcReflectionMethod extends ReflectionMethod {
                    //use ezcReflectionReturnInfo;
                    //}
        //2. defines four operations:
                        //Addition
                        //Subtraction
                        //Multiplication
                        //Division

namespace App\Model;

use Nette\SmartObject;
/**
 * Model of calculator
 * @package App\Model
 */
class CalculatorManager{

    use SmartObject;

    /** Definition of constant for operations */
    const
        ADD = 1,
        SUBTRACT = 2,
        MULTIPLY = 3,
        DIVIDE = 4;

    /**
    * Getter for existing operation
    * @return array associative array of constants for operations and theirs denomination
    */
    public function getOperations(){
        return array(
            self::ADD => 'Add',
            self::SUBTRACT => 'Subtract',
            self::MULTIPLY => 'Multiply',
            self::DIVIDE => 'Divide'
        );
    }

    /**
    * Calls entered operations and returns its result.
    * @param int $operation entered operation
    * @param int $x         first number for operation
    * @param int $y         second number of operation
    * @return int|null operation result or null if entered operation does not exist 
    */
    public function calculate($operation, $x, $y){
        switch ($operation) {
            case self::ADD:
                return $this->add($x, $y);
            case self::SUBTRACT:
                return $this->subtract($x, $y);
            case self::MULTIPLY:
                return $this->multiply($x, $y);
            case self::DIVIDE:
                return $this->divide($x, $y);
            default:
                return null;
        }
    }
        
    
    /**
     * Adding numbers and returns result. 
     * @param int $x first number
     * @param int $y second number 
     * @return int  adding result
     */
    public function add($x, $y){
        return $x + $y;
    }

    /**
     * Subtracting second number from first and returns result.
     * @param int $x first number
     * @param int $y second number 
     * @return int  subtracting result
     */
    public function subtract($x, $y)
    {
        return $x - $y;
    }

    /**
     * Multiplying numbers and returns result. 
     * @param int $x first number
     * @param int $y second number 
     * @return int  multiplying result
     */
    public function multiply($x, $y)
    {
        return $x * $y;
    }

    /**
     * Dividing numbers and returns result. 
     * @param int $x first number
     * @param int $y second number; cannot be 0
     * @return int  dividing result without remainder  
     */
    public function divide($x, $y)
    {
        return round($x / $y);
    }
}