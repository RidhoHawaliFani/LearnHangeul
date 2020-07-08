<?php

Class Agivest_model extends CI_Model {
    //1. Login - Model ---------------------------------------------------------
   	function getData($username, $password){
		$query = $this->db->query("select * from user where (username='$username' && password='$password')");
	    if($query->num_rows() > 0){
			return $query->result();
	    }else{
			return false;
	    }
	}
	function getDataToko($username, $password,$user){
		$query = $this->db->query("select * from identitastoko,karyawantoko where identitastoko.idNameToko='$username' and karyawantoko.emailKaryawan='$password' and karyawantoko.idToko=(SELECT idToko from karyawantoko  where usernameKaryawan='$user') limit 1");
	    if($query->num_rows() > 0){
			return $query->result();
	    }else{
			return false;
	    }
	}
	function getData2($username, $password){
		$query = $this->db->query("select * from identitastoko where (email='$username' && pass='$password') || (email='$username' && pass='$password') limit 1");
	    if($query->num_rows() > 0){
			return $query->result();
	    }else{
			return false;
	    }
	}
	function checkEmailValid($username){
		$result = $this->db->query("select * from user where idNameToko='$username'");
		return $result;
	}

	function checkEmailValid2($email,$username){
		$result = $this->db->query("select * from user where email='$email' and username='$username'");
		return $result;
	}

    //End of Login-Model -------------------------------------------------------

    //2. Register - Model ---------------------------------------------------------
   	function checkDuplicate($where){
		$result=$this->db->query('select * from user '. $where);		
		if($result->num_rows() == 0){
			return 0;//valid
		}else{
			return 1;//duplicate
		}
	}

	function checkDuplicateSaldoKas($where){
		$result=$this->db->query('select * from saldokas '. $where);		
		if($result->num_rows() == 0){
			return 0;//valid
		}else{
			return 1;//duplicate
		}
	}

	function insertData($tableName, $data){
		$result = $this->db->insert($tableName, $data);
		return $result;
	}
	//End of Register-Model -------------------------------------------------------

	//3. Forgot - Model ---------------------------------------------------------
	function checkEmailValidForgot($where){
	$result=$this->db->query("select * from user " . $where);		
		if($result->num_rows() == 0){			
			return 0;//Belum Terdaftar
		}else{
			return 1;//Sudah Terdaftar
		}
	}

	function updateStatus($verificationCode,$email, $username){
		$result = "update user set forgetPassCode = '$verificationCode' WHERE email = '$email' and username='$username'";
        $this->db->query($result);
    	return $result;
	}

	function resetPassword($password,$verificationText){
		$result = "update user set password = '$password' WHERE forgetPassCode = '$verificationText'";
        $this->db->query($result);
    	return $result;
	}

	function getDataForgot($verificationText){
		$result = $this->db->query("select * from identitas where verificationCodeForgotPass='$verificationText'");
		return $result;
	}
	//End of Forgot-Model -------------------------------------------------------
	//4. Investor - Model ---------------------------------------------------------
	public function getDataOrder($id_identitas){
		$result = $this->db->query("select * from invest,targetinvest where invest.id_targetInvest = targetinvest.id_targetInvest and invest.id_identitas = '$id_identitas'");
		return $result;
	}

	public function getDataOrder2($id_identitas){
		$result = $this->db->query("select * from invest,targetinvest where invest.id_targetInvest = targetinvest.id_targetInvest and invest.id_identitas = '$id_identitas' and invest.statusInvest = 'N'");
		return $result;
	}

	public function getDataOrderAktif($id_identitas){
		$result = $this->db->query("select * from invest,targetinvest where invest.id_targetInvest = targetinvest.id_targetInvest and invest.id_identitas = '$id_identitas' and invest.statusInvest = 'A'");
		return $result;
	}

	public function countOrderAktif($id_identitas){
		$result = $this->db->query("select count(invest.id_invest) as count from invest,targetinvest where invest.id_targetInvest = targetinvest.id_targetInvest and invest.id_identitas = '$id_identitas' and invest.statusInvest = 'A'");
		return $result->row()->count;
	}

	public function getDataInvestor($id_identitas){
		$result = $this->db->query("select * from identitas where id_identitas = '$id_identitas'");
		return $result;
	}

	public function getDataInvestasi($id_targetInvest){
		$result = $this->db->query("select * from invest
									LEFT JOIN identitas
									on identitas.id_identitas = invest.id_identitas
									where id_targetInvest = '$id_targetInvest'
									and invest.statusInvest = 'A'
									");
		return $result;
	}

	public function getCekTambak(){
		$result = $this->db->query("select *
									from targetinvest
									WHERE targetinvest.total_targetInvest <= (Select sum(money)
																	     From invest,targetinvest
																	     where invest.id_targetInvest = targetinvest.id_targetInvest
																	     and targetinvest.statusTargetInvest = 'A'
																	     and invest.statusInvest = 'A'
																		)");
		return $result;
	}

	public function getDataPenambak($id_targetInvest){
		$result = $this->db->query("
			select * from identitas 
			LEFT JOIN id_targetInvest 
			ON targetinvest.id_identitas = identitas.id_identitas
			WHERE targetinvest.id_targetInvest = '$id_targetInvest'  
			LIMIT 1");
		return $result;
	}

	public function getDataTambak($id_targetInvest, $statusInvest){
		$result = $this->db->query("select 
									targetinvest.namaInvest, 
									targetinvest.pictureInvest,
									targetinvest.statusTargetInvest,
									targetinvest.lokasiInvest, 
									invest.statusInvest, 
									invest.money,
									invest.id_invest,
									invest.ordered, 
									invest.expired
									from targetinvest,invest
									where targetinvest.id_targetInvest = invest.id_targetInvest
									and invest.id_targetInvest = '$id_targetInvest'
									and invest.statusInvest = '$statusInvest';");
		return $result;
	}

	public function getPilihTambak($id_targetInvest){
		$result = $this->db->query("select 
									targetinvest.namaInvest, 
									targetinvest.pictureInvest, 
									targetinvest.statusTargetInvest, 
									targetinvest.progressTargetInvest,
									targetinvest.lokasiInvest, 
									invest.statusInvest, 
									invest.money,
									invest.id_invest,
									invest.ordered, 
									invest.expired
									from targetinvest,invest
									where invest.id_targetInvest = '$id_targetInvest'
									and invest.statusInvest = 'A';");
		return $result;
	}	

	public function getTambak($id){
		$result = $this->db->query("select * from targetinvest
									WHERE targetinvest.statusTargetInvest = 'A'
									and targetinvest.namaInvest = '$id'
									order by idTambak");
		return $result;
	}

	public function countTambak($username,$namaInvest){
		$result = $this->db->query("select COUNT(namaInvest) 
									FROM invest
									WHERE username = '$username'
									AND namaInvest = '$namaInvest'
									AND statusInvest = 'A'
									HAVING COUNT(namaInvest) == 1");
		return $result;
	}

	public function deleteData($tableName, $where){
		$result = $this->db->delete($tableName, $where);
		return $result;
	}

	public function getDataPakan($id){
		$result = $this->db->query("select fypakan.tanggal_pakan, fypakan.jmlhKg_pakan
									from fypakan, targetinvest
									where fypakan.id_targetInvest = targetinvest.id_targetInvest
									and fypakan.id_targetInvest = '$id'
									and fypakan.id_penambak = targetinvest.id_penambak
									order by fypakan.id_pakan DESC;");
		return $result;
	}

	public function countPakan($id){
		$this->db->select_sum('jmlhKg_pakan');
		$this->db->where("fypakan.id_targetInvest = '$id'");
		$this->db->where("targetinvest.id_targetInvest = fypakan.id_targetInvest");
		$this->db->where("targetinvest.id_penambak = fypakan.id_penambak");
		$result = $this->db->get('fypakan, targetinvest')->row()->jmlhKg_pakan;
		return $result;
	}

	public function getDataIkan($id){
		$result = $this->db->query("select 
									fyikan.id_ikan, 
									fyikan.condition_ikan,
									fyikan.desc_ikan,
									fyikan.dead_ikan,
									fyikan.date_ikan
									from fyikan,targetinvest
									where fyikan.id_targetInvest = '$id' 
									and fyikan.id_targetInvest = targetinvest.id_targetInvest
									and fyikan.id_penambak = targetinvest.id_penambak
									order by fyikan.id_ikan DESC;");
		return $result;
	}

	public function getKondisiIkan($id){
		/*
		$result = $this->db->query("select 
									condition_ikan
									from fyikan,targetinvest
									where fyikan.id_targetInvest = '$id' 
									and fyikan.id_targetInvest = targetinvest.id_targetInvest
									and fyikan.id_penambak = targetinvest.id_penambak
									limit 1;");
		return $result;*/

		$this->db->select('condition_ikan');
		$this->db->where("fyikan.id_targetInvest = '$id'");
		$this->db->where("fyikan.id_targetInvest = targetinvest.id_targetInvest");
		$result = $this->db->get('fyikan, targetinvest');
		return $result;
	}

	public function getDataUang($id){
		$result = $this->db->query("select 
									fyuang.id_uang,
									fyuang.date_uang,
									fyuang.save_uang,
									fyuang.buy_uang,
									fyuang.desc_uang
									from fyuang, targetinvest
									where targetinvest.id_targetInvest = fyuang.id_targetInvest
									and fyuang.id_targetInvest = '$id'
									and fyuang.id_penambak = targetinvest.id_penambak
									order by fyuang.id_uang DESC;");
		return $result;
	}

	//End of Investor-Model -------------------------------------------------------
	//5. Penambak - Model ---------------------------------------------------------
	public function getIdTambak($id_identitas){
		$this->db->select('id_targetInvest');
		$this->db->where("targetinvest.id_penambak = '$id_identitas'");
		$result = $this->db->get('targetInvest')->row()->id_targetInvest;
		return $result;
	}

	public function getTempInvestment($id_targetInvest){
		$this->db->select('temporaryInvestment');
		$this->db->where("targetinvest.id_targetInvest = '$id_targetInvest'");
		$result = $this->db->get('targetInvest')->row()->temporaryInvestment;
		return $result;
	}

	//End of Investor-Model -------------------------------------------------------
}

?>