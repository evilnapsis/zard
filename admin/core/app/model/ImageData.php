<?php
class ImageData {
	public static $tablename = "image";


	public function ImageData(){
		$this->title = "";
		$this->content = "";
		$this->image = "";
		$this->user_id = "";
		$this->is_public = "0";
		$this->created_at = "NOW()";
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (src,user_id,created_at) ";
		$sql .= "value (\"$this->src\",$this->user_id,$this->created_at)";
		return Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id=$id";
		Executor::doit($sql);
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->id";
		Executor::doit($sql);
	}

// partiendo de que ya tenemos creado un objecto ImageData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set title=\"$this->title\",description=\"$this->description\" where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ImageData());
	}

	public static function countAllFromToday(){
		$sql = "select count(*) as c from ".self::$tablename." where date(created_at)=date(NOW())";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ImageData())->c;
	}


	public static function getAll(){
		$sql = "select * from ".self::$tablename." order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ImageData());
	}

	public static function getLast10(){
		$sql = "select * from ".self::$tablename." order by created_at desc limit 10";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ImageData());
	}


	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where title like '%$q%' or content like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ImageData());
	}


}

?>