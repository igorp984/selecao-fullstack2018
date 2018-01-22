<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '_class/vacinacaoDao.php';

$app->get('/vacinacoes/{anv_int_codigo}', function (Request $request, Response $response) {
    $anv_int_codigo = $request->getAttribute('anv_int_codigo');

    $animal_vacina = new Vacinacao();
    $animal_vacina->setAnv_int_codigo($anv_int_codigo);

    $data = VacinacaoDao::selectByIdForm($animal_vacina);
    $code = count($data) > 0 ? 200 : 404;

	return $response->withJson($data, $code);
});


$app->post('/vacinacoes', function (Request $request, Response $response) {
    $body = $request->getParsedBody();

    $animal_vacina = new Vacinacao();
    $animal_vacina->setAnv_ani_int_codigo($body['ani_int_codigo']);
 	$animal_vacina->setAnv_vac_int_codigo($body['vac_int_codigo']);
 	$animal_vacina->setAnv_dat_programacao($body['anv_dat_programacao']);


    $data = VacinacaoDao::insert($animal_vacina);
    $code = ($data['status']) ? 201 : 500;

	return $response->withJson($data, $code);
});


$app->put('/vacinacoes/{anv_int_codigo}', function (Request $request, Response $response) {
    $body = $request->getParsedBody();
	$anv_int_codigo = $request->getAttribute('anv_int_codigo');

    $animal_vacina = new Vacinacao();

    $animal_vacina->setAnv_int_codigo($anv_int_codigo);
    $animal_vacina->setAnv_ani_int_codigo($body['ani_int_codigo']);
    $animal_vacina->setAnv_vac_int_codigo($body['vac_int_codigo']);
    $animal_vacina->setAnv_dat_programacao($body['anv_dat_programacao']);

    $data = VacinacaoDao::update($animal_vacina);
    $code = ($data['status']) ? 200 : 500;

	return $response->withJson($data, $code);
});

$app->put('/vacinacoes/vacinar/{anv_int_codigo}', function (Request $request, Response $response) {
    $body = $request->getParsedBody();
	$anv_int_codigo = $request->getAttribute('anv_int_codigo');

    $animal_vacina = new Vacinacao();

    $animal_vacina->setAnv_int_codigo($anv_int_codigo);
    $animal_vacina->setAnv_ani_int_codigo($body['usu_int_codigo']);
    $animal_vacina->setAnv_usu_int_codigo($body['usu_int_codigo']);

    $data = VacinacaoDao::vacinar($animal_vacina);
    $code = ($data['status']) ? 200 : 500;

	return $response->withJson($data, $code);
});


$app->delete('/vacinacoes/{anv_int_codigo}', function (Request $request, Response $response) {
    $anv_int_codigo = $request->getAttribute('anv_int_codigo');
    
    $animal_vacina = new Vacinacao();
    $animal_vacina->setAnv_int_codigo($anv_int_codigo);

    $data = VacinacaoDao::delete($animal_vacina);
    $code = ($data['status']) ? 200 : 500;

	return $response->withJson($data, $code);
});