<?php
	
include APPPATH . '/beans/Encript.php';
	
	class User
	{
		public $id_user;
		public $id_employee;
		public $name_user;
		public $password;
		public $token;
		public $day_entry;
		protected $encript;

		function __construct() {
			$this->encript = new Encript();
			date_default_timezone_set('America/Mexico_City');
			$this->day_entry = date("Y-m-d H:i:s");
	    }

		public function getId_user(){
			$this->id_user;
		}

		public function setId_user($id_user){
			$this->id_user = $id_user;
		}

		public function getId_employee(){
			$this->id_user;
		}

		public function setId_employee($id_employee){
			$this->id_employee = $id_employee;
		}
		
		public function getName_user(){
			$this->id_user;
		}

		public function setName_user($name_user){
			$this->name_user = $name_user;
		}
		
		public function getPassword(){
			$this->password;
		}

		public function setPassword($password){
			$this->id_user = $password;
		}		

		public function generateToken(){
		    $this->day_entry;
		    $str = $this->id_user . '|' . $this->id_employee . '|' . $this->name_user . '|' . $this->password;
		    $this->token = $this->encript->toEncrypt( $str, $this->day_entry);
		}

	}
?>