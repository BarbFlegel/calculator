<?php

namespace App\Presenters;


use Nette\Application\UI\Presenter;
use App\Model\CalculatorManager;
use Nette\Application\UI\Form;
use Nette\Utils\ArrayHash;

/**
 * Presenter of calculator.
 * @package App\Presenters
 */

class CalculatorPresenter extends Presenter{

    const
		FORM_MSG_REQUIRED = 'This field is required.',
		FORM_MSG_RULE = 'This is not corresct format.';

	/** @var CalculatorManager Instanse of model class for calculator's operations. */
	private $calculatorManager;
    
    /** @var int|null operation result or null */
    private $result = null;

    public function __construct(CalculatorManager $calculatorManager){
        parent::__construct();
        $this->calculatorManager = $calculatorManager;
    }

    /** The default rendering method of the presenter. */
    public function renderDefault(){
        // Passing the result in the template.
        $this->template->result = $this->result;
    }

    /**
	 * Return form calculator.
	 * @return Form calculator form.	 */

    protected function createComponentCalculatorForm(){

        $form = new Form;
        // Getting existing calculator operator and giving operation to operation selector.
        $form->addRadioList('operation', 'Operation:', $this->calculatorManager->getOperations())
            ->setDefaultValue(CalculatorManager::ADD)
            ->setRequired(self::FORM_MSG_REQUIRED);
        $form->addText('x', 'First Number:')
            ->setType('number')
            ->setDefaultValue(0)
            ->setRequired(self::FORM_MSG_REQUIRED)
            ->addRule(Form::INTEGER, self::FORM_MSG_RULE);
        $form->addText('y', 'Second Number:')
            ->setType('number')
            ->setDefaultValue(0)
            ->setRequired(self::FORM_MSG_REQUIRED)
            ->addRule(Form::INTEGER, self::FORM_MSG_RULE)
            // Solving division by zero.
            ->addConditionOn($form['operation'], Form::EQUAL, CalculatorManager::DIVIDE)
            ->addRule(Form::PATTERN, 'Cannot divide by zero.', '^[^0].*');
        $form->addSubmit('calculate', 'Calculate Result');
        $form->onSuccess[] = [$this, 'calculatorFormSucceeded'];
        return $form;
    }

    /**
     * Funkce se vykonaná při úspěšném odeslání formuláře kalkulačky a zpracuje odeslané hodnoty.
     * @param Form $form        formulář kalkulačky
     * @param ArrayHash $values odeslané hodnoty formuláře
     */
    public function calculatorFormSucceeded($form, $values) {
        // Necháme si vypočítat výsledek podle zvolené operace a zadaných hodnot.
        $this->result = $this->calculatorManager->calculate($values->operation, $values->x, $values->y);
    }
}



