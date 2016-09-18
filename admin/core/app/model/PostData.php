<?php
class PostData {
	public static $tablename = "post";


	public function PostData(){
		$this->title = "";
		$this->content = "";
		$this->image_id = "NULL";
		$this->user_id = "";
		$this->is_public = "0";
		$this->accept_comments = "0";
		$this->show_image = "0";
		$this->created_at = "NOW()";
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (title,content,image_id,user_id,status,visibility,accept_comments,show_image,created_at) ";
		 $sql .= "value (\"$this->title\",\"$this->content\",$this->image_id,$this->user_id,$this->status,$this->visibility,$this->accept_comments,$this->show_image,$this->created_at)";
		return Executor::doit($sql);
	}

	public function addpage(){
		$sql = "insert into ".self::$tablename." (kind,title,content,image_id,user_id,status,visibility,accept_comments,show_image,created_at) ";
		$sql .= "value (2,\"$this->title\",\"$this->content\",$this->image_id,$this->user_id,$this->status,$this->visibility,$this->accept_comments,$this->show_image,$this->created_at)";
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

// partiendo de que ya tenemos creado un objecto PostData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set title=\"$this->title\",content=\"$this->content\",status=\"$this->status\",visibility=\"$this->visibility\",accept_comments=\"$this->accept_comments\",show_image=\"$this->show_image\" where id=$this->id";
		Executor::doit($sql);
	}

	public function update_image(){
		$sql = "update ".self::$tablename." set image_id=\"$this->image_id\" where id=$this->id";
		Executor::doit($sql);
	}
	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new PostData());
	}

	public static function countAllFromToday(){
		$sql = "select count(*) as c from ".self::$tablename." where date(created_at)=date(NOW())";
		$query = Executor::doit($sql);
		return Model::one($query[0],new PostData())->c;
	}


	public static function getAll(){
		$sql = "select * from ".self::$tablename." where kind=1 order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PostData());
	}

	public static function getPages(){
		$sql = "select * from ".self::$tablename." where kind=2 order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PostData());
	}


	public static function getLast($n){
		$sql = "select * from ".self::$tablename." where status=1 and kind=1 order by created_at desc limit $n";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PostData());
	}


	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where title like '%$q%' or content like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PostData());
	}


}

?>