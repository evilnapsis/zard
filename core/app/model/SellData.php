<?php
class SellData {
	public static $tablename = "sell";

	public function SellData(){
		$this->created_at = "NOW()";
	}

	public function getPerson(){ return PersonData::getById($this->person_id);}
	public function getUser(){ return UserData::getById($this->user_id);}
	public function getP(){ return PData::getById($this->p_id);}
	public function getD(){ return DData::getById($this->d_id);}
	public function getStockTo(){ return StockData::getById($this->stock_to_id);}

	public function add(){
		$sql = "insert into ".self::$tablename." (person_id,stock_to_id,iva,p_id,d_id,total,discount,user_id,created_at) ";
		$sql .= "value ($this->person_id,$this->stock_to_id,$this->iva,$this->p_id,$this->d_id,$this->total,$this->discount,$this->user_id,$this->created_at)";
		return Executor::doit($sql);
	}
	public function add_traspase(){
		$sql = "insert into ".self::$tablename." (operation_type_id,iva,p_id,d_id,total,discount,user_id,created_at) ";
		echo $sql .= "value (6,$this->iva,$this->p_id,$this->d_id,$this->total,$this->discount,$this->user_id,$this->created_at)";
		return Executor::doit($sql);
	}


	public function add_cotization(){
		$sql = "insert into ".self::$tablename." (is_draft,p_id,d_id,user_id,created_at) ";
		$sql .= "value (1,2,2,$this->user_id,$this->created_at)";
		return Executor::doit($sql);
	}

	public function add_cotization_by_client(){
		$sql = "insert into ".self::$tablename." (is_draft,p_id,d_id,person_id,created_at) ";
		echo $sql .= "value (1,2,2,$this->person_id,$this->created_at)";
		return Executor::doit($sql);
	}

	public function add_de(){
		$sql = "insert into ".self::$tablename." (user_id,operation_type_id,created_at) ";
		$sql .= "value ($this->user_id,1,$this->created_at)";
		return Executor::doit($sql);
	}


	public function add_re(){
		$sql = "insert into ".self::$tablename." (person_id,stock_to_id,total,p_id,d_id,user_id,operation_type_id,created_at) ";
		$sql .= "value ($this->person_id,$this->stock_to_id,$this->total,$this->p_id,$this->d_id,$this->user_id,1,$this->created_at)";
		return Executor::doit($sql);
	}


public function add_with_client(){	
		$sql = "insert into ".self::$tablename." (iva,p_id,d_id,total,discount,person_id,user_id,created_at) ";
		$sql .= "value ($this->iva,$this->p_id,$this->d_id,$this->total,$this->discount,$this->person_id,$this->user_id,$this->created_at)";
		return Executor::doit($sql);
	}
	public function add_re_with_client(){
		$sql = "insert into ".self::$tablename." (p_id,d_id,person_id,operation_type_id,user_id,created_at) ";
		$sql .= "value ($this->p_id,$this->d_id,$this->person_id,1,$this->user_id,$this->created_at)";
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

	public function process_cotization(){
		$sql = "update ".self::$tablename." set p_id=$this->p_id,d_id=$this->d_id,iva=$this->iva,total=$this->total,discount=$this->discount,cash=$this->cash,is_draft=0 where id=$this->id";
		Executor::doit($sql);
	}

	public function update_box(){
		$sql = "update ".self::$tablename." set box_id=$this->box_id where id=$this->id";
		Executor::doit($sql);
	}

	public function update_d(){
		$sql = "update ".self::$tablename." set d_id=$this->d_id where id=$this->id";
		Executor::doit($sql);
	}

	public function update_p(){
		$sql = "update ".self::$tablename." set p_id=$this->p_id where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		 $sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new SellData());
	}



	public static function getCotizations(){
		$sql = "select * from ".self::$tablename." where operation_type_id=2 and p_id=2 and d_id=2 and is_draft=1 order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SellData());
	}

	public static function getCotizationsByClientId($id){
		$sql = "select * from ".self::$tablename." where operation_type_id=2 and p_id=2 and d_id=2 and is_draft=1 and person_id=$id order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SellData());
	}

	public static function getSells(){
		$sql = "select * from ".self::$tablename." where operation_type_id=2 and p_id=1 and d_id=1 and is_draft=0 order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SellData());
	}

	public static function getSellsByUS($id){
		$sql = "select * from ".self::$tablename." where user_id=$id and operation_type_id=2 and p_id=1 and d_id=1 and is_draft=0 order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SellData());
	}

	public static function getSellsByPersonId($id,$p,$d){
		$sql = "select * from ".self::$tablename." where person_id=$id and operation_type_id=2 and p_id=$p and d_id=$d and is_draft=0 order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SellData());
	}

	public static function getSellsByUserId($id){
		$sql = "select * from ".self::$tablename." where operation_type_id=2 and p_id=1 and d_id=1 and is_draft=0 and user_id=$id order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SellData());
	}

	public static function getSellsByStockId($id){
		$sql = "select * from ".self::$tablename." where operation_type_id=2 and p_id=1 and d_id=1 and is_draft=0 and stock_to_id=$id order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SellData());
	}

	public static function getCredits(){
		$sql = "select * from ".self::$tablename." where operation_type_id=2 and p_id=4 and is_draft=0 order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SellData());
	}

	public static function getCreditsByUserId($id){
		$sql = "select * from ".self::$tablename." where operation_type_id=2 and p_id=4 and is_draft=0 and user_id=$id order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SellData());
	}

	public static function getCreditsByStockId($id){
		$sql = "select * from ".self::$tablename." where operation_type_id=2 and p_id=4 and is_draft=0 and stock_to_id=$id order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SellData());
	}

	public static function getSellsByClientId($id){
		$sql = "select * from ".self::$tablename." where operation_type_id=2 and p_id=1 and d_id=1 and is_draft=0 and person_id=$id order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SellData());
	}


	public static function getSellsToDeliver(){
		$sql = "select * from ".self::$tablename." where operation_type_id=2 and d_id=2 and is_draft=0 order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SellData());
	}

	public static function getSellsToDeliverByUserId($id){
		$sql = "select * from ".self::$tablename." where operation_type_id=2 and d_id=2 and is_draft=0 and user_id=$id order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SellData());
	}
	public static function getSellsToDeliverByStockId($id){
		$sql = "select * from ".self::$tablename." where operation_type_id=2 and d_id=2 and is_draft=0 and stock_to_id=$id order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SellData());
	}


	public static function getSellsToDeliverByClient($id){
		$sql = "select * from ".self::$tablename." where operation_type_id=2 and d_id=2 and is_draft=0 and person_id=$id order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SellData());
	}

	public static function getSellsToCob(){
		$sql = "select * from ".self::$tablename." where operation_type_id=2 and p_id=2 and is_draft=0 order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SellData());
	}

	public static function getSellsToCobByUserId($id){
		$sql = "select * from ".self::$tablename." where operation_type_id=2 and p_id=2 and is_draft=0 and user_id=$id order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SellData());
	}
	public static function getSellsToCobByStockId($id){
		$sql = "select * from ".self::$tablename." where operation_type_id=2 and p_id=2 and is_draft=0 and stock_to_id=$id order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SellData());
	}

	public static function getSellsToCobByClientId($id){
		$sql = "select * from ".self::$tablename." where operation_type_id=2 and p_id=2 and is_draft=0 and person_id=$id order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SellData());
	}


	public static function getSellsUnBoxed(){
		$sql = "select * from ".self::$tablename." where operation_type_id=2 and box_id is NULL and p_id=1 and is_draft=0 order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SellData());
	}

	public static function getByBoxId($id){
		$sql = "select * from ".self::$tablename." where operation_type_id=2 and box_id=$id and is_draft=0 order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SellData());
	}

	public static function getRes(){
		$sql = "select * from ".self::$tablename." where operation_type_id=1 and p_id=1 and d_id=1 order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SellData());
	}

	public static function getResByStockId($id){
		$sql = "select * from ".self::$tablename." where operation_type_id=1 and p_id=1 and d_id=1 and stock_to_id=$id order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SellData());
	}

	public static function getResToPay(){
		$sql = "select * from ".self::$tablename." where operation_type_id=1 and p_id=2  order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SellData());
	}

	public static function getResToPayByStockId($id){
		$sql = "select * from ".self::$tablename." where operation_type_id=1 and p_id=2 and stock_to_id=$id order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SellData());
	}

	public static function getResToReceive(){
		$sql = "select * from ".self::$tablename." where operation_type_id=1 and d_id=2  order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SellData());
	}

	public static function getResToReceiveByStockId($id){
		$sql = "select * from ".self::$tablename." where operation_type_id=1 and d_id=2 and stock_to_id=$id order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SellData());
	}

	public static function getAllByPage($start_from,$limit){
		$sql = "select * from ".self::$tablename." where id<=$start_from limit $limit";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SellData());

	}

	public static function getAllByDateOp($start,$end,$op){
	  $sql = "select * from ".self::$tablename." where date(created_at) >= \"$start\" and date(created_at) <= \"$end\" and operation_type_id=$op and is_draft=0 and p_id=1 and d_id=1 order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SellData());
	}

	public static function getAllByDateOpByUserId($user,$start,$end,$op){
	  $sql = "select * from ".self::$tablename." where date(created_at) >= \"$start\" and date(created_at) <= \"$end\" and operation_type_id=$op and is_draft=0 and p_id=1 and d_id=1 and user_id=$user order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SellData());
	}


		public static function getGroupByDateOp($start,$end,$op){
  $sql = "select id,sum(total) as tot,discount,sum(total-discount) as t,count(*) as c from ".self::$tablename." where date(created_at) >= \"$start\" and date(created_at) <= \"$end\" and operation_type_id=$op";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SellData());
	}


	public static function getAllByDateBCOp($clientid,$start,$end,$op){
 		$sql = "select * from ".self::$tablename." where date(created_at) >= \"$start\" and date(created_at) <= \"$end\" and person_id=$clientid  and operation_type_id=$op and is_draft=0 and p_id=1 and d_id=1 order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SellData());

	}

	public static function getAllByDateBCOpByUserId($user,$clientid,$start,$end,$op){
 		$sql = "select * from ".self::$tablename." where date(created_at) >= \"$start\" and date(created_at) <= \"$end\" and person_id=$clientid  and operation_type_id=$op and is_draft=0 and p_id=1 and d_id=1 and user_id=$user order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SellData());

	}


}

?>