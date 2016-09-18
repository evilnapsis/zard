<?php
class WidgetData {
	public static $tablename = "widget";


	public function WidgetData(){
		$this->title = "";
		$this->content = "";
		$this->image = "";
		$this->user_id = "";
		$this->is_public = "0";
		$this->created_at = "NOW()";
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (title,func,params,ord) ";
		$sql .= "value (\"$this->title\",\"$this->func\",\"$this->params\",$this->ord)";
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

// partiendo de que ya tenemos creado un objecto WidgetData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set title=\"$this->title\",func=\"$this->func\",params=\"$this->params\",status=\"$this->status\",ord=\"$this->ord\" where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new WidgetData());
	}



	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new WidgetData());
	}

	public static function getPublics(){
		$sql = "select * from ".self::$tablename." where status=1 order by ord";
		$query = Executor::doit($sql);
		return Model::many($query[0],new WidgetData());
	}

	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where title like '%$q%' or content like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new WidgetData());
	}


}

?>