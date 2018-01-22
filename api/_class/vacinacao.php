<?php
class Vacinacao{
	private $anv_int_codigo;
	private $ani_int_codigo;
	private $vac_int_codigo;
	private $anv_dat_programacao;
	private $usu_int_codigo;


	public function getAnv_int_codigo() {
		return $this->anv_int_codigo;
	}

	public function setAnv_int_codigo($anv_int_codigo) {
		$this->anv_int_codigo = $anv_int_codigo;
	}

	public function getAnv_ani_int_codigo() {
		return $this->ani_int_codigo;
	}

	public function setAnv_ani_int_codigo($ani_int_codigo) {
		$this->ani_int_codigo = $ani_int_codigo;
	}

	public function getAnv_vac_int_codigo() {
		return $this->vac_int_codigo;
	}

	public function setAnv_vac_int_codigo($vac_int_codigo) {
		$this->vac_int_codigo = $vac_int_codigo;
	}

	public function getAnv_usu_int_codigo() {
		return $this->usu_int_codigo;
	}

	public function setAnv_usu_int_codigo($usu_int_codigo) {
		$this->usu_int_codigo = $usu_int_codigo;
	}

	public function getAnv_dat_programacao() {
		return $this->anv_dat_programacao;
	}

	public function setAnv_dat_programacao($anv_dat_programacao) {
		$this->anv_dat_programacao = $anv_dat_programacao;
	}
}