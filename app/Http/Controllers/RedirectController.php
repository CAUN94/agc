<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RedirectController extends Controller {
	public function index() {
		$url = "https://youjustbetter.cl/";
		return Redirect::away($url);

	}

	public function development() {
		$url = "https://docs.google.com/forms/d/e/1FAIpQLScN3X3iTNlXW1XuTBOGGTECeGM7fXK43RHAg3oQS_lA9akLqQ/viewform?usp=sf_link";
		return Redirect::away($url);

	}

	public function communications() {
		$url = "https://docs.google.com/forms/d/e/1FAIpQLSf-6LgbONv4BuFIzoyjDpHFM2EbBZVhHHMeP8P1XKUAOe8jlg/viewform";
		return Redirect::away($url);

	}

	public function administration() {
		$url = "https://docs.google.com/forms/d/e/1FAIpQLSfI8R2A36mwtSwihtYocuQI9xgJ22L56E5PwvHN-ZFoqsC7Cw/viewform?usp=sf_link";
		return Redirect::away($url);

	}

	public function whatsapp() {
		$url = "https://api.whatsapp.com/send?phone=56933809726&text=Hola%20Equipo%20You";
		return Redirect::away($url);
	}

	public function whatsappform(Request $request) {
		$validated = $request->validate([
			'message' => 'required',
			'number' => 'required|min:8',
		]);
		$data = $request->all();
		$number = substr($data['number'], -8);
		$data['message'] = $data['message'] . " ";
		$data['message'] = preg_replace('/\n+/', '%0A', $data['message']);
		$data['message'] = preg_replace('/\s+/', '%20', $data['message']);
		$url = "https://api.whatsapp.com/send?phone=569" . $number . "&text=" . $data['message'];
		return Redirect::away($url);
	}

	public function trainning() {
		$url = "https://docs.google.com/forms/d/e/1FAIpQLScpUiedpwx-A20tpT_zVjineUTcGvpkHPpal7ztKekMTqP6TQ/viewform?usp=sf_link";
		return Redirect::away($url);
	}

	public function arancel() {
		$url = "https://docs.google.com/spreadsheets/d/1GeEQi1_4sWTI81nUj4z73SeKPBAh5VrFovGMASiLTMQ/edit?usp=sharing";
		return Redirect::away($url);
	}

	public function pay() {
		// $url = "https://pagatuprofesional.cl/profesionales/you-spa";
		$url = "https://padpow.com/customer/professionals/3165/payments/new";
		return Redirect::away($url);
	}

	public function contreras() {
		$url = "https://meet.jit.si/dcontrerasb";
		return Redirect::away($url);
	}

	public function cristi() {
		$url = "https://meet.jit.si/icristis";
		return Redirect::away($url);
	}

	public function guzman() {
		$url = "https://meet.jit.si/jmguzmanh";
		return Redirect::away($url);
	}

	public function moya() {
		$url = "https://meet.jit.si/cmoyac";
		return Redirect::away($url);
	}

	public function niklitschek() {
		$url = "https://meet.jit.si/aniklitscheks";
		return Redirect::away($url);
	}

	public function ross() {
		$url = "https://meet.jit.si/mrossg";
		return Redirect::away($url);
	}

	public function vivallo() {
		$url = "https://meet.jit.si/dvivallov";
		return Redirect::away($url);
	}

	public function internos() {
		$url = "https://meet.jit.si/internos";
		return Redirect::away($url);
	}

	public function meetyou() {
		$url = "https://meet.jit.si/meetyou";
		return Redirect::away($url);
	}

	public function fguzman() {
		$url = "https://meet.jit.si/fguzmanh";
		return Redirect::away($url);
	}

	public function hernandez() {
		$url = "https://meet.jit.si/chernandezc";
		return Redirect::away($url);
	}

	public function aceresuelap() {
		$url = "https://meet.jit.si/aceresuelap";
		return Redirect::away($url);
	}

	public function cahumadah() {
		$url = "https://meet.jit.si/cahumadah";
		return Redirect::away($url);
	}

	public function ncedeñow() {
		$url = "https://meet.jit.si/ncedeñow";
		return Redirect::away($url);
	}

	public function rnuches() {
		$url = "https://meet.jit.si/rnuches";
		return Redirect::away($url);
	}

	public function asaezm() {
		$url = "https://meet.jit.si/asaezm";
		return Redirect::away($url);
	}

	public function msilvaa() {
		$url = "https://meet.jit.si/msilvaa";
		return Redirect::away($url);
	}

	public function jvalcarcels() {
		$url = "https://meet.jit.si/jvalcarcels";
		return Redirect::away($url);
	}

	public function mrebolledon() {
		$url = "https://meet.jit.si/mrebolledon";
		return Redirect::away($url);
	}

	public function rrhh() {
		$url = "https://docs.google.com/forms/d/e/1FAIpQLSfp5FjEXouwK0_Tm6hkHaLMvrzqU6OsXmNhIYHUQ3-vdlbJSA/viewform?usp=sf_link";
		return Redirect::away($url);
	}

	public function techo() {
		$url = "https://docs.google.com/forms/d/e/1FAIpQLSeRuajbx4B0Ox8fA3g9hRZfIdfdRLAwoU6eJIsec98XlTq2gA/viewform?usp=pp_url";
		return Redirect::away($url);
	}

	public function rsf() {
		$url = "https://docs.google.com/forms/d/e/1FAIpQLScCFgcGZG_OAlDUaG2VdAUUYD4m3dCHWcRD33cUl-zv2Wiw4A/viewform?usp=sf_link";
		return Redirect::away($url);
	}

	public function registro() {
		$url = "https://docs.google.com/forms/d/1NHVEMK_SuUTnFHyACwKxXvydQ0t9BhOLevnWaL3U9Bw/edit";
		return Redirect::away($url);
	}

	public function comunicaciones() {
		$url = "https://docs.google.com/document/d/19iDHBI6mONTLLZ1j0MZoxyc0cyixm_HZGp2SzRF3CIE/edit#heading=h.samqshe4j5m8";
		return Redirect::away($url);
	}

	public function pendientes() {
		$url = "https://docs.google.com/document/d/1NT569Gz2aEPYaKyKakyAvBIXgKpLYS8NZ7ezMgUKUJo/edit";
		return Redirect::away($url);
	}

	public function clinica() {
		$url = "https://sites.google.com/justbetter.cl/recepcinyoujustbetter/temas-clinicos";
		return Redirect::away($url);
	}

	public function krunners() {
		$url = "https://docs.google.com/forms/d/e/1FAIpQLSd_SX3KxGY6kSpkZ3y-mlpxlQGMx6aeLTFERCW0eqL60ct6yw/viewform?usp=sf_link";
		return Redirect::away($url);
	}

	public function encuestahaas(){
		$url = "https://forms.gle/DFM9JJwcBGyaLPyq7";
		return Redirect::away($url);
	}

	public function strava(){
		$url = "https://www.strava.com/clubs/1043089";
		return Redirect::away($url);
	}

	public function viarunning(){
		$url = "https://docs.google.com/forms/d/e/1FAIpQLSelhtRWSR60BQpR_MasmD_Nbast35NVZmLiafB4m_ZBrDo2-A/viewform?usp=sf_link";
		return Redirect::away($url);
	}

	public function endurance(){
		$url = "https://docs.google.com/forms/d/e/1FAIpQLSdJFzOwZ1MbJ83sR2-iyY76EUPTkCSQHJsmjNjV6NUX1EO8OA/viewform?usp=sf_link";
		return Redirect::away($url);
	}

	public function academia(){
		$url = "https://you-just-better-programs.teachable.com/courses";
		return Redirect::away($url);
	}

	public function agendate(){
		$url = "https://f8f6bc91ed06a41fb6527cdbb7dd65b9638c84fd.agenda.softwaremedilink.com/agendas/agendamiento";
		return Redirect::away($url);
	}

	public function masterclass(){
		$url = "https://mpago.la/1Z75Xy3";
		return Redirect::away($url);
	}

	public function indicadores(){
		$url = 'https://auto-indicadores-yjb.streamlit.app/';
		return Redirect::away($url);
	}
	public function alianzas(){
		$url = 'https://alianzas-yjb.streamlit.app/';
		return Redirect::away($url);
	}
	public function progreso(){
		$url = 'https://progreso-yjb.streamlit.app/';
		return Redirect::away($url);
	}
	public function pnl(){
		$url = 'https://datos-relevantes-yjb.streamlit.app/';
		return Redirect::away($url);
	}
	public function horariospeak(){
		$url = 'https://horarios-peak-yjb.streamlit.app/';
		return Redirect::away($url);
	}

	public function recomiendanos(){
		$url = 'https://g.page/r/Cc9xYzd7nYRrEB0/review';
		return Redirect::away($url);
	}

	public function mds(){
		$url = 'https://forms.gle/w8Dg1Ruhgiijne29A';
		return Redirect::away($url);
	}

}
