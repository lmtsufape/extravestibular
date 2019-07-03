<?php

namespace extravestibular\Http\Controllers;

use extravestibular\Http\Controllers\Controller;
use extravestibular\Inscricao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Auth;

class InscricaoController extends Controller
{
	public function cadastroInscricao(Request $request)
	  	 {
	  	 	  if(!strcmp($request->tipo, 'reintegracao')){
																								//salvar arquivo
		  	     $file = $request->historicoEscolar;
		  	     $path = 'inscricao/' . Auth::user()->id;
				  Storage::putFileAs($path, $file, 'historicoEscolar.pdf');
				  																				//criar inscricao no banco
				  Inscricao::create([
				  	'usuarioId'             => Auth::user()->id,
				  	'tipo'					   => $request->tipo,
				  	'editalId'              => $request->editalId,
				  	'historicoEscolar'      => '/home/wteia/site/extravestibular/storage/app/' . $path . '/historicoEscolar.pdf',
				  	'curso'						=> $request->curso,
				  	'polo'						=> $request->polo,
				  	'unidade'					=> $request->unidade,
				  	'turno'						=> $request->turno,
				  	'cursoDeOrigem'			=> $request->cursoDeOrigem,
				  	'instituicaoDeOrigem'   => $request->instituicaoDeOrigem,
				  	'naturezaDaIes'			=> $request->naturezaDaIes,
				  	'enderecoIes'				=> $request->enderecoIes,		  
				  ]);					  
				  	        
		        return view('home');
	    	  }
	    	  if(!strcmp($request->tipo, 'transferenciaInterna')) {
	    	  		
				  $file = $request->historicoEscolar;
		  	     $path = 'inscricao/' . Auth::user()->id;
				  Storage::putFileAs($path, $file, 'historicoEscolar.pdf');	
				  $file = $request->declaracaoDeVinculo;
		  	     $path = 'inscricao/' . Auth::user()->id;
				  Storage::putFileAs($path, $file, 'declaracaoDeVinculo.pdf');	  
				  
				  Inscricao::create([
				  	'usuarioId'             => Auth::user()->id,
				  	'tipo'					   => $request->tipo,
				  	'editalId'              => $request->editalId,
				  	'historicoEscolar'      => '/home/wteia/site/extravestibular/storage/app/' . $path . '/historicoEscolar.pdf',				  
				  	'declaracaoDeVinculo'   => '/home/wteia/site/extravestibular/storage/app/' . $path . '/declaracaoDeVinculo.pdf',
				  ]);	  
				  
				  return view('home');       
	    	  }
	    	  if(!strcmp($request->tipo, 'transferenciaExterna')) {
	    	  	
				  $file = $request->historicoEscolar;
		  	     $path = 'inscricao/' . Auth::user()->id;
				  Storage::putFileAs($path, $file, 'historicoEscolar.pdf');	
				  $file = $request->declaracaoDeVinculo;
		  	     $path = 'inscricao/' . Auth::user()->id;
				  Storage::putFileAs($path, $file, 'declaracaoDeVinculo.pdf');	    
				  $file = $request->historicoEscolar;
		  	     $path = 'inscricao/' . Auth::user()->id;
				  Storage::putFileAs($path, $file, 'programaDasDisciplinas.pdf');	
				  $file = $request->declaracaoDeVinculo;
		  	     $path = 'inscricao/' . Auth::user()->id;
				  Storage::putFileAs($path, $file, 'curriculo.pdf');
				  
				  Inscricao::create([
				  	'usuarioId'              => Auth::user()->id,
				  	'tipo'         			 => $request->tipo,
				  	'editalId'               => $request->editalId,
				  	'historicoEscolar'       => '/home/wteia/site/extravestibular/storage/app/' . $path . '/historicoEscolar.pdf',				  
				  	'declaracaoDeVinculo'    => '/home/wteia/site/extravestibular/storage/app/' . $path . '/declaracaoDeVinculo.pdf',   
				  	'programaDasDisciplinas' => '/home/wteia/site/extravestibular/storage/app/' . $path . '/programaDasDisciplinas.pdf',            
				  	'curriculo'              => '/home/wteia/site/extravestibular/storage/app/' . $path . '/curriculo.pdf',
				  
				  ]);	
				  
				  return view('home');   
	    	  }
	    	  if(!strcmp($request->tipo, 'portadorDeDiploma')) {
	    	  	  $file = $request->historicoEscolar;
		  	     $path = 'inscricao/' . Auth::user()->id;
				  Storage::putFileAs($path, $file, 'historicoEscolar.pdf');	
				  $file = $request->declaracaoDeVinculo;
		  	     $path = 'inscricao/' . Auth::user()->id;
				  Storage::putFileAs($path, $file, 'declaracaoDeVinculo.pdf');	    
				  $file = $request->historicoEscolar;
		  	     $path = 'inscricao/' . Auth::user()->id;
				  Storage::putFileAs($path, $file, 'programaDasDisciplinas.pdf');	
				  $file = $request->declaracaoDeVinculo;
		  	     $path = 'inscricao/' . Auth::user()->id;
				  Storage::putFileAs($path, $file, 'enem.pdf');
				  
				  Inscricao::create([
				  	'usuarioId'              => Auth::user()->id,
				  	'tipo'					    => $request->tipo,
				  	'editalId'               => $request->editalId,
				  	'historicoEscolar'       => '/home/wteia/site/extravestibular/storage/app/' . $path . '/historicoEscolar.pdf',				  
				  	'declaracaoDeVinculo'    => '/home/wteia/site/extravestibular/storage/app/' . $path . '/declaracaoDeVinculo.pdf',   
				  	'programaDasDisciplinas' => '/home/wteia/site/extravestibular/storage/app/' . $path . '/programaDasDisciplinas.pdf',            
				  	'enem'                   => '/home/wteia/site/extravestibular/storage/app/' . $path . '/enem.pdf',
				  
				  ]);	
				  
				  return view('home'); 
	    	  }	    	  
		 }
	    
}

