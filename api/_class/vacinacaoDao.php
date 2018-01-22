
<?php
require_once("vacinacao.php");

class VacinacaoDao {
    /** @param Animal $animal */
    public function selectByIdForm($animal_vacina) {
        $ret = array();
        try {
            $mysql = new GDbMysql();
            $mysql->execute("SELECT anv_int_codigo,ani_int_codigo,vac_int_codigo,anv_dat_programacao,anv_dti_aplicacao,usu_int_codigo FROM vw_animal_vacina WHERE anv_int_codigo = ? ", array("i", $animal_vacina->getAnv_int_codigo()), true, 'MYSQL_ASSOC');
            if ($mysql->fetch()) {
                $ret = $mysql->res;
            }
            $mysql->close();
        } catch (GDbException $e) {
            echo $e->getError();
        }
        return $ret;
    }

    /** @param Animal $animal */
    public function insert($animal_vacina) {

        $return = array();
        $param = array("iis",
            $animal_vacina->getAnv_ani_int_codigo(),
            $animal_vacina->getAnv_vac_int_codigo(),
            $animal_vacina->getAnv_dat_programacao()          
            );
        try{
            $mysql = new GDbMysql();
            $mysql->execute("CALL sp_vacinacao_ins(?,?,?, @p_status, @p_msg, @p_insert_id);", $param, false);
            $mysql->execute("SELECT @p_status, @p_msg, @p_insert_id");
            $mysql->fetch();
            $return["status"] = ($mysql->res[0]) ? true : false;
            $return["msg"] = $mysql->res[1];
            $return["insertId"] = $mysql->res[2];
            $mysql->close();
        } catch (GDbException $e) {
            $return["status"] = false;
            $return["msg"] = $e->getError();
        }
        return $return;
    }

    /** @param Animal $animal */
    public function update($animal_vacina) {


        $return = array();
        $param = array("iiisi",
            $animal_vacina->getAnv_int_codigo(),
            $animal_vacina->getAnv_ani_int_codigo(),
            $animal_vacina->getAnv_vac_int_codigo(),
            $animal_vacina->getAnv_dat_progamacao(),
            ); 
        try{
            $mysql = new GDbMysql();
            $mysql->execute("CALL sp_vacinacao_upd(?,?,?,?, @p_status, @p_msg);", $param, false);
            $mysql->execute("SELECT @p_status, @p_msg");
            $mysql->fetch();
            $return["status"] = ($mysql->res[0]) ? true : false;
            $return["msg"] = $mysql->res[1];
            $mysql->close();
        } catch (GDbException $e) {
            $return["status"] = false;
            $return["msg"] = $e->getError();
        }
        return $return;
    }

    /** @param Animal $animal */
    public function vacinar($animal_vacina) {
        $return = array();
        $param = array("iiisi",
            $animal_vacina->getAnv_int_codigo(),
            $animal_vacina->getAnv_ani_int_codigo(),
            $animal_vacina->getAnv_usu_int_codigo(),
            ); 
        try{
            $mysql = new GDbMysql();
            $mysql->execute("CALL sp_vacinacao_aplica(?,?,?, @p_status, @p_msg);", $param, false);
            $mysql->execute("SELECT @p_status, @p_msg");
            $mysql->fetch();
            $return["status"] = ($mysql->res[0]) ? true : false;
            $return["msg"] = $mysql->res[1];
            $mysql->close();
        } catch (GDbException $e) {
            $return["status"] = false;
            $return["msg"] = $e->getError();
        }
        return $return;
    }

    /** @param Animal $animal */
    public function delete($animal_vacina) {
        
        $return = array();
        $param = array("i",$animal_vacina->getAnv_int_codigo());
        try {
            $mysql = new GDbMysql();
            $mysql->execute("CALL sp_vacinacao_del(?, @p_status, @p_msg);", $param, false);
            $mysql->execute("SELECT @p_status, @p_msg");
            $mysql->fetch();
            $return["status"] = ($mysql->res[0]) ? true : false;
            $return["msg"] = $mysql->res[1];
            $mysql->close();
        } catch (GDbException $e) {
            $return["status"] = false;
            $return["msg"] = $e->getError();
        }
        return $return;
    }
}