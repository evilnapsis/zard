<?php
class CommentData {
	public static $tablename = "comment";


	public function CommentData(){
		$this->title = "";
		$this->content = "";
		$this->image = "";
		$this->user_id = "";
		$this->is_public = "0";
		$this->created_at = "NOW()";
	}

	public function getPost(){ return PostData::getById($this->post_id); }

	public function add(){
		$sql = "insert into ".self::$tablename." (name,email,content,post_id,created_at) ";
		$sql .= "value (\"$this->name\",\"$this->email\",\"$this->content\",$this->post_id,$this->created_at)";
		return Executor::doit($sql);
	}

	public function addmsg(){
		$sql = "insert into ".self::$tablename." (name,email,content,kind,created_at) ";
		$sql .= "value (\"$this->name\",\"$this->email\",\"$this->content\",2,$this->created_at)";
		return Executor::doit($sql);
	}


	public function answer(){
		$sql = "insert into ".self::$tablename." (content,comment_id,is_public,created_at) ";
		$sql .= "value (\"$this->content\",$this->comment_id,1,$this->created_at)";
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

// partiendo de que ya tenemos creado un objecto CommentData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set title=\"$this->title\",content=\"$this->content\",is_public=\"$this->is_public\" where id=$this->id";
		Executor::doit($sql);
	}


	public function aprove(){
		$sql = "update ".self::$tablename." set is_public=1 where id=$this->id";
		Executor::doit($sql);
	}

	public function unaprove(){
		$sql = "update ".self::$tablename." set is_public=0 where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new CommentData());
	}

	public static function countPendings(){
		$sql = "select count(*) as c from ".self::$tablename." where kind=1 and is_public=0";
		$query = Executor::doit($sql);
		return Model::one($query[0],new CommentData())->c;
	}

	public static function countMsgPendings(){
		$sql = "select count(*) as c from ".self::$tablename." where kind=2 and is_public=0";
		$query = Executor::doit($sql);
		return Model::one($query[0],new CommentData())->c;
	}


	public static function getAll(){
		$sql = "select * from ".self::$tablename." where kind=1 order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new CommentData());
	}

	public static function getMessages(){
		$sql = "select * from ".self::$tablename." where kind=2 order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new CommentData());
	}


	public static function getApprovedByPostId($id){
		$sql = "select * from ".self::$tablename." where post_id=$id and is_public order by created_at";
		$query = Executor::doit($sql);
		return Model::many($query[0],new CommentData());
	}

	public static function getApprovedByCommentId($id){
		$sql = "select * from ".self::$tablename." where comment_id=$id and is_public order by created_at";
		$query = Executor::doit($sql);
		return Model::many($query[0],new CommentData());
	}


	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where title like '%$q%' or content like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new CommentData());
	}


}

?>