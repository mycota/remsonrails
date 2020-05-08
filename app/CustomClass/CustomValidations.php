<?php


namespace App\CustomClass;
use DateTime;


class CustomValidations
{
    private $values;
	private $model;
	private $column;
	private $id;
	private $length;

	public function ishumanNames($name){

		$this->values = $name;
	 	if($this->values === null or preg_match("/^[a-zA-Z ]+$/", $this->values) === 0){
	 		return true;
	 	}else{ return false; }
		// echo "The value that came is ".$this->values;

	}

	public function isotherNames($othername){

		$this->values = $othername;
		if($this->values === null or preg_match("/^[a-zA-Z ]+$/", $this->values) === 0){
	 		return true;
	 	}else{ return false; }


	}

	public function isotherNamesSymbols($othername){

		$this->values = $othername;
		if($this->values === null or preg_match("/^[a-zA-Z0-9 &-.]+$/", $this->values) === 0)
		{
	 		return true;
	 	}else{ return false; }


	}

	public function isnumbers($numbers){

		$this->values = $numbers;
		if($this->values === null or preg_match("/^[0-9]+$/", $this->values) === 0){
	 		return true;
	 	}else{ return false; }
	}

	public function isfloatingPoints($float){

		$this->values = $float;
		if(!is_numeric($this->values)){
	 		return true;
	 	}else{ return false; }
		//
	}

	public function phone($phone)
	{
		$this->values = $phone;

		if ($this->values === null or preg_match("/^[0-9]+$/", $this->values) === 0 or strlen($this->values) !== 10){
			return true;
	 	}
	 	else{ return false; }

	}

	public function anyLength($value, $length)
	{
		$this->values = $value;
		$this->length = $length;

		if ($this->values === null or preg_match("/^[0-9]+$/", $this->values) === 0 or strlen($this->values) !== $this->length){
			return true;
	 	}else{ return false; }

	}

	public function isDate($date){

		$this->values = $date;
		if(!$this->validateDate($this->values))
		{
			return true;
		}
		else{ return false; }
		//is_numeric
	}

	public function getNoDays($date){

		$this->values = $date;
		if($this->getDays($this->values))
		{
			return true;
		}
		else{ return false; }
		//is_numeric
	}

	public function dateLess($date){

		$this->values = $date;
		if ($this->values < date('Y-m-d'))
		{
			return true;
		}
		else{ return false; }
		//is_numeric
	}

	public function dateMore($date){

		$this->values = $date;
		if ($this->values > date('Y-m-d'))
		{
			return true;
		}
		else{ return false; }
		//is_numeric
	}

	public function ifDataExist($model, $column, $value){

		$this->model = $model;
		$this->column = $column;
		$this->value = $value;
		if ($this->ifexist($this->model, $this->column, $this->value))
		{
			return true;
		}
		else{ return false; }
		//is_numeric
	}

	public function ifDataExistupdate($model, $column, $value, $id){

		$this->model = $model;
		$this->column = $column;
		$this->values = $value;
		$this->id = $id;

		return $this->ifexistupdate($this->model, $this->column, $this->values, $this->id);
	}

	public function isEmailValid($email)
	{
		$this->values = $email;
		if (!filter_var($this->values, FILTER_VALIDATE_EMAIL))
		{
			return true;
		} else{ return false; }
	}

	private function validateDate($date, $format = 'Y-m-d')
	{
	    $d = DateTime::createFromFormat($format, $date);
	    return $d && $d->format($format) == $date;
	}


	private function getDays($date){

        $now = time(); // or your date as well
        $your_date = strtotime($date);
        $datediff = $your_date - $now;

        $date_diff = round($datediff / (60 * 60 * 24));

        if ($date_diff <= 10) {
            return true;
        }
        else{ return false; }

    }

    // check if data is there or not.
    private function ifexist($model, $column, $value){
        $data = $model::where([$column=> $value])->first();

        if ($data) {
            return true;
        }else{ return false; }

    }

    private function ifexistupdate($model, $column, $value, $id){
        $data = $model::where([$column=> $value])->first();

        if($data){

            if ($data->id === $id) {
                return false;
            }
            else if ($data->id != $id) {
                return true;
            }
        }
        else{ return false;}

    }
}
