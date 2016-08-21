<?php
class SavingData {
	public static $tablename = "saving";

	public function SavingData(){


		$this->created_at = "NOW()";
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (concept,description,date_at,amount,kind,created_at) ";
		$sql .= "value (\"$this->concept\",\"$this->description\",\"$this->date_at\",\"$this->amount\",\"$this->kind\",$this->created_at)";
		Executor::doit($sql);
	}

	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->id";
		Executor::doit($sql);
	}

	public static function delBy($k,$v){
		$sql = "delete from ".self::$tablename." where $k=\"$v\"";
		Executor::doit($sql);
	}

	public function update(){
		$sql = "update ".self::$tablename." set concept=\"$this->concept\",description=\"$this->description\",date_at=\"$this->date_at\",amount=\"$this->amount\" where id=$this->id";
		Executor::doit($sql);
	}

	public function updateById($k,$v){
		$sql = "update ".self::$tablename." set $k=\"$v\" where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		 $sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new SavingData());
	}

	public static function getBy($k,$v){
		$sql = "select * from ".self::$tablename." where $k=\"$v\"";
		$query = Executor::doit($sql);
		return Model::one($query[0],new SavingData());
	}

	public static function sumByKind($k){
		$sql = "select sum(amount) as s from ".self::$tablename." where kind=\"$k\"";
		$query = Executor::doit($sql);
		return Model::one($query[0],new SavingData());
	}

	public static function getAll(){
		 $sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new SavingData());
	}

	public static function getAllByKind($k){
		 $sql = "select * from ".self::$tablename." where kind=$k order by date_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SavingData());
	}

	public static function getAllByKindDate($d,$k){
		 $sql = "select * from ".self::$tablename." where kind=$k and date_at=\"$d\" order by date_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SavingData());
	}

	public static function getSumByKindDate($d,$k){
		$sql = "select sum(amount) as t from ".self::$tablename." where kind=$k and date_at=\"$d\" order by date_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SavingData());
	}

	public static function getAllBy($k,$v){
		 $sql = "select * from ".self::$tablename." where $k=\"$v\"";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SavingData());
	}


	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where name like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SavingData());
	}


}

?>