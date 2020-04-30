<?php
Class Home_model extends CI_Model{
	function __construct(){
            parent::__construct();
            //load our second db and put in $db2
            $this->db2 = $this->load->database('second', TRUE);
    }

	public function getData($tableName, $where){
		$result = $this->db->query("select * from $tableName $where");
		return $result;
	}

	public function getRate($tableName, $where){
		$result = $this->db->query("select round($tableName,1) rerata from $where");
		return $result->row()->rerata;
	}

	public function getRateMentor($tableName, $where, $kondisi){
		$result = $this->db->query("select round($tableName,1) rerata from $where $kondisi");
		return $result->row()->rerata;
	}

	public function getDataLevelUser($tableName, $where){
		$result = $this->db->query("select statusLevelUser level from $tableName $where");
		return $result->row()->level;
	}

	public function getDataLevelUserRoot($tableName, $where){
		$result = $this->db->query("select statusUser userRoot from $tableName $where");
		return $result->row()->userRoot;
	}

	public function cekPeRating($penilai, $terimaNilai){
		$query = $this->db->query("select * from ratinguser where idPenilai='$penilai' && idPenerimaNilai='$terimaNilai' limit 1");
	    if($query->num_rows() > 0){
			return $query->result();
	    }else{
			return false;
	    }
	}
	
	public function getDataCount($column, $tableName, $where){
		$result = $this->db->query("select count($column) jumlah from $tableName $where");
		return $result->row()->jumlah;
	}

	
	public function insertData($tableName, $data){
		$result = $this->db->insert($tableName, $data);
		return $result;
	}

	public function insertData2nd($tableName, $data){
		$result = $this->db2->insert($tableName, $data);
		return $result;
	}

	public function updateData($tableName, $data, $where){
		$result = $this->db->update($tableName, $data, $where);
		return $result;
	}
	public function updateData2nd($tableName, $data, $where){
		$result = $this->db2->update($tableName, $data, $where);
		return $result;
	}
	public function updateTemporaryTargetInvest($tableName, $data, $where){
		$result = $this->db->query("update $tableName set temporaryTargetInvest=temporaryTargetInvest+$data $where");
		return $result;
	}

	public function updateSaldoMasuk($where1,$where2,$Uangnya,$tglNya){
		$this->db->where('id_identitas', $where1);
		$this->db->where('id_invest', $where2);
		$this->db->set('tgl_saldokas', "$tglNya");
		$this->db->set('saldoMasuk', 'saldoMasuk +'."$Uangnya", FALSE);
		$this->db->update('saldokas');
	}
	public function updateSaldoMasuk2nd($where1,$where2,$Uangnya){
		$this->db2->where('id_identitas', $where1);
		$this->db2->where('id_invest', $where2);
		$this->db2->set('saldoMasuk', 'saldoMasuk +'."$Uangnya", FALSE);
		$this->db2->update('saldokas');
	}

	public function updateCountReadBy($where1){
		$this->db->where('idArtikel', $where1);
		$this->db->set('readCount', 'readCount +'."1", FALSE);
		$this->db->update('artikel');
	}

	public function updatePaketAddMember($idPaket, $jmlJemaah){
		$this->db->where('idPaket', $idPaket);
		$this->db->set('currentMember', 'currentMember +'."$jmlJemaah", FALSE);
		$this->db->update('pakettourtravel');
	}

	public function updateSaldoDicairkan($where1,$where2,$Uangnya){
		$this->db->where('id_identitas', $where1);
		$this->db->where('id_invest', $where2);
		
		$this->db->set('saldoMasuk', 'saldoMasuk -'."$Uangnya", FALSE);
		$this->db->update('saldokas');
	}

	public function updateRating($totalSkor, $kondisi){
		$result = $this->db->query("update ratinguser set totalSkor = $totalSkor WHERE $kondisi ");
		return $result;
	}

	public function deleteData($tableName, $where){
		$result = $this->db->delete($tableName, $where);
		return $result;
	}

	public function countUser(){
		$this->db->select('id_identitas');
		$this->db->where("statusUser = '0'");
		$result = $this->db->count_all_results('identitas');
		return $result;
	}

	public function countClassificationItem($idToko){
		$this->db->select('idInvKlasifikasi');
		$this->db->where('idToko', $idToko);
		$result = $this->db->count_all_results('inventory_klasifikasi');
		return $result;
	}

	public function countLuas(){
		$this->db->select_sum('spaciousPond');
		$this->db->where("targetinvest.statusTargetInvest = 'A'");
		$result = $this->db->get('targetinvest')->row()->spaciousPond;
		return $result;
	}

	public function countInvest2($id){
		$this->db->select_sum('money');
		$this->db->where("invest.statusInvest = 'A'");
		$this->db->where("invest.id_targetInvest = '$id'");
		$result = $this->db->get('invest')->row()->money;
		return $result;
	}

	public function countSahamInvest($users){
		$this->db->select_sum('saham_invest');
		
		$this->db->where("invest.id_identitas = '$users'");
		$result = $this->db->get('invest')->row()->saham_invest;
		return $result;
	}

	

	public function countInvest(){
		$this->db->select_sum('money');
		$this->db->where("invest.statusInvest = 'N'");
		$result = $this->db->get('invest')->row()->money;
		return $result;
	}

	

	public function countInvestTambak(){
		$this->db->select_sum('money');
		$this->db->where("invest.statusInvest = 'A'");
		$this->db->where("invest.id_targetInvest = targetinvest.id_targetInvest");
		$this->db->where("targetinvest.statusTargetInvest = 'A'");
		$result = $this->db->get('invest, targetInvest')->row()->money;
		return $result;
	}

	public function countPenambak(){
		$this->db->select('fishFarmer');
		$result = $this->db->count_all_results('targetinvest');
		return $result;
	}

	public function email($username){
		$result = $this->db->query("select email from identitas where username = '$username'");
		return $result;
	}

	public function getMoney($tableName, $where){
		$result = $this->db->query("select * from $tableName $where");
		return $result;
	}

	public function updateTambak($id_tambak, $uang){
		$result = $this->db->query("update targetinvest set temporaryTargetInvestment = '$uang' WHERE statusTambak = 'A' AND id_tambak = '$id_tambak' ");
		return $result;
	}

	public function getSelectData($select, $tableName, $where){
		$result = $this->db->query("select $select from $tableName $where");
		return $result;
	}

	public function getSelectData2nd($select, $tableName, $where){
		$result = $this->db2->query("select $select from $tableName $where");
		return $result;
	}

	public function selectItemModel($idInvKlasifikasi)
	 {
	  $this->db->where('idInvKlasifikasi', $idInvKlasifikasi);
	  $this->db->order_by('namaItem', 'ASC');
	  $query = $this->db->get('inventory_item');
	  $output = '<option value="">Pilih item yang terkait dengan klasifikasi tersebut</option>
	  			 <option value="tambahJenisItemBaru" id="addNewOptionJenisItemttt">Tambah Klasifikasi Baru</option>
	  ';
	  foreach($query->result() as $row)
	  {
	   $output .= '<option value="'.$row->idInvItem.'">'.$row->namaItem.'</option>';
	  }
	  echo json_encode($output);
	 }

	 public function selectDetailItemModel($idInvKlasifikasi)
	 {
	  $this->db->where('idInvItem', $idInvKlasifikasi);
	  $this->db->order_by('variabel', 'ASC');
	  $query = $this->db->get('inventory_detail_item');
	  $output = "";
	  if (!$query->result()) {
	  	$output .= '<div class="col-md-12 alert alert-info">
                    
                    <span>
                      <b> Info - </b> Tidak ada detail data untuk item ini. Anda dapat menambahkan variabel baru pada kolom isian dibawah ini.</span>
                  </div>';
	  }else{
		  foreach($query->result() as $row)
		  {
		   // $output .= "<div  class='col-md-3' id='dataDetail".$row->idDetailItem."'><div class='card'><div class='card-body'><a href='".base_url()."Managements/show/dataDetail".$row->idDetailItem."' class='text-dark' >".$row->variabel."</a></div></div></div>";
		   $output .= "<div  class='col-md-3' id='dataDetail'><div class='card'><div class='card-body'>".$row->variabel."</div></div></div>";
		  }
		}
	  echo json_encode($output);
	 }

	 public function selectDetailItemModelShopPages($idInvKlasifikasi)
	 {
	  
	  $query = $this->Home_model->getSelectData("*","klasifikasibarang, detailbarang", "WHERE klasifikasibarang.idKlasifikasi=detailbarang.idKlasifikasi AND detailbarang.statusBarang='aktif' AND detailbarang.idBarang=$idInvKlasifikasi");
	  $output;
	  
	  if (!$query->result()) {
	  	$output['isi'] = '<div class="col-md-12 alert alert-info">
                    
                    <span>
                      <b> Info - </b> Tidak ada detail data untuk item ini. Anda dapat menambahkan variabel baru pada kolom isian dibawah ini.</span>
                  </div>';
	  }else{
	  	 
		  foreach($query->result() as $row)
		  {
		   // $output .= "<div  class='col-md-3' id='dataDetail".$row->idDetailItem."'><div class='card'><div class='card-body'><a href='".base_url()."Managements/show/dataDetail".$row->idDetailItem."' class='text-dark' >".$row->variabel."</a></div></div></div>";
		   $output['isi'] = '

		   
		  
			   <div style="margin-bottom:10px; border-bottom:1px solid #f2f2f2; width:100%;padding:20px;padding-bottom:12px;padding-top:12px;" id="trPesanan'.$row->idBarang.'">

			    <form action="" class="m-t-40" method="post" enctype="multipart/form-data" id="myform">
				   <table width=100% style="" id="tblPayment">
					   <tr class="trPaymentInvoice">
						   <td width=40%>'.$row->namaKlasifikasi.' '.$row->merk.'<small style="display:block;">variant <b>'.$row->ukuran.'</b></small>
						   <span style="display:block"><small><span class="badge badge-info">Stock '.$row->stok.'</span>
						   	<span class="badge badge-warning">@ Rp '.number_format($row->harga,0,',','.').'</span>
						   	<input type="hidden" class="hrgItemNya" id="hrgItem'.$row->idBarang.'" name="hrgItemInput[]" value="'.$row->harga.'">
						   	</small>
						   </span>
						   </td>
						   <input type="hidden" id="idItem'.$row->idBarang.'" name="idItemInput[]" value="'.$row->idBarang.'">
						   <input type="hidden" id="namaItem'.$row->idBarang.'" name="namaItemInput[]" value="'.$row->namaKlasifikasi.' '.$row->merk.'">
						   <input type="hidden" id="idTokoTerkaitNya'.$row->idBarang.'" name="idTokoTerkaitNyaInput[]" value="'.$row->idBarang.'" >
						   <td width=40% >
						   <div class="input-group number-spinner" style="text-align:center;">
								
									<span style="transform:scale(0.8,0.8);" class="btn btn-dark btn-just-icon" data-dir="dwn"><i class="fas fa-chevron-left" style="margin:auto; "></i></span>
								
									<input type="text" id="jmlPesanan'.$row->idBarang.'" class="form-control" min=0 style="width:25%; font-size:20px;border:none;color:#000; text-align:center" max="'.$row->stok.'" value="0" maxlength="3" name="jmlPesananInput[]">
								
									<span style=" transform:scale(0.8,0.8);" class="btn btn-dark btn-just-icon" data-dir="up"><i class="fas fa-chevron-right" style="margin:auto; "></i></span>
								
							</div>
						   
						   
						   </td>
						   
						   <td width=20% class="tdTotal text-center">
						   <div id="totalHslPesanan'.$row->idBarang.'" style="padding-left:10px;">0</div>
						   <input type="hidden" id="totalHrgHiddenID'.$row->idBarang.'" class="totalprice" name="totalHrgHiddenInput[]">
						   </td>
						  
						   	
			               
						   
					   </tr>
					   <div style="position:absolute; right:-25px; margin-top:7px;">
					   <button type="submit" class="btn btn-dark btn-round btn-just-icon" style="padding:0px; transform:scale(0.8,0.8);" id="btnHapusTD'.$row->idBarang.'">
			                  <i class="fas fa-trash" style="margin:auto;padding:10px; "></i>
			        
			                </button>
			                </div>


				   </table>
				   
				   <script type="text/javascript">

				   	
				 

				  $(document).ready(function() {
				   	var jmlNya'.$row->idBarang.' = 0;
					var hrgNya'.$row->idBarang.' = 0;
				   	
				   	var hslNya'.$row->idBarang.' = 0;
				   	var totalPayment = 0;
				   	var total = 0;
				   	
				    var value1'.$row->idBarang.'= 0 ;
				    
				    $("#jmlPesanan'.$row->idBarang.'").on("change", function(){
					   	  
		                  jmlNya'.$row->idBarang.' =  $(this).val();
		                  hrgNya'.$row->idBarang.' =  $("#hrgItem'.$row->idBarang.'").val();
		                  hslNya'.$row->idBarang.' = jmlNya'.$row->idBarang.' * hrgNya'.$row->idBarang.';
		                 
		                  $("#totalHrgHiddenID'.$row->idBarang.'").val(hslNya'.$row->idBarang.');
		                 
						  $("#totalHslPesanan'.$row->idBarang.'").html(hslNya'.$row->idBarang.'.toString());
						  

						  			//UNTUK MENGHASILKAN TOTAL----------------------------------------------------------
						  			
						  			total = 0;

									$(".tdTotal").each(function() {
									   			
										total += parseInt($(this).text());
									
									});
									$("#divTotalHargaNya").text(total.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));	


									if ($("#jmlPesanan'.$row->idBarang.'").filter(function(){ return this.value.trim(); }).length) {
                                                 $("#divTombolAcceptNya").fadeIn(900);
                                                  $("#divTombolAcceptNya").attr({"style" : "visibility:true"});
									}
                                    else {
                                                  $("#divTombolAcceptNya").fadeOut(900);
                                                  $("#divTombolAcceptNya").attr({"style" : "visibility:hidden"});

                                    }
									//UNTUK MENGHASILKAN TOTAL----------------------------------------------------------
					
				   });


				   										

												$("#btnTombolAcceptNyaID").on("click", function(evented){
													evented.preventDefault();


														
														var hrgItemNYa = $("#hrgItem'.$row->idBarang.'").val();
                                                  		var idItemNya = $("#idItem'.$row->idBarang.'").val();
                                                  		var namaItemNya = $("#namaItem'.$row->idBarang.'").val();
                                                  		var jmlPesananNya = $("#jmlPesanan'.$row->idBarang.'").val();
                                                  		var totalHrgHiddenIDNya = $("#totalHrgHiddenID'.$row->idBarang.'").val();
                                                  		var codeX = $("#idTransactionTag").text();

                                                  		jQuery.ajax({
					                                              type: "POST",
					                                              url: "'.base_url().'"+"Transaksi/insertPaymentInvoice",
					                                              dataType: "json",
						                                          //mengirim data dengan type post
						                                          data: {codeTrans:codeX, hargaItemNya: hrgItemNYa,namaItemNyaaa : namaItemNya, idItemNyaaa : idItemNya, jumlahPesananNya : jmlPesananNya, totalHargaNya : totalHrgHiddenIDNya},
						                                          //menerima result dari controller
						                                          
						                                          success: function(data) {

						                                          		Swal.fire({
									                                      position: "top-success",
									                                      title: "Transaksi berhasil.",
									                                      showConfirmButton: true,
									                                      timer: 3500
									                                    });


						                                          		   var resultCode ="";
						                                          		   var characters       = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
																		   var charactersLength = characters.length;
																		   for ( var i = 0; i < 10; i++ ) {
																		      resultCode += characters.charAt(Math.floor(Math.random() * charactersLength));
																		   }
																		   
						                                          		$("#idTransactionTag").text(resultCode);

						                                          		$("#searchBoxItemByName").trigger("change");
						                                          }
					                                          
					                                    });

					                                    $("#trPesanan'.$row->idBarang.'").remove();


								                  		//UNTUK MENGHASILKAN TOTAL----------------------------------------------------------
								                  			total = 0;

															$(".tdTotal").each(function() {
															   			
																total += parseInt($(this).text());
															
															});
															$("#divTotalHargaNya").text(total.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));

															if (total) {
						                                                  $("#divTombolAcceptNya").fadeIn(900);
						                                                  $("#divTombolAcceptNya").attr({"style" : "visibility:true"});
						                                                  
						                                            }
						                                            else {
						                                                  
						                                                  $("#divTombolAcceptNya").attr({"style" : "visibility:hidden"});
						                                                  $("#divTombolAcceptNya").fadeOut(900);

						                                    }

						                                //UNTUK MENGHASILKAN TOTAL----------------------------------------------------------


			                                             	

                                                  });


				   $("#btnHapusTD'.$row->idBarang.'").on("click", function(){

		                  $("#trPesanan'.$row->idBarang.'").remove();


		                  		//UNTUK MENGHASILKAN TOTAL----------------------------------------------------------
		                  			total = 0;

									$(".tdTotal").each(function() {
									   			
										total += parseInt($(this).text());
									
									});
									$("#divTotalHargaNya").text(total.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));

									if (total) {
                                                  $("#divTombolAcceptNya").fadeIn(900);
                                                  $("#divTombolAcceptNya").attr({"style" : "visibility:true"});
                                                  
                                            }
                                            else {
                                                  
                                                  $("#divTombolAcceptNya").attr({"style" : "visibility:hidden"});
                                                  $("#divTombolAcceptNya").fadeOut(900);

                                    }

                                //UNTUK MENGHASILKAN TOTAL----------------------------------------------------------
		   
				   });




				  





				   });


				  


			       </script>

			       </form>
			   </div>

			   
		   
		   ';
		  }

		 

		}

		


	  	echo json_encode($output);
	 }


	public function updateStockItemIfJustUpdate($where1,$stockNya){
		$this->db->where('idInvItem', $where1);
		$this->db->set('stock',"$stockNya", FALSE);
		$this->db->update('inventory_item');
	}

	public function updateStockItemIfJustUpdateByShopper($where1,$where2,$stockNya){
		$this->db->where('idItemRequest', $where1);
		$this->db->where('idTokoRequester', $where2);
		$this->db->set('stockRequest',"$stockNya", FALSE);
		$this->db->update('item_on_shop');
	}

	public function updateActualStockItemByShopper($where1,$where2,$stockNya){
		$this->db->where('idInvItem', $where1);
		$this->db->where('idTokoTerkait', $where2);
		$this->db->set('stockTerkini',"$stockNya", FALSE);
		$this->db->update('item_stock_actual');
	}


	public function updateStockItemIfTambahkan($where1,$stockNya){
		$this->db->where('idInvItem', $where1);
		$this->db->set('stock','stock +'."$stockNya", FALSE);
		$this->db->update('inventory_item');
	}

	public function updateStockItemIfTambahkanByShopper($where1,$where2,$stockNya){
		$this->db->where('idItemRequest', $where1);
		$this->db->where('idTokoRequester', $where2);
		$this->db->set('stockRequest','stockRequest +'."$stockNya", FALSE);
		$this->db->update('item_on_shop');
	}

	public function updateActualStockItemByShopperIfTambah($where1,$where2,$stockNya){
		$this->db->where('idInvItem', $where1);
		$this->db->where('idTokoTerkait', $where2);
		$this->db->set('stockTerkini','stockTerkini +'."$stockNya", FALSE);
		$this->db->update('item_stock_actual');
	}


	public function updateStockItemIfKurangi($where1,$stockNya){
		$this->db->where('idInvItem', $where1);
		$this->db->set('stock','stock -'."$stockNya", FALSE);
		$this->db->update('inventory_item');
	}

	public function updateStockItemIfKurangiByShopper($where1,$where2,$stockNya){
		$this->db->where('idItemRequest', $where1);
		$this->db->where('idTokoRequester', $where2);
		$this->db->set('stockRequest','stockRequest -'."$stockNya", FALSE);
		$this->db->update('item_on_shop');
	}

	public function updateActualStockItemByShopperIfKurang($where1,$where2,$stockNya){
		$this->db->where('idInvItem', $where1);
		$this->db->where('idTokoTerkait', $where2);
		$this->db->set('stockTerkini','stockTerkini -'."$stockNya", FALSE);
		$this->db->update('item_stock_actual');
	}

	public function updateStockSoldOutBySellerIfSent($where1,$stockNya,$where2){
		$this->db->where('idInvItem', $where1);
		$this->db->where('idTokoTerkait', $where2);
		$this->db->set('stockTerkini','stockTerkini -'."$stockNya", FALSE);
		$this->db->update('item_stock_actual');
	}

	public function updateStockItemWhenAdd($where1,$where2,$stockNya){
		$this->db->where('idInvItem', $where1);
		$this->db->where('idTokoTerkait', $where2);
		$this->db->set('stockTerkini','stockTerkini +'."$stockNya", FALSE);
		$this->db->update('item_stock_actual');
	}

	public function updateStockItemWhenPaymentOut($where1,$stockNya){
		$this->db->where('idBarang', $where1);
		$this->db->set('stok','stok -'."$stockNya", FALSE);
		$this->db->update('detailbarang');
	}
	public function updateStockItemWhenCancelPayment($where1,$stockNya){
		$this->db->where('idBarang', $where1);
		$this->db->set('stok','stok +'."$stockNya", FALSE);
		$this->db->update('detailbarang');
	}



	 
     
}
?>