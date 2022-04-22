<?php
require_once("CsvHandler.php");

class CsvMap extends CsvHandler
{
	public function init(){
		$this->loadKeys();
		$this->loadRowNames();

	}

	public function createMap(){
		$this->init();
		$keys=$this->keys;
	    $rowNames=$this->rowNames;
		$rows;
		
		foreach($rowNames as $rowKey){
			$cols=$this->getCols($rowKey);
			foreach($keys as $keyItem){
                $this->map[$rowKey][$keyItem]=$cols[$keyItem];
			}
		}
	
	}

	public function getMap(){
		return $this->map;
	}

	public function getMapItem($name, $key){
		//$item=$this->map[$name][$key];
		if (in_array($key, $this->keys) && in_array($name, $this->rowNames) ){
			$item=$this->map[$name][$key];
			return $item;
		}
		else {return "No such item!";}
	
	}

	public function getRows(){
		$tableArray=$this->getTableArray();
		$rows;
		$rowNumber=0;
		foreach($tableArray as $row){
			if ($rowNumber>0){
			$rows[$tableArray[$rowNumber][0]]=$row;
			}
			$rowNumber+=1;			
		}
		
		return $rows;
	}

	public function getCols($rowName){
		$colArray;
		$keys=$this->keys;
		$tableRow=$this->getRows();
		$colNumber=0;
		foreach($keys as $keyItem){
			$colArray[$keyItem]=$tableRow[$rowName][$colNumber];
			$colNumber+=1;
		}
		
		return $colArray;

	}


	public function loadKeys(){
		$this->keys=$this->getTableArray()[0];
	}

	public function loadRowNames(){
		$rows=$this->getRows();
		$rowNames;
		foreach ($rows as $item){
			$rowNames[]=$item[0];
		}

		$this->rowNames=$rowNames;

	}

	protected $map;
	protected $keys;
	protected $rowNames;

}

?>
