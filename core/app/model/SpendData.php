<?php
class SpendData {
	public static $tablename = "spend";

	public function SpendData(){
		$this->name = "";
		$this->price_in = "";
		$this->price_out = "";
		$this->unit = "";
		$this->user_id = "";
		$this->presentation = "0";
		$this->created_at = "NOW()";
	}

	public function getCategory(){ return SpendData::getById($this->category_id);}

	public function add(){
		$sql = "insert into spend (name,price,created_at) ";
		$sql .= "value (\"$this->name\",$this->price,$this->created_at)";
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

// partiendo de que ya tenemos creado un objecto CategoryData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set name=\"$this->name\",price=$this->price where id=$this->id";
		Executor::doit($sql);
	}

	public function update_box(){
		$sql = "update ".self::$tablename." set box_id=$this->box_id where id=$this->id";
		Executor::doit($sql);
	}


	public function del_category(){
		$sql = "update ".self::$tablename." set category_id=NULL where id=$this->id";
		Executor::doit($sql);
	}


	public function update_image(){
		$sql = "update ".self::$tablename." set image=\"$this->image\" where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new SpendData());

	}



	public static function getAll(){
		$sql = "select * from ".self::$tablename." order by created_at ";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SpendData());
	}

	public static function getAllUnBoxed(){
		$sql = "select * from ".self::$tablename." where box_id is NULL order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SpendData());
	}


	public static function getAllByPage($start_from,$limit){
		$sql = "select * from ".self::$tablename." where id>=$start_from limit $limit";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SpendData());
	}


	public static function getLike($p){
		$sql = "select * from ".self::$tablename." where barcode like '%$p%' or name like '%$p%' or id like '%$p%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SpendData());
	}



	public static function getAllByUserId($user_id){
		$sql = "select * from ".self::$tablename." where user_id=$user_id order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SpendData());
	}

	public static function getAllByCategoryId($category_id){
		$sql = "select * from ".self::$tablename." where category_id=$category_id order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SpendData());
	}

		public static function getGroupByDateOp($start,$end){
 		$sql = "select *,sum(price) as t from ".self::$tablename." where date(created_at) >= \"$start\" and date(created_at) <= \"$end\"";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SellData());

	}






}

?>