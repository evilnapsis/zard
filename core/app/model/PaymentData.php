<?php
class PaymentData {
	public static $tablename = "payment";

	public function PaymentData(){
		$this->name = "";
	}

	public function getClient(){ return PersonData::getById($this->person_id); }
	public function getPaymentType(){ return PaymentTypeData::getById($this->payment_type_id); }



	public function add(){
		$sql = "insert into ".self::$tablename." (person_id,sell_id,val,payment_type_id,created_at) ";
		$sql .= "value (\"$this->person_id\",$this->sell_id,$this->val,1,NOW())";
		Executor::doit($sql);
	}


	public function add_payment(){
		$sql = "insert into ".self::$tablename." (person_id,val,payment_type_id,created_at) ";
		$sql .= "value (\"$this->person_id\",$this->val,2,NOW())";
		Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id=$id";
		Executor::doit($sql);
	}

	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->id";
		Executor::doit($sql);
	}


	public static function getById($id){
		 $sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new PaymentData());
	}

	public static function getByName($name){
		 $sql = "select * from ".self::$tablename." where name=\"$name\"";
		$query = Executor::doit($sql);
		return Model::one($query[0],new PaymentData());
	}


	public static function getAll(){
		$sql = "select * from ".self::$tablename." order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PaymentData());	
	}

	public static function getAllByDate($start,$end){
		$sql = "select * from ".self::$tablename." where (date(created_at)>=\"$start\" and date(created_at)<=\"$end\") and payment_type_id=2 order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PaymentData());	
	}

	public static function getAllByDateAndClient($start,$end,$id){
		$sql = "select * from ".self::$tablename." where (date(created_at)>=\"$start\" and date(created_at)<=\"$end\") and payment_type_id=2 and person_id=$id order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PaymentData());	
	}

	public static function getAllByClientId($id){
		$sql = "select * from ".self::$tablename." where person_id=$id order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PaymentData());	
	}

	public static function sumByClientId($id){
		$sql = "select SUM(val) as total from ".self::$tablename." where person_id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new PaymentData());	
	}


}

?>